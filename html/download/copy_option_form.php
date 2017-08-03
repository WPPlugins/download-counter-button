<?php
/**
 * FontAwesome
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.6
 */
?>
<form method="post" action="options.php">
    <?php settings_fields('melibu_plugin_download_copy'); ?>
    <p>
        <input type="checkbox" 
               name="melibu_plugin_get_download_copy[onoff]" 
               id="melibu_plugin_get_download_copy" 
               value="on" 
               class="mb_switch" 
               <?php checked($settings['copyright'], 'on'); ?> />
        <label for="melibu_plugin_get_download_copy"><?php _e('Turn', 'download-counter-button'); ?></label>
    </p>
    <p>
        <input type="submit" 
               value="<?php _e('Save', 'download-counter-button'); ?>" 
               class="button-primary" />
    </p>
    <?php wp_nonce_field( 'melibuPlugin_download_nonce_action', 'melibuPlugin_download_nonce' ); ?>
</form>