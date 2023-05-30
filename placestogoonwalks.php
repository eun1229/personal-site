<?php
  include('include/init.php');
  echoHeader("Walk Locations");
  $postInfo = getPost(4);
  echoPost($postInfo, 'title', 'body');
  echoFooter();
?>