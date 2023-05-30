<?php

  function getCommentsForPost($postId) {
    return db_Query("
      SELECT * 
      FROM comments 
      WHERE postId=$postId;
    ") -> fetchAll();
  }

  function insertComment($body, $postId, $name) {
    db_Query("
    INSERT INTO comments (postId, body, dateCommented, name)
    VALUES ($postId, '$body', NOW(), '$name')
    ") -> fetch();
  }