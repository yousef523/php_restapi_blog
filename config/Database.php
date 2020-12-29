<?php

    class Database{

        private $conn;
        private $host = 'localhost';
        private $dbname = 'myblog';
        private $username = 'root';
        private $password = '';


        public function connnect()
        {
            $this->conn = null;

            try {
                $this->conn = new PDO('localhost=' . $host .';dbname=' . $dbname ,$username,$password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'connnection error' . $e->getMessage();
            }

            return $this->conn;
        }

    }