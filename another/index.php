<?php
echo "<br><h1>This LINE-bot is working now!</h1>";
echo "@" .date('Y-m-d H:i:s'); 

require_once __DIR__ . '/lineBot.php';

$bot = new Linebot();
$text = $bot->getMessageText();
if($text == 'สวัสดี'){
	$bot->reply('ยินดีต้อนรับสู่ระบบการแจ้งเตือนความปลอดภัยผ่านสื่อสังคมออนไลน์โดยตรวจสอบข้อมูลเพิ่มเติมของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');
}
else{
	$bot->reply('ท่านสามารถตรวจสอบข้อมูลเพิ่มเติมของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
}
echo "<hr><h3>success</h3><hr>";
?>



