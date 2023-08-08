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
    <link href="<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Borel&family=Inter:wght@300;400;500&family=Mulish:wght@300;400&display=swap" rel="stylesheet">
    <title>Login</title>
  </head>
  <body>
    <div style = 'display: flex; justify-content: space-around; align-items: center; height: 100%'>
    <div class = 'loginform'>
      <form action='index.php' method='post'>
        <p style = 'margin-bottom: 10px; width: 300px'><?php echo $registrationmessage ?></p>
        <h2>List</h2>
        <p style='text-align: left'>email</p>
        <input type='email' name='email' class='textboxes'/> <br/>
        <p style='text-align: left'>password</p>
        <input type='password' name='password' class='textboxes'/><br/>
        <p style = 'margin-bottom: 10px'><?php echo $errormessage ?></p>
        <input type='submit' name='enter' value='Sign In' style='margin-top: 35px'/>
      </form>
      <p class="signuptext">Don't have an account yet? <a href = signup.php>sign up</a></p>
    </div>
    <div>
      <img src="man with laptop.png">
    </div>
    </div>
  </body>
</html>