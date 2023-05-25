<?php
  include('include/init.php');
  echoHeader("Weather");
  $postInfo = getPost(2);
  echoPost($postInfo, 'title', 'body');
  echoFooter();
?>