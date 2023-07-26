<?php
  include_once('include/init.php');
  $thisUser = verifyLogin();
  $userId = $thisUser['userId'];
  $lastAdded = $thisUser['lastAdded'];
  if (isset($_REQUEST['logout'])) {
    session_destroy();
    header('location:index.php');
    exit;
  }
  $tasks = getAllTasks($userId, "daily_task_list"); 
  $recurringTasks = getAllTasks($userId, "recurring_task_rule");
  if ($lastAdded != date('W')) {
      insertRecurringToDaily();
      updateLast($userId, date('W'));
  }
?>

<html>
  <head>
    <link rel="stylesheet" href="daily_style.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <title>Daily Tasks</title>
    <script src="daily_tasks.js"></script>
  </head>
  <body>
    <div id = "navbar" class = "navbar">
      <form action="" method="post" class = "logoutform">
        <input type="submit" value = "logout" name="logout"/>
      </form>
    </div>
    <div id = "main" class = "main">
      <div class = "mainsections">
        <div class = "todosection">
          <div class = "todoheader"><h2>today's to-do</h2></div>
          <div class = "todolist">
            <ul id = "todolist">
              <?php
                displayAllTasks($tasks, $userId);
              ?>
            </ul>
          </div>
          <div class = "todoform">
            <form id = "todoform" action = "" method = "POST" style = "margin: 0" onsubmit = "insertTask(event, <?php echo $userId;?>, true)">
            <label for = "task">enter a task:</label>
            <input id = "task" type = "text" name = "task"><br>
            <div class = "recurform">
              <input type="checkbox" name = "recuroption" id = "recuroption" style = "margin-left: 0px" onclick = "showRecurOptions()">
              <label for = "recuroption">this is a recurring task</label>
                <p id = "recurlabel" style = "display:none; text-align: right">every:</p>
                <ul id = "recurday" style = "display:none; padding-left: 10px">
                  <label for="sunday"><input type = "checkbox" name = "recurday" value = "0" id = "sunday">Sunday</label><br>
                  <label for="monday"><input type = "checkbox" name = "recurday" value = "1" id = "monday">Monday</label><br>
                  <label for="tuesday"><input type = "checkbox" name = "recurday" value = "2" id = "tuesday">Tuesday</label><br>
                  <label for="wednesday"><input type = "checkbox" name = "recurday" value = "3" id = "wednesday">Wednesday</label><br>
                  <label for="thursday"><input type = "checkbox" name = "recurday" value = "4" id = "thursday">Thursday</label><br>
                  <label for="friday"><input type = "checkbox" name = "recurday" value = "5" id = "friday">Friday</label><br>
                  <label for="sunday"><input type = "checkbox" name = "recurday" value = "6" id = "saturday">Saturday</label><br>
                </ul>
              <p id = "emptytaskmessage" class = "emptymessage">please enter a task before submitting</p>
              <input type="submit" name="entered" value = "enter">
              </form>
            </div>  
          </div>
          <div class = "viewrecurring">
            <input type = "checkbox" id = "showAllRecurring" onclick = "showAllRecurringTasks()">view and edit recurring tasks</input>
            <ul class = "listrecurring" id = "listrecurring" style = "display:none">
              <?php
                displayAllRecurring($recurringTasks, $userId);
              ?>
            </ul>
          </div>
        </div>
        <div class='gptform'>
          <h2><center>generate steps to achieve a goal</center></h2>
          <p style='margin-left: 10%; margin-right: 10%'>enter a goal you would like to achieve in the box below</p>
          <form id='goalform' action='' method='POST' onsubmit='generateTaskFromInput(event)' class='todoform'>
            <input id = 'goal' type = "text" name = 'goal'>
            <input type = 'submit' name='goalentered' value='enter'>
          </form>
          <form id = 'generated' action='' method='POST' onsubmit='insertTask(event, <?php echo $userId;?>, false)'>
            <p id='generatedTask0'><input type = 'hidden' name = 'taskbody0'></p>
            <p id='generatedTask1'><input type = 'hidden' name = 'taskbody1'></p>
            <p id='generatedTask2'><input type = 'hidden' name = 'taskbody2'></p>
            <input type = 'submit' class='generatedbutton' id='generatedbutton' name='generatedentered' value='add to daily list'>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
