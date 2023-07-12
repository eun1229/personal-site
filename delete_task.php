<?php
  include('include/init.php');
  echo $_REQUEST['taskId']."update";
  deleteTask($_REQUEST['taskId'], 'daily_task_list');