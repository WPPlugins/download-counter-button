<?php
/**
 * MELIBU DOWNLOAD
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.0
 */
if (!defined('ABSPATH')) { exit; }

global $MELIBU_PLUGIN_OPTIONS_01;
$settings = $MELIBU_PLUGIN_OPTIONS_01->settings();
$design = $MELIBU_PLUGIN_OPTIONS_01->design();
$modal = $MELIBU_PLUGIN_OPTIONS_01->modal();

$datas = get_plugin_data(MELIBU_PLUGIN_PATH_01 . 'download-counter-button.php', $markup = true, $translate = true);

// is only the check for update, see on line 34
if (!isset($_REQUEST['settings-updated'])) {
    $_REQUEST['settings-updated'] = false;
}
?>
<div class="wrap">
    <div class="st-wp-brand">
        <h1>
            <img src="<?php echo plugins_url("download-counter-button/img/icon-MB.png"); ?>" alt="icon-MB-20" width="50" class="st-wp-logo"> 
            <?php echo $datas['Name']; ?>
            <span><?php _e('Professional Themes and Plugins for WordPress', 'download-counter-button'); ?></span>
        </h1>
    </div>
    <hr />
    <?php if (false !== $_REQUEST['settings-updated']) : ?>  
        <div class="notice notice-success is-dismissible">
            <p>
                <strong>
                    <?php _e('Settings saved!', 'download-counter-button'); ?>
                </strong>
            </p>
        </div>
    <?php endif; ?>
    <div class="mb-st-grid-9">
        <div class="st-melibuPlugin-area">
            <div class="st_melibuPlugin_list st_melibuPlugin_list_flip">
                <input name="st_melibuPlugin_list_item" 
                       id="st_melibuPlugin_list_item_1" 
                       class="st_melibuPlugin_list_item_1" 
                       type="radio" 
                       value="1" 
                       checked="checked">
                <label for="st_melibuPlugin_list_item_1"><span><span class="dashicons dashicons-exerpt-view"></span> <?php _e('Modal', 'download-counter-button'); ?></span></label>
                <ul>
                    <li class="st_melibuPlugin_list_item_1">
                        <div class="st_melibuPlugin_list_content">
                            <form method="post" action="options.php">
                                <?php settings_fields('melibuPlugin_download_button_text'); ?>
                                <table class="wp-list-table widefat fixed striped media">
                                    <tr>
                                        <th><?php _e('Description', 'download-counter-button'); ?></th>
                                        <th><?php _e('Example', 'download-counter-button'); ?></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php require_once MELIBU_PLUGIN_PATH_01 . 'html/download/modal_text_form.php'; ?>
                                        </td>
                                        <td><img src="<?php echo MELIBU_PLUGIN_URL_01; ?>img/thanks.png" alt="" width="400" class="st-img"></td>
                                    </tr>
                                </table> 
                                <p>
                                    <input type="submit" 
                                           value="<?php _e('Save', 'download-counter-button'); ?>" 
                                           class="button-primary" />
                                </p>
                                <?php wp_nonce_field('melibuPlugin_download_nonce_action', 'melibuPlugin_download_nonce'); ?>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="st-melibu-copy">
                <p class="left">
                    <em><?php _e('Thank you for your confidence in', 'download-counter-button'); ?></em>
                    <a href="http://samet-tarim.de/wordpress/melibu-plugins/"><?php echo $datas['Name']; ?></a> &copy; <?php echo date('Y'); ?>
                </p>
                <p class="right"><?php _e('Version', 'download-counter-button'); ?> <?php echo $datas['Version']; ?></p>
            </div>
        </div>
    </div>
    <div class="mb-st-grid-3">
        <div class="melibu-postbox postbox st-margin-top-45">
            <h2>
                <span>MeliBu WP Syntax High Lighter</span>
            </h2>
            <p>
                <?php _e('Do you know, the MeliBu WP Syntax High Lighter. Turn your code into a highlight in seconds with short codes in WP Texteditor. And very much more...', 'download-counter-button'); ?>.
            </p>
            <img src="<?php echo plugins_url("img/other/shl.png", dirname(__FILE__)); ?>" alt="MeliBu WP Syntax High Lighter" width="650" class="st-img"/>
            <p><a href='plugin-install.php?s=MeliBu+WP+Syntax+High+Lighter+&amp;tab=search&amp;type=term' class='button button-primary'><?php _e('More...', 'download-counter-button'); ?></a></p>
        </div>
    </div>
    <div class="mb-st-grid-3">
        <div class="melibu-postbox postbox st-margin-top-45">
            <h2>
                <span>MeliBu WP Hits</span>
            </h2>
            <p>
                <?php _e('Get more statistics, with the Melibu WP hits. Learn how many clicks you on what download button get, in several graphic banner with detailed information. It supports various plugins Melibu. And very much more...', 'download-counter-button'); ?>.
            </p>
            <img src="<?php echo plugins_url("img/other/hits.jpg", dirname(__FILE__)); ?>" alt="MeliBu WP Hits" width="650" class="st-img"/>
            <p><a href='#' class='button button-primary'><?php _e('Coming soon', 'download-counter-button'); ?></a></p>
        </div>
    </div>
</div>
