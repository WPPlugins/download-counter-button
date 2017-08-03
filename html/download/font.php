<?php
/**
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.0.8
 */
echo $settings['font'];
?>
<form method="post" action="options.php" class="mb_form">
    <?php settings_fields('melibuPlugin_download_button_fontawesome'); ?>
    <h3><?php _e('No Icon', 'download-counter-button'); ?></h3>
    <input type="radio" 
           name="melibuPlugin_get_download_button_fontawesome[frontonoff]" 
           id="melibuPlugin_get_download_button_noicon" 
           value="off" 
           class="mb_switch"
           <?php checked($settings['font'], 'off'); ?> />
    <label for="melibuPlugin_get_download_button_noicon"><?php _e('Turn', 'download-counter-button'); ?></label>
    <h3>WP Dashicons</h3>
    <input type="radio" 
           name="melibuPlugin_get_download_button_fontawesome[frontonoff]" 
           id="melibuPlugin_get_download_button_dashicons" 
           value="dashicons" 
           class="mb_switch"
           <?php checked($settings['font'], 'dashicons'); ?> />
    <label for="melibuPlugin_get_download_button_dashicons"><?php _e('Turn', 'download-counter-button'); ?></label>
    <small><?php _e('More information about', 'download-counter-button'); ?> <a href="https://developer.wordpress.org/resource/dashicons/" target="_blank">WP Dashicons</a>.</small>
    <h3>FontAwesome</h3>
    <input type="radio" 
           name="melibuPlugin_get_download_button_fontawesome[frontonoff]" 
           id="melibuPlugin_get_download_button_fontawesome" 
           value="fontawesome" 
           class="mb_switch"
           <?php checked($settings['font'], 'fontawesome'); ?> />
    <label for="melibuPlugin_get_download_button_fontawesome"><?php _e('Turn', 'download-counter-button'); ?></label>
    <small><?php _e('More information about', 'download-counter-button'); ?> <a href="https://fortawesome.github.io/Font-Awesome/" target="_blank">FontAwesome</a>.</small>
    <input name="st_melibuPlugin_list_item" type="hidden" value="5">
    <p>
        <input type="submit" 
               value="<?php _e('Save', 'download-counter-button'); ?>" 
               class="button-primary" />
    </p>
    <?php wp_nonce_field('melibuPlugin_download_nonce_action', 'melibuPlugin_download_nonce'); ?>
</form>