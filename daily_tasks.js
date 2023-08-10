  function openNav(navId) {
    document.getElementById(navId).style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    document.getElementById("openbutton").style.visibility = "hidden";
  }

  function closeNav(navId) {
    document.getElementById(navId).style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    document.getElementById("openbutton").style.visibility = "visible";
  }

  function showRecurOptions() {
    checkbox = document.getElementById("recuroption");
    options = document.getElementById("recurday");
    if (checkbox.checked == true){
      options.style.display = "block";
    }
    else {
      options.style.display = "none";
    }
  }

  function insertTask(event, userId, manual){
    event.preventDefault();
    if (document.getElementById('task').value == "" && manual) {
      document.getElementById("emptytaskmessage").style.display = "block";
    }
    else {
      let recurdays = [];
      const url = '/add_task.php';
      let newTaskData = new URLSearchParams();
      newTaskData.append('taskbody', document.getElementById('task').value);
      newTaskData.append('userId', userId);
      newTaskData.append('recurs', document.getElementById('recuroption').checked);
      newTaskData.append('manual', manual);
      if (!manual) {
        newTaskData.append('goalBody', document.getElementById('goal').value);
        newTaskData.append('timeNumber', document.getElementById('timeNumber').value);
        newTaskData.append('timeUnit', document.getElementById('timeUnit').value);
      }
      if (document.getElementById('recuroption').checked && manual) {
        days = document.getElementsByName('recurday');
        for (let i = 0; i < days.length; i++){
          if (days[i].checked) {
            recurdays.push(days[i].value);
          }
        }
        newTaskData.append('days', recurdays);
        const options = {
          method: 'POST',
          body: newTaskData,
        };
        fetch (url, options)
        .then(response => {
          return response.json();
        })
        .then(insertedTask => {
          if (recurdays.includes(insertedTask.currentDay)) {
            document.getElementById('todotable').insertAdjacentHTML('beforeend', insertedTask.nonRecurringBody);
          }
          if (recurdays.includes('0')) {
            document.getElementById('sundayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('1')) {
            document.getElementById('mondayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('2')) {
            document.getElementById('tuesdayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('3')) {
            document.getElementById('wednesdayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('4')) {
            document.getElementById('thursdayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('5')) {
            document.getElementById('fridayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('6')) {
            document.getElementById('saturdayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
        })
        .catch(error => {
          console.error('Error: ', error);
        });
        document.getElementById('todoform').reset();
        document.getElementById("recurday").style.display = "none";
      }
      else if(!manual) {
        recurdays = ['0','1', '2', '3', '4', '5', '6'];
        newTaskData.append('taskbody', document.getElementById('generatedTask0').textContent.replace(/[0-9]+\./, ''));
        const options = {
          method: 'POST',
          body: newTaskData,
        };
        fetch (url, options)
        .then(response => {
          return response.json();
        })
        .then(insertedTask => {
          if (recurdays.includes(insertedTask.currentDay)) {
            document.getElementById('todotable').insertAdjacentHTML('beforeend', insertedTask.nonRecurringBody);
            console.log("here");
          }
          if (recurdays.includes('0')) {
            document.getElementById('sundayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('1')) {
            document.getElementById('mondayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('2')) {
            document.getElementById('tuesdayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('3')) {
            document.getElementById('wednesdayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('4')) {
            document.getElementById('thursdayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('5')) {
            document.getElementById('fridayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('6')) {
            document.getElementById('saturdayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
        })
        .catch(error => {
          console.error('Error: ', error);
        });
        newTaskData.append('taskbody', document.getElementById('generatedTask1').textContent.replace(/[0-9]+\./, ''));
        fetch (url, options)
        .then(response => {
          return response.json();
        })
        .then(insertedTask => {
          if (recurdays.includes(insertedTask.currentDay)) {
            document.getElementById('todotable').insertAdjacentHTML('beforeend', insertedTask.nonRecurringBody);
          }
          if (recurdays.includes('0')) {
            document.getElementById('sundayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('1')) {
            document.getElementById('mondayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('2')) {
            document.getElementById('tuesdayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('3')) {
            document.getElementById('wednesdayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('4')) {
            document.getElementById('thursdayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('5')) {
            document.getElementById('fridayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('6')) {
            document.getElementById('saturdayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
        })
        .catch(error => {
          console.error('Error: ', error);
        });
        newTaskData.append('taskbody', document.getElementById('generatedTask2').textContent.replace(/[0-9]+\./, ''));
        fetch (url, options)
        .then(response => {
          return response.json();
        })
        .then(insertedTask => {
          console.log(insertedTask.currentDay);
          console.log(recurdays);
          if (recurdays.includes(insertedTask.currentDay)) {
            document.getElementById('todotable').insertAdjacentHTML('beforeend', insertedTask.nonRecurringBody);
          }
          if (recurdays.includes('0')) {
            document.getElementById('sundayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('1')) {
            document.getElementById('mondayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('2')) {
            document.getElementById('tuesdayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('3')) {
            document.getElementById('wednesdayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('4')) {
            document.getElementById('thursdayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('5')) {
            document.getElementById('fridayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
          if (recurdays.includes('6')) {
            document.getElementById('saturdayrow').insertAdjacentHTML('beforeend', insertedTask.recurringBody);
          }
        })
        .catch(error => {
          console.error('Error: ', error);
        });
      }
      else {
        const options = {
          method: 'POST',
          body: newTaskData,
        };
        fetch (url, options)
        .then(response => {
          return response.json();
        })
        .then(insertedTask => {
          document.getElementById('todotable').insertAdjacentHTML('beforeend', insertedTask.nonRecurringBody);
        })
        .catch(error => {
          console.error('Error: ', error);
        });
        document.getElementById('todoform').reset();
      }
    }
  }

  function updateTask(taskId, userId) {
    const url = '/update_task.php';
    let updatedTaskData = new URLSearchParams();
    updatedTaskData.append('taskId', taskId);
    updatedTaskData.append('userId', userId);
    const options = {
      method: 'POST',
      body: updatedTaskData,
    };
    fetch(url, options)
    .then(response => {
      return response.text();
    })
    .then(updatedTask => {
      document.getElementById(taskId.toString().concat('update')).innerHTML = updatedTask;
    })
    .catch(error => {
      console.error('Error: ', error);
    });
  }

  function deleteTask(taskId, userId) {
    const url = '/delete_task.php';
    let deletedTaskData = new URLSearchParams();
    deletedTaskData.append('taskId', taskId);
    deletedTaskData.append('userId', userId);
    const options = {
      method: 'POST',
      body: deletedTaskData,
    };
    fetch(url, options)
    .then(response => {
      return response.text();
    })
    .then(deletedTask => {
      document.getElementById(deletedTask).remove();
    })
    .catch(error => {
      console.error('Error: ', error);
    });    
  }

  function showAllRecurringTasks() {
    const showCheckbox = document.getElementById("showAllRecurring");
    const recurringlist = document.getElementById("listrecurring");
    if (showCheckbox.checked == true){
      recurringlist.style.display = "block";
    }
    else {
      recurringlist.style.display = "none";
    }
  }

  function deleteRecurringTask(taskId, userId) {
    const url = '/delete_recurring_task.php';
    let deletedRecurringTaskData = new URLSearchParams();
    deletedRecurringTaskData.append('recurringTaskId', taskId);
    deletedRecurringTaskData.append('recurringUserId', userId);
    const options = {
      method: 'POST',
      body: deletedRecurringTaskData,
    };
    fetch(url, options)
    .then(response => {
      return response.text();
    })
    .then(deletedRecurringTask => {
      const allrecurring = Array.from(document.getElementsByClassName(deletedRecurringTask));
      allrecurring.forEach(individualtask => {individualtask.remove();});
    })
    .catch(error => {
      console.error('Error: ', error);
    });    
  }

  function updateRecurringTask(taskId, userId) {
    const url = '/update_recurring_task.php';
    let updatedRecurringTaskData = new URLSearchParams();
    updatedRecurringTaskData.append('taskId', taskId);
    updatedRecurringTaskData.append('userId', userId);
    const options = {
      method: 'POST',
      body: updatedRecurringTaskData,
    };
    fetch(url, options)
    .then(response => {
      return response.text();
    })
    .then(updatedRecurringTask => {
      document.getElementById(`${taskId}recur`).innerHTML = updatedRecurringTask;
    })
    .catch(error => {
      console.error('Error: ', error);
    });
  }

  function generateTaskFromInput(event) {
    event.preventDefault();
    const url = '/gpt.php';
    let inputtedGoal = new URLSearchParams();
    inputtedGoal.append('goal', document.getElementById('goal').value);
    inputtedGoal.append('timeNumber', document.getElementById('timeNumber').value);
    inputtedGoal.append('timeUnit', document.getElementById('timeUnit').value);
    const options = {
      method: 'POST',
      body: inputtedGoal,
    };
    fetch(url, options)
    .then(response => {
      return response.json();
    })
    .then(steps => {
      document.getElementById('generatedTask0').innerHTML = steps[0];
      document.getElementById('generatedTask1').innerHTML = steps[1];
      document.getElementById('generatedTask2').innerHTML = steps[2];
      document.getElementById('generatedbutton').style.display = 'block';
    })
    .catch(error => {
      console.error('Error: ', error);
    });
  }

  function insertGoal(userId) {
    let newGoalData = new URLSearchParams();
    const url = '/add_goal.php';
    newGoalData.append('goalBody', document.getElementById('goal').value);
    newGoalData.append('userId', userId);
    newGoalData.append('timeNumber', document.getElementById('timeNumber').value);
    newGoalData.append('timeUnit', document.getElementById('timeUnit').value);
    const options = {
      method: 'POST',
      body: newGoalData,
    };
    fetch(url, options)
    .catch(error => {
      console.error('Error: ', error);
    });
  }

  function displayGoal(userId) {
    let goalData = new URLSearchParams();
    goalData.append('userId', userId);
    const url = '/display_goal.php';
    const options = {
      method: 'POST',
      body: goalData,
    };
    fetch(url, options)
    .then (response => {
      return response.text();
    })
    .then(display => {
      document.getElementById('listProjects').insertAdjacentHTML('beforeend', display);
    })
    .catch(error => {
      console.error('Error: ', error);
    });
  }

  function goalFunctions(userId, manual, event) {
    insertGoal(userId);
    insertTask(event, userId, manual);
    setTimeout(continueExecution, 1000);
  }
  function continueExecution () {
    displayGoal();
  }

  function showtaskspage() {
    document.getElementById('todaystaskspage').style.display = 'block';
    document.getElementById('recurringtaskspage').style.display = 'none';
    document.getElementById('generategoalpage').style.display = 'none';
    document.getElementById('currentgoalpage').style.display = 'none';
    document.getElementById('recurringtasknav').style.backgroundColor = 'transparent';
    document.getElementById('generategoalnav').style.backgroundColor = 'transparent';
    document.getElementById('currentgoalnav').style.backgroundColor = 'transparent';
    document.getElementById('todaystasknav').style.backgroundColor = '#7087d21a';
    document.getElementById('recurringtasknav').style.borderRight = 'none';
    document.getElementById('generategoalnav').style.borderRight = 'none';
    document.getElementById('currentgoalnav').style.borderRight = 'none';
    document.getElementById('todaystasknav').style.borderRight = '4px solid #2B3E7E';
  }

  function showrecurringpage() {
    document.getElementById('todaystaskspage').style.display = 'none';
    document.getElementById('recurringtaskspage').style.display = 'block';
    document.getElementById('generategoalpage').style.display = 'none';
    document.getElementById('currentgoalpage').style.display = 'none';
    document.getElementById('todaystasknav').style.backgroundColor = 'transparent';
    document.getElementById('generategoalnav').style.backgroundColor = 'transparent';
    document.getElementById('currentgoalnav').style.backgroundColor = 'transparent';
    document.getElementById('recurringtasknav').style.backgroundColor = '#7087d21a';
    document.getElementById('todaystasknav').style.borderRight = 'none';
    document.getElementById('generategoalnav').style.borderRight = 'none';
    document.getElementById('currentgoalnav').style.borderRight = 'none';
    document.getElementById('recurringtasknav').style.borderRight = '4px solid #2B3E7E';
  }

  function showgenerategoalpage() {
    document.getElementById('todaystaskspage').style.display = 'none';
    document.getElementById('generategoalpage').style.display = 'block';
    document.getElementById('recurringtaskspage').style.display = 'none';
    document.getElementById('currentgoalpage').style.display = 'none';
    document.getElementById('recurringtasknav').style.backgroundColor = 'transparent';
    document.getElementById('todaystasknav').style.backgroundColor = 'transparent';
    document.getElementById('currentgoalnav').style.backgroundColor = 'transparent';
    document.getElementById('generategoalnav').style.backgroundColor = '#7087d21a';
    document.getElementById('recurringtasknav').style.borderRight = 'none';
    document.getElementById('todaystasknav').style.borderRight = 'none';
    document.getElementById('currentgoalnav').style.borderRight = 'none';
    document.getElementById('generategoalnav').style.borderRight = '4px solid #2B3E7E';
  }

  function showcurrentgoalpage() {
    document.getElementById('todaystaskspage').style.display = 'none';
    document.getElementById('generategoalpage').style.display = 'none';
    document.getElementById('recurringtaskspage').style.display = 'none';
    document.getElementById('currentgoalpage').style.display = 'block';
    document.getElementById('recurringtasknav').style.backgroundColor = 'transparent';
    document.getElementById('generategoalnav').style.backgroundColor = 'transparent';
    document.getElementById('todaystasknav').style.backgroundColor = 'transparent';
    document.getElementById('currentgoalnav').style.backgroundColor = '#7087d21a';
    document.getElementById('recurringtasknav').style.borderRight = 'none';
    document.getElementById('generategoalnav').style.borderRight = 'none';
    document.getElementById('todaystasknav').style.borderRight = 'none';
    document.getElementById('currentgoalnav').style.borderRight = '4px solid #2B3E7E';
  }