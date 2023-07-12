<?php
  include('include/init.php');
  echo $_REQUEST['recurringTaskId']."recur";
  deleteTask($_REQUEST['recurringTaskId'], 'recurring_task_rule');