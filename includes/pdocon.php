<?php
class Pdocon {

    // CloudWays Database Information:
            private $host       = "localhost";
            private $user       = "xfhbbaqwxr";
            private $pass       = "V3K2XgpGtk";
            private $dbnm       = "xfhbbaqwxr";
    /*
    // Local Database Information:
            private $host       = "localhost";
            private $user       = "root";
            private $pass       = "";
            private $dbnm       = "app";
    */
    // Holds database connection:
        private $dbh;
    
    // Holds error messages:
        private $errmsg;
    
    // Handles error statements:
        private $stmt;
 
        
    // Method to open connection:

        public function __construct(){
        // Establishes dsn as MYSQL on localhost, and the database name.
        $dsn ="mysql:host=" . $this->host . "; dbname=" . $this->dbnm; 
    
        $options = array( 
        
        // Sets up database as a persistent connection.
        PDO::ATTR_PERSISTENT    => true,
            
        // Sets up database to show errors that are thrown.
        PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
            
        try {
        // Logs in using localhost username and password
        $this->dbh  = new PDO($dsn, $this->user, $this->pass, $options); 
            } catch(PDOException $error) {
            
                $this->errmsg = $error->getMessage();
                
                echo $this->errmsg;
            }
        }
    
        // Query function.
        public function query($query){
            
            $this->stmt = $this->dbh->prepare($query);
            
        }
    
        // Bind function.
        public function bindvalue($param, $value, $type){
            
        $this->stmt->bindValue($param, $value, $type);
        // Bindvalue will take in two arguments that you want to compare to test if data matches. Also takes in the datatype.
            
        // This would be used if you are trying to retrieve or put in values from the database. 
            
        // It is necessary because PHP needs a way of knowing which data is associated with which variable.
        }
        
        // Function to execute statement:
        public function execute(){
            
        return $this->stmt->execute();
        // Actually executes everything you've set up using the previous functions. 
            
        // It is always the last function you need in order to run SQL statements where you are inserting into the database.
        }

        // Function to check if statement was successfully executed:
        public function confirm_result(){
            
            $this->dbh->lastInsertId();
            // Checks the last item inserted to make sure that it was run properly. 
        }
        
        // Command to fetch data in a result set in associative array:
        public function fetchMultiple(){
            
        $this->execute();    
            
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);   
        // Fetches and returns all rows 
        }

        // Command count fetched data in a result set:
        public function fetchSingle(){
    
        $this->execute();    
            
        return $this->stmt->fetch(PDO::FETCH_ASSOC);    
        }
    
}    
?>