<?php

    class db{

        // Properties

        private $dbhost = 'localhost';

        private $dbuser = 'publifac_userbd';

        private $dbpass = 'Publifac2354#';

        private $dbname = 'publifac_sigop';



        // Connect

        public function connect(){

            $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";

            $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);

            $dbConnection -> exec("SET CHARACTER SET utf8");

            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $dbConnection;

        }

    }