<?php
  include_once('include/init.php');
  $thisUser = verifyLogin();
  $userId = $thisUser['userId'];
  if (isset($_REQUEST['logout'])) {
    session_destroy();
    header('location:index.php');
    exit;
  }
  $tasks = getAllTasks($userId); 
?>

<html>
  <head>
    <link rel="stylesheet" href="daily_style.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <title>Daily Tasks</title>
    <script src="daily_tasks.js"></script>
  </head>
  <body>
    <div id = "navbar" class = "navbar">
      <button class="closenav" onclick = "closeNav('navbar')">x</button>
      <form action="" method="post" class = "logoutform">
        <input type="submit" value = "logout" name="logout"/>
      </form>
    </div>
    <div id = "main" class = "main">
      <button id = "openbutton" class = "opennav" onclick = "openNav('navbar')">&#9776</button>
      <div class = "todosection">
        <div class = "todoheader"><h2>today's to-do</h2></div>
        <div class = "todolist">
          <ul id = "todolist">
            <?php
              displayAllTasks($tasks, $userId);
            ?>
          </ul>
        </div>
        <div class = "todoform">
          <form id = "todoform" action = "" method = "POST" style = "margin: 0" onsubmit = "insertTask(event, <?php echo $userId;?>)">
          <label for = "task">enter a task:</label>
          <input id = "task" type = "text" name = "task"><br>
          <p id = "emptytaskmessage" class = "emptymessage">please enter a task before submitting</p>
          <input type="submit" name="entered" value = "enter">
        </div>      
      </div>
    </div>
  </body>
</html>
