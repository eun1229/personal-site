<?php
  include('include/init.php');
  validateUser();
  if (isset($_SESSION['userId'])) {
    header('location:homepage.php');
    exit;
  }
?>

<form action='login.php' method='post'>
	<h2>enter login info</h2>
	username: <input type='text' name='username'/> <br/><br/>

	password: <input type='text' name='password'/> <br/><br/>

	<input type='submit' name='enter'/>
</form>

<a href = signup.php> sign up </a>