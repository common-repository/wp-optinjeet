<?php

$edit_file='';
     global $wpdb;
     
     $phpmail_from_email = urldecode(sanitize_email($_POST['phpmail_from_email'])); //echo $phpmail_from_email;
     $phpmail_password = urldecode(sanitize_text_field($_POST['phpmail_password'])); //echo $phpmail_password;
     $timezone_mail = urldecode(sanitize_text_field($_POST['timezone_mail'])); //echo $timezone_mail;
     
     
     
     $table_name = $wpdb->prefix."optinjeet_phpmail";	 //echo $table_name;
    
     $result = $wpdb->get_results("SELECT * FROM $table_name");  
     //echo count($result);
 if (count ($result) == "0") {

       $sql1 = $wpdb->prepare( "insert into $table_name( phpmail_from_email, phpmail_password, timezone) values(%s,%s,%s)", $phpmail_from_email, md5($phpmail_password), $timezone_mail);
       $sql = $wpdb->query($sql1);
       if ($sql){
          //echo  $insert;      
        //   $result12 = $wpdb->get_results("SELECT phpmail_from_email FROM $table_name WHERE phpmail_from_email='".$phpmail_from_email."'");  
        //print_r($result12);
       $thepost = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_name order by Id desc",$phpmail_from_email ) );
//
//$_SESSION['phpmail_myValue']=$thepost->phpmail_from_email;
//echo $thepost->phpmail_from_email;
       echo " Data Inserted";
       }
       
 
   }
    else {
     
      $query = $wpdb->query("UPDATE {$table_name} SET phpmail_from_email = '{$phpmail_from_email}', phpmail_password = '{$phpmail_password}', 	timezone = '{$timezone_mail}'");
     
     if($query) 
{

echo "Sucessful Updation.";

}
       
}