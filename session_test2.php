<?php
  include_once('include/init.php');
?>

<?php
if (isset($_REQUEST['enter'])) {
    if ($_REQUEST['password'] == '' || $_REQUEST['username'] == '') {
      echo 'USERNAME AND PASSWORD REQUIRED';
    }
    else {
      $user = getUserFromInput($_REQUEST['username'], $_REQUEST['password']);
      if ($user) {
        $_SESSION['userId'] = $user['userId'];
      }
      else {
        echo "invalid username and password";
      }
    }
}
if (isset($_SESSION['userId'])) {
  header('location:session_test.php');
}
?>

<form action='session_test2.php' method='post'>
	<h2>enter login info</h2>
	username: <input type='text' name='username'/> <br/><br/>

	password: <input type='text' name='password'/> <br/><br/>

	<input type='submit' name='enter'/>
</form>
