<?php
  include('include/init.php');
  echoHeader("Recipes");
  $postInfo = getPost(3);
  echoPost($postInfo, 'title', 'body');
  echoFooter();
?>
