<?php

/*

Plugin Name: Helpdesk for tech and design needs

Description: Chat support for any technical, design or marketing issues related to wordpress, directly in your wordpress dashboard. No more going to forums to solve silly questions, no more sorting strange bidders on freelancing site everytime you need help.

Plugin URI: http://www.theitoons.com/

Author URI: http://www.theitoons.com/

Author: TheIToons

License: GPL

Version: 2.2

*/



/**

 * PART 1. Defining Database Table

 * ============================================================================

 *

 * In this part you are going to define custom database table,

 * create it, update, and fill with some dummy data

 *

 * http://codex.wordpress.org/Creating_Tables_with_Plugins

 *

 * In case your are developing and want to check plugin use:

 *

 * DROP TABLE IF EXISTS wp_support;

 * DELETE FROM wp_options WHERE option_name = 'support_install_data';

 *

 * to drop table and option

 */



/**

 * $custom_table_example_db_version - holds current database version

 * and used on plugin update to sync database tables

 */

global $support_db_version;

$support_db_version = '1.1'; // version changed from 1.0 to 1.1

//define('MOM_KEY','xY5Uv37rP2');



/**

 * register_activation_hook implementation

 *

 * will be called when user activates plugin first time

 * must create needed database tables

 */

/*
Function name prefix 'tiwsp' = theitoons wordpress support
*/

function tiwsp_support_install()

{

    global $wpdb;

    global $support_db_version;

    $charset_collate = $wpdb->get_charset_collate();

    $table_name = $wpdb->prefix . 'tiwsp_support'; // do not forget about tables prefix

    

    add_option('support_db_version', $support_db_version);



    

    $installed_ver = get_option('support_db_version');

    if ($installed_ver != $support_db_version) {

        update_option('support_db_version', $support_db_version);

    }

}



register_activation_hook(__FILE__, 'tiwsp_support_install');



/**

 * register_activation_hook implementation

 *

 * [OPTIONAL]

 * additional implementation of register_activation_hook

 * to insert some dummy data

 */

function tiwsp_support_install_data()

{

    global $wpdb;

}



register_activation_hook(__FILE__, 'tiwsp_support_install_data');



/**

 * Trick to update plugin database, see docs

 */

function tiwsp_support_update_db_check()

{

    global $support_db_version;

    if (get_site_option('support_db_version') != $support_db_version) {

        //support_install();

    }

}



add_action('plugins_loaded', 'tiwsp_support_update_db_check');



/**

 * PART 3. Admin page

 * ============================================================================

 *

 * In this part you are going to add admin page for custom table

 *

 * http://codex.wordpress.org/Administration_Menus

 */



/**

 * admin_menu hook implementation, will add pages to list persons and to add new one

 */

function tiwsp_support_admin_menu()

{

  //add_action( 'admin_enqueue_scripts', 'enqueue_date_picker' );

  

    add_menu_page(__(

                    'Support', 

                    'support'), 

                    __('TheIToons Support', 'support'), 

                    'manage_options', 

                    'Support', 

                    'support_handler',

                    plugins_url('icon.png', __FILE__),

                    3

                    );

}
add_action('admin_menu', 'tiwsp_support_admin_menu');



function tiwsp_support_page_styles()
{
    // Register the style like this for a plugin:
    wp_register_style( 'custom-style', plugins_url( 'style.css', __FILE__ ), array(), '', 'all' );
    
    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'custom-style' );

    // Register the style like this for a plugin:
    wp_enqueue_script( 'custom-script', plugins_url( 'script.js', __FILE__ ), array(), 'true', 'all' );
}

add_action( 'admin_enqueue_scripts', 'tiwsp_support_page_styles' );


function support_handler(){

    echo "<div class='tiwsp'>";
    //echo '<iframe height=800 width=1300 src="http://www.tawk.to/theitoons"></iframe>';
    echo "<div id='tawk_56656b7ad7a97578329c83e1' style='display: inline-block'></div> <script type='text/javascript'> var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date(); Tawk_API.embedded='tawk_56656b7ad7a97578329c83e1'; (function(){ var s1=document.createElement('script'),s0=document.getElementsByTagName('script')[0]; s1.async=true; s1.src='https://embed.tawk.to/56656b7ad7a97578329c83e1/1a64cgl0b'; s1.charset='UTF-8'; s1.setAttribute('crossorigin','*'); s0.parentNode.insertBefore(s1,s0);})(); </script>";
    

    echo '<div id="rightside" style="display: none">
    
    <h1>Let us support each other</h1>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<table>
<tr><td><input type="hidden" name="on0" value="Tips to support this plugin">Tips to support this plugin</td></tr><tr><td><select name="os0">
    <option value="Buy us a coffee">Buy us a coffee $2.00 USD</option>
    <option value="Buy us a breakfast">Buy us a breakfast $10.00 USD</option>
    <option value="Buy us a lunch/dinner">Buy us a lunch/dinner $25.00 USD</option>
    <option value="Buy us a full day to help people in need">Buy us a full day to help people in need $100.00 USD</option>
</select> </td></tr>
<tr><td><input type="hidden" name="on1" value="Few words about our plugin">Few words about our plugin</td></tr><tr><td><input type="text" name="os1" maxlength="200"></td></tr>
<tr><td><input type="hidden" name="on2" value="Feedback (if you have any)">Feedback (if you have any)</td></tr><tr><td><input type="text" name="os2" maxlength="200"></td></tr>
</table>
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIIgQYJKoZIhvcNAQcEoIIIcjCCCG4CAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYAIzefKrKvig3fQSEKK1lBPvIpWjDoZNyu3aXraNFUVL37Aztt0INrNFtymromLsip3FoGUbm0lqBwAlgJRbFXfLOPJ1jrv+9gr9NTUTFa/201isRnKhp9B41vVNmjN+lVcxO/qtErDkmTSVGKZ+sWxVzHV5YaDGl3RmxMTtZPWVjELMAkGBSsOAwIaBQAwggH9BgkqhkiG9w0BBwEwFAYIKoZIhvcNAwcECBxXja0xohJkgIIB2A7FNpnKeinRv1RMZPFSJskLr0rvyZELJDDh9KhFlg75iQ3fa/rF6ZKoUX97eUOfcSSsYhq7dTT1TR4GMCPhKMgCFBN4JJTMHRDMbOd/BHeHKEMpBhiZfkCGQj8aK+ydwDm+jAi+DfQiEPzYSyHqSQxApdO/tUHhefON4VfpPMt1OQSFwnLyWpGynmpnvQY1QKnLS/mkwTstICrpNIdM7R1FpDdG8gEwerfhFfN9neVrHFf9ZxYmwtv9Uscb9jvMWxmLw/v9cBNUUtYkquAf8QvG5yrDvcfOVcs1GTqnkLU7/zwmxPbIvcD3JQY2H1WFbPRrHuQ8fbotEhPiQBI6PcwhHceFkaOvl5yyOr0XgNF9w3vhjjFJMhEiCTfqipZem36bDB0mxkPL4tCAOseFAd4iRv7nswFfItBneQXUciTJkJOPgOrDZB2xGlnCGbaDux4Zu6VM1g8K8NuV7yor932cwCXS1k+ZhZyv+XdRMRC98UaiQWTOkgth9AGLDWuq1oa6bysE5S+dhiu1kcL+GSsshjZrWrPMo4urkocfNnGcceWjAri4gOBC1mAtn/gKuIGWMpIfac9zOvNscejAMkZ1j1Ma86TBa2vHcvKPEjUa2J1BF3AvZTKgggOHMIIDgzCCAuygAwIBAgIBADANBgkqhkiG9w0BAQUFADCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wHhcNMDQwMjEzMTAxMzE1WhcNMzUwMjEzMTAxMzE1WjCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wgZ8wDQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBAMFHTt38RMxLXJyO2SmS+Ndl72T7oKJ4u4uw+6awntALWh03PewmIJuzbALScsTS4sZoS1fKciBGoh11gIfHzylvkdNe/hJl66/RGqrj5rFb08sAABNTzDTiqqNpJeBsYs/c2aiGozptX2RlnBktH+SUNpAajW724Nv2Wvhif6sFAgMBAAGjge4wgeswHQYDVR0OBBYEFJaffLvGbxe9WT9S1wob7BDWZJRrMIG7BgNVHSMEgbMwgbCAFJaffLvGbxe9WT9S1wob7BDWZJRroYGUpIGRMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbYIBADAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBBQUAA4GBAIFfOlaagFrl71+jq6OKidbWFSE+Q4FqROvdgIONth+8kSK//Y/4ihuE4Ymvzn5ceE3S/iBSQQMjyvb+s2TWbQYDwcp129OPIbD9epdr4tJOUNiSojw7BHwYRiPh58S1xGlFgHFXwrEBb3dgNbMUa+u4qectsMAXpVHnD9wIyfmHMYIBmjCCAZYCAQEwgZQwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tAgEAMAkGBSsOAwIaBQCgXTAYBgkqhkiG9w0BCQMxCwYJKoZIhvcNAQcBMBwGCSqGSIb3DQEJBTEPFw0xNTEyMTAwMDA1MTRaMCMGCSqGSIb3DQEJBDEWBBQQQ4nuWZyUyP792jYlKFUIJV/VFzANBgkqhkiG9w0BAQEFAASBgCaVDC5oDpP5trOMujFIDK9rNQgVr2mJOYKHluG/L3piTmDRhRqvSFTiL2aSCtHzbsIMaUfGvw5f+tbEpv5vxNrVdajLVG3nrf5+fQTdMEHBSjuKuH/JCAnnj9dsWtosfWEJXhJZL9x1vTH4xCo54KTKlMlcGghdq4saeDVfHioB-----END PKCS7-----
">
<input type="image" src="http://www.theitoons.com/patron-button.png" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>
</div>';

echo "</div> <!-- .tiwsp ends -->";

echo '<!-- start Mixpanel --><script type="text/javascript">(function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2;a=e.createElement("script");a.type="text/javascript";a.async=!0;a.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"file:"===e.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";f=e.getElementsByTagName("script")[0];f.parentNode.insertBefore(a,f)}})(document,window.mixpanel||[]);
mixpanel.init("6c32c583cb3679cbaa6e9d592b5e38c9");</script><!-- end Mixpanel -->';

echo '<script type="text/javascript"> mixpanel.track("Pageview"); </script>';

}