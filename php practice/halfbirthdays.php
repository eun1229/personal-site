<html>
  <head>
    <link rel="stylesheet" href='halfbirthdays.css'/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sniglet:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <meta name="viewport" content="width=device-width">
  </head>
  <style>
    .material-symbols-outlined {
      color: #784300;
      font-variation-settings:
      'FILL' 0,
      'wght' 600,
      'GRAD' 0,
      'opsz' 48
    }
  </style>
  <body>
    <div class="container">
      <div class="title">
        <h1>HALF BIRTHDAYS!<h1>
      </div>
      <div class="birthdays">
        <?php
        $fellows = array("Grace" => "December 29", "Mythri" => "April 20", "Savi" => "November 15", "Shangwe" => "January 14");

        function daysCalculator ($birthday) {
          $birthday = strtotime("$birthday 1970");
          // $year = date("Y", $birthday);
          $startOfYear = strtotime("January 1, 1970");
          $difference = $birthday - $startOfYear;
          $daysBetween = round($difference / (60 * 60 * 24));
          return $daysBetween;
        }

        function halfBirthdayCalculator($days) {
          $halfDistance = ($days + 183) % 365;
          $timestamp = $halfDistance * 60 * 60 * 24;
          return gmdate("M, d", $timestamp);
        }

        foreach($fellows as $name=>$birthday) {
          $daysBetween = daysCalculator($birthday);
          $halfBirthday = halfBirthdayCalculator($daysBetween);
          echo "<div class='birthdayrow'>";
          echo "<span class='material-symbols-outlined'>cake</span>";
          echo "<h3>$name's half-birthday is $halfBirthday</h3>";
          echo "<span class='material-symbols-outlined'>cake</span>";
          echo "</div>";
          echo "<br>";          
        }
        ?>
      </div>
    </div>
  </body>
</html>