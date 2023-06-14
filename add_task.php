<?php
  include('include/init.php');
    db_Query("
    INSERT INTO daily_task_list (task, userId)
    VALUES (:task, 1)", 
    [
      'task' => $_REQUEST['taskbody']
    ]
    );
    $tasks = getAllTasks($_REQUEST['userId']);
    displayAllTasks($tasks);
?>