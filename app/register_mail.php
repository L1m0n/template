<?php

$recepient = "test@gmail.com";
$sitename = "test";

$mail = trim($_POST["mail"]);
$phone = trim($_POST["phone"]);
$name = trim($_POST["name"]);
$city = trim($_POST["city"]);
$ip_address= $_SERVER["REMOTE_ADDR"];
$GA_client_id = $_COOKIE['_ga'];

$dblocation = "localhost"; // Имя сервера
$dbuser = "12";          // Имя пользователя
$dbpasswd = "12";            // Пароль
$dbname = "12";
$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);

if (!$dbcnx) // Если дескриптор равен 0 соединение не установлено
{
  echo("<P>error</P>");

}
if (!@mysql_select_db($dbname, $dbcnx)) 
{
  echo( "<P>В настоящий момент база данных не доступна, поэтому
            корректное отображение страницы невозможно.</P>" );

}
$query = "INSERT INTO consultation() VALUES ('$name', '$phone')";
mysql_query ("SET NAMES utf8");
mysql_query ( $query );	

$pagetitle = "pagetitle";
$message = "Имя: $name <br> Телефон: $phone  <br> E-mail: $mail <br>
Город: $city <br>
utm_source: $utm_source <br>
utm_campaign: $utm_campaign<br>
utm_medium: $utm_medium<br>
date_submitted: $date_submitted<br>
time_submitted: $time_submitted<br>
page_url: $page_url<br>
ref: $ref<br>
utm_term: $utm_term<br>
utm_content: $utm_content<br>
lead_name: $lead_name<br>
lead_price: $lead_price<br>
";

// Для отправки HTML-письма должен быть установлен заголовок Content-type
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=urf-8' . "\r\n";

// Дополнительные заголовки
$headers .= 'From: test.com.ua';


mail($recepient, $pagetitle, $message, $headers);   


/**
Подписка нового юзера в базу mailchimp

require_once 'inc/MCAPI.class.php';
require_once 'inc/config.inc.php'; //contains apikey

$api = new MCAPI($apikey);

$merge_vars = array('FNAME'=>$name, 'LNAME'=>$phone, 
                  'GROUPINGS'=>array(
                        array('name'=>'LP_Webinar', 'groups'=>'webinar')
                        )
                    );

// By default this sends a confirmation email - you will not see new members
// until the link contained in it is clicked!
$retval = $api->listSubscribe( $listId, $mail, $merge_vars, 'html', false );

if ($api->errorCode){
  echo "Unable to load listSubscribe()!\n";
  echo "\tCode=".$api->errorCode."\n";
  echo "\tMsg=".$api->errorMessage."\n";
} else {
    echo "Subscribed - look for the confirmation email!\n";
}
**/


            // Отправка хука в Slack
/*
$message_to_slack = "
*$pagetitle*
Имя: $name 
Телефон: $phone 
E-mail: $mail 
Город: $city 
page_url: $page_url
date_submitted: $date_submitted
time_submitted: $time_submitted
lead_name: $lead_name
lead_price: $lead_price
ref: $ref
utm_source: $utm_source 
utm_campaign: $utm_campaign
utm_medium: $utm_medium
utm_term: $utm_term
utm_content: $utm_content
-------------------------
";

$room = "leads"; 
$icon = ":glitch_crab:"; 
$data = "payload=" . json_encode(array(         
        "channel"       =>  "#{$room}",
        "text"          =>  $message_to_slack,
        "icon_emoji"    =>  $icon
    ));
$url = "";
         
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
echo var_dump($result);
if($result === false)
{
    echo 'Curl error: ' . curl_error($ch);
}
 
curl_close($ch); 
*/


?>