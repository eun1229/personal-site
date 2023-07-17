<?php
include('include/init.php');
require __DIR__ . '/vendor/autoload.php'; // remove this line if you use a PHP Framework.

use Orhanerday\OpenAi\OpenAi;

$open_ai_key = getenv('OPENAI_API_KEY');
$open_ai = new OpenAi($open_ai_key);

function generateSteps($goal) {
  return 'Give me 3 daily steps I can take to'.$goal.' in a JSON array without enumerating the steps with numbers
  goal: become a better public speaker
  steps: ["Join a Toastmasters club", "Practice a 2 minute speech in front of the mirror", "Read articles or listen to podcasts about public speaking"]
  goal: '.$goal.'
  steps:';
}

$chat = $open_ai->completion([
  'model' => 'text-davinci-002',
  'prompt' => generateSteps($_REQUEST['goal']),
  'temperature' => 0.9,
  'max_tokens' => 150,
  'frequency_penalty' => 0,
  'presence_penalty' => 0.6,
]);


// // decode response
$d = json_decode($chat);
// // Get Content
$string = $d->choices[0]->text;

echo ($string);

?>


