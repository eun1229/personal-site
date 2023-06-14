<?php
  include_once('include/init.php');
  validateUser();
  if (isset($_SESSION['userId'])) {
    header('location:session_test.php');
    exit;
  }
?>

<form action='session_test2.php' method='post'>
	<h2>enter login info</h2>
	username: <input type='text' name='username'/> <br/><br/>

	password: <input type='text' name='password'/> <br/><br/>

	<input type='submit' name='enter'/>
</form>

<a href = signup.php> sign up </a>