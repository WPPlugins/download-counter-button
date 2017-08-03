<?php
/**
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.5.2
 */
$melibuPlugin_get_download_errors = get_option('melibuPlugin_get_download_errors');
$melibu_plugin_download_errors_onoff = 'hide';
if (isset($melibuPlugin_get_download_errors['onoff']) && !empty($melibuPlugin_get_download_errors['onoff'])) {
    $melibu_plugin_download_errors_onoff = $melibuPlugin_get_download_errors['onoff'];
}
?>
<form method="post" action="options.php">
    <?php settings_fields('melibuPlugin_download_errors'); ?>
    <p>
        <input type="checkbox" 
               name="melibuPlugin_get_download_errors[onoff]" 
               id="melibuPlugin_get_download_errors" 
               value="show" 
               class="mb_switch" 
               <?php checked($melibu_plugin_download_errors_onoff, 'show'); ?> />
        <label for="melibuPlugin_get_download_errors"><?php _e('Turn', 'download-counter-button'); ?></label>
    </p>
    <p>
        <input type="submit" 
               value="<?php _e('Save', 'download-counter-button'); ?>" 
               class="button-primary" />
    </p>
    <?php wp_nonce_field('melibuPlugin_download_nonce_action', 'melibuPlugin_download_nonce'); ?>
</form>