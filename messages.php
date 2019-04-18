<?php 

//set Message
if($messageText == "hi") {
    $answer = "Hello";
}

if($messageText == "weather") {
	$text = "The current temperature is ".round($temperature,1)."°C";
	$answer = $text;
}

if($messageText != "hi" && $messageText != "weather" && $messageText != "more") {
	$answer = 'Perhaps you may try "hi", "weather" or "more"!';
}

$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];

if($messageText == "more") {  
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

    $response = [
    	'recipient' => [ 'id' => $senderId ],
    	'message' => $answer 
	];
}

?>