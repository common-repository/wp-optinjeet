<?php
$edit_file='';
     global $wpdb;
     
     $mail_to1 = urldecode(sanitize_text_field($_POST['db_mail_to'])); 
     $send_email_by1 = urldecode(sanitize_text_field($_POST['db_send_email_by'])); 
     $mail_sub1 = urldecode(sanitize_text_field($_POST['db_subject'])); 
     $status = sanitize_text_field($_POST['status']); 
     
     $table_name = $wpdb->prefix."optinjeet_email";

       $sql1 = $wpdb->prepare( "insert into $table_name( mail_to, send_email_by,subject,mail_sent_at,status) values(%s,%s,%s,%s,%d)", @$mail_to1,@$send_email_by1,@$mail_sub1,'',$status);
       if ($wpdb->query($sql1)){
    echo 'inserted';
       }
