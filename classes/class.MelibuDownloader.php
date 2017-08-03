<?php

require_once 'class.MelibuDownloaderAbstract.php';

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
if (!class_exists('MELIBU_PLUGIN_DOWNLOADER_01')) {

    class MELIBU_PLUGIN_DOWNLOADER_01 extends MELIBU_PLUGIN_DOWNLOADER_ABSTRACT {

        protected $HELPER = '';
        protected $WP_DB = '';

        /**
         * Constructor
         */
        public function __construct() {

            // Need Session ?
            if (!session_id()) {
                session_start();
            }
            global $melibuPluginHelper;
            $this->HELPER = $melibuPluginHelper;
        }
        
        /**
         * Handle the action for count without JS
         * POST and GET
         * @global type $wpdb
         */
        public function action_handler() {

            $getArr = array(); // Collector

            /**
             * POST
             */
            $post = filter_input(INPUT_POST, 'mbcountdown');
            if (isset($post) && $post == '1') {
                $getArr['URL'] = $this->sanitize_url('url');
                $getArr['Btn'] = $this->sanitize_str('btn');
                $getArr['Pass'] = $this->sanitize_str('pass');
                $getArr['Atagseo'] = $this->sanitize_str('rel');
                $getArr['Type'] = $this->sanitize_str('type');
                $getArr['Size'] = $this->sanitize_str('size');
                $getArr['Instance'] = $this->sanitize_int('ins');
                $getArr['Subscribe'] = $this->sanitize_str('subscribe');
                $getArr['User'] = $this->sanitize_str('user');
                $getArr['Mail'] = $this->sanitize_mail('mail');
                $this->count_non_js($getArr);
            }

            /**
             * GET
             */
            $get = filter_input(INPUT_GET, 'mbcountdown');
            if (isset($get) && $get == '1') {
                $getArr['URL'] = $this->sanitize_url('url');
                $getArr['Btn'] = $this->sanitize_str('btn');
                $getArr['Pass'] = $this->sanitize_str('pass');
                $getArr['Atagseo'] = $this->sanitize_str('rel');
                $getArr['Type'] = $this->sanitize_str('type');
                $getArr['Size'] = $this->sanitize_str('size');
                $getArr['Instance'] = $this->sanitize_int('ins');
                $this->count_non_js($getArr);
            }
        }

        /**
         * This part counts non JS/AJAX with get or post
         * @global type $wpdb
         * @param array $getArr
         */
        public function count_non_js($getArr) {

            $getArr['Count'] = 0; // count here the new, for not manipulating the count stats
            if (isset($getArr['URL']) && !empty($getArr['URL']) && isset($getArr['Instance']) && !empty($getArr['Instance'])) {
                $urlResult = $this->select_url($getArr['URL'], $getArr['Instance']); // Get result for this URL
                if ($urlResult) {
                    $getArr['Count'] = (int) $urlResult[0]->count; // Get Count
                    $getArr['Count'] ++; // Increment one more
                    $this->update_non_js($getArr);
                } else {
                    $getArr['Count'] ++; // Increment one more
                    $this->insert_non_js($getArr);
                }
            }
            if (isset($getArr['Subscribe']) && $getArr['Subscribe'] == 'on') { // If Username OR Mail ON
                $this->subscribe($getArr);
            }
            $load = MELIBU_PLUGIN_URL_01 . "functions/count/download.php?durl=" . urlencode($getArr['URL']) . '&amp;dtp=' . $getArr['Type'] . '&amp;dabp=' . ABSPATH;
            $this->HELPER->redirect_URL($load);
        }

        /**
         * INSERT
         * @global type $wpdb
         * @param type $getArr
         */
        protected function insert_non_js($getArr) {

            global $wpdb;
            $this->WP_DB = $wpdb;
            $melibu_dcb = $this->WP_DB->prefix . "melibu_dcb";
            $this->WP_DB->insert($melibu_dcb, array(
                'url' => $getArr['URL'],
                'name' => basename($getArr['URL']),
                'count' => $getArr['Count'],
                'instance' => $getArr['Instance'],
                'type' => $getArr['Type'],
                'size' => $getArr['Size'],
                'time' => $this->get_datetime(),
                'btn' => $getArr['Btn'],
                'atagseo' => $getArr['Atagseo'],
                'pass' => $getArr['Pass'])
            );
        }

        /**
         * UPDATE
         * @global type $wpdb
         * @param type $getArr
         */
        protected function update_non_js($getArr) {

            global $wpdb;
            $this->WP_DB = $wpdb;
            $melibu_dcb = $this->WP_DB->prefix . "melibu_dcb";
            $this->WP_DB->update($melibu_dcb, array(
                'count' => $getArr['Count'],
                'instance' => $getArr['Instance'],
                'type' => $getArr['Type'],
                'size' => $getArr['Size'],
                'time' => $this->get_datetime(),
                'btn' => $getArr['Btn'],
                'atagseo' => $getArr['Atagseo'],
                'pass' => $getArr['Pass']), array('url' => $getArr['URL'], 'instance' => $getArr['Instance'])
            );
        }

        /**
         * This count with AJAX
         * @global type $wpdb
         */
        public function count() {

            $arr = array();
            $arr['Count'] = 0; // count here the new, for not manipulating the count stats
            if (isset($_POST) && !empty($_POST)) {
                $arr['URL'] = $this->sanitize_url('url');
                $arr['Btn'] = $this->sanitize_str('btn');
                $arr['Pass'] = $this->sanitize_str('pass');
                $arr['Atagseo'] = $this->sanitize_str('rel');
                $arr['Type'] = $this->sanitize_str('type');
                $arr['Size'] = $this->sanitize_str('size');
                $arr['Instance'] = $this->sanitize_int('ins');
                $arr['Subscribe'] = $this->sanitize_str('subscribe');
                $arr['User'] = $this->sanitize_str('user');
                $arr['Mail'] = $this->sanitize_mail('mail');
                $result = $this->select_url($arr['URL'], $arr['Instance']); // Get counts from URL and instance
                if ($result) { // Is result
                    $arr['Count'] = (int) $result[0]->count; // Get Count
                    $arr['Count'] ++; // Increment one more
                    $this->update($arr);
                } else {
                    $arr['Count'] ++; // Increment one more
                    $this->insert($arr);
                }
                $this->subscribe($arr);
            }
            echo $arr['Count'];
        }

        /**
         * INSERT
         * @global type $wpdb
         * @param type $getArr
         */
        protected function insert($getArr) {

            global $wpdb;
            $this->WP_DB = $wpdb;
            $melibu_dcb = $this->WP_DB->prefix . "melibu_dcb";
            $this->WP_DB->insert($melibu_dcb, array(
                'url' => $getArr['URL'],
                'name' => basename($getArr['URL']),
                'count' => $getArr['Count'],
                'instance' => $getArr['Instance'],
                'type' => $getArr['Type'],
                'size' => $getArr['Size'],
                'time' => $this->get_datetime(),
                'btn' => $getArr['Btn'],
                'atagseo' => $getArr['Atagseo'],
                'pass' => $getArr['Pass'])
            );
        }

        /**
         * UPDATE
         * @global type $wpdb
         * @param type $getArr
         */
        protected function update($getArr) {

            global $wpdb;
            $this->WP_DB = $wpdb;
            $melibu_dcb = $this->WP_DB->prefix . "melibu_dcb";
            $this->WP_DB->update($melibu_dcb, array(
                'count' => $getArr['Count'],
                'instance' => $getArr['Instance'],
                'type' => $getArr['Type'],
                'size' => $getArr['Size'],
                'time' => $this->get_datetime(),
                'btn' => $getArr['Btn'],
                'atagseo' => $getArr['Atagseo'],
                'pass' => $getArr['Pass']), array('url' => $getArr['URL'], 'instance' => $getArr['Instance'])
            );
        }

        /**
         * SUBSCRIBE
         * @global type $wpdb
         * @param type $getArr
         */
        protected function subscribe($getArr) {

            global $wpdb;
            $this->WP_DB = $wpdb;
            if ($getArr['Subscribe'] == 'on') {
                $melibu_dcb_sub = $this->WP_DB->prefix . "melibu_dcb_sub";
                $this->WP_DB->insert($melibu_dcb_sub, array(
                    'user' => $getArr['User'],
                    'mail' => $getArr['Mail'],
                    'name' => basename($getArr['URL']),
                    'url' => $getArr['URL'],
                    'time' => $this->get_datetime())
                );
            }
        }

        /**
         * RETURN
         * @global type $wpdb
         * @param type $content
         * @param type $atts
         * @param type $mod
         * @return type
         */
        public function return_download_data($content, $atts, $mode) {

            global $MELIBU_PLUGIN_SECURE_01;
            $data = array();

            // Validate
            if ($content && is_string($content) && $content != '') {

                $data['Url'] = $content; // Url
                $urlARR = parse_url($content); // parse for check
                if (isset($urlARR["host"]) && $urlARR["host"] == get_bloginfo('url')) {
                    $fullfilepath = '';
                    $data['Path'] = 'No Path';
                } else {
                    $fullfilepath = $this->parse_url_to_path($content, ABSPATH);
                    $data['Path'] = $fullfilepath; // Path
                }

                if (file_exists($fullfilepath)) {
                    if (!is_file($fullfilepath)) {
                        $data['Error'] = __('No file found: Please select a file', 'download-counter-button');
                    } else {
                        chmod($fullfilepath, $mode); // Change file permission for subscribe and captcha
                        clearstatcache();
                        $data['Permission'] = substr(sprintf('%o', fileperms($fullfilepath)), -4);
                        $type = $this->get_type_by_path($fullfilepath);
                        $data['Type'] = $type; // FILETYPE
                        $size = $this->get_size_by_path($fullfilepath);
                        $data['Size'] = $size; // FILESIZE
                    }
                } else {

                    global $MELIBU_PLUGIN_VALIDATE_01;

                    if ($MELIBU_PLUGIN_VALIDATE_01->domainAvailible($content)) {
                        $headers = get_headers($content, true);
                        $head = array_change_key_case($headers);

                        if (isset($head['content-type']) && !empty($head['content-type'][1]) && $head['content-type'][1] != 'e') {
                            $data['Type'] = (string) $head['content-type'][1];
                        } else {
                            $type = $this->get_type_by_url($content);
                            $data['Type'] = $type;
                        }

                        if (isset($head['content-length']) && !empty($head['content-length'][1])) {
                            $filesize = $head['content-length'][1];
                            $data['Size'] = $this->HELPER->get_real_file_size($filesize); // FILESIZE
                        } else {
                            $data['Size'] = $this->get_size_by_url($content);
                        }
                    } else {
                        
                        $data['Type'] = 'No Type';
                        $data['Size'] = 'No Size';
                    }
                }
            } else if ($content == '...URL...' || $content == '...Here comes the selected URL-path...' || $content == '...Download file path here...') {
                $data['Error'] = __('No URL found: please enter an url', 'download-counter-button');
            } else {
                $data['Error'] = __('No URL found: ', 'download-counter-button') . $content;
            }

            if (is_array($atts)) {
                // Instance
                $data['Instance'] = (int) (isset($atts['instance']) && !empty($atts['instance']) ? $atts['instance'] : '');
                $data['Btn'] = (string) (isset($atts['buttonname']) && !empty($atts['buttonname']) ? $atts['buttonname'] : '');
                $data['Ategseo'] = (string) (isset($atts['atagseo']) && !empty($atts['atagseo']) ? $atts['atagseo'] : ''); // Rel
                $data['Pass'] = (string) (isset($atts['password']) && !empty($atts['password']) ? $MELIBU_PLUGIN_SECURE_01->set_mcrypt(array("password" => $atts['password'])) : ''); // Password
                $url_result = $this->select_url($content, $data['Instance']); // Get DB counts for this content
            } else {
                $url_result = $this->select_url($content, $atts); // Get DB counts for this content
            }

            $data['Count'] = (int) (isset($url_result) ? $url_result[0]->count : 0); // Count
            return $data; // Collect back
        }

        /**
         * DOWNLOAD
         */
        public function download() {

            if (isset($_GET) && !empty($_GET)) { // If GET
                $durl = (string) urldecode(filter_input(INPUT_GET, 'durl')); // File url
                $dtp = (string) filter_input(INPUT_GET, 'dtp'); // File type
                $dabp = (string) filter_input(INPUT_GET, 'dabp'); // File abs path
                if (headers_sent()) { // If headers sent?
                    die('Please try again, the header was sent and can not send again.');
                }
                $fullfilepath = $this->parse_url_to_path($durl, $dabp); // get file fullpath
                // File Exists?
                if (file_exists($fullfilepath) && is_file($fullfilepath)) {
                    chmod($fullfilepath, 0755); // Change file permission for subscribe and captcha
                    clearstatcache();
                    $this->download_file($durl, $fullfilepath, $dtp);
                } else {
                    trigger_error('The file path does not, therefore, the file could not be found. Is SERVER DOCUMENT ROOT: "' . $fullfilepath . '"? It could not be determined, the server Document root.', E_WARNING);
                }
            } else {
                die('No GET parameters');
            }
        }

        /**
         * DOWNLOAD HEADER
         * @param type $fileurl
         * @param type $filepath
         * @param type $filetype
         */
        protected function download_file($fileurl, $filepath, $filetype) {

            $filename = basename(trim($fileurl)); // File basename
            $filesize = filesize(trim($filepath)); // Get filesize
            header("Pragma: public");
            header('Connection: Keep-Alive');
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header('Expires: 0');
            header('Content-Description: File Transfer');
            header("Content-Transfer-Encoding: Binary");
            header("Content-Type: $filetype"); // Set filetype
            header("Content-Disposition: attachment; filename=\"$filename\""); // Set filename
            header("Content-Length: $filesize"); // Set filesize
            readfile($filepath); // Read and Download file
            exit;
        }

    }

    global $MELIBU_PLUGIN_DOWNLOADER_01;
    $MELIBU_PLUGIN_DOWNLOADER_01 = new MELIBU_PLUGIN_DOWNLOADER_01();
}
