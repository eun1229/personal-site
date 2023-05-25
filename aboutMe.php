<?php
  include('include/init.php');
  echoHeader("About Me");
  $postInfo = getPost(1);
  // debugOutput($postInfo);
  echoPost($postInfo, 'title', 'body');
  echoFooter();
?>