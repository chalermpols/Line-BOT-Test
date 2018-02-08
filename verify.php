<?php
$access_token = 'PrWTV5bXVrtLSyt0jsXfiF9jCBUX6lmuYnt49fgqyESRkAAlQAbSZauENl24pecw7QCpAiKngVHr5r5te+maRsBk0T1OSfctNZz0pk9Z23d2T5YDPPAYu+jO6MjcGwFegweBsodqGG2NGKCA3r8TRgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
