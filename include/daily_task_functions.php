<?php
  function insertTask($task, $userId) {
    if ($_SESSION['userId'] == $_REQUEST['userId']) {
      db_Query("
      INSERT INTO daily_task_list (task, userId)
      VALUES (:task, :userId)", 
      [
        'task' => $task,
        'userId' => $userId
      ]
      );
    }
  }

  function insertRecurringTask($task, $userId, $day) {
    if ($_SESSION['userId'] == $_REQUEST['userId']) {
      db_Query("
      INSERT INTO recurring_task_rule (task, userId, recur_day)
      VALUES (:task, :userId, :day)", 
      [
        'task' => $task,
        'userId' => $userId,
        'day' => $day
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

  function displayAllRecurring($tasks, $userId) {
    foreach ($tasks as $task) {
      echo"<li id = '$task[taskId]recur' style = 'list-style-type: none'><label>
      <p >$task[task]</p>
      <p style = 'margin-left: auto'><button onclick = 'deleteRecurringTask($task[taskId], $userId)' class = 'delete', style = 'border: none'>x</button></p>
      </label></li>";
    }
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

  function displayTask($allTasks, $selectedId, $userId) {
    $task = $allTasks[$selectedId];
    $completedStyle = '';
    $checked = '';
    if ($task['completed'] == 1) {
      $completedStyle = 'text-decoration: line-through';
      $checked = 'checked';
    }
    return "<li id = '$task[taskId]update'><label><input type='checkbox' onclick = 'updateTask($task[taskId], $userId)' $checked>
    <p style = '$completedStyle'>$task[task]</p>
    <p style = 'margin-left: auto'><button onclick = 'deleteTask($task[taskId], $userId)' class = 'delete', style = 'border: none'>x</button></p>
    </label></li>";
  }

  function displayRecurringTask($allTasks, $selectedId, $userId) {
    $task = $allTasks[$selectedId];
    $completedStyle = '';
    $checked = '';
    return "<li id = '$task[taskId]recur'><label>
    <p style = '$completedStyle'>$task[task]</p>
    <p style = 'margin-left: auto'><button onclick = 'deleteRecurringTask($task[taskId], $userId)' class = 'delete', style = 'border: none'>x</button></p>
    </label></li>";
  }

  function displayRecurringTask($allTasks, $selectedId, $userId) {
    $task = $allTasks[$selectedId];
    $completedStyle = '';
    $checked = '';
    return "<li id = '$task[taskId]recur'><label>
    <p style = '$completedStyle'>$task[task]</p>
    <p style = 'margin-left: auto'><button onclick = 'deleteRecurringTask($task[taskId], $userId)' class = 'closenav', style = 'border: none'>x</button></p>
    </label></li>";
  }