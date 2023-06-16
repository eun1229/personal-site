<?php
  include('include/init.php');
    insertTask($_REQUEST['taskbody']);
    $tasks = getAllTasks($_REQUEST['userId']);
    $last_inserted =  count($tasks) - 1;
    displayTask($tasks, $last_inserted);
?>