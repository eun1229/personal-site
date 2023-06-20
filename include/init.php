<?php
  date_default_timezone_set('America/Chicago');
  session_start();

  include('include/connect.php');
  include('include/db_query.php');  
  include('include/daily_task_functions.php');
  include('include/helper.php');
  include('include/login_functions.php');
  include('include/signup_functions.php');