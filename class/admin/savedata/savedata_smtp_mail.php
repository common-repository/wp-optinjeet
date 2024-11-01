<?php
$edit_file='';


     global $wpdb;
     $smtp_name = urldecode(sanitize_text_field($_POST['smtp_name'])); //echo $smtp_name;
     $smtp_hostname = urldecode(sanitize_text_field($_POST['smtp_hostname'])); //echo $smtp_hostname;
      $smtp_port = urldecode(sanitize_text_field($_POST['smtp_port'])); //echo $smtp_port;
     $smtp_from_email = urldecode(sanitize_email($_POST['smtp_from_email'])); //echo $smtp_from_email;
      $smtp_password = urldecode(sanitize_text_field($_POST['smtp_password'])); //echo $smtp_password;
      
         $table_name1 = $wpdb->prefix."optinjeet_smtp";//echo $table_name1;
         
                $sql = $wpdb->prepare( "insert into $table_name1( smtp_name, smtp_hostname,smtp_port,smtp_from_email,smtp_password) values(%s,%s,%d,%s,%s)", $smtp_name, $smtp_hostname,$smtp_port,$smtp_from_email,$smtp_password);

      // $insert1 = $wpdb->query($sql);
       if ($wpdb->query($sql)){
        $thepost1 = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_name1 order by Id desc",$smtp_name,$smtp_hostname,$smtp_port,$smtp_from_email,$smtp_password) );

       }