<?php 
	class sys_common {
		public function __construc(){
			
		}

		public function redirectUrl($url = '', $type = 1, $noRoot = 0) {
            if ($noRoot > 0) {
                if ($type == 1) {
                    header('Location: ' . $url);
                    exit;
                } else {
                    echo '<script>window.location.href="' . $url . '"</script>';
                    exit;
                }
            } else {
                if ($type == 1) {
                    header('Location: ' . ROOT . '/' . $url);
                    exit;
                } else {
                    echo '<script>window.location.href="' . ROOT . '/' . $url . '"</script>';
                    exit;
                }
            }
        }
        
        public function createTypeUrl($type = 0, $str = '', $id = 0, $char = '-') {
            $unicode = array(
                'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|A',
                'd' => 'đ|Đ',
                'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|E|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
                'i' => 'í|ì|ỉ|ĩ|ị|I|Í|Ì|Ỉ|Ĩ|Ị',
                'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|O|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
                'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|U|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
                'y' => 'ý|ỳ|ỷ|ỹ|ỵ|Y|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
                '-' => '\&|\:|\;|\.|\.\.|\.\.\.|\=|\+|\_|\-\-|\-\-\-|\#'
            );

            foreach ($unicode as $nonUnicode => $uni) {
                $str = preg_replace("/($uni)/i", $nonUnicode, $str);
            }
            $str = str_replace(' ', $char, $str);

            $str = str_replace('---', $char, $str);

            $str = str_replace('--', $char, $str);

            $str = strtolower($str);

            switch ($type) {
                case 0:
                    return '/category/' . $str . '_' . $id;
                    break;
                case 1:
                    return '/bai-viet/' . $str . '_' . $id;
                    break;
                case 3:
                    return '/tin-tuc/' . $str . '_' . $id;
                    break;
            }
        }
        public function str_Convert_VnEn($str, $dis = '-') {
            $unicode = array(
                'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
                'd' => 'đ',
                'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
                'i' => 'í|ì|ỉ|ĩ|ị',
                'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
                'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
                'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
                'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
                'D' => 'Đ',
                'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
                'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
                'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
                'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
                'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            );

            foreach ($unicode as $nonUnicode => $uni) {
                $str = preg_replace("/($uni)/i", $nonUnicode, $str);
            }
            $str = str_replace(' ', $dis, $str);
            return $str;
        }
        
        public function resizeImage($file, $width = 1000, $folder = '') {

            $path = '../upload';
            $image_name = '';

            if (!file_exists($path . '/Images')) {
                $oldmask = umask(0);
                mkdir($path . '/Images', 0777, true);
                umask($oldmask);
                $path .= '/Images';
            } else {
                $path .= '/Images';
            }

            if (!file_exists($path . '/' . $folder)) {
                $oldmask = umask(0);
                mkdir($path . '/' . $folder, 0777, true);
                umask($oldmask);
                $path .= '/' . $folder;
            } else {
                $path .= '/' . $folder;
            }

            if (!file_exists($path . '/' . date('Y'))) {
                $oldmask = umask(0);
                mkdir($path . '/' . date('Y'), 0777, true);
                umask($oldmask);
                $path .= '/' . date('Y');
                $image_name .= date('Y');
            } else {
                $path .= '/' . date('Y');
                $image_name .= date('Y');
            }

            if (!file_exists($path . '/' . date('m'))) {
                $oldmask = umask(0);
                mkdir($path . '/' . date('m'), 0777, true);
                umask($oldmask);
                $path .= '/' . date('m');
                $image_name .= '/' . date('m');
            } else {
                $path .= '/' . date('m');
                $image_name .= '/' . date('m');
            }

            if (!file_exists($path . '/' . date('d'))) {
                $oldmask = umask(0);
                mkdir($path . '/' . date('d'), 0777, true);
                umask($oldmask);
                $path .= '/' . date('d');
                $image_name .= '/' . date('d');
            } else {
                $path .= '/' . date('d');
                $image_name .= '/' . date('d');
            }

            $path .= '/';

            $temp = explode('.', $file['name']);

            $image_name .= '/' . $temp[0] . '_' . substr(md5($temp[0] . date('YmdHis')), 0, 8) . '.' . $temp[1];

            $path = $path . basename($image_name);

            $type = $this->isTrueTypeImage($file);

            $image_origin = '';

            switch ($type) {
                case 'image/gif':
                    $image_origin = imagecreatefromgif($file['tmp_name']);

                    $photoX = ImagesX($image_origin);
                    $photoY = ImagesY($image_origin);

                    if ($photoX > $width) {
                        $new_width = $width;
                        $new_height = round($width * $photoY / $photoX);
                    } else {
                        $new_width = $photoX;
                        $new_height = $photoY;
                    }

                    $image_resize = imagecreatetruecolor($new_width, $new_height);

                    /* transparent */
                    imagealphablending($image_resize, false);
                    imagesavealpha($image_resize, true);
                    $transparent = imagecolorallocatealpha($image_resize, 255, 255, 255, 127);
                    imagefilledrectangle($image_resize, 0, 0, $new_width, $new_height, $transparent);

                    imagecopyresampled($image_resize, $image_origin, 0, 0, 0, 0, $new_width, $new_height, $photoX, $photoY);
                    imagegif($image_resize, $path);

                    imagedestroy($image_origin);
                    imagedestroy($image_resize);
                    break;
                case 'image/jpeg':

                    $image_origin = imagecreatefromjpeg($file['tmp_name']);

                    $photoX = ImagesX($image_origin);
                    $photoY = ImagesY($image_origin);

                    if ($photoX > $width) {
                        $new_width = $width;
                        $new_height = round($width * $photoY / $photoX);
                    } else {
                        $new_width = $photoX;
                        $new_height = $photoY;
                    }

                    $image_resize = imagecreatetruecolor($new_width, $new_height);

                    imagecopyresampled($image_resize, $image_origin, 0, 0, 0, 0, $new_width, $new_height, $photoX, $photoY);
                    imagejpeg($image_resize, $path, 100);

                    imagedestroy($image_origin);
                    imagedestroy($image_resize);
                    break;
                case 'image/png':

                    $image_origin = imagecreatefrompng($file['tmp_name']);

                    $photoX = ImagesX($image_origin);
                    $photoY = ImagesY($image_origin);

                    if ($photoX > $width) {
                        $new_width = $width;
                        $new_height = round($width * $photoY / $photoX);
                    } else {
                        $new_width = $photoX;
                        $new_height = $photoY;
                    }

                    $image_resize = imagecreatetruecolor($new_width, $new_height);

                    /* transparent */
                    imagealphablending($image_resize, false);
                    imagesavealpha($image_resize, true);
                    $transparent = imagecolorallocatealpha($image_resize, 255, 255, 255, 127);
                    imagefilledrectangle($image_resize, 0, 0, $new_width, $new_height, $transparent);

                    imagecopyresampled($image_resize, $image_origin, 0, 0, 0, 0, $new_width, $new_height, $photoX, $photoY);
                    imagepng($image_resize, $path, 9);

                    imagedestroy($image_origin);
                    imagedestroy($image_resize);
                    break;
                case 'image/bmp':
                    $image_origin = imagecreatefromwbmp($file['tmp_name']);

                    $photoX = ImagesX($image_origin);
                    $photoY = ImagesY($image_origin);

                    if ($photoX > $width) {
                        $new_width = $width;
                        $new_height = round($width * $photoY / $photoX);
                    } else {
                        $new_width = $photoX;
                        $new_height = $photoY;
                    }

                    $image_resize = imagecreatetruecolor($new_width, $new_height);

                    imagecopyresampled($image_resize, $image_origin, 0, 0, 0, 0, $new_width, $new_height, $photoX, $photoY);
                    image2wbmp($image_resize, $path);

                    imagedestroy($image_origin);
                    imagedestroy($image_resize);
                    break;
            }

            return $image_name;
        }
        public function isTrueTypeImage($file) {
            $file_type = $file['type'];
            $list_type_allow = array('image/gif', 'image/jpeg', 'image/png', 'image/bmp');

            if (in_array($file_type, $list_type_allow)) {
                return $file_type;
            }
            return '';
        }
        public function isTrueTypeVideo($file) {
            $file_type = $file['type'];
            $list_type_allow = array("video/webm", "video/mp4", "video/ogv");

            if (in_array($file_type, $list_type_allow)) {
                return $file_type;
            }
            return '';
        }

        public function isTrueSizeImage($file) {
            $file_size = $file['size'];
            if ($file_size <= 3072000) {
                return $file_size;
            }
            return '';
        }

        public function convertListImagesToImage($files) {

            $image_list = array();

            foreach ($files['name'] as $key => $value) {

                $image_temp = array(
                    'name' => $value,
                    'type' => $files['type'][$key],
                    'tmp_name' => $files['tmp_name'][$key],
                    'error' => $files['error'][$key],
                    'size' => $files['size'][$key]
                );

                array_push($image_list, $image_temp);
            }

            return $image_list;
        }

        public function move_file($file, $folder) {
            $path = '../upload';
            $file_name = '';

            if (!file_exists($path . '/Images')) {
                $oldmask = umask(0);
                mkdir($path . '/Images', 0777, true);
                umask($oldmask);
                $path .= '/Images';
            } else {
                $path .= '/Images';
            }

            if (!file_exists($path . '/' . $folder)) {
                $oldmask = umask(0);
                mkdir($path . '/' . $folder, 0777, true);
                umask($oldmask);
                $path .= '/' . $folder;
            } else {
                $path .= '/' . $folder;
            }

            if (!file_exists($path . '/' . date('Y'))) {
                $oldmask = umask(0);
                mkdir($path . '/' . date('Y'), 0777, true);
                umask($oldmask);
                $path .= '/' . date('Y');
                $file_name .= date('Y');
            } else {
                $path .= '/' . date('Y');
                $file_name .= date('Y');
            }

            if (!file_exists($path . '/' . date('m'))) {
                $oldmask = umask(0);
                mkdir($path . '/' . date('m'), 0777, true);
                umask($oldmask);
                $path .= '/' . date('m');
                $file_name .= '/' . date('m');
            } else {
                $path .= '/' . date('m');
                $file_name .= '/' . date('m');
            }

            if (!file_exists($path . '/' . date('d'))) {
                $oldmask = umask(0);
                mkdir($path . '/' . date('d'), 0777, true);
                umask($oldmask);
                $path .= '/' . date('d');
                $file_name .= '/' . date('d');
            } else {
                $path .= '/' . date('d');
                $file_name .= '/' . date('d');
            }

            $path .= '/';

            $temp = explode('.', $file['name']);

            $file_name .= '/' . substr(md5($temp[0] . time()), 0, 7) . '.' . end($temp);

            $path = $path . basename($file_name);

            move_uploaded_file($file['tmp_name'], $path);

            return $file_name;
        }

        public function upload_file_attachment($file, $folder) {
            $path = '../upload';
            $file_name = '';

            if (!file_exists($path . '/Files')) {
                $oldmask = umask(0);
                mkdir($path . '/Files', 0777, true);
                umask($oldmask);
                $path .= '/Files';
            } else {
                $path .= '/Files';
            }

            if (!file_exists($path . '/' . $folder)) {
                $oldmask = umask(0);
                mkdir($path . '/' . $folder, 0777, true);
                umask($oldmask);
                $path .= '/' . $folder;
            } else {
                $path .= '/' . $folder;
            }

            if (!file_exists($path . '/' . date('Y'))) {
                $oldmask = umask(0);
                mkdir($path . '/' . date('Y'), 0777, true);
                umask($oldmask);
                $path .= '/' . date('Y');
                $file_name .= date('Y');
            } else {
                $path .= '/' . date('Y');
                $file_name .= date('Y');
            }

            if (!file_exists($path . '/' . date('m'))) {
                $oldmask = umask(0);
                mkdir($path . '/' . date('m'), 0777, true);
                umask($oldmask);
                $path .= '/' . date('m');
                $file_name .= '/' . date('m');
            } else {
                $path .= '/' . date('m');
                $file_name .= '/' . date('m');
            }

            if (!file_exists($path . '/' . date('d'))) {
                $oldmask = umask(0);
                mkdir($path . '/' . date('d'), 0777, true);
                umask($oldmask);
                $path .= '/' . date('d');
                $file_name .= '/' . date('d');
            } else {
                $path .= '/' . date('d');
                $file_name .= '/' . date('d');
            }

            $path .= '/';

            $temp = explode('.', $file['name']);

            $file_name .= '/' . $this->str_Convert_VnEn($temp[0]) . '_' . substr(md5($temp[0].time()), 0, 5) . '.' . end($temp);

            $path = $path . basename($file_name);

            move_uploaded_file($file['tmp_name'], $path);

            return $file_name;
        }


        public $listMenuPosition = array(0 => 'Menu trên', 1 => 'Menu chính',2 => 'Menu duới');
        public $listMenuStatus = array(0 => 'Ẩn', 1 => 'Hiện');
        public $listUserStatus = array(0 => 'Khóa', 1 => 'Hoạt động');
        public $listFeaturedCategory = array(0 => 'Bình thường', 1 => 'Nổi bật');
        public $listCategoryStatus = array(0 => 'Ẩn', 1 => 'Hiện');
        public $listArticleStatus = array(0 => 'Ẩn', 1 => 'Hiện');
        public $listArticleOnlineStatus = array(0 => 'Ẩn', 1 => 'Hiện');
        public $listArticleFeatured = array(0 => 'Bình thường', 1 => 'Nổi bật');
        public $listProductStatus = array(0 => 'Ẩn', 1 => 'Hiện');
        public $listProductFeatured = array(0 => 'Bình thường', 1 => 'Nổi bật');
        public $listBannerStatus = array(0 => 'Ẩn', 1 => 'Hiện');
        public $listOrderStatus = array(0 => 'Đang thực hiện', 1 => 'Xong');
        public $listTransactionStatus = array(0 => 'Chưa Thanh toán', 1 => 'Đã thanh toán');
        public $listPayment = array(0 => 'Thanh toán khi giao hàng', 1 => 'Chuyển khoản');
        public $listAttributeStatus = array(0 => 'Ẩn', 1 => 'Hiện');
        public $listProductAttributeStatus = array(0 => 'Ẩn', 1 => 'Hiện');
        public $listProductRatingStatus = array(0 => 'Ẩn', 1 => 'Hiện');
        public $listBannerPosition = array(0 => 'Slider trên', 1 => 'Quảng cáo',2=>'Slider dưới');
        public function getBannerPosition($position) {
            return $this->listBannerPosition[$position];
        }
        public function getProductRatingStatus($status) {
            return $this->listProductRatingStatus[$status];
        }
        public function getProductAttributeStatus($status) {
            return $this->listProductAttributeStatus[$status];
        }
        public function getAttributeStatus($status) {
            return $this->listAttributeStatus[$status];
        }
        public function getPayment($status) {
            return $this->listPayment[$status];
        }
        public function getTransactionStatus($status) {
            return $this->listTransactionStatus[$status];
        }
         public function getOrderStatus($status) {
            return $this->listOrderStatus[$status];
        }
        public function getBannerStatus($status) {
            return $this->listBannerStatus[$status];
        }
        public function getFeaturedCategory($featured) {
            return $this->listFeaturedCategory[$featured];
        }
        public function getFeaturedProduct($featured) {
            return $this->listFeaturedCategory[$featured];
        }
        public function getCategoryStatus($status) {
            return $this->listProductFeatured[$status];
        }
        public function getArticleStatus($status) {
            return $this->listArticleStatus[$status];
        }
        public function getArticleOnlineStatus($status) {
            return $this->listArticleOnlineStatus[$status];
        }
        public function getArticleFeatured($featured) {
            return $this->listArticleFeatured[$featured];
        }
        public function getUserStatus($status) {
            return $this->listUserStatus[$status];
        }
        public function getProductStatus($status) {
            return $this->listProductStatus[$status];
        }
	}
?>