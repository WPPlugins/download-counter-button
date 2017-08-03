<?php

/**
 * MELIBU PLUGIN HELPER CLASS
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.7.5
 */
if (!class_exists('MELIBU_PLUGIN_SECURE_01')) {

    class MELIBU_PLUGIN_SECURE_01 {

        /**
         * 
         * @param type $rest
         */
        public function file_protect(array $rest) {

            $fname = dirname($rest['Path']) . "/.htaccess";
            if (file_exists($fname)) {
                $fhandle = fopen($fname, "a+");
                $content = '';
                if (file_exists($fname) && filesize($fname) > 0) {
                    $content = fread($fhandle, filesize($fname));
                }
                $saver = '
<Files ' . basename($rest['Path']) . '>
  order allow,deny
  Deny from all
</Files>
';
                $pos = strpos($content, $saver);
                if ($pos === false) {
                    $fhandle = fopen($fname, "a+");
                    fwrite($fhandle, $saver);
                }
                fclose($fhandle);
            }
        }

        /**
         * 
         * @param type $rest
         */
        public function remove_file_protect(array $rest) {
            if (file_exists(dirname($rest['Path']) . "/.htaccess")) {
                unlink(dirname($rest['Path']) . "/.htaccess");
            }
        }

        /**
         * 
         * @param type $atts
         * @return type
         */
        public function set_mcrypt(array $atts) {
            if (!empty($atts['password'])) {
                if (function_exists('mcrypt_get_iv_size')) {
                    $key = (isset($atts['key']) ? $atts['key'] : "0815");
                    $iv = mcrypt_create_iv(
                            mcrypt_get_iv_size(
                                    MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC
                            ), MCRYPT_DEV_URANDOM
                    );
                    $encrypted = base64_encode(
                            $iv .
                            mcrypt_encrypt(
                                    MCRYPT_RIJNDAEL_128, hash('sha256', $key, true), $atts['password'], MCRYPT_MODE_CBC, $iv
                            )
                    );
                } else {
                    $encrypted = base64_encode($atts['password']);
                }
            } else {
                $encrypted = '';
            }
            return $encrypted; // ENCRYPT MCRYPT
        }

        /**
         * 
         * @param type $atts
         * @return type
         */
        public function get_mcrypt(array $atts) {

            if (!empty($atts['password'])) {
                if (function_exists('mcrypt_get_iv_size')) {
                    $key = (isset($atts['key']) ? $atts['key'] : "0815");
                    $data = base64_decode($atts['password']);
                    $iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));
                    $decrypted = rtrim(
                            mcrypt_decrypt(
                                    MCRYPT_RIJNDAEL_128, hash('sha256', $key, true), substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)), MCRYPT_MODE_CBC, $iv
                            ), "\0"
                    );
                } else {
                    $decrypted = base64_decode($atts['password']);
                }
            } else {
                $decrypted = '';
            }
            return $decrypted; // DECRYPT MCRYPT
        }

    }

    global $MELIBU_PLUGIN_SECURE_01;
    $MELIBU_PLUGIN_SECURE_01 = new MELIBU_PLUGIN_SECURE_01();
}
