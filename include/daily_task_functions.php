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
      echo "<li><label><input type='checkbox' onclick = 'updateTask($task[taskId], 1)' $checked>
      <p style = '$completedStyle'>$task[task]</p>
      <p style = 'margin-left: auto'><a href='javascript:void(0)' onclick = 'deleteTask($task[taskId], 1)'>x</a></p>
      </label></li>";
    }
  }