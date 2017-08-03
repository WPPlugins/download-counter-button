<?php
/**
 * MELIBU Abo
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.7
 */
if (!defined('ABSPATH')) { exit; }

$melibuPluginFeedbackDatas = get_plugin_data(MELIBU_PLUGIN_PATH_01 . 'download-counter-button.php', $markup = true, $translate = true);
?>
<div class="wrap">
    <div class="st-wp-brand">
        <h1>
            <img src="<?php echo plugins_url("download-counter-button/img/icon-MB.png"); ?>" alt="icon-MB-20" width="50" class="st-wp-logo"> 
            <?php echo $melibuPluginFeedbackDatas['Name']; ?>
            <span><?php _e('Professional Themes and Plugins for WordPress', 'download-counter-button'); ?></span>
        </h1>
    </div>
    <hr />
    <div class="st-melibuPlugin-area">
        <?php
        $melibuPlugin_download_subscriber_pager = new MeliBu_Plugin_Download_Subscriber_Pager();
        $melibuPlugin_download_subscriber_pager->browse(1);
        ?>
    </div>
</div>