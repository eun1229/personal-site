<?php //opening tag for php
  $Result = 3+9; //variables start with $
  //different ways to echo/print something
  echo($Result);
  echo "<br/><br/>echoing a string without parentheses ".$Result; //concantentate a variable with .$variableName, there must be no space btwn ".

  $input1 = 7;
  $input2 = 9;

  $sum = $input1 + $input2;

  echo
    "<br/><br/> We're going to add the numbers ".$input1." and ".$input2.".
    <br/><br/>
    Here we go: ".$input1." + ".$input2." = ".$sum;