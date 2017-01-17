<?php
require_once __DIR__ . '/lineBot.php';

$bot = new Linebot();
$text = $bot->getMessageText();
$bot->reply($text .ก็ได้);

echo "<br><h1>This LINE-bot is working now!</h1>";



