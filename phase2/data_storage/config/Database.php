<?php
    require '/var/www/vendor/autoload.php';  
    // connect to mongodb

    class Database {
        // DB parameters
        private $servername = 'mongo-db';
        private $port = 27017;
        private $username = 'root';
        private $password= "pass";
        private $conn;
    
        public function connect(){
          //Connecting to MongoDB
          $this->conn = null;
          try {
          //Establish database connection
              $this->conn = new MongoDB\Client("mongodb://".$this->username.":".$this->password."@".$this->servername.":".$this->port."");
          }catch (Exception $e) {
            return "Connection to MongoDB Failed with Error: {$e}";
          }
          return $this->conn;
        }
      }

?>