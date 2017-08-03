<?php
/**
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.8.0
 */
?>
<form method="post" action="options.php">
    <?php settings_fields('melibuPlugin_download_button_top'); ?>
    <p>
        <input type="checkbox" 
               name="melibuPlugin_get_download_button_top[protect]" 
               id="melibuPlugin_get_download_button_protect" 
               value="yes" 
               class="mb_switch" 
               <?php checked($settings['protect'], 'yes'); ?> />
        <label for="melibuPlugin_get_download_button_protect"><?php _e('Turn', 'download-counter-button'); ?></label>
    </p>
    <p>
        <input type="submit" 
               value="<?php _e('Save', 'download-counter-button'); ?>" 
               class="button-primary" />
    </p>
    <?php wp_nonce_field('melibuPlugin_download_nonce_action', 'melibuPlugin_download_nonce'); ?>
</form>