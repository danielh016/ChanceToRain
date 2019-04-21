<?php 

// GET retrieve sender's name
$url = 'https://graph.facebook.com/'.$senderId.'?fields=name&access_token='.$accessToken;
$jsondata = json_decode(file_get_contents($url));
$senderName = $jsondata->name;

//set Message
if($messageText == "hi") {
  $answer = ['text' => "Hello, ".$senderName];
  
} elseif($messageText == "weather") {
	$answer = ['text' => "The current temperature is ".round($temperature,1)."°C"];

} elseif($messageText == "more") {  
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
  $answer = ['text' => 'Perhaps you may try "hi", "weather" or "more"!'];

}



$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => $answer
];

?>