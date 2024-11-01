<?php
if(!class_exists('optinJeet_admin6'))
{
class optinJeet_admin6{
     function header_image_optin() {
        ?>
        <IMG SRC="<?php echo esc_url(optinjeet_pluginurl.'/images/msmall.png') ?>" class="floatLeft">
        <?php
    }
    
       function history() {
           ?>
        <div style="margin-left: -9px;margin-bottom: 14px;margin-top: 14px;">
            <button class="btn btn-primary btn-success btn-optin history_email_btn" type="button" style="padding: 10px 20px;">Send Email List History</button>   
         <button class="btn btn-primary btn-success btn-optin history_emaillist_btn" type="button" style="padding: 10px 20px;"> Send Email History</button>   
        </div>
        <h1>Email History</h1>
           <script>
               jQuery(document).ready(function($){
                   $('.history_email').show();
                   $('.history_emaillist').hide();
                  $('.history_email_btn').click(function(){
                      $('.history_email').show();
                      $('.history_emaillist').hide();
                  }); 
                  $('.history_emaillist_btn').click(function(){
                      $('.history_email').hide();
                      $('.history_emaillist').show();
                  }); 
               });
               </script>
       <div class="all-smtpsetting-panel"style="position: relative;
     width: 95%;
    margin-bottom: 10px;
       padding-left: 1px;
    display: inline-block;
    background: #fff;
    border: 1px solid #E6E9ED;">
              <div class="panel-full-body" style="padding: 0px 1px 2px;
    position: relative;
    width: 100%;
    float: left;
    clear: both;
    margin-top: 3px;">
    <div class="table-responsive">
   <table id="datatable_ajax" class="lsttbl table table-bordered table-striped table-condensed dataTable history_email" aria-describedby="datatable_ajax_info">
      <thead>
        <tr>
        <th style="width: 214px; text-align: center; border-bottom: 1px solid black;">Id</th>
        <th style="width: 236px; text-align: center; border-bottom: 1px solid black;">Send Email To</th>
        <th style="width: 223px; text-align: center; border-bottom: 1px solid black;">Email List</th>
          <th style="width: 223px; text-align: center; border-bottom: 1px solid black;">Subject</th>
           <th style="width: 223px; text-align: center; border-bottom: 1px solid black;">Mail Sent At</th>
             <th style="width: 223px; text-align: center; border-bottom: 1px solid black;">Status</th>
          
       </tr>
       </thead>
       <tbody role="alert" aria-live="polite" aria-relevant="all">
 <?php
 global $wpdb;
 $table_name1 = $wpdb->prefix."optinjeet_emaillist";
 $sqry2= $wpdb->get_results("select Id, mail_to,send_email_by,subject,mail_sent_at,status from $table_name1 ");
  foreach ( $sqry2 as $print1 ) {  
      $arr = explode(',',$print1->mail_to);
 ?>
            <thead style="text-align: center;">
       <tr>
           
    <td style="background-color: #E0E2FF;"><?php echo esc_html($print1->Id);?></td>
     <td style="background-color: #E6E9ED;"><?php echo count($arr); ?></td>
      <td style="background-color: #E6E9ED;"><?php echo esc_html($print1->send_email_by);?></td>
       <td style="background-color: #E6E9ED;"><?php echo esc_html($print1->subject);?></td>
         <td style="background-color: #E6E9ED;"><?php echo esc_html($print1->mail_sent_at);?></td>
            <td style="background-color: #E6E9ED;"><?php echo esc_html(($print1->status)? 'Sent':'Not Sent');?></td>
    </tr>
            </thead>
        <?php        
  }
 
 ?>
   
       </tbody>
</table>
</div>
<div class="table-responsive">
                  <table id="datatable_ajax" class="lsttbl table table-bordered table-striped table-condensed dataTable history_emaillist" aria-describedby="datatable_ajax_info">
      <thead>
        <tr>
        <th style="width: 214px; text-align: center; border-bottom: 1px solid black;">Id</th>
        <th style="width: 236px; text-align: center; border-bottom: 1px solid black;">Send Email To</th>
        <th style="width: 223px; text-align: center; border-bottom: 1px solid black;">Email List</th>
          <th style="width: 223px; text-align: center; border-bottom: 1px solid black;">Subject</th>
           <th style="width: 223px; text-align: center; border-bottom: 1px solid black;">Mail Sent At</th>
             <th style="width: 223px; text-align: center; border-bottom: 1px solid black;">Status</th>
          
       </tr>
       </thead>
        <tbody role="alert" aria-live="polite" aria-relevant="all">
        <?php        

 global $wpdb;
 $table_name2 = $wpdb->prefix."optinjeet_email";
 $sqry3= $wpdb->get_results("select Id, mail_to,send_email_by,subject,mail_sent_at,status from $table_name2 ");
  foreach ( $sqry3 as $print2 ) {  
       $arr1 = explode(',',$print2->mail_to);
 ?>
            <thead style="text-align: center;">
       <tr>
    <td style="background-color: #E0E2FF;"><?php echo esc_html($print2->Id);?></td>
     <td style="background-color: #E6E9ED;"><?php echo count($arr1);?></td>
      <td style="background-color: #E6E9ED;"><?php echo esc_html($print2->send_email_by);?></td>
       <td style="background-color: #E6E9ED;"><?php echo esc_html($print2->subject);?></td>
         <td style="background-color: #E6E9ED;"><?php echo esc_html($print2->mail_sent_at);?></td>
            <td style="background-color: #E6E9ED;"><?php echo esc_html($print2->status);?></td>
    </tr>
            </thead>
        <?php        
  }
 ?>
       </tbody>
      </table>  
</div>
              </div>
                  
       </div>
            <?php
       }
}
}