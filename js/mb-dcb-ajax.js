/**
 * Melibu AJAX
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Melibu Download Counter Button
 * @since       1.0
 */

/**
 * AJAX
 * 
 * @param {type} arr
 * @returns {undefined}
 */
var mb_script = {
    name: 'Melibu Plugin Javascript AJAX',
    /**
     * 
     * @returns {e|XMLHttpRequest|ActiveXObject}
     */
    xml: function () {
        // Google Chrome, Mozilla Firefox, Opera, Safari,...
        if (window.XMLHttpRequest) {
            return new XMLHttpRequest();
        } else if (window.ActiveXObject) { // Internet Explorer
            try {
                return new ActiveXObject("Msxml3.XMLHTTP");
            } catch (e) {
                return e;
            }
            try {
                return new ActiveXObject("Msxml2.XMLHTTP.6.0");
            } catch (e) {
                return e;
            }
            try {
                return new ActiveXObject("Msxml2.XMLHTTP.3.0");
            } catch (e) {
                return e;
            }
            try {
                return new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                return e;
            }
            try {
                // code for IE6, IE5
                return new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                return e;
            }
        }
        return null;
    },
    /**
     * 
     * @param {type} data
     * @returns {String}
     */
    params: function (data) {
        var collector = '';
        for (var key in data) {
            collector += key + '=';
            var value = data[key];
            collector += value + '&';
        }
        return collector.substr(0, (collector.length - 1));
    },
    /**
     * 
     * @param {type} arr
     * @returns {undefined}
     */
    ajax: function (arr) {

        var xmlRequest = this.xml(); // xmlHTTPrequest
        if (xmlRequest !== null) {
            // onReadyState
            xmlRequest.onreadystatechange = function () {
                // readyState
                if (xmlRequest.readyState === 4) {
                    // status
                    if (xmlRequest.status === 200) {
                        /**
                         * Outputs the following:
                         *
                         * LOADING 200
                         * DONE 200
                         */
                        arr.success(xmlRequest.responseText);
                    } else {
                        /**
                         * Outputs the following:
                         *
                         * UNSENT 0
                         * OPENED 0
                         */
                        arr.error('Melibu Plugin AJAX - ERROR: \n Status: ' + xmlRequest.status + ' | StatusText: ' + xmlRequest.statusText);
                    }
                }
            };
            ////////////////////////////////////////////////////////////////////
            // ASYNC
            var async = true; // Default
            if (arr.async) {
                async = arr.async;
            }
            xmlRequest.open(arr.type, arr.url, async);
            ////////////////////////////////////////////////////////////////////
            // HEADER
            var contentType = "application/x-www-form-urlencoded"; // Default
            if (arr.contentType) {
                contentType = arr.contentType;
            }
            xmlRequest.setRequestHeader("Content-Type", contentType);
            ////////////////////////////////////////////////////////////////////
            // SEND
            if (typeof arr.data === 'object' || Array.isArray(arr.data) && arr.data !== null) { // Object
                var param = this.params(arr.data);
                xmlRequest.send(param);
            } else if (typeof arr.data === 'string') { // String
                xmlRequest.send(arr.data);
            } else {
                
            }
            ////////////////////////////////////////////////////////////////////
        }
    }
};