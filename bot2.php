<?php
$access_token = 'PrWTV5bXVrtLSyt0jsXfiF9jCBUX6lmuYnt49fgqyESRkAAlQAbSZauENl24pecw7QCpAiKngVHr5r5te+maRsBk0T1OSfctNZz0pk9Z23d2T5YDPPAYu+jO6MjcGwFegweBsodqGG2NGKCA3r8TRgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message'{

			switch($event[‘message’][‘type’]){
 			case 'text':
 			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			if ($text == "1"){
				// Build message to reply back
				$messages = [
				'type' => 'text',
				'text' => "แจ้งอุบัติเหตุ รบกวนช่วยแชร์ location ครับ"
				];
			} elseif ($text == "2"){
				// Build message to reply back
				$messages = [
				'type' => 'text',
				'text' => "แจ้งซ่อม รบกวนขอเบอร์โทรติดต่อกลับครับ"
				];
			} else {
				$messages = [
				'type' => 'text',
				'text' => "ขอบคุณที่ส่งข้อความถึงเรา .. TVIHotline ยินดีบริการ เราพร้อมอยู่เคียงข้างและดูแลคุณตลอด 24 ชม. กรุณากรุณาเลือกบริการที่ท่านต้องการติดต่อ 
				\n กด 1  บริการแจ้งอุบัติเหตุ 
				\n กด 2  บริการแจ้งซ่อม"
				];
			}
 			break;
 			//case 'location':
 			// Get replyToken
			//$replyToken = $event['replyToken'];
 			//$messages = [
			//'type' => 'text',
			//'text' => "ได้รับ location แล้ว ขอบคุณครับ"];
			//break;

			default:
 			}

 			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";

		}
	}
}
echo "OK";