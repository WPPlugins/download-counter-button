<?php
/**
 * MELIBU SUBSCRIBER OVERVIEW
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.4.5
 */
if (!class_exists('MeliBu_Plugin_Download_Subscriber_Pager')) {

    class MeliBu_Plugin_Download_Subscriber_Pager {

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

            $pager = filter_input(INPUT_GET, 's', FILTER_SANITIZE_NUMBER_INT);
            if ($pager) {
                $this->page = (int) intval(trim(htmlentities($pager, ENT_QUOTES, "UTF-8")));
            }

            $mb_select_shows = filter_input(INPUT_POST, 'mb_select_shows', FILTER_SANITIZE_NUMBER_INT);
            if ($mb_select_shows && $mb_select_shows != '') {
                if (isset($_SESSION['mb_show_downloads'])) {
                    $_SESSION['mb_show_downloads'] = (int) intval(trim(htmlentities($mb_select_shows, ENT_QUOTES, "UTF-8")));
                }
            }

            $mb_delete = filter_input(INPUT_POST, 'mb_delete_download_subs', FILTER_SANITIZE_NUMBER_INT);
            if ($mb_delete && $mb_delete != '') {
                $this->deleteID = (int) intval(trim(htmlentities($mb_delete, ENT_QUOTES, "UTF-8")));
                $this->delete();
            }

            if (isset($_POST['mb-sub-results'])) {
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
        public function browse($pages = "1", $color = "") {

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
                        . '<form action="' . $this->link . '&s=' . $first . '" method="post">'
                        . '<input name="st_melibuPlugin_list_item" type="hidden" value="3">'
                        . '<p><button type="submit" class="mb-btn">&laquo; ' . __('First', 'download-counter-button') . ' </button></p>'
                        . '</form>'
                        . "</li>";
            }

            if ($go != 1) {
                $prev = $go - 1;
                $links[] = "<li>"
                        . '<form action="' . $this->link . '&s=' . $prev . '" method="post">'
                        . '<input name="st_melibuPlugin_list_item" type="hidden" value="3">'
                        . '<p><button type="submit" class="mb-btn">&laquo; ' . __('Back', 'download-counter-button') . ' </button></p>'
                        . '</form>'
                        . "</li>";
            }

            for ($i = $off; $i <= ( $go + $danach ); $i++) {
                if ($i != $go) {
                    $links[] = "<li>"
                            . '<form action="' . $this->link . '&s=' . $i . '" method="post">'
                            . '<input name="st_melibuPlugin_list_item" type="hidden" value="3">'
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
                        . '<form action="' . $this->link . '&s=' . $next . '" method="post">'
                        . '<input name="st_melibuPlugin_list_item" type="hidden" value="3">'
                        . '<p><button type="submit" class="mb-btn">' . __('Go', 'download-counter-button') . ' &raquo;</button></p>'
                        . '</form>'
                        . "</li>";
            }
            if ($sites - $go - $pages > 0) {
                $last = $sites;
                $links[] = "<li>"
                        . '<form action="' . $this->link . '&s=' . $last . '" method="post">'
                        . '<input name="st_melibuPlugin_list_item" type="hidden" value="3">'
                        . '<p><button type="submit" class="mb-btn">' . __('Last', 'download-counter-button') . ' &raquo;</button></p>'
                        . '</form>'
                        . "</li>";
            }

            $start = ( $go - 1 ) * $_SESSION['mb_show_downloads'];
            $link_string = implode(" ", $links);
            $resultPager = $this->DB->get_results("SELECT * FROM " . $this->DB->prefix . "melibu_dcb_sub" . " ORDER BY `" . esc_sql($this->showResult) . "` DESC LIMIT " . esc_sql($start) . ", " . esc_sql($_SESSION['mb_show_downloads']) . "");
            ?>
            <div id="st-subscriber-default-mail">
                <div class="mb-st-grid-8">
                    <h3>
                        <span class="dashicons dashicons-admin-users"></span> <?php _e('Total', 'download-counter-button'); ?> <?php echo '(' . $this->total() . ')'; ?> | 
                        <span class="dashicons dashicons-email"></span> <?php _e('Subscribers', 'download-counter-button'); ?> <?php echo '(' . $this->total_subscriber() . ')'; ?>
                    </h3>
                </div>
                <div class="mb-st-grid-4">
                    <form action="<?php echo esc_url($this->link); ?>" method="post">
                        <input name="st_melibuPlugin_list_item" type="hidden" value="3">
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
                    _e('You have no Subscribers.', 'download-counter-button');
                    return;
                } else {
                    $this->read($resultPager, $go, $sites, $link_string, $color);
                }
                ?>
            </div>
            <?php
        }

        /**
         * Overview
         * 
         * @param type $resultPager
         * @param type $go
         * @param type $sites
         * @param type $link_string
         */
        private function read($resultPager, $go, $sites, $link_string, $color) {
            global $MELIBU_PLUGIN_DOWNLOADER_01;
            $melibuPlugin_get_download_email_defaults = get_option('melibuPlugin_get_download_email_defaults');
            ?>
            <a href="#st-subscriber-default-mail" class="page-title-action st-subscriber-default-mail-show"><?php _e('Edit Mail to defaults', 'download-counter-button'); ?></a>
            <a href="#" class="page-title-action st-subscriber-default-mail-hide"><?php _e('Close Mail to defaults', 'download-counter-button'); ?></a>
            <div class="st-subscriber-default-mail">
                <div class="mb-st-grid-8">
                    <form method="post" action="options.php">
                        <?php settings_fields('melibuPlugin_download_email_defaults'); ?>
                        <p>
                            <input type="text" name="melibuPlugin_get_download_email_defaults[cc]" value="<?php echo (isset($melibuPlugin_get_download_email_defaults) && !empty($melibuPlugin_get_download_email_defaults['cc'])) ? esc_html($melibuPlugin_get_download_email_defaults['cc']) : ''; ?>" placeholder="[CC]">
                            <input type="text" name="melibuPlugin_get_download_email_defaults[bcc]" value="<?php echo (isset($melibuPlugin_get_download_email_defaults) && !empty($melibuPlugin_get_download_email_defaults['bcc'])) ? esc_html($melibuPlugin_get_download_email_defaults['bcc']) : ''; ?>" placeholder="[BCC]">
                            <input type="text" name="melibuPlugin_get_download_email_defaults[subject]" value="<?php echo (isset($melibuPlugin_get_download_email_defaults) && !empty($melibuPlugin_get_download_email_defaults['subject'])) ? esc_html($melibuPlugin_get_download_email_defaults['subject']) : ''; ?>" placeholder="[<?php _e('Subject', 'download-counter-button'); ?>]">
                        </p>
                        <p>
                            <textarea name="melibuPlugin_get_download_email_defaults[body]" placeholder="[<?php _e('Body', 'download-counter-button'); ?>]" ><?php echo (isset($melibuPlugin_get_download_email_defaults) && !empty($melibuPlugin_get_download_email_defaults['body'])) ? esc_textarea($melibuPlugin_get_download_email_defaults['body']) : ''; ?></textarea>
                        </p>
                        <small><?php _e('More information about', 'download-counter-button'); ?> <a href="https://en.wikipedia.org/wiki/Mailto" target="_blank">mailto</a></small>
                        <input type="submit" 
                               value="<?php _e('Save', 'download-counter-button'); ?>" 
                               class="button-primary" />
                               <?php wp_nonce_field('melibuPlugin_download_nonce_action', 'melibuPlugin_download_nonce'); ?>
                    </form>
                </div>
                <div class="mb-st-grid-4">
                    <h2><strong><?php _e('E-Mail default settings', 'download-counter-button'); ?></strong></h2>
                    <p><?php _e('You can make email standard settings here, that means if you click in the list on an e-mail address below, your e-mail program on the computer called. The sender is automatically populated with the email address to which you have just clicked and these standard settings have typing.', 'download-counter-button'); ?></p>
                </div>
                <div class="st-clear"></div>
                <hr />
            </div>
            <div class="mb-st-grid-4">
                <form action="<?php echo esc_url($this->link); ?>" method="post">
                    <p>
                        <select name="mb_select_shows">
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
                    <th>
                <form action="<?php echo esc_url($this->link); ?>" method="post">
                    <input type="hidden" name="mb-sub-results">
                    <input type="hidden" name="mb-type" value="user">
                    <button type="submit" class="st-button-link">
                        <?php _e('Subscriber', 'download-counter-button'); ?>
                    </button>
                </form>
            </th>
            <th><?php _e('E-Mail', 'download-counter-button'); ?></th>
            <th><?php _e('Url', 'download-counter-button'); ?></th>
            <th><?php _e('Name', 'download-counter-button'); ?></th>
            <th>
            <form action="<?php echo esc_url($this->link); ?>" method="post">
                <input type="hidden" name="mb-sub-results">
                <input type="hidden" name="mb-type" value="time">
                <button type="submit" class="st-button-link">
                    <?php _e('Subscribed on', 'download-counter-button'); ?>
                </button>
            </form>
            </th>
            <th><?php _e('Edit', 'download-counter-button'); ?></th>
            </tr>
            <?php foreach ($resultPager as $downloads) : ?>
                <tr>
                    <td>
                        <span class="dashicons dashicons-admin-users"></span> <?php
                        if (isset($downloads->user) && $downloads->user != '') {
                            echo esc_html($downloads->user);
                        } else {
                            _e('No Name', 'download-counter-button');
                            echo '<p><small>' . __('Turn name Mandatory when download to, in the settings.', 'download-counter-button') . '</small></p>';
                        }
                        ?>
                    </td>
                    <td>
                        <span class="dashicons dashicons-email"></span> <?php _e('Mail to', 'download-counter-button'); ?>: <br>
                        <a href="mailto:<?php
                        if (isset($downloads->mail) && $downloads->mail != '') {
                            echo esc_html($downloads->mail);
                        }
                        ?>?cc=<?php echo (isset($melibuPlugin_get_download_email_defaults) && !empty($melibuPlugin_get_download_email_defaults['cc'])) ? esc_html($melibuPlugin_get_download_email_defaults['cc']) : '';
                        ?>&amp;bcc=<?php echo (isset($melibuPlugin_get_download_email_defaults) && !empty($melibuPlugin_get_download_email_defaults['bcc'])) ? esc_html($melibuPlugin_get_download_email_defaults['bcc']) : '';
                        ?>&amp;subject=<?php echo (isset($melibuPlugin_get_download_email_defaults) && !empty($melibuPlugin_get_download_email_defaults['subject'])) ? esc_html($melibuPlugin_get_download_email_defaults['subject']) : '';
                        ?>&amp;body=<?php echo (isset($melibuPlugin_get_download_email_defaults) && !empty($melibuPlugin_get_download_email_defaults['body'])) ? esc_html($melibuPlugin_get_download_email_defaults['body']) : '';
                        ?>"><?php
                               if (isset($downloads->mail) && $downloads->mail != '') {
                                   echo esc_html($downloads->mail);
                               }
                               ?></a>
                    </td>
                    <td>
                        <p>
                            <?php
                            $var = $MELIBU_PLUGIN_DOWNLOADER_01->check_ext_url($downloads->url);
                            if ($var == true) {
                                ?><span class="dashicons dashicons-admin-links"></span> <?php
                                _e("internally", 'download-counter-button');
                            } else {
                                ?><span class="dashicons dashicons-external"></span> <?php
                                _e("external", 'download-counter-button');
                            }
                            ?>
                        </p>
                        <a href="<?php echo (isset($downloads->url) && $downloads->url != '' ? strtok($downloads->url, '?') : ''); ?>" target="_blank">
                            <?php echo (isset($downloads->url) && $downloads->url != '' ? esc_url(strtok($downloads->url, '?')) : ''); ?>
                        </a>
                    </td>
                    <td>
                        <span class="dashicons dashicons-media-default"></span> 
                        <?php echo (isset($downloads->name) && $downloads->name != '' ? esc_html(strtok($downloads->name, '?')) : ''); ?>
                    </td>
                    <td>
                        <span class="dashicons dashicons-clock"></span>
                        <?php
                        if (isset($downloads->time) && $downloads->time != '') {
                            $format = get_option('date_format') . ' ' . get_option('time_format');
                            echo date_i18n($format, esc_html($downloads->time));
                        }
                        ?>
                    </td>
                    <td>
                        <form action="<?php
                        if (isset($downloads->link) && $downloads->link != '') {
                            echo esc_url($this->link);
                        } else {
                            echo '#';
                        }
                        ?>" method="post">
                            <input name="st_melibuPlugin_list_item" type="hidden" value="3">
                            <input name="mb_delete_download_subs" type="hidden" value="<?php
                            if (isset($downloads->id) && $downloads->id != '') {
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
         * Total
         */
        private function total() {
            $result = 0;
            $result = $this->DB->get_results("SELECT * FROM " . $this->DB->prefix . "melibu_dcb_sub" . "");
            return number_format_i18n(count($result));
        }

        /**
         * Total subs
         */
        private function total_subscriber() {
            $result = 0;
            $result = $this->DB->get_results("SELECT * FROM " . $this->DB->prefix . "melibu_dcb_sub" . " GROUP BY mail");
            return number_format_i18n(count($result));
        }

        /**
         * Delete
         * 
         */
        private function delete() {
            $resultPager = $this->DB->delete($this->DB->prefix . "melibu_dcb_sub", array('id' => esc_sql($this->deleteID)));
            if ($resultPager) {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p><?php _e('Entry successfully removed', 'download-counter-button'); ?></p>
                </div>
                <?php
            }
        }

    }

}