<?php
  include("include/connect.php");
  $result = db_Query("SHOW TABLES")->fetchAll();
  var_dump($result);
  // phpinfo();