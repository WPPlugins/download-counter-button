<?php

/**
 * MELIBU PLUGIN BACKEND CLASS
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.4.9
 */
if (!class_exists('MELIBU_PLUGIN_BACKEND_01_ABSTRACT')) {

    abstract class MELIBU_PLUGIN_BACKEND_01_ABSTRACT {

        const VERSION = '1.8.6.6';
        const DB_VERSION = '1.3.7.0';

        private $DB = null;

        /**
         * 
         */
        public static function create_db() {

            /**
             * 
             * https://codex.wordpress.org/Creating_Tables_with_Plugins
             */
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            global $wpdb;

            $charset_collate = $wpdb->get_charset_collate();

            $melibu_plugin_downloader_table_name = $wpdb->prefix . 'melibu_dcb';
            $melibu_plugin_downloader_create_sql = "CREATE TABLE IF NOT EXISTS " . $melibu_plugin_downloader_table_name . " (
		id int(11) NOT NULL AUTO_INCREMENT,
		name varchar(100) NOT NULL,
                url varchar(255) NOT NULL,
		count int(11) NOT NULL,
		instance int(11) NOT NULL,
		type varchar(150) NOT NULL,
		size varchar(20) NOT NULL,
                time int(11) NOT NULL,
		PRIMARY KEY id (id)
            ) $charset_collate;";

            dbDelta($melibu_plugin_downloader_create_sql);

            $melibu_download_sub_table_name = $wpdb->prefix . 'melibu_dcb_sub';
            $melibu_download_sub_create_sql = "CREATE TABLE IF NOT EXISTS " . $melibu_download_sub_table_name . " (
		id int(11) NOT NULL AUTO_INCREMENT,
		user varchar(100) NOT NULL,
		mail varchar(255) NOT NULL,
		name varchar(100) NOT NULL,
                url varchar(255) NOT NULL,
                time int(11) NOT NULL,
		PRIMARY KEY id (id)
            ) $charset_collate;";


            dbDelta($melibu_download_sub_create_sql);
        }

        /**
         * 
         * @global type $wpdb
         * @return type
         */
        public function update() {

            global $wpdb;
            $this->DB = $wpdb;

            set_time_limit(0); // no PHP timeout for running updates

            $this->create_db();

            /**
             * get_option() WP Since: 1.5.0
             * https://codex.wordpress.org/Function_Reference/get_option
             */
            if (self::DB_VERSION > get_option('melibuPlugin_DCB_db_version')) {

                $melibu_dcb = $this->DB->prefix . 'melibu_dcb';
                $melibu_dcb_sub = $this->DB->prefix . 'melibu_dcb_sub';

                $row2 = $this->DB->get_results("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '" . $melibu_dcb . "' AND column_name = 'type'");
                if (!$row2) {
                    $alter_sql2 = "ALTER TABLE " . $melibu_dcb . " ADD type varchar(150) NOT NULL;";
                    $this->DB->query($alter_sql2);
                }

                $row3 = $this->DB->get_results("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '" . $melibu_dcb . "' AND column_name = 'instance'");
                if (!$row3) {
                    $alter_sql3 = "ALTER TABLE " . $melibu_dcb . " ADD instance integer(11) NOT NULL;";
                    $this->DB->query($alter_sql3);
                }

                // v.1.5
                $row4 = $this->DB->get_results("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '" . $melibu_dcb_sub . "' AND column_name = 'user'");
                if (!$row4) {
                    $alter_sql4 = "ALTER TABLE " . $melibu_dcb_sub . " ADD user varchar(100) NOT NULL;";
                    $this->DB->query($alter_sql4);
                }

                // v.1.7
                $row5 = $this->DB->get_results("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '" . $melibu_dcb . "' AND column_name = 'btn'");
                if (!$row5) {
                    $alter_sql5 = "ALTER TABLE " . $melibu_dcb . " ADD btn varchar(100) NOT NULL;";
                    $this->DB->query($alter_sql5);
                }

                // v.1.8.0
                $row6 = $this->DB->get_results("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '" . $melibu_dcb . "' AND column_name = 'atagseo'");
                if (!$row6) {
                    $alter_sql6 = "ALTER TABLE " . $melibu_dcb . " ADD atagseo varchar(100) NOT NULL;";
                    $this->DB->query($alter_sql6);
                }

                // v.1.8.0
                $row7 = $this->DB->get_results("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '" . $melibu_dcb . "' AND column_name = 'pass'");
                if (!$row7) {
                    $alter_sql7 = "ALTER TABLE " . $melibu_dcb . " ADD pass varchar(255) NOT NULL;";
                    $this->DB->query($alter_sql7);
                }

                /**
                 * update_option() WP Since: 1.0.0
                 * https://codex.wordpress.org/Function_Reference/update_option
                 */
                update_option("melibuPlugin_DCB_db_version", self::DB_VERSION);
            }

            if (self::VERSION > get_option('melibuPlugin_DCB_version')) {

                update_option("melibuPlugin_DCB_version", self::VERSION);
            }
        }

        /**
         * 
         */
        public function init_options() {

            /**
             * add_option() WP Since: 1.0.0
             * https://codex.wordpress.org/Function_Reference/add_option
             */
            add_option('melibuPlugin_DCB_version', self::VERSION);
            add_option('melibuPlugin_DCB_db_version', self::DB_VERSION);
        }

        /**
         * 
         */
        public function init_filter() {

            /**
             * add_filter() WP Since: 0.71
             * https://developer.wordpress.org/reference/functions/add_filter/
             */
            add_filter('mce_buttons', array($this, 'add_button'));
            add_filter("mce_external_plugins", array($this, 'register_button'));
        }

        /**
         * 
         * @param type $buttons
         * @return type
         */
        public function add_button($buttons) {

            /**
             * array_push() PHP Since: PHP 4
             * http://php.net/manual/de/function.array-push.php
             */
            array_push($buttons, "melibu_plugin_download_counter_button");
            return $buttons;
        }

        /**
         * 
         * @param array $plugin_array
         * @return type
         */
        public function register_button($plugin_array) {

            /**
             * plugins_url() WP Since: 2.6.0
             * https://codex.wordpress.org/Function_Reference/plugins_url
             */
            $plugin_array['melibu_plugin_download_counter_button'] = plugins_url("js/mb-dcb-shortcode.js", dirname(__FILE__));
            return $plugin_array;
        }

        /**
         * Welcome
         */
        public function welcome() {

            require_once MELIBU_PLUGIN_PATH_01 . 'html/welcome.php';
        }

        /**
         * Download
         */
        public function options() {

            require_once MELIBU_PLUGIN_PATH_01 . 'html/download.php';
        }

        /**
         * Download
         */
        public function abo() {

            require_once MELIBU_PLUGIN_PATH_01 . 'html/abo-lister.php';
        }

        /**
         * Download
         */
        public function download() {

            require_once MELIBU_PLUGIN_PATH_01 . 'html/down-lister.php';
        }

        /**
         * Download
         */
        public function settings() {

            require_once MELIBU_PLUGIN_PATH_01 . 'html/settings.php';
        }

        /**
         * Download
         */
        public function modal() {

            require_once MELIBU_PLUGIN_PATH_01 . 'html/modal.php';
        }

        /**
         * Download
         */
        public function shortcode() {

            require_once MELIBU_PLUGIN_PATH_01 . 'html/shortcode.php';
        }

        /**
         * About
         */
        public function about() {

            require_once MELIBU_PLUGIN_PATH_01 . 'html/about.php';
        }

        /**
         * 
         */
        public function init_settings() {

            /**
             * register_setting() WP Since: 2.7.0
             * https://codex.wordpress.org/Function_Reference/register_setting
             */
            register_setting(
                    "melibuPlugin_download_button_layout", // ID
                    "melibuPlugin_get_download_button_layout", // Datenbankeintrag
                    array($this, 'save_option') // Funktion die aufgerufen wird
            );

            // Modal
            register_setting(
                    "melibuPlugin_download_button_icon", // ID
                    "melibuPlugin_get_download_button_icon", // Datenbankeintrag
                    array($this, 'save_option') // Funktion die aufgerufen wird
            );

            // Button color
            register_setting(
                    "melibuPlugin_download_button", // ID
                    "melibuPlugin_get_download_button", // Datenbankeintrag 
                    array($this, 'save_option') // Funktion die aufgerufen wird
            );

            // Label
            register_setting(
                    "melibuPlugin_download_button_drop", // ID
                    "melibuPlugin_get_download_button_drop", // Datenbankeintrag 
                    array($this, 'save_option') // Funktion die aufgerufen wird
            );

            // Options
            register_setting(
                    "melibuPlugin_download_button_options", // ID
                    "melibuPlugin_get_download_button_options", // Datenbankeintrag 
                    array($this, 'save_option') // Funktion die aufgerufen wird
            );

            // Defaults
            register_setting(
                    "melibuPlugin_download_button_default", // ID
                    "melibuPlugin_get_download_button_default", // Datenbankeintrag 
                    array($this, 'save_option') // Funktion die aufgerufen wird
            );

            // Thanks text
            register_setting(
                    "melibuPlugin_download_button_text", // ID
                    "melibuPlugin_get_download_button_text", // Datenbankeintrag
                    array($this, 'save_option') // Funktion die aufgerufen wird
            );

            // FontAwesome
            register_setting(
                    "melibuPlugin_download_button_fontawesome", // ID
                    "melibuPlugin_get_download_button_fontawesome", // Datenbankeintrag
                    array($this, 'save_option') // Funktion die aufgerufen wird
            );

            // Logo
            register_setting(
                    "melibuPlugin_download_button_logo", // ID
                    "melibuPlugin_get_download_button_logo", // Datenbankeintrag
                    array($this, 'save_upload') // Funktion die aufgerufen wird
            );

            // Hide/Show
            register_setting(
                    "melibuPlugin_download_button_counthide", // ID
                    "melibuPlugin_get_download_button_counthide", // Datenbankeintrag
                    array($this, 'save_option') // Funktion die aufgerufen wird
            );

            // Subscriber
            register_setting(
                    "melibuPlugin_download_button_subscriber", // ID
                    "melibuPlugin_get_download_button_subscriber", // Datenbankeintrag
                    array($this, 'save_option') // Funktion die aufgerufen wird
            );

            // Modal
            register_setting(
                    "melibuPlugin_download_button_modal", // ID
                    "melibuPlugin_get_download_button_modal", // Datenbankeintrag
                    array($this, 'save_option') // Funktion die aufgerufen wird
            );

            // Captcha
            register_setting(
                    "melibuPlugin_download_button_captcha", // ID
                    "melibuPlugin_get_download_button_captcha", // Datenbankeintrag
                    array($this, 'save_option') // Funktion die aufgerufen wird
            );

            // Widget
            register_setting(
                    "melibuPlugin_download_button_top", // ID
                    "melibuPlugin_get_download_button_top", // Datenbankeintrag
                    array($this, 'save_option') // Funktion die aufgerufen wird
            );

            // Errors
            register_setting(
                    "melibuPlugin_download_errors", // ID
                    "melibuPlugin_get_download_errors", // Datenbankeintrag
                    array($this, 'save_option') // Funktion die aufgerufen wird
            );

            // COPY
            register_setting(
                    "melibu_plugin_download_copy", // ID
                    "melibu_plugin_get_download_copy", // Datenbankeintrag
                    array($this, 'save_option') // Funktion die aufgerufen wird
            );

            // MAIL DEFAULTS
            register_setting(
                    "melibuPlugin_download_email_defaults", // ID
                    "melibuPlugin_get_download_email_defaults", // Datenbankeintrag
                    array($this, 'save_option') // Funktion die aufgerufen wird
            );
        }

        /**
         * 
         * @param type $input
         * @return boolean
         */
        public function save_option($input) {

            $return = $input;
            if (!empty($_POST) && check_admin_referer('melibuPlugin_download_nonce_action', 'melibuPlugin_download_nonce')) {
                /**
                 * https://codex.wordpress.org/Function_Reference/current_user_can
                 * https://codex.wordpress.org/Roles_and_Capabilities
                 * since 2.0.0
                 */
                if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
                    $return = false;
                }
                return $return;
            }
        }

        /**
         * 
         * @return type
         */
        public function save_upload() {

            if (!function_exists('wp_handle_upload')) {
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
            }

            if (!empty($_POST) && check_admin_referer('melibuPlugin_download_nonce_action', 'melibuPlugin_download_nonce')) {

                /**
                 * https://codex.wordpress.org/Function_Reference/current_user_can
                 * https://codex.wordpress.org/Roles_and_Capabilities
                 * since 2.0.0
                 */
                if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
                    return false;
                }

                // Get and delete old
                $melibuPlugin_get_download_button_logo = get_option('melibuPlugin_get_download_button_logo');
                if (file_exists($melibuPlugin_get_download_button_logo['file'])) {
                    unlink($melibuPlugin_get_download_button_logo['file']);
                }

                $uploadedfile = $_FILES['melibuPlugin_get_download_button_logo'];
                $upload_overrides = array('test_form' => false);
                $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

                if ($movefile && !isset($movefile['error'])) {
                    return $movefile;
                } else {
                    /**
                     * Error generated by _wp_handle_upload()
                     * @see _wp_handle_upload() in wp-admin/includes/file.php
                     */
                    echo $movefile['error'];
                }
            }
        }

    }

}