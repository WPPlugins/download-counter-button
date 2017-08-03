<?php

/**
 * MELIBU ABOUT
 * 
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.0
 */
if (!defined('ABSPATH')) { exit; }

$datas = get_plugin_data(MELIBU_PLUGIN_PATH_01 . 'download-counter-button.php', $markup = true, $translate = true);
?>
<div class="melibu-download-about wrap about-wrap">

    <h1>
        <?php _e('Welcome to', 'download-counter-button'); ?> <span style="color:#FF7F01;"><?php echo $datas['Name']; ?></span>&nbsp;<?php echo $datas['Version']; ?>
    </h1>
    
    <div class="about-text"><?php echo $datas['Description']; ?></div>
    <div class="wp-badge"><?php _e('Version', 'download-counter-button'); ?> <?php echo $datas['Version']; ?></div>

    <div class="st-melibuPlugin-area">
        <div class="st_melibuPlugin_list st_melibuPlugin_list_flip">

            <input name="st_melibuPlugin_list_item"
                   id="st_melibuPlugin_list_item_1" 
                   class="st_melibuPlugin_list_item_1" 
                   type="radio" 
                   value="1" checked="checked">
            <label for="st_melibuPlugin_list_item_1"><span><span class="dashicons dashicons-admin-home"></span> <?php _e('Welcome', 'download-counter-button'); ?></span></label>
            <input name="st_melibuPlugin_list_item" 
                   id="st_melibuPlugin_list_item_2" 
                   class="st_melibuPlugin_list_item_2" 
                   type="radio" 
                   value="2">
            <label for="st_melibuPlugin_list_item_2"><span><span class="dashicons dashicons-editor-code"></span> <?php _e('Functions', 'download-counter-button'); ?></span></label>
            <input name="st_melibuPlugin_list_item" 
                   id="st_melibuPlugin_list_item_3" 
                   class="st_melibuPlugin_list_item_3" 
                   type="radio" 
                   value="3">
            <label for="st_melibuPlugin_list_item_3"><span><span class="dashicons dashicons-sos"></span> <?php _e('Support', 'download-counter-button'); ?> </span></label>
            <input name="st_melibuPlugin_list_item" 
                   id="st_melibuPlugin_list_item_4" 
                   class="st_melibuPlugin_list_item_4" 
                   type="radio" 
                   value="4">
            <label for="st_melibuPlugin_list_item_4"><span><span class="dashicons dashicons-hammer"></span> <?php _e('Development', 'download-counter-button'); ?> </span></label>
            <input name="st_melibuPlugin_list_item" 
                   id="st_melibuPlugin_list_item_5" 
                   class="st_melibuPlugin_list_item_5" 
                   type="radio" 
                   value="5">
            <label for="st_melibuPlugin_list_item_5"><span><span class="dashicons dashicons-translation"></span> <?php _e('Translation', 'download-counter-button'); ?> </span></label>
            <input name="st_melibuPlugin_list_item" 
                   id="st_melibuPlugin_list_item_6" 
                   class="st_melibuPlugin_list_item_6" 
                   type="radio" 
                   value="6">
            <label for="st_melibuPlugin_list_item_6"><span><span class="dashicons dashicons-carrot"></span> <?php _e('Donate', 'download-counter-button'); ?> </span></label>
            <ul>
                <li class="st_melibuPlugin_list_item_1">
                    <div class="st_melibuPlugin_list_content">
                        <h3>MeliBu &copy;</h3>
                        <hr />
                        <?php
                        if ($datas) {
                            foreach ($datas as $key => $data) {

                                echo '<strong>' . $key . '</strong>: ' . $data . '<br />';
                            }
                        }
                        ?>
                        <hr />
                        <p>
                            <?php _e('More Professional', 'download-counter-button'); ?> <a href="http://samet-tarim.de/wordpress/melibu-themes" target="_blank"><?php _e('Themes', 'download-counter-button'); ?></a> <?php _e('and', 'download-counter-button'); ?> <a href="http://samet-tarim.de/wordpress/melibu-plugins" target="_blank"><?php _e('Plugins', 'download-counter-button'); ?></a>
                        </p>
                        <hr />
                        <div class="headline-feature feature-video" style="background-color:#191E23;">
                            <img src="<?php echo plugins_url("screenshot-1.jpg", dirname(__FILE__)); ?>" alt="screenshot-1" width="650" class="st-img"/>
                        </div>
                    </div>
                </li>
                <li class="st_melibuPlugin_list_item_2">
                    <div class="st_melibuPlugin_list_content">
                        
                        <h3><?php _e('Functions', 'download-counter-button'); ?></h3>
                        <hr />
                        
                        <div class="under-the-hood three-col">
                            <div class="col">
                                <h3><?php _e('Functionality', 'download-counter-button'); ?></h3>
                                <ul class="st-list">
                                    <li><?php _e('Counts your downloads/clicks', 'download-counter-button'); ?></li>
                                    <li><?php _e('Returns the current number of downloads/clicks', 'download-counter-button'); ?></li>
                                    <li><?php _e('No page refresh required (JS)', 'download-counter-button'); ?></li>
                                    <li><?php _e('Prevents double count', 'download-counter-button'); ?></li>
                                    <li><?php _e('Multiple placeble (duplicates and singles)', 'download-counter-button'); ?></li>
                                    <li><?php _e('Works in any post, page and text widget (Sidebars)', 'download-counter-button'); ?></li>
                                    <li><?php _e('Can useable any File-Types (PDF, ZIP, MP3, MPEG...) or any URL', 'download-counter-button'); ?></li>
                                    <li><?php _e('All downloads can be provided with a captcha', 'download-counter-button'); ?></li>
                                    <li><?php _e('All downloads can be provided with a subscription & subscription with name', 'download-counter-button'); ?></li>
                                    <li><?php _e('Top 5 Widget', 'download-counter-button'); ?></li>
                                    <li><?php _e('Label with infos', 'download-counter-button'); ?></li>
                                    <li><?php _e('Full File Protection', 'download-counter-button'); ?></li>
                                    <li><?php _e('Protect the download with Password', 'download-counter-button'); ?></li>
                                    <li><?php _e('Place your ads in the window', 'download-counter-button'); ?></li>
                                    <li><?php _e('Simple select file from Media library or upload new or give the url', 'download-counter-button'); ?></li>
                                    <li><?php _e('Download information overview with statistics of downloaded files', 'download-counter-button'); ?></li>
                                    <li><?php _e('With Subscriber list with mailto function', 'download-counter-button'); ?></li>
                                    <li><?php _e('Download and Subscriber Overview sort', 'download-counter-button'); ?></li>
                                    <li><?php _e('SEO relevant rel tag', 'download-counter-button'); ?></li>
                                    <li><?php _e('Any document/file type, open the right window', 'download-counter-button'); ?></li>
                                    <li><?php _e('Automaticly file permission change', 'download-counter-button'); ?></li>
                                    <li><?php _e('Counts without JavaScript (AJAX)', 'download-counter-button'); ?></li>
                                    <li><?php _e('Supports http:// and https:// protocol', 'download-counter-button'); ?></li>
                                </ul>
                            </div>
                            <div class="col">
                                <h3><?php _e('Options', 'download-counter-button'); ?></h3>
                                <ul class="st-list">
                                    <li><?php _e('Shortcode to select from the media library a file', 'download-counter-button'); ?></li>
                                    <li><?php _e('Custom button layout', 'download-counter-button'); ?></li>
                                    <li><?php _e('Custom button name', 'download-counter-button'); ?></li>
                                    <li><?php _e('Custom button label name', 'download-counter-button'); ?></li>
                                    <li><?php _e('Custom button datetime', 'download-counter-button'); ?></li>
                                    <li><?php _e('Custom button other', 'download-counter-button'); ?></li>
                                    <li><?php _e('Custom button color', 'download-counter-button'); ?></li>
                                    <li><?php _e('Custom button icon color', 'download-counter-button'); ?></li>
                                    <li><?php _e('Custom dashed pattern', 'download-counter-button'); ?></li>
                                    <li><?php _e('Custom label color', 'download-counter-button'); ?></li>
                                    <li><?php _e('Custom info box image upload', 'download-counter-button'); ?></li>
                                    <li><?php _e('Custom thanks, subscriber and captcha Title & Description', 'download-counter-button'); ?></li>
                                    <li><?php _e('Custom ADS (Publish)', 'download-counter-button'); ?></li>
                                    <li><?php _e('Show/Hide additional info box', 'download-counter-button'); ?></li>
                                    <li><?php _e('Show/Hide additional count', 'download-counter-button'); ?></li>
                                    <li><?php _e('Show/Hide additional modal', 'download-counter-button'); ?></li>
                                    <li><?php _e('Show/Hide additional FontAwesome CSS', 'download-counter-button'); ?></li>
                                    <li><?php _e('Activate/Deactivate additional subscription', 'download-counter-button'); ?></li>
                                    <li><?php _e('Activate/Deactivate additional captcha', 'download-counter-button'); ?></li>
                                    <li><?php _e('Activate/Deactivate full file protection', 'download-counter-button'); ?></li>
                                    <li><?php _e('Subscriber overview mailto default settings', 'download-counter-button'); ?></li>
                                    <li><?php _e('Refresh on downloads overview', 'download-counter-button'); ?></li>
                                    <li><?php _e('Refresh on subscriber overview', 'download-counter-button'); ?></li>
                                </ul>
                            </div>
                            <div class="col">
                                <h3><?php _e('Extras', 'download-counter-button'); ?></h3>
                                <ul class="st-list">
                                    <li><?php _e('Hide Counts for User', 'download-counter-button'); ?> (<a href="https://wordpress.org/support/topic/hide-counter-for-users/" target="_blank"><?php _e('Idea of', 'download-counter-button'); ?></a>)</li>
                                    <li><?php _e('External URLs can be used', 'download-counter-button'); ?> (<a href="https://wordpress.org/support/topic/doesnt-work-with-dropbox-links/" target="_blank"><?php _e('Idea of', 'download-counter-button'); ?></a>)</li>
                                    <li><?php _e('Short code default settings', 'download-counter-button'); ?> (<a href="https://wordpress.org/support/topic/plugin-is-not-working-46/#post-8178052" target="_blank"><?php _e('Idea of', 'download-counter-button'); ?></a>)</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </li>
                <li class="st_melibuPlugin_list_item_3">
                    <div class="st_melibuPlugin_list_content">
                        <h3><?php _e('Support', 'download-counter-button'); ?></h3>
                        <hr />
                        <div class="feature-section two-col">
                            <div class="col">
                                <h3><?php _e('In like please give', 'download-counter-button'); ?> <?php echo $datas['Name']; ?></h3>
                                <ul>
                                    <li><span class="dashicons dashicons-thumbs-up"></span>
                                        <a href="https://wordpress.org/support/view/plugin-reviews/<?php echo $datas['TextDomain']; ?>" target="_blank"><?php _e('WordPress Rate', 'download-counter-button'); ?></a>
                                    </li>
                                    <li><span class="dashicons dashicons-thumbs-up"></span>
                                        <a href="https://plus.google.com/u/0/b/112736162951079313360/112736162951079313360" target="_blank">Google+</a>
                                    </li>
                                    <li><span class="dashicons dashicons-thumbs-up"></span>
                                        <a href="https://www.facebook.com/wordpress.melibu/" target="_blank">Facebook</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                <h3><?php _e('Feel free and post your question, suggestion, idea or criticism. We love it!', 'download-counter-button'); ?></h3>
                                <ul>
                                    <li><span class="dashicons dashicons-sos"></span> <?php _e('For Plugin English Support', 'download-counter-button'); ?>
                                        <a href="https://wordpress.org/support/plugin/<?php echo $datas['TextDomain']; ?>" target="_blank"><?php _e('Support EN', 'download-counter-button'); ?></a>
                                    </li>
                                    <li><span class="dashicons dashicons-sos"></span> <?php _e('For Plugin German Support', 'download-counter-button'); ?>
                                        <a href="https://plus.google.com/u/0/communities/106070505484298900786" target="_blank"><?php _e('Support DE', 'download-counter-button'); ?></a>
                                    </li>
                                    <li><span class="dashicons dashicons-sos"></span> <?php _e('For Plugin Turkey Support', 'download-counter-button'); ?>
                                        <a href="https://plus.google.com/u/0/communities/111364399553479782817" target="_blank"><?php _e('Support TR', 'download-counter-button'); ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="st_melibuPlugin_list_item_4">
                    <div class="st_melibuPlugin_list_content">
                        <h3><?php _e('Development ', 'download-counter-button'); ?></h3>
                        <hr />
                        <ul>
                            <li>
                                <h3><?php _e('Author', 'download-counter-button'); ?></h3>
                                <a href="https://profiles.wordpress.org/prodeveloper/">
                                    <img src="//www.gravatar.com/avatar/93bdbf0f9c1262bdb6a559194213e63d?s=150&amp;r=g&amp;d=mm" class="avatar user-14722029-avatar avatar-150 photo" alt="Profile picture of Samet Tarim" height="150" width="150">
                                </a>
                                <p>
                                    <?php _e('Founder and Project Manager', 'download-counter-button'); ?><br />
                                    <span class="dashicons dashicons-welcome-learn-more"></span>
                                    <a href="http://samet-tarim.de/" target="_blank">Dipl. Web Engineer, Samet Tarim</a>
                                </p>
                            </li>
                            <li>
                                <h3><?php _e('Contributors', 'download-counter-button'); ?></h3>
                                <a href="https://profiles.wordpress.org/projectmate/">
                                    <img src="//www.gravatar.com/avatar/403021844ef89f1ced9663c5708eb3ab?s=150&amp;r=g&amp;d=mm" class="avatar user-14822683-avatar avatar-150 photo" alt="Profile picture of Volkan Tarim" height="150" width="150">
                                </a>
                                <p>
                                    <?php _e('Project manager', 'download-counter-button'); ?><br />
                                    <span class="dashicons dashicons-welcome-learn-more"></span>
                                    <a href="http://volkan-tarim.de/" target="_blank"><?php _e('Economic Computer Science', 'download-counter-button'); ?>, Volkan Tarim</a>
                                </p>
                            </li>

                            <li class="wp-person"><h3><?php _e('Marketing', 'download-counter-button'); ?></h3> 
                                <p>
                                    <a href="http://samet-tarim.de/" target="_blank">Samet Tarim</a>, 
                                    <a href="http://volkan-tarim.de/" target="_blank">Volkan Tarim</a>
                                </p>
                            </li>
                            <li class="wp-person"><h3><?php _e('Developer', 'download-counter-button'); ?></h3>
                                <p>
                                    <a href="http://samet-tarim.de/" target="_blank">Samet Tarim</a>, 
                                    <a href="http://volkan-tarim.de/" target="_blank">Volkan Tarim</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="st_melibuPlugin_list_item_5">
                    <div class="st_melibuPlugin_list_content">
                        <h3><?php _e('Thanks all Translaters', 'download-counter-button'); ?></h3>
                        <hr />
                        <p>
                            <span class="dashicons dashicons-translation"></span> <?php _e('Translate this Plugin', 'download-counter-button'); ?>: <a href="https://translate.wordpress.org/projects/wp-plugins/<?php echo $datas['TextDomain']; ?>" target="_blank"><?php _e('Translate', 'download-counter-button'); ?></a>
                        </p>
                        <hr />
                        <ul>
                            <li><a target="_blank" href="https://profiles.wordpress.org/fxbenard/">fxbenard</a> (French (France))</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/jmvdp/">JMDP</a> (French (France))</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/vincentbray/">VincentBray</a> (French (France))</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/linuxmaster/">linuxmaster</a> (Russian)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/jsousa/">JSousa</a> (Spanish (Spain))</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/venerdi/">venerdi</a> (Italian)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/marcochiesi/">Marco Chiesi</a> (Italian)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/rubenw/">Ruben Woudsma</a> (Dutch Nederlands)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/mpol/">Marcel Pol</a> (Dutch Nederlands)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/mobby2561/">Tomáš Hrdina</a> (Czech Čeština‎)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/foxtrot_cz/">Foxtrot</a> (Czech Čeština‎)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/kalich5/">Michal Janata</a> (Czech Čeština‎)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/thee17/">Charles E. Frees-Melvin</a> (English (Canada))</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/christophherr/">Christoph Herr</a> (English (Canada))</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/fgywp/">FYGureout</a> (Hungarian Magyar)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/nao/">Naoko Takano</a> (Japanese 日本語)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/shoheitanaka/">shohei.tanaka</a> (Japanese 日本語)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/fn9m-tkhslivejp/">vostro1520</a> (Japanese 日本語)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/tai/">JOTAKI Taisuke</a> (Japanese 日本語)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/valeriutihai/">Valeriu Tihai</a> (Romanian Română)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/adrianpop/">Adrian Pop</a> (Romanian Română)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/deconf/">Alin Marcu</a> (Romanian Română)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/pixelfisch/">pixelfisch</a> (German Deutsch)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/trkr/">Turker YILDIRIM</a> (Turkish Türkçe)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/catiakitahara/">Catia Kitahara</a> (Portuguese (Brazil))</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/romanbon/">Roman Bondar</a> (Ukrainian Українська)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/nomatter13/">nomatter13</a> (Ukrainian Українська)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/georgwp/">Georg</a> (Danish Dansk)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/tmejer/">tmejer</a> (Danish Dansk)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/culturemark/">Mark Thomas Gazel</a> (Danish Dansk)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/arhipaiva/">arhipaiva</a> (Finnish Suomi)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/knome/">knome</a> (Finnish Suomi)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/hpguru/">hpguru</a> (Finnish Suomi)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/pokeraitis/">Justina</a> (Lithuanian Lietuvių kalba)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/ideag/">Arunas Liuiza</a> (Lithuanian Lietuvių kalba)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/iworks/">Marcin Pietrzak</a> (Polish Polski)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/drozdz/">Krzysiek Dróżdż</a> (Polish Polski)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/ocean90/">Dominik Schilling (ocean90)</a> (Polish Polski)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/muhsinmushviq/">Mushviq Abdulla</a> (Azerbaijani Azərbaycan dili)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/agfare/">Agfare</a> (Belarusian Беларуская мова)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/reitermarkus/">reitermarkus</a> (German Deutsch (Formal))</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/tobiasbg/">TobiasBg</a> (German Deutsch (Formal))</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/pixelfisch/">pixelfisch</a> (German Deutsch (Formal))</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/coachbirgit/">Birgit Olzem</a> (German Deutsch (Formal))</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/kosvrouvas/">Kostas Vrouvas</a> (Greek)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/dyrer/">dyrer</a> (Greek)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/ramiy/">Rami Yushuvaev</a> (Hebrew)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/1anand/">1anand</a> (Hindi)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/rajeevbhandari/">RajeevBhandari</a> (Hindi)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/gagan0123/">Gagan Deep Singh</a> (Hindi)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/qzoners/">Lutvi Avandi</a> (Indonesian)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/angeloverona/">angeloverona</a> (Slovak Slovenčina)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/igorlopasovsky/">Igor Lopasovsky</a> (Slovak Slovenčina)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/dimadin/">Milan Dinić</a> (Serbian Српски језик)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/marcusfrontender/">Marcus Tisäter</a> (Swedish Svenska)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/bjornctecse/">bjorn@ctec.se</a> (Swedish Svenska)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/pedromendonca/">Pedro Mendonça</a> Portuguese (Portugal)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/webdados/">Marco Almeida | Webdados</a> Portuguese (Portugal)</li>
                            <li><a target="_blank" href="https://profiles.wordpress.org/lightningspirit/">Vitor Carvalho</a> Portuguese (Portugal)</li>
                            <li><a target="_blank" href="https://translate.wordpress.org/projects/wp-plugins/download-counter-button/">More...</a></li>
                        </ul>
                    </div>
                </li>
                <li class="st_melibuPlugin_list_item_6">
                    <div class="st_melibuPlugin_list_content">
                        <h3><?php _e('Donate', 'download-counter-button'); ?></h3>
                        <p>
                            <?php _e('Development is fueled by your praise and feedback', 'download-counter-button'); ?>
                        </p>
                        <hr />
                        <p>
                            <?php _e('In how you can support us so that we can further develop this plugin regularly, it may not always be financially, so you will give us feedback or recommend us, please give us a review, Liken our Facebook page or sponsor us, so that we further useful free plugins can develop.', 'download-counter-button'); ?>
                        </p>    
                        <p>
                            <?php _e('You see, it is much more possible if you want to support something, thanks to all the Support Us.', 'download-counter-button'); ?>
                        </p>
                        <img src="<?php echo plugins_url('img/paypal-logo.jpg', dirname(__FILE__)); ?>" alt="" width="130" height="35"/>
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="BN988PMGBEB2S">
                            <input type="image" src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="<?php _e('Now simply, quickly and safely pay online - with PayPal.', 'download-counter-button'); ?>">
                            <img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
                        </form>
                        <p>
                            <?php _e('LOOK FOR SPONSOR !!!', 'download-counter-button'); ?>
                        </p>
                        <p>
                            <em><?php _e('Your Melibu Team', 'download-counter-button'); ?></em>
                        </p>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</div>