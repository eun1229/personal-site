<?php
  include_once('include/init.php');
  if (isset($_REQUEST['submitted'])) {
    if ($_REQUEST['password'] != $_REQUEST['repeatpassword']) {
      echo "passwords do not match";
    }
    else if(sizeof(verifyEmail($_REQUEST['email'])) != 0) {
      echo "email is already in use";
    }
    else {
      insertUser($_REQUEST['name'], $_REQUEST['lastname'], $_REQUEST['email'], $_REQUEST['password']);
      $_SESSION['msg'] = "Registration was successful, you may now login";
      header('location: index.php');
    }
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
    <div>
      <form action="" method="post" class = 'signupform'>
        <h2>Register new user</h2>

        <p>Name:</p>
        <input type="text" placeholder="Enter First Name" name="name" required><br>

        <p>Last Name:</p>
        <input type="text" placeholder="Enter Last Name" name="lastname" required><br>

        <p>Email:</p>
        <input type="email" placeholder="Enter Email" name="email" required><br>

        <p>Password:</p>
        <input type="password" placeholder="Enter Password" name="password" required><br>

        <p>Repeat Password:</p>
        <input type="password" placeholder="Repeat Password" name="repeatpassword" required><br>

        <button type="submit" class="signupbutton" name="submitted">Sign Up</button>
      </form>
    </div>
  </body>
</html>