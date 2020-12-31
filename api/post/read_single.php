<?php

  //Headers 
  header('Access-Control-Allow-Origin: *');
  header('Content-type:application-json');

  include_once('../../config/Database.php');
  include_once('../../models/Post.php');

  //init DB
  $db = new Database();
  $conn = $db->connect();

  //init post class
  $post = new Post($conn);

  //init id 
  $post->id = isset($_GET['id']) ? $_GET['id'] : die();
  

  $post->read_single();


  $post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name
    );
// echo $post->last_id;
print_r(json_encode($post_arr));