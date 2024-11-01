<?php
if(!class_exists('OptinJeetWpmail'))
{
	class OptinJeetWpmail
	{
		function composeMail($mailtoarr,$mailSub,$msggg)
		{
		
		global $wpdb;
		
		$table=$wpdb->prefix."optinjeet_phpmail";
		
		$res=$wpdb->get_var("select phpmail_from_email from ".$table." order by id desc limit 1");
		
		//echo $res;
		
	$to =implode(', ',$mailtoarr);
$subject =$mailSub;

$message = "
<html>
<head>
<title>Email Message</title>
</head>
<body>".$msggg."
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers

if(filter_var($res,FILTER_VALIDATE_EMAIL))
{
    
$headers .= 'From: <'.$res.'>' . "\r\n";
//$headers .= 'Cc: myboss@gmail.com' . "\r\n";

}

if(mail($to,$subject,$message,$headers)){return 1;}else{return 0;};
		
		}
	
	}
	
}
?>