<?php

    class flashmessage {

        public function __construct() {
            
        }

        public static $messagename = 'message';

        public static function setMessage($alert = '') {

            $_SESSION[flashmessage::$messagename] = $alert;
        }

        public static function displayMessage() {


            if (isset($_SESSION[flashmessage::$messagename])) {

                echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="fa fa-check"></i> Thông báo: <span>' . $_SESSION[flashmessage::$messagename] . '</span></h4></div>';

                unset($_SESSION[flashmessage::$messagename]);
            }
        }

        public static $messageerrorname = 'messageerror';

        public static function setMessageError($alert = '') {
            $_SESSION[flashmessage::$messageerrorname] = $alert;
        }

        public static function displayMessageError() {

            if (isset($_SESSION[flashmessage::$messageerrorname])) {

                echo '<div class="alert alert-danger " role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="fa fa-warning"></i> Thông báo: <span>' . $_SESSION[flashmessage::$messageerrorname] .'</span></h4></div>';
                unset($_SESSION[flashmessage::$messageerrorname]);
            }
        }

        public static function displayLoginMessageError() {

            if (isset($_SESSION[flashmessage::$messageerrorname])) {

                echo '<div class="alert alert-danger login" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><i class="fa fa-warning"></i> Thông báo</h4><p>' . $_SESSION[flashmessage::$messageerrorname] . '</p></div>';
                unset($_SESSION[flashmessage::$messageerrorname]);
            }
        }

        /*     * ** FRONT-END *** */

        public static $messageeclient = 'messageeclient';
        
        public static function setMessageErrorClient($alert = '') {
            $_SESSION[flashmessage::$messageerrorname] = $alert;
        }

        public static function displayLoginMessageErrorClient() {

            if (isset($_SESSION[flashmessage::$messageerrorname])) {

                echo '<div class="alert alert-danger">' . $_SESSION[flashmessage::$messageerrorname] . '</div>';
                unset($_SESSION[flashmessage::$messageerrorname]);
            }
        }

        public static function setMessageMainClient($alert = '') {
            $_SESSION[flashmessage::$messageeclient] = $alert;
        }

        public static function displayMessageMainClient() {

            if (isset($_SESSION[flashmessage::$messageeclient])) {
                echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Thông báo :</strong> '.$_SESSION[flashmessage::$messageeclient].'</div>';
                unset($_SESSION[flashmessage::$messageeclient]);
            }
        }

}

?>
