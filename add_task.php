<?php
  include('include/init.php');
  if ($_SESSION['userId'] == $_REQUEST['userId']){
    insertTask($_REQUEST['taskbody'], $_REQUEST['userId']);
    $tasks = getAllTasks($_REQUEST['userId']);
    $last_inserted =  count($tasks) - 1;
    displayTask($tasks, $last_inserted, $_REQUEST['userId']);
  }
?>