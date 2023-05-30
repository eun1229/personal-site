<?php
  include_once('include/init.php');

  $postId = $_GET['postId'];
  $postInfo = getPost($postId);

  echoHeader($postInfo['header']);
  echoPost($postInfo, 'title', 'body');
  $errors = [];

  if (isset($_REQUEST['isSubmitted'])) {
    if ($_REQUEST['body'] == '') {
      $errors['comment'] = 'COMMENT REQUIRED';
    }
    if ($_REQUEST['name'] == '') {
      $errors['comment'] = 'NAME REQUIRED';
    }
    if ($_REQUEST['body'] == '' && $_REQUEST['name'] == '') {
      $errors['comment'] = 'NAME AND COMMENT REQUIRED';
    }
    if (sizeof($errors) === 0) {
      insertComment($_REQUEST['body'], $postId, $_REQUEST['name']);
      header('location: ?postId='.$_REQUEST['postId']);
      exit;
    }
  }

  echoCommentsInput($errors, 'comment');
  $comments = getCommentsForPost($postId);

  echo "
  <div class='displaycomments'>
  <details>
    <summary>click to view all comments</summary>
    <div class='allcomments'>
  ";

  foreach ($comments as $comment) {
    echo "<p class='commentname'>$comment[name]<br></p>";
    echo "<p class='commentbody'>$comment[body]<br></p>";
  }

  echo "
  </div>
  </details>
  </div>
  ";

  echoFooter();
?>