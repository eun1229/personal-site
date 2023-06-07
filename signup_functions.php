<?php
  function verifyUsername($username){
    return db_Query("
    SELECT * 
    FROM user
    WHERE username='$username';
    ") -> fetchAll();
  }

  function verifyEmail($email){
    return db_Query("
    SELECT * 
    FROM user
    WHERE email='$email';
    ") -> fetchAll();
  }

  function insertUser($name, $lastname, $username, $password, $email) {
    db_Query("
    INSERT INTO user(firstName, lastName, email, dateCreated, password, username) 
    VALUES ('$name', '$lastname', '$email', TIME(), '$password', '$username')
    ") -> fetch();
  }