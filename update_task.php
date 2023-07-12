<?php
  include('include/init.php');
  updateTask($_REQUEST['taskId'], 'daily_task_list');
  
  $tasks = getAllTasks($_REQUEST['userId']);
  $ids = array_column($tasks, 'taskId');
  $last_updated = array_search($_REQUEST['taskId'], $ids);
  displayTask($tasks, $last_updated, $_REQUEST['userId']);