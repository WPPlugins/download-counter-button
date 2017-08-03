<?php
/**
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.1.1
 */
?>
<form method="post" action="options.php">
    <?php settings_fields('melibuPlugin_download_button_modal'); ?>
    <p>
        <input type="checkbox" 
               name="melibuPlugin_get_download_button_modal[onoff]" 
               id="melibuPlugin_get_download_button_modal1" 
               value="on" 
               class="mb_switch"
               <?php checked($settings['modal'], 'on'); ?> />
        <label for="melibuPlugin_get_download_button_modal1"><?php _e('Turn', 'download-counter-button'); ?></label>
    </p>
    <p>
        <input type="submit" 
               value="<?php _e('Save', 'download-counter-button'); ?>" 
               class="button-primary" />
    </p>
    <?php wp_nonce_field('melibuPlugin_download_nonce_action', 'melibuPlugin_download_nonce'); ?>
</form>