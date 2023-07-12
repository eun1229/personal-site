<?php

require __DIR__ . '/vendor/autoload.php'; // remove this line if you use a PHP Framework.

use Orhanerday\OpenAi\OpenAi;

$open_ai_key = getenv('OPENAI_API_KEY');
$open_ai = new OpenAi($open_ai_key);

// $chat = $open_ai->chat([
//    'model' => 'gpt-3.5-turbo',
//    'messages' => [
//        [
//            "role" => "system",
//            "content" => "You are a helpful assistant."
//        ],
//        [
//            "role" => "user",
//            "content" => "Who won the world series in 2020?"
//        ],
//        [
//            "role" => "assistant",
//            "content" => "The Los Angeles Dodgers won the World Series in 2020."
//        ],
//        [
//            "role" => "user",
//            "content" => "Where was it played?"
//        ],
//    ],
//    'temperature' => 1.0,
//    'max_tokens' => 4000,
//    'frequency_penalty' => 0,
//    'presence_penalty' => 0,
// ]);

function generateSteps($goal) {
  return 'Give me 3 daily steps I can take to'.$goal;
}

$chat = $open_ai->completion([
  'model' => 'text-davinci-002',
  'prompt' => generateSteps($_REQUEST['goal']),
  'temperature' => 0.9,
  'max_tokens' => 150,
  'frequency_penalty' => 0,
  'presence_penalty' => 0.6,
]);


// var_dump($chat);
// echo "<br>";
// echo "<br>";
// echo "<br>";
// decode response
$d = json_decode($chat);
// Get Content
echo($d->choices[0]->text);

?>


