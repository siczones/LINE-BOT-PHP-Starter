<?php
	$url = 'https://siczones.coe.psu.ac.th/cgi-bin/requestAlert.py';
	$data = array('ID' => 'temp', 'key' => 'abcd');
	
	// use key 'http' even if you send the request to https://...
	$options = array(
	    'http' => array(
	        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	        'method'  => 'POST',
	        'content' => http_build_query($data)
	    )
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE) { /* Handle error */ }
	
	var_dump($result);
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
	$bot->reply('ระบบกำลังตรวจสอบ...' .$text .'   ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
	$url = 'https://siczones.coe.psu.ac.th/cgi-bin/requestAlert.py';
	$data = array('ID' => 'temp', 'key' => 'abcd');
	
	// use key 'http' even if you send the request to https://...
	$options = array(
	    'http' => array(
	        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	        'method'  => 'POST',
	        'content' => http_build_query($data)
	    )
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE) { /* Handle error */ }
	
	var_dump($result);
}
elseif( ($text == 'ความชื้น')){
	$bot->reply('ระบบกำลังตรวจสอบ...' .$text .'   ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
}
elseif( ($text == 'เสียงผิดปกติ')){
	$bot->reply('ระบบกำลังตรวจสอบ...' .$text .'   ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
}
elseif( ($text == 'แสงสว่าง')){
	$bot->reply('ระบบกำลังตรวจสอบ...' .$text .'   ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
}
elseif( ($text == 'การเคลื่อนไหว')){
	$bot->reply('ระบบกำลังตรวจสอบ...' .$text .'   ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
}
else{
	$bot->reply('Oops!  ระบบกำลังพัฒนาและพร้อมใช้งานในเร็วๆ นี้  ระหว่างนี้ท่านสามารถใช้งาน คำสั่ง เปิดไฟ ปิดไฟ อุณหภูมิ ความชื้น เสียงผิดปกติ แสงสว่าง การเคลื่อนไหว เพื่อตรวจสอบเบื้องต้น หรือตรวจสอบข้อมูลเพิ่มเติมของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
}
echo "<hr><h3>success</h3><hr>";

?>



