<?php
echo("<div id = 'todaystaskspage'>
<div>
  <h1 class='todolistfinal'>Today's to-do list</h1>
</div>
<div class = 'mainsections' id = 'mains'>
  <div class = 'todosection'>
    <div class = 'todoheader'><h2>today's to-do</h2></div>
    <div class = 'todolist'>
      <ul id = 'todolist'>
        <?php
          displayAllTasks($tasks, $userId);
        ?>
      </ul>
    </div>
    <div class = 'todoform'>
      <form id = 'todoform' action = '' method = 'POST' style = 'margin: 0' onsubmit = 'insertTask(event, <?php echo $userId;?>, true)'>
      <label for = 'task'>enter a task:</label>
      <input id = 'task' type = 'text' name = 'task'><br>
      <div class = 'recurform'>
        <input type='checkbox' name = 'recuroption' id = 'recuroption' style = 'margin-left: 0px' onclick = 'showRecurOptions()'>
        <label for = 'recuroption'>this is a recurring task</label>
          <p id = 'recurlabel' style = 'display:none; text-align: right'>every:</p>
          <ul id = 'recurday' style = 'display:none; padding-left: 10px'>
            <label for='sunday'><input type = 'checkbox' name = 'recurday' value = '0' id = 'sunday'>Sunday</label><br>
            <label for='monday'><input type = 'checkbox' name = 'recurday' value = '1' id = 'monday'>Monday</label><br>
            <label for='tuesday'><input type = 'checkbox' name = 'recurday' value = '2' id = 'tuesday'>Tuesday</label><br>
            <label for='wednesday'><input type = 'checkbox' name = 'recurday' value = '3' id = 'wednesday'>Wednesday</label><br>
            <label for='thursday'><input type = 'checkbox' name = 'recurday' value = '4' id = 'thursday'>Thursday</label><br>
            <label for='friday'><input type = 'checkbox' name = 'recurday' value = '5' id = 'friday'>Friday</label><br>
            <label for='sunday'><input type = 'checkbox' name = 'recurday' value = '6' id = 'saturday'>Saturday</label><br>
          </ul>
        <p id = 'emptytaskmessage' class = 'emptymessage'>please enter a task before submitting</p>
        <input type='submit' name='entered' value = 'enter'>
        </form>
      </div>  
    </div>
    <div class = 'viewrecurring'>
      <input type = 'checkbox' id = 'showAllRecurring' onclick = 'showAllRecurringTasks()'>view and edit recurring tasks</input>
      <ul class = 'listrecurring' id = 'listrecurring' style = 'display:none'>
        <?php
          displayAllRecurring($recurringTasks, $userId);
        ?>
      </ul>
    </div>
  </div>
  <div style='display:flex; flex-direction:column; width: 30%; margin: 5%;'>
    <div class='gptform' style='width: 100%'>
      <h2><center>generate steps to achieve a goal</center></h2>
      <p style='margin-left: 10%; margin-right: 10%'>enter a goal/task you would like to achieve in the box below</p>
      <form id='goalform' action='' method='POST' onsubmit='generateTaskFromInput(event)' class='todoform'>
        <label for='goal'>goal:</label>
        <input id = 'goal' type = 'text' name = 'goal' style='width: 75%'>
        <label for='number'>within:</label>
        <input type = 'number' id = 'timeNumber' name = 'timeNumber'>
        <select id = 'timeUnit' name = 'timeUnit'>
          <option value='days'>days</option>
          <option value='weeks'>weeks</option>
          <option value='months'>months</option>
        </select>
        <input type = 'submit' name='goalentered' value='enter'>
      </form>
      <div class='stepslist'>
        <form id = 'generated' action='' method='POST' onsubmit='goalFunctions(<?php echo $userId; ?>, false, event)'>
          <p id='generatedTask0'><input type = 'hidden' name = 'taskbody0'></p>
          <p id='generatedTask1'><input type = 'hidden' name = 'taskbody1'></p>
          <p id='generatedTask2'><input type = 'hidden' name = 'taskbody2'></p>
          <input type = 'submit' class='generatedbutton' id='generatedbutton' name='generatedentered' value='add to daily list'>
        </form>
      </div>
    </div>
    <div class = 'viewrecurring'>
      <h2>current projects</h2>
      <ul class = 'listProjects' id = 'listProjects'>
        <?php
          displayAllGoals($allGoals, $userId);
        ?>
      </ul>
    </div>
  </div>
</div>
</div>"
);
?>
