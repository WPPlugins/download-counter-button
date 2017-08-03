<?php
/**
 * MELIBU SETTINGS
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
    <?php if (isset($_REQUEST['settings-updated']) && false !== $_REQUEST['settings-updated']) : ?>  
        <div class="notice notice-success is-dismissible">
            <p>
                <strong>
                    <?php _e('Settings saved!', 'download-counter-button'); ?>
                </strong>
            </p>
        </div>
    <?php endif; ?>
    <div class="mb-st-grid-12">
        <div class="st-melibuPlugin-area">
            <div class="st_melibuPlugin_list st_melibuPlugin_list_flip">
                <input name="st_melibuPlugin_list_item"
                       id="st_melibuPlugin_list_item_1" 
                       class="st_melibuPlugin_list_item_1" 
                       type="radio" 
                       value="1" 
                       checked="checked">
                <label for="st_melibuPlugin_list_item_1"><span><span class="dashicons dashicons-admin-generic"></span> <?php _e('Settings', 'download-counter-button'); ?></span></label>
                <ul>
                    <li class="st_melibuPlugin_list_item_1">
                        <div class="st_melibuPlugin_list_content">
                            <h2>Button</h2>
                            <table class="wp-list-table widefat fixed striped media">
                                <tr>
                                    <th><?php _e('Description', 'download-counter-button'); ?></th>
                                    <th><?php _e('Basic', 'download-counter-button'); ?></th>
                                    <th><?php _e('Example', 'download-counter-button'); ?></th>
                                </tr>
                                <tr id="mb-doc-infolabel">
                                    <td>
                                        <h3><span class="dashicons dashicons-tag"></span> <?php _e('Label', 'download-counter-button'); ?></h3>
                                        <p>
                                            <?php _e('Here you have to set the possibility.', 'download-counter-button'); ?>
                                        </p>
                                    </td>
                                    <td><?php require_once MELIBU_PLUGIN_PATH_01 . 'html/download/label_option_form.php'; ?></td>
                                    <td><img src="<?php echo MELIBU_PLUGIN_URL_01; ?>img/downloadlabel.png" alt="" width="300" class="st-img"></td>
                                </tr>
                                <tr id="mb-doc-counthide">
                                    <td>
                                        <h3><span class="dashicons dashicons-hidden"></span> <?php _e('Hide Count', 'download-counter-button'); ?></h3>
                                        <p>
                                            <?php _e('Here you can show/hide count for Users. (Only Admin see the counts)', 'download-counter-button'); ?>
                                        </p>
                                    </td>
                                    <td><?php require_once MELIBU_PLUGIN_PATH_01 . 'html/download/hidecount.php'; ?></td>
                                    <td><img src="<?php echo MELIBU_PLUGIN_URL_01; ?>img/downloadcounter.png" alt="" width="300" class="st-img"></td>
                                </tr>
                                <tr id="mb-doc-support">
                                    <td>
                                        <h3><span class="dashicons dashicons-flag"></span> <?php _e('Support us', 'download-counter-button'); ?> </h3>
                                        <p><?php _e('Here you can show/hide', 'download-counter-button'); ?> Copyright - Powerd by &copy; Melibu</p>
                                        <p><?php _e('Please activate this to help us, for share this plugin', 'download-counter-button'); ?></p>
                                    </td>
                                    <td><?php require_once MELIBU_PLUGIN_PATH_01 . 'html/download/copy_option_form.php'; ?></td>
                                    <td><img src="<?php echo MELIBU_PLUGIN_URL_01; ?>img/downloadcopy.png" alt="" width="300" class="st-img"></td>
                                </tr>
                            </table>
                            <h2>Modal</h2>
                            <table class="wp-list-table widefat fixed striped media">
                                <tr>
                                    <th><?php _e('Description', 'download-counter-button'); ?></th>
                                    <th><?php _e('Basic', 'download-counter-button'); ?></th>
                                    <th><?php _e('Example', 'download-counter-button'); ?></th>
                                </tr>
                                <tr id="mb-doc-thanks">
                                    <td>
                                        <h3><span class="dashicons dashicons-welcome-widgets-menus"></span> <?php _e('Thank window', 'download-counter-button'); ?></h3>
                                        <p>
                                            <?php _e('You can, depending on the need, the Thank window on and off.', 'download-counter-button'); ?>
                                        </p>
                                    </td>
                                    <td><?php require_once MELIBU_PLUGIN_PATH_01 . 'html/download/modal_option_form.php'; ?></td>
                                    <td><img src="<?php echo MELIBU_PLUGIN_URL_01; ?>img/modalthanks.png" alt="" width="300" class="st-img"></td>
                                </tr>
                                <tr id="mb-doc-subscribe">
                                    <td>
                                        <h3><span class="dashicons dashicons-email-alt"></span> <?php _e('Subscription', 'download-counter-button'); ?></h3>
                                        <p>
                                            <?php _e('You can activate the subscription feature. Turn this feature on, the user must enter the file downloading an e-mail address.', 'download-counter-button'); ?>
                                        </p>
                                    </td>
                                    <td><?php require_once MELIBU_PLUGIN_PATH_01 . 'html/download/subscribe.php'; ?></td>
                                    <td><img src="<?php echo MELIBU_PLUGIN_URL_01; ?>img/modalsubscribe.png" alt="" width="300" class="st-img"></td>
                                </tr>
                                <tr id="mb-doc-captcha">
                                    <td>
                                        <h3><span class="dashicons dashicons-lock"></span> <?php _e('Captcha', 'download-counter-button'); ?></h3>
                                        <p>
                                            <?php _e('Click here for Malibu Captcha depending on needs on and off', 'download-counter-button'); ?>
                                        </p>
                                    </td>
                                    <td><?php require_once MELIBU_PLUGIN_PATH_01 . 'html/download/captcha.php'; ?></td>
                                    <td><img src="<?php echo MELIBU_PLUGIN_URL_01; ?>img/modalcaptcha.png" alt="" width="300" class="st-img"></td>
                                </tr>
                            </table> 
                            <h2>Widget</h2>
                            <table class="wp-list-table widefat fixed striped media">
                                <tr>
                                    <th><?php _e('Description', 'download-counter-button'); ?></th>
                                    <th><?php _e('Basic', 'download-counter-button'); ?></th>
                                    <th><?php _e('Example', 'download-counter-button'); ?></th>
                                </tr>
                                <tr id="mb-doc-topfive">
                                    <td>
                                        <h3><span class="dashicons dashicons-grid-view"></span> Top 5 Widget</h3>
                                        <p>
                                            <?php _e('Here you can display and hide the information to download', 'download-counter-button'); ?>
                                        </p>
                                    </td>
                                    <td><?php require_once MELIBU_PLUGIN_PATH_01 . 'html/download/topfive.php'; ?></td>
                                    <td><img src="<?php echo MELIBU_PLUGIN_URL_01; ?>img/widgettop5.png" alt="" width="300" class="st-img"></td>
                                </tr>
                            </table>
                            <h2>Protect</h2>
                            <table class="wp-list-table widefat fixed striped media">
                                <tr>
                                    <th><?php _e('Description', 'download-counter-button'); ?></th>
                                    <th><?php _e('Basic', 'download-counter-button'); ?></th>
                                    <th><?php _e('Example', 'download-counter-button'); ?></th>
                                </tr>
                                <tr id="mb-doc-protect">
                                    <td>
                                        <h3><span class="dashicons dashicons-lock"></span> <?php _e('Protection', 'download-counter-button'); ?></h3>
                                        <p>
                                            <?php _e('If you really want to protect a file so that no one can download it with other agents, you have to enable this function. When you do this will no longer be accessible to the entire web space / server this file and can be downloaded only with the WP MeliBu Download Counter button.', 'download-counter-button'); ?>
                                        </p>
                                    </td>
                                    <td><?php require_once MELIBU_PLUGIN_PATH_01 . 'html/download/protect.php'; ?></td>
                                    <td><img src="<?php echo MELIBU_PLUGIN_URL_01; ?>img/forbidden.png" alt="" width="300" class="st-img"></td>
                                </tr>
                            </table>
                            <h2>Others</h2>
                            <table class="wp-list-table widefat fixed striped media">
                                <tr>
                                    <th><?php _e('Description', 'download-counter-button'); ?></th>
                                    <th><?php _e('Basic', 'download-counter-button'); ?></th>
                                    <th><?php _e('Example', 'download-counter-button'); ?></th>
                                </tr>
                                <tr>
                                    <td><h3><span class="dashicons dashicons-flag"></span> <?php _e('Font', 'download-counter-button'); ?></h3><p><?php _e('You can according to your needs the Icons on and off.', 'download-counter-button'); ?></p></td>
                                    <td><?php require_once MELIBU_PLUGIN_PATH_01 . 'html/download/font.php'; ?></td>
                                    <td><img src="<?php echo MELIBU_PLUGIN_URL_01; ?>img/downloadicon.png" alt="" width="300" class="st-img"></td>
                                </tr>
                            </table> 
                            <h2>Plugin</h2>
                            <table class="wp-list-table widefat fixed striped media">
                                <tr>
                                    <th><?php _e('Description', 'download-counter-button'); ?></th>
                                    <th><?php _e('Basic', 'download-counter-button'); ?></th>
                                </tr>
                                <tr>
                                    <td>
                                        <h3><span class="dashicons dashicons-flag"></span> <?php _e('Help us to improve the plugin', 'download-counter-button'); ?></h3>
                                        <p>
                                            <?php _e('Enable error notification report', 'download-counter-button'); ?>
                                        </p>
                                    </td>
                                    <td><?php require_once MELIBU_PLUGIN_PATH_01 . 'html/download/errors.php'; ?></td>
                                </tr>
                            </table>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
