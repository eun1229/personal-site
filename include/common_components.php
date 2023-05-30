<?php
  function echoHeader($pageTitle) {
    echo "
    <html>
    <head>
      <link rel='stylesheet' href='style.css'/>
      <link rel='preconnect' href='https://fonts.googleapis.com'>
      <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
      <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap' rel='stylesheet'>
      <meta name='viewport' content='width=device-width'>
      <style>
      </style>
      <title>$pageTitle</title>
    </head>
    ";
  }

  function echoFooter() {
    echo "
        </body>
      </html>
    ";
  }

  function echoPost($postInfo, $title, $body) {
    echo "
    <div class='blogparent'>
      <h1 class='blogtitle'>
        $postInfo[$title]
      </h1>
      <p class='blogcontents'>
        $postInfo[$body]
      </p>
      <p style='text-align: center'>
        <a href='index.php'>back home</a>
      </p>
    </div>
    ";
  }

  function echoBox($hRefFile, $h2, $p) {
    echo "
    <div class='individualboxes'>
      <h2>$h2</h2>
      <p>$p</p>
      <div class='text-center'>
        <button><a href=$hRefFile>learn more</a></button>
      </div>
    </div>
    ";
  }

  function echoCommentsInput($errors, $comment) {
    echo "
    <div class='comments'>
      <h2>leave a comment</h2>
    ";

    if(isset($errors[$comment])){
      echo "
        <div style='color:red; font-weight: bold;'>
          $errors[$comment]
        </div>
      ";
    }

    echo "
      <form action = '' method = 'POST'>
      <p>Name:<br></p>
      <input type='text' name='name' style = 'width: 100%; background-color: #d9d9d9c2; border: none'>
      <p>Comment:<br></p>
      <textarea name='body' style = 'width: 100%; height: 5%; background-color: #d9d9d9c2; border: none'></textarea><br>
      <div style='margin-top: 2%; margin-bottom: 2%;'><input type='submit' name='isSubmitted' class='submitbutton'><br></div>
      </form>
    </div>
    ";
  }


