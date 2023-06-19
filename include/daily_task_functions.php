<?php
  function insertTask($task) {
    db_Query("
    INSERT INTO daily_task_list (task, userId)
    VALUES (:task, 1)", 
    [
      'task' => $task
    ]
    );
  }

  function updateTask($task_id) {
    db_Query("
    UPDATE daily_task_list 
    SET completed = 1
    WHERE taskId = :task_id",
    [
      'task_id' => $task_id
    ]
    );
  }

  function deleteTask($task_id) {
    db_Query("
    DELETE FROM daily_task_list
    WHERE taskId = :task_id",
    [
      'task_id' => $task_id
    ]
    );
  }

  function getAllTasks($userId) {
    return db_Query("
    SELECT * 
    FROM daily_task_list
    WHERE userId = :userId ", 
    [
      'userId' => $userId
    ]
    ) -> fetchAll();    
  }

  function displayAllTasks($tasks) {
    foreach ($tasks as $task){
      $completedStyle = '';
      $checked = '';
      if ($task['completed'] == 1) {
        $completedStyle = 'text-decoration: line-through';
        $checked = 'checked';
      }
      echo "<li id = '$task[taskId]update'><label><input type='checkbox' onclick = 'updateTask($task[taskId], 1)' $checked>
      <p style = '$completedStyle'>$task[task]</p>
      <p style = 'margin-left: auto'><button onclick = 'deleteTask($task[taskId], 1)', class = 'closenav', style = 'border: none'>x</button></p>
      </label></li>";
    }
  }

  function displayTask($allTasks, $selectedId) {
    $task = $allTasks[$selectedId];
    $completedStyle = '';
    $checked = '';
    if ($task['completed'] == 1) {
      $completedStyle = 'text-decoration: line-through';
      $checked = 'checked';
    }
    echo "<li id = '$task[taskId]update'><label><input type='checkbox' onclick = 'updateTask($task[taskId], 1)' $checked>
    <p style = '$completedStyle'>$task[task]</p>
    <p style = 'margin-left: auto'><button onclick = 'deleteTask($task[taskId], 1)', class = 'closenav', style = 'border: none'>x</button></p>
    </label></li>";
  }