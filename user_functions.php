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
?>
