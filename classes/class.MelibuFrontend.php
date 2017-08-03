<?php

/**
 * MELIBU PLUGIN FRONTEND CLASS
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.4.9
 */
if (!class_exists('MELIBU_PLUGIN_FRONTEND_01')) {

    class MELIBU_PLUGIN_FRONTEND_01 {

        private $HELPER;
        private $SECURE;
        private $DOWNLOADER;
        private $VALIDATE;
        private $OPTIONS;
        private $locale = '';

        /**
         *  Construct
         */
        public function __construct() {

            global $melibuPluginHelper, $MELIBU_PLUGIN_DOWNLOADER_01, $MELIBU_PLUGIN_VALIDATE_01, $MELIBU_PLUGIN_SECURE_01, $MELIBU_PLUGIN_OPTIONS_01;
            $this->HELPER = $melibuPluginHelper;
            $this->SECURE = $MELIBU_PLUGIN_SECURE_01;
            $this->DOWNLOADER = $MELIBU_PLUGIN_DOWNLOADER_01;
            $this->VALIDATE = $MELIBU_PLUGIN_VALIDATE_01;
            $this->OPTIONS = $MELIBU_PLUGIN_OPTIONS_01;
            /**
             * add_action() WP Since: 1.2.0
             * https://developer.wordpress.org/reference/functions/add_action/
             */
            add_action('init', array($this, 'init'));
            add_action('plugins_loaded', array($this, 'plugins_loaded'));
            add_action('wp_enqueue_scripts', array($this, 'wp_enqueue_scripts'));
            add_action('widgets_init', array($this, 'widgets_init'));
            add_action('wp_footer', array($this, 'wp_footer'));
            add_action('wp_ajax_melibu_down_ajax', array($this, 'melibu_down_ajax')); // admin side
            add_action('wp_ajax_nopriv_melibu_down_ajax', array($this, 'melibu_down_ajax')); // for frontend
            /**
             * add_shortcode() WP Since: 2.5
             * https://codex.wordpress.org/Function_Reference/add_shortcode
             */
            add_shortcode('download', array($this, 'shortcode'));
            add_shortcode('wp_mb_plugin_download', array($this, 'shortcode'));
        }

        /**
         * Init
         */
        public function init() {

            $this->init_filters();
            $this->init_session();
        }

        /**
         * Filters
         */
        public function init_filters() {

            add_filter('widget_text', 'do_shortcode'); // Enable Shortcode in Text Widgets
            /**
             * apply_filters() WP Since: 0.71
             * https://developer.wordpress.org/reference/functions/apply_filters/
             */
            $this->locale = apply_filters('plugin_locale', get_locale(), 'download-counter-button');
        }

        /**
         * Session
         */
        public function init_session() {

            if (!session_id()) {
                session_start();
            }
        }

        /**
         * Scripts
         */
        public function wp_enqueue_scripts() {

            $shortcode = $this->OPTIONS->shortcode();
            $settings = $this->OPTIONS->settings();
            $design = $this->OPTIONS->design();
            $melibu_dateime_format = get_date_from_gmt(date('Y-m-d H:i:s', time()), get_option('date_format') . ' - ' . get_option('time_format'));

            /**
             * wp_enqueue_style() WP Since: 2.6.0
             * https://developer.wordpress.org/reference/functions/wp_enqueue_style/
             */
            wp_enqueue_style('melibu-plugin-dcb-style', plugins_url('css/style.min.css', dirname(__FILE__)));

            // Font
            if ($settings['font'] == 'dashicons') {
                wp_enqueue_style('dashicons');
            } else if ($settings['font'] == 'fontawesome' || $settings['font'] == 'on') {
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
                'abspath' => ABSPATH
            );
            wp_localize_script('melibu-plugin-dcb-download-js', 'melibu_download_translate', $drag_translation_array);
            wp_enqueue_script('melibu-plugin-dcb-download-js');

            wp_enqueue_script('melibu-plugin-all-ajax-js', plugins_url('js/mb-dcb-ajax.js', dirname(__FILE__)), array(), '', true);
        }

        /**
         * Plugins Loaded
         */
        public function wp_footer() {

            $this->DOWNLOADER->modal();
        }

        /**
         * Plugins Loaded
         */
        public function plugins_loaded() {

            $this->load_textdomain();
        }

        /**
         * Load Textdomains
         */
        public function load_textdomain() {

            /**
             * load_textdomain() WP Since: 1.5.0
             * https://codex.wordpress.org/Function_Reference/load_textdomain
             */
            load_textdomain('download-counter-button', WP_LANG_DIR . "/plugins/download-counter-button/download-counter-button-$this->locale.mo");
            /**
             * load_plugin_textdomain() WP Since: 1.5.0
             * https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
             */
            load_plugin_textdomain('download-counter-button', false, plugin_basename(MELIBU_PLUGIN_PATH_01 . 'languages/'));
        }

        /**
         * Add Shortcode
         * 
         * @param type $atts
         * @param type $content
         * @return type
         */
        public function shortcode($atts, $content = null) {

            $settings = $this->OPTIONS->settings();
            $design = $this->OPTIONS->design();

            $downloadURL = (string) trim($content); // Trim url

            /**
             * shortcode_atts() WP Since: 2.5
             * https://codex.wordpress.org/Function_Reference/shortcode_atts
             */
            shortcode_atts(array(
                'instance' => '',
                'password' => '',
                'name' => '',
                'buttonname' => '',
                'datetime' => '',
                'other' => '',
                'atagseo' => ''), $atts);

            $downloadButtonname = 'Download';
            if (isset($atts['buttonname']) && !empty($atts['buttonname'])) {
                $downloadButtonname = (string) esc_html(trim($atts['buttonname']));
            }
            $downloadAtagseo = 'tag';
            if (isset($atts['atagseo']) && !empty($atts['atagseo'])) {
                $downloadAtagseo = (string) esc_html(trim($atts['atagseo']));
            }
            $downloadPass = '';
            if (isset($atts['password']) && !empty($atts['password'])) {
                $downloadPass = esc_html($this->SECURE->set_mcrypt($atts));
            }

            /**
             * No subscribe or No captcha 
             * then file permission for others read
             */
            $mode = 0744;
            if ($settings['subscribe'] == 'on' || $settings['captcha'] == 'on' || $downloadPass != '') { // With subscribe, captcha or pass
                $mode = 0644;
                $return = $this->VALIDATE->val_action();
                if ('true' == $return) {
                    $this->DOWNLOADER->action_handler(); // Action handler without JS
                }
            }

            $rest = $this->DOWNLOADER->return_download_data($downloadURL, $atts, $mode);

            /**
             * File protection
             */
            if ($settings['protect'] == "yes") {
                $this->SECURE->file_protect($rest);
            } else {
                $this->SECURE->remove_file_protect($rest);
            }

            // Download start
            $download = '<!-- MELIBU WP DOWNLOAD COUNTER BUTTON BY SAMET TARIM -->';
            $noscriptURL = '';

            // NO JS
            if (isset($_GET['mbdowncheck']) && $_GET['mbdowncheck'] == "1") {
                if (isset($_GET['ins']) && $_GET['ins'] == trim($atts['instance'])) {
                    $download .= $this->DOWNLOADER->modal_non_js($rest, $return);
                }
            }
            // NO JS
            // // Anker start
            $download .= '<div id="mb-dcb-anker' . $atts['instance'] . '" class="st-download-button-' . esc_attr($design['layout']) . '">';
            // If no Type, no Size and no URL the download not work
            if (!isset($rest['Error'])) {

                // Icon start
                $download .= '<div class="st-download-button-icon ' . esc_attr($design['icon-color']) . '">';
                // Font
                if ($settings['font'] == 'dashicons') {
                    $download .= '<span class="dashicons dashicons-download"></span>';
                } else if ($settings['font'] == 'fontawesome' || $settings['font'] == 'on') {
                    $download .= '<i class="fa fa-download"></i>';
                }
                $download .= '</div>';
                // Icon end
                // Button start
                $download .= '<div class="st-download-button-name ' . esc_attr($design['color']) . '">';
                $download .= '<div class="mb-put' . esc_attr($atts['instance']) . '" data-mb-dcb-btnname="' . $downloadButtonname . '" data-mb-dcb-atagseo="' . $downloadAtagseo . '" data-mb-dcb-pass="' . $downloadPass . '">';
                // No Script part start ////////////////////////////////////
                $download .= '<noscript>';
                if ($settings['subscribe'] == 'on' || $settings['captcha'] == 'on' || $settings['modal'] == 'on' || $downloadPass != '') { // With subscribe or captcha
                    // Create POST download link
                    $noscriptURL .= $this->HELPER->get_protocol();
                    $noscriptURL .= filter_input(INPUT_SERVER, "HTTP_HOST");
                    $noscriptURL .= strtok(filter_input(INPUT_SERVER, "REQUEST_URI"), '?');
                    $noscriptURL .= '?mbdowncheck=1';
                    $noscriptURL .= '&ins=' . $atts['instance'];
                    $noscriptURL .= '#mb-dcb-anker' . $atts['instance'];
                } else {
                    // Create GET download link
                    $noscriptURL .= $this->HELPER->get_protocol(); // http or https
                    $noscriptURL .= filter_input(INPUT_SERVER, "HTTP_HOST");
                    $noscriptURL .= strtok(filter_input(INPUT_SERVER, "REQUEST_URI"), '?');
                    $noscriptURL .= '?mbcountdown=1';
                    $noscriptURL .= '&url=' . urlencode($downloadURL);
                    $noscriptURL .= '&type=' . $rest['Type'];
                    $noscriptURL .= '&size=' . $rest['Size'];
                    $noscriptURL .= '&ins=' . $atts['instance'];
                    $noscriptURL .= '&pass=' . $downloadPass;
                    $noscriptURL .= '&rel=' . $downloadAtagseo;
                    $noscriptURL .= '&btn=' . $downloadButtonname;
                    $noscriptURL .= '#mb-dcb-anker' . $atts['instance'];
                }
                $download .= '<a href="' . esc_url($noscriptURL) . '" rel="' . esc_attr($downloadAtagseo) . '" title="' . esc_attr($downloadButtonname) . ' (' . esc_attr($rest['Count']) . ')" class="' . esc_attr($design['dash']) . '" download="download">' . $downloadButtonname;
                if ($settings['counter'] == 'off' || is_admin()) {
                    $download .= '&nbsp;<span class="st-display">(' . esc_html($rest['Count']) . ')</span>';
                }
                $download .= '</a>';
                $download .= '</noscript>';
                // No Script part end //////////////////////////////////////
                $download .= '</div>';
                $download .= '</div>';
                // Button end
                $download .= '<input type="hidden" name="' . esc_url($downloadURL) . '" value="' . esc_html($rest['Count']) . '" id="' . esc_html($atts['instance']) . '" class="mb-instances" readonly="readonly">';

                // Drop start
                $download .= '<div class="st-download-drop ' . esc_attr($settings['label']) . ' ' . esc_attr($design['labelcolor']) . '">';
                $download .= '<div class="mb-drop' . esc_html($atts['instance']) . '">';

                // Info Label with logo or without
                if (!empty($design['logo'])) {
                    $download .= '<div class="st-drop-img">';
                    $download .= '<img src="' . esc_url($design['logo']) . '" alt="' . esc_html(basename($design['logo'])) . '" width="40" height="40">';
                    $download .= '</div>';

                    $download .= '<div class="st-drop-descrip">';
                    if (isset($atts['name'])) {
                        $download .= esc_html($atts['name']) . '<br />';
                    }
                    $download .= '<span><small>' . esc_html($atts['datetime']) . '</small></span><br />';
                    $download .= '<small><span class="mb-download-type">' . esc_html($rest['Type']) . '</span></small><br />';
                    $download .= '<span class="mb-download-size">' . esc_html($rest['Size']) . '</span><br />';
                    $download .= '<span>' . esc_html($atts['other']) . '</span>';
                    $download .= '</div>';
                } else {
                    $download .= '<div class="st-drop-descrip">';
                    if (isset($atts['name'])) {
                        $download .= esc_html($atts['name']) . '<br />';
                    }
                    $download .= '<span><small>' . esc_html($atts['datetime']) . '</small></span><br />';
                    $download .= '<small><span class="mb-download-type">' . esc_html($rest['Type']) . '</span></small><br />';
                    $download .= '<span class="mb-download-size">' . esc_html($rest['Size']) . '</span><br />';
                    $download .= '<span>' . esc_html($atts['other']) . '</span>';
                    $download .= '</div>';
                }

                // Clear
                $download .= '<span class="st-clear"></span>';

                $download .= '</div>';
                $download .= '</div>';
                // Drop end
            } else {

                // Error
                $download .= '<div style="color:red;">';
                $download .= '<h3>DOWNLOAD ERROR</h3>';

                if (current_user_can('manage_options')) {
                    $download .= '<h3>' . esc_html($rest['Error']) . '</h3>';
                }

                $download .= '<div class="st-alert st-alert-warning"><strong>';
                $download .= esc_url($downloadURL);
                $download .= '</strong></div>';

                $download .= '<ul class="st-list">';
                $download .= '<li>' . __('Check if File deleted!', 'download-counter-button') . '</li>';
                $download .= '<li>' . __('Selected Check whether file!', 'download-counter-button') . '</li>';
                $download .= '<li>' . __('Changed Check whether filename or path!', 'download-counter-button') . '</li>';
                $download .= '<li>' . __('Choose the file again, or enter the path manually!', 'download-counter-button') . '</li>';
                $download .= '<li>' . __('Refresh the page!', 'download-counter-button') . '</li>';
                $download .= '</ul>';

                $download .= '</div>';
            }

            // Powerd start
            if ($settings['copyright'] == 'on') {
                $download .= '<span class="st-download-copy">';
                $download .= __('Powerd by', 'download-counter-button') . ' &copy; <a href="' . esc_url('http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button/') . '" target="_blank">Melibu</a>';
                $download .= '</span>';
            }
            // Powerd end

            $download .= '</div>';
            // Anker end

            $download .= '<!-- MELIBU WP DOWNLOAD COUNTER BUTTON BY SAMET TARIM -->';
            // Download end

            return $download; // return the complete download button or errors
        }

        /**
         * AJAX
         * @global type $wpdb
         */
        public function melibu_down_ajax() {

            if (isset($_POST) && !empty($_POST)) {
                $post = filter_input(INPUT_POST, 'actiontype');
                switch ($post) {
                    case 'check':
                        $return = $this->VALIDATE->val_action();
                        echo $return;
                        break;
                    case 'count':
                        $this->DOWNLOADER->count();
                        break;
                    case 'captcha':
                        $this->VALIDATE->captcha_actually();
                        break;
                    default :
                        break;
                }
            }
        }

        /**
         *  register widgets
         */
        public function widgets_init() {

            require_once MELIBU_PLUGIN_PATH_01 . 'classes/class.MelibuWidget.php';
            /**
             * register_widget() WP Since: 
             * https://codex.wordpress.org/Function_Reference/register_widget
             */
            register_widget('MELIBU_PLUGIN_WIDGET_01');
        }

    }

}
