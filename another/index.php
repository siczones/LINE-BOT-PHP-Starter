<?php
echo "<br><h1>This LINE-bot is working now!</h1>";
echo "@" .date('Y-m-d H:i:s'); 

require_once __DIR__ . '/lineBot.php';

$bot = new Linebot();
$text = $bot->getMessageText();
if($text == 'สวัสดี'){
	$bot->reply('ยินดีต้อนรับสู่ระบบการแจ้งเตือนความปลอดภัยผ่านสื่อสังคมออนไลน์โดยตรวจสอบข้อมูลเพิ่มเติมของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');
}
elseif( ($text == 'เปิดไฟ') or ($text == 'ปิดไฟ') ){
	$bot->reply('ระบบรับรู้การ' .$text .' '.'ในระหว่างนี้ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
}
elseif( ($text == 'อุณหภูมิ')){
	$bot->reply('ระบบกำลังตรวจสอบ ' .$text .' '.' กรุณารอสักครู่ ในระหว่างนี้ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
}
elseif( ($text == 'ความชื้น')){
	$bot->reply('ระบบกำลังตรวจสอบ ' .$text .' '.' กรุณารอสักครู่ ในระหว่างนี้ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
}
elseif( ($text == 'เสียงผิดปกติ')){
	$bot->reply('ระบบกำลังตรวจสอบ ' .$text .' '.' กรุณารอสักครู่ ในระหว่างนี้ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
}
elseif( ($text == 'แสงสว่าง')){
	$bot->reply('ระบบกำลังตรวจสอบ ' .$text .' '.' กรุณารอสักครู่ ในระหว่างนี้ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
}
elseif( ($text == 'การเคลื่อนไหว')){
	$bot->reply('ระบบกำลังตรวจสอบ ' .$text .' '.' กรุณารอสักครู่ ในระหว่างนี้ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
}
else{
	$bot->reply('ระบบกำลังพัฒนาและพร้อมใช้งานในเร็วๆ นี้  ระหว่างนี้ท่านสามารถตรวจสอบข้อมูลเพิ่มเติมของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
}
echo "<hr><h3>success</h3><hr>";
?>



