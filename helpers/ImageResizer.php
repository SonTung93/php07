<?php

define('FILE_CACHE_DIRECTORY', './upload/cache');
define('FILE_CACHE_TIME_BETWEEN_CLEANS', 25000);
define('FILE_CACHE_MAX_FILE_AGE', 25000);
define('FILE_CACHE_SUFFIX', '__mokova_.txt');
define('MAX_FILE_SIZE', 10485760); //10MB
define('MAX_WIDTH', 15000);
define('MAX_HEIGHT', 15000);
define('DEFAULT_WIDTH', 100);
define('DEFAULT_HEIGHT', 100);

define('BROWSER_CACHE_DISABLE', false);
define('FILE_CACHE_ENABLED', TRUE);
define('BROWSER_CACHE_MAX_AGE', 864000);

ImageResizer::ready();

class ImageResizer {

    public $cachefile = null;
    public $docRoot = null;
    public $cacheDirectory = null;
    public $localImage = null;
    public $localImageMTime = null;
    public $src = null;
    protected $filePrependSecurityBlock = "<?php die('Execution denied!'); //";

    public function __construct() {

        date_default_timezone_set('Asia/Saigon');

        $this->calcDocRoot();

        if (!is_dir(FILE_CACHE_DIRECTORY)) {
            mkdir(FILE_CACHE_DIRECTORY);
        }

        if (!is_dir(FILE_CACHE_DIRECTORY)) {
            $this->cacheDirectory = sys_get_temp_dir();
        }

        $this->cacheDirectory = FILE_CACHE_DIRECTORY;
        touch($this->cacheDirectory . '/index.html');

        $this->cleanCache();

        $this->src = $this->getParam('src');

        $this->localImage = $this->getLocalImagePath($this->src);

        if (!$this->localImage) {
            return false;
        }

        $this->localImageMTime = filemtime($this->localImage);

        $this->cachefile = $this->cacheDirectory . '/' . md5($this->localImageMTime . $_SERVER ['QUERY_STRING']) . FILE_CACHE_SUFFIX;

        return true;
    }

    public static function ready() {
        $ImageResizer = new ImageResizer();
        if ($ImageResizer->tryBrowserCache()) {
            exit(0);
        }

        if (FILE_CACHE_ENABLED && $ImageResizer->tryServerCache()) {
            exit(0);
        }

        $ImageResizer->start();

        return true;
    }

    public function start() {
        $this->serveInternalImage();
        return true;
    }
    
    protected function serveInternalImage() {
        if (!$this->localImage) {
            return false;
        }
        
        $fileSize = filesize($this->localImage);
        if ($fileSize > MAX_FILE_SIZE) {
            return false;
        }
        
        if ($fileSize <= 0) {
            return false;
        }
        
        if ($this->processImageToCache($this->localImage)) {
            $this->serveCacheFile();
            return true;
        } else {
            return false;
        }
    }
    
    protected function serveCacheFile() {
        if (!is_file($this->cachefile)) {
            return false;
        }
        $fp = fopen($this->cachefile, 'rb');
        
        fseek($fp, strlen($this->filePrependSecurityBlock), SEEK_SET);
        $imgType = fread($fp, 3);
        fseek($fp, 3, SEEK_CUR);

        if (ftell($fp) != strlen($this->filePrependSecurityBlock) + 6) {
            @unlink($this->cachefile);
        }
        
        $imageDataSize = filesize($this->cachefile) - (strlen($this->filePrependSecurityBlock) + 6);
        $this->sendImageHeaders($imgType, $imageDataSize);
        $bytesSent = @fpassthru($fp);
        fclose($fp);
        if ($bytesSent > 0) {
            return true;
        }
        $content = file_get_contents($this->cachefile);
        if ($content != FALSE) {
            $content = substr($content, strlen($this->filePrependSecurityBlock) + 6);
            echo $content;
            return true;
        } else {
            return false;
        }
    }
    
    protected function sendImageHeaders($mimeType, $dataSize) {
        if (!preg_match('/^image\//i', $mimeType)) {
            $mimeType = 'image/' . $mimeType;
        }
        
        if (strtolower($mimeType) == 'image/jpg') {
            $mimeType = 'image/jpeg';
        }
        
        $gmdate_expires = gmdate('D, d M Y H:i:s', strtotime('now +10 days')) . ' GMT';
        $gmdate_modified = gmdate('D, d M Y H:i:s') . ' GMT';
        
        header('Content-Type: ' . $mimeType);
        header('Accept-Ranges: none');
        header('Last-Modified: ' . $gmdate_modified);
        header('Content-Length: ' . $dataSize);
        if (BROWSER_CACHE_DISABLE) {
            header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
            header("Pragma: no-cache");
            header('Expires: ' . gmdate('D, d M Y H:i:s', time()));
        } else {
            header('Cache-Control: max-age=' . BROWSER_CACHE_MAX_AGE . ', must-revalidate');
            header('Expires: ' . $gmdate_expires);
        }
        return true;
    }

    protected function tryServerCache() {
        if (file_exists($this->cachefile)) {

            if ($this->serveCacheFile()) {
                return true;
            } else {
                @unlink($this->cachefile);
                return true;
            }
        }
    }

    protected function tryBrowserCache() {
        if (BROWSER_CACHE_DISABLE) {
            return false;
        }
        if (!empty($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
            $mtime = false;

            if (!is_file($this->cachefile)) {
                return false;
            }

            if ($this->localImageMTime) {
                $mtime = $this->localImageMTime;
            } else if (is_file($this->cachefile)) {
                $mtime = filemtime($this->cachefile);
            }
            if (!$mtime) {
                return false;
            }

            $iftime = strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']);
            if ($iftime < 1) {
                return false;
            }
            if ($iftime < $mtime) {
                return false;
            } else {
                header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
                return true;
            }
        }
        return false;
    }

    protected function getLocalImagePath($src) {
        $src = ltrim($src, '/');
        if (!$this->docRoot) {
            $file = preg_replace('/^.*?([^\/\\\\]+)$/', '$1', $src);
            if (is_file($file)) {
                return $this->realpath($file);
            }
        }

        if (file_exists($this->docRoot . '/' . $src)) {
            $real = $this->realpath($this->docRoot . '/' . $src);
            if (stripos($real, $this->docRoot) === 0) {
                return $real;
            }
        }

        $absolute = $this->realpath('/' . $src);
        if ($absolute && file_exists($absolute)) {

            if (stripos($absolute, $this->docRoot) === 0) {
                return $absolute;
            }
        }

        $base = $this->docRoot;

        if (strstr($_SERVER['SCRIPT_FILENAME'], ':')) {
            $sub_directories = explode('\\', str_replace($this->docRoot, '', $_SERVER['SCRIPT_FILENAME']));
        } else {
            $sub_directories = explode('/', str_replace($this->docRoot, '', $_SERVER['SCRIPT_FILENAME']));
        }

        foreach ($sub_directories as $sub) {
            $base .= $sub . '/';
            if (file_exists($base . $src)) {
                $real = $this->realpath($base . $src);
                if (stripos($real, $this->realpath($this->docRoot)) === 0) {
                    return $real;
                }
            }
        }
        return false;
    }

    protected function realpath($path) {
        $remove_relatives = '/\w+\/\.\.\//';
        while (preg_match($remove_relatives, $path)) {
            $path = preg_replace($remove_relatives, '', $path);
        }

        return preg_match('#^\.\./|/\.\./#', $path) ? realpath($path) : $path;
    }

    protected function cleanCache() {
        if (FILE_CACHE_TIME_BETWEEN_CLEANS < 0) {
            return;
        }

        $lastCleanFile = $this->cacheDirectory . '/__mokova_cacheLastCleanTime.touch';

        if (!is_file($lastCleanFile)) {
            touch($lastCleanFile);
            return;
        }
        if (filemtime($lastCleanFile) < (time() - FILE_CACHE_TIME_BETWEEN_CLEANS)) {
            touch($lastCleanFile);
            $files = glob($this->cacheDirectory . '/*' . FILE_CACHE_SUFFIX);
            if ($files) {
                $timeAgo = time() - FILE_CACHE_MAX_FILE_AGE;
                foreach ($files as $file) {
                    if (@filemtime($file) < $timeAgo) {
                        @unlink($file);
                    }
                }
            }
            return true;
        }
        return false;
    }

    protected function calcDocRoot() {
        $docRoot = $_SERVER['DOCUMENT_ROOT'];
        /*
          if (!isset($docRoot)) {
          if (isset($_SERVER['SCRIPT_FILENAME'])) {
          $docRoot = str_replace('\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0 - strlen($_SERVER['PHP_SELF'])));
          }
          }
          if (!isset($docRoot)) {
          if (isset($_SERVER['PATH_TRANSLATED'])) {
          $docRoot = str_replace('\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0 - strlen($_SERVER['PHP_SELF'])));
          }
          }
          if ($docRoot && $_SERVER['DOCUMENT_ROOT'] != '/') {
          $docRoot = preg_replace('/\/$/', '', $docRoot);
          }
         * $docRoot không thay đổi khi chạy ở localhost
         */
        $this->docRoot = $docRoot;
    }

    protected function processImageToCache($source = '') {

        $w = $this->getParam('w', 100);
        $h = $this->getParam('h', 100);
        $zc = $this->getParam('zc', 2);
        $q = $this->getParam('q', 100);
        $a = $this->getParam('a', 'c');
        $f = $this->getParam('f', '4');
        $s = $this->getParam('s', 0);
        $cc = $this->getParam('cc', 'ffffff');
        $ct = $this->getParam('ct', 1);

        $image_info = getimagesize($source);

        $orig_type = $image_info[2];
        $mime_type = $image_info['mime'];

        if (preg_match('/^image\/(?:gif|jpg|jpeg|png)$/i', $mime_type)) {

            $image_filters = array(
                1 => array(IMG_FILTER_NEGATE, 0),
                2 => array(IMG_FILTER_GRAYSCALE, 0),
                3 => array(IMG_FILTER_BRIGHTNESS, 1),
                4 => array(IMG_FILTER_CONTRAST, 1),
                5 => array(IMG_FILTER_COLORIZE, 4),
                6 => array(IMG_FILTER_EDGEDETECT, 0),
                7 => array(IMG_FILTER_EMBOSS, 0),
                8 => array(IMG_FILTER_GAUSSIAN_BLUR, 0),
                9 => array(IMG_FILTER_SELECTIVE_BLUR, 0),
                10 => array(IMG_FILTER_MEAN_REMOVAL, 0),
                11 => array(IMG_FILTER_SMOOTH, 0),
            );

            $new_width = (int) abs($w);
            $new_height = (int) abs($h);
            $zoom_crop = (int) abs($zc);
            $quality = (int) abs($q);
            $align = $a;
            $filters = $f;
            $sharpen = (bool) $s;
            $canvas_color = $cc;
            $canvas_transparent = (bool) $ct;

            $valid = $this->validSizeImage($new_width, $new_height);

            $new_width = $valid['w'];
            $new_height = $valid['h'];

            $image = $this->openImage($mime_type, $source);

            $width = imagesx($image);
            $height = imagesy($image);
            $origin_x = 0;
            $origin_y = 0;

            if ($new_width && !$new_height) {
                $new_height = floor($height * ($new_width / $width));
            } else if ($new_height && !$new_width) {
                $new_width = floor($width * ($new_height / $height));
            }

            if ($zoom_crop == 3) {

                $final_height = $height * ($new_width / $width);

                if ($final_height > $new_height) {
                    $new_width = $width * ($new_height / $height);
                } else {
                    $new_height = $final_height;
                }
            }

            $canvas = imagecreatetruecolor($new_width, $new_height);
            imagealphablending($canvas, false);

            if (strlen($canvas_color) == 3) {
                $canvas_color = str_repeat(substr($canvas_color, 0, 1), 2) . str_repeat(substr($canvas_color, 1, 1), 2) . str_repeat(substr($canvas_color, 2, 1), 2);
            } else if (strlen($canvas_color) != 6) {
                $canvas_color = 'ffffff';
            }

            $canvas_color_R = hexdec(substr($canvas_color, 0, 2));
            $canvas_color_G = hexdec(substr($canvas_color, 2, 2));
            $canvas_color_B = hexdec(substr($canvas_color, 4, 2));

            if (preg_match('/^image\/png$/i', $mime_type) && $canvas_transparent) {
                $color = imagecolorallocatealpha($canvas, $canvas_color_R, $canvas_color_G, $canvas_color_B, 127);
            } else {
                $color = imagecolorallocatealpha($canvas, $canvas_color_R, $canvas_color_G, $canvas_color_B, 0);
            }

            imagefill($canvas, 0, 0, $color);


            if ($zoom_crop == 2) {

                $final_height = $height * ($new_width / $width);

                if ($final_height > $new_height) {
                    $origin_x = $new_width / 2;
                    $new_width = $width * ($new_height / $height);
                    $origin_x = round($origin_x - ($new_width / 2));
                } else {
                    $origin_y = $new_height / 2;
                    $new_height = $final_height;
                    $origin_y = round($origin_y - ($new_height / 2));
                }
            }

            imagesavealpha($canvas, true);

            if ($zoom_crop > 0) {

                $src_x = $src_y = 0;
                $src_w = $width;
                $src_h = $height;

                $cmp_x = $width / $new_width;
                $cmp_y = $height / $new_height;

                if ($cmp_x > $cmp_y) {

                    $src_w = round($width / $cmp_x * $cmp_y);
                    $src_x = round(($width - ($width / $cmp_x * $cmp_y)) / 2);
                } else if ($cmp_y > $cmp_x) {

                    $src_h = round($height / $cmp_y * $cmp_x);
                    $src_y = round(($height - ($height / $cmp_y * $cmp_x)) / 2);
                }

                if ($align) {
                    if (strpos($align, 't') !== false) {
                        $src_y = 0;
                    }
                    if (strpos($align, 'b') !== false) {
                        $src_y = $height - $src_h;
                    }
                    if (strpos($align, 'l') !== false) {
                        $src_x = 0;
                    }
                    if (strpos($align, 'r') !== false) {
                        $src_x = $width - $src_w;
                    }
                }

                imagecopyresampled($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);
            } else {
                imagecopyresampled($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            }

            if ($filters != '') {
                $filter_list = explode('|', $filters);
                foreach ($filter_list as $fl) {

                    $filter_settings = explode(',', $fl);
                    if (isset($image_filters[$filter_settings[0]])) {

                        for ($i = 0; $i < 4; $i ++) {
                            if (!isset($filter_settings[$i])) {
                                $filter_settings[$i] = null;
                            } else {
                                $filter_settings[$i] = (int) $filter_settings[$i];
                            }
                        }

                        switch ($image_filters[$filter_settings[0]][1]) {
                            case 1:
                                imagefilter($canvas, $image_filters[$filter_settings[0]][0], $filter_settings[1]);
                                break;
                            case 2:
                                imagefilter($canvas, $image_filters[$filter_settings[0]][0], $filter_settings[1], $filter_settings[2]);
                                break;
                            case 3:
                                imagefilter($canvas, $image_filters[$filter_settings[0]][0], $filter_settings[1], $filter_settings[2], $filter_settings[3]);
                                break;
                            case 4:
                                imagefilter($canvas, $image_filters[$filter_settings[0]][0], $filter_settings[1], $filter_settings[2], $filter_settings[3], $filter_settings[4]);
                                break;
                            default:
                                imagefilter($canvas, $image_filters[$filter_settings[0]][0]);
                                break;
                        }
                    }
                }
            }

            if ($sharpen) {
                $sharpenMatrix = array(
                    array(-1, -1, -1),
                    array(-1, 16, -1),
                    array(-1, -1, -1),
                );
                $divisor = 8;
                $offset = 0;
                imageconvolution($canvas, $sharpenMatrix, $divisor, $offset);
            }

            if ((IMAGETYPE_PNG == $orig_type || IMAGETYPE_GIF == $orig_type) && !imageistruecolor($image) && imagecolortransparent($image) > 0) {
                imagetruecolortopalette($canvas, false, imagecolorstotal($image));
            }

            $imgType = '';
            $upload = tempnam($this->cacheDirectory, 'mokova_temp_image_');

            if (preg_match('/^image\/(?:jpg|jpeg)$/i', $mime_type)) {
                $imgType = 'jpg';
                imagejpeg($canvas, $upload, $quality);
            } else if (preg_match('/^image\/png$/i', $mime_type)) {
                $imgType = 'png';
                imagepng($canvas, $upload, floor($quality * 0.09));
            } else if (preg_match('/^image\/gif$/i', $mime_type)) {
                $imgType = 'gif';
                imagegif($canvas, $upload);
            }

            $upload2 = tempnam($this->cacheDirectory, 'mokova_temp_image_');
            $context = stream_context_create();

            $fp = fopen($upload, 'r', 0, $context);
            file_put_contents($upload2, $this->filePrependSecurityBlock . $imgType . ' ?' . '>');
            file_put_contents($upload2, $fp, FILE_APPEND);
            fclose($fp);
            unlink($upload);

            $lockFile = $this->cachefile . '.lock';

            $fh = fopen($lockFile, 'w');

            if (flock($fh, LOCK_EX)) {
                @unlink($this->cachefile);
                rename($upload2, $this->cachefile);
                flock($fh, LOCK_UN);
                fclose($fh);
                unlink($lockFile);
            } else {
                fclose($fh);
                @unlink($lockFile);
                @unlink($upload2);
            }

            imagedestroy($canvas);
            imagedestroy($image);

            return true;
        }
    }

    protected function openImage($mime, $source) {
        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source);
                break;

            case 'image/png':
                $image = imagecreatefrompng($source);
                imagealphablending($image, true);
                imagesavealpha($image, true);
                break;

            case 'image/gif':
                $image = imagecreatefromgif($source);
                break;
        }

        return $image;
    }

    protected function validSizeImage($w, $h) {
        if ($w == 0 && $h == 0) {
            $w = DEFAULT_WIDTH;
            $h = DEFAULT_HEIGHT;
        }

        $w = min($w, MAX_WIDTH);
        $h = min($h, MAX_HEIGHT);
        return array('w' => $w, 'h' => $h);
    }

    protected function getParam($name, $default = '') {
        return isset($_GET[$name]) ? $_GET[$name] : $default;
    }

}
