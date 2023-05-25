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
      <body>
        <div class='homesection' id='home'>
            <ul>
              <li><p class='navbarbuttons'><a href='#home'>Home</a></p></li>
              <li><p class='navbarbuttons'>News</p></li>
              <li><p class='navbarbuttons'><a href='#contact'>Contact</a></p></li>
              <li><p class='navbarbuttons'>About</p></li>
            </ul>
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
