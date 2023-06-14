<?php
  include('include/init.php');
  db_Query("
  UPDATE daily_task_list 
  SET completed = 1
  WHERE taskId = :task_id",
  [
    'task_id' => $_REQUEST['taskId']
  ]
  );
  $tasks = getAllTasks($_REQUEST['userId']);
  displayAllTasks($tasks);
  