<?php
  include('include/init.php');
  $errormessage = validateUser('enter', 'email', 'password');
  $registrationmessage = null;
  if (isset($_SESSION['msg'])) { 
    $registrationmessage = $_SESSION['msg']; 
    $_SESSION['msg'] = "";
  }
  if (isset($_SESSION['userId'])) {
    header('location:daily_task_page.php');
    exit;
  }
?>
<html>
  <head>
    <link rel="stylesheet" href="login_style.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <title>Login</title>
  </head>
  <body>
    <div class = 'loginform'>
      <form action='index.php' method='post'>
        <p style = 'margin-bottom: 10px'><?php echo $registrationmessage ?></p>
        <h2>enter login info</h2>
        <p>email</p>
        <input type='email' name='email'/> <br/>
        <p>password</p>
        <input type='password' name='password'/><br/>
        <p style = 'margin-bottom: 10px'><?php echo $errormessage ?></p>
        <input type='submit' name='enter'/>
      </form>
      <a href = signup.php><p>sign up</p></a>
    <div>
  </body>
</html>