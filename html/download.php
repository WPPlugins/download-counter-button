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
                <label for="st_melibuPlugin_list_item_1"><span><span class="dashicons dashicons-admin-appearance"></span> <?php _e('Design', 'download-counter-button'); ?></span></label>
                <ul>
                    <li class="st_melibuPlugin_list_item_1">
                        <div class="st_melibuPlugin_list_content">

                            <table class="wp-list-table widefat fixed striped media">
                                <tr>
                                    <th><?php _e('Description', 'download-counter-button'); ?></th>
                                    <th><?php _e('Basic', 'download-counter-button'); ?></th>
                                </tr>
                                <tr>
                                    <td>
                                        <h3><span class="dashicons dashicons-visibility"></span> <?php _e('Preview', 'download-counter-button'); ?></h3>
                                        <p><?php _e('Here you have a preview non active, you can click it.', 'download-counter-button'); ?></p>
                                    </td>
                                    <td>
                                        <?php require_once MELIBU_PLUGIN_PATH_01 . 'html/dummy/dummy.php'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3><span class="dashicons dashicons-format-image"></span> <?php _e('Image & Layout', 'download-counter-button'); ?></h3>
                                        <p>
                                            <?php _e('Here you can set the image and the layout.', 'download-counter-button'); ?>
                                        </p>
                                    </td>
                                    <td>
                                        <div class="pad5 mb-st-grid-12">
                                            <?php require_once MELIBU_PLUGIN_PATH_01 . 'html/download/button_logo_form.php'; ?>
                                        </div> 
                                        <div class="pad5 mb-st-grid-12">
                                            <?php require_once MELIBU_PLUGIN_PATH_01 . 'html/download/layout_form.php'; ?>
                                        </div>
                                        <div class="st_clear"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3><span class="dashicons dashicons-admin-appearance"></span> <?php _e('Colors', 'download-counter-button'); ?></h3>
                                        <p>
                                            <?php _e('Here you have to set the colors.', 'download-counter-button'); ?>
                                        </p>
                                    </td>
                                    <td>
                                        <div class="pad5 mb-st-grid-4">
                                            <?php require_once MELIBU_PLUGIN_PATH_01 . 'html/download/button_icon_color_form.php'; ?>
                                        </div>
                                        <div class="pad5 mb-st-grid-4">
                                            <?php require_once MELIBU_PLUGIN_PATH_01 . 'html/download/button_color_form.php'; ?>
                                        </div>
                                        <div class="pad5 mb-st-grid-4">
                                            <?php require_once MELIBU_PLUGIN_PATH_01 . 'html/download/label_color_form.php'; ?>
                                        </div>
                                        <div class="st_clear"></div>
                                    </td>
                                </tr>
                            </table> 

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
                <span>MeliBu WP Sharing Social Safe</span>
            </h2>
            <p>
                <?php _e("With the MeliBu WP Sharing Social Safe, your content will be shared not only without a warning, but you will also receive statistics. You can also use Optional bitly shortened URLs so your pages and posts are bit-lined so you can track the back link behave. And much more...", 'download-counter-button'); ?>.
            </p>
            <img src="<?php echo plugins_url("img/other/sss.png", dirname(__FILE__)); ?>" alt="MeliBu WP Sharing Social Safe" width="650" class="st-img"/>
            <p><a href='plugin-install.php?s=MeliBu+WP+Sharing+Social+Safe&amp;tab=search&amp;type=term' class='button button-primary'><?php _e('More...', 'download-counter-button'); ?></a></p>
        </div>
    </div>
    <div class="mb-st-grid-3">
        <div class="melibu-postbox postbox st-margin-top-45">
            <h2>
                <span>MeliBu WP Feedback Generate</span>
            </h2>
            <p>
                <?php _e("Our feedback Generate's position all possible forms to create in seconds. Thanks to the sophisticated Melibus Drag N Drop system with live preview you can also see immediately what you are doing. And much more...", 'download-counter-button'); ?>.
            </p>
            <img src="<?php echo plugins_url("img/other/fg.png", dirname(__FILE__)); ?>" alt="MeliBu WP Feedback Generate" width="650" class="st-img"/>
            <p><a href='#' class='button button-primary'><?php _e('Coming soon', 'download-counter-button'); ?></a></p>
        </div>
    </div>
</div>