<?php
include('include/init.php');
require __DIR__ . '/vendor/autoload.php'; // remove this line if you use a PHP Framework.

use Orhanerday\OpenAi\OpenAi;

$open_ai_key = getenv('OPENAI_API_KEY');
$open_ai = new OpenAi($open_ai_key);

function generateSteps($goal) {
  return 'Give me 3 daily steps I can take to'.$goal.'
    goal: lose 10 pounds
    steps: 1. Drink at least 2 liters of water every day 2. Walk at least 5,000 steps daily 3. Eat in a caloric deficit
    goal: become a better public speaker
    steps: 1. Join a Toastmasters club 2. Practice a speech in front of the mirror every day 3. Read articles or listen to podcasts about public speaking
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


// decode response
$d = json_decode($chat);
// Get Content
$string = $d->choices[0]->text;

$one = preg_match('/(?<=1\.)(.*)(?=2\.)/', $string, $matches0);
$two = preg_match('/(?<=2\.)(.*)(?=3\.)/', $string, $matches1);
$three = preg_match('/(?<=3\.)(.*)/', $string, $matches2);

$steps = array($matches0[0], $matches1[0], $matches2[0]);

echo (json_encode($steps));

?>


