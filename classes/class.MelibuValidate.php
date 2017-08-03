<?php

/**
 * Melibu Captcha
 *
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.4.9
 */
if (!class_exists('MELIBU_PLUGIN_VALIDATE_01')) {

    class MELIBU_PLUGIN_VALIDATE_01 {

        public function __construct() {

            if (!session_id()) {
                session_start();
            }
        }

        /**
         *  Subscribe Action coming AJAX data
         */
        public function val_action() {

            $return = '';

            if (isset($_POST)) { // If POST, then check
                
                $mpo = (string) filter_input(INPUT_POST, 'subscribe', FILTER_SANITIZE_STRING); // Subscribe ON/OFF
                $upo = (string) filter_input(INPUT_POST, 'upo', FILTER_SANITIZE_STRING); // Username ON/OFF
                $cpo = (string) filter_input(INPUT_POST, 'cpo', FILTER_SANITIZE_STRING); // Captcha ON/OFF
                $pass = (string) filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING); // Password ON/OFF

                $errors = array();

                if ($upo && is_string($upo) && $upo == 'on') { // If Username on, validate data
                    $user = (string) filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
                    $errors = $this->check_name($errors, $user);
                }

                if ($mpo && is_string($mpo) && $mpo == 'on') { // If Mail on, validate data
                    $mail = (string) filter_var(filter_input(INPUT_POST, 'mail'), FILTER_SANITIZE_EMAIL);
                    $errors = $this->check_mail($errors, $mail);
                }

                if ($cpo && is_string($cpo) && $cpo == 'on') { // If Captcha on, validate data
                    $captcha = (string) filter_input(INPUT_POST, 'captcha', FILTER_SANITIZE_STRING);
                    $errors = $this->check_cap($errors, $captcha);
                }

                if ($pass) { // If Password on, validate data
                    $passcheck = (string) filter_input(INPUT_POST, 'passcheck', FILTER_SANITIZE_STRING);
                    $errors = $this->check_pass($errors, $pass, $passcheck);
                }

                if ($errors) {
                    $return .= '<ul>';
                    foreach ($errors as $error) {
                        $return .= '<li>' . $error . '</li>';
                    }
                    $return .= '</ul>';
                } else {
                    $return = 'true';
                }

                return $return;
            }
        }

        /**
         * chekc name
         */
        public function check_name($errors, $user) {

            if ($user == '') {
                $errors[] = __('Please enter your Name', 'download-counter-button');
            } else {
                if (strlen($user) < 3) {
                    $errors[] = __('Please enter at least 3 Characters', 'download-counter-button');
                }
                if (!is_string($user)) {
                    $errors[] = __('Please enter an Name that have a string type', 'download-counter-button');
                }
            }

            return $errors;
        }

        /**
         * check mail
         */
        public function check_mail($errors, $mail) {

            if ($mail == '') {
                $errors[] = __('Please enter your E-Mail-Address', 'download-counter-button');
            } else {
                if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = __('Please enter a valid E-Mail-Address', 'download-counter-button');
                }
                if (!is_email($mail)) {
                    $errors[] = __('Please enter a valid E-Mail-Address', 'download-counter-button');
                }
                if (!$this->validateEmail($mail)) {
                    $errors[] = __('Please enter an E-Mail-Address that exists in world wide web', 'download-counter-button');
                }
                if (!is_string($mail)) {
                    $errors[] = __('Please enter an E-Mail-Address that have a string type', 'download-counter-button');
                }
            }

            return $errors;
        }

        /**
         * check password
         */
        public function check_pass($errors, $password, $passcheck) {
            global $MELIBU_PLUGIN_SECURE_01;
            if ($passcheck == '' OR $password == '') {
                $errors[] = __('Please enter the password', 'download-counter-button');
            } else {
                if ($passcheck != $MELIBU_PLUGIN_SECURE_01->get_mcrypt(array("password" => $password))) {
                    $errors[] = __('Please enter the correct password', 'download-counter-button');
                }
                if (!is_string($password)) {
                    $errors[] = __('Please enter an password that have a string type', 'download-counter-button');
                }
            }

            return $errors;
        }

        /**
         * check captcha
         */
        public function check_cap($errors, $captcha) {

            if ($captcha == '') {
                $errors[] = __('Please enter the captcha', 'download-counter-button');
            } else {
                if (isset($_SESSION['mb_captcha']) && $_SESSION['mb_captcha'] != $captcha) {
                    $errors[] = __('Please enter the correct captcha', 'download-counter-button');
                }
                if (!is_string($captcha)) {
                    $errors[] = __('Please enter an password that have a string type', 'download-counter-button');
                }
            }

            return $errors;
        }

        /**
         * Actual Captcha Value
         */
        public function captcha_actually() {

            if (isset($_SESSION['mb_captcha']) && $_SESSION['mb_captcha'] != '') {
                echo $_SESSION['mb_captcha'];
            }
        }

        /**
         * Captcha
         */
        public function captcha() {

            header("(anti-spam-content-type:) image/png");

            $enc_num = rand(0, 9999);
            $key_num = rand(0, 24);
            $hash_string = substr(md5($enc_num), $key_num, 5);

            $_SESSION['mb_captcha'] = $hash_string;

            # Verification image backgrounds
            $dir = '../../img/captcha/';

            $bgs = array($dir . 'cbg1.png',
                $dir . 'cbg2.png',
                $dir . 'cbg3.png',
                $dir . 'cbg4.png',
                $dir . 'cbg5.png',
                $dir . 'cbg6.png');

            $background = array_rand($bgs, 1);

            # Verification image variables
            $img_handle = imagecreatefrompng($bgs[$background]);
            $text_colour = imagecolorallocate($img_handle, 53, 66, 79);
            $font_size = 5;
            $rotate_img = rand(-15, 15);

            $size_array = getimagesize($bgs[$background]);
            $img_w = $size_array[0];
            $img_h = $size_array[1];
//
//            $horiz = round(( $img_w / 2 ) - ( ( strlen($hash_string) * imagefontwidth(5) ) / 2 ) + $rotate_img, 1);
//            $vert = round(( $img_h / 2 ) - ( imagefontheight($font_size) / 2 ));

            # Create the verification image
            imagettftext($img_handle, 22, rand(0, -4), 5, 30, $text_colour, "../../fonts/arial.ttf", $hash_string);
            imagepng($img_handle);

            # Destroy the image 
            imagedestroy($img_handle);
        }

        /**
         * Domain Available
         * @param type $domain
         * @return boolean
         */
        public function domainAvailible($domain) {

            $isValidDomain = true;
            $curlHandle = curl_init($domain);
            curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($curlHandle, CURLOPT_HEADER, true);
            curl_setopt($curlHandle, CURLOPT_NOBODY, true);
            curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
            $domainResponse = curl_exec($curlHandle);
            curl_close($curlHandle);
            if (!$domainResponse) {
                $isValidDomain = false;
            }
            return $isValidDomain;
        }

        /**
         * 
         * @param type $emailadress
         * @return boolean
         */
        public function validateEmail($emailadress) {

            $isValid = true;
            $atIndex = strrpos($emailadress, "@");
            if (is_bool($atIndex) && !$atIndex) {
                $isValid = false;
            } else {

                $domain = substr($emailadress, $atIndex + 1);
                $local = substr($emailadress, 0, $atIndex);

                // Laenge ermitteln E-Mail-Adresse und Domain.
                $localLen = strlen($local);
                $domainLen = strlen($domain);

                // Erlaubte E-Mail-Adressen Laenge 1 - 255.
                if ($localLen <= 0 || $localLen >= 255) {
                    $isValid = false;
                }
                // Erlaubte Domain lenge 1 - 255 Zeichen.
                elseif ($domainLen <= 0 || $domainLen >= 255) {
                    $isValid = false;
                }
                // Endet oder Startet die E-Mail-Adresse mit einem Punkt.
                elseif ($local[0] == '.' || $local[$localLen - 1] == '.') {
                    $isValid = false;
                }
                // Kommen in der E-Mail-Adresse 2 punkte vor ?
                elseif (preg_match('/\\.\\./', $local)) {
                    $isValid = false;
                }
                // Kommen in der E-Mail-Adresse 2 punkte vor ?
                elseif (preg_match('/\s/', $local)) {
                    $isValid = false;
                }
                // Kommen in der Domain unerlaubte Zeichen vor.
                elseif (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
                    $isValid = false;
                }
                // Kommen in der Domain 2 punkte vor.
                elseif (preg_match('/\\.\\./', $domain)) {
                    $isValid = false;
                }
                // Kommt in der Domain 1 punkte vor.
                elseif (!preg_match('/\\./', $domain)) {
                    $isValid = false;
                }
                // Kommt in der Domain ein leerzeichen vor.
                elseif (preg_match('/\s/', $domain)) {
                    $isValid = false;
                }
                // Kommen in der E-Mail-Adresse unerlaubte Zeichen vor.
                elseif (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\", "", $local))) {

                    // Wenn ja aktion
                    if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\", "", $local))) {
                        $isValid = false;
                    }
                }

                if ($this->domainAvailible($domain)) {

                    // Existiert fuer diese Domain DNS ein MX-Rekord oder ein A-Rekord
                    if ($isValid && !( checkdnsrr($domain, "MX") || checkdnsrr($domain, "A") )) {

                        $isValid = false;
                    }
                }
            }

            return $isValid;
        }

    }

    global $MELIBU_PLUGIN_VALIDATE_01;
    $MELIBU_PLUGIN_VALIDATE_01 = new MELIBU_PLUGIN_VALIDATE_01();
}
