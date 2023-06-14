<?php
  include('include/init.php');

  $thisUser = verifyLogin();

  if (isset($_REQUEST['logout'])) {
    session_destroy();
    header('location:login.php');
    exit;
  }

  echo "
    <p>Welcome, ". $thisUser['firstName']."</p>
    <p>Your username: ". $thisUser['username']."</p>
    <form action='homepage.php' method='post'>
      <input type='submit' value = 'logout' name='logout'/>
    </form>
  ";
?>
