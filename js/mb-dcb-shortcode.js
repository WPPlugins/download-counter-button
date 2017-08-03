/**
 * Melibu TinyMCE Shortcode
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Melibu Download Counter Button
 * @since       1.0
 */
jQuery(document).ready(function ($) {

    if (tinymce) {
        
        tinymce.create('tinymce.plugins.melibuPluginDownload', {
            init: function (ed, url) {

                ed.addButton('melibu_plugin_download_counter_button', {
                    title: melibu_download_translate.shortcode_text,
                    cmd: 'melibuplugin_download_insert_shortcode',
                    icon: 'download'
                });

                ed.addCommand('melibuplugin_download_insert_shortcode', function () {

                    var mediaUploader, return_text = '', dater = new Date();

                    if (mediaUploader) {
                        mediaUploader.open();
                        return;
                    }

                    mediaUploader = wp.media.frames.file_frame = wp.media({
                        title: 'MELIBU Download',
                        button: {
                            text: melibu_download_translate.shortcode_button_text
                        },
                        multiple: false
                    });

                    mediaUploader.on('select', function () {

                        attachment = mediaUploader.state().get('selection').first().toJSON();
                        return_text = '[wp_mb_plugin_download instance="1" password="' + melibu_download_translate.password + '" buttonname="' + melibu_download_translate.buttonname + '" name="' + melibu_download_translate.name + '" datetime="' + melibu_download_translate.time + '" other="' + melibu_download_translate.other + '" atagseo="' + melibu_download_translate.atagseo + '"]' + attachment.url + '[/wp_mb_plugin_download]';
                        ed.execCommand('mceInsertContent', 0, return_text);
                    });

                    mediaUploader.open();
                });
            },
            createControl: function (n, cm) {
                return null;
            }
        });

        tinymce.PluginManager.add('melibu_plugin_download_counter_button', tinymce.plugins.melibuPluginDownload);
        
    } else {
        
        alert('MeliBu WP Download Counter Button, says non jQuery for the shortcode TinyMCE');
    }
});

