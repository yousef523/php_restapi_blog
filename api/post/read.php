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

  $result = $post->read();
  $num = $result->rowCount();

  if($num > 0){

    //posts array
    $posts_arr = array();
    $posts_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => $body,
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        );
        
        //push to "data"
        array_push($posts_arr['data'],$post_item);
    }

    //turn into JSON & output
    // print_r($posts_arr);
    echo json_encode($posts_arr);

  } else {
    echo json_encode(
        array('message'=>'No Posts Found')
    );
  }