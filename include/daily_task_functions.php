<?php
  function insertTask($task, $userId, $goalId=NULL) {
    if ($_SESSION['userId'] == $_REQUEST['userId']) {
      db_Query("
      INSERT INTO daily_task_list (task, userId, goalId)
      VALUES (:task, :userId, :goalId)", 
      [
        'task' => $task,
        'userId' => $userId,
        'goalId' => $goalId
      ]
      );
    }
  }

  function insertRecurringTask($task, $userId, $day, $goalId=NULL) {
    if ($_SESSION['userId'] == $_REQUEST['userId']) {
      db_Query("
      INSERT INTO recurring_task_rule (task, userId, recur_day, goalId)
      VALUES (:task, :userId, :day, :goalId)", 
      [
        'task' => $task,
        'userId' => $userId,
        'day' => $day,
        'goalId' => $goalId
      ]
      );
    }
  }

  function insertRecurringToDaily() {
    $recurringTasks = db_Query("
    SELECT * 
    FROM recurring_task_rule") -> fetchAll();
    foreach ($recurringTasks as $task) {
      db_Query("
      INSERT INTO daily_task_list
      (userId, task, recurs, recur_day) 
      VALUES (:userId, :task, 1, :recur_day)",
      [
        'userId' => $task['userId'],
        'task' => $task['task'],
        'recur_day' => $task['recur_day']
      ]
      );
    }
  }

  function displayAllRecurring($day, $tasks, $userId) {
    foreach ($tasks as $task) {
      if (strpos($task['recur_day'], strval($day)) !== false) {
        echo"<li class = '$task[taskId]recur' style = 'list-style-type: none; padding-left: 40px; padding-right: 40px;'><label>
        <p >$task[task]</p>
        <p style = 'margin-left: auto'><button onclick = 'deleteRecurringTask($task[taskId], $userId)' class = 'delete', style = 'border: none'>x</button></p>
        </label></li>";
      }
    }
  }

  function displayRecurringForTable($allTasks, $selectedId, $userId) {
    $task = $allTasks[$selectedId];
    $completedStyle = '';
    $checked = '';
    return "<li id = '$task[taskId]recur'><label>
    <p style = '$completedStyle'>$task[task]</p>
    <p style = 'margin-left: auto'><button onclick = 'deleteRecurringTask($task[taskId], $userId)' class = 'delete', style = 'border: none'>x</button></p>
    </label></li>";
  }

  function updateTask($task_id, $dbName) {
    if (checkUser($task_id, $dbName)) {
      db_Query("
      UPDATE $dbName
      SET completed = NOT completed
      WHERE taskId = :task_id",
      [
        'task_id' => $task_id,
      ]
      );
      $currentTask = getTask($task_id);
      if ($currentTask['goalId'] != NULL) {
        addCompletionDay($currentTask['goalId']);
      }
    }
  }

  function deleteTask($task_id, $dbName) {
    if (checkUser($task_id, $dbName)) {
      db_Query("
      DELETE FROM $dbName
      WHERE taskId = :task_id",
      [
        'task_id' => $task_id,
      ]
      );
    }
  }

  function checkUser($taskId, $dbName) {
    $taskUserId = db_Query("
    SELECT userId
    FROM $dbName
    WHERE taskId = :task_id",
    [
      'task_id' => $taskId,
    ]
    ) -> fetch();
    if ($_SESSION['userId'] == $taskUserId['userId']) {
      return true;
    }
    else {
      return false;
    }
  }

  function getAllTasks($userId, $dbName) {
    return db_Query("
    SELECT * 
    FROM $dbName
    WHERE userId = :userId ", 
    [
      'userId' => $userId,
    ]
    ) -> fetchAll();    
  }

  function getTask($taskId) {
    return db_Query("
    SELECT * 
    FROM daily_task_list
    WHERE taskId = :taskId ", 
    [
      'taskId' => $taskId,
    ]
    ) -> fetch();  
  }

  function getGoal($goalId) {
    return db_Query("
    SELECT * 
    FROM goal
    WHERE goalId = :goalId ", 
    [
      'goalId' => $goalId,
    ]
    ) -> fetch();  
  }

  function displayAllTasks($tasks, $userId) {
    foreach ($tasks as $task){
      $completedStyle = '';
      $checked = '';
      if ($task['completed'] == 1) {
        $completedStyle = 'text-decoration: line-through';
        $checked = 'checked';
      }
      if (!is_null($task['recur_day']) ) {
        $today = date('w');
        if (strpos($task['recur_day'], $today) === false) {
          continue;
        }
      }
      echo "<li id = '$task[taskId]update'><label><input type='checkbox' onclick = 'updateTask($task[taskId], $userId)' $checked>
      <p style = '$completedStyle'>$task[task]</p>
      <p style = 'margin-left: auto'><button onclick = 'deleteTask($task[taskId], $userId)' class = 'delete', style = 'border: none'>x</button></p>
      </label></li>";
    }
  }

  function displayTodaysTasks($tasks, $userId) {
    foreach ($tasks as $task){
      $completedStyle = '';
      $checked = '';
      $recurStyle = 'none';
      $goalStyle = 'none';
      $goalBody = '';
      $daysBody = '';
      $today = date('w');
      $daysArray = ['Sunday, ', 'Monday, ', 'Tuesday, ', 'Wednesday, ', 'Thursday, ', 'Friday, ', 'Saturday, '];
      if ($task['completed'] == 1) {
        $completedStyle = 'text-decoration: line-through';
        $checked = 'checked';
      }
      if (!is_null($task['goalId'])) {
        $goalId = $task['goalId'];
        $goal = getGoal($goalId);
        $goalBody = $goal['goalBody'];
        $goalStyle = 'block';
      }
      if (!is_null($task['recur_day']) ) {
        if (strpos($task['recur_day'], $today) === false) {
          continue;
        }
        $recurStyle = 'block';
        $theseDays = str_split(preg_replace('/[,]+/', ' ', $task['recur_day']));
        foreach ($theseDays as $dayIndex) {
          $daysBody .= $daysArray[intval($dayIndex)];
        }
        $daysBody = substr($daysBody, 0, -2);
      }
      // echo "<tr id = '$task[taskId]update'><td><label style = 'justify-content: center'><input type='checkbox' style='z-index: -1' onclick = 'updateTask($task[taskId], $userId)' $checked></td>
      // <td><p style = '$completedStyle; padding: 15px 16px 15px 16px; color: #525257; font-weight: 500; font-size: medium'>$task[task]</p></td>
      // <td><p style = 'display: $recurStyle; text-align: center'>&#10003</p></td>
      // <td style = 'text-align: center'><div class = 'tooltip' style = 'text-align: center'><p style = 'display: $goalStyle; text-align: center' class = 'tooltip'>&#10024</p><span class = 'tooltiptext'>$goalBody</span></div></td>
      // <td><p style = 'text-align: center'><button onclick = 'deleteTask($task[taskId], $userId)' class = 'delete', style = 'border: none'>x</button></p></td>
      // </label></tr>";
      echo "<tr id = '$task[taskId]update'><td><label style = 'justify-content: center'><input type='checkbox' style='z-index: -1' onclick = 'updateTask($task[taskId], $userId)' $checked></td>
      <td><p style = '$completedStyle; padding: 15px 16px 15px 16px; color: #525257; font-weight: 500; font-size: medium'>$task[task]</p></td>
      <td style = 'text-align: center'><div class = 'tooltip' style = 'text-align: center'><p style = 'display: $recurStyle; text-align: center' class = 'tooltip'>&#10003</p><span class = 'tooltiptext'>$daysBody</span></div></td>
      <td style = 'text-align: center'><div class = 'tooltip' style = 'text-align: center'><p style = 'display: $goalStyle; text-align: center' class = 'tooltip'>&#10024</p><span class = 'tooltiptext'>$goalBody</span></div></td>
      <td><p style = 'text-align: center'><button onclick = 'deleteTask($task[taskId], $userId)' class = 'delete', style = 'border: none'>x</button></p></td>
      </label></tr>";
    }
  }

  function displayTask($allTasks, $selectedId, $userId) {
    $task = $allTasks[$selectedId];
    $completedStyle = '';
    $checked = '';
    $recurStyle = 'none';
    $goalStyle = 'none';
    $goalBody = '';
    $daysBody = '';
    $today = date('w');
    $daysArray = ['Sunday, ', 'Monday, ', 'Tuesday, ', 'Wednesday, ', 'Thursday, ', 'Friday, ', 'Saturday, '];
    if ($task['completed'] == 1) {
      $completedStyle = 'text-decoration: line-through';
      $checked = 'checked';
    }
    if (!is_null($task['goalId'])) {
      $goalId = $task['goalId'];
      $goal = getGoal($goalId);
      $goalBody = $goal['goalBody'];
      $goalStyle = 'block';
    }
    if (!is_null($task['recur_day']) ) {
      $recurStyle = 'block';
      $theseDays = str_split(preg_replace('/[,]+/', ' ', $task['recur_day']));
      foreach ($theseDays as $dayIndex) {
        $daysBody .= $daysArray[intval($dayIndex)];
      }
      $daysBody = substr($daysBody, 0, -2);
    }
    return "<tr id = '$task[taskId]update'><td><label style = 'justify-content: center'><input type='checkbox' style='z-index: -1' onclick = 'updateTask($task[taskId], $userId)' $checked></td>
    <td><p style = '$completedStyle; padding: 15px 16px 15px 16px; color: #525257; font-weight: 500; font-size: medium'>$task[task]</p></td>
    <td style = 'text-align: center'><div class = 'tooltip' style = 'text-align: center'><p style = 'display: $recurStyle; text-align: center' class = 'tooltip'>&#10003</p><span class = 'tooltiptext'>$daysBody</span></div></td>
    <td style = 'text-align: center'><div class = 'tooltip' style = 'text-align: center'><p style = 'display: $goalStyle; text-align: center' class = 'tooltip'>&#10024</p><span class = 'tooltiptext'>$goalBody</span></div></td>
    <td><p style = 'text-align: center'><button onclick = 'deleteTask($task[taskId], $userId)' class = 'delete', style = 'border: none'>x</button></p></td>
    </label></tr>";
  }

  function displayRecurringTask($allTasks, $selectedId, $userId) {
    $task = $allTasks[$selectedId];
    $completedStyle = '';
    $checked = '';
    return "<li style = 'list-style-type: none; padding-left: 40px; padding-right: 40px; font-size: medium' id = '$task[taskId]recur'><label>
    <p style = '$completedStyle'>$task[task]</p>
    <p style = 'margin-left: auto'><button onclick = 'deleteRecurringTask($task[taskId], $userId)' class = 'delete', style = 'border: none'>x</button></p>
    </label></li>";
  }

  function addGoal($goalBody, $userId, $timeNumber, $timeUnit) {
    $days = 0;
    $timeNumber = intval($timeNumber);
    if ($timeUnit == 'months'){
      $now = time();
      $future = date('Y-m-d', strtotime('+'.$timeNumber.' month'));
      $diff = strtotime($future) - $now;
      $days = round($diff / (60 * 60 * 24));
    }
    else if ($timeUnit == 'weeks') {
      $days = $timeNumber * 7;
    }
    else if ($timeUnit == 'days') {
      $days = $timeNumber;
    }
    if ($_SESSION['userId'] == $_REQUEST['userId']) {
      db_Query("
      INSERT INTO goal (goalBody, userId, daysneeded)
      VALUES (:goalBody, :userId, :daysNeeded)", 
      [
        'goalBody' => $goalBody,
        'userId' => $userId,
        'daysNeeded' => $days
      ]
      );
    }
  }

  function returnLastGoalId() {
    $last = db_Query("
    SELECT * FROM goal ORDER BY goalId DESC LIMIT 0, 1"
    ) -> fetch();
    $lastGoalId = $last['goalId'];
    return $lastGoalId;
  }

  function displayGoal($userId) {
    $selectedId = returnLastGoalId();
    $goal = db_Query("
    SELECT * FROM goal WHERE goalId = :selectedId", 
    [
      'selectedId' => $selectedId,
    ]
    ) -> fetch();
    $fraction = ($goal['daysCompleted']/$goal['daysNeeded']) * 100;
    $relatedTasks = db_Query("
    SELECT * FROM recurring_task_rule WHERE goalId = :selectedId", 
    [
      'selectedId' => $selectedId,
    ]
    ) -> fetchAll();
    $display = "<div class = 'goalbox' style= 'padding: 20px; margin: 0px'><li style = 'list-style-type: none; width: 100%' id = '$goal[goalId]goal'>
    <h2 style = 'margin-top: 0px; margin-bottom: 0px'>$goal[goalBody]</h2><p>$goal[daysCompleted]/$goal[daysNeeded] days</p><div class = 'progressborder'><div class = 'progressmeter' style = 'width: $fraction%'></div></div>";
    foreach ($relatedTasks as $task) {
      $display .= "
      <p style = 'text-align: left'>$task[task]</p>
      ";
    }
    $display .= "</li>";
    echo($display);
  }

  function displayAllGoals($allGoals, $userId) {
    foreach ($allGoals as $goal) {
      $goalId = $goal['goalId'];
      $fraction = ($goal['daysCompleted']/$goal['daysNeeded']) * 100;
      $relatedTasks = db_Query("
      SELECT * FROM recurring_task_rule WHERE goalId = :goalId", 
      [
        'goalId' => $goalId,
      ]
      ) -> fetchAll();
      $display = "<div class = 'goalbox' style= 'padding: 20px; margin: 0px'><li style = 'list-style-type: none; width: 100%' id = '$goal[goalId]goal'>
      <h2 style = 'margin-top: 0px; margin-bottom: 0px'>$goal[goalBody]</h2><p>$goal[daysCompleted]/$goal[daysNeeded] days</p><div class = 'progressborder'><div class = 'progressmeter' style = 'width: $fraction%'></div></div>";
      foreach ($relatedTasks as $task) {
        $display .= "
        <p style = 'text-align: left'>$task[task]</p>
        ";
      }
      $display .= "</li></div>";
      echo ($display);
    }
  }

  function addCompletionDay($goalId) {
    $today = date('w');
    $completed = 0;
    $todaySteps = db_Query("
    SELECT * 
    FROM daily_task_list
    WHERE goalId = $goalId and recur_day = $today
    ") -> fetchAll();
    foreach ($todaySteps as $step) {
      if ($step['completed'] == 1) {
        $completed++;
      }
    }
    if ($completed == 3) {
      db_Query("
      UPDATE goal
      SET daysCompleted = daysCompleted + 1
      WHERE goalId = $goalId
      ");
    }
  }

  function displayDayTask($day) {
    $dayRecurring = db_Query("
    SELECT * 
    FROM daily_task_list
    WHERE goalId = $goalId and recur_day = $today
    ") -> fetchAll();
  }

