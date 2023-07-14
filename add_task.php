<?php
  include('include/init.php');
  $values = [];
  $today = date('w');
  $values[0] = $today;
  if ($_SESSION['userId'] == $_REQUEST['userId']){
    if ($_REQUEST['manual'] == 'true' and $_REQUEST['recurs'] == 'true') {
      $dayNoComma = str_split(str_replace(',', '', $_REQUEST['days']));
      foreach ($dayNoComma as $number) {
        if (intval($number) >= $today) {
          db_Query("
          INSERT INTO daily_task_list (task, userId, recur_day, recurs)
          VALUES (:task, :userId, :day, 1)", 
          [
            'task' => $_REQUEST['taskbody'],
            'userId' => $_REQUEST['userId'],
            'day' => $number
          ]
          );
        }
        if (intval($number) == $today) {
          $tasks2 = getAllTasks($_REQUEST['userId'], 'daily_task_list');
          $last_inserted2 =  count($tasks2) - 1;
          $values[2] = displayTask($tasks2, $last_inserted2, $_REQUEST['userId']);
        }
      }
      insertRecurringTask($_REQUEST['taskbody'], $_REQUEST['userId'], $_REQUEST['days']);
      $recurringTasks = getAllTasks($_REQUEST['userId'], 'recurring_task_rule');
      $last_inserted =  count($recurringTasks) - 1;
      $values[1] = displayRecurringTask($recurringTasks, $last_inserted, $_REQUEST['userId']);
    }
    else if ($_REQUEST['manual'] == 'false') {
      $days = str_split('0123456');
      foreach ($days as $number) {
        if (intval($number) >= $today) {
          db_Query("
          INSERT INTO daily_task_list (task, userId, recur_day, recurs)
          VALUES (:task, :userId, :day, 1)", 
          [
            'task' => $_REQUEST['taskbody'],
            'userId' => $_REQUEST['userId'],
            'day' => $number
          ]
          );
        }
        if (intval($number) == $today) {
          $tasks2 = getAllTasks($_REQUEST['userId'], 'daily_task_list');
          $last_inserted2 =  count($tasks2) - 1;
          $values[2] = displayTask($tasks2, $last_inserted2, $_REQUEST['userId']);
        }
      }
      insertRecurringTask($_REQUEST['taskbody'], $_REQUEST['userId'], '0,1,2,3,4,5,6');
      $recurringTasks = getAllTasks($_REQUEST['userId'], 'recurring_task_rule');
      $last_inserted =  count($recurringTasks) - 1;
      $values[1] = displayRecurringTask($recurringTasks, $last_inserted, $_REQUEST['userId']);
    }
    else if ($_REQUEST['manual'] == 'true' and $_REQUEST['recurs'] == 'false') {
      insertTask($_REQUEST['taskbody'], $_REQUEST['userId']);
      $tasks = getAllTasks($_REQUEST['userId'], 'daily_task_list');
      $last_inserted =  count($tasks) - 1;
      $values[1] = "this";
      $values[2] = displayTask($tasks, $last_inserted, $_REQUEST['userId']);
    }
  }
  echo(json_encode($values));
?>