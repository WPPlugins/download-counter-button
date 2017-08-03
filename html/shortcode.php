<?php
/**
 * MELIBU SHORTCODE
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.7
 */
if (!defined('ABSPATH')) { exit; }

global $MELIBU_PLUGIN_OPTIONS_01;
$melibu_plugin_get_shortcode = $MELIBU_PLUGIN_OPTIONS_01->shortcode();

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
                <label for="st_melibuPlugin_list_item_1"><span><span class="dashicons dashicons-editor-code"></span> <?php _e('Short code', 'download-counter-button'); ?></span></label>
                <ul>
                    <li class="st_melibuPlugin_list_item_1">
                        <div class="st_melibuPlugin_list_content">
                            <h2><?php _e('Short code', 'download-counter-button'); ?></h2>
                            <p><?php _e('Set the short code defaults here', 'download-counter-button'); ?></p>
                            <p>
                                <input ondblclick="this.setSelectionRange(0, this.value.length)" 
                                       id='mb_plugin_download_input' 
                                       class='mb-input' 
                                       type="text" 
                                       value='[wp_mb_plugin_download instance="1" password="<?php echo esc_html($melibu_plugin_get_shortcode['password']); ?>" buttonname="<?php echo esc_html($melibu_plugin_get_shortcode['buttonname']); ?>" name="<?php echo esc_html($melibu_plugin_get_shortcode['labelname']); ?>" datetime="<?php echo get_date_from_gmt(date('Y-m-d H:i:s', time()), get_option('date_format') . ' - ' . get_option('time_format')); ?>" other="<?php echo esc_html($melibu_plugin_get_shortcode['other']); ?>" atagseo="<?php echo esc_html($melibu_plugin_get_shortcode['atagseo']); ?>"]...URL...[/wp_mb_plugin_download]'
                                       readonly="readonly" />
                            </p>
                            <form method="post" action="options.php">
                                <?php settings_fields('melibuPlugin_download_button_default'); ?>
                                <table class="wp-list-table widefat fixed striped media">
                                    <tr>
                                        <th><?php _e('Description', 'download-counter-button'); ?></th>
                                        <th><?php _e('Basic', 'download-counter-button'); ?></th>
                                        <th><?php _e('Example', 'download-counter-button'); ?></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3><span class="dashicons dashicons-admin-network"></span> <?php _e('Password', 'download-counter-button'); ?></h3>
                                            <p><code>password=""</code> <span class="mb-badge"><?php _e('new', 'download-counter-button'); ?></span></p>
                                        </td>
                                        <td>
                                            <input type="text" 
                                                   name="melibuPlugin_get_download_button_default[password]" 
                                                   placeholder="Download password"
                                                   value="<?php echo esc_html($melibu_plugin_get_shortcode['password']); ?>"
                                                   class="mb_input" />
                                        </td>
                                        <td><img src="<?php echo MELIBU_PLUGIN_URL_01; ?>img/downloadpassword.png" alt="" width="300" class="st-img"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3><span class="dashicons dashicons-download"></span> <?php _e('Button name', 'download-counter-button'); ?></h3>
                                            <p><code>buttonname=""</code> <span class="mb-badge"><?php _e('new', 'download-counter-button'); ?></span></p>
                                        </td>
                                        <td>
                                            <input type="text" 
                                                   name="melibuPlugin_get_download_button_default[buttonname]" 
                                                   placeholder="Download button name"
                                                   value="<?php echo esc_html($melibu_plugin_get_shortcode['buttonname']); ?>"
                                                   class="mb_input" />
                                        </td>
                                        <td><img src="<?php echo MELIBU_PLUGIN_URL_01; ?>img/downloadbuttonname.png" alt="" width="300" class="st-img"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3><span class="dashicons dashicons-tag"></span> <?php _e('Label name', 'download-counter-button'); ?></h3>
                                            <p><code>name=""</code></p>
                                        </td>
                                        <td>
                                            <input type="text" 
                                                   name="melibuPlugin_get_download_button_default[name]" 
                                                   placeholder="Download label name"
                                                   value="<?php echo esc_html($melibu_plugin_get_shortcode['labelname']); ?>"
                                                   class="mb_input" />
                                        </td>
                                        <td><img src="<?php echo MELIBU_PLUGIN_URL_01; ?>img/downloadlabelname.png" alt="" width="300" class="st-img"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3><span class="dashicons dashicons-clock"></span> <?php _e('Datetime', 'download-counter-button'); ?></h3>
                                            <p><?php _e('The short code works with the date specified time that you can adjust at any time or have customized in your WP setting', 'download-counter-button'); ?></p>
                                            <p><code>datetime=""</code></p>
                                        </td>
                                        <td>
                                            <p><strong><?php _e('Currently set', 'download-counter-button'); ?>:</strong></p>
                                            <p><?php echo get_date_from_gmt(date('Y-m-d H:i:s', time()), get_option('date_format') . ' - ' . get_option('time_format')); ?></p>
                                            <a href="options-general.php#timezone_string" class="mb-btn"><?php _e('WP Dateime settings', 'download-counter-button'); ?>!</a>
                                        </td>
                                        <td><img src="<?php echo MELIBU_PLUGIN_URL_01; ?>img/downloaddatetime.png" alt="" width="300" class="st-img"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3><span class="dashicons dashicons-carrot"></span> <?php _e('Other', 'download-counter-button'); ?></h3>
                                            <p><code>other=""</code></p>
                                        </td>
                                        <td>
                                            <input type="text" 
                                                   placeholder="Download other infos"
                                                   name="melibuPlugin_get_download_button_default[other]" 
                                                   value="<?php echo esc_html($melibu_plugin_get_shortcode['other']); ?>"
                                                   class="mb_input" />
                                        </td>
                                        <td><img src="<?php echo MELIBU_PLUGIN_URL_01; ?>img/downloadother.png" alt="" width="300" class="st-img"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3><span class="dashicons dashicons-search"></span> <?php _e('Seo', 'download-counter-button'); ?></h3>
                                            <p><code>atagseo=""</code> <span class="mb-badge"><?php _e('new', 'download-counter-button'); ?></span></p>
                                            <p><?php _e('This parameter is the rel tag the same', 'download-counter-button'); ?>. <?php _e('More information about', 'download-counter-button'); ?> <code>rel=""</code> <a href="https://www.w3.org/TR/html5/links.html">W3C</a></p>
                                        </td>
                                        <td>
                                            <input type="text" 
                                                   placeholder="follow or nofollow"
                                                   name="melibuPlugin_get_download_button_default[atagseo]" 
                                                   value="<?php echo esc_html($melibu_plugin_get_shortcode['atagseo']); ?>"
                                                   class="mb_input" />
                                        </td>
                                        <td></td>
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
        </div>
    </div>
</div>