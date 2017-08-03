<?php
/**
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.0
 */

// Nonce on modal.php line 76
?>
<h3><span class="dashicons dashicons-format-aside"></span> <?php _e('Thank, Subscribe and Captcha window', 'download-counter-button'); ?></h3>
<p><?php _e('Here you can the Downloader say thank you, give information on the subscription, captcha or more.', 'download-counter-button'); ?></p>
<p>
    <label><?php _e('Title', 'download-counter-button'); ?></label>
    <input type="text" 
           name="melibuPlugin_get_download_button_text[title]" 
           value="<?php echo esc_html($modal['title']); ?>"
           class="mb_input" />
</p>
<p>
    <label><?php _e('Description', 'download-counter-button'); ?></label>
    <textarea name="melibuPlugin_get_download_button_text[text]" 
              class="mb_textarea"><?php echo esc_textarea($modal['description']); ?></textarea>
</p>
