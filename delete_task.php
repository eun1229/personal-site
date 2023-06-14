<?php
  include('include/init.php');
  db_Query("
  DELETE FROM daily_task_list
  WHERE taskId = :task_id",
  [
    'task_id' => $_REQUEST['taskId']
  ]
  );
  $tasks = getAllTasks($_REQUEST['userId']);
  displayAllTasks($tasks);