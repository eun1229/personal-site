<?php
  include_once('include/init.php');
  $comments = db_Query("
    SELECT *
    FROM injection_test
  ")->fetchAll();

  echo "<h1>View all comments</h1>";

  foreach($comments as $comment){
    echo "
      <div><strong>('.htmlspecialchars($comment['name']).')</strong> '.htmlspecialchars($comment['comment']).'</div>
    ";
  }

?>