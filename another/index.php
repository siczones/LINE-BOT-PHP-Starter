<?php
echo "<br><h1>This LINE-bot is working now!</h1>";
echo "@" .date('Y-m-d H:i:s'); 

require_once __DIR__ . '/lineBot.php';

$endpoint = 'ท่านสามารถตรวจสอบผลการทำงานเพิ่มเติมอีกครั้งได้ที่  https://siczones.coe.psu.ac.th';
$bot = new Linebot();
$text = $bot->getMessageText();
$sirenOn = 'siren on';
$sirenOn_th = 'เปิดไซเรน';
$sirenOff = 'siren off';
$sirenOff_th = 'ปิดไซเรน';
$rpitemp = 'pi';
$rpitemp_th = 'พาย';
$temp = 'temp';
$temp_th = 'อุณหภูมิ';
$humid = 'humidity';
$humid_th = 'ความชื้น';
$voice = 'voice';
$voice_th = 'เสียง';
$light = 'light';
$light_th = 'แสง';
$motion = 'motion';
$motion_th = 'เคลื่อนไหว';
$help = 'help';
$help_th1 = 'ช่วยเหลือ';
$help_th2 = 'คู่มือ';

if($text == 'สวัสดี' or $text== 'Hello'){
	$bot->reply('ยินดีต้อนรับสู่ระบบการแจ้งเตือนความปลอดภัยผ่านสื่อสังคมออนไลน์โดยตรวจสอบข้อมูลเพิ่มเติมของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');
}

elseif ((strpos($text, $sirenOff) !== false) or (strpos($text, $sirenOff_th) !== false)){
	$bot->reply('ส่งคำขอ ' .$text .'  ให้แล้วนะ ' .$endpoint);	
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
	if ($result == FALSE) {$bot->reply('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
	
	var_dump($result);
}

elseif ((strpos($text, $sirenOn) !== false) or (strpos($text, $sirenOn_th) !== false)){
	$bot->reply('ส่งคำขอ ' .$text .'  ให้แล้วนะ ' .$endpoint);		
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
	if ($result == FALSE) {$bot->reply('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
	
	var_dump($result);
}

elseif ((strpos($text, $rpitemp) !== false) or (strpos($text, $rpitemp_th) !== false)){
	$bot->reply('ระบบกำลังตรวจสอบ...อุณหภูมิเซิร์ฟเวอร์ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้' .$endpoint);	
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
	if ($result == FALSE) {$bot->reply('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
	
	var_dump($result);
}

elseif ((strpos($text, $temp) !== false) or (strpos($text, $temp_th) !== false)){
	$bot->reply('ระบบกำลังตรวจสอบ...' .$temp_th .'   ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้' .$endpoint);	
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
	if ($result == FALSE) {$bot->reply('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
	
	var_dump($result);
}
elseif ((strpos($text, $humid) !== false) or (strpos($text, $humid_th) !== false)){
	$bot->reply('ระบบกำลังตรวจสอบ...' .$humid_th .'   ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้' .$endpoint);	
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
	if ($result == FALSE) {$bot->reply('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
	
	var_dump($result);
	}
elseif ((strpos($text, $voice) !== false) or (strpos($text, $voice_th) !== false)){
	$bot->reply('ระบบกำลังตรวจสอบ...' .$voice_th .' ผิดปกติ  ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้' .$endpoint);	
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
	if ($result == FALSE) {$bot->reply('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
	
	var_dump($result);
	}
elseif ((strpos($text, $light) !== false) or (strpos($text, $light_th) !== false)){
	$bot->reply('ระบบกำลังตรวจสอบ...' .$light_th .' สว่าง  ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้' .$endpoint);	
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
	if ($result == FALSE) {$bot->reply('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
	
	var_dump($result);
	}
elseif ((strpos($text, $motion) !== false) or (strpos($text, $motion_th) !== false)){
	$bot->reply('ระบบกำลังตรวจสอบ...การ' .$motion_th .'   ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้' .$endpoint);	
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
	if ($result == FALSE) {$bot->reply('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
	
	var_dump($result);
	}

elseif ((strpos($text, $help) !== false) or (strpos($text, $help_th1) !== false)){
	$bot->reply('ท่านสามารถใช้งาน คำสั่งดังต่อไปนี้เพื่อตรวจสอบและควบคุมการทำงานของระบบ 
	เปิดไฟ,ปิดไฟ,อุณหภูมิ,ความชื้น,เสียง,แสง,การเคลื่อนไหว,โหมด,โหมด: อยู่บ้าน,โหมด: ไม่อยู่บ้าน,pi,
	temp,humidity,motion,light,voice,siren on,siren off,mode,mode: stand by,mode: full
'.$endpoint);	
}

elseif($text == 'สวัสดี' or $text== 'Hello'){
	$bot->reply('ยินดีต้อนรับสู่ระบบการแจ้งเตือนความปลอดภัยผ่านสื่อสังคมออนไลน์โดยตรวจสอบข้อมูลเพิ่มเติมของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');
}

else{
	$bot->reply('Oops! ไม่พบคีย์เวิร์ดที่ต้องการ ในระหว่างนี้ท่านสามารถใช้งาน คำสั่ง เปิดไฟ ปิดไฟ อุณหภูมิ ความชื้น เสียงผิดปกติ แสงสว่าง การเคลื่อนไหว หรือพิมพ์คำว่า "ช่วยเหลือ"  เพื่อแสดงคู่มือการใช้งานหรือตรวจสอบข้อมูลเพิ่มเติมของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');	
}
echo "<hr><h3>success</h3><hr>";

?>



