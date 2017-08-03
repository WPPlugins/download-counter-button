<?php
/**
 * MELIBU Dummy
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.0
 */
$melibuPlugin_get_download_button_logo = get_option('melibuPlugin_get_download_button_logo');
?>
<div class="st-download-button-<?php echo $design['layout']; ?>">

    <div class="st-download-button-icon <?php echo $design['icon-color']; ?>">
        <?php
        // FontAwesome
        if ($settings['font'] == 'dashicons') {
            ?><span class="dashicons dashicons-download"></span><?php
        }
        if ($settings['font'] == 'fontawesome' || $settings['font'] == 'on') {
            ?><i class="fa fa-download"></i><?php
        }
        ?>
    </div>

    <div class="st-download-button-name <?php echo $design['color']; ?>">
        <a class="melibu-download <?php echo $design['dash']; ?>" href="#">Download&nbsp;
            <?php if ($settings['counter'] == 'off' || is_admin()) { ?>
                (0)
            <?php } ?>
        </a>
    </div>

    <div class="st-download-drop <?php echo $settings['label']; ?> <?php echo $design['labelcolor']; ?>">
        <?php if (isset($melibuPlugin_get_download_button_logo['url'])) { ?>
            <div class="st-drop-img">
                <img src="<?php echo (isset($melibuPlugin_get_download_button_logo['url']) ? esc_url($melibuPlugin_get_download_button_logo['url']) : ''); ?>" alt="Melibu Example Download Button" width="40" height="40" /> 
            </div>
        <?php } ?>
        <div class="st-drop-descrip"> 
            Melibu Theme Multi<br />
            <span><small>15.1.2016 03:43</small></span><br />
            <small><span>application/zip</span></small><br />
            <span>9.24 MB</span><br />
            <span>v.0.9 alpha</span>
        </div>
        <span class="st-clear"></span>
    </div>
    <?php
    if ($settings['copyright'] == 'on') {
        ?>
        <span class="st-download-copy">
            <?php _e('Powerd by', 'download-counter-button'); ?> &copy; <a href="http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button/" target="_blank">Melibu</a>
        </span>
    <?php } ?>
</div>