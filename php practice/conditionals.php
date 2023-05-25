<?php
  $input1 = 8;
  $input2 = 11;

  if ($input1 < $input2) {
    $comparisonText = "less than";
  }
  elseif ($input1 > $input2) {
    $comparisonText = "greater than";
  }
  else {
    $comparisonText = "equal to";
  }
  echo "The number ".$input1." is ".$comparisonText." the number ".$input2;    
