<?php
if(!class_exists('optinJeet_admin4'))
{
class optinJeet_admin4 {
     function header_image_optin() {
        ?>
        <IMG SRC="<?php echo esc_url(optinjeet_pluginurl.'/images/msmall.png'); ?>" class="floatLeft">
        <?php
    }

    function form_send_email_list(){
        foreach (glob(plugin_dir_path(__FILE__) . "class/admin/*.php") as $file) {
    include_once $file;
}
global $wpdb;
$table_name4 = $wpdb->prefix."optinjeet_phpmail";//echo $table_name4;
   $thepost4 = $wpdb->get_results( "SELECT * FROM $table_name4" );
      $timezone = $thepost4['0']->timezone != null ? $thepost4['0']->timezone : "America/Chicago";

  $php_mail = "PHP Mail";
   $smtp = "SMTP";
   if(isset($_POST['submit2']))
{
  $var = sanitize_text_field($_POST['mail_optin_prototype']); //echo $var;
   $var = explode("=", $var);  
    
if($var['0'] == $php_mail){
       $textarea6 = $thepost4['0']->phpmail_from_email;
 
 //$textarea6 = $_SESSION['phpmail_myValue']; echo $textarea6; 
   $mailto1 = $_POST['mail_to'];
   //echo $to;
   if(is_array($mailto1))
     {
       foreach($mailto1 as $mailto1_index=>$mailto1_val)
       {
        $mailto1[$mailto1_index]=sanitize_text_field($mailto1_val);
       }

     }
   $mailto1=sanitize_text_field(implode(',',$mailto1));
   $mailtoarr=array_unique(explode(',',$mailto1));   
$mailSub1 = sanitize_text_field($_POST['mail_sub']); 
$message = sanitize_text_field($_POST['mail_msg']);//echo $message;
 $msggg = stripslashes($message);//echo $msggg;
  	//$wpmailheaders = "MIME-Version: 1.0" . "\r\n";
    //$wpmailheaders= array('Content-Type: text/html; charset=UTF-8');
    
    //echo wp_mail( $mailto1,$mailSub1,$msggg,$wpcrmailheaders );
	 //$wpmailheadersallop=array('Content-Type: text/html; charset=UTF-8');
    $composeob=new OptinJeetWpmail();
    $wpmlsnd=$composeob->composeMail($mailtoarr,$mailSub1,$msggg);
    
    
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
  // echo "hiiiiiiiiiii";
    global $wpdb;
$table_name7 = $wpdb->prefix."optinjeet_smtp";
   $thepost4 = $wpdb->get_results( "SELECT * FROM $table_name7 where Id= $var[0]" );
   // print_r($thepost3);
 foreach ($thepost4 as $pst4){
     $mailto1 = $_POST['mail_to']; //echo $mailto1;
     if(is_array($mailto1))
     {
       foreach($mailto1 as $mailto1_index=>$mailto1_val)
       {
        $mailto1[$mailto1_index]=sanitize_text_field($mailto1_val);
       }
     }
	 $mailto1=implode(',',$mailto1);
//     print_r (explode(" ",$mailto1));
    $mailSub1 = sanitize_text_field($_POST['mail_sub']);//echo $mailSub1;
    $mailMsg = sanitize_text_field($_POST['mail_msg']);
     $msg_new = stripslashes($mailMsg);//echo $msg_new;   
   //require 'PHPMailer-master/PHPMailerAutoload.php';
   $smtp_hostname1 = $pst4->smtp_hostname;
  $smtp_port1 = $pst4->smtp_port;
  $smtp_password1 = base64_decode($pst4->smtp_password);
 $smtp_from_email1 = $pst4->smtp_from_email;
//  //require 'PHPMailerAutoload.php';
//   //require './vendor/autoload.php';
   //$mail = new PHPMailer();

   global $phpmailer;
   if ( ! ( $phpmailer instanceof PHPMailer ) ) {
    require_once ABSPATH . WPINC . '/class-phpmailer.php';
    require_once ABSPATH . WPINC . '/class-smtp.php';
    $phpmailer = new PHPMailer;
}

   $mail=$phpmailer;

   $mail ->IsSmtp();
   $mail ->SMTPDebug = 0;
   $mail ->SMTPAuth = true;
   //$mail ->SMTPSecure = 'ssl';
   $mail ->Host = $smtp_hostname1;//smtp.gmail.com
   $mail ->Port = $smtp_port1; // or 587
   $mail ->IsHTML(true);
   $mail ->Username = $smtp_from_email1;
   $mail ->Password = $smtp_password1;
   $mail ->SetFrom($smtp_from_email1);
   $mail ->Subject = $mailSub1;
   $mail ->Body = $msg_new;
   $addre = explode(',',$mailto1);
foreach ($addre as $add) {
    $mail->AddAddress( trim($add) );       
}

   if(!$mail->Send())
   {
        ?>
        
        <div style="border-left-color: #F44336;" id="message" class="updated notice notice-success is-dismissible">
            <p>Mail Not Sent.</p>
           
        </div>
        <?php
      // echo "Mail Not Sent";
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
}
$edit_file='';


     global $wpdb;
     
  
     $send_email_by = $var['1']; //echo $send_email_by;
     $dt = new DateTime("now", new DateTimeZone($timezone));

    $date =  $dt->format('Y-m-d H:i:s');
  
    $table_name = $wpdb->prefix."optinjeet_emaillist";	//echo $table_name;
    if($mailto1 != null && $send_email_by != null && $mailSub1 !=null){
		
	$mailtoarr=array_unique(explode(',',$mailto1));
	$mailto1=implode(',',$mailtoarr);
	
       $sql1 = $wpdb->prepare( "insert into $table_name( mail_to, send_email_by,subject,mail_sent_at,status) values(%s,%s,%s,%s,%d)", @$mailto1,@sanitize_text_field($send_email_by),@$mailSub1,$date, $status);
       if ($wpdb->query($sql1)){
    //echo 'inserted';
       }
     }
        ?>
 
  <script>
        
  (function($) {
      
    $("#form_send_email_smtp").validate({
        rules: {
            mail_sub: "required",
            ttttt: {
                required: true,
                email: true
            },
             mail_to: {required: true}
           
        },
        messages: {
            mail_sub: "* Please enter the Subject",
            mail_to: "* Please check",
            
        },
         
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  })(jQuery);
  
  </script>
    <script>
         jQuery(document).ready(function($){
         var var1 =  $( window ).width();
        $("#content textarea").attr('cols', '15');
      });
        </script>
     <script>
bkLib.onDomLoaded(function() {
       (function($){
         var var1 =  $( window ).width();//alert(var1);
         if(var1 == '320'){//alert(var1);
        $("#content textarea").attr('cols', '35');
         }
     else if(var1 == '1024'){
      $("#content textarea").attr('cols', '80');
        }
        else if(var1 == '360'){
       $("#content textarea").attr('cols', '40');
        }
        else if(var1 == '375'){
       $("#content textarea").attr('cols', '43');
        }
        else if(var1 == '412'){
       $("#content textarea").attr('cols', '48');
        }
        else if(var1 == '414'){
       $("#content textarea").attr('cols', '48');
        }
        else if(var1 == '600'){
       $("#content textarea").attr('cols', '47');
        }
        else if(var1 == '768'){
       $("#content textarea").attr('cols', '60');
          }
           else if(var1 == '1440'){
       $("#content textarea").attr('cols', '80');
          }
        })(jQuery);
       new nicEditor({maxHeight : 280,maxWidth:500}).panelInstance('area5');
  });
  </script>  
  
  <script>
           (function($){
               
 // add multiple select / deselect functionality
 $("#selectall").click(function () {
  $('.case').attr('checked', this.checked);
  var allVals = [];
     $('#c_b :checked').each(function() {
    allVals.push($(this).val());
     });
    
 });  
 
})(jQuery);
            
    </script>
        
         <h1>Send Email by Email List</h1>
         <div class="send-emaillist-panel">
             
               <div class="panel-full-body">
                   
                   <form action="" method="post" class="form-horizontal" id="form_send_email_smtp">
                       <div class="form-group margin_optin media1">
                           <label class="label-optin" style=""> List <span class="required">*</span></label>
                        
                      <div id="c_b" >
                        
<input type="checkbox" name="id_name-ck" id="selectall" class="case" value=""><label>All</label>	
<!--                               <input type="checkbox" name="list"  id="selectall" class="case" value="all">-->
                            
                              <?php
                               $args = array(
                           'posts_per_page' => -1,
                           'post_type' => 'optinformList',
                                    'post_email_id'=>'shivi',
                            'post_status' => 'publish'
                                  
                        );
                                 $posts_array = get_posts($args);
                            //      echo '<pre>';  print_r($posts_array) ; echo '</pre>';
                                     foreach ($posts_array as $post){                          
                                        $args1 = array(
                                'posts_per_page' => -1,
                                'post_type' => "optinListVal_" . $post->ID,
                                'post_status' => 'publish'
                            );

                            $posts_array1 = get_posts($args1);
                     //   echo '<pre>';  print_r($posts_array1) ; echo '</pre>';
                            
                    foreach ($posts_array1 as $pst) {
                        
                      //  echo $pst->post_content;
                    $var7 .= $pst->post_content.",";
                   // echo $var7;
                 //   $varr2 = '';
                             }
                            
                             $patternml	=	"/(?:[a-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/";
							 
							 preg_match_all($patternml,$var7,$matchesv);
							
							$varr2="";
                             foreach($matchesv[0] as $email)
							 {
								 if(substr(trim($email),0,1)=='_')
								 {
									 $email=substr($email,1,strlen($email));
								 }
	                          $varr2=$varr2.$email.", ";
                              }
                            
                             $varr2 = rtrim($varr2,", ");//echo $varr2;
                           echo '<input class="mail_to_sub case" name="mail_to[]" type="checkbox"  value="'.esc_attr($varr2).'" style="margin-left: 20px;">';
                    
                          echo  "<label style='margin-right: 2px;'>".esc_html($post->post_title)."</label>";
                       
                  $var7= '';
                  
                                    }   
                              
                             ?>
           
                        </div>
<!--                           <input type="text" id="t">-->
                       </div>
                      <div class="form-group margin_optin">
                        <label class="label-optin" >Send Email by</label>   
                        <div class="all_display" id="send_email_by">
                            <select name="mail_optin_prototype" class="form-control1"  id="mail_type">
                              <option value="<?php echo esc_attr($php_mail)."= ".esc_attr($php_mail);?>"><?php echo esc_html($php_mail);?></option>
                               
                               <?php
                                 global $wpdb;
                                $table_name1 = $wpdb->prefix."optinjeet_smtp";
                                $qry3= $wpdb->get_results("select * from $table_name1");         
                             //print_r($qry3);
                              foreach ($qry3 as $val){
                                  echo '<option value="'.esc_attr($val->Id)."= ".esc_attr($val->smtp_name).'">'.esc_html($val->smtp_name).'</option>';
                                //echo $val->Id;
                              }
                                   
                                  ?>
                               
                           </select>
                        </div> 
                    </div>  

                          
                           <div class="form-group margin_optin div5_media">
                       <label class="label-optin" >Subject<span class="required">*</span></label>   
                       <div class="all_display" id="subject">
                           <input name="mail_sub" type="text" class="form-control" id="mail_sub1">
                       </div>  
                    </div> 

                    
                        <div class="form-group margin_optin">
                            
                            <label class="label-optin">Content</label>   
                            <div class="content contenttscqrcitylistpage" id='content'>
                                                    <textarea style="height: 300px;" name="mail_msg" cols="73" id="area5"></textarea>
                       </div>
                       
                       <script>
                           setTimeout(
                            function(){
                           const contenttscqrcitylistpage=document.querySelectorAll("div.contenttscqrcitylistpage")[0].childNodes;
                            console.log(contenttscqrcitylistpage.length);
                           
                           for(let i=0;i<contenttscqrcitylistpage.length;i++)
                           {
                              try{ contenttscqrcitylistpage[i].style.width="100%";}catch(err){};
                           }
                        },500);
                        </script>
                    <div class="form-group margin_optin " style="margin-left: 144px;margin-bottom:40px;">
                        <input type="submit" class="btn btn-success div6_media" value="Send e-mail" name="submit2" id="btnSubmit">
                                       
                    </div> 
                            </div>
                       </form>
                    </div>
            
               
                   
                               
               </div>
       
        <?php
    }
}
}