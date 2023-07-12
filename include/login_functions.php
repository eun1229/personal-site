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

function getUserFromInput($username) {
  return db_Query("
    SELECT * 
    FROM user 
    WHERE email = :username",
    [
      'username' => strtolower($username),
    ]
    ) -> fetch();
  }

function validateUser($submit, $username, $password) { 
  if (isset($_REQUEST[$submit])) {
    if (!$_REQUEST[$username] || !$_REQUEST[$password]) {
      return 'username and password required!';
    }
    else {
      $user = getUserFromInput($_REQUEST[$username]);
      if ($user) {
        $hashedPassword = $user['password'];
        if (password_verify($_REQUEST[$password], $hashedPassword)) {
          $_SESSION['userId'] = $user['userId'];
        }
        else {
          return 'invalid password!';
        }
      }
      else {
        return 'email is not yet registered!';
      }
    }
  }
}

function verifyLogin() {
  if (!isset($_SESSION['userId'])) {
    header('location:index.php');
  }
  else {
    return getUser($_SESSION['userId']);
  }
}

function updateLast($userId, $week) {
  db_Query ("
  UPDATE user 
  SET lastAdded = :week
  WHERE userId = :userId",
  [
    'userId' => $userId,
    'week' => $week
  ]
  );
}
?>