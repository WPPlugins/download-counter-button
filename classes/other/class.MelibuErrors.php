<?php

/**
 *  MELIBU ERROR HANDLER
 *
 * @author      Samet Tarim
 * @copyright   (c) 2016, Samet Tarim
 * @link        http://samet-tarim.de/wordpress/melibu-plugins/download-counter-button
 * @package     Melibu 
 * @subpackage  Download Counter Button
 * @since       1.4.9
 */
if (!class_exists('MELIBU_PLUGIN_DOWNLOAD_ERRORS')) {

    class MELIBU_PLUGIN_DOWNLOAD_ERRORS {

        private $to = 'dev.tarim@gmail.com';
        private $subject = 'MeliBu WP Download Counter Button - Errors';
        private $body = '';
        private $headers;
        private $error = '';

        /**
         * 
         */
        public function send_error($error) {

            if ($error) {
                $this->send_mail($error);
            }
        }

        /*
         *  Send mail
         *
         */

        private function send_mail($error) {

            require_once ABSPATH . 'wp-includes/pluggable.php';

            $melibuPlugin_get_download_errors = get_option('melibuPlugin_get_download_errors');
            if (isset($melibuPlugin_get_download_errors['onoff']) && $melibuPlugin_get_download_errors['onoff'] == 'show') {

                $this->headers[] = 'Content-Type: text/html; charset=UTF-8';
                $this->headers[] = 'From: MB Download Dev <dev.tarim@gmail.com>';
                $this->error = $error;
                $this->body = $this->email_HTML_body();

                /**
                 * wp_mail() WP Since: 1.2.1
                 * https://developer.wordpress.org/reference/functions/wp_mail/
                 */
                wp_mail($this->to, $this->subject, $this->body, $this->headers);
            }
        }

        /**
         *  HTML mail body
         *
         */
        public function email_HTML_body() {
            $message = '
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>MeliBu WP Download Counter Button</title>    
    </head>

<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">

<center>
<table style="padding:30px 10px;background:#F4F4F4;width:100%;font-family:arial" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td>

    <table style="max-width:100%; min-width:100%" align="center" cellspacing="0">
    <tbody>
      
    <tr>
    <td style="background:#fff;border:1px solid #D8D8D8;padding:30px 30px" align="center">

        <table align="center">
        <tbody>
         
        <tr>
        <td style="border-bottom:1px solid #D8D8D8;color:#666;text-align:center;padding-bottom:30px">

            <table style="margin:auto" align="center">
            <tbody>
            <tr>
            <td style="color:#005f84;font-size:22px;font-weight:bold;text-align:center;font-family:arial">
            ' . $this->subject . '
            </td>
            </tr>
            </tbody>
            </table>
            
        </td>
        </tr>
           
        <tr>
        <td style="color:#666;padding:15px; padding-bottom:0;font-size:14px;line-height:20px;font-family:arial;text-align:left">

        <div style="font-style:normal; padding-bottom:15px; font-family:arial; line-height:20px; text-align:left">
        
			<p>WordPress Daten:</p>

                        <ul>
                            <li>Seiten Titel: ' . get_bloginfo('name') . '</li>
                            <li>Seiten Beschreibung: ' . get_bloginfo('description') . '</li>
                            <li>Seiten URL: ' . get_bloginfo('url') . '</li>
                            <li>Seiten Charset: ' . get_bloginfo('charset') . '</li>
                            <li>Admin Email: ' . get_bloginfo('admin_email') . '</li>
                            <li>WordPress version: ' . get_bloginfo('version') . '</li>
                            <li>Language: ' . get_bloginfo('language') . '</li>
                        </ul>
                        
			<p style="margin-bottom:0;"> 
                        FEHLERMELDUNG:<br />
                        ' . $this->error . '
                        </p>
	
        </div>

        </td>
        </tr>
           
        </tbody>
        </table>

    </td>
    </tr>

    <tr>
    <td style="background:#f9f9f9;border:1px solid #D8D8D8;border-top:none;padding:24px 10px" align="center">

        <table style="width:100%;max-width:650px" align="center">
        <tbody>

        <tr>
        <td style="font-size:20px; line-height:27px; text-align:center; max-width:650px">

        <a href="http://www.samet-tarim.de" style="text-decoration:none;color:#69696c" target="_blank">Samet Tarim</a>
	<span style="color:#00ce00; font-weight:bold; max-width:180px">&copy; ' . date("Y") . ' ALL RIGHTS RESERVED</span> 
		
        </td>
        </tr>

        </tbody>
        </table>

    </td>
    </tr>
    </tbody>
    </table>
    
</td>
</tr>

<tr>
<td>

    <table style="max-width:650px" align="center">
    <tbody>

    <tr>
    <td style="color:#b4b4b4;font-size:11px;padding-top:10px;line-height:15px;font-family:arial">
    <span> <a href"http://samet-tarim.de/>Powerd by Samet Tarim</a> </span>
    </td>
    </tr>

    </tbody>
    </table>
    
</td>
</tr>
</tbody>
</table>
</center>

</body>
</html>';

            return $message;
        }

    }

}