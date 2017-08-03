<?php

/**
 * MELIBU PLUGIN WIDGET
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.4.9
 *
 * https://developer.wordpress.org/themes/functionality/widgets/
 */
if (!class_exists('MELIBU_PLUGIN_WIDGET_01')) {

    /**
     * DOWNLOAD WIDGET
     */
    class MELIBU_PLUGIN_WIDGET_01 extends WP_Widget {

        /**
         * Attributes
         * 
         * @var type 
         */
        private $DB = null;

        /**
         * Register widget with WordPress.
         * And get $wpdb to private modus
         */
        public function __construct() {

            global $wpdb;
            $this->DB = $wpdb;
            parent::__construct(
                    'download-counter-button', // Base ID
                    'MB Download (Top 5)', // Name
                    array('description' => __('A MeliBu WordPress Widget by Professionals Developers.', 'download-counter-button'))
            );
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args     Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget($args, $instance) {

            $title = '';
            $text = '';
            $widgetCheckbox1 = '';

            if (isset($instance['widget_title'])) {
                $title = apply_filters('widget_title', $instance['widget_title']);
            }
            if (isset($instance['widget_text'])) {
                $text = apply_filters('widget_text', $instance['widget_text']);
            }
            if (isset($instance['widget_checkbox_1'])) {
                $widgetCheckbox1 = apply_filters('widget_checkbox_1', $instance['widget_checkbox_1']);
            }

            // Widget start
            echo $args['before_widget'];
            if (!empty($title)) {
                echo $args['before_title'] . esc_html($title) . $args['after_title'];
            }
            if (empty($widgetCheckbox1)) {
                $this->get_widget_download();
            }
            if (!empty($text)) {
                echo esc_html($text);
            }
            echo $args['after_widget'];
            // Widget end
        }

        /**
         * 
         */
        public function get_widget_download() {

            global $MELIBU_PLUGIN_DOWNLOADER_01,
            $melibuPluginHelper,
            $MELIBU_PLUGIN_OPTIONS_01,
            $MELIBU_PLUGIN_VALIDATE_01;

            $settings = $MELIBU_PLUGIN_OPTIONS_01->settings();
            $design = $MELIBU_PLUGIN_OPTIONS_01->design();

            $result = $this->DB->get_results("SELECT * "
                    . "FROM " . $this->DB->prefix . "melibu_dcb "
                    . "ORDER BY count "
                    . "DESC "
                    . "LIMIT 5");

            // Create TOP 5 list
            echo '<div class="st-download-widget-list">';
            if ($result) {
                echo '<ul>';
                $count = 1;
                foreach ($result as $rest) {

                    $downloadname = 'Download';
                    if (isset($rest->btn) && !empty($rest->btn)) {
                        $downloadname = esc_html($rest->btn);
                    }

                    $downloadpassword = '';
                    if (isset($rest->pass) && !empty($rest->pass)) {
                        $downloadpassword = esc_html($rest->pass);
                    }

                    $downloadatagseo = 'tag';
                    if (isset($rest->atagseo) && !empty($rest->atagseo)) {
                        $downloadatagseo = esc_html($rest->atagseo);
                    }

                    $mode = 0755; // No subscribe or no captcha then file permission for all
                    if ($settings['subscribe'] == 'on' || $settings['captcha'] == 'on' && $downloadpassword != '') { // With subscribe or captcha
                        $mode = 0644; // If subscribe or captcha then file permission not for all
                    }

                    // create array to get datas
                    $arr = array(
                        "instance" => $rest->instance,
                        "buttonname" => $downloadname,
                        "atagseo" => $downloadatagseo,
                        "password" => $downloadpassword
                    );

                    $restCheck = $MELIBU_PLUGIN_DOWNLOADER_01->return_download_data($rest->url, $arr, $mode); // get download data
                    $return = $MELIBU_PLUGIN_VALIDATE_01->val_action(); // validate
                    // NO JS
                    if (isset($_GET['mbdowncheck']) && $_GET['mbdowncheck'] == "1") {
                        if (isset($_GET['ins']) && $_GET['ins'] == trim($rest->instance)) {
                            $MELIBU_PLUGIN_DOWNLOADER_01->modal_non_js($restCheck, $return);
                        }
                    }
                    // NO JS
                    $noscriptURL = '';
                    if (isset($restCheck['Url'])) {
                        if ($rest->instance > 0) {

                            echo '<li id="mb-dcb-widget-anker' . esc_attr($rest->instance) . '" class="' . esc_attr($design['color']) . '">';
                            echo '<div class="st-download-button-name">';
                            echo '<strong>' . esc_html($count) . '</strong> ';
                            $typeIcon = '';

                            /**
                             * http://www.iana.org/assignments/media-types/media-types.xhtml
                             */
                            if (preg_match('/application\/(.*)/i', $rest->type, $matches)) {

//                                echo '<pre>';
//                                var_dump($matches[1]);
//                                echo '</pre>';

                                switch ($matches[1]) {
                                    case 'zip':
                                        $typeIcon = '&nbsp;<i class="fa fa-1x fa-file-archive-o" aria-hidden="true"></i>';
                                        break;
                                    case 'pdf':
                                        $typeIcon = '&nbsp;<i class="fa fa-1x fa-file-pdf-o" aria-hidden="true"></i>';
                                        break;
                                    case 'javascript':
                                        $typeIcon = '&nbsp;<i class="fa fa-1x fa-file-code-o" aria-hidden="true"></i>';
                                        break;
                                    case 'json':
                                        $typeIcon = '&nbsp;<i class="fa fa-1x fa-file-code-o" aria-hidden="true"></i>';
                                        break;
                                    default:
                                }
                            } else if (preg_match('/audio\/(.*)/i', $rest->type)) {
                                $typeIcon = '&nbsp;<i class="fa fa-1x fa-file-audio-o" aria-hidden="true"></i>';
//                                $audio = $rest->url;
//                                require_once MELIBU_PLUGIN_PATH_01 . 'tpl/tpl.audio.php';
                            } else if (preg_match('/image\/(.*)/i', $rest->type, $matches)) {
                                $typeIcon = '&nbsp;<i class="fa fa-1x fa-file-image-o" aria-hidden="true"></i>';
                            } else if (preg_match('/text\/(.*)/i', $rest->type)) {
                                $typeIcon = '&nbsp;<i class="fa fa-1x fa-file-text-o" aria-hidden="true"></i>';
                            } else if (preg_match('/video\/(.*)/i', $rest->type)) {
                                $typeIcon = '&nbsp;<i class="fa fa-1x fa-file-video-o" aria-hidden="true"></i>';
                            }
                            
                            echo $typeIcon;

                            // Putter and Button name
                            echo '<span class="mb-put' . $rest->instance . '" data-mb-dcb-btnname="' . $downloadname . '" data-mb-dcb-atagseo="' . $downloadatagseo . '" data-mb-dcb-pass="' . $downloadpassword . '">';
                            // No Script part start ////////////////////////////
                            echo '<noscript>';
                            if ($settings['subscribe'] == 'on' OR $settings['captcha'] == 'on' OR $settings['modal'] == 'on' OR $downloadpassword != '') {
                                // Create POST download link
                                $noscriptURL .= $melibuPluginHelper->get_protocol();
                                $noscriptURL .= filter_input(INPUT_SERVER, "HTTP_HOST");
                                $noscriptURL .= strtok(filter_input(INPUT_SERVER, "REQUEST_URI"), '?');
                                $noscriptURL .= '/?mbdowncheck=1';
                                $noscriptURL .= '&ins=' . $rest->instance;
                                $noscriptURL .= '#mb-dcb-widget-anker' . $rest->instance;
                            } else {
                                // Create GET download link
                                $noscriptURL .= $melibuPluginHelper->get_protocol();
                                $noscriptURL .= filter_input(INPUT_SERVER, "HTTP_HOST");
                                $noscriptURL .= strtok(filter_input(INPUT_SERVER, "REQUEST_URI"), '?');
                                $noscriptURL .= '/?mbcountdown=1';
                                $noscriptURL .= '&url=' . urlencode($rest->url);
                                $noscriptURL .= '&type=' . $rest->type;
                                $noscriptURL .= '&size=' . $rest->size;
                                $noscriptURL .= '&ins=' . $rest->instance;
                                $noscriptURL .= '&pass=' . $downloadpassword;
                                $noscriptURL .= '&rel=' . $downloadatagseo;
                                $noscriptURL .= '&btn=' . $downloadname;
                                $noscriptURL .= '#mb-dcb-widget-anker' . $rest->instance;
                            }
                            echo '<a href="' . esc_url($noscriptURL) . '" rel="' . esc_attr($downloadatagseo) . '" title="' . esc_attr($downloadname) . ' (' . esc_attr($rest->count) . ')" class="' . esc_attr($design['dash']) . '" download="download">' . $downloadname;
                            if ($settings['counter'] == 'off' || current_user_can('manage_options')) {
                                echo '&nbsp;<span class="st-display">(' . esc_html($rest->count) . ')</span>';
                            }
                            echo '</a>';
                            echo '</noscript>';
                            // No Script part end //////////////////////////////
                            echo '</span>';
                            echo '</div>';

                            echo '<input type="hidden" name="' . esc_url($rest->url) . '" value="' . esc_html($rest->count) . '" id="' . esc_html($rest->instance) . '" class="mb-instances" readonly="readonly">';

                            echo '<div class="st-download-drop ' . $settings['topfive'] . '">';
                            echo '<div class="mb-drop' . esc_html($rest->instance) . '"><strong>' . esc_html(strtok($rest->name, '?')) . '</strong>';
                            echo '<div class="st-drop-descrip">';
                            echo '<small>';

                            echo '<span class="mb-download-type">' . esc_html($rest->type) . '</span>';
                            echo '&nbsp;&minus;&nbsp;';
                            echo '<span class="mb-download-size">' . esc_html($rest->size) . '</span>';

                            echo '</small>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';

                            echo '</li>';
                        }
                        $count++;
                    } else {

                        echo '<div style="color:red;">';
                        echo '<h3>' . __('Can\'t open file informations', 'download-counter-button') . '</h3>';
                        echo '<div class="st-alert st-alert-warning">';
                        echo '<p>' . esc_url($rest->url) . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                echo '</ul>';
            } else {
                echo '<div class="st-alert st-alert-info">';
                _e('At the moment no top downloads available', 'download-counter-button');
                echo '</div>';
            }

            if ($settings['copyright'] == 'on') {
                echo '<div class="st-copy">';
                _e('Powerd by', 'download-counter-button');
                echo ' &copy; <a href="http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button/" title="Melibu" target="_blank">Melibu</a>';
                echo '</div>';
            }

            echo '</div>';
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance) {

            global $MELIBU_PLUGIN_OPTIONS_01;

            $title = '';
            $text = '';
            $widgetCheckbox1 = '';
            if (isset($instance['widget_title'])) {
                $title = $instance['widget_title'];
            }
            if (isset($instance['widget_text'])) {
                $text = $instance['widget_text'];
            }
            if (isset($instance['widget_checkbox_1'])) {
                $widgetCheckbox1 = $instance['widget_checkbox_1'];
            }

            $melibu_plugin_get_shortcode = $MELIBU_PLUGIN_OPTIONS_01->shortcode();

            echo '<p>';
            echo '<label for="' . $this->get_field_name('widget_title') . '">';
            _e('Title', 'download-counter-button');
            echo '</label>';
            echo '<input type="text" name="' . $this->get_field_name('widget_title') . '" value="' . $title . '" class="widefat" id="' . $this->get_field_id('widget_title') . '" />';
            echo '</p>';

            echo '<p>';
            _e('Select:', 'download-counter-button');
            echo '<br /><input type="checkbox" name="' . $this->get_field_name('widget_checkbox_1') . '" ' . checked($widgetCheckbox1, 'true', false) . ' class="widefat" id="' . $this->get_field_id('widget_checkbox_1') . '" />';
            echo '<label for="' . $this->get_field_id('widget_checkbox_1') . '">';
            _e('Without Top 5', 'download-counter-button');
            echo '</label>';
            echo '</p>';

            if (empty($widgetCheckbox1)) {
                $this->get_form_download();
            }

            echo '<div class="st-copy">';
            _e('Powerd by', 'download-counter-button');
            echo ' &copy; <a href="http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button/" title="Melibu" target="_blank">Melibu</a>';
            echo '</div>';

            echo '<small>';
            _e('Click to Edit and Double Click to copy.', 'download-counter-button');
            echo '</small>';
            echo '<input ondblclick="this.setSelectionRange(0, this.value.length)" 
                           id="mb_plugin_download_input" 
                           class="mb_input" 
                           type="text" 
                           value=\'[wp_mb_plugin_download instance="1" password="' . $melibu_plugin_get_shortcode['password'] . '" buttonname="' . $melibu_plugin_get_shortcode['buttonname'] . '" name="' . $melibu_plugin_get_shortcode['labelname'] . '" datetime="' . get_date_from_gmt(date('Y-m-d H:i:s', time()), get_option('date_format') . ' - ' . get_option('time_format')) . '" other="' . $melibu_plugin_get_shortcode['other'] . '" atagseo="' . $melibu_plugin_get_shortcode['atagseo'] . '"]...URL...[/wp_mb_plugin_download]\' 
                           readonly="readonly" />';
            echo '<p>';
            echo '<label for="' . $this->get_field_id('widget_text') . '">';
            _e('Text & Short Code', 'download-counter-button');
            echo '</label>';
            echo '<textarea name="' . $this->get_field_name('widget_text') . '" class="widefat" id="' . $this->get_field_id('widget_text') . '">' . $text . '</textarea>';
            echo '</p>';
        }

        /**
         * 
         */
        public function get_form_download() {

            $result = $this->DB->get_results("SELECT * FROM " . $this->DB->prefix . "melibu_dcb ORDER BY count DESC LIMIT 5");
            if ($result) {
                echo '<ul>';
                $count = 1;
                foreach ($result as $rest) {
                    echo '<li>' . $count . '. <a href="' . $rest->url . '" traget="_blank">' . $rest->name . ' (' . $rest->count . ')</a></li>';
                    $count++;
                }
                echo '</ul>';
            } else {

                echo '<div>';
                _e('At the moment no top downloads available', 'download-counter-button');
                echo '</div>';
            }
        }

        /**
         * Sanitize widget form values as they are saved.
         *
         * @see WP_Widget::update()
         *
         * @param array $new_instance Values just sent to be saved.
         * @param array $old_instance Previously saved values from database.
         *
         * @return array Updated safe values to be saved.
         */
        public function update($new_instance, $old_instance) {

            $instance = $old_instance;
            $instance['widget_title'] = (!empty($new_instance['widget_title']) ) ? strip_tags($new_instance['widget_title']) : '';
            $instance['widget_text'] = (!empty($new_instance['widget_text']) ) ? strip_tags($new_instance['widget_text']) : '';
            $instance['widget_checkbox_1'] = (!empty($new_instance['widget_checkbox_1'])) ? 'true' : '';
            return $instance;
        }

    }

}