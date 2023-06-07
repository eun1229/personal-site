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

  function verifyTaskInput($errors) {
    if (isset($_REQUEST['entered'])) {
      if ($_REQUEST['task'] == '') {
        global $errors;
        $errors['comment'] = "please enter a task before submitting";
      }
      if (sizeof($errors) === 0) {
        insertTask($_REQUEST['task']);
        header('location: ? userId = $_REQUEST[userId]');
      }
    }
  }

  function emptyTaskMessage($errors) {
    if (isset($errors['comment'])) {
      echo "
        $errors[comment]<br>
      ";
    }
  }