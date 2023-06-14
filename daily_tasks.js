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
      let data = new URLSearchParams();
      data.append('taskbody', document.getElementById('task').value);
      data.append('userId', userId);
      const options = {
        method: 'POST',
        body: data,
      };
      fetch (url, options)
      .then(response => {
        return response.text();
      })
      .then(data => {
        document.getElementById('todolist').innerHTML = data;
      })
      .catch(error => {
        console.error('Error: ', error);
      });
      document.getElementById('todoform').reset();
    }
  }

  function updateTask(taskId, userId) {
    const url = '/update_task.php';
    let data = new URLSearchParams();
    data.append('taskId', taskId);
    data.append('userId', userId);
    const options = {
      method: 'POST',
      body: data,
    };
    fetch(url, options)
    .then(response => {
      return response.text();
    })
    .then(data => {
      document.getElementById('todolist').innerHTML = data;
    })
    .catch(error => {
      console.error('Error: ', error);
    });
  }

  function deleteTask(taskId, userId) {
    const url = '/delete_task.php';
    let data = new URLSearchParams();
    data.append('taskId', taskId);
    data.append('userId', userId);
    const options = {
      method: 'POST',
      body: data,
    };
    fetch(url, options)
    .then(response => {
      return response.text();
    })
    .then(data => {
      document.getElementById('todolist').innerHTML = data;
    })
    .catch(error => {
      console.error('Error: ', error);
    });    
  }
