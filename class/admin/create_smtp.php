<?php
if(!class_exists('header_image_optin'))
{
class optinJeet_admin3{
  function header_image_optin() {
        ?>
        <IMG SRC="<?php echo esc_url(optinjeet_pluginurl.'/images/msmall.png'); ?>" class="floatLeft">
        <?php
    }
    
        
    function form_smtp_settings() {
        ?>
         <script>
             jQuery(document).ready(function($){ 
       
               $("#smtp_setting").validate({
        rules: {
            smtp_name: "required",
            smtp_hostname: "required",
             smtp_port: {
                 required: true,
                 number: true
    }
        },
        messages: {
            smtp_name: "* Please enter the SMTP name",
            smtp_hostname: "* Please enter the SMTP hostname",
             smtp_port: "* Please enter numbers",
        },
        
        submitHandler: function(form) {
                  var smtp_name = encodeURIComponent($('.smtp_name').val()); //alert(smtp_name);
            var smtp_hostname = encodeURIComponent($('.smtp_hostname').val()); //alert(smtp_hostname);
              var smtp_port = encodeURIComponent($('.smtp_port').val()); //alert(smtp_port);
                var smtp_from_email = encodeURIComponent($('.smtp_from_email').val()); //alert(smtp_from_email);
                  var smtp_password = encodeURIComponent(btoa($('.smtp_password').val())); //alert(smtp_password);
             $.ajax({
   		type: 'POST',
   		url: "<?php echo admin_url('admin-ajax.php'); ?>",  
   		data: "action=wpoptinjeetsavedata_smtp_mail&smtp_name="+ smtp_name + "&smtp_hostname=" + smtp_hostname+ "&smtp_port=" + smtp_port+ "&smtp_from_email=" + smtp_from_email+ "&smtp_password=" + smtp_password+"&wpoptinjeet_csrf=<?php echo wp_create_nonce('wpoptinjeet'); ?>",
                //dataType: 'json',
                success: function(msg1){
                  
                     window.location='admin.php?page=sub-optinJeet_all_smtppp_settings';
                    alert('DATA INSERTED');
                  //  alert(msg1);
                }
            });
          form.submit();
        }
    });
     
            });
      
        </script>
       
       <h1>Create SMTP Settings</h1>
      <div class="smtp-settings-panel">
           <div class="panel-full-body">
               <form action="" method="post" class="form-horizontal" id="smtp_setting">
                    <div class="form-group margin_optin" style="margin-top: 6%;margin-left: 18px;">
                               <label class="label-optin label_email">SMTP Name<span class="required" style="line-height: 40px;">*</span></label>
                               <div class="all_display" id="from_email">
                                   <input type="text" class="form-control input_smtp_1 smtp_name" name="smtp_name" value="">
                               </div>
                           </div>
                   
                   <div class="form-group margin_optin" style="margin-top: 3%;margin-left: 18px;">
                               <label class="label-optin label_email"> SMTP Host Name<span class="required" style="line-height: 40px;">*</span></label>
                               <div class="all_display" id="from_email">
                                   <input type="text" class="form-control input_smtp_2 smtp_hostname" value="" name="smtp_hostname">
                               </div>
                           </div>
                   
                   <div class="form-group margin_optin" style="margin-top: 3%;margin-left: 18px;">
                               <label class="label-optin label_email"> SMTP Port<span class="required" style="line-height: 40px;">*</span></label>
                               <div class="all_display" id="from_email">
                                   <input type="text" class="form-control input_smtp_5 smtp_port" name="smtp_port" value="">
                               </div>
                           </div>
                   
                   <div class="form-group margin_optin" style="margin-top: 3%;margin-left: 18px;">
                               <label class="label-optin label_email"> From Email<span class="required" style="line-height: 40px;">*</span></label>
                               <div class="all_display" id="from_email">
                                   <input type="text" class="form-control input_smtp_6 smtp_from_email" name="smtp_from_email" value="" required>
                               </div>
                           </div>
                   
                   <div class="form-group margin_optin" style="margin-top: 3%;margin-left: 18px;">
                               <label class="label-optin label_email">Email Password<span class="required" style="line-height: 40px;">*</span></label>
                               <div class="all_display" id="from_email">
                                   <input type="password" class="form-control input_smtp_7 smtp_password" name="smtp_password" value="">
                               </div>
                           </div>
                   
                   <div class="form-group margin_optin success_button">
                       <input type="submit" class="btn btn-success" name="submit" value="Add" id="submit_create_submit">                                   
                           </div>
                
                   
               </form>          
               
           </div>
                
       </div>  
       
    <?php
}









}
}