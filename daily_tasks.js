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
    label = document.getElementById("recurlabel");
    options = document.getElementById("recurday");
    if (checkbox.checked == true){
      options.style.display = "block";
      label.style.display = "block";
    }
    else {
      options.style.display = "none";
      label.style.display = "none";
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
          if (recurdays.includes(insertedTask[0])) {
            document.getElementById('todolist').insertAdjacentHTML('beforeend', insertedTask[2]);
          }
          document.getElementById('listrecurring').insertAdjacentHTML('beforeend', insertedTask[1]);
        })
        .catch(error => {
          console.error('Error: ', error);
        });
        document.getElementById('todoform').reset();
      }
      else if(!manual) {
        recurdays = ['0','1', '2', '3', '4', '5'];
        newTaskData.append('taskbody', document.getElementById('generatedTask0').textContent);
        const options = {
          method: 'POST',
          body: newTaskData,
        };
        fetch (url, options)
        .then(response => {
          return response.json();
        })
        .then(insertedTask => {
          if (recurdays.includes(insertedTask[0])) {
            document.getElementById('todolist').insertAdjacentHTML('beforeend', insertedTask[2]);
          }
          document.getElementById('listrecurring').insertAdjacentHTML('beforeend', insertedTask[1]);
        })
        .catch(error => {
          console.error('Error: ', error);
        });
        newTaskData.append('taskbody', document.getElementById('generatedTask1').textContent);
        fetch (url, options)
        .then(response => {
          return response.json();
        })
        .then(insertedTask => {
          if (recurdays.includes(insertedTask[0])) {
            document.getElementById('todolist').insertAdjacentHTML('beforeend', insertedTask[2]);
          }
          document.getElementById('listrecurring').insertAdjacentHTML('beforeend', insertedTask[1]);
        })
        .catch(error => {
          console.error('Error: ', error);
        });
        newTaskData.append('taskbody', document.getElementById('generatedTask2').textContent);
        fetch (url, options)
        .then(response => {
          return response.json();
        })
        .then(insertedTask => {
          if (recurdays.includes(insertedTask[0])) {
            document.getElementById('todolist').insertAdjacentHTML('beforeend', insertedTask[2]);
          }
          document.getElementById('listrecurring').insertAdjacentHTML('beforeend', insertedTask[1]);
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
          document.getElementById('todolist').insertAdjacentHTML('beforeend', insertedTask[2]);
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
    checkbox = document.getElementById("showAllRecurring");
    recurringlist = document.getElementById("listrecurring");
    if (checkbox.checked == true){
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
      document.getElementById(deletedRecurringTask).remove();
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
      document.getElementById(taskId.toString().concat('recur')).innerHTML = updatedRecurringTask;
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

  function insertGeneratedTasks() {
    const url = 'add_task.php';

  }