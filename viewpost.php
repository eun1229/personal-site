<?php
  include('include/init.php');
  $postId = $_GET['postId'];
  $postInfo = getPost($postId);
  echoHeader($postInfo['header']);
  // debugOutput($postInfo);
  echoPost($postInfo, 'title', 'body');
  echoFooter();
?>