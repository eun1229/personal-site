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

  function insertTask(event, userId){
    event.preventDefault();
    if (document.getElementById('task').value == "") {
      document.getElementById("emptytaskmessage").style.display = "block";
    }
    else {
      const url = '/add_task.php';
      let newTaskData = new URLSearchParams();
      newTaskData.append('taskbody', document.getElementById('task').value);
      newTaskData.append('userId', userId);
      const options = {
        method: 'POST',
        body: newTaskData,
      };
      fetch (url, options)
      .then(response => {
        return response.text();
      })
      .then(insertedTask => {
        document.getElementById('todolist').insertAdjacentHTML('beforeend', insertedTask);
      })
      .catch(error => {
        console.error('Error: ', error);
      });
      document.getElementById('todoform').reset();
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
