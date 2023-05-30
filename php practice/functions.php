<?php
  // echo rand(0, 100);
  $randomValue = rand(-100, 100);

  if ($randomValue > 0) {
    $descriptionText = "positive";
  }
  elseif ($randomValue < 0) {
    $descriptionText = "negative";
  }
  else {
    $descriptionText = "zero";    
  }

  echo "Our number ".$randomValue." is ".$descriptionText;
