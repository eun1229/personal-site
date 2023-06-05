<?php
  function getAllPosts() {
    $posts = db_Query("
      SELECT * 
      FROM post
      ORDER BY datePublished DESC
    ") -> fetchAll();

    return $posts;
  }

  function getPost($postId) {
    $post = db_Query("
      SELECT * 
      FROM post
      WHERE postId = $postId
    ") -> fetch();

    return $post;
  }


