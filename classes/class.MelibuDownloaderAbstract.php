<?php

/**
 * MELIBU DOWNLOADER
 *
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.4.9
 */
if (!class_exists('MELIBU_PLUGIN_DOWNLOADER_ABSTRACT')) {

    abstract class MELIBU_PLUGIN_DOWNLOADER_ABSTRACT {

                /**
         * 
         * @param type $url
         * @return type
         */
        public function sanitize_url($url) {
            
            return (string) trim(strip_tags(htmlentities(urldecode(filter_input(INPUT_POST, $url, FILTER_SANITIZE_URL)), ENT_QUOTES, "UTF-8")));
        }
        /**
         * 
         * @param type $string
         * @return type
         */
        public function sanitize_str($string) {
            
            return (string) trim(strip_tags(htmlentities(urldecode(filter_input(INPUT_POST, $string, FILTER_SANITIZE_STRING)), ENT_QUOTES, "UTF-8")));
        }
        /**
         * 
         * @param type $integer
         * @return type
         */
        public function sanitize_int($integer) {
            
            return (string) trim(strip_tags(htmlentities(urldecode(filter_input(INPUT_POST, $integer, FILTER_SANITIZE_NUMBER_INT)), ENT_QUOTES, "UTF-8")));
        }
        /**
         * 
         * @param type $email
         * @return type
         */
        public function sanitize_mail($email) {
            
            return (string) trim(strip_tags(htmlentities(urldecode(filter_input(INPUT_POST, $email, FILTER_SANITIZE_EMAIL)), ENT_QUOTES, "UTF-8")));
        }
        
        /**
         * Get selected URL data
         * 
         * @global type $wpdb
         * @param type $url
         * @param type $instance
         * @return type
         */
        protected function select_url($url, $instance) {

            global $wpdb;
            $this->WP_DB = $wpdb;
            $melibu_dcb = $this->WP_DB->prefix . "melibu_dcb";
            $result = $this->WP_DB->get_results("SELECT * FROM " . $melibu_dcb . " WHERE url='" . esc_sql($url) . "' AND instance='" . esc_sql($instance) . "'");
            if ($result) {
                return $result;
            }
        }

        /**
         * GET PATH
         * @param type $url
         * @param type $absolutepath
         * @return string
         */
        protected function parse_url_to_path($url, $absolutepath) {

            $arr = parse_url($url);
            $thinpart = str_replace(filter_input(INPUT_SERVER, "DOCUMENT_ROOT"), '', $absolutepath);
            $thinparter = str_replace($thinpart, '', $absolutepath);
            if ($thinpart == $absolutepath) {
                $fullfilepath = '/' . trim($absolutepath, '/') . $arr['path'];
            } else {
                $fullfilepath = $thinparter . $arr['path'];
            }
            return $fullfilepath;
        }

        /**
         * DATETIME
         * @return type
         */
        protected function get_datetime() {

            return strtotime(get_date_from_gmt(date('Y-m-d H:i:s', time()), get_option('date_format') . ' ' . get_option('time_format')));
        }

        /**
         * FILESIZE
         * @param type $filepath
         * @return type
         */
        protected function get_size_by_path($filepath) {

            $get_size = filesize($filepath); // get filesize 2134124000930
            $size = $this->HELPER->get_real_file_size($get_size); // get realsize 2.3MB
            return $size;
        }

        /**
         * FILESIZE
         * @param type $fileurl
         * @return type
         */
        protected function get_size_by_url($fileurl) {

            $filecontent = file_get_contents($fileurl);
            $get_size = filesize($filecontent); // get filesize 2134124000930
            $size = $this->HELPER->get_real_file_size($get_size); // get realsize 2.3MB
            return $size;
        }

        /**
         * FILETYPE with path
         * @param type $filepath
         * @return type
         */
        protected function get_type_by_path($filepath) {

            $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
            $type = finfo_file($finfo, $filepath);
            finfo_close($finfo);
            return $type;
        }

        /**
         * FILETYPE with url
         * @param type $fileurl
         * @return type
         */
        protected function get_type_by_url($fileurl) {

            $filecontent = file_get_contents($fileurl);
            $file_info = new finfo(FILEINFO_MIME_TYPE);
            $type = $file_info->buffer($filecontent);
            return $type;
        }

        /**
         * This is the JS/AJAX modal
         * 
         */
        public function modal() {

            global $MELIBU_PLUGIN_OPTIONS_01;
            $melibu_plugin_dcb_settings = $MELIBU_PLUGIN_OPTIONS_01->settings();
            $melibu_plugin_dcb_modal = $MELIBU_PLUGIN_OPTIONS_01->modal();
            require_once MELIBU_PLUGIN_PATH_01 . 'tpl/modal.php';
            return;
        }

        /**
         * MODAL
         */
        public function modal_non_js($melibu_plugin_dcb_rest, $melibu_plugin_dcb_return) {

            global $MELIBU_PLUGIN_OPTIONS_01;
            $melibu_plugin_dcb_settings = $MELIBU_PLUGIN_OPTIONS_01->settings();
            $melibu_plugin_dcb_modal = $MELIBU_PLUGIN_OPTIONS_01->modal();
            $melibu_plugin_dcb_modal_mode = 'nonjs';
            if ($melibu_plugin_dcb_settings['modal'] == 'on' OR $melibu_plugin_dcb_settings['captcha'] == 'on' OR $melibu_plugin_dcb_settings['subscribe'] == 'on' OR $melibu_plugin_dcb_rest['Pass'] != '') {
                require_once MELIBU_PLUGIN_PATH_01 . 'tpl/modal.php';
            }
            return;
        }

        /**
         * URL - extern / intern
         */
        public function check_ext_url($url) {

            $return = false;
            $urlPar = parse_url($url);
            $urlExt = $urlPar["scheme"] . '://' . $urlPar["host"];
            $pos = strpos(get_bloginfo('url'), $urlExt);
            if ($pos !== false) {
                $return = true;
            }

            return $return;
        }

    }

}