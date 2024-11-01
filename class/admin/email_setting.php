<?php
   //session_start();
if(!class_exists('optinJeet_admin2'))
{
class optinJeet_admin2{
  function header_image_optin() {
        ?>
        <IMG SRC="<?php echo esc_url(optinjeet_pluginurl.'/images/msmall.png'); ?>" class="floatLeft">
        <?php
    }
 function form_php_email_settings() { 
         if(isset($_POST['submit']))
{

    update_option("phpmail_from_email", @sanitize_email($_POST['phpmail_from_email']));
    update_option("phpmail_password",@sanitize_text_field($_POST['phpmail_password']));

}
        ?>
     <script>
             jQuery(document).ready(function($){ 
       
               $("#email_setting").validate({
        rules: {
            mail_sub: "required",
            phpmail_from_email: {
                required: true,
                email: true
            },
             phpmail_password: {
                required: true,
                minlength: 5
            },
        },
        messages: {
            mail_sub: "* Please enter the Subject",
            phpmail_from_email: "* Please enter a valid email address",
            phpmail_password: {
                required: "* Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
        },
        
        submitHandler: function(form) {
            var phpmail_from_email = encodeURIComponent($('.phpmail_from_email').val()); //alert(phpmail_from_email);
            var phpmail_password = encodeURIComponent($('.phpmail_password').val()); //alert(phpmail_password);
              var timezone_mail = encodeURIComponent($('.timezone_mail').val()); //alert(timezone_mail);
             $.ajax({
   		type: 'POST',
   		url: "<?php echo admin_url('admin-ajax.php'); ?>",  
   		data: "action=savedata_phpmail_setting&phpmail_from_email="+ phpmail_from_email + "&phpmail_password=" + phpmail_password+ "&timezone_mail=" + timezone_mail+"&wpoptinjeet_csrf=<?php echo wp_create_nonce('wpoptinjeet'); ?>",
                //dataType: 'json',
                success: function(msg){
                    //alert(msg);
                    alert('DATA INSERTED');
                }
            });
          form.submit();
        }
    });
     
            });
        </script>
        <?php
        global $wpdb;
 $table_name5 = $wpdb->prefix."optinjeet_phpmail";
 $query5= $wpdb->get_results("select * from $table_name5 ");
  
        ?>
      <h1>Email Settings</h1>
      <div class="php-emailsetting-panel">
        
           <div class="panel-full-body">
        
               <form action="" method="post" class="form-horizontal" id="email_setting">
                    <div class="form-group margin_optin" style="margin-top: 6%;margin-left: 18px;">
                        <label class="label-optin label_email"> From Email<span class="required" style="line-height: 40px;">*</span></label>
                               <div class="all_display" id="from_email">
                                   <input type="email"  class="form-control phpmail_from_email" name="phpmail_from_email" value="<?= esc_attr($query5['0']->phpmail_from_email); ?>">
                               </div>
                    </div>
                   <div class="form-group margin_optin" style="margin-top: 4%;margin-left: 17px;">
                        <label class="label-optin label_email"> Password <span class="required" style="line-height: 40px;">*</span></label>
                               <div class="all_display" id="from_email">
                                   <input type="password"  class="form-control phpmail_password" name="phpmail_password" value="<?=  esc_attr($query5['0']->phpmail_password); ?>">
                               </div>
                    </div>
                
                   
                    <div class="form-group margin_optin" style="margin-top: 4%;
    margin-left: 17px;">
                      <label class="label-optin label_email"> Select TimeZone <span class="required" style="line-height: 40px;">*</span></label>
                      <div class="all_display time_css time_css1 time_css2">      
        <?php
        $timezone = array('Africa/Abidjan', 'Africa/Accra', 'Africa/Addis_Ababa', 'Africa/Algiers', 'Africa/Asmara', 'Africa/Bamako', 'Africa/Bangui', 'Africa/Banjul', 'Africa/Bissau', 'Africa/Blantyre', 'Africa/Brazzaville', 'Africa/Bujumbura', 'Africa/Cairo', 'Africa/Casablanca', 'Africa/Ceuta', 'Africa/Conakry', 'Africa/Dakar', 'Africa/Dar_es_Salaam', 'Africa/Djibouti', 'Africa/Douala', 'Africa/El_Aaiun', 'Africa/Freetown', 'Africa/Gaborone', 'Africa/Harare', 'Africa/Johannesburg', 'Africa/Juba', 'Africa/Kampala', 'Africa/Khartoum', 'Africa/Kigali', 'Africa/Kinshasa', 'Africa/Lagos', 'Africa/Libreville', 'Africa/Lome', 'Africa/Luanda', 'Africa/Lubumbashi', 'Africa/Lusaka', 'Africa/Malabo', 'Africa/Maputo', 'Africa/Maseru', 'Africa/Mbabane', 'Africa/Mogadishu', 'Africa/Monrovia', 'Africa/Nairobi', 'Africa/Ndjamena', 'Africa/Niamey', 'Africa/Nouakchott', 'Africa/Ouagadougou', 'Africa/Porto-Novo', 'Africa/Sao_Tome', 'Africa/Tripoli', 'Africa/Tunis', 'Africa/Windhoek',
            'America/Adak', 'America/Anchorage', 'America/Anguilla', 'America/Antigua', 'America/Araguaina', 'America/Argentina/Buenos_Aires', 'America/Argentina/Catamarca', 'America/Argentina/Cordoba', 'America/Argentina/Jujuy', 'America/Argentina/La_Rioja', 'America/Argentina/Mendoza', 'America/Argentina/Rio_Gallegos', 'America/Argentina/Salta', 'America/Argentina/San_Juan', 'America/Argentina/San_Luis', 'America/Argentina/Tucuman', 'America/Argentina/Ushuaia', 'America/Aruba', 'America/Asuncion', 'America/Atikokan', 'America/Bahia', 'America/Bahia_Banderas', 'America/Barbados', 'America/Belem', 'America/Belize', 'America/Blanc-Sablon', 'America/Boa_Vista', 'America/Bogota', 'America/Boise', 'America/Cambridge_Bay', 'America/Campo_Grande', 'America/Cancun', 'America/Caracas', 'America/Cayenne', 'America/Cayman', 'America/Chicago', 'America/Chihuahua', 'America/Costa_Rica', 'America/Creston', 'America/Cuiaba', 'America/Curacao', 'America/Danmarkshavn', 'America/Dawson',
            'America/Dawson_Creek', 'America/Denver', 'America/Detroit', 'America/Dominica', 'America/Edmonton', 'America/Eirunepe', 'America/El_Salvador', 'America/Fort_Nelson', 'America/Fortaleza', 'America/Glace_Bay', 'America/Godthab', 'America/Goose_Bay', 'America/Grand_Turk', 'America/Grenada', 'America/Guadeloupe', 'America/Guatemala', 'America/Guayaquil', 'America/Guyana', 'America/Halifax', 'America/Havana', 'America/Hermosillo', 'America/Indiana/Indianapolis', 'America/Indiana/Knox', 'America/Indiana/Marengo', 'America/Indiana/Petersburg', 'America/Indiana/Tell_City', 'America/Indiana/Vevay', 'America/Indiana/Vincennes', 'America/Indiana/Winamac', 'America/Inuvik', 'America/Iqaluit', 'America/Jamaica', 'America/Juneau', 'America/Kentucky/Louisville', 'America/Kentucky/Monticello', 'America/Kralendijk', 'America/La_Paz', 'America/Lima', 'America/Los_Angeles', 'America/Lower_Princes', 'America/Maceio', 'America/Managua', 'America/Manaus', 'America/Marigot', 'America/Martinique',
            'America/Matamoros', 'America/Mazatlan', 'America/Menominee', 'America/Merida', 'America/Metlakatla', 'America/Mexico_City', 'America/Miquelon', 'America/Moncton', 'America/Monterrey', 'America/Montevideo', 'America/Montserrat', 'America/Nassau', 'America/New_York', 'America/Nipigon', 'America/Nome', 'America/Noronha', 'America/North_Dakota/Beulah', 'America/North_Dakota/Center', 'America/North_Dakota/New_Salem', 'America/Ojinaga', 'America/Panama', 'America/Pangnirtung', 'America/Paramaribo', 'America/Phoenix', 'America/Port-au-Prince', 'America/Port_of_Spain', 'America/Porto_Velho', 'America/Puerto_Rico', 'America/Rainy_River', 'America/Rankin_Inlet', 'America/Recife', 'America/Regina', 'America/Resolute', 'America/Rio_Branco', 'America/Santarem', 'America/Santiago', 'America/Santo_Domingo', 'America/Sao_Paulo', 'America/Scoresbysund', 'America/Sitka', 'America/St_Barthelemy', 'America/St_Johns', 'America/St_Kitts', 'America/St_Lucia', 'America/St_Thomas',
            'America/St_Vincent', 'America/Swift_Current', 'America/Tegucigalpa', 'America/Thule', 'America/Thunder_Bay', 'America/Tijuana', 'America/Toronto', 'America/Tortola', 'America/Vancouver', 'America/Whitehorse', 'America/Winnipeg', 'America/Yakutat', 'America/Yellowknife', 'Antarctica/Casey', 'Antarctica/Davis', 'Antarctica/DumontDUrville', 'Antarctica/Macquarie', 'Antarctica/Mawson', 'Antarctica/McMurdo', 'Antarctica/Palmer', 'Antarctica/Rothera', 'Antarctica/Syowa', 'Antarctica/Troll', 'Antarctica/Vostok', 'Arctic/Longyearbyen', 'Asia/Aden', 'Asia/Almaty', 'Asia/Amman', 'Asia/Anadyr', 'Asia/Aqtau', 'Asia/Aqtobe', 'Asia/Ashgabat', 'Asia/Atyrau', 'Asia/Baghdad', 'Asia/Bahrain', 'Asia/Baku', 'Asia/Bangkok', 'Asia/Barnaul', 'Asia/Beirut', 'Asia/Bishkek', 'Asia/Brunei', 'Asia/Chita', 'Asia/Choibalsan', 'Asia/Colombo', 'Asia/Damascus', 'Asia/Dhaka', 'Asia/Dili', 'Asia/Dubai', 'Asia/Dushanbe', 'Asia/Famagusta', 'Asia/Gaza', 'Asia/Hebron', 'Asia/Ho_Chi_Minh',
            'Asia/Hong_Kong', 'Asia/Hovd', 'Asia/Irkutsk', 'Asia/Jakarta', 'Asia/Jayapura', 'Asia/Jerusalem', 'Asia/Kabul', 'Asia/Kamchatka', 'Asia/Karachi', 'Asia/Kathmandu', 'Asia/Khandyga', 'Asia/Kolkata', 'Asia/Krasnoyarsk', 'Asia/Kuala_Lumpur', 'Asia/Kuching', 'Asia/Kuwait', 'Asia/Macau', 'Asia/Magadan', 'Asia/Makassar', 'Asia/Manila', 'Asia/Muscat', 'Asia/Nicosia', 'Asia/Novokuznetsk', 'Asia/Novosibirsk', 'Asia/Omsk', 'Asia/Oral', 'Asia/Phnom_Penh', 'Asia/Pontianak', 'Asia/Pyongyang', 'Asia/Qatar', 'Asia/Qyzylorda', 'Asia/Riyadh', 'Asia/Sakhalin', 'Asia/Samarkand', 'Asia/Seoul', 'Asia/Shanghai', 'Asia/Singapore', 'Asia/Srednekolymsk', 'Asia/Taipei', 'Asia/Tashkent', 'Asia/Tbilisi', 'Asia/Tehran', 'Asia/Thimphu', 'Asia/Tokyo', 'Asia/Tomsk', 'Asia/Ulaanbaatar', 'Asia/Urumqi', 'Asia/Ust-Nera', 'Asia/Vientiane', 'Asia/Vladivostok', 'Asia/Yakutsk', 'Asia/Yangon', 'Asia/Yekaterinburg', 'Asia/Yerevan', 'Atlantic/Azores', 'Atlantic/Bermuda', 'Atlantic/Canary', 'Atlantic/Cape_Verde',
            'Atlantic/Faroe', 'Atlantic/Madeira', 'Atlantic/Reykjavik', 'Atlantic/South_Georgia', 'Atlantic/St_Helena', 'Atlantic/Stanley', 'Australia/Adelaide', 'Australia/Brisbane', 'Australia/Broken_Hill', 'Australia/Currie', 'Australia/Darwin', 'Australia/Eucla', 'Australia/Hobart', 'Australia/Lindeman', 'Australia/Lord_Howe', 'Australia/Melbourne', 'Australia/Perth', 'Australia/Sydney', 'Europe/Amsterdam', 'Europe/Andorra', 'Europe/Astrakhan', 'Europe/Athens', 'Europe/Belgrade', 'Europe/Berlin', 'Europe/Bratislava', 'Europe/Brussels', 'Europe/Bucharest', 'Europe/Budapest', 'Europe/Busingen', 'Europe/Chisinau', 'Europe/Copenhagen', 'Europe/Dublin', 'Europe/Gibraltar', 'Europe/Guernsey', 'Europe/Helsinki', 'Europe/Isle_of_Man', 'Europe/Istanbul', 'Europe/Jersey', 'Europe/Kaliningrad', 'Europe/Kiev', 'Europe/Kirov', 'Europe/Lisbon', 'Europe/Ljubljana', 'Europe/London', 'Europe/Luxembourg', 'Europe/Madrid', 'Europe/Malta', 'Europe/Mariehamn', 'Europe/Minsk', 'Europe/Monaco',
            'Europe/Moscow', 'Europe/Oslo', 'Europe/Paris', 'Europe/Podgorica', 'Europe/Prague', 'Europe/Riga', 'Europe/Rome', 'Europe/Samara', 'Europe/San_Marino', 'Europe/Sarajevo', 'Europe/Saratov', 'Europe/Simferopol', 'Europe/Skopje', 'Europe/Sofia', 'Europe/Stockholm', 'Europe/Tallinn', 'Europe/Tirane', 'Europe/Ulyanovsk', 'Europe/Uzhgorod', 'Europe/Vaduz', 'Europe/Vatican', 'Europe/Vienna', 'Europe/Vilnius', 'Europe/Volgograd', 'Europe/Warsaw', 'Europe/Zagreb', 'Europe/Zaporozhye', 'Europe/Zurich', 'Indian/Antananarivo', 'Indian/Chagos', 'Indian/Christmas', 'Indian/Cocos', 'Indian/Comoro', 'Indian/Kerguelen', 'Indian/Mahe', 'Indian/Maldives', 'Indian/Mauritius', 'Indian/Mayotte', 'Indian/Reunion', 'Pacific/Apia', 'Pacific/Auckland', 'Pacific/Bougainville', 'Pacific/Chatham', 'Pacific/Chuuk', 'Pacific/Easter', 'Pacific/Efate', 'Pacific/Enderbury', 'Pacific/Fakaofo', 'Pacific/Fiji', 'Pacific/Funafuti', 'Pacific/Galapagos', 'Pacific/Gambier', 'Pacific/Guadalcanal',
            'Pacific/Guam', 'Pacific/Honolulu', 'Pacific/Johnston', 'Pacific/Kiritimati', 'Pacific/Kosrae', 'Pacific/Kwajalein', 'Pacific/Majuro', 'Pacific/Marquesas', 'Pacific/Midway', 'Pacific/Nauru', 'Pacific/Niue', 'Pacific/Norfolk', 'Pacific/Noumea', 'Pacific/Pago_Pago', 'Pacific/Palau', 'Pacific/Pitcairn', 'Pacific/Pohnpei', 'Pacific/Port_Moresby', 'Pacific/Rarotonga', 'Pacific/Saipan', 'Pacific/Tahiti', 'Pacific/Tarawa', 'Pacific/Tongatapu', 'Pacific/Wake', 'Pacific/Wallis', 'Africa/Asmera', 'Africa/Timbuktu', 'America/Argentina/ComodRivadavia', 'America/Atka', 'America/Buenos_Aires', 'America/Catamarca', 'America/Coral_Harbour', 'America/Cordoba', 'America/Ensenada', 'America/Fort_Wayne', 'America/Indianapolis', 'America/Jujuy', 'America/Knox_IN', 'America/Louisville', 'America/Mendoza', 'America/Montreal', 'America/Porto_Acre', 'America/Rosario', 'America/Santa_Isabel', 'America/Shiprock', 'America/Virgin', 'Antarctica/South_Pole', 'Asia/Ashkhabad', 'Asia/Calcutta',
            'Asia/Chongqing', 'Asia/Chungking', 'Asia/Dacca', 'Asia/Harbin', 'Asia/Istanbul', 'Asia/Kashgar', 'Asia/Katmandu', 'Asia/Macao', 'Asia/Rangoon', 'Asia/Saigon', 'Asia/Tel_Aviv', 'Asia/Thimbu', 'Asia/Ujung_Pandang', 'Asia/Ulan_Bator', 'Atlantic/Faeroe', 'Atlantic/Jan_Mayen', 'Australia/ACT', 'Australia/Canberra', 'Australia/LHI', 'Australia/North', 'Australia/NSW', 'Australia/Queensland', 'Australia/South', 'Australia/Tasmania', 'Australia/Victoria', 'Australia/West', 'Australia/Yancowinna', 'Brazil/Acre', 'Brazil/DeNoronha', 'Brazil/East', 'Brazil/West', 'Canada/Atlantic', 'Canada/Central', 'Canada/East-Saskatchewan', 'Canada/Eastern', 'Canada/Mountain', 'Canada/Newfoundland', 'Canada/Pacific', 'Canada/Saskatchewan', 'Canada/Yukon', 'CET', 'Chile/Continental', 'Chile/EasterIsland');
        ?>
                          <select name=""  class="form-control timezone_mail" id="mail1">
                                <option value="">Select Time Zone </option>
                            <?php for ($i = 0; $i < count($timezone); $i++) { ?>
                                    <option value='<?php echo esc_attr($timezone[$i]); ?>' <?php
//                    if (get_option('Pageflipper_TimeZone') == $timezone[$i]) {
//                        echo ' selected="selected"';
//                    }
                    ?> <?php if($query5['0']->timezone == $timezone[$i]){ echo 'selected'; } ?>><?php echo esc_html($timezone[$i]); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                   
                    <div class="form-group margin_optin success_button" style="">
                        <input type="submit" class="btn btn-success" name="submit" value="Update" id="submit_phpmail">                                   
                           </div>
                   
                  
               </form>
           </div>
      </div>
      
      <?php
 
    }
}
}