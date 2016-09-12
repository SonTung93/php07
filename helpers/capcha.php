<?php

class capcha
{   
    public static $code = 'capcha-code';

    public static function getCode() {
        return $_SESSION[capcha::$code];
    }

    public static function setCapcha() {
        //echo '<img src="./helpers/captchaimg.php?rand='.rand().'   " id="captcha" ><a href="javascript: refreshCaptcha();" class="btn btn-default"><i class="fa fa-refresh"></i></a>';
        echo '<img src="'.ROOT.'/captcha?rand='.rand().'   " id="captcha" ><a href="javascript: refreshCaptcha();" class="btn btn-default btn-xs" style="vertical-align: bottom;"><i class="fa fa-refresh"></i></a>';
        echo "<script type='text/javascript'>";
        echo "function refreshCaptcha(){";
        echo "var img = document.images['captcha'];";
        echo 'img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;}';
        echo "</script>";
    }
    public static function clearCapcha() {
        unset($_SESSION[capcha::$code]);
    }
    public static function phpcaptcha($textColor,$backgroundColor,$imgWidth,$imgHeight,$noiceLines=0,$noiceDots=0,$noiceColor='#162453')
    {   
        /* Settings */
        $text=capcha::random();
        
        $font = './helpers/monofont.ttf';/* font */
        $textColor=capcha::hexToRGB($textColor);    
        $fontSize = $imgHeight * 0.75;
        
        $im = imagecreatetruecolor($imgWidth, $imgHeight);  
        $textColor = imagecolorallocate($im, $textColor['r'],$textColor['g'],$textColor['b']);          
        
        $backgroundColor = capcha::hexToRGB($backgroundColor);
        $backgroundColor = imagecolorallocate($im, $backgroundColor['r'],$backgroundColor['g'],$backgroundColor['b']);
                
        /* generating lines randomly in background of image */
        if($noiceLines>0){
        $noiceColor=capcha::hexToRGB($noiceColor);  
        $noiceColor = imagecolorallocate($im, $noiceColor['r'],$noiceColor['g'],$noiceColor['b']);
        for( $i=0; $i<$noiceLines; $i++ ) {             
            imageline($im, mt_rand(0,$imgWidth), mt_rand(0,$imgHeight),
            mt_rand(0,$imgWidth), mt_rand(0,$imgHeight), $noiceColor);
        }}              
                
        if($noiceDots>0){/* generating the dots randomly in background */
        for( $i=0; $i<$noiceDots; $i++ ) {
            imagefilledellipse($im, mt_rand(0,$imgWidth),
            mt_rand(0,$imgHeight), 3, 3, $textColor);
        }}      
        
        imagefill($im,0,0,$backgroundColor);    
        list($x, $y) = capcha::ImageTTFCenter($im, $text, $font, $fontSize);    
        imagettftext($im, $fontSize, 0, $x, $y, $textColor, $font, $text);      

        imagejpeg($im,NULL,75);/* Showing image */
        header('Content-Type: image/jpeg');/* defining the image type to be shown in browser widow */
        imagedestroy($im);/* Destroying image instance */
        $_SESSION[capcha::$code] = $text;/* set random text in session for captcha validation*/
    }
    
    /*for random string*/
    protected static function random($characters=6,$letters = '23456789bcdfghjkmnpqrstvwxyz'){
        $str='';
        for ($i=0; $i<$characters; $i++) { 
            $str .= substr($letters, mt_rand(0, strlen($letters)-1), 1);
        }
        return $str;
    }   
    
    /*function to convert hex value to rgb array*/
    protected  static function hexToRGB($colour)
    {
            if ( $colour[0] == '#' ) {
                    $colour = substr( $colour, 1 );
            }
            if ( strlen( $colour ) == 6 ) {
                    list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
            } elseif ( strlen( $colour ) == 3 ) {
                    list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
            } else {
                    return false;
            }
            $r = hexdec( $r );
            $g = hexdec( $g );
            $b = hexdec( $b );
            return array( 'r' => $r, 'g' => $g, 'b' => $b );
    }       
        
    /*function to get center position on image*/
    protected static function ImageTTFCenter($image, $text, $font, $size, $angle = 8) 
    {
        $xi = imagesx($image);
        $yi = imagesy($image);
        $box = imagettfbbox($size, $angle, $font, $text);
        $xr = abs(max($box[2], $box[4]));
        $yr = abs(max($box[5], $box[7]));
        $x = intval(($xi - $xr) / 2);
        $y = intval(($yi + $yr) / 2);
        return array($x, $y);   
    }
}
?>