<?php
if(!class_exists('optinJeet_admin5'))
{
class optinJeet_admin5 {
     function header_image_optin() {
        ?>
        <IMG SRC="<?php echo esc_url(optinjeet_pluginurl.'/images/msmall.png'); ?>" class="floatLeft">
        <?php
    }
     
function form_edit_delete(){
 foreach (glob(plugin_dir_path(__FILE__) . "class/admin/*.php") as $file) {
    include_once $file;
}

$delete = isset($_GET["deleteID"]) ? sanitize_text_field($_GET["deleteID"]) : "";
//echo $delete;
            if ($delete != "") {
                global $wpdb;
                $tablnam = $wpdb->prefix."optinjeet_smtp";//echo $tablnam;
               // $wpdb->delete($wpdb->optinjeet_smtp, array('ID' => $delete));
                $sql1 = $wpdb->delete($tablnam,array('ID' => $delete));
                
               if($wpdb->query($sql1)){
                echo "<p class='' style='color: green'>list Deleted</p>";
               }
            }
            echo "<div class='singLeEditMenu'>";
            $this->form_all_smtp_settings();
            echo "</div>";    
}
function form_all_smtp_settings() {
         $msg = isset($_GET["msg"]) ? esc_html($_GET["msg"]) : "";
        if ($msg != "") {
            echo " <p class='form-submit-successOPtin' style='color: green'>Settings " . $msg . " Successfully</p>";
        }
        ?>
       <h1>All SMTP</h1>
       <?php
            $edit_file='';
{
?>
           
       <div class="all-smtpsetting-panel smtp-settings-panel">
              <div class="panel-full-body">
    <div class="table-responsive">
   <table id="datatable_ajax" class="lsttbl table table-bordered table-striped table-condensed dataTable" aria-describedby="datatable_ajax_info">
      <thead>
        <tr>
        <th style="width: 214px; text-align: center; border-bottom: 1px solid black;">ID</th>
        <th style="width: 236px; text-align: center; border-bottom: 1px solid black;">SMTP Name</th>
        <th style="width: 223px; text-align: center; border-bottom: 1px solid black;">Action</th>
       </tr>
       </thead>
       <tbody role="alert" aria-live="polite" aria-relevant="all">
 <?php
 global $wpdb;
 $table_name1 = $wpdb->prefix."optinjeet_smtp";
 $qry2= $wpdb->get_results("select Id, smtp_name from $table_name1 ");
  foreach ( $qry2 as $print ) {  
 ?>
<!--            <thead style="text-align: center;">-->
       <tr style="text-align: center;">
    <td style="background-color: #E0E2FF;"><?php echo esc_html($print->Id);?></td>
     <td style="background-color: #E6E9ED;"><?php echo esc_html($print->smtp_name);?></td>
     <td style="background-color: #E0E2FF;"><a onclick="return confirm('Are you sure you wish to delete?')" href="<?php echo esc_url(home_url() . '/wp-admin/admin.php?page=sub-optinJeet_all_smtppp_settings&deleteID=' . $print->Id); ?>">Delete</a> | <a class="href_edit" href="<?php echo esc_url(home_url() . '/wp-admin/admin.php?page=sub-optinJeet_createall_smtp_settings&editID=' . $print->Id); ?>">Edit</a></td>
    </tr>
<!--            </thead>-->
        <?php        
  }
 ?>
       </tbody>
</table>
</div>
        
              </div>
                  
       </div>
       <?php 
       
 } ?>
       
       

       <?php
}

    function optinJeet_edit_delete_list() {
         
if (isset($_POST["submit"])) {
    //echo 'hii';
            $smtp_name = sanitize_text_field($_POST["smtp_name"]);//echo $smtp_name;
            $smtp_hostname = sanitize_text_field($_POST["smtp_hostname"]);
            $smtp_port = sanitize_text_field($_POST["smtp_port"]);
            $smtp_from_email = sanitize_email($_POST["smtp_from_email"]);
            $smtp_password = base64_encode(sanitize_text_field($_POST["smtp_password"]));
            $updateID = isset($_POST["Update_ID"]) ? sanitize_text_field($_POST["Update_ID"]) : "";
            if ($updateID == "") {
                $my_post = array(
                    'smtp_name' => $smtp_name,
                    'smtp_hostname' => $smtp_hostname,
                    'smtp_port' => $smtp_port,
                    'smtp_from_email' =>$smtp_from_email,
                      'smtp_password' =>$smtp_password
                );
                 global $wpdb;
           $table_name5 = $wpdb->prefix."optinjeet_smtp";//echo esc_html($table_name5);
            $post_id = $updateID; //echo $post_id;
    $sql = $wpdb->query( "insert into $table_name5( smtp_name, smtp_hostname, smtp_port, smtp_from_email,smtp_password) values(%s,%s,%d,%s,%s) WHERE Id = '{$post_id}'" );
                $post_id = wp_insert_post($my_post);//echo $post_id;
                     
     if($sql) 
{
echo $post_id;
echo "Sucessful Insertion.";

}
            }else {
                $edit = isset($_GET["editID"]) ? sanitize_text_field($_GET["editID"]): "";
                $my_post = array(
                    'ID' => $updateID,
                    'smtp_name' => $smtp_name,
                     'smtp_hostname' => $smtp_hostname,
                    'smtp_port' => $smtp_port,
                  'smtp_from_email' =>$smtp_from_email,
                   'smtp_password' =>$smtp_password
                );
               // print_r($my_post);
             //   wp_update_post($my_post);
                 global $wpdb;
           $table_name5 = $wpdb->prefix."optinjeet_smtp";//echo $table_name5;
                $post_id = $updateID; //echo $post_id;
                  $query = $wpdb->query("UPDATE {$table_name5} SET smtp_name = '{$smtp_name}', smtp_hostname = '{$smtp_hostname}', smtp_port = '{$smtp_port}', smtp_from_email = '{$smtp_from_email}', smtp_password = '{$smtp_password}'  WHERE Id = '{$edit}'");
     
     if($query) 
{

// echo "Sucessful Updation.";

}
            }

              $msg = "Updated";
            if ($updateID == "") {
                $msg = "Created";
            }
            if ($post_id != "") {
//                update_post_meta($post_id, "Optin_Form_Html", $form);
//                update_post_meta($post_id, "Optin_Flds_fld", $lfds);
                if ($updateID != "") {
                    
 echo " <p class='form-submit-successOPtin' style='color: green'> " . esc_html($msg) . "</p>";
                      echo "<script>window.location='admin.php?page=sub-optinJeet_all_smtppp_settings';</script>";




                } else {
                  echo " <p class='form-submit-successOPtin' style='color: green'> " . esc_html($msg) . "</p>";
                 
                      echo "<script>window.location='admin.php?page=sub-optinJeet_all_smtppp_settings';</script>";
                }
            } else {
                echo " <p class='form-submit-errorOPtin' style='color: green'>There is some error please try again</p>";
            }
}

     $edit = isset($_GET["editID"]) ? sanitize_text_field($_GET["editID"]) : "";
       $titleOptn = "";
        global $wpdb;
           $table_name5 = $wpdb->prefix."optinjeet_smtp";//echo $table_name5;
   $qry5= $wpdb->get_results("select smtp_name,smtp_hostname,smtp_port,smtp_from_email,smtp_password from $table_name5 where Id=$edit");
             if ($edit != "") {
                 
  foreach ( $qry5 as $printt ) {  

                 $smtp_name = $printt->smtp_name;//echo esc_html($smtp_name);
                  $smtp_hostname = $printt->smtp_hostname;//echo $smtp_hostname;
                   $smtp_port = $printt->smtp_port;//echo $smtp_port;
                    $smtp_from_email = $printt->smtp_from_email;//echo $smtp_from_email;
                     $smtp_password = $printt->smtp_password;//echo esc_html($smtp_password);
           
     }
             }
     
        ?>
       <h1>Edit SMTP Settings</h1>

      
      <div class="smtp-settings-panel">
           <div class="panel-full-body">
                <form action="" method="post" class="form-horizontal" id="smtp_setting">
                   <?php
                    if ($edit != "") {
                        echo "<input type='hidden' name='Update_ID' value='" . esc_attr($edit) . "' >";
                    }
                    ?>
                    <div class="form-group margin_optin" style="margin-top: 6%;margin-left: 18px;">
                               <label class="label-optin label_email"> SMTP Name<span class="required" style="line-height: 40px;">*</span></label>
                               <div class="all_display" id="from_email">
                                   <input type="text" class="form-control input_smtp_1 smtp_name" name="smtp_name" value="<?php echo esc_attr($smtp_name); ?>">
                               </div>
                           </div>
                    
                    
                    <div class="form-group margin_optin" style="margin-top: 3%;margin-left: 18px;">
                               <label class="label-optin label_email"> SMTP Host Name<span class="required" style="line-height: 40px;">*</span></label>
                               <div class="all_display" id="from_email">
                                   <input type="text" class="form-control input_smtp_2 smtp_hostname" value="<?php echo esc_attr($smtp_hostname); ?>" name="smtp_hostname">
                               </div>
                           </div>
                   
          <div class="form-group margin_optin" style="margin-top: 3%;margin-left: 18px;">
                               <label class="label-optin label_email"> SMTP Port<span class="required" style="line-height: 40px;">*</span></label>
                               <div class="all_display" id="from_email">
                                   <input type="text" class="form-control input_smtp_5 smtp_port" name="smtp_port" value="<?php echo esc_attr($smtp_port); ?>">
                               </div>
                           </div>
                   
                <div class="form-group margin_optin" style="margin-top: 3%;margin-left: 18px;">
                               <label class="label-optin label_email"> From Email<span class="required" style="line-height: 40px;">*</span></label>
                               <div class="all_display" id="from_email">
                                   <input type="text" class="form-control input_smtp_6 smtp_from_email" name="smtp_from_email" value="<?php echo esc_attr($smtp_from_email); ?>" required>
                               </div>
                           </div>
                   
         <div class="form-group margin_optin" style="margin-top: 3%;margin-left: 18px;">
                               <label class="label-optin label_email">Email Password<span class="required" style="line-height: 40px;">*</span></label>
                               <div class="all_display" id="from_email">
                                   <input type="password" class="form-control input_smtp_7 smtp_password" name="smtp_password" value="<?php echo esc_attr($smtp_password); ?>">
                               </div>
                           </div>
                 
                   
                   <div class="form-group margin_optin success_button" >
                       <input type="submit" class="btn btn-success" name="submit" value="Update" id="submit_edit_submit">                                   
                           </div>
                   
               </form>          
               
           </div>
                
       </div>  
       
    <?php
  
}

}
}