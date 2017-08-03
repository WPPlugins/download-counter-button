<?php
/**
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.0
 */
?>
<form method="post" action="options.php">
    <?php settings_fields('melibuPlugin_download_button_drop'); ?>
    <div class="mb_select_box">
        <label>
            <strong><?php _e('Label colors', 'download-counter-button'); ?></strong>
        </label>
        <select name="melibuPlugin_get_download_button_drop[color]" 
                class="mb_select">
            <option value="light" <?php selected($design['labelcolor'], 'light' ); ?> selected="selected">
                <?php _e('Light', 'download-counter-button'); ?>
            </option>
            <option value="light_flat" <?php selected($design['labelcolor'], 'light_flat' ); ?>>
                <?php _e('Light Flat', 'download-counter-button'); ?>
            </option>
            <option value="dark" <?php selected($design['labelcolor'], 'dark' ); ?>>
                <?php _e('Dark', 'download-counter-button'); ?>
            </option>
            <option value="dark_flat" <?php selected($design['labelcolor'], 'dark_flat' ); ?>>
                <?php _e('Dark Flat', 'download-counter-button'); ?>
            </option>
            <option value="white" <?php selected($design['labelcolor'], 'white' ); ?>>
                <?php _e('White', 'download-counter-button'); ?>
            </option>
            <option value="white_flat" <?php selected($design['labelcolor'], 'white_flat' ); ?>>
                <?php _e('White Flat', 'download-counter-button'); ?>
            </option>
        </select>
        <input type="submit" 
               value="<?php _e('Save', 'download-counter-button'); ?>" 
               class="button-primary" />
    </div>
    <?php wp_nonce_field( 'melibuPlugin_download_nonce_action', 'melibuPlugin_download_nonce' ); ?>
</form>