<?php
  include_once('include/init.php');
  $errors = [];
  verifyTaskInput($errors);
  $tasks = getAllTasks(1);
?>

<html>
  <head>
    <link rel='stylesheet' href='daily_style.css'/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <title>Daily Tasks</title>
  </head>
  <body>
    <div class = todosection>
      <div class = todoheader><h2>today's to-do</h2></div>
      <div class = todolist>
        <ul>
          <?php
          foreach ($tasks as $task){
            echo "<li><input type='checkbox'><label>$task[task]</label></li>";
          }
          ?>
        </ul>
      </div>
      <div class = todoform>
        <form action = '' method = 'POST' style = 'margin: 0'>
        <label for = 'task'>enter a task:</label>
        <input id = 'task' type = 'text' name = 'task'><br>
        <?php emptyTaskMessage($errors) ?>
        <input type='submit' name='entered' value = 'enter'>
      </div>      
    </div>
  </body>
</html>
