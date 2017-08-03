<?php
/**
 * MELIBU WELCOME
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
$melibuPlugin_get_download_button_default_date_format = get_date_from_gmt(date('Y-m-d H:i:s', time()), get_option('date_format') . ' - ' . get_option('time_format'));

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
    <div class="st-wp-brand-box">
        <p>
            <?php _e('Version', 'download-counter-button'); ?>: <?php echo get_option('melibuPlugin_DCB_version'); ?> | DB <?php _e('Version', 'download-counter-button'); ?>: <?php echo get_option('melibuPlugin_DCB_db_version'); ?>
            <span class="st-right" style="text-align: right;">
                <span class="dashicons dashicons-star-filled"></span> <a href="https://wordpress.org/support/plugin/download-counter-button/reviews/" target="_blank">Rate</a> |
                <span class="dashicons dashicons-backup"></span> <a href="https://wordpress.org/plugins/download-counter-button/changelog/" target="_blank">Changelog</a> | 
                <span class="dashicons dashicons-editor-help"></span> <a href="https://wordpress.org/plugins/download-counter-button/faq/" target="_blank">FAQ</a> | 
                <span class="dashicons dashicons-sos"></span> <a href="https://wordpress.org/support/plugin/download-counter-button" target="_blank">Support</a>
            </span>
        </p>
    </div>
    <hr />
    <div class="mb-st-grid-9">
        <div class="st-melibuPlugin-area">
            <div class="welcome-panel">

                <div class="welcome-panel-column-container">
                    <p class="about-description">
                        <?php _e('This documentation should help you.', 'download-counter-button'); ?>
                    </p>
                    <br />

                    <div class="melibu-docu">

                        <div class="left-side">
                            <ul>
                                <li class="start st-active">
                                    <div class="st-icon st-active">
                                        <span class="dashicons dashicons-dashboard"></span>
                                    </div>
                                    <?php _e('Start', 'download-counter-button'); ?>
                                </li>
                                <li class="part-1">
                                    <div class="st-icon">
                                        <span class="dashicons dashicons-admin-appearance"></span>
                                    </div>
                                    <?php _e('Design', 'download-counter-button'); ?>
                                </li>
                                <li class="part-2">
                                    <div class="st-icon">
                                        <span class="dashicons dashicons-exerpt-view"></span>
                                    </div>
                                    <?php _e('Modal', 'download-counter-button'); ?>
                                </li>
                                <li class="part-3">
                                    <div class="st-icon">
                                        <span class="dashicons dashicons-admin-users"></span>
                                    </div>
                                    <?php _e('Subscribes', 'download-counter-button'); ?>
                                </li>
                                <li class="part-4">
                                    <div class="st-icon">
                                        <span class="dashicons dashicons-download"></span>
                                    </div>
                                    <?php _e('Downloads', 'download-counter-button'); ?>
                                </li>
                                <li class="part-5">
                                    <div class="st-icon">
                                        <span class="dashicons dashicons-admin-generic"></span>
                                    </div>
                                    <?php _e('Settings', 'download-counter-button'); ?>
                                </li>
                                <li class="part-6">
                                    <div class="st-icon">
                                        <span class="dashicons dashicons-editor-code"></span>
                                    </div>
                                    <?php _e('Short code', 'download-counter-button'); ?>
                                </li>
                            </ul>
                        </div>

                        <div class="border">
                            <div class="line one"></div>
                        </div>

                        <div class="right-side">

                            <div class="first active">
                                <div class="st-icon st-big">
                                    <span class="dashicons dashicons-dashboard"></span>
                                </div>
                                <h1><?php _e('To use Melibu WP Donwload Counter Button properly', 'download-counter-button'); ?></h1>
                                <p><?php _e('Thank you that you use MeliBu WP Donwload Counter Button', 'download-counter-button'); ?>.</p>
                                <img src="<?php echo plugins_url("screenshot-1.jpg", dirname(__FILE__)); ?>" alt="screenshot-1" width="650" class="st-img"/>
                            </div>

                            <div class="second">
                                <div class="st-icon st-big">
                                    <span class="dashicons dashicons-admin-appearance"></span>
                                </div>
                                <h1><?php _e("Let's start now with the button", 'download-counter-button'); ?></h1>
                                <h2><?php _e('Layout', 'download-counter-button'); ?></h2>
                                <p><?php _e('First you have the opportunity to select a predefined template, in the free version are these', 'download-counter-button'); ?>:</p>
                                <ul>
                                    <li><?php _e('Normal', 'download-counter-button'); ?></li>
                                    <li><?php _e('User', 'download-counter-button'); ?></li>
                                    <li><?php _e('Developer', 'download-counter-button'); ?></li>
                                    <li><?php _e('Organization', 'download-counter-button'); ?> I</li>
                                    <li><?php _e('Organization', 'download-counter-button'); ?> II</li>
                                    <li><?php _e('Organization', 'download-counter-button'); ?> III</li>
                                </ul>
                                <h2><?php _e('Colors', 'download-counter-button'); ?></h2>
                                <p><?php _e('After the selection of a template you can now change the colors', 'download-counter-button'); ?>.</p>
                                <h2><?php _e('Logo', 'download-counter-button'); ?></h2>
                                <p><?php _e('Upload your logo to the downloads', 'download-counter-button'); ?>, <?php _e('your logo with every download the label Show', 'download-counter-button'); ?>.</p>
                                <a href="admin.php?page=melibu-plugin-download-admin-control-menu-1" class="mb-btn"><?php _e('Select your download button', 'download-counter-button'); ?>!</a>
                            </div>

                            <div class="third">
                                <div class="st-icon st-big">
                                    <span class="dashicons dashicons-exerpt-view"></span>
                                </div>
                                <h1><?php _e('Modal', 'download-counter-button'); ?></h1>
                                <h2><?php _e('Thank, Subscribe and Captcha window', 'download-counter-button'); ?></h2>
                                <p><?php _e('Give your form an appropriate title and description', 'download-counter-button'); ?></p>
                                <h2><?php _e('ADS', 'download-counter-button'); ?></h2>
                                <p><?php _e('Place your advertising or affiliate program banners', 'download-counter-button'); ?></p>
                                <a href="admin.php?page=melibu-plugin-download-admin-control-menu-2" class="mb-btn"><?php _e('Set it', 'download-counter-button'); ?></a>
                            </div>

                            <div class="fourth">
                                <div class="st-icon st-big">
                                    <span class="dashicons dashicons-admin-users"></span>
                                </div>
                                <h1><?php _e('Subscribers', 'download-counter-button'); ?></h1>
                                <h2><?php _e('Download after enter E-Mail-Address', 'download-counter-button'); ?></h2>
                                <p><?php _e('Activate, Subscribe ask the function to the user when download the settings to enter your email address', 'download-counter-button'); ?>.</p>
                                <h2><?php _e('Download after enter E-Mail-Address and Name', 'download-counter-button'); ?></h2>
                                <p><?php _e('In addition, to require you to enter the name you select this under the settings', 'download-counter-button'); ?>.</p>
                                <a href="admin.php?page=melibu-plugin-download-admin-control-menu-3#mb-doc-subscribe" class="mb-btn"><?php _e('Activate Subscribes', 'download-counter-button'); ?></a>
                                <h2><?php _e('Overview', 'download-counter-button'); ?></h2>
                                <p><?php _e('You get all subscribes in one list and may be consulted at any time', 'download-counter-button'); ?>.</p>
                                <a href="admin.php?page=melibu-plugin-download-admin-control-menu-3" class="mb-btn"><?php _e('Check Subscriber list', 'download-counter-button'); ?></a>
                            </div>

                            <div class="fifth">
                                <div class="st-icon st-big">
                                    <span class="dashicons dashicons-download"></span>
                                </div>
                                <h1><?php _e('Downloads', 'download-counter-button'); ?></h1>
                                <h2><?php _e('Overview', 'download-counter-button'); ?></h2>
                                <p><?php _e('You get all downloads in one list and may be consulted at any time', 'download-counter-button'); ?>.</p>
                                <a href="admin.php?page=melibu-plugin-download-admin-control-menu-4" class="mb-btn"><?php _e('Check download list', 'download-counter-button'); ?></a>
                            </div>

                            <div class="sixth">
                                <div class="st-icon st-big">
                                    <span class="dashicons dashicons-admin-generic"></span>
                                </div>
                                <h1><?php _e('Settings', 'download-counter-button'); ?></h1>
                                <h2><?php _e('Download after enter Captcha', 'download-counter-button'); ?></h2>
                                <p><?php _e('Activate a Captcha, which must then be entered for each download', 'download-counter-button'); ?>.</p>
                                <a href="admin.php?page=melibu-plugin-download-admin-control-menu-5#mb-doc-captcha" class="mb-btn"><?php _e('Activate captcha', 'download-counter-button'); ?></a>
                                <h2><?php _e('Full file protection', 'download-counter-button'); ?></h2>
                                <p><?php _e('Activate a protect, which must then be entered for each download', 'download-counter-button'); ?>.</p>
                                <a href="admin.php?page=melibu-plugin-download-admin-control-menu-5#mb-doc-protect" class="mb-btn"><?php _e('Activate protect', 'download-counter-button'); ?></a>
                                <p><?php _e('You can make and optimize with many various settings', 'download-counter-button'); ?>.</p>
                                <a href="admin.php?page=melibu-plugin-download-admin-control-menu-5" class="mb-btn"><?php _e('Set it', 'download-counter-button'); ?></a>
                            </div>

                            <div class="seventh">
                                <div class="st-icon st-big">
                                    <span class="dashicons dashicons-editor-code"></span>
                                </div>
                                <h1><?php _e('Short code', 'download-counter-button'); ?></h1>
                                <p><?php _e('Use the short code in your WP Editor for set your downloads or copy, paste and set manually', 'download-counter-button'); ?>.</p>
                                <div>
                                    <img src="<?php echo MELIBU_PLUGIN_URL_01 . 'screenshot-11.png'; ?>" alt="">
                                    <h2><?php _e('OLD', 'download-counter-button'); ?></h2>
                                    <?php $melibu_plugin_get_shortcode = $MELIBU_PLUGIN_OPTIONS_01->shortcode(); ?>
                                    <code>[download 
                                        instance="xxx" 
                                        name="<?php echo $melibu_plugin_get_shortcode['labelname']; ?>" 
                                        datetime="<?php echo $melibuPlugin_get_download_button_default_date_format; ?>" 
                                        other="<?php echo $melibu_plugin_get_shortcode['other']; ?>"
                                        ]...URL...[/download]
                                    </code>
                                    <h2><?php _e('NEW', 'download-counter-button'); ?></h2>
                                    <code>[wp_mb_plugin_download 
                                        instance="xxx" 
                                        password="xxx"
                                        buttonname="<?php echo $melibu_plugin_get_shortcode['buttonname']; ?>" 
                                        name="<?php echo $melibu_plugin_get_shortcode['labelname']; ?>" 
                                        datetime="<?php echo $melibuPlugin_get_download_button_default_date_format; ?>" 
                                        other="<?php echo $melibu_plugin_get_shortcode['other']; ?>"
                                        atagseo="<?php echo $melibu_plugin_get_shortcode['atagseo']; ?>"
                                        ]...URL...[/wp_mb_plugin_download]
                                    </code>
                                    <ul>
                                        <li>
                                            <strong>[wp_mb_plugin_download ...] (newest version) or [download ...] (the old version)</strong>: <br />
                                            <?php _e('Without this shortcode does not download the old version should be replaced if possible by the latest. Both versions work but could be a fault occur when another plugin also the name download has a shortcode', 'download-counter-button'); ?>.
                                        </li>
                                        <li>
                                            <strong>instance</strong>: <br />
                                            <?php _e('The instance that is controlled single and duplicates each download you must offer individually possess another instance, unless you want to use on a page more identical downloads, then you have the instance and the download URL be the same', 'download-counter-button'); ?>.
                                        </li>
                                        <li>
                                            <strong>password</strong>: <span class="mb-badge"><?php _e('new', 'download-counter-button'); ?></span><br />
                                            <p><?php _e('You can add this parameter you download a password', 'download-counter-button'); ?>.</p>
                                        </li>
                                        <li>
                                            <strong>buttonname</strong>: <span class="mb-badge"><?php _e('new', 'download-counter-button'); ?></span><br />
                                            <p><?php _e('You can choose the Download button name as example "My Download"', 'download-counter-button'); ?>.</p>
                                        </li>
                                        <li>
                                            <strong>name</strong>: <br />
                                            <?php _e('You can choose the Download label name as example "My Download Label"', 'download-counter-button'); ?>.
                                        </li>
                                        <li>
                                            <strong>datetime</strong>: <br />
                                            <?php _e('This is generated automatically when you put the short code, this is the date when you submitted the file available or what you want', 'download-counter-button'); ?>.
                                        </li>
                                        <li>
                                            <strong>other</strong>: <br />
                                            <?php _e('This parameter can, for example, for the version or use something else', 'download-counter-button'); ?>.
                                        </li>
                                        <li>
                                            <strong>atagseo</strong>: <span class="mb-badge"><?php _e('new', 'download-counter-button'); ?></span><br />
                                            <?php _e('This parameter is the rel tag the same, you can see any information for rel tag by the', 'download-counter-button'); ?> <a href="https://www.w3.org/TR/html5/links.html" target="_blank">W3C</a>.
                                        </li>
                                    </ul>
                                    <div class='st-melibuPlugin-area'>
                                        <div class="st-present">
                                            <label for='mb_plugin_download_input'>
                                                <small>
                                                    <?php _e('That is the short code. You can copy a short code and place on a page, post or in a widget. Or use the short code has been integrated into your editor, a click is enough and the part buttons after save visible', 'download-counter-button'); ?>.
                                                </small>
                                            </label><br />
                                            <input ondblclick="this.setSelectionRange(0, this.value.length)" 
                                                   id='mb_plugin_download_input' 
                                                   class='mb-input' 
                                                   type="text" 
                                                   value='[wp_mb_plugin_download instance="1" password="<?php echo $melibu_plugin_get_shortcode['password']; ?>" buttonname="<?php echo $melibu_plugin_get_shortcode['buttonname']; ?>" name="<?php echo $melibu_plugin_get_shortcode['labelname']; ?>" datetime="<?php echo $melibuPlugin_get_download_button_default_date_format; ?>" other="<?php echo $melibu_plugin_get_shortcode['other']; ?>" atagseo="<?php echo $melibu_plugin_get_shortcode['atagseo']; ?>"]...URL...[/wp_mb_plugin_download]'
                                                   readonly="readonly" />
                                            <small><?php _e('Please take the short code double click to copy', 'download-counter-button'); ?></small>
                                        </div>
                                    </div>
                                </div>
                                <p><?php _e('You can set for the short code standard settings', 'download-counter-button'); ?></p>
                                <a href="admin.php?page=melibu-plugin-download-admin-control-menu-6" class="mb-btn"><?php _e('Set it now', 'download-counter-button'); ?>!</a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="mb-st-grid-3">
        <div class="melibu-postbox postbox  st-margin-top-15">
            <img src="<?php echo MELIBU_PLUGIN_URL_01; ?>screenshot-11.png" alt="screenshot-11" width="650">
            <h2><span><?php _e('Use Short code in WP Editor', 'download-counter-button'); ?></span></h2>
            <p><?php _e('Take your part to put the buttons shortcode in WP editor Melibu', 'download-counter-button'); ?>.</p>
        </div>
    </div>
    <div class="mb-st-grid-3">
        <div class="melibu-postbox postbox">
            <img src="<?php echo MELIBU_PLUGIN_URL_01; ?>screenshot-12.png" alt="screenshot-12" width="650">
            <h2><span><?php _e('Use Top 5 Widget', 'download-counter-button'); ?></span></h2>
            <p><?php _e('Use the Top 5 widget to your Top Downloads close attention', 'download-counter-button'); ?><br><a href="http://127.0.0.1/welcomewp/wp-admin/widgets.php">Set</a></p>
        </div>
    </div>
</div>