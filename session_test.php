<?php
  include_once('include/init.php');

  $thisUser = getUser($_SESSION['userId']);

  if (isset($_REQUEST['logout'])) {
    session_destroy();
    header('location:session_test2.php');
    exit;
  }

  echo "
    <p>Welcome, ". $thisUser['firstName']."</p>
    <p>Your username: ". $thisUser['username']."</p>
    <form action='session_test.php' method='post'>
      <input type='submit' value = 'logout' name='logout'/>
    </form>
  ";
?>