<?php

class Setting {
	public function getChannelAccessToken(){
		$channelAccessToken = "hb8oE3kH7ys+kpqrUcKCEeAii6gvsAmf4hKTJzffNe6VEkcptKpdczTKs7BHuxlkN3JbH8731E1D7/h/4Lu2L5gjKrTTW9kpwGTcZd7w+tpw/RPQEWWILrhfePT0s2nUe2M+O50e1NOPVUpNAF3emwdB04t89/1O/w1cDnyilFU=";
		return $channelAccessToken;
	}
	public function getChannelSecret(){
		$channelSecret = "4fa72238672c25a970d378eb364ac3af";
		return $channelSecret;
	}
	public function getApiReply(){
		$api = "https://api.line.me/v2/bot/message/reply";
		return $api;
	}
	public function getApiPush(){
		$api = "https://api.line.me/v2/bot/message/push";
		return $api;
	}
}