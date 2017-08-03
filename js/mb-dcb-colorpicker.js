
jQuery(document).ready(function ($) {

    var myOptions = {
        defaultColor: false,
        change: function (event, ui) {
            melibu_colorpicker_set_color();
        },
        clear: function () {
        },
        hide: true,
        palettes: true
    };

    if (typeof jQuery.wp === 'object' && typeof jQuery.wp.wpColorPicker === 'function') {
        jQuery('.melibu-plugin-dcb-btn-color').wpColorPicker(myOptions);
        jQuery('.melibu-plugin-dcb-btn-txt-color').wpColorPicker(myOptions);
        jQuery('.melibu-plugin-dcb-btn-icon-color').wpColorPicker(myOptions);
        jQuery('.melibu-plugin-dcb-btn-icon-txt-color').wpColorPicker(myOptions);
    } else {
        jQuery('.melibu-plugin-dcb-btn-colorpicker').farbtastic('.melibu-plugin-dcb-btn-color');
        jQuery('.melibu-plugin-dcb-btn-txt-colorpicker').farbtastic('.melibu-plugin-dcb-btn-txt-color');
        jQuery('.melibu-plugin-dcb-btn-icon-colorpicker').farbtastic('.melibu-plugin-dcb-btn-icon-color');
        jQuery('.melibu-plugin-dcb-btn-icon-txt-colorpicker').farbtastic('.melibu-plugin-dcb-btn-icon-txt-color');

    }
});

function melibu_colorpicker_set_color() {

    var bgc = jQuery('.wp-color-result.wp-picker-open').css('backgroundColor');
    var c = jQuery('.wp-color-result.wp-picker-open').css('color');
    jQuery('.st-download-button-name').css('backgroundColor', bgc);
    jQuery('.st-download-button-name').css('color', c);
    jQuery('.st-download-button-icon').css('backgroundColor', bgc);
    jQuery('.st-download-button-icon').css('color', c);
}