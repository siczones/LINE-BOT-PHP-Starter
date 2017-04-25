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
			$img_url = "https://siczones.coe.psu.ac.th/img/brand/Noo.jpg";
			$button = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder("Mode", "Please select mode", $img_url, $actions);
			$outputText = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("This funcntion active on mobile application only!", $button);
			break;
		case "status" :
			$columns = array();
			$img_url = "https://cdn.shopify.com/s/files/1/0379/7669/products/sampleset2_1024x1024.JPG?v=1458740363";
			for($i=0;$i<5;$i++) {
				$actions = array(
					new \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("View status","action=carousel&button=".$i),
					new \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder("View","http://www.google.com")
				);
				$column = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder("Sensor".($i+1), "description", $img_url , $actions);
				$columns[] = $column;
			}
			$carousel = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder($columns);
			$outputText = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("Carousel Demo", $carousel);
			break;	
		case "image" :
			$img_url = "https://cdn.shopify.com/s/files/1/0379/7669/products/sampleset2_1024x1024.JPG?v=1458740363";
			$outputText = new LINE\LINEBot\MessageBuilder\ImageMessageBuilder($img_url, $img_url);
			break;	
		case "siren" :
			$actions = array (
				New \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("on", "ans=on"),
				New \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("off", "ans=off")
			);
			$button = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder("Siren", $actions);
			$outputText = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("This funcntion active on mobile application only!", $button);
			break;
		default :
			$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("Command: text, location, button, confirm to test message template");	
			break;
		}
		$response = $bot->replyMessage($event->getReplyToken(), $outputText);
	}
} 
?>