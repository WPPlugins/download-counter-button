<?php
/**
 * MELIBU DOWNLOADS OVERVIEW
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.4.0
 */
if (!class_exists('MeliBu_Plugin_Download_Pager')) {

    class MeliBu_Plugin_Download_Pager {

        // Attributes
        private $DB = null;
        private $page = 0;
        private $link = '#';
        private $deleteID = '';
        private $showResult = 'id';

        /**
         * Constructor
         * 
         * @global type $wpdb
         */
        public function __construct() {

            global $wpdb;
            $this->DB = $wpdb;
            $this->actionHandler();
            $this->link = 'http://' . filter_input(INPUT_SERVER, "HTTP_HOST", FILTER_SANITIZE_STRING) . filter_input(INPUT_SERVER, "REQUEST_URI", FILTER_SANITIZE_STRING);
        }

        /**
         * Actionhandler
         * 
         */
        private function actionHandler() {

            if (!isset($_SESSION['mb_show_downloads'])) {
                $_SESSION['mb_show_downloads'] = 5;
            }
            $pager = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_NUMBER_INT);
            if ($pager) {
                $this->page = (int) intval(trim(htmlentities($pager, ENT_QUOTES, "UTF-8")));
            }
            $mb_select_shows = filter_input(INPUT_POST, 'mb_select_download_shows', FILTER_SANITIZE_NUMBER_INT);
            if ($mb_select_shows && $mb_select_shows != '') {
                if (isset($_SESSION['mb_show_downloads'])) {
                    $_SESSION['mb_show_downloads'] = (int) intval(trim(htmlentities($mb_select_shows, ENT_QUOTES, "UTF-8")));
                }
            }
            $mb_delete = filter_input(INPUT_POST, 'mb_delete_download_stat', FILTER_SANITIZE_NUMBER_INT);
            if ($mb_delete) {
                $this->deleteID = (int) intval(trim(htmlentities($mb_delete, ENT_QUOTES, "UTF-8")));
                $this->delete();
            }
            if (isset($_POST['mb-results'])) {
                $mb_count = filter_input(INPUT_POST, 'mb-type', FILTER_SANITIZE_STRING);
                $this->showResult = (string) trim(htmlentities($mb_count, ENT_QUOTES, "UTF-8"));
            }
        }

        /**
         * Pagination
         * 
         * @param type $pages
         * @param type $color
         * @return type
         */
        public function browse($pages = "1") {

            $total = $this->total();
            $sites = ceil($total / $_SESSION['mb_show_downloads']);
            $links = array();
            if ($this->page == 0) {
                $go = 1;
            } else if ($this->page <= 0 || $this->page > $sites) {
                $go = 1;
            } else {
                $go = $this->page;
            }
            if (( $go - $pages ) < 1) {
                $davor = $go - 1;
            } else {
                $davor = $pages;
            }
            if (( $go + $pages ) > $sites) {
                $danach = $sites - $go;
            } else {
                $danach = $pages;
            }
            $off = ( $go - $davor );
            if ($go - $davor > 1) {
                $first = 1;
                $links[] = "<li>"
                        . '<form action="' . $this->link . '&p=' . $first . '" method="post">'
                        . '<input name="st_melibuPlugin_list_item" type="hidden" value="4">'
                        . '<p><button type="submit" class="mb-btn">&laquo; ' . __('First', 'download-counter-button') . ' </button></p>'
                        . '</form>'
                        . "</li>";
            }
            if ($go != 1) {
                $prev = $go - 1;
                $links[] = "<li>"
                        . '<form action="' . $this->link . '&p=' . $prev . '" method="post">'
                        . '<input name="st_melibuPlugin_list_item" type="hidden" value="4">'
                        . '<p><button type="submit" class="mb-btn">&laquo; ' . __('Back', 'download-counter-button') . ' </button></p>'
                        . '</form>'
                        . "</li>";
            }
            for ($i = $off; $i <= ( $go + $danach ); $i++) {
                if ($i != $go) {
                    $links[] = "<li>"
                            . '<form action="' . $this->link . '&p=' . $i . '" method="post">'
                            . '<input name="st_melibuPlugin_list_item" type="hidden" value="4">'
                            . '<p><button type="submit" class="mb-btn">' . $i . '</button></p>'
                            . '</form>'
                            . "</li>";
                } else if ($i == $sites) {
                    $links[] = "<li class='mb-btn active'> "
                            . "[ $i ]"
                            . "</li>";
                } else if ($i == $go) {
                    $links[] = "<li class='mb-btn active'>"
                            . "[ $i ]"
                            . "</li>";
                }
            }
            if ($go != $sites) {
                $next = $go + 1;
                $links[] = "<li>"
                        . '<form action="' . $this->link . '&p=' . $next . '" method="post">'
                        . '<input name="st_melibuPlugin_list_item" type="hidden" value="4">'
                        . '<p><button type="submit" class="mb-btn">' . __('Go', 'download-counter-button') . ' &raquo;</button></p>'
                        . '</form>'
                        . "</li>";
            }
            if ($sites - $go - $pages > 0) {
                $last = $sites;
                $links[] = "<li>"
                        . '<form action="' . $this->link . '&p=' . $last . '" method="post">'
                        . '<input name="st_melibuPlugin_list_item" type="hidden" value="4">'
                        . '<p><button type="submit" class="mb-btn">' . __('Last', 'download-counter-button') . ' &raquo;</button></p>'
                        . '</form>'
                        . "</li>";
            }
            $start = ( $go - 1 ) * $_SESSION['mb_show_downloads'];
            $link_string = implode(" ", $links);
            $resultPager = $this->DB->get_results("SELECT * FROM " . $this->DB->prefix . "melibu_dcb" . " ORDER BY `" . $this->showResult . "` DESC LIMIT " . esc_sql($start) . ", " . esc_sql($_SESSION['mb_show_downloads']) . "");
            ?>
            <div class="mb-st-grid-8">
                <h3>
                    <span class="dashicons dashicons-admin-page"></span> <?php _e('Download Files', 'download-counter-button'); ?> <?php echo '(' . $total . ')'; ?> | 
                    <span class="dashicons dashicons-download"></span> <?php _e('Total Downloads', 'download-counter-button'); ?> <?php echo '(' . $this->total_downloads() . ')'; ?>
                </h3>
            </div>
            <div class="mb-st-grid-4">
                <form action="<?php echo esc_url($this->link); ?>" method="post">
                    <input name="st_melibuPlugin_list_item" type="hidden" value="4">
                    <p>
                        <button type="submit" class="mb-btn">
                            <span class="dashicons dashicons-update"></span> 
                            <?php _e('Refresh', 'download-counter-button'); ?>
                        </button>
                    </p>
                </form>
            </div>
            <div class="st-clear"></div>
            <hr />
            <?php
            if (!$resultPager) {
                _e('You have no downloads.', 'download-counter-button');
                return;
            } else {
                $this->read($resultPager, $go, $sites, $link_string);
            }
        }

        /**
         * 
         * @param type $resultPager
         * @param type $go
         * @param type $sites
         * @param type $link_string
         */
        private function read($resultPager, $go, $sites, $link_string) {
            global $MELIBU_PLUGIN_OPTIONS_01, $MELIBU_PLUGIN_DOWNLOADER_01;
            $settings = $MELIBU_PLUGIN_OPTIONS_01->settings();
            ?>
            <div class="mb-st-grid-4">
                <form action="<?php echo esc_url($this->link); ?>" method="post">
                    <input name="st_melibuPlugin_list_item" type="hidden" value="4">
                    <p>
                        <select name="mb_select_download_shows">
                            <option <?php selected($_SESSION['mb_show_downloads'], 1); ?>>1</option>
                            <option <?php selected($_SESSION['mb_show_downloads'], 5); ?>>5</option>
                            <option <?php selected($_SESSION['mb_show_downloads'], 10); ?>>10</option>
                            <option <?php selected($_SESSION['mb_show_downloads'], 25); ?>>25</option>
                            <option <?php selected($_SESSION['mb_show_downloads'], 50); ?>>50</option>
                            <option <?php selected($_SESSION['mb_show_downloads'], 100); ?>>100</option>
                        </select>
                        <button type="submit" class="mb-btn">
                            <span class="dashicons dashicons-list-view"></span> 
                            <?php _e('Show per page', 'download-counter-button'); ?>
                        </button>
                    </p>
                </form>
            </div>
            <div class="st_clear"></div>

            <table class="wp-list-table widefat fixed striped media">
                <tr>
                    <th><?php _e('Instance', 'download-counter-button'); ?></th>
                    <th><?php _e('Preview', 'download-counter-button'); ?></th>
                    <th><?php _e('Name', 'download-counter-button'); ?></th>
                    <th><?php _e('URL', 'download-counter-button'); ?></th>
                    <th><?php _e('Type', 'download-counter-button'); ?></th>
                    <th><?php _e('Size', 'download-counter-button'); ?></th>
                    <th>
                <form action="<?php echo esc_url($this->link); ?>" method="post">
                    <input type="hidden" name="mb-results">
                    <input type="hidden" name="mb-type" value="count">
                    <button type="submit" class="st-button-link">
                        <?php _e('Downloads', 'download-counter-button'); ?>
                    </button>
                </form>
            </th>
            <th>
            <form action="<?php echo esc_url($this->link); ?>" method="post">
                <input type="hidden" name="mb-results">
                <input type="hidden" name="mb-type" value="time">
                <button type="submit" class="st-button-link">
                    <?php _e('Last Download', 'download-counter-button'); ?>
                </button>
            </form>
            </th>
            <th>
                <?php _e('Edit', 'download-counter-button'); ?>
            </th>
            </tr>
            <?php foreach ($resultPager as $downloads) : ?>
                <tr>
                    <td><strong>
                            <?php
                            if (isset($downloads->instance) && $downloads->instance != '') {
                                echo esc_html($downloads->instance);
                            }
                            ?>
                        </strong>
                    </td>
                    <td>
                        <?php
                        $var = $MELIBU_PLUGIN_DOWNLOADER_01->check_ext_url($downloads->url);
                        if ($var == true) {
                            if ($settings['protect'] != 'yes') {
                                if (isset($downloads->type) && preg_match('/image\//i', $downloads->type)) {
                                    ?>
                                    <iframe src="<?php echo (isset($downloads->url) && $downloads->url != '' ? esc_url(strtok($downloads->url, '?')) : ''); ?>" class="" style="width: 100%; overflow-x: hidden; overflow-y:hidden;" scrolling="no" frameBorder="0"></iframe> 
                                    <?php
                                }
                            } else {
                                echo '<em>' . __('Full file protection', 'download-counter-button') . '</em>';
                                echo '<span class="dashicons dashicons-yes"></span>';
                                echo '<strong>' . __('is active', 'download-counter-button') . '</strong><br>';
                                echo '<small>' . __('This file can not be accessed in the browser', 'download-counter-button') . '</small>';
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <span class="dashicons dashicons-media-default"></span> 
                        <?php echo esc_html(strtok($downloads->name, '?')); ?>
                    </td>
                    <td>
                        <p>
                            <?php
                            if ($var == true) {
                                ?><span class="dashicons dashicons-admin-links"></span><?php
                                _e("internally", 'download-counter-button');
                            } else {
                                ?><span class="dashicons dashicons-external"></span><?php
                                _e("external", 'download-counter-button');
                            }
                            ?>
                        </p>
                        <a href="<?php echo (isset($downloads->url) && $downloads->url != '' ? esc_url(strtok($downloads->url, '?')) : ''); ?>" target="_blank"><?php echo (isset($downloads->url) && $downloads->url != '' ? strtok($downloads->url, '?') : ''); ?></a>
                    </td>
                    <td>
                        <?php
                        if (isset($downloads->type) && $downloads->type != '') {
                            echo esc_html($downloads->type);
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (isset($downloads->size) && $downloads->size) {
                            echo esc_html($downloads->size);
                        }
                        ?>
                    </td>
                    <td>
                        <span class="dashicons dashicons-download"></span>
                        <span class="mb-badge">
                            <i>
                                <?php
                                if (isset($downloads->count) && $downloads->count) {
                                    echo esc_html(number_format($downloads->count));
                                }
                                ?>
                            </i>
                        </span>
                    </td>
                    <td>
                        <span class="dashicons dashicons-clock"></span>
                        <?php
                        if (isset($downloads->time) && $downloads->time) {
                            $format = get_option('date_format') . ' ' . get_option('time_format');
                            echo date_i18n($format, esc_html($downloads->time));
                        }
                        ?>
                    </td>
                    <td>
                        <form action="<?php
                        if (isset($downloads->link) && $downloads->link) {
                            echo esc_url($downloads->link);
                        } else {
                            echo '#';
                        }
                        ?>" method="post">
                            <input name="st_melibuPlugin_list_item" type="hidden" value="4">
                            <input name="mb_delete_download_stat" type="hidden" value="<?php
                            if (isset($downloads->id) && $downloads->id) {
                                echo esc_html($downloads->id);
                            }
                            ?>">
                            <button type="submit" class="mb-btn">
                                <span class="dashicons dashicons-trash"></span> 
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table>

            <section class="mb-st-pagechanger">
                <div class="mb-st-pager">
                    <div class="mb-st-paged">
                        <?php _e('Page', 'download-counter-button'); ?> <?php echo $go; ?> <?php _e('from', 'download-counter-button'); ?> <?php echo $sites; ?>
                    </div>
                    <ul>
                        <?php echo $link_string; ?>
                    </ul>
                </div>
            </section>
            <?php
        }

        /**
         * Delete
         * 
         */
        private function delete() {

            $resultPager = $this->DB->delete($this->DB->prefix . "melibu_dcb", array('id' => $this->deleteID));
            if ($resultPager) {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p><?php _e('Entry successfully removed', 'download-counter-button'); ?></p>
                </div>
                <?php
            }
        }

        /**
         * Total
         * 
         */
        private function total() {

            $result = $this->DB->get_results("SELECT * FROM " . $this->DB->prefix . "melibu_dcb" . "");
            return number_format_i18n(count($result));
        }

        /**
         * Total Downloads
         * 
         */
        private function total_downloads() {
            /**
             * TODO
             * thousends seperator
             */
            $resultSumCounts = 0;
            $resultSumCount = $this->DB->get_results("SELECT SUM(count) AS TotalDownloads FROM " . $this->DB->prefix . "melibu_dcb" . "");
            if ($resultSumCount[0]->TotalDownloads != NULL) {
                $resultSumCounts = $resultSumCount[0]->TotalDownloads;
            }
            return number_format_i18n($resultSumCounts);
        }

    }

}