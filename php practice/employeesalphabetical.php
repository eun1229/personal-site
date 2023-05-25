<?php
  $employees = array('Ther Matthew', 'Eva Jeliazkova', 'Maddie Hoffmann', 'Michael Wuellner', 'Robert Landis', 'Emily Schwab', 'Bracken King');
  sort($employees);
  echo "Some LACRM employees in alphabetical order: <br>";
  echo "<br>";
  foreach ($employees as $name) {
    echo "$name <br>";
  }
  echo "<br>";
  echo "Some LACRM employees in reverse alphabetical order: <br>";
  echo "<br>";
  rsort($employees);
  foreach ($employees as $name) {
    echo "$name <br>";
  }
?>