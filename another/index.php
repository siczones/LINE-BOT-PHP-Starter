<?php
require_once __DIR__ . '/lineBot.php';

$bot = new Linebot();
$text = $bot->getMessageText();
$bot->reply($text);

echo "<br><h1 align="center">This LINE-bot is working now!</h1>";



