<?php

require_once 'class.MelibuBackendAbstract.php';

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
if (!class_exists('MELIBU_PLUGIN_BACKEND_01')) {

    class MELIBU_PLUGIN_BACKEND_01 extends MELIBU_PLUGIN_BACKEND_01_ABSTRACT {

        private $slug = 'melibu-plugin-download-admin';
        private $ERRORS;

        /**
         * Construct
         */
        public function __construct() {

            global $MELIBU_PLUGIN_DOWNLOAD_ERRORS;
            $this->ERRORS = $MELIBU_PLUGIN_DOWNLOAD_ERRORS;

            /**
             * add_action() WP Since: 1.2.0
             * https://developer.wordpress.org/reference/functions/add_action/
             */
            add_action('admin_menu', array($this, 'add_menu'));
            add_action('admin_init', array($this, 'admin_init'));
            add_action('admin_head', array($this, 'admin_head'));
            add_action('plugins_loaded', array($this, 'plugins_loaded'));
            add_action('plugins_loaded', array($this, 'plugins_loaded_about'), 1);
//            add_action('admin_enqueue_scripts', array($this, 'color_picker_assets'));
        }

        /**
         * Activate
         */
        public static function activate() {
            
            /**
             * current_user_can() WP Since: 2.0.0
             * https://codex.wordpress.org/Function_Reference/current_user_can
             * https://codex.wordpress.org/Roles_and_Capabilities
             */
            if (!current_user_can('activate_plugins')) {
                return;
            }
            
            clearstatcache();
            flush_rewrite_rules(); // rewrite rules for activate and update

            /**
             * set_transient() WP Since: 2.8
             * https://codex.wordpress.org/Function_Reference/set_transient
             */
            set_transient('melibu-plugin-DCB-page-activated', 1, 30);
        }

        /**
         * Deactivate
         */
        public static function deactivate() {

            //..
        }

        /**
         * Uninstall
         */
        public static function uninstall() {

            /**
             * current_user_can() WP Since: 2.0.0
             * https://codex.wordpress.org/Function_Reference/current_user_can
             * https://codex.wordpress.org/Roles_and_Capabilities
             */
            if (!defined('WP_UNINSTALL_PLUGIN') && !current_user_can('delete_plugins')) {
                return;
            }

            /**
             * Unregister settings
             * https://codex.wordpress.org/Function_Reference/unregister_setting
             */
            unregister_setting("melibuPlugin_download_button_layout", "melibuPlugin_get_download_button_layout", "");
            delete_option("melibuPlugin_get_download_button_layout");

            unregister_setting("melibuPlugin_download_button_icon", "melibuPlugin_get_download_button_icon", "");
            delete_option("melibuPlugin_get_download_button_icon");

            unregister_setting("melibuPlugin_download_button", "melibuPlugin_get_download_button", "");
            delete_option("melibuPlugin_get_download_button");

            unregister_setting("melibuPlugin_download_button_drop", "melibuPlugin_get_download_button_drop", "");
            delete_option("melibuPlugin_get_download_button_drop");

            unregister_setting("melibuPlugin_download_button_options", "melibuPlugin_get_download_button_options", "");
            delete_option("melibuPlugin_get_download_button_options");

            unregister_setting("melibuPlugin_download_button_default", "melibuPlugin_get_download_button_default", "");
            delete_option("melibuPlugin_get_download_button_default");

            unregister_setting("melibuPlugin_download_button_text", "melibuPlugin_get_download_button_text", "");
            delete_option("melibuPlugin_get_download_button_text");

            unregister_setting("melibuPlugin_download_button_fontawesome", "melibuPlugin_get_download_button_fontawesome", "");
            delete_option("melibuPlugin_get_download_button_fontawesome");

            unregister_setting("melibuPlugin_download_button_logo", "melibuPlugin_get_download_button_logo", "");
            delete_option("melibuPlugin_get_download_button_logo");

            unregister_setting("melibuPlugin_download_button_counthide", "melibuPlugin_get_download_button_counthide", "");
            delete_option("melibuPlugin_get_download_button_counthide");

            unregister_setting("melibuPlugin_download_button_subscriber", "melibuPlugin_get_download_button_subscriber", "");
            delete_option("melibuPlugin_get_download_button_subscriber");

            unregister_setting("melibuPlugin_download_button_modal", "melibuPlugin_get_download_button_modal", "");
            delete_option("melibuPlugin_get_download_button_modal");

            unregister_setting("melibuPlugin_download_button_captcha", "melibuPlugin_get_download_button_captcha", "");
            delete_option("melibuPlugin_get_download_button_captcha");

            unregister_setting("melibuPlugin_download_button_top", "melibuPlugin_get_download_button_top", "");
            delete_option("melibuPlugin_get_download_button_top");

            unregister_setting("melibuPlugin_download_errors", "melibuPlugin_get_download_errors", "");
            delete_option("melibuPlugin_get_download_errors");

            unregister_setting("melibu_plugin_download_copy", "melibu_plugin_get_download_copy", "");
            delete_option("melibu_plugin_get_download_copy");

            unregister_setting("melibuPlugin_download_email_defaults", "melibuPlugin_get_download_email_defaults", "");
            delete_option("melibuPlugin_get_download_email_defaults");

            delete_option('melibuPlugin_DCB_version');
            delete_option('melibuPlugin_DCB_db_version');

            global $wpdb;
            $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}melibu_dcb");
            $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}melibu_dcb_sub");
        }

        /**
         * Init Admin
         */
        public function admin_init() {

            $this->init_options();
            $this->init_settings();
            $this->init_filter();
        }

        /**
         * Admin Menus
         */
        public function add_menu() {

            /**
             * add_menu_page()
             * https://developer.wordpress.org/reference/functions/add_menu_page/
             */
            add_menu_page('MeliBu Download Counter Button - Welcome', // $page_title
                    'MB Download', // $menu_title
                    'manage_options', // $capability
                    $this->slug, // $menu_slug
                    array($this, 'welcome'), // $function
                    plugins_url('img/icon-MB-20.png', dirname(__FILE__)) // $icon_url
            );

            /**
             * add_submenu_page() WP Since: 1.5.0
             * https://developer.wordpress.org/reference/functions/add_submenu_page/
             */
            add_submenu_page($this->slug, // $parent_slug
                    'MeliBu Download Counter Button - Options', // $page_title
                    __('Design', 'download-counter-button'), // $menu_title
                    'manage_options', // $capability
                    'melibu-plugin-download-admin-control-menu-1', // $menu_slug
                    array($this, 'options') // $function
            );

            /**
             * add_submenu_page() WP Since: 1.5.0
             * https://developer.wordpress.org/reference/functions/add_submenu_page/
             */
            add_submenu_page($this->slug, // $parent_slug
                    'MeliBu Download Counter Button - Modal', // $page_title
                    __('Modal', 'download-counter-button'), // $menu_title
                    'manage_options', // $capability
                    'melibu-plugin-download-admin-control-menu-2', // $menu_slug
                    array($this, 'modal') // $function
            );

            /**
             * add_submenu_page() WP Since: 1.5.0
             * https://developer.wordpress.org/reference/functions/add_submenu_page/
             */
            add_submenu_page($this->slug, // $parent_slug
                    'MeliBu Download Counter Button - Subscribers', // $page_title
                    __('Subscribes', 'download-counter-button'), // $menu_title
                    'manage_options', // $capability
                    'melibu-plugin-download-admin-control-menu-3', // $menu_slug
                    array($this, 'abo') // $function
            );

            /**
             * add_submenu_page() WP Since: 1.5.0
             * https://developer.wordpress.org/reference/functions/add_submenu_page/
             */
            add_submenu_page($this->slug, // $parent_slug
                    'MeliBu Download Counter Button - Download', // $page_title
                    __('Downloads', 'download-counter-button'), // $menu_title
                    'manage_options', // $capability
                    'melibu-plugin-download-admin-control-menu-4', // $menu_slug
                    array($this, 'download') // $function
            );

            /**
             * add_submenu_page() WP Since: 1.5.0
             * https://developer.wordpress.org/reference/functions/add_submenu_page/
             */
            add_submenu_page($this->slug, // $parent_slug
                    'MeliBu Download Counter Button - Settings', // $page_title
                    __('Settings', 'download-counter-button'), // $menu_title
                    'manage_options', // $capability
                    'melibu-plugin-download-admin-control-menu-5', // $menu_slug
                    array($this, 'Settings') // $function
            );

            /**
             * add_submenu_page() WP Since: 1.5.0
             * https://developer.wordpress.org/reference/functions/add_submenu_page/
             */
            add_submenu_page($this->slug, // $parent_slug
                    'MeliBu Download Counter Button - Shortcode', // $page_title
                    __('Shortcode', 'download-counter-button'), // $menu_title
                    'manage_options', // $capability
                    'melibu-plugin-download-admin-control-menu-6', // $menu_slug
                    array($this, 'shortcode') // $function
            );

            /**
             * add_submenu_page() WP Since: 1.5.0
             * https://developer.wordpress.org/reference/functions/add_submenu_page/
             */
            add_submenu_page($this->slug, // $parent_slug
                    'MeliBu Download Counter Button - About', // $page_title
                    __('About', 'download-counter-button'), // $menu_title
                    'manage_options', // $capability
                    'melibu-plugin-download-admin-control-menu-7', // $menu_slug
                    array($this, 'about') // $function
            );
        }

        /**
         * Admin Head
         */
        public function admin_head() {

            global $MELIBU_PLUGIN_OPTIONS_01;
            $shortcode = $MELIBU_PLUGIN_OPTIONS_01->shortcode();
            $settings = $MELIBU_PLUGIN_OPTIONS_01->settings();
            $design = $MELIBU_PLUGIN_OPTIONS_01->design();
            $melibu_dateime_format = get_date_from_gmt(date('Y-m-d H:i:s', time()), get_option('date_format') . ' - ' . get_option('time_format'));

            /**
             * wp_enqueue_style() WP Since: 2.6.0
             * https://developer.wordpress.org/reference/functions/wp_enqueue_style/
             */
            wp_enqueue_style('melibu-plugin-dcb-style', plugins_url('css/style.min.css', dirname(__FILE__)));
            wp_enqueue_style('melibu-plugin-dcb-admin-style', plugins_url('css/admin.min.css', dirname(__FILE__)));
            wp_enqueue_style('melibu-plugin-all-style', plugins_url('css/all.min.css', dirname(__FILE__)));

            // Font
            if ($settings['font'] == 'fontawesome' || $settings['font'] == 'on') {
                wp_enqueue_style('font-awesome-4-6-1', plugins_url('ext/font-awesome-4.6.1/css/font-awesome.min.css', dirname(__FILE__)));
            }

            /**
             * wp_enqueue_script() WP Since: 2.1.0
             * https://developer.wordpress.org/reference/functions/wp_enqueue_script/
             */
            wp_enqueue_script('melibu-plugin-all-event-js', plugins_url('js/mb-dcb-event.js', dirname(__FILE__)), array(), '', true);

            $admin = 0;
            if (current_user_can('manage_options')) {
                $admin = 1;
            }

            wp_register_script('melibu-plugin-dcb-download-js', plugins_url('js/mb-dcb-download.js', dirname(__FILE__)), array(), '', true);
            $drag_translation_array = array(
                'shortcode_text' => __('Insert MB Download short code', 'download-counter-button'),
                'shortcode_button_text' => __('Get File URL', 'download-counter-button'),
                'name' => $shortcode['labelname'],
                'buttonname' => $shortcode['buttonname'],
                'password' => $shortcode['password'],
                'other' => $shortcode['other'],
                'time' => $melibu_dateime_format,
                'atagseo' => $shortcode['atagseo'],
                'modal' => $settings['modal'],
                'subscribe' => $settings['subscribe'],
                'subscribename' => $settings['subscribename'],
                'captcha' => $settings['captcha'],
                'counter' => $settings['counter'],
                'dash' => $design['dash'],
                'user_role' => $admin,
                'blog_url' => get_bloginfo('url'),
                'plugin_url' => MELIBU_PLUGIN_URL_01,
            );
            wp_localize_script('melibu-plugin-dcb-download-js', 'melibu_download_translate', $drag_translation_array);
            wp_enqueue_script('melibu-plugin-dcb-download-js');

            wp_enqueue_script('melibu-plugin-dcb-doc-js', plugins_url('js/mb-dcb-doc.js', dirname(__FILE__)), array(), '', true);
        }

//        /**
//         * 
//         * @param type $hook_suffix
//         */
//        public function color_picker_assets($hook_suffix) {
//
//            // $hook_suffix to apply a check for admin page.
//
//            wp_enqueue_style('wp-color-picker');
//            wp_enqueue_script('wp-color-picker');
//
//            wp_enqueue_script('melibu-plugin-dcb-colorpicker-js', plugins_url('js/mb-dcb-colorpicker.js', dirname(__FILE__)), array('wp-color-picker'), false, true);
//        }

        /**
         * Plugins Loaded
         */
        public function plugins_loaded() {

            $this->update();
        }

        /**
         * Plugins Loaded
         */
        public function plugins_loaded_about() {

            /**
             * get_transient() WP Since: 2.8
             * https://codex.wordpress.org/Function_Reference/get_transient
             */
            if (!get_transient('melibu-plugin-DCB-page-activated')) {
                return;
            }

            /**
             * delete_transient() WP Since: 2.8
             * https://codex.wordpress.org/Function_Reference/delete_transient
             */
            delete_transient('melibu-plugin-DCB-page-activated');

            /**
             * wp_redirect() WP Since: 1.5.1
             * https://codex.wordpress.org/Function_Reference/wp_redirect
             */
            wp_redirect(
                    /**
                     * admin_url() WP Since:2.6.0
                     * https://codex.wordpress.org/Function_Reference/admin_url
                     */
                    admin_url('admin.php?page=melibu-plugin-download-admin-control-menu-7')
            );
            exit;
        }

    }

}
