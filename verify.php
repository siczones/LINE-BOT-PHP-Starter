<!DOCTYPE html>
<html>
<head>
	<title>LINE-Bot php Verify</title>	
</head>
<?php
$access_token = 'hb8oE3kH7ys+kpqrUcKCEeAii6gvsAmf4hKTJzffNe6VEkcptKpdczTKs7BHuxlkN3JbH8731E1D7/h/4Lu2L5gjKrTTW9kpwGTcZd7w+tpw/RPQEWWILrhfePT0s2nUe2M+O50e1NOPVUpNAF3emwdB04t89/1O/w1cDnyilFU=';

$url1 = 'https://api.line.me/v1/oauth/verify';
$url2 = 'https://api.line.me/v1/profile';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result1 = curl_exec($ch);
curl_close($ch);

$ch = curl_init($url2);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result2 = curl_exec($ch);
curl_close($ch);

echo "<h2>This is get verify JSON file from Sever </h2>" .$result1;
echo "<h2>This is get profile JSON file from Sever </h2>" .$result2;
?>

</body>
</html>