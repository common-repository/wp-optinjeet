<?php
/*
  Plugin Name: WP OptinJeet
  Plugin URI: http://teknikforce.com
  Description: Create Form Lists and Mange leads
  Author: Teknikforce
  Version: 1.0
 */


define('optinjeet_pluginurl',plugins_url("",__FILE__));

    add_action('admin_menu','mt_add_optinJeet'); 


foreach (glob(plugin_dir_path(__FILE__) . "class/*.php") as $file) {
    include_once $file;
}
foreach (glob(plugin_dir_path(__FILE__) . "class/admin/*.php") as $file) {
    include_once $file;
}



if(!function_exists('css_js_add_to_head_of_wp_optinjeet'))
{
    function css_js_add_to_head_of_wp_optinjeet()
    {
        wp_enqueue_script('jquery');

        wp_register_style('optinjeet_primary_style',optinjeet_pluginurl.'/css/style.css');
        wp_enqueue_style('optinjeet_primary_style');

        wp_register_script('optinjeet_admin_sight_js',optinjeet_pluginurl.'/js/custom.js');
        wp_enqueue_script('optinjeet_admin_sight_js');

        wp_register_script('optinjeet_jqry_datatables',optinjeet_pluginurl.'/datatables-1.9.4/js/jquery.dataTables.min.js');
        wp_enqueue_script('optinjeet_jqry_datatables');

        wp_register_script('optinjeet_dtable_tools', optinjeet_pluginurl.'/datatables-1.9.4/tabletools-2.2.0/js/dataTables.tableTools.js');
        wp_enqueue_script('optinjeet_dtable_tools');

        wp_register_script('optinjeet_datatables_columnfilter',optinjeet_pluginurl.'/datatables-1.9.4/jquery.dataTables.columnFilter.js');
        wp_enqueue_script('optinjeet_datatables_columnfilter');

        wp_register_style('optinjeet_datatables_css',optinjeet_pluginurl.'/datatables-1.9.4/css/jquery.dataTables.css');
        wp_enqueue_style('optinjeet_datatables_css');

        wp_register_style('optinjeet_dataTables_tableTools_css',optinjeet_pluginurl.'/datatables-1.9.4/tabletools-2.2.0/css/dataTables.tableTools.css');
        wp_enqueue_style('optinjeet_dataTables_tableTools_css');

    }
}

if(!function_exists('optinjeetwp_adminarea_specific_scripts'))
{
    function optinjeetwp_adminarea_specific_scripts()
    {
        wp_register_script('wpoptinjeet_validate_min_js',optinjeet_pluginurl.'/js/jquery.validate.min.js');
        wp_enqueue_script('wpoptinjeet_validate_min_js');

        wp_register_script('wpoptinjeetadminarea_bootstrap_js',optinjeet_pluginurl."/bootstrap/js/bootstrap.min.js");
        wp_enqueue_script('wpoptinjeetadminarea_bootstrap_js');

        wp_register_style('wpoptinjeetadminarea_bootstrap_css',optinjeet_pluginurl."/bootstrap/css/bootstrap.min.css");
        wp_enqueue_style('wpoptinjeetadminarea_bootstrap_css');

        wp_register_style('wpoptinjeet_sendmail_css',optinjeet_pluginurl.'/css/send_email.css');
        wp_enqueue_style('wpoptinjeet_sendmail_css');

        wp_register_script('wpoptinjeet_niceeditor',optinjeet_pluginurl.'/js/nicEdit-latest.js');
        wp_enqueue_script('wpoptinjeet_niceeditor');

        wp_register_script('wpoptinjeet_jquery_md5',optinjeet_pluginurl.'/admin/js/jquery.md5.js');


        if(isset($_GET['page']) && ($_GET['page']=='sub-optinJeet_smtp_settings' || $_GET['page']=='sub-optinJeet_createall_smtp_settings'))
        {
            wp_register_style('optin_jeet_create_smtp_style',optinjeet_pluginurl.'/css/create_smtp_setting.css');
            wp_enqueue_style('optin_jeet_create_smtp_style');
        }
        if(isset($_GET['page']) && $_GET['page']=='sub-optinJeet_send_by_email_list')
        {
            wp_register_style('optinjeet_sendby_emaillist',optinjeet_pluginurl.'/css/send_email_list.css');
            wp_enqueue_style('optinjeet_sendby_emaillist');
        }
        if(isset($_GET['page']) && ($_GET['page']=='sub-optinJeet_php_email_settings'))
        {
            wp_register_style('sub-optinJeet_php_email_settings_css',optinjeet_pluginurl.'/css/php_email_setting.css');
            wp_enqueue_style('sub-optinJeet_php_email_settings_css');
        }
    }
}

if(!function_exists('add_wp_optin_jeet_css_js_at_head'))
{
    function add_wp_optin_jeet_css_js_at_head()
    {
        $wpoptinjeetarraypage=array('mt-top-optinJeet-handle','sub-createoptinJeet_list','sub-createoptinJeet_Optin','sub-optinJeet_list','sub-optinJeet_Optin','sub-optinJeet_send_email','sub-optinJeet_send_by_email_list','sub-optinJeet_php_email_settings','sub-optinJeet_smtp_settings','sub-optinJeet_createall_smtp_settings','sub-optinJeet_all_smtppp_settings','sub-history_Optin');
        if(isset($_GET['page']))
        {
            if(in_array($_GET['page'],$wpoptinjeetarraypage))
            {
                css_js_add_to_head_of_wp_optinjeet();
                optinjeetwp_adminarea_specific_scripts();
            }
        }
    }
}
add_action( 'admin_enqueue_scripts', 'add_wp_optin_jeet_css_js_at_head');

add_action('admin_footer',function(){
    $wpoptinjeetarraypage=array('mt-top-optinJeet-handle','sub-createoptinJeet_list','sub-createoptinJeet_Optin','sub-optinJeet_list','sub-optinJeet_Optin','sub-optinJeet_send_email','sub-optinJeet_send_by_email_list','sub-optinJeet_php_email_settings','sub-optinJeet_smtp_settings','sub-optinJeet_all_smtppp_settings','sub-history_Optin');

    if(isset($_GET['page']) && in_array($_GET['page'],$wpoptinjeetarraypage))
    {
        echo '<span class="pull-right" style="bottom:0px;right:0px;margin-bottom:35px;margin-right:10px;position:absolute"><a href="https://teknikforce.com" target="_BLANK"><img src="'.esc_url(plugins_url('images/tekniklogo.png',__FILE__)).'" style="cursor:pointer"></a></span>';
    }

});

if(!function_exists('shortcode_of_wpoptinjeet_css_js'))
{
    function shortcode_of_wpoptinjeet_css_js()
    {
        $shortcode='leadGenerate_jeetOptin'; $post_id=false;
        global $post;
        $post_obj   = get_post( $post->ID );
        if (stripos($post_obj->post_content, '[' . $shortcode ) !== false) 
        {
            css_js_add_to_head_of_wp_optinjeet();
        }

    }
}
add_action('wp_enqueue_scripts','shortcode_of_wpoptinjeet_css_js');
add_action('wp_enqueue_scripts','shortcode_of_wpoptinjeet_usersitecss');

if(!function_exists('shortcode_of_wpoptinjeet_usersitecss'))
{
    function shortcode_of_wpoptinjeet_usersitecss()
    {
        wp_register_style('wpoptinjeetusercss',optinjeet_pluginurl.'/css/jeet.css');
            wp_enqueue_style('wpoptinjeetusercss');  
    }
}
if(!function_exists('mt_add_optinJeet'))
{
function mt_add_optinJeet() {
    add_menu_page(__('WP OptinJeet', 'menu-test'), __('WP OptinJeet', 'menu-test'), 'manage_options', 'mt-top-optinJeet-handle', 'optinJeetfunc');
    add_submenu_page('mt-top-optinJeet-handle', __('Create Lists', 'menu-test'), __('Create Lists', 'menu-test'), 'manage_options', 'sub-createoptinJeet_list', 'mt_sublevel_createoptinJeet_list');
    add_submenu_page('mt-top-optinJeet-handle', __('Create Optins', 'menu-test'), __('Create Optins', 'menu-test'), 'manage_options', 'sub-createoptinJeet_Optin', 'mt_sublevel_CreateoptinJeet_Optin');
    add_submenu_page('mt-top-optinJeet-handle', __('Lists', 'menu-test'), __('Lists', 'menu-test'), 'manage_options', 'sub-optinJeet_list', 'mt_sublevel_optinJeet_list');
    add_submenu_page('mt-top-optinJeet-handle', __('Optins', 'menu-test'), __('Optins', 'menu-test'), 'manage_options', 'sub-optinJeet_Optin', 'mt_sublevel_optinJeet_Optin');
    add_submenu_page('mt-top-optinJeet-handle', __('Send Email', 'menu-test'), __('Send Email', 'menu-test'), 'manage_options', 'sub-optinJeet_send_email', 'mt_sublevel_optinJeet_send_email');
    add_submenu_page('mt-top-optinJeet-handle', __('Send Email by Email List', 'menu-test'), __('Send Email by Email List', 'menu-test'), 'manage_options', 'sub-optinJeet_send_by_email_list', 'mt_sublevel_optinJeet_send_by_email_list');
    add_submenu_page('mt-top-optinJeet-handle', __('PHP Email Settings', 'menu-test'), __('PHP Email Settings', 'menu-test'), 'manage_options', 'sub-optinJeet_php_email_settings', 'mt_sublevel_optinJeet_php_email_settings');
    add_submenu_page('mt-top-optinJeet-handle', __('Create SMTP Settings', 'menu-test'), __('Create SMTP Settings', 'menu-test'), 'manage_options', 'sub-optinJeet_smtp_settings', 'mt_sublevel_optinJeet_smtp_settings');
    add_submenu_page('mt-top-optinJeet-handle', __('All SMTP Settings', 'menu-test'), __('All SMTP Settings', 'menu-test'), 'manage_options', 'sub-optinJeet_all_smtppp_settings', 'mt_sublevel_optinJeet_all_smtp_settings'); 
    add_submenu_page('mt-top-optinJeet-handle1', __('Create all smtp', 'menu-test'), __('Create all smtp', 'menu-test'), 'manage_options', 'sub-optinJeet_createall_smtp_settings', 'mt_sublevel_Show_optinJeet_all_smtp_settings');
    add_submenu_page('mt-top-optinJeet-handle', __('History', 'menu-test'), __('History', 'menu-test'), 'manage_options', 'sub-history_Optin', 'mt_history_optinJeet_Optin'); 
}
}

if(!function_exists('optinJeetfunc'))
{
    function optinJeetfunc() {
        $obj = new optinJeet_admin();
        $obj->header_image_optin();
        $obj->optinJeet_all_area();
        $obj->footer_image_optin();
    }
}
if(!function_exists('mt_sublevel_optinJeet_list'))
{
function mt_sublevel_optinJeet_list() {
    $obj = new optinJeet_admin();
    $obj->header_image_optin();
    $obj->form_Leads_Data();
    $obj->footer_image_optin();
}
}
if(!function_exists('mt_sublevel_optinJeet_Optin'))
{
    function mt_sublevel_optinJeet_Optin() {
        $obj = new optinJeet_admin();
        $obj->header_image_optin();
        $obj->form_Optin_Data();
        $obj->footer_image_optin();
    }
}
if(!function_exists('mt_sublevel_createoptinJeet_list'))
{
    function mt_sublevel_createoptinJeet_list() {
        $obj = new optinJeet_admin();
        $obj->header_image_optin();
        echo "<div class='singLeOptinMenu'>";
        $obj->optinJeet_CreateList();
        echo "</div>";
        $obj->footer_image_optin();
    }
}

if(!function_exists('mt_sublevel_createoptinJeet_Optin'))
{
    function mt_sublevel_createoptinJeet_Optin() {
        $obj = new optinJeet_admin();
        $obj->header_image_optin();
        echo "<div class='singLeOptinMenu'>";
        $obj->optinJeet_CreateOptin();
        echo "</div>";
        $obj->footer_image_optin();
    }
}

add_shortcode("leadGenerate_jeetOptin", "leadGenerate_jeetOptin");

if(!function_exists('leadGenerate_jeetOptin'))
{
    function leadGenerate_jeetOptin() {
        $obj = new optinJeet_admin();
        $obj->saveLeadOptin();
    }
}

if(!function_exists('mt_Settings_optinJeet_Optin'))
{
function mt_Settings_optinJeet_Optin() {
    $obj = new optinJeet_admin();
    $obj->settings();
}
}

if(!function_exists('mt_sublevel_optinJeet_send_email'))
{
    function mt_sublevel_optinJeet_send_email(){
        $obj1 = new optinJeet_admin1();
        $obj1->header_image_optin(); 
        $obj1->form_send_email();
    }
}

if(!function_exists('mt_sublevel_optinJeet_send_by_email_list'))
{
    function mt_sublevel_optinJeet_send_by_email_list(){
        $obj4 = new optinJeet_admin4();
        $obj4->header_image_optin();
        $obj4->form_send_email_list();
    }
}

if(!function_exists('mt_sublevel_optinJeet_php_email_settings'))
{
    function mt_sublevel_optinJeet_php_email_settings(){
        $obj2 = new optinJeet_admin2();
        $obj2->header_image_optin(); 
        $obj2->form_php_email_settings();
    }
}

if(!function_exists('mt_sublevel_optinJeet_smtp_settings'))
{
    function mt_sublevel_optinJeet_smtp_settings(){
        $obj3 = new optinJeet_admin3();
        $obj3->header_image_optin(); 
        $obj3->form_smtp_settings();



    }
}

if(!function_exists('mt_sublevel_optinJeet_all_smtp_settings'))
{
    function mt_sublevel_optinJeet_all_smtp_settings(){
        $obj5 = new optinJeet_admin5();
        $obj5->header_image_optin(); 
        $obj5->form_edit_delete();
    //  $obj5->form_all_smtp_settings1();
    }
}

if(!function_exists('mt_history_optinJeet_Optin'))
{
    function mt_history_optinJeet_Optin(){
        $obj6 = new optinJeet_admin6();
        $obj6->header_image_optin(); 
        $obj6->history();
    }
}

if(!function_exists('mt_sublevel_show_optinJeet_all_smtp_settings'))
{
function mt_sublevel_show_optinJeet_all_smtp_settings() {
    $obj5 = new optinJeet_admin5();
    $obj5->header_image_optin();
    echo "<div class='singLeEditMenu'>";
    $obj5->optinJeet_edit_delete_list();
    echo "</div>";
   /// $obj5->footer_image_optin();
}
}

define('OPTINJEET_PHPMAIL', 'optinjeet_phpmail');
define('OPTINJEET_SMTP', 'optinjeet_smtp');
define('OPTINJEET_EMAIL', 'optinjeet_email');
define('OPTINJEET_EMAIL_LIST', 'optinjeet_emaillist');

register_activation_hook( __FILE__, 'optinjeet_send_email_callback' );

if(!function_exists('optinjeet_send_email_callback'))
{
        function optinjeet_send_email_callback() {

            global $wpdb;
                
                $charset_collate = '';
                
            if (!empty($wpdb->charset)) {
                $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
            }
            if (!empty($wpdb->collate)) {
                $charset_collate .= " COLLATE {$wpdb->collate}";
            }
                $optinjeet_phpmail = $wpdb->prefix . OPTINJEET_PHPMAIL;
                
            $sql = "CREATE TABLE IF NOT EXISTS {$optinjeet_phpmail} (" .
                "`Id` bigint(11) NOT NULL AUTO_INCREMENT,".				                 
                        "`phpmail_from_email` varchar(200) NOT NULL,".
                        "`phpmail_password` varchar(20) NOT NULL,".    
                        "`timezone` varchar(200) NOT NULL,". 
                "PRIMARY KEY (`id`)".
                    ") {$charset_collate} ENGINE=InnoDB;";
                $wpdb->query($sql); 
                $optinjeet_smtp = $wpdb->prefix . OPTINJEET_SMTP;
                
            $sql1 = "CREATE TABLE IF NOT EXISTS {$optinjeet_smtp} (" .
                "`Id` bigint(11) NOT NULL AUTO_INCREMENT,".				                 
                        "`smtp_name` text NOT NULL,".
                        "`smtp_hostname` varchar(200) NOT NULL,".                 
                        "`smtp_port` int(15) NOT NULL,".
                        "`smtp_from_email` varchar(200) NOT NULL,".   
                        "`smtp_password` varchar(20) NOT NULL,". 
                "PRIMARY KEY (`id`)".
                    ") {$charset_collate} ENGINE=InnoDB;";
                $wpdb->query($sql1);
                
                $optinjeet_email = $wpdb->prefix . OPTINJEET_EMAIL;
                
            $sql2 = "CREATE TABLE IF NOT EXISTS {$optinjeet_email} (" .
                "`Id` bigint(11) NOT NULL AUTO_INCREMENT,".				                 
                        "`mail_to` text NOT NULL,". 
                        "`send_email_by` varchar(200) NOT NULL,". 
                        "`subject` varchar(200) NOT NULL,". 
                        "`mail_sent_at` DATETIME NOT NULL,". 
                        "`status` int(10) NOT NULL,". 
                "PRIMARY KEY (`id`)".
                    ") {$charset_collate} ENGINE=InnoDB;";
                $wpdb->query($sql2);
                
                $optinjeet_emaillist = $wpdb->prefix . OPTINJEET_EMAIL_LIST;
                
            $sql3 = "CREATE TABLE IF NOT EXISTS {$optinjeet_emaillist} (" .
                "`Id` bigint(11) NOT NULL AUTO_INCREMENT,".				                 
                        "`mail_to` text NOT NULL,". 
                        "`send_email_by` varchar(200) NOT NULL,". 
                        "`subject` varchar(200) NOT NULL,". 
                        "`mail_sent_at` DATETIME NOT NULL,". 
                        "`status` int(10) NOT NULL,". 
                "PRIMARY KEY (`id`)".
                    ") {$charset_collate} ENGINE=InnoDB;";
                $wpdb->query($sql3);
                
                
        }
}



add_action('wp_ajax_savedata_phpmail_setting','wpoptinjeetsavedata_phpmail_setting');
add_action('wp_ajax_nopriv_savedata_phpmail_setting','wpoptinjeetsavedata_phpmail_setting');

if(!function_exists('wpoptinjeetsavedata_phpmail_setting'))
{
    function wpoptinjeetsavedata_phpmail_setting()
    {
        if(isset($_POST['wpoptinjeet_csrf']) && wp_verify_nonce($_POST['wpoptinjeet_csrf'],'wpoptinjeet'))
        {
            require_once('class/admin/savedata/savedata_phpmail_setting.php');
        }
        wp_die();
    }
}
add_action('wp_ajax_wpoptinjeetsavedata_smtp_mail','wpoptinjeetsavedata_smtp_mail');
add_action('wp_ajax_nopriv_wpoptinjeetsavedata_smtp_mail','wpoptinjeetsavedata_smtp_mail');

if(!function_exists('wpoptinjeetsavedata_smtp_mail'))
{
    function wpoptinjeetsavedata_smtp_mail()
    {
        if(isset($_POST['wpoptinjeet_csrf']) && wp_verify_nonce($_POST['wpoptinjeet_csrf'],'wpoptinjeet'))
        {
            require_once('class/admin/savedata/savedata_smtp_mail.php');
        }
        wp_die();
    }
}
?>