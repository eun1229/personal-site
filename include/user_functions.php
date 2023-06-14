<?php
function getUser($userId) {
    return db_Query("
      SELECT * 
      FROM user 
      WHERE userId = :userId", 
      [
        'userId' => $userId
      ]
      ) -> fetch();
  }

function getUserFromInput($username, $password) {
  return db_Query("
    SELECT * 
    FROM user 
    WHERE username = :username AND password = :password",
    [
      'username' => $username,
      'password' => $password
    ]
    ) -> fetch();
  }

function validateUser() {
  if (isset($_REQUEST['enter'])) {
    if ($_REQUEST['password'] == '' || $_REQUEST['username'] == '') {
      echo 'USERNAME AND PASSWORD REQUIRED';
      //exit;
    }
    else {
      $user = getUserFromInput($_REQUEST['username'], $_REQUEST['password']);
      if ($user) {
        $_SESSION['userId'] = $user['userId'];
        //exit;
      }
      else {
        echo "invalid username and password";
        //exit;
      }
    }
  }
}

function verifyLogin() {
  if (!isset($_SESSION['userId'])) {
    header('location:login.php');
    //exit;
  }
  else {
    return getUser($_SESSION['userId']);
    //exit;
  }
}

?>


