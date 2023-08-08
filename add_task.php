<?php
  include('include/init.php');
  class addedTask {
    public $currentDay;
    public $recurringBody;
    public $nonRecurringBody;
    public $lastGoalId;

    function setCurrentDay($currentDay) {
      $this->currentDay = $currentDay;
    }

    function setLastGoalId($lastGoalId) {
      $this->lastGoalId = $lastGoalId;
    }

    function setRecurringBody($lastGoalId) {
      if ($_REQUEST['manual'] == 'true' and $_REQUEST['recurs'] == 'true') {
        insertRecurringTask($_REQUEST['taskbody'], $_REQUEST['userId'], $_REQUEST['days']);
        $recurringTasks = getAllTasks($_REQUEST['userId'], 'recurring_task_rule');
        $last_inserted =  count($recurringTasks) - 1;
        $this->recurringBody = displayRecurringTask($recurringTasks, $last_inserted, $_REQUEST['userId']);
      }
      else if ($_REQUEST['manual'] == 'false') {
        insertRecurringTask($_REQUEST['taskbody'], $_REQUEST['userId'], '0,1,2,3,4,5,6', $lastGoalId);
        $recurringTasks = getAllTasks($_REQUEST['userId'], 'recurring_task_rule');
        $last_inserted =  count($recurringTasks) - 1;
        $this->recurringBody = displayRecurringTask($recurringTasks, $last_inserted, $_REQUEST['userId']);
      }
      else if ($_REQUEST['manual'] == 'true' and $_REQUEST['recurs'] == 'false') {
        $this->recurringBody = "none";
      }
    }

    function setNonRecurringBody($lastGoalId) {
      if ($_REQUEST['manual'] == 'true' and $_REQUEST['recurs'] == 'true') {
        $dayNoComma = str_split(str_replace(',', '', $_REQUEST['days']));
        foreach ($dayNoComma as $number) {
          if (intval($number) >= date('w')) {
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
          if (intval($number) == date('w')) {
            $tasks2 = getAllTasks($_REQUEST['userId'], 'daily_task_list');
            $last_inserted2 =  count($tasks2) - 1;
            $this->nonRecurringBody = displayTask($tasks2, $last_inserted2, $_REQUEST['userId']);
          }
        }
      }
      else if ($_REQUEST['manual'] == 'false') {
        $days = str_split('0123456');
        foreach ($days as $number) {
          if (intval($number) >= date('w')) {
            db_Query("
            INSERT INTO daily_task_list (task, userId, recur_day, recurs, goalId)
            VALUES (:task, :userId, :day, 1, :goalId)", 
            [
              'task' => $_REQUEST['taskbody'],
              'userId' => $_REQUEST['userId'],
              'day' => $number,
              'goalId' => $lastGoalId
            ]
            );
          }
          if (intval($number) == date('w')) {
            $tasks2 = getAllTasks($_REQUEST['userId'], 'daily_task_list');
            $last_inserted2 =  count($tasks2) - 1;
            $this->nonRecurringBody = displayTask($tasks2, $last_inserted2, $_REQUEST['userId']);
          }
        }
      }
      else if ($_REQUEST['manual'] == 'true' and $_REQUEST['recurs'] == 'false') {
        insertTask($_REQUEST['taskbody'], $_REQUEST['userId']);
        $tasks = getAllTasks($_REQUEST['userId'], 'daily_task_list');
        $last_inserted =  count($tasks) - 1;
        $this->nonRecurringBody = displayTask($tasks, $last_inserted, $_REQUEST['userId']);
      }
    }
  }

  if ($_SESSION['userId'] == $_REQUEST['userId']) {
    $thisTask = new addedTask;
    if ($_REQUEST['manual'] == 'true') {
      $lastGoalId = NULL;
      $thisTask->setLastGoalId($lastGoalId);
    }
    else if ($_REQUEST['manual'] == 'false') {
      $lastGoalId = returnLastGoalId();
      $thisTask->setLastGoalId($lastGoalId);
    }
    $thisTask->setCurrentDay(date('w'));
    $thisTask->setRecurringBody($lastGoalId);
    $thisTask->setNonRecurringBody($lastGoalId);
    echo(json_encode($thisTask));
  }

  if ($_SESSION['userId'] == $_REQUEST['userId']) {
    $thisTask = new addedTask;
    $thisTask->setCurrentDay(date('w'));
    $thisTask->setRecurringBody();
    $thisTask->setNonRecurringBody();
    echo(json_encode($thisTask));
  }





  // $values = [];
  // $today = date('w');
  // $values[0] = $today;
  // if ($_SESSION['userId'] == $_REQUEST['userId']){
  //   if ($_REQUEST['recurs'] == 'true') {
  //     $dayNoComma = str_split(str_replace(',', '', $_REQUEST['days']));
  //     foreach ($dayNoComma as $number) {
  //       if (intval($number) >= $today) {
  //         db_Query("
  //         INSERT INTO daily_task_list (task, userId, recur_day, recurs)
  //         VALUES (:task, :userId, :day, 1)", 
  //         [
  //           'task' => $_REQUEST['taskbody'],
  //           'userId' => $_REQUEST['userId'],
  //           'day' => $number
  //         ]
  //         );
  //       }
  //       if (intval($number) == $today) {
  //         $tasks2 = getAllTasks($_REQUEST['userId'], 'daily_task_list');
  //         $last_inserted2 =  count($tasks2) - 1;
  //         $values[2] = displayTask($tasks2, $last_inserted2, $_REQUEST['userId']);
  //       }
  //     }
  //     insertRecurringTask($_REQUEST['taskbody'], $_REQUEST['userId'], $_REQUEST['days']);
  //     $recurringTasks = getAllTasks($_REQUEST['userId'], 'recurring_task_rule');
  //     $last_inserted =  count($recurringTasks) - 1;
  //     $values[1] = displayRecurringTask($recurringTasks, $last_inserted, $_REQUEST['userId']);
  //   }
  //   else {
  //     insertTask($_REQUEST['taskbody'], $_REQUEST['userId']);
  //     $tasks = getAllTasks($_REQUEST['userId'], 'daily_task_list');
  //     $last_inserted =  count($tasks) - 1;
  //     $values[1] = "none";
  //     $values[2] = displayTask($tasks, $last_inserted, $_REQUEST['userId']);
  //   }
  // }
  // echo(json_encode($values));
?>