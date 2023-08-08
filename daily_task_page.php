<?php
  include_once('include/init.php');
  $thisUser = verifyLogin();
  $userId = $thisUser['userId'];
  $lastAdded = $thisUser['lastAdded'];
  $name = $thisUser['firstName'];
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
  $allGoals = getAllTasks($userId, "goal");
?>

<html>
  <head>
    <link rel="stylesheet" href="daily_style.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Borel:wght@400;500&family=Inter:wght@300;400;500&family=Mulish:wght@300;400;500;600;700&family=David+Libre&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Daily Tasks</title>
    <script src="daily_tasks.js"></script>
    <nav style='height:85px; align-items: center; z-index: 1000'>
      <div style='margin-top: 10px; margin-bottom: 10px; padding-left: 30px; padding-right: 30px; background-color: #FFFFFF; height: 45px; font-size: larger'>List</div>
      <div class = 'userbox'>
        <div style='line-height: 1; margin: 0px 0px 0px 0px'>Welcome, <?php echo($name)?></div>
        <div style='line-height: 1; margin: 0px 0px 0px 0px'>
          <form action="" method="post" class = "logoutform">
            <input type="submit" value = "sign out" name="logout" class = "signout"/>
          </form>
        </div>
      </div>
    </nav>
  </head>
  <body style = 'margin: 0px 0px 0px 0px; oveflow: hidden; height: 100vh'>
  <div class = 'wrapper'>
      <aside>
        <ul>
          <li id = 'todaystasknav'class='navtab'><div style = "display: flex; align-items: center; height: 100%"><span class="material-symbols-outlined" style = 'color: #2B3E7E; margin-right: 5px'>star</span>
          <a href = "#main" onclick = "showtaskspage()">
              Today's tasks
            </a></div>
          </li>
          <li id = 'recurringtasknav'class='navtab' style = 'background-color: transparent; border: none'><div style = "display: flex; align-items: center; height: 100%"><span class="material-symbols-outlined" style = 'color: #2B3E7E; margin-right: 5px'>
            autorenew
          </span><a href = "#main" onclick = "showrecurringpage()">
            Manage recurring tasks
            </a></div>
          </li>
          <li id = 'generategoalnav' class='navtab' style = 'background-color: transparent; border: none'><div style = "display: flex; align-items: center; height: 100%"><span class="material-symbols-outlined" style = 'color: #2B3E7E; margin-right: 5px'>potted_plant</span>
            <a href = "#main" onclick = "showgenerategoalpage()">
            Generate goal
            </a></div>
          </li>
          <li id = 'currentgoalnav' class='navtab' style = 'background-color: transparent; border: none'><div style = "display: flex; align-items: center; height: 100%"><span class="material-symbols-outlined" style = 'color: #2B3E7E; margin-right: 5px'>rocket_launch</span>
          <a href = "#main" onclick = "showcurrentgoalpage()">
            View current goals
            </a></div>
          </li>
        </ul>
      </aside>
    <div id = "main" class = "main">
      <div id = "todaystaskspage">
        <div>
          <h1 class="todolistfinal">Today's to-do list</h1>
        </div>
        <table style="width: 100%; border-collapse: collapse;">
          <thead style="width: 100%; text-align: left; color: #6C6C72">
            <tr style = "background-color: #FBFAFA;">
              <th style="padding: 10px 16px 10px 16px">Completed</th>
              <th style="text-align: left">Task</th>
              <th style="padding: 10px 16px 10px 16px">Recurs</th>
              <th style="padding: 10px 16px 10px 16px">Goal</th>
              <th style="padding: 10px 16px 10px 16px">Delete</th>          
            </tr>
          </thead>
          <tbody id = 'todotable'>
            <?php
              displayTodaysTasks($tasks, $userId);
            ?>
          </tbody>
        </table>
        <div class = "todoform">
              <form id = "todoform" action = "" method = "POST" class = "todoformrow" onsubmit = "insertTask(event, <?php echo $userId;?>, true)">
              <div style="display: flex; width: 100%"><input class = 'addbutton' type="submit" name="entered" value = "+"><input id = "task" type = "text" name = "task" class = "entertasktext" placeholder="add a new task">
                <div class="checkbox-wrapper-2" style="display: flex; align-items: center"><input type="checkbox" name = "recuroption" id = "recuroption" class="sc-gJwTLC ikxBAC" style = "margin: 5px" onclick = "showRecurOptions()"></div>
                <label for = "recuroption" style= "color: #6c6c72">this is a recurring task</label>
                  <ul id = "recurday" style = "display:none; padding-left: 10px">
                    <label for="sunday"><input type = "checkbox" name = "recurday" value = "0" id = "sunday">Sunday</label><br>
                    <label for="monday"><input type = "checkbox" name = "recurday" value = "1" id = "monday">Monday</label><br>
                    <label for="tuesday"><input type = "checkbox" name = "recurday" value = "2" id = "tuesday">Tuesday</label><br>
                    <label for="wednesday"><input type = "checkbox" name = "recurday" value = "3" id = "wednesday">Wednesday</label><br>
                    <label for="thursday"><input type = "checkbox" name = "recurday" value = "4" id = "thursday">Thursday</label><br>
                    <label for="friday"><input type = "checkbox" name = "recurday" value = "5" id = "friday">Friday</label><br>
                    <label for="sunday"><input type = "checkbox" name = "recurday" value = "6" id = "saturday">Saturday</label><br>
                  </ul>
                </div>
                </form>
                <p id = "emptytaskmessage" class = "emptymessage">please enter a task before submitting</p>
            </div>
        </div>
      <div id = "recurringtaskspage" style = "display: none">
          <div>
            <h1 class="todolistfinal">View and delete recurring tasks</h1>
          </div>
          <table style="width: 100%; border-collapse: collapse;">
            <tbody id = 'recurringtable'>
              <tr>
                <td class = "weekday">Sunday</td>
                <td id = "sundayrow"><?php displayAllRecurring(0, $recurringTasks, $userId)?></td>
              </tr>
              <tr>
                <td class = "weekday">Monday</td>
                <td id = "mondayrow"><?php displayAllRecurring(1, $recurringTasks, $userId)?></td>
              </tr>
              <tr>
                <td class = "weekday">Tuesday</td>
                <td id = "tuesdayrow"><?php displayAllRecurring(2, $recurringTasks, $userId)?></td>
              </tr>
              <tr>
                <td class = "weekday">Wednesday</td>
                <td id = "wednesdayrow"><?php displayAllRecurring(3, $recurringTasks, $userId)?></td>
              </tr>
              <tr>
                <td class = "weekday">Thursday</td>
                <td id = "thursdayrow"><?php displayAllRecurring(4, $recurringTasks, $userId)?></td>
              </tr>
              <tr>
                <td class = "weekday">Friday</td>
                <td id = "fridayrow"><?php displayAllRecurring(5, $recurringTasks, $userId)?></td>
              </tr>
              <tr>
                <td class = "weekday">Saturday</td>
                <td id = "saturdayrow"><?php displayAllRecurring(6, $recurringTasks, $userId)?></td>
              </tr>
            </tbody>
          </table>
      </div>
      <div id = "generategoalpage" style = "display: none">
          <div style = "display: flex; flex-direction: column">
          <h1 class="generateheader">Generate daily steps to achieve a goal</h1>
          <p style = "font-size: medium; margin-top: 15px; margin-bottom: 20px">use the power of generative AI to help you get started on your goals!</p>
          </div>
          <div class = 'formandsteps'>
            <div class = 'gptformfinal'>
              <p style = 'font-size: 20px; font-weight: 600; color: #1c1c1c '>Enter a goal or task you would like to complete</p>
              <form id='goalform' action='' method='POST' onsubmit='generateTaskFromInput(event)'>
                <input id = 'goal' type = 'text' name = 'goal' class = "textboxes" placeholder = "Goal or task">
                <p style = 'font-size: 20px; font-weight: 600; color: #1c1c1c '>Desired time frame</p>
                <input type = 'number' id = 'timeNumber' name = 'timeNumber'  class = "textboxes" style = "width: 80%" placeholder = "Number">
                <select id = 'timeUnit' name = 'timeUnit'>
                  <option value="days">days</option>
                  <option value="weeks">weeks</option>
                  <option value="months">months</option>
                </select>
                <div><input type = 'submit' name='goalentered' value='enter' class = "entergenerate"></div>
              </form>
            </div>
            <div style = "width: 27.5%; display: flex; flex-direction: column; height: 330">
            <form id = 'generated' action='' method='POST' onsubmit='goalFunctions(<?php echo $userId; ?>, false, event); alert("successfuly added!")' style = "display: flex; height: 330px; flex-direction: column">
                <div style = "flex-grow: 1; display: flex; align-items: center;"><p id='generatedTask0'><input type = 'hidden' name = 'taskbody0'></p></div>
                <div style = "flex-grow: 1; display: flex; align-items: center; border-top: 1px solid #eaeaea; border-bottom: 1px solid #eaeaea"><p id='generatedTask1'><input type = 'hidden' name = 'taskbody1'></p></div>
                <div style = "flex-grow: 1; display: flex; align-items: center;"><p id='generatedTask2'><input type = 'hidden' name = 'taskbody2'></p></div>
                <div><input type = 'submit' class='entergenerate' style = "display: none; width: 100%" id='generatedbutton' name='generatedentered' value='add to daily list'></div>
            </form>
            </div>
          </div>
        <!-- <div class='gptform' style='width: 100%'>
              <h2><center>generate steps to achieve a goal</center></h2>
              <p style='margin-left: 10%; margin-right: 10%'>enter a goal/task you would like to achieve in the box below</p>
              <form id='goalform' action='' method='POST' onsubmit='generateTaskFromInput(event)'>
                <label for='goal'>goal:</label>
                <input id = 'goal' type = 'text' name = 'goal' style="width: 75%">
                <label for='number'>within:</label>
                <input type = 'number' id = 'timeNumber' name = 'timeNumber'>
                <select id = 'timeUnit' name = 'timeUnit'>
                  <option value="days">days</option>
                  <option value="weeks">weeks</option>
                  <option value="months">months</option>
                </select>
                <input type = 'submit' name='goalentered' value='enter'>
              </form>
              <div class='stepslist'>
                <form id = 'generated' action='' method='POST' onsubmit='goalFunctions(, false, event)'>
                  <p id='generatedTask0'><input type = 'hidden' name = 'taskbody0'></p>
                  <p id='generatedTask1'><input type = 'hidden' name = 'taskbody1'></p>
                  <p id='generatedTask2'><input type = 'hidden' name = 'taskbody2'></p>
                  <input type = 'submit' class='generatedbutton' id='generatedbutton' name='generatedentered' value='add to daily list'>
                </form>
              </div>
            </div> -->
      </div>
      <div id = "currentgoalpage" style = "display: none">
        <div>
          <h1 class="todolistfinal">Current goals</h1>
          <div id = 'listProjects' style = "display: flex; height: 100%; width: 100%; flex-wrap: wrap; column-gap: 3%; row-gap: 40px; align-content: flex-start">
            <?php
                displayAllGoals($allGoals, $userId);
            ?>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
  </body>
</html>
