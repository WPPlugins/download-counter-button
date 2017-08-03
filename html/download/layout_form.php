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
    <?php settings_fields('melibuPlugin_download_button_layout'); ?>
    <div class="mb_select_box">
        <label>
            <strong><?php _e('Choose your Layout', 'download-counter-button'); ?></strong>
        </label>
        <select name="melibuPlugin_get_download_button_layout[layout]" 
                class="mb_select">
            <option value="normal" selected="selected"
                    <?php selected($design['layout'], 'normal'); ?>>
                        <?php _e('Normal', 'download-counter-button'); ?>
            </option>
            <option value="user" 
                    <?php selected($design['layout'], 'user'); ?>>
                        <?php _e('User', 'download-counter-button'); ?>
            </option>
            <option value="developer" 
                    <?php selected($design['layout'], 'developer'); ?>>
                        <?php _e('Developer', 'download-counter-button'); ?>
            </option>
            <option value="organisation" 
                    <?php selected($design['layout'], 'organisation'); ?>>
                <?php _e('Organization', 'download-counter-button'); ?> I
            </option>
            <option value="organisation2" 
                    <?php selected($design['layout'], 'organisation2'); ?>>
                <?php _e('Organization', 'download-counter-button'); ?> II
            </option>
            <option value="organisation3" 
                    <?php selected($design['layout'], 'organisation3'); ?>>
                <?php _e('Organization', 'download-counter-button'); ?> III
            </option>
        </select>
        <p>
            <input type="checkbox" 
                   name="melibuPlugin_get_download_button_layout[dashed]" 
                   id="melibuPlugin_get_download_button_layout_dash" 
                   value="st-download-button-dash" 
                   class="mb_switch" 
                   <?php checked($design['dash'], 'st-download-button-dash'); ?> />
            <label for="melibuPlugin_get_download_button_layout_dash"><?php _e('Dashed', 'download-counter-button'); ?></label>
        </p>
<!--        <p>
            <input type="checkbox" 
                   name="melibuPlugin_get_download_button_layout[flated]" 
                   id="melibuPlugin_get_download_button_layout_flat" 
                   value="st-download-button-flat" 
                   class="mb_switch" 
                   <?php // checked($design['flat'], 'st-download-button-dash'); ?> />
            <label for="melibuPlugin_get_download_button_layout_flat"><?php // _e('Flat', 'download-counter-button'); ?></label>
        </p>-->
        <input type="submit" 
               value="<?php _e('Save', 'download-counter-button'); ?>" 
               class="button-primary" />
    </div>
    <?php wp_nonce_field('melibuPlugin_download_nonce_action', 'melibuPlugin_download_nonce'); ?>
</form>