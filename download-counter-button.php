<?php

/*
  Plugin Name: MeliBu WP Download Counter Button
  Plugin URI:  http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
  Description: This plugin was developed to him to be serve your <strong>DOWNLOADS</strong>. We hope that it would be purposeful fulfilled and fun turn have so offer your downloads. On a successful download. Rate this plugin <a href="https://wordpress.org/support/view/plugin-reviews/download-counter-button">MeliBu WP Download Counter Button</a> we welcome any support. Your Melibu Team
  Version:     1.8.6.6
  Author:      Samet Tarim
  Author URI:  http://samet-tarim.de/
  Text Domain: download-counter-button
  Domain Path: /languages/
  License:     GPLv2
  License URI: https://www.gnu.org/licenses/gpl-2.0.html

  MeliBu WP Download Counter Button is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 2 of the License, or
  any later version.

  MeliBu WP Download Counter Button is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with MeliBu WP Download Counter Button. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

// SECURE SCRIPT ///////////////////////////////////////////////////////////////

if (!defined('ABSPATH')) {
    exit;
}

// DEFINE //////////////////////////////////////////////////////////////////////

if (!defined('MELIBU_PLUGIN_PATH_01')) {
    define('MELIBU_PLUGIN_PATH_01', plugin_dir_path(__FILE__));
}

if (!defined('MELIBU_PLUGIN_URL_01')) {
    define('MELIBU_PLUGIN_URL_01', plugin_dir_url(__FILE__));
}

define('FS_CHMOD_DIR', (0755 & ~ umask()));
define('FS_CHMOD_FILE', (0644 & ~ umask()));

require_once MELIBU_PLUGIN_PATH_01 . 'classes/other/class.MelibuErrors.php';

// Check if class
if (class_exists('MELIBU_PLUGIN_DOWNLOAD_ERRORS')) {

    $melibu_plugin_dcb_error = new MELIBU_PLUGIN_DOWNLOAD_ERRORS();
}

// DEFINE GLOBALS //////////////////////////////////////////////////////////////

global $MELIBU_PLUGIN_BACKEND_01,
 $MELIBU_PLUGIN_FRONTEND_01,
 $MELIBU_PLUGIN_VALIDATE_01,
 $MELIBU_PLUGIN_DOWNLOADER_01,
 $melibu_plugin_dcb_error;

// LOAD BACKEND ////////////////////////////////////////////////////////////////
// Check Admin
if (is_admin()) {

    // Require Backend Classes
    require_once MELIBU_PLUGIN_PATH_01 . 'classes/class.MelibuBackend.php';
    require_once MELIBU_PLUGIN_PATH_01 . 'classes/pager/class.Downloads.php'; // Download Overview
    require_once MELIBU_PLUGIN_PATH_01 . 'classes/pager/class.Subscriber.php'; // Subscriber Overview
    // Check if class
    if (class_exists('MELIBU_PLUGIN_BACKEND_01')) {

        // Instantiate the plugin class backend
        $MELIBU_PLUGIN_BACKEND_01 = new MELIBU_PLUGIN_BACKEND_01();

        // Installation and uninstallation hooks
        register_activation_hook(__FILE__, array('MELIBU_PLUGIN_BACKEND_01', 'activate'));
        register_deactivation_hook(__FILE__, array('MELIBU_PLUGIN_BACKEND_01', 'deactivate'));
        register_uninstall_hook(__FILE__, array('MELIBU_PLUGIN_BACKEND_01', 'uninstall'));
    }

    // Add a link to the settings page onto the plugin page
    if (isset($MELIBU_PLUGIN_BACKEND_01)) {

        // Add the settings link to the plugins page
        function melibu_plugin_settings_01_link($links) {

            $melibu_plugin_donwload_setting_link = '<a href="admin.php?page=melibu-plugin-download-admin-control-menu-1">' . __('Options', 'download-counter-button') . '</a>';
            array_unshift($links, $melibu_plugin_donwload_setting_link);
            return $links;
        }

        $melibu_plugin_donwload_setting_button = plugin_basename(__FILE__);
        add_filter("plugin_action_links_$melibu_plugin_donwload_setting_button", 'melibu_plugin_settings_01_link');
    }
}

// LOAD FRONTEND ///////////////////////////////////////////////////////////////
// Require Frontend Class
require_once MELIBU_PLUGIN_PATH_01 . 'classes/class.MelibuFrontend.php';
require_once MELIBU_PLUGIN_PATH_01 . 'classes/class.MelibuHelper.php';
require_once MELIBU_PLUGIN_PATH_01 . 'classes/class.MelibuValidate.php';
require_once MELIBU_PLUGIN_PATH_01 . 'classes/class.MelibuDownloader.php';
require_once MELIBU_PLUGIN_PATH_01 . 'classes/class.MelibuOptions.php';
require_once MELIBU_PLUGIN_PATH_01 . 'classes/class.MelibuSecure.php';

// Check if class
if (class_exists('MELIBU_PLUGIN_FRONTEND_01')) {

    // Instantiate the plugin class frontend
    $MELIBU_PLUGIN_FRONTEND_01 = new MELIBU_PLUGIN_FRONTEND_01();
}