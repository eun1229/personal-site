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
    db_Query(
      "INSERT INTO user (firstName, lastName, email, dateCreated, password, username) 
      VALUES ('$name', '$lastname', '$email', NOW(), '$password', '$username')
    ");
  }

//   function verifyLogin() {
//     if (isset($_REQUEST['enter'])) {
//       if ($_REQUEST['password'] == '' || $_REQUEST['username'] == '') {
//         echo 'USERNAME AND PASSWORD REQUIRED';
//         exit;
//       }
//       else {
//         $user = getUserFromInput($_REQUEST['username'], $_REQUEST['password']);
//         if ($user) {
//           $_SESSION['userId'] = $user['userId'];
//           exit;
//         }
//         else {
//           echo "invalid username and password";
//           exit;
//         }
//       }
//     }
//     if (isset($_SESSION['userId'])) {
//       return $thisUser = getUser($_SESSION['userId']);
//       exit;
//     }
// }
