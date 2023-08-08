<?php
  include_once('include/init.php');
  $errormessage='';
  if (isset($_REQUEST['submitted'])) {
    if ($_REQUEST['password'] != $_REQUEST['repeatpassword']) {
      $errormessage = "passwords do not match";
    }
    else if(sizeof(verifyEmail($_REQUEST['email'])) != 0) {
      echo "email is already in use";
    }
    else {
      insertUser($_REQUEST['name'], $_REQUEST['lastname'], $_REQUEST['email'], $_REQUEST['password']);
      $_SESSION['msg'] = "Registration was successful, you may now login";
      header('location: index.php');
    }
  }
?>
<html>
  <head>
    <link rel="stylesheet" href="login_style.css"/>
    <link rel="stylesheet" href="login_style.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Borel&family=Inter:wght@300;400;500&family=Mulish:wght@300;400&family=David+Libre&display=swap" rel="stylesheet">
    <title>Sign Up</title>
    <nav>
      <div style='padding-top: 10px; padding-bottom: 10px; padding-left: 30px; background-color: #FFFFFF; height: 45px'>List</div>
    </nav>
  </head>
  <body style= 'background-image: none; background-color: #FBFAFA; margin: 0px 0px 0px 0px'>
    <div class='signupbody'>
      <div class='signupleft'>
        <h2 class='createaccount'>Create a List account</h2>
        <p style='width: 45%; text-align: center; margin-top: 7.5px; font-family: "Inter"; font-size:0.9rem; color:'>Enter the following information to create an account. It's free!</p>
        <img class='manpointing' src='signupleft.svg'>
      </div>
      <div class='signupright'>
        <div style='width:85%'>
          <form action="" method="post" class = 'signupform'>
            <div style='width: 100%'>
              <div style = 'text-align: left;'>
                <p style = 'font-weight: 500; margin-top: 5px; font-size: 1.1rem;'>Name</p>
              </div>
              <input type="text" name="name" class="textboxes" style="width:100%; height: 50px; font-weight: 500" required><br>
            </div>
            <div style='width: 100%'>
              <div style = 'text-align: left'>
                <p style = 'font-weight: 500; margin-top: 5px; font-size: 1.1rem;'>Last Name</p>
              </div>
              <input type="text" name="lastname" class="textboxes" style="width:100%; height: 50px; font-weight: 500" required><br>
            </div>
            <div style='width: 100%'>
              <div style = 'text-align: left'>
                <p style = 'font-weight: 500; margin-top: 5px; font-size: 1.1rem;'>Email</p>
              </div>
              <input type="email" name="email" class="textboxes" style="width:100%; height: 50px; font-weight: 500" required><br>
            </div>
            <div style='width: 100%'>
              <div style = 'text-align: left'>
                <p style = 'font-weight: 500; margin-top: 5px; font-size: 1.1rem;'>Password</p>
              </div>
              <input type="password" name="password" class="textboxes" style="width:100%; height: 50px; font-weight: 500" required><br>
            </div>
            <div style='width: 100%'>
              <div style = 'text-align: left'>
                <p style = 'font-weight: 500; margin-top: 7.5px; font-size: 1.1rem;'>Repeat Password</p>
              </div>
              <input type="password" name="repeatpassword" class="textboxes" style="width:100%; height: 50px; font-weight: 500" required><br>
            </div>
            <div style='width: 100%'>
              <button type="submit" name="submitted" class="createaccountbutton">Create account</button>
            </div>
            <div><?php echo($errormessage) ?></div>
            <div>
              <p class="signuptext" style="margin-top: 1px">Already have an account? <a href = index.php>Sign in here.</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>