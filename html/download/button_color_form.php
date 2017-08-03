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
    <?php settings_fields('melibuPlugin_download_button'); ?>
    <div class="mb_select_box">
        <label>
            <strong><?php _e('Button colors', 'download-counter-button'); ?></strong>
        </label>
        <select name="melibuPlugin_get_download_button[color]" 
                class="mb_select">
            <option value="red" <?php selected($design['color'], 'red'); ?> selected="selected">
                <?php _e('Red', 'download-counter-button'); ?>
            </option>
            <option value="red_flat" <?php selected($design['color'], 'red_flat'); ?>>
                <?php _e('Red Flat', 'download-counter-button'); ?>
            </option>
            <option value="orange" <?php selected($design['color'], 'orange'); ?>>
                <?php _e('Orange', 'download-counter-button'); ?>
            </option>
            <option value="orange_flat" <?php selected($design['color'], 'orange_flat'); ?>>
                <?php _e('Orange Flat', 'download-counter-button'); ?>
            </option>
            <option value="yellow" <?php selected($design['color'], 'yellow'); ?>>
                <?php _e('Yellow', 'download-counter-button'); ?>
            </option>
            <option value="yellow_flat" <?php selected($design['color'], 'yellow_flat'); ?>>
                <?php _e('Yellow Flat', 'download-counter-button'); ?>
            </option>
            <option value="green" <?php selected($design['color'], 'green'); ?>>
                <?php _e('Green', 'download-counter-button'); ?>
            </option>
            <option value="green_flat" <?php selected($design['color'], 'green_flat'); ?>>
                <?php _e('Green Flat', 'download-counter-button'); ?>
            </option>
            <option value="blue" <?php selected($design['color'], 'blue'); ?>>
                <?php _e('Blue', 'download-counter-button'); ?>
            </option>
            <option value="bluedark" <?php selected($design['color'], 'bluedark'); ?>>
                <?php _e('Dark Blue', 'download-counter-button'); ?>
            </option>
            <option value="blue_flat" <?php selected($design['color'], 'blue_flat'); ?>>
                <?php _e('Blue Flat', 'download-counter-button'); ?>
            </option>
            <option value="purple" <?php selected($design['color'], 'purple'); ?>>
                <?php _e('Purple', 'download-counter-button'); ?>
            </option>
            <option value="purple_flat" <?php selected($design['color'], 'purple_flat'); ?>>
                <?php _e('Purple Flat', 'download-counter-button'); ?>
            </option>
            <option value="black" <?php selected($design['color'], 'black'); ?>>
                <?php _e('Black', 'download-counter-button'); ?>
            </option>
            <option value="black_flat" <?php selected($design['color'], 'black_flat'); ?>>
                <?php _e('Black Flat', 'download-counter-button'); ?>
            </option>
            <option value="grey" <?php selected($design['color'], 'grey'); ?>>
                <?php _e('Grey', 'download-counter-button'); ?>
            </option>
            <option value="grey_flat" <?php selected($design['color'], 'grey_flat'); ?>>
                <?php _e('Grey Flat', 'download-counter-button'); ?>
            </option>
        </select>
<!--        <p><?php // _e('Background Color', 'download-counter-button'); ?></p>
        <input type="text" name="melibuPlugin_get_download_button[btn-color]" value="<?php // echo $design['btn-color']; ?>" data-default-color="#ffffff" class="melibu-plugin-dcb-btn-color" />
        <div class="melibu-plugin-dcb-btn-colorpicker"></div>
        <p><?php // _e('Text Color', 'download-counter-button'); ?></p>
        <input type="text" name="melibuPlugin_get_download_button[btn-txt-color]" value="<?php // echo $design['btn-txt-color']; ?>" data-default-color="#ffffff" class="melibu-plugin-dcb-btn-txt-color" />
        <div class="melibu-plugin-dcb-btn-txt-colorpicker"></div>-->
        <input type="submit" 
               value="<?php _e('Save', 'download-counter-button'); ?>" 
               class="button-primary" />
    </div>
    <?php wp_nonce_field('melibuPlugin_download_nonce_action', 'melibuPlugin_download_nonce'); ?>
</form>