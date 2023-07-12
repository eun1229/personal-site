// DELETE THIS FILE
function generateTaskFromInput(event) {
  event.preventDefault();
  console.log('here');
  const url = '/gpt.php';
  let inputtedGoal = new URLSearchParams();
  inputtedGoal.append('goal', document.getElementById('goal').value);
  const options = {
    method: 'POST',
    body: inputtedGoal,
  };
  fetch(url, options)
  .then(response => {
    return response.text();
  })
  .then(steps => {
    document.getElementById('generatedTasks').innerHTML = steps;
  })
  .catch(error => {
    console.error('Error: ', error);
  });
}