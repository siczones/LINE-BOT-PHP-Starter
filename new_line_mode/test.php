<?php
require_once __DIR__ . '/setting.php';
require_once __DIR__ . '/vendor/autoload.php';

//call function in setting.php
$channelAccessToken = Setting::getChannelAccessToken(); 
$channelSecret = Setting::getChannelSecret();
$apiReply = Setting::getApiReply();
$apiPush = Setting::getApiPush();

echo "<br><h1>This LINE-bot is working now!</h1>";
echo "@" .date('Y-m-d H:i:s'); 
echo "<hr><h3>success</h3><hr>";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

$endpoint = 'ท่านสามารถตรวจสอบผลการทำงานเพิ่มเติมอีกครั้งได้ที่  https://siczones.coe.psu.ac.th';
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

$sensors = array('Temperature', 'Humidity', 'Voice', 'Light', 'Motion');
$sensors_des = array("Temperature in celsuis degree", "Percent of humidity", "Voice activity detection", "Light in 10 level", "Motion detection");
$sensors_id = array($temp, $humid, $voice, $light, $motion);

$standby = 'mode: stand by';
$standby_th = 'โหมด: อยู่บ้าน';
$full = 'mode: full';
$full_th = 'โหมด: ไม่อยู่บ้าน';
$mode = 'mode';
$mode_th = 'โหมด';


$logger = new Logger('LineBot');
$logger->pushHandler(new StreamHandler('php://stderr', Logger::DEBUG));
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($channelAccessToken);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
$signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
$signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
try {
	$events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
} catch(\LINE\LINEBot\Exception\InvalidSignatureException $e) {
	error_log('parseEventRequest failed. InvalidSignatureException => '.var_export($e, true));
} catch(\LINE\LINEBot\Exception\UnknownEventTypeException $e) {
	error_log('parseEventRequest failed. UnknownEventTypeException => '.var_export($e, true));
} catch(\LINE\LINEBot\Exception\UnknownMessageTypeException $e) {
	error_log('parseEventRequest failed. UnknownMessageTypeException => '.var_export($e, true));
} catch(\LINE\LINEBot\Exception\InvalidEventRequestException $e) {
	error_log('parseEventRequest failed. InvalidEventRequestException => '.var_export($e, true));
}
foreach ($events as $event) {
	// Postback Event
	if (($event instanceof \LINE\LINEBot\Event\PostbackEvent)) {
		$logger->info('Postback message has come');
		continue;
	}
	// Location Event
	if  ($event instanceof LINE\LINEBot\Event\MessageEvent\LocationMessage) {
		$logger->info("location -> ".$event->getLatitude().",".$event->getLongitude());
		continue;
	}
	// Message Event = TextMessage
	if (($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage)) {
		$messageText=strtolower(trim($event->getText()));
		switch ($messageText) {
		case "hello" : 
			$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ยินดีต้อนรับสู่ระบบการแจ้งเตือนความปลอดภัยผ่านสื่อสังคมออนไลน์ท่านสามารถตรวจสอบข้อมูลเพิ่มเติมของระบบได้ที่ ' .'https://siczones.coe.psu.ac.th');
			break;
		case "location" :
			$outputText = new \LINE\LINEBot\MessageBuilder\LocationMessageBuilder("Embedded room", "Department of Computer Engineering, Prince of Songkla University, Hatyai Songkla ,Thailand",  7.858328, 100.294750);
			break;
		case "mode" :
			$actions = array (
				// general message action
				New \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder("Stand by", "mode: stand by"),
				// URL type action
				New \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder("Full", "mode: full"),
				// The following two are interactive actions
				//New \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("next page", "page=3"),
				New \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder("More", "https://siczones.coe.psu.ac.th")
			);
			$img_url = "https://siczones.coe.psu.ac.th/img/brand/logo.jpg";
			$button = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder("Mode", "Please select mode", $img_url, $actions);
			$outputText = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("This funcntion active on mobile application only!", $button);
			break;
		case "status" :
			$columns = array();
			$img_url = "https://siczones.coe.psu.ac.th/img/brand/logo.jpg";
			$count = 1;
			for($i=0;$i<5;$i++) {				
				$actions = array(
					//new \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("Get status","action=carousel&button=".$i),
					new \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder("Get status", (string)$sensors_id[$count-1]),
					new \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder("View more", "https://siczones.coe.psu.ac.th/cgi-bin/status.py")
				);
				$column = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder("Sensor".($i+1) .": " .(string)$sensors[$count-1], .(string)$sensors_des[$count-1], $img_url , $actions);
				$columns[] = $column;
				$count++;
			}
			$carousel = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder($columns);
			$outputText = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("This funcntion active on mobile application only!", $carousel);
			break;	
		/*
			$columns = array();
			$img_url = "https://siczones.coe.psu.ac.th/img/brand/logo.jpg";
			for($i=0;$i<5;$i++) {
				$actions = array(
					//new \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder("Get status", $sensors_id[i]),
					new \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("Get status","action=carousel&button=".$i),
					new \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder("View more", "https://siczones.coe.psu.ac.th/cgi-bin/status.py")
				);
				$column = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder($sensors[i], $sensors_des[i], $img_url , $actions);
				$columns[] = $column;
			}
			$carousel = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder($columns);
			$outputText = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("Carousel Demo", $carousel);
			break;
		*/
		case "image" :
			$img_url = "https://siczones.coe.psu.ac.th/img/brand/logo.jpg";
			$outputText = new LINE\LINEBot\MessageBuilder\ImageMessageBuilder($img_url, $img_url);
			break;	
		case "siren" :
			$actions = array (
				new \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder("On", "siren on"),
				new \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder("Off", "siren off")
				//New \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("on", "ans=on"),
				//New \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("off", "ans=off")
			);
			$button = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder("Siren", $actions);
			$outputText = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("This funcntion active on mobile application only!", $button);
			break;
		default :
		//
			if ((strpos($messageText, $sirenOff) !== false) or (strpos($messageText, $sirenOff_th) !== false)){
				//$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ส่งคำขอ ' .$messageText .'  ให้แล้วนะ ' .$endpoint);	
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
				if ($result == FALSE) {$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
				
				var_dump($result);
			}

			elseif ((strpos($messageText, $sirenOn) !== false) or (strpos($messageText, $sirenOn_th) !== false)){
				//$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ส่งคำขอ ' .$messageText .'  ให้แล้วนะ ' .$endpoint);		
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
				if ($result == FALSE) {$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
				
				var_dump($result);
			}

			elseif ((strpos($messageText, $rpitemp) !== false) or (strpos($messageText, $rpitemp_th) !== false)){
				//$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ระบบกำลังตรวจสอบ...อุณหภูมิเซิร์ฟเวอร์ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้' .$endpoint);	
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
				if ($result == FALSE) {$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
				
				var_dump($result);
			}

			elseif ((strpos($messageText, $temp) !== false) or (strpos($messageText, $temp_th) !== false)){
				//$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ระบบกำลังตรวจสอบ...' .$temp_th .'   ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้' .$endpoint);	
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
				if ($result == FALSE) {$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
				
				var_dump($result);
			}
			elseif ((strpos($messageText, $humid) !== false) or (strpos($messageText, $humid_th) !== false)){
				//$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ระบบกำลังตรวจสอบ...' .$humid_th .'   ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้' .$endpoint);	
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
				if ($result == FALSE) {$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
				
				var_dump($result);
				}
			elseif ((strpos($messageText, $voice) !== false) or (strpos($messageText, $voice_th) !== false)){
				//$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ระบบกำลังตรวจสอบ...' .$voice_th .' ผิดปกติ  ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้' .$endpoint);	
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
				if ($result == FALSE) {$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
				
				var_dump($result);
				}
			elseif ((strpos($messageText, $light) !== false) or (strpos($messageText, $light_th) !== false)){
				//$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ระบบกำลังตรวจสอบ...' .$light_th .' สว่าง  ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้' .$endpoint);	
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
				if ($result == FALSE) {$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
				
				var_dump($result);
				}
			elseif ((strpos($messageText, $motion) !== false) or (strpos($messageText, $motion_th) !== false)){
				//$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ระบบกำลังตรวจสอบ...การ' .$motion_th .'   ให้ท่านอยู่ '.' กรุณารอสักครู่! ในระหว่างนี้' .$endpoint);	
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
				if ($result == FALSE) {$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
				
				var_dump($result);
				}

			elseif ((strpos($messageText, $standby) !== false) or (strpos($messageText, $standby_th) !== false)){
				//$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('เปลี่ยน ' .$messageText .'  ให้แล้วนะ ' .$endpoint);	
				$url = 'https://siczones.coe.psu.ac.th/cgi-bin/mode.py';
				$data = array('currentMode' => '1', 'key' => 'abcd');
				
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
				if ($result == FALSE) {$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
				
				var_dump($result);
			}
				
			elseif ((strpos($messageText, $full) !== false) or (strpos($messageText, $full_th) !== false)){
				//$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('เปลี่ยน ' .$messageText .'  ให้แล้วนะ ' .$endpoint);	
				$url = 'https://siczones.coe.psu.ac.th/cgi-bin/mode.py';
				$data = array('currentMode' => '2', 'key' => 'abcd');
				
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
				if ($result == FALSE) {$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ไม่สำเร็จ!! กรุณารอสักครู่ แล้วลองใหม่อีกครั้ง!');}
				
				var_dump($result);
			}

			elseif ((strpos($messageText, $mode) !== false) or (strpos($messageText, $mode_th1) !== false)){
				$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ท่านสามารถใช้งาน คำสั่งดังต่อไปนี้เพื่อควบคุมโหมดการทำงานของระบบ 
				โหมด: อยู่บ้าน,
				โหมด: ไม่อยู่บ้าน,
				mode: stand by,
				mode: full
			'.$endpoint);	
			}
				
			elseif ((strpos($messageText, $help) !== false) or (strpos($messageText, $help_th1) !== false)){
				$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ท่านสามารถใช้งาน คำสั่งดังต่อไปนี้เพื่อตรวจสอบและควบคุมการทำงานของระบบ 
				พาย,
				อุณหภูมิ,
				ความชื้น,
				เคลื่อนไหว,
				แสง,
				เสียง,
				ช่วยเหลือ,
				โหมด,
				โหมด: อยู่บ้าน,
				โหมด: ไม่อยู่บ้าน,
				pi,
				temp,
				humidity,
				motion,
				light,
				voice,
				siren,
				siren on,
				siren off,
				mode,
				mode: stand by,
				mode: full
				location,
				status,
			'.$endpoint);	
			}
		//
			break;
		}
		$response = $bot->replyMessage($event->getReplyToken(), $outputText);
	}
} 
?>