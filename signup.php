<?php
  include_once('include/init.php');

  $emptyerrors = [];
  $names = array("name", "lastname", "username", "email", "password");

  if (isset($_REQUEST['submitted'])) {
    foreach ($names as $value) {
      if ($_REQUEST[$value] == '') {
        $emptyerrors['comment'] = $value." required";
        break;
      }
    }
  }

  if (sizeof($emptyerrors) === 0) {
    if ($_REQUEST['password'] != $_REQUEST['repeatpassword']) {
      echo "passwords do not match";
    }
    else if(sizeof(verifyUsername($_REQUEST['username'])) != 0) {
      echo "username is already taken";
    }
    else if(sizeof(verifyEmail($_REQUEST['email'])) != 0) {
      echo "email is already in use";
    }
    else {
      insertUser($_REQUEST['name'], $_REQUEST['lastname'], $_REQUEST['username'], $_REQUEST['password'], $_REQUEST['email']);
      header('location: session_test2.php');
    }
  }
?>

<form action="" method="post">
  <label for="name"><b>Name *</b></label>
  <input type="text" placeholder="Enter First Name" name="name"><br>

  <label for="lastname"><b>Last Name *</b></label>
  <input type="text" placeholder="Enter Last Name" name="lastname"><br>

  <label for="username"><b>Create Username *</b></label>
  <input type="text" placeholder="Enter Username" name="username"><br>

  <label for="email"><b>Email *</b></label>
  <input type="text" placeholder="Enter Email" name="email"><br>

  <label for="password"><b>Password *</b></label>
  <input type="password" placeholder="Enter Password" name="password"><br>

  <label for="repeatpassword"><b>Repeat Password *</b></label>
  <input type="password" placeholder="Repeat Password" name="repeatpassword"><br>

  <button type="submit" class="signupbtn" name="submitted">Sign Up</button>
</form>