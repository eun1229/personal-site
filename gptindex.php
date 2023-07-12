<!-- DELETE THIS FILE -->

<html>
  <head>
    <title>Generate Tasks</title>
    <script src='gpt.js'></script>
  </head>
  <body>
    <div class='inputform'>
      <form id='goalform' action='' method='POST' onsubmit='generateTaskFromInput(event)'>
        <input id = 'goal' type = "text" name = 'goal'>
        <input type = 'submit' name='goalentered' value='enter'>
      </form>
      <p id='generatedTasks'></p>
  </body>
</html>