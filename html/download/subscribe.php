<?php
/**
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.4.5
 */
?>
<form method="post" action="options.php">
    <?php settings_fields('melibuPlugin_download_button_subscriber'); ?>
    <p>
        <input type="checkbox" 
               name="melibuPlugin_get_download_button_subscriber[onoff]" 
               id="melibuPlugin_get_download_button_subscriber1" 
               value="on" 
               class="mb_switch" 
               <?php checked($settings['subscribe'], 'on'); ?> />
        <label for="melibuPlugin_get_download_button_subscriber1"><?php _e('Turn', 'download-counter-button'); ?></label>
    </p>
    <p>
        <input type="checkbox" 
               name="melibuPlugin_get_download_button_subscriber[name]" 
               id="melibuPlugin_get_download_button_subscriber2" 
               value="on" 
               class="mb_switch" 
               <?php checked($settings['subscribename'], 'on'); ?> />
        <label for="melibuPlugin_get_download_button_subscriber2"><?php _e('Turn with Name', 'download-counter-button'); ?></label>
    </p>
    <p>
        <input type="submit" 
               value="<?php _e('Save', 'download-counter-button'); ?>" 
               class="button-primary" />
    </p>
    <?php wp_nonce_field('melibuPlugin_download_nonce_action', 'melibuPlugin_download_nonce'); ?>
</form>