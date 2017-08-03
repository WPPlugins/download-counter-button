<?php
/**
 * MELIBU PLUGIN HELPER CLASS
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.4.9
 */
if (!class_exists('MELIBU_PLUGIN_HELPER')) {

    class MELIBU_PLUGIN_HELPER {

        /**
         * Melibu Redirect
         * @param type $filename
         */
        public function redirect_URL($filename) {

            // If PHP header sent
            if (!headers_sent()) {
                header("Location: $filename");
            } else {
                // Check if JS else HTML refresh
                ?>
                <script>
                    window.location.href = <?php echo $filename; ?>; // WINDOW LOCATION
                </script>
                <noscript>
                <meta http-equiv="refresh" content="0; URL=<?php echo $filename; ?>">
                </noscript>
                <?php
            }
        }

        /**
         *  Melibu Real Filesize
         */
        public function get_real_file_size($size, $praefix = true, $short = true) {

            if ($praefix === true) {
                if ($short === true) {
                    $norm = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                } else {
                    $norm = array('Byte', 'Kilobyte', 'Megabyte', 'Gigabyte', 'Terabyte', 'Petabyte', 'Exabyte', 'Zettabyte', 'Yottabyte');
                }
                $factor = 1000;
            } else {
                if ($short === true) {
                    $norm = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
                } else {
                    $norm = array('Byte', 'Kibibyte', 'Mebibyte', 'Gibibyte', 'Tebibyte', 'Pebibyte', 'Exbibyte', 'Zebibyte', 'Yobibyte');
                }
                $factor = 1024;
            }
            $count = count($norm) - 1;
            $x = 0;
            while ($size >= $factor && $x < $count) {
                $size /= $factor;
                $x++;
            }
            return sprintf("%01.2f", $size) . ' ' . $norm[$x];
        }

        /**
         * 
         * @return type
         */
        public function get_protocol() {
            return stripos(filter_input(INPUT_SERVER, "SERVER_PROTOCOL"), 'https') === true ? 'https://' : 'http://';
        }

        /**
         * 
         * @return type
         */
        public static function get_IP() {

            $HTTP_X_FORWARDED_FOR = filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED_FOR');
            $HTTP_CLIENT_IP = filter_input(INPUT_SERVER, 'HTTP_CLIENT_IP');
            $REMOTE_ADDR = filter_input(INPUT_SERVER, 'REMOTE_ADDR');

            // Ist HTTP_X_FORWARDED_FOR vorhanden ?
            if ($HTTP_X_FORWARDED_FOR) {

                $realIP = $HTTP_X_FORWARDED_FOR; // Ermittelte IP-Adresse.
            }
            // Oder ist HTTP_CLIENT_IP vorhanden ?
            else if ($HTTP_CLIENT_IP) {

                $realIP = $HTTP_CLIENT_IP; // Ermittelte IP-Adresse.
            }
            // Wenn beides oben nicht zutraff, dann REMOTE_ADDR ermitteln.
            else {

                $makeRealIP = $REMOTE_ADDR; // Ermittelte Remote-Adresse.
                // Umwandeln in lesbare komma getrennte (123.25.25.123) IP-Adresse.
                $realIP = long2ip(ip2long($makeRealIP));
            }

            return $realIP;
        }

    }

    global $melibuPluginHelper;
    $melibuPluginHelper = new MELIBU_PLUGIN_HELPER();
}
