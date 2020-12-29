<?php

    class Post{

        //DB stuff
        private $conn;
        private $table = 'posts';


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


    }