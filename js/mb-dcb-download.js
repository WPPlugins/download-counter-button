/**
 * Melibu Download
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Melibu Download Counter Button
 * @since       1.0
 */

var melibu_plugin_download = {
    name: 'Melibu WP Download Counter Button',
    modal: document.querySelector(".mb-modal"),
    dialog: document.querySelector(".mb-modal-dialog"),
    load: document.querySelector(".melibu-download-loading"),
    id: '',
    url: '',
    type: '',
    size: '',
    query: '',
    password: '',
    passwordcheck: '',
    instance: 1,
    modalOnOff: melibu_download_translate.modal, // Modal ON/OFF
    layoutDash: melibu_download_translate.dash, // Dash ON/OFF
    downName: '',
    mailID: '',
    subsOnOff: melibu_download_translate.subscribe, // Subscribe Email ON/OFF
    subsID: '',
    usersOnOff: melibu_download_translate.subscribename, // Username ON/OFF
    usersID: '',
    capsOnOff: melibu_download_translate.captcha, // Captcha ON/OFF
    capsCode: '',
    capsRotate: 0,
    countOnOff: melibu_download_translate.counter, // User Count ON/OFF
    admin: melibu_download_translate.user_role, // is admin
    errors: '',
    /**
     * 
     * @param {type} r
     * @returns {String|melibu_plugin_download.killZero.k}
     */
    killZero: function (r) {
        var k = '';
        if (r.substr(r.length - 1) === '0') {
            k = r.substring(0, r.length - 1); // Clean zero on last -> }0 this gives a error 
        } else {
            k = r;
        }
        return k;
    },
    /**
     * 
     * @param {type} u
     * @returns {melibu_plugin_download.getLocation.l}
     */
    getLocation: function (u) {
        var l = document.createElement("a");
        l.href = u;
        return l;
    },
    /**
     * Set all Download buttons
     * 
     * @returns {Boolean}
     */
    getandset_all_download_buttons: function () {

        if (document.getElementsByClassName("mb-instances")) { // Is instances
            var mb_instances = document.getElementsByClassName("mb-instances"); // Get all instances
            for (var e = 0; e < mb_instances.length; e++) { // Loop all instances
                if (document.getElementsByClassName("mb-put" + mb_instances[e].id)) { // If put in the loop
                    if (document.getElementsByClassName("mb-put" + mb_instances[e].id).length > 1) { // More than one
                        for (var d = 0; d < document.getElementsByClassName("mb-put" + mb_instances[e].id).length; d++) { // loop again
                            // Vars
                            var setToGetherDouble = '',
                                    downloadTitle = 'Download',
                                    downloadTitleck = '',
                                    pass = '',
                                    atagseo = 'tag';
                            if (document.getElementsByClassName("mb-put" + mb_instances[e].id)[d].getAttribute('data-mb-dcb-btnname')) {
                                downloadTitle = document.getElementsByClassName("mb-put" + mb_instances[e].id)[d].getAttribute('data-mb-dcb-btnname');
                                // If counthide
                                if (melibu_plugin_download.countOnOff === 'off' || melibu_plugin_download.admin === '1') {
                                    downloadTitleck += ' (' + mb_instances[e].value + ')';
                                }
                            }
                            if (document.getElementsByClassName("mb-put" + mb_instances[e].id)[d].getAttribute('data-mb-dcb-atagseo')) {
                                atagseo = document.getElementsByClassName("mb-put" + mb_instances[e].id)[d].getAttribute('data-mb-dcb-atagseo');
                            }
                            if (document.getElementsByClassName("mb-put" + mb_instances[e].id)[d].getAttribute('data-mb-dcb-pass')) {
                                pass = document.getElementsByClassName("mb-put" + mb_instances[e].id)[d].getAttribute('data-mb-dcb-pass');
                            }
                            // Link start
                            setToGetherDouble += '<a href="#" rel="' + atagseo + '" title="' + downloadTitle + downloadTitleck + '" class="melibu-download melibu-download' + mb_instances[e].id + ' ' + melibu_plugin_download.layoutDash + '" data-mb-dcb-btname="' + downloadTitle + '" data-mb-dcb-btnid="' + mb_instances[e].id + '" data-mb-dcb-btnfile="' + mb_instances[e].name + '" data-mb-dcb-btncount="' + mb_instances[e].value + '" data-mb-dcb-pass="' + pass + '" download="download">' + downloadTitle;
                            // If counthide                
                            if (melibu_plugin_download.countOnOff === 'off' || melibu_plugin_download.admin === '1') {
                                setToGetherDouble += '&nbsp;<span class="st-display">(' + mb_instances[e].value + ')</span>';
                            }
                            setToGetherDouble += '</a>'; // Link end
                            // Put buttons
                            document.getElementsByClassName("mb-put" + mb_instances[e].id)[d].innerHTML = setToGetherDouble;
                        }

                    } else {
                        // Vars
                        var setToGetherSingle = '',
                                downloadTitle = 'Download',
                                downloadTitleck = '',
                                pass = '',
                                atagseo = 'tag';
                        if (document.querySelector(".mb-put" + mb_instances[e].id).getAttribute('data-mb-dcb-btnname')) {
                            downloadTitle = document.querySelector(".mb-put" + mb_instances[e].id).getAttribute('data-mb-dcb-btnname');
                            // If counthide
                            if (melibu_plugin_download.countOnOff === 'off' || melibu_plugin_download.admin === '1') {
                                downloadTitleck += ' (' + mb_instances[e].value + ')';
                            }
                        }
                        if (document.querySelector(".mb-put" + mb_instances[e].id).getAttribute('data-mb-dcb-atagseo')) {
                            atagseo = document.querySelector(".mb-put" + mb_instances[e].id).getAttribute('data-mb-dcb-atagseo');
                        }
                        if (document.querySelector(".mb-put" + mb_instances[e].id).getAttribute('data-mb-dcb-pass')) {
                            pass = document.querySelector(".mb-put" + mb_instances[e].id).getAttribute('data-mb-dcb-pass');
                        }
                        // Link start
                        setToGetherSingle += '<a href="#" rel="' + atagseo + '" title="' + downloadTitle + downloadTitleck + '" class="melibu-download melibu-download' + mb_instances[e].id + ' ' + melibu_plugin_download.layoutDash + '" data-mb-dcb-btname="' + downloadTitle + '" data-mb-dcb-btnid="' + mb_instances[e].id + '" data-mb-dcb-btnfile="' + mb_instances[e].name + '" data-mb-dcb-btncount="' + mb_instances[e].value + '" data-mb-dcb-pass="' + pass + '" download="download">' + downloadTitle;
                        // If counthide
                        if (melibu_plugin_download.countOnOff === 'off' || melibu_plugin_download.admin === '1') {
                            setToGetherSingle += '&nbsp;<span class="st-display">(' + mb_instances[e].value + ')</span>';
                        }
                        setToGetherSingle += '</a>'; // Link end
                        // Put buttons
                        document.querySelector(".mb-put" + mb_instances[e].id).innerHTML = setToGetherSingle;
                    }
                }
            }
        }
        return false;
    },
    /**
     * Download Click
     * 
     * @param {type} e
     * @returns {Boolean}
     */
    click_download: function (e) {

        e.preventDefault(); // Deactivate link
        var instance = e.target.getAttribute('data-mb-dcb-btnid');
        melibu_plugin_download.instance = instance;
        melibu_plugin_download.url = e.target.getAttribute('data-mb-dcb-btnfile');
        melibu_plugin_download.password = e.target.getAttribute('data-mb-dcb-pass');
        melibu_plugin_download.query = "mb-drop" + instance;
        // If password required
        if (melibu_plugin_download.password) {
            if (document.querySelector('.mb-modal-password')) { // If password field
                // Show password field
                document.querySelector('.mb-modal-password').style.display = 'block';
            }
        } else {
            if (document.querySelector('.mb-modal-password')) { // If password field
                document.querySelector('.mb-modal-password').style.display = 'none';
            }
        }

        // If Modal ON
        if (melibu_plugin_download.modalOnOff === 'on' || 
                melibu_plugin_download.subsOnOff === 'on' || 
                melibu_plugin_download.capsOnOff === 'on' ||
                melibu_plugin_download.password) {

            // Show modal
            melibu_plugin_download.dialog.style.top = '20%';
            melibu_plugin_download.modal.style.visibility = 'visible';
        } else {
            // Download data
            melibu_plugin_download.send_data(); // Send
        }
        return false;
    },
    /**
     * Download Cancel
     * 
     * @returns {Boolean}
     */
    cancel_download: function (e) {

        e.preventDefault(); // Deactivate link

        if (melibu_plugin_download.errors) {
            melibu_plugin_download.errors.innerHTML = '';
        }
        if (melibu_plugin_download.load) {
            melibu_plugin_download.load.innerHTML = '';
        }

        if (document.querySelector('.mb-modal-subscribe-mail')) {
            document.querySelector('.mb-modal-subscribe-mail').value = '';
        }

        if (document.querySelector('.mb-modal-subscribe-user')) {
            document.querySelector('.mb-modal-subscribe-user').value = '';
        }

        if (document.querySelector('.mb-captcha-code')) {
            document.querySelector('.mb-captcha-code').value = '';
        }

        if (document.querySelector('.mb-modal-password')) {
            document.querySelector('.mb-modal-password').value = '';
        }

        // Hide modal
        melibu_plugin_download.dialog.style.top = '-100%';
        melibu_plugin_download.modal.style.visibility = 'hidden';
        return false;
    },
    /**
     * 
     * @param {type} e
     * @returns {Boolean}
     */
    to_subscribe: function (e) {

        e.preventDefault(); // Deactivate link

        // Set send params
        var sendParams = {
            action: 'melibu_down_ajax', // add_action('wp_ajax', 'melibu_down_ajax');
            actiontype: 'check',
            subscribe: melibu_plugin_download.subsOnOff,
            cpo: melibu_plugin_download.capsOnOff
        };
        if (melibu_plugin_download.subsOnOff === 'on') { // Subscribe

            if (document.querySelector('.mb-modal-subscribe-mail')) {
                melibu_plugin_download.mailID = document.querySelector('.mb-modal-subscribe-mail');
                sendParams.mail = melibu_plugin_download.mailID.value; // Param
            }

            sendParams.upo = melibu_plugin_download.usersOnOff; // Param

            if (melibu_plugin_download.usersOnOff === 'on') { // Username
                if (document.querySelector('.mb-modal-subscribe-user')) {
                    melibu_plugin_download.usersID = document.querySelector('.mb-modal-subscribe-user');
                    sendParams.user = melibu_plugin_download.usersID.value; // Param
                }
            }
        }

        if (melibu_plugin_download.capsOnOff === 'on') { // Captcha
            if (document.querySelector('.mb-captcha-code')) {
                melibu_plugin_download.capsCode = document.querySelector('.mb-captcha-code');
                sendParams.captcha = melibu_plugin_download.capsCode.value; // Param
            }
        }

        if (melibu_plugin_download.password) { // Password
            sendParams.pass = melibu_plugin_download.password; // Param
            if (document.querySelector('.mb-modal-password')) {
                melibu_plugin_download.passwordcheck = document.querySelector('.mb-modal-password');
                sendParams.passcheck = melibu_plugin_download.passwordcheck.value; // Param
            }
        }

        if (melibu_plugin_download.load) {
            melibu_plugin_download.load.innerHTML = '<img src="' + melibu_download_translate.plugin_url + 'img/loading.gif" alt="loeading">';
        }
        mb_script.ajax({
            type: "POST", // Type post
            url: melibu_download_translate.blog_url + "/wp-admin/admin-ajax.php", // WP ajax
            data: sendParams, // Params
            success: function (req) {
                var fixer = melibu_plugin_download.killZero(req);
                if (fixer !== 'true') {
                    // Show errors
                    if (melibu_plugin_download.errors) {
                        melibu_plugin_download.errors.innerHTML = '';
                    }
                    if (melibu_plugin_download.load) {
                        melibu_plugin_download.load.innerHTML = '';
                    }
                    melibu_plugin_download.errors.innerHTML = fixer;
                    if (melibu_plugin_download.capsOnOff === 'on') { // Captcha
                        melibu_plugin_download.reload_captcha(); // Captcha reload
                    }
                } else if (fixer === 'true') {
                    // Hide modal
                    melibu_plugin_download.dialog.style.top = '-100%';
                    melibu_plugin_download.modal.style.visibility = 'hidden';
                    melibu_plugin_download.send_data(); // Send data
                }
                return false;
            },
            error: function (errorThrown) {
                alert(errorThrown);
            }
        });
    },
    send_data: function () {

        melibu_plugin_download.size = document.querySelector("." + melibu_plugin_download.query + " .st-drop-descrip .mb-download-size").innerHTML;
        melibu_plugin_download.type = document.querySelector("." + melibu_plugin_download.query + " .st-drop-descrip .mb-download-type").innerHTML;
        
        // Set send params
        var downloadParams = {
            action: 'melibu_down_ajax', // add_action('wp_ajax', 'melibu_down_ajax');
            actiontype: 'count',
            url: melibu_plugin_download.url,
            type: melibu_plugin_download.type,
            size: melibu_plugin_download.size,
            subscribe: melibu_plugin_download.subsOnOff,
            sbuo: melibu_plugin_download.usersOnOff,
            ins: melibu_plugin_download.instance,
            pass: melibu_plugin_download.password,
            btn: document.querySelector(".melibu-download" + melibu_plugin_download.instance).getAttribute('data-mb-dcb-btname'),
            rel: document.querySelector(".melibu-download" + melibu_plugin_download.instance).getAttribute('rel')
        };
        
        if (melibu_plugin_download.subsOnOff === "on") { // Subscribe
            downloadParams.mail = melibu_plugin_download.mailID.value; // Param
            if (melibu_plugin_download.usersOnOff === "on") { // Username
                downloadParams.user = melibu_plugin_download.usersID.value; // Param
            }
        }

        if (melibu_plugin_download.load) {
            melibu_plugin_download.load.innerHTML = '<img src="' + melibu_download_translate.plugin_url + 'img/loading.gif" alt="loeading">';
        }
        var fixer = '';
        mb_script.ajax({
            type: "POST", // Type post
            url: melibu_download_translate.blog_url + "/wp-admin/admin-ajax.php", // WP ajax
            data: downloadParams, // Params
            success: function (requestback) {
                if (melibu_plugin_download.load) {
                    melibu_plugin_download.errors.innerHTML = '';
                }
                if (melibu_plugin_download.load) {
                    melibu_plugin_download.load.innerHTML = '';
                }

                fixer = melibu_plugin_download.killZero(requestback);
                // Subscribe ON/OFF
                if (melibu_plugin_download.subsOnOff === 'on') {
                    if (melibu_plugin_download.mailID) {
                        melibu_plugin_download.mailID.value = '';
                    }
                    if (melibu_plugin_download.usersID) {
                        melibu_plugin_download.usersID.value = '';
                    }
                }
                // Captcha ON/OFF
                if (melibu_plugin_download.capsOnOff === 'on') {
                    melibu_plugin_download.capsCode.value = '';
                }
                // Instance
                if (melibu_plugin_download.instance) {
                    if (document.querySelectorAll(".melibu-download" + melibu_plugin_download.instance)) {
                        // Counts
                        if (melibu_plugin_download.countOnOff === 'off' || melibu_plugin_download.admin === '1') {
                            var countsrefresh = document.querySelectorAll(".melibu-download" + melibu_plugin_download.instance);
                            for (var cc = 0; cc < countsrefresh.length; cc++) {
                                countsrefresh[cc].setAttribute("title", countsrefresh[cc].getAttribute('data-mb-dcb-btname') + ' (' + fixer + ')');
                                countsrefresh[cc].innerHTML = countsrefresh[cc].getAttribute('data-mb-dcb-btname') + '&nbsp;<span class="st-display">(' + fixer + ')</span>'; // Set new counts
                            }
                        }

                        var l = melibu_plugin_download.getLocation(melibu_plugin_download.url);

                        // Download file
                        if (window.location.hostname.replace('www.', '') === l.hostname.replace('www.', '')) { // File to Download
                            window.location = melibu_download_translate.plugin_url + 'functions/count/download.php?durl=' + encodeURIComponent(melibu_plugin_download.url) + '&dtp=' + melibu_plugin_download.type + '&dabp=' + melibu_download_translate.abspath;
                        } else {
                            window.location = melibu_plugin_download.url;
                        }
                    }
                }
                return false;
            },
            error: function (errorThrown) {
                alert(errorThrown);
            }
        });
        return false;
    },
    reload_captcha: function () {

        if (document.querySelector("#mb-captcha")) {
            melibu_plugin_download.capsRotate += 90;
            if (document.querySelector('.mb-captcode > .refresh-captcha > i')) {
                document.querySelector('.mb-captcode > .refresh-captcha > i').style.transform = 'rotate(' + melibu_plugin_download.capsRotate + 'deg)';
            } else if (document.querySelector('.mb-captcode > .refresh-captcha > span')) {
                document.querySelector('.mb-captcode > .refresh-captcha > span').style.transform = 'rotate(' + melibu_plugin_download.capsRotate + 'deg)';
            }
            mb_script.ajax({
                type: "POST",
                url: melibu_download_translate.blog_url + "/wp-admin/admin-ajax.php", // plugins_url("download-counter-button/functions/other/captcha_sess.php");
                data: {
                    action: 'melibu_down_ajax', // add_action('wp_ajax', 'melibu_down_ajax');
                    actiontype: 'captcha'
                },
                success: function (req) {

                    document.querySelector("#mb-captcha").src = melibu_download_translate.plugin_url + 'functions/other/captcha.php?r=' + Math.random();
                    melibu_plugin_download.set_download_sub_capt(req);
                    return false;
                },
                error: function (errorThrown) {
                    alert(errorThrown);
                }
            });
        }
        return false;
    },
    set_download_sub_capt: function (req) {
        mb_modal_subscribe_captcha_1399965 = document.querySelector('.mb-captcha-reload');
        mb_modal_subscribe_captcha_1399965.value = req;
    }
};
/**
 * On Document ready set all eventhandler
 * 
 * @returns {undefined}
 */
document.addEventListener('DOMContentLoaded', function () {

    melibu_plugin_download.getandset_all_download_buttons();
    // MODAL START
    if (document.querySelectorAll('.melibu-download')) {
        var st_download = document.querySelectorAll('.melibu-download');
        for (var i = 0; i < st_download.length; i++) {
            melibu_plugin_event.addEvent(st_download[i], 'click', melibu_plugin_download.click_download);
            melibu_plugin_event.addEvent(st_download[i], 'contextmenu', melibu_plugin_download.click_download);
        }
    }

    // DOWNLOAD
    if (document.getElementsByClassName('mb-modal-download-btn')) {
        var mb_modal_download = document.getElementsByClassName('mb-modal-download-btn');
        for (var j = 0; j < mb_modal_download.length; j++) {
            melibu_plugin_event.addEvent(mb_modal_download[j], 'click', melibu_plugin_download.to_subscribe);
        }
    }

    // SUBSCRIBE
    if (document.getElementsByClassName('mb-modal-subscribe-btn')) {
        var mb_modal_subscribe_btn = document.getElementsByClassName('mb-modal-subscribe-btn');
        for (var y = 0; y < mb_modal_subscribe_btn.length; y++) {
            melibu_plugin_event.addEvent(mb_modal_subscribe_btn[y], 'click', melibu_plugin_download.to_subscribe);
        }
    }

    // CANCEL
    if (document.querySelectorAll('.mb-modal .mb-modal-cancel')) {
        var mb_modal_abort = document.querySelectorAll('.mb-modal .mb-modal-cancel');
        for (var x = 0; x < mb_modal_abort.length; x++) {
            melibu_plugin_event.addEvent(mb_modal_abort[x], 'click', melibu_plugin_download.cancel_download);
        }
    }

    // CAPTCHA
    if (document.querySelector('.mb-captcode')) {
        melibu_plugin_event.addEvent(document.querySelector('.mb-captcode'), "click", melibu_plugin_download.reload_captcha);
    }

    melibu_plugin_download.errors = document.querySelector('.mb-modal-errors');
    melibu_plugin_download.reload_captcha();
});