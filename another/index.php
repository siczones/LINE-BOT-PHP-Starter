<?php
echo "<br><h1>This LINE-bot is working now!</h1>";
echo "@" .date('Y-m-d H:i:s'); 

require_once __DIR__ . '/lineBot.php';

$bot = new Linebot();
$text = $bot->getMessageText();
$rpitemp = array("pi", "ไพ");

if($text == 'สวัสดี'){
	$bot->reply('ยินดีต้อนรับสู่ระบบการแจ้งเตือนความปลอดภัยผ่านสื่อสังคมออนไลน์โดยตรวจสอบข้อมูลเพิ่มเติมของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');
}

elseif( ($text == 'ปิดไซเรน') or ($text == 'siren off')){
	$bot->reply($text .'   ให้แล้วนะ ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
	$url = 'https://siczones.coe.psu.ac.th/cgi-bin/alert.py';
	$data = array('AlertStatus' => 'OFF', 'key' => 'abcd');
	
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

elseif( ($text == 'เปิดไซเรน') or ($text == 'siren on')){
	$bot->reply($text .'   ให้แล้วนะ ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
	$url = 'https://siczones.coe.psu.ac.th/cgi-bin/alert.py';
	$data = array('AlertStatus' => 'ON', 'key' => 'abcd');
	
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

elseif ((strpos($text, $rpitemp) !== false){
	$bot->reply('ระบบกำลังตรวจสอบ...' .$text .'   ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
	$url = 'https://siczones.coe.psu.ac.th/cgi-bin/requestAlert.py';
	$data = array('ID' => 'rpitemp', 'key' => 'abcd');
	
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

elseif( ($text == 'อุณหภูมิ') or ($text == 'temp')){
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
elseif( ($text == 'ความชื้น') or ($text == 'humidity')){
	$bot->reply('ระบบกำลังตรวจสอบ...' .$text .'   ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
	$url = 'https://siczones.coe.psu.ac.th/cgi-bin/requestAlert.py';
	$data = array('ID' => 'humid', 'key' => 'abcd');
	
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
elseif( ($text == 'เสียงผิดปกติ') or ($text == 'voice')){
	$bot->reply('ระบบกำลังตรวจสอบ...' .$text .'   ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
	$url = 'https://siczones.coe.psu.ac.th/cgi-bin/requestAlert.py';
	$data = array('ID' => 'voice', 'key' => 'abcd');
	
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
elseif( ($text == 'แสงสว่าง') or ($text == 'light')){
	$bot->reply('ระบบกำลังตรวจสอบ...' .$text .'   ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
	$url = 'https://siczones.coe.psu.ac.th/cgi-bin/requestAlert.py';
	$data = array('ID' => 'light', 'key' => 'abcd');
	
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
elseif( ($text == 'การเคลื่อนไหว') or ($text == 'motion')){
	$bot->reply('ระบบกำลังตรวจสอบ...' .$text .'   ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้ท่านสามารถตรวจสอบสถานะการทำงานของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
	$url = 'https://siczones.coe.psu.ac.th/cgi-bin/requestAlert.py';
	$data = array('ID' => 'motion', 'key' => 'abcd');
	
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
else{
	$bot->reply('Oops!  ระบบกำลังพัฒนาและพร้อมใช้งานในเร็วๆ นี้  ระหว่างนี้ท่านสามารถใช้งาน คำสั่ง เปิดไฟ ปิดไฟ อุณหภูมิ ความชื้น เสียงผิดปกติ แสงสว่าง การเคลื่อนไหว เพื่อตรวจสอบเบื้องต้น หรือตรวจสอบข้อมูลเพิ่มเติมของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
}
echo "<hr><h3>success</h3><hr>";

?>



