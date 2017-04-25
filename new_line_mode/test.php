<?php
require_once __DIR__ . '/setting.php';

//call function in setting.php
$channelAccessToken = Setting::getChannelAccessToken(); 
$channelSecret = Setting::getChannelSecret();
$apiReply = Setting::getApiReply();
$apiPush = Setting::getApiPush();

echo "<br><h1>This LINE-bot is working now!</h1>";
echo "<br>Channel access token is</h1>" .$channelAccessToken;

echo "@" .date('Y-m-d H:i:s'); 
echo "<hr><h3>success</h3><hr>";

?>