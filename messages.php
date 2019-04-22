<?php 

// GET retrieve sender's name 
$url = 'https://graph.facebook.com/'.$senderId.'?fields=name&access_token='.$accessToken;
$jsondata = json_decode(file_get_contents($url));
$senderName = $jsondata->name;

//set Message
if(preg_match('/[H|h][E|e|I|i]/', $messageText)) {
  $answer = ['text' => "Hello, ".$senderName];
  
} elseif(preg_match('/[T|t][O|o][D|d][A|a][Y|y]/', $messageText)) {
	$answer = ['text' => "Currently ".round($temperature,1)."°C. Today's highest: ".round($todayTempHigh,1)."°C.\n\nThe chance of rain today is ".$precipProbability."%.\n\nToday's highest UV index is ".$uvindex."(".$uvscale.").\n\nThe most recent PM2.5 index is ".$pm25."(".$pmscale.")." ];

} elseif(preg_match('/[M|m][O|o][R|r][E|e]/', $messageText)) {  
 	$answer = ["attachment"=>[
    "type"=>"template",
    "payload"=>[
      "template_type"=>"button",
      "text"=>"What do you want to do next?",
      "buttons"=>[
        [
          "type"=>"web_url",
          "url"=>"https://weather.hyhu.me",
          "title"=>"Show Website"
        ]
      ]
    ]
  ]];

} else {
  $answer = ['text' => 'Type "today" for today\'s weather condition. Type "more" for the weather forecast website.'];

}



$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => $answer
];

?>