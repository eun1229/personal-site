<?php
  // function getAllPosts() {
  //   $posts = array(
  //     1 => [
  //       'Id' => 1,
  //       'DateCreated' => '5/24/23',
  //       'Title' => 'About Me',
  //       'Author' => 'Grace Lee',
  //       'Body' => 'Here is some information about me',
  //     ], 
  //     2 => [
  //       'Id' => 2,      
  //       'DateCreated' => '5/24/23',
  //       'Title' => 'My Thoughts About the Weather',
  //       'Author' => 'Grace Lee',
  //       'Body' => 'Here is some information about the weather',
  //     ],
  //     3 => [
  //       'Id' => 3,      
  //       'DateCreated' => '5/24/23',
  //       'Title' => 'My Favorite Recipes',
  //       'Author' => 'Grace Lee',
  //       'Body' => 'I want to learn how to cook, here are some of my favorite recipes',
  //     ], 
  //     4 => [
  //       'Id' => 4,      
  //       'DateCreated' => '5/24/23',
  //       'Title' => 'Favorite Places to Go on Walks',
  //       'Author' => 'Grace Lee',
  //       'Body' => 'I love going on walks. Here are some of my favorite places 
  //        I"ve been on walks and a , and a list of places I still want to go on walks',
  //     ], 
  //   );
  //   return $posts;
  // }

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


