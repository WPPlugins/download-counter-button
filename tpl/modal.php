<?php
/**
 * MELIBU MODAL
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.4.9
 */
?>
<!--MELIBU WP DOWNLOAD COUNTER BUTTON MODAL START-->
<!--MODAL CLOSER START-->
<div id="modal-closer">
    <?php if (isset($melibu_plugin_dcb_modal_mode) && $melibu_plugin_dcb_modal_mode == 'nonjs') { ?>
        <!--MODAL WITH OUT JS START-->
        <div class="mb-modal-without-js">
        <?php } else { ?>
            <!--MODAL WITH JS START-->
            <div class="mb-modal">
            <?php } ?>
            <!--MODAL DIALOG START-->
            <div class="mb-modal-dialog">
                <?php if (isset($melibu_plugin_dcb_modal_mode) && $melibu_plugin_dcb_modal_mode == 'nonjs') { ?>
                    <!--MODAL FORM START-->
                    <?php if ($melibu_plugin_dcb_rest['Type'] != 'No Type (url extern)') { ?>
                        <form method="post" action="<?php echo filter_input(INPUT_SERVER, "REQUEST_URI"); ?>">
                        <?php } else { ?>
                            <form method="post" action="<?php echo esc_url($melibu_plugin_dcb_rest['Url']); ?>">
                            <?php } ?>
                        <?php } ?>
                        <!--MODAL HEADER START-->
                        <div class="mb-modal-header">
                            <!--MODAL TITLE START-->
                            <h3> <?php ($melibu_plugin_dcb_modal['title'] != '') ? esc_html_e($melibu_plugin_dcb_modal['title']) : _e('Download', 'download-counter-button'); ?></h3>
                            <!--MODAL TITLE END-->
                        </div>
                        <!--MODAL HEADER END-->
                        <!--MODAL BODY START-->
                        <div class="mb-modal-body">
                            <!--MODAL DESCRIPTION START-->
                            <p><?php ($melibu_plugin_dcb_modal['description'] != '') ? esc_html_e($melibu_plugin_dcb_modal['description']) : _e('Thank you for your download, we hope you are satisfied with our software.', 'download-counter-button'); ?></p>
                            <!--MODAL DESCRIPTION END-->
                            <!--MODAL ADS START-->
                            <div class="mb-modal-ads"><?php echo balanceTags($melibu_plugin_dcb_modal['ads'], true); ?></div>
                            <!--MODAL ADS END-->
                            <!--MODAL ERRORS START-->
                            <div class="mb-modal-errors"><?php
                                if (isset($melibu_plugin_dcb_modal_mode) && $melibu_plugin_dcb_modal_mode == 'nonjs') {
                                    if ('true' != $melibu_plugin_dcb_return) {
                                        echo esc_html($melibu_plugin_dcb_return); // Show errors
                                    }
                                }
                                ?></div>
                            <!--MODAL ERRORS END-->
                            <!--MODAL LOAD START-->
                            <div class="melibu-download-loading"></div>
                            <!--MODAL LOAD END-->
                            <!--MODAL SUBSCRIBER START-->
                            <div class="mb-download-subscribe">
                                <?php
                                // Create POST download
                                if (isset($melibu_plugin_dcb_modal_mode) && $melibu_plugin_dcb_modal_mode == 'nonjs') {
                                    ?>
                                    <input type="hidden" name="mbcountdown" value="1" />
                                    <input type="hidden" name="url" value="<?php echo esc_url(urlencode($melibu_plugin_dcb_rest['Url'])); ?>" />
                                    <input type="hidden" name="type" value="<?php echo esc_html($melibu_plugin_dcb_rest['Type']); ?>" />
                                    <input type="hidden" name="ins" value="<?php echo esc_html($melibu_plugin_dcb_rest['Instance']); ?>" />
                                    <input type="hidden" name="btn" value="<?php echo esc_html($melibu_plugin_dcb_rest['Btn']); ?>" />
                                    <input type="hidden" name="size" value="<?php echo esc_html($melibu_plugin_dcb_rest['Size']); ?>" />
                                    <input type="hidden" name="rel" value="<?php echo esc_html($melibu_plugin_dcb_rest['Ategseo']); ?>" />
                                    <input type="hidden" name="pass" value="<?php echo esc_html($melibu_plugin_dcb_rest['Pass']); ?>" />
                                    <input type="hidden" name="subscribe" value="<?php echo esc_html($melibu_plugin_dcb_settings['subscribe']); ?>" />
                                    <input type="hidden" name="upo" value="<?php echo esc_html($melibu_plugin_dcb_settings['subscribename']); ?>" />
                                    <input type="hidden" name="cpo" value="<?php echo esc_html($melibu_plugin_dcb_settings['captcha']); ?>" />
                                    <?php
                                }
                                ?>
                                <?php if ($melibu_plugin_dcb_settings['subscribe'] == 'on') { // If Subscribe ON  ?>
                                    <?php if ($melibu_plugin_dcb_settings['subscribename'] == 'on') { // If User ON     ?>
                                        <!--MODAL NAME START-->
                                        <label class="mb-subscribe-field">
                                            <input type="text" name="user" autocomplete="off" placeholder="<?php _e('Enter your Name', 'download-counter-button'); ?>" class="mb-modal-subscribe-user" />
                                        </label>
                                        <!--MODAL NAME END-->
                                    <?php } ?>
                                    <!--MODAL MAIL START-->
                                    <label class="mb-subscribe-field">
                                        <input type="text" name="mail" autocomplete="off" placeholder="<?php _e('Enter your E-Mail', 'download-counter-button'); ?>" class="mb-modal-subscribe-mail" />
                                    </label>
                                    <!--MODAL MAIL END-->
                                <?php } ?>
                                <?php
                                $display = 'none';
                                if (isset($melibu_plugin_dcb_rest) && $melibu_plugin_dcb_rest['Pass'] != '') {
                                    $display = 'block';
                                }
                                ?>
                                <!--MODAL PASSWORD START-->  
                                <label class="mb-password-field">
                                    <input style="<?php echo $display; ?>" type="text" name="passcheck" autocomplete="off" placeholder="<?php _e('Enter your Password', 'download-counter-button'); ?>" class="mb-modal-password" />
                                </label>
                                <!--MODAL PASSWORD END-->
                            </div>
                            <!--MODAL SUBSCRIBER END-->
                            <!--MODAL CAPTCHA START-->
                            <div class="mb-download-captcha">
                                <?php if ($melibu_plugin_dcb_settings['captcha'] == 'on') { // If Captcha ON     ?>
                                    <!--MODAL CAPTCHA FIELD START-->
                                    <div class="mb-captcha-field">
                                        <input type="hidden" class="mb-captcha-reload" value="" />
                                        <img src="<?php echo MELIBU_PLUGIN_URL_01 . "functions/other/captcha.php"; ?>" id="mb-captcha" alt="Captcha"/>
                                        <?php if (isset($melibu_plugin_dcb_modal_mode) && $melibu_plugin_dcb_modal_mode == 'nonjs') { ?>
                                            <!--MODAL CAPTCHA CODE START-->
                                            <label for="securitycode">
                                                <a class="mb-captcode" href="<?php echo esc_url(filter_input(INPUT_SERVER, "REQUEST_URI")); ?>">
                                                    <span class="refresh-captcha">
                                                        <?php if ($melibu_plugin_dcb_settings['font'] == 'dashicons') { ?>
                                                            <span class="dashicons dashicons-update"></span>
                                                        <?php } else if ($melibu_plugin_dcb_settings['font'] == 'fontawesome' || $melibu_plugin_dcb_settings['font'] == 'on') { ?>
                                                            <i class="fa fa-refresh"></i>
                                                        <?php } ?>
                                                    </span>
                                                </a>
                                            </label>
                                            <!--MODAL CAPTCHA CODE END-->
                                        <?php } else { ?>
                                            <!--MODAL CAPTCHA CODE START-->
                                            <label for="securitycode" class="mb-captcode">
                                                <span class="refresh-captcha">
                                                    <?php if ($melibu_plugin_dcb_settings['font'] == 'dashicons') { ?>
                                                        <span class="dashicons dashicons-update"></span>
                                                    <?php } else if ($melibu_plugin_dcb_settings['font'] == 'fontawesome' || $melibu_plugin_dcb_settings['font'] == 'on') { ?>
                                                        <i class="fa fa-refresh"></i>
                                                    <?php } ?>
                                                </span>
                                            </label>
                                            <!--MODAL CAPTCHA CODE END-->
                                        <?php } ?>
                                        <!--MODAL CAPTCHA ENTER START-->
                                        <label class="mb-captcha-enter-field">
                                            <input type="text" name="captcha" autocomplete="off" id="securitycode" class="mb-captcha-code" placeholder="<?php _e('Enter Code', 'download-counter-button'); ?>">
                                        </label>
                                        <!--MODAL CAPTCHA ENTER END-->
                                    </div>
                                    <!--MODAL CAPTCHA FIELD END-->
                                    <?php
                                    if ($melibu_plugin_dcb_settings['copyright'] == 'on') {
                                        ?>
                                        <!--MODAL COPY START-->
                                        <div class="st-download-copy">
                                            <?php _e('Powerd by', 'download-counter-button'); ?> &copy; <a href="http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button/" target="_blank">Melibu</a>
                                        </div>
                                        <!--MODAL COPY END-->
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <!--MODAL CAPTCHA END-->
                        </div>
                        <!--MODAL BODY END-->
                        <!--MODAL FOOTER START-->
                        <div class="mb-modal-footer">
                            <!--MODAL CANCEL START-->
                            <a href="#modal-closer" class="mb-modal-cancel"><?php _e('Cancel', 'download-counter-button'); ?></a>
                            <!--MODAL CANCEL END-->
                            <!--MODAL DOWNLOAD START-->
                            <?php if (isset($melibu_plugin_dcb_modal_mode) && $melibu_plugin_dcb_modal_mode == 'nonjs') { ?>
                                <?php if ($melibu_plugin_dcb_settings['subscribe'] == 'on' OR $melibu_plugin_dcb_settings['captcha'] == 'on' OR $melibu_plugin_dcb_rest['Pass'] != '') { ?>
                                    <input type="submit" value="<?php _e('Click here to download', 'download-counter-button'); ?>" />
                                <?php } else { ?>
                                    <input type="submit" value="<?php _e('Click here to download', 'download-counter-button'); ?>" />
                                <?php } ?>
                            <?php } else { ?>
                                <?php if ($melibu_plugin_dcb_settings['subscribe'] == 'on' OR $melibu_plugin_dcb_settings['captcha'] == 'on') { ?>
                                    <a href="#subscribe" id="mb-dcb-abs-download" class="mb-modal-subscribe-btn blue"><?php _e('Click here to download', 'download-counter-button'); ?></a>
                                <?php } else { ?>
                                    <a href="#download" id="mb-dcb-abs-download" class="mb-modal-download-btn blue"><?php _e('Click here to download', 'download-counter-button'); ?></a>
                                <?php } ?>
                            <?php } ?>
                            <!--MODAL DOWNLOAD END-->
                        </div>
                        <!--MODAL FOOTER END-->
                        <?php if (isset($melibu_plugin_dcb_modal_mode) && $melibu_plugin_dcb_modal_mode == 'nonjs') { ?>
                        </form>
                        <!--MODAL FORM END-->
                    <?php } ?>
            </div>
            <!--MODAL DIALOG END-->
        </div>
        <!--MODAL WITH OUT JS END-->
    </div>
    <!--MODAL CLOSER END-->
    <!--MELIBU WP DOWNLOAD COUNTER BUTTON MODAL END-->
    <?php
    