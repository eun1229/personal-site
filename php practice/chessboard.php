<html>
  <head>
    <link rel="stylesheet" href='chessboard.css'/>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <h1>THIS IS MY CHESSBOARD</h1>
      </div>
      <?php
        $xposition = 0;
        $yposition = 0;  
          echo "<div class='chessboard'>";
          for ($row = 0; $row < 8; $row++) {
            for ($column = 0; $column < 8; $column++) {
              $count = $row + $column;
              if ($count%2==0) {
                echo "<div class= 'blacksquare' style = 'left: $xposition; top: $yposition;'></div>";
              }
              else {
                echo "<div class= 'whitesquare' style = 'left: $xposition; top: $yposition;'></div>";  
              }
              $xposition = $xposition + 50;
            }
            $yposition = $yposition + 50;
            $xposition = 0;
          }
          echo "</div>";
          echo "</div>";   
      ?>
    </div>
  </body>
</html>
