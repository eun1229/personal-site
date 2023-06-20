<?php
  function verifyEmail($email){
    return db_Query("
    SELECT * 
    FROM user
    WHERE email='$email';
    ") -> fetchAll();
  }

  function insertUser($name, $lastname, $email, $password) {
    db_Query("
      INSERT INTO user (firstName, lastName, email, dateCreated, password) 
      VALUES (:name, :lastname, :email, NOW(), :password)", 
      [
      'name' => $name,
      'lastname' => $lastname,
      'email' => $email,
      'password' => password_hash($password, PASSWORD_BCRYPT),
      ]);
  }
?>