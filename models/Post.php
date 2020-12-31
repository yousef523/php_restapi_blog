<?php

    class Post{

        //DB stuff
        private $conn;
        private $table = 'posts';
        // public $last_id = null;

        //Post properties


        //constructor with DB
        public function __construct($db)
        {
            $this->conn = $db;
        }

        //get posts
        public function read()
        {
            //create query
            $sql = "SELECT 
            c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_at
            FROM `posts` p
            LEFT JOIN `categories` c
            ON p.category_id = c.id ORDER BY p.created_at DESC";

            //prepare statement
            $stmt = $this->conn->prepare($sql);

            //excute query
            $stmt->execute();


            return $stmt;   
        }

        public function read_single()
        {
           //create query
           $sql = "SELECT 
           c.name as category_name,
           p.id,
           p.category_id,
           p.title,
           p.body,
           p.author,
           p.created_at
           FROM `posts` p
           LEFT JOIN `categories` c
           ON p.category_id = c.id
           WHERE p.id = ? 
           LIMIT 1
           ";

           //prepare statement
           $stmt = $this->conn->prepare($sql);

           //bind params
           $stmt->bindParam(1,$this->id);

          //excute query
          $stmt->execute();
         
          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          //set properties
          $this->title = $row['title'];
          $this->body = $row['body'];
          $this->author = $row['author'];
          $this->category_id = $row['category_id'];
          $this->category_name = $row['category_name'];

        //   $this->last_id = $this->conn->lastInsertId();
        
        }




    }