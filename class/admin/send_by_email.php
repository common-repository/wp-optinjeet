<?php
if(!class_exists('optinJeet_admin1'))
{
class optinJeet_admin1 {
  function header_image_optin() {
        ?>
        <IMG SRC="<?php echo esc_url(optinjeet_pluginurl.'/images/msmall.png'); ?>" class="floatLeft">
        <?php
    }
    
     function form_send_email(){
          foreach (glob(plugin_dir_path(__FILE__) . "class/admin/*.php") as $file) {
    include_once $file;
    


    }
    global $wpdb;
$table_name4 = $wpdb->prefix."optinjeet_phpmail";//echo $table_name4;
   $thepost4 = $wpdb->get_results( "SELECT * FROM $table_name4" );
     $timezone = $thepost4['0']->timezone != null ? $thepost4['0']->timezone : "America/Chicago" ;
  // print_r($thepost4);


  $php_mail = "PHP Mail";
   $smtp = "SMTP";
   if(isset($_POST['submit1']))
{
     
  $var = sanitize_text_field($_POST['mail_optin_prototype']);//echo $var;
  $var = explode("=", $var);
  

if($var['0'] == $php_mail){
   // echo "hiii";
  
    
   $textarea6 = $thepost4['0']->phpmail_from_email;
  // echo $textarea6."<br/>";

  
//  //$textarea6 = $_SESSION['phpmail_myValue']; echo $textarea6; 

 $mailto = sanitize_text_field($_POST['mail_to']); //echo $mailto."<br/>";
   $mailtoarr=array_unique(explode(',',$mailto));
 $mailSub = sanitize_text_field($_POST['mail_sub']); //echo $mailSub."<br/>";
 $message = sanitize_text_field($_POST['mail_msg']);//echo $message."<br/>";
  $msggg = stripslashes($message);//echo $msggg."<br/>";

 	//$wpmailheaders = "MIME-Version: 1.0" . "\r\n";
    //$wpmailheadersok= array('Content-Type: text/html; charset=UTF-8');

   //echo wp_mail( $mailto,$mailSub,$msggg,$wpcrmailheaders );	

      $composeob=new OptinJeetWpmail();   

      $wpmlsnd=$composeob->composeMail($mailtoarr,$mailSub,$msggg);
    
    
        if($wpmlsnd){
            ?>
        
        <div id="message" class="updated notice notice-success is-dismissible">
            <p>Mail Sent Successfully.</p>
           
        </div>
        <?php
           // echo "Thanks";
            $status = 1;
        }
        else{
            ?>
        
        <div style="border-left-color: #F44336;" id="message" class="updated notice notice-success is-dismissible">
            <p>Mail Not Sent.</p>
           
        </div>
        <?php
           // echo "Bad";
            $status = 0;
        }
}
else{
//echo "hiiiiiiiiiii";
 global $wpdb;
$table_name1 = $wpdb->prefix."optinjeet_smtp";//echo $table_name1;
   $thepost3 = $wpdb->get_results( "SELECT * FROM $table_name1 where Id= ".sanitize_text_field($var[0])."" );
    //print_r($thepost3);
 foreach ($thepost3 as $pst3){
   
     $mailto = sanitize_text_field($_POST['mail_to']);//echo $mailto;
     $mailSub = sanitize_text_field($_POST['mail_sub']);
     $message = sanitize_text_field($_POST['mail_msg']); //echo $message;
     $msggg = stripslashes($message);//echo $msggg;   
     $smtp_hostname = $pst3->smtp_hostname;
     $smtp_port = $pst3->smtp_port;
     $smtp_password = base64_decode($pst3->smtp_password);
     $smtp_from_email = $pst3->smtp_from_email;
   //require 'PHPMailer-master/PHPMailerAutoload.php';
   global $phpmailer;
   if ( ! ( $phpmailer instanceof PHPMailer ) ) {
    require_once ABSPATH . WPINC . '/class-phpmailer.php';
    require_once ABSPATH . WPINC . '/class-smtp.php';
    $phpmailer = new PHPMailer;
}

   $mail = $phpmailer;
   $mail ->IsSmtp();
   $mail ->SMTPDebug = 0;
   $mail ->SMTPAuth = true;
   //$mail ->SMTPSecure = 'ssl';
   $mail ->Host = $smtp_hostname;//smtp.gmail.com
   $mail ->Port = $smtp_port; // or 587
   $mail ->IsHTML(true);
   $mail ->Username = $smtp_from_email;
   $mail ->Password = $smtp_password;
   $mail ->SetFrom($smtp_from_email);
   $mail ->Subject = $mailSub;
   $mail ->Body = $msggg;
  $addr = array_unique(explode(',',$mailto));

foreach ($addr as $ad) {
    $mail->AddAddress( trim($ad) );       
}
?>
<?php
   if(!$mail->Send())
   {
        ?>
        
        <div style="border-left-color: #F44336;" id="message" class="updated notice notice-success is-dismissible">
            <p>Mail Not Sent.</p>
           
        </div>
        <?php
       //echo "Mail Not Sent";
       $status = 0;
     
   }
   else
   {
         ?>
        
        <div id="message" class="updated notice notice-success is-dismissible">
            <p>Mail Sent Successfully.</p>
           
        </div>
        <?php
       //echo "Mail Sent";
      $status = 1;
   } 
   //echo $status;
 }
}
}  //$status = 2;

$edit_file='';

     global $wpdb;
     
  
     $send_email_by = $var['1']; //echo $send_email_by;
     $dt = new DateTime("now", new DateTimeZone($timezone));

    $date =  $dt->format('Y-m-d H:i:s');
  
     $table_name = $wpdb->prefix."optinjeet_email";	//echo $table_name;
    if($mailto != null && $send_email_by != null && $mailSub !=null){
		
		$mailtoarr=array_unique(explode(',',$mailto));
	$mailto=implode(',',$mailtoarr);
		
       $sql1 = $wpdb->prepare( "insert into $table_name( mail_to, send_email_by,subject,mail_sent_at,status) values(%s,%s,%s,%s,%d)", @$mailto,@sanitize_text_field($send_email_by),@$mailSub,$date, $status);
       if ($wpdb->query($sql1)){
    //echo 'inserted';
       }
     }
        ?>
   <script>
      jQuery(document).ready(function($){
         var var1 =  $( window ).width();
         if(var1 == '320'){
        $("#content textarea").attr('cols', '15');
         }
        else if(var1 == '360'){
       $("#content textarea").attr('cols', '18');
        }
        else  if(var1 == '375'){
       $("#content textarea").attr('cols', '18');
        }
        else if(var1 == '412'){
       $("#content textarea").attr('cols', '20');
        }
        else if(var1 == '414'){
       $("#content textarea").attr('cols', '22');
        }
        else if(var1 == '600'){
       $("#content textarea").attr('cols', '30');
        }
        else if(var1 == '768'){
       $("#content textarea").attr('cols', '50');
          }
      });
         </script>
     <script>
bkLib.onDomLoaded(function() {
       
       new nicEditor({maxHeight : 280,maxWidth:500}).panelInstance('area5');
  });
  </script>
  
    

    
        <h1>Send Email</h1>
        <div class="send-email-panel">
            <div class="panel-full-body">
                <form action="" method="post" class="form-horizontal" id="form_send_by_email">
                    <div class="form-group margin_optin">
                        <label class="label-optin" style="">Email Addresses<span class="required">*</span></label>   
                        <div class="all_display" id="display1">
                            <textarea id="mail_to" class="db_mail_to" name="mail_to" placeholder="example@example.com,example@example.com,example@example.com,example@example.com" class="form-control" rows="3"></textarea>
                        </div>
                    </div>   
                    <div class="form-group margin_optin">
                        <label class="label-optin" >Send Email by</label>   
                        <div class="all_display" id="display2">
                            <select name="mail_optin_prototype" class="form-control db_send_email_by" id="mail_type">
                              <option value="<?php echo esc_attr($php_mail."=".$php_mail);?>"><?php echo esc_html($php_mail);?></option>
                               
                               <?php
                                 global $wpdb;
                                $table_name1 = $wpdb->prefix."optinjeet_smtp";
                                $qry3= $wpdb->get_results("select * from $table_name1");         
                             //print_r($qry3);
                              foreach ($qry3 as $val){
                                  echo '<option value="'.esc_attr($val->Id."= ".$val->smtp_name).'">'.esc_html($val->smtp_name).'</option>';
                                //echo $val->Id;
                              }
                                   
                                  ?>
                               
                           </select>
                        </div> 
                    </div>   

                    <div class="form-group margin_optin">
                       <label class="label-optin" >Subject<span class="required">*</span></label>   
                       <div class="all_display" id="display3">
                           <input type="text" class="form-control db_subject" id="mail_sub" name="mail_sub" value="" required>
                       </div>  
                    </div>  
                    


<div class="form-group margin_optin">
                            
                       <label class="label-optin">Content</label>  
                       <div id="content">
                           <textarea style="height: 300px;" name="mail_msg" cols="73"  id="area5"></textarea>
                           
                           
                       </div> 
                   
                    
                    <div class="form-group margin_optin" style="    margin-left: 144px;">
                        <input type="submit" class="btn btn-success submit_email" value="Send e-mail" name="submit1" id="send_email">
                    </div> 
                        </div>
                </form>    
            </div>
            
        </div>
       <?php
}


}
}