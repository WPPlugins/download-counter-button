<?php

/**
 * MELIBU PLUGIN HELPER CLASS
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.7
 */
if (!class_exists('MELIBU_PLUGIN_OPTIONS_01')) {

    class MELIBU_PLUGIN_OPTIONS_01 {

        public function shortcode() {
            
            $collector = array();
            
            $melibuPlugin_get_download_button_default = get_option('melibuPlugin_get_download_button_default');
            $collector['buttonname'] = 'Download';
            if (isset($melibuPlugin_get_download_button_default) && !empty($melibuPlugin_get_download_button_default['buttonname'])) {
                $collector['buttonname'] = $melibuPlugin_get_download_button_default['buttonname'];
            }
            $collector['labelname'] = 'Download Label';
            if (isset($melibuPlugin_get_download_button_default) && !empty($melibuPlugin_get_download_button_default['name'])) {
                $collector['labelname'] = $melibuPlugin_get_download_button_default['name'];
            }
            $collector['other'] = 'v.1.7 (stable)';
            if (isset($melibuPlugin_get_download_button_default) && !empty($melibuPlugin_get_download_button_default['other'])) {
                $collector['other'] = $melibuPlugin_get_download_button_default['other'];
            }
            $collector['atagseo'] = 'tag';
            if (isset($melibuPlugin_get_download_button_default) && !empty($melibuPlugin_get_download_button_default['atagseo'])) {
                $collector['atagseo'] = $melibuPlugin_get_download_button_default['atagseo'];
            }
            $collector['password'] = '';
            if (isset($melibuPlugin_get_download_button_default) && !empty($melibuPlugin_get_download_button_default['password'])) {
                $collector['password'] = $melibuPlugin_get_download_button_default['password'];
            }
            return $collector;
        }

        public function settings() {
            
            $collector = array();
            
            $collector['label'] = 'hide';
            $melibuPlugin_get_download_button_options = get_option('melibuPlugin_get_download_button_options');
            if (isset($melibuPlugin_get_download_button_options['label']) && !empty($melibuPlugin_get_download_button_options['label'])) {
                $collector['label'] = $melibuPlugin_get_download_button_options['label'];
            }
            $collector['counter'] = 'off';
            $melibuPlugin_get_download_button_counthide = get_option('melibuPlugin_get_download_button_counthide');
            if (isset($melibuPlugin_get_download_button_counthide['onoff']) && !empty($melibuPlugin_get_download_button_counthide['onoff'])) {
                $collector['counter'] = $melibuPlugin_get_download_button_counthide['onoff'];
            }
            $collector['subscribe'] = 'off';
            $melibuPlugin_get_download_button_subscriber = get_option('melibuPlugin_get_download_button_subscriber');
            if (isset($melibuPlugin_get_download_button_subscriber['onoff']) && !empty($melibuPlugin_get_download_button_subscriber['onoff'])) {
                $collector['subscribe'] = $melibuPlugin_get_download_button_subscriber['onoff'];
            }
            $collector['subscribename'] = 'off';
            if (isset($melibuPlugin_get_download_button_subscriber['name']) && !empty($melibuPlugin_get_download_button_subscriber['name'])) {
                $collector['subscribename'] = $melibuPlugin_get_download_button_subscriber['name'];
            }
            $collector['captcha'] = 'off';
            $melibuPlugin_get_download_button_captcha = get_option('melibuPlugin_get_download_button_captcha');
            if (isset($melibuPlugin_get_download_button_captcha['onoff']) && !empty($melibuPlugin_get_download_button_captcha['onoff'])) {
                $collector['captcha'] = $melibuPlugin_get_download_button_captcha['onoff'];
            }
            $collector['modal'] = 'off';
            $melibuPlugin_get_download_button_modal = get_option('melibuPlugin_get_download_button_modal');
            if (isset($melibuPlugin_get_download_button_modal['onoff']) && !empty($melibuPlugin_get_download_button_modal['onoff'])) {
                $collector['modal'] = $melibuPlugin_get_download_button_modal['onoff'];
            }
            $collector['topfive'] = 'off';
            $melibuPlugin_get_download_button_top = get_option('melibuPlugin_get_download_button_top');
            if (isset($melibuPlugin_get_download_button_top['top']) && !empty($melibuPlugin_get_download_button_top['top'])) {
                $collector['topfive'] = $melibuPlugin_get_download_button_top['top'];
            }
            $collector['protect'] = 'no';
            if (isset($melibuPlugin_get_download_button_top['protect']) && !empty($melibuPlugin_get_download_button_top['protect'])) {
                $collector['protect'] = $melibuPlugin_get_download_button_top['protect'];
            }
            $collector['font'] = 'off';
            $melibuPlugin_get_download_button_fontawesome = get_option('melibuPlugin_get_download_button_fontawesome');
            if (isset($melibuPlugin_get_download_button_fontawesome['frontonoff']) && !empty($melibuPlugin_get_download_button_fontawesome['frontonoff'])) {
                $collector['font'] = $melibuPlugin_get_download_button_fontawesome['frontonoff'];
            }
            $collector['copyright'] = 'off';
            $melibuPlugin_get_download_copy = get_option('melibu_plugin_get_download_copy');
            if (isset($melibuPlugin_get_download_copy['onoff']) && !empty($melibuPlugin_get_download_copy['onoff'])) {
                $collector['copyright'] = $melibuPlugin_get_download_copy['onoff'];
            }
            return $collector;
        }

        public function design() {
            
            $collector = array();
            
            $collector['layout'] = 'normal';
            $melibuPlugin_get_download_button_layout = get_option('melibuPlugin_get_download_button_layout');
            if (isset($melibuPlugin_get_download_button_layout) && !empty($melibuPlugin_get_download_button_layout['layout'])) {
                $collector['layout'] = $melibuPlugin_get_download_button_layout['layout'];
            }
            $collector['logo'] = '';
            $melibuPlugin_get_download_button_logo = get_option('melibuPlugin_get_download_button_logo');
            if (isset($melibuPlugin_get_download_button_logo) && !empty($melibuPlugin_get_download_button_logo['url'])) {
                $collector['logo'] = $melibuPlugin_get_download_button_logo['url'];
            }
            $collector['color'] = 'grey';
            $melibuPlugin_get_download_button_color = get_option('melibuPlugin_get_download_button');
            if (isset($melibuPlugin_get_download_button_color['color']) && !empty($melibuPlugin_get_download_button_color['color'])) {
                $collector['color'] = $melibuPlugin_get_download_button_color['color'];
            }
            $collector['btn-color'] = 'grey';
            if (isset($melibuPlugin_get_download_button_color['btn-color']) && !empty($melibuPlugin_get_download_button_color['btn-color'])) {
                $collector['btn-color'] = $melibuPlugin_get_download_button_color['btn-color'];
            }
            $collector['btn-txt-color'] = 'grey';
            if (isset($melibuPlugin_get_download_button_color['btn-txt-color']) && !empty($melibuPlugin_get_download_button_color['btn-txt-color'])) {
                $collector['btn-txt-color'] = $melibuPlugin_get_download_button_color['btn-txt-color'];
            }
            $collector['icon-color'] = 'grey';
            $melibuPlugin_get_download_button_icon_color = get_option('melibuPlugin_get_download_button_icon');
            if (isset($melibuPlugin_get_download_button_icon_color['color']) && !empty($melibuPlugin_get_download_button_icon_color['color'])) {
                $collector['icon-color'] = $melibuPlugin_get_download_button_icon_color['color'];
            }
            $collector['btn-icon-color'] = 'grey';
            if (isset($melibuPlugin_get_download_button_icon_color['btn-icon-color']) && !empty($melibuPlugin_get_download_button_icon_color['btn-icon-color'])) {
                $collector['btn-icon-color'] = $melibuPlugin_get_download_button_icon_color['btn-icon-color'];
            }
            $collector['btn-icon-txt-color'] = 'grey';
            if (isset($melibuPlugin_get_download_button_icon_color['btn-icon-txt-color']) && !empty($melibuPlugin_get_download_button_icon_color['btn-icon-txt-color'])) {
                $collector['btn-icon-txt-color'] = $melibuPlugin_get_download_button_icon_color['btn-icon-txt-color'];
            }
            $collector['labelcolor'] = 'light';
            $melibuPlugin_download_button_drop = get_option('melibuPlugin_get_download_button_drop');
            if (isset($melibuPlugin_download_button_drop) && !empty($melibuPlugin_download_button_drop['color'])) {
                $collector['labelcolor'] = $melibuPlugin_download_button_drop['color'];
            }
            $collector['dash'] = 'off';
            if (isset($melibuPlugin_get_download_button_layout['dashed']) && !empty($melibuPlugin_get_download_button_layout['dashed'])) {
                $collector['dash'] = $melibuPlugin_get_download_button_layout['dashed'];
            }
            $collector['flat'] = 'off';
            if (isset($melibuPlugin_get_download_button_layout['flated']) && !empty($melibuPlugin_get_download_button_layout['flated'])) {
                $collector['flat'] = $melibuPlugin_get_download_button_layout['flated'];
            }
            return $collector;
        }

        public function modal() {
            
            $collector = array();
            
            $melibuPlugin_get_download_button_text = get_option('melibuPlugin_get_download_button_text');
            $collector['title'] = '';
            if (isset($melibuPlugin_get_download_button_text['title']) && !empty($melibuPlugin_get_download_button_text['title'])) {
                $collector['title'] = $melibuPlugin_get_download_button_text['title'];
            }
            $collector['description'] = '';
            if (isset($melibuPlugin_get_download_button_text['text']) && !empty($melibuPlugin_get_download_button_text['text'])) {
                $collector['description'] = $melibuPlugin_get_download_button_text['text'];
            }
            $collector['ads'] = '';
            if (isset($melibuPlugin_get_download_button_text['ads']) && !empty($melibuPlugin_get_download_button_text['ads'])) {
                $collector['ads'] = $melibuPlugin_get_download_button_text['ads'];
            }
            return $collector;
        }

    }

    global $MELIBU_PLUGIN_OPTIONS_01;
    $MELIBU_PLUGIN_OPTIONS_01 = new MELIBU_PLUGIN_OPTIONS_01();
}
