<?php 
/**
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.3.7
 */
$melibuPlugin_get_download_button_logo = get_option('melibuPlugin_get_download_button_logo');
?>
<form method="post" action="options.php" enctype="multipart/form-data">
    <?php settings_fields('melibuPlugin_download_button_logo'); ?>
    <div class="st_download_custom_upload">
        <div class="st_download_logo_upload">
            <img src="<?php
            if (isset($melibuPlugin_get_download_button_logo['url'])) {
                echo $melibuPlugin_get_download_button_logo['url'];
            }
            ?>" alt="Melibu WP Download Counter Button Logo" width="50" />
            <label for="file_upload"><?php _e('You can set here a image for your download button.', 'download-counter-button'); ?></label>
            <input type="file" id="file_upload" name="melibuPlugin_get_download_button_logo" />
        </div>
    </div>
    <p>
        <small><?php _e('You can delete the actually image, save without select a image.', 'download-counter-button'); ?></small>
    </p>
    <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Save', 'download-counter-button'); ?>" />
    </p>
    <?php wp_nonce_field('melibuPlugin_download_nonce_action', 'melibuPlugin_download_nonce'); ?>
</form>