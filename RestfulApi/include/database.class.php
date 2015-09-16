<?php
 
/**
 * Handling database connection
 *
 */


class DbConnect {
 
    private $conn;
 
    function __construct() { 
    }

    function __destruct() {
        // closing db connection
        $this->close();
    }
 
    /**
     * Establishing database connection
     * @return database connection handler
     */
    function connect() {
        include_once dirname(__FILE__) . '/config.db.php';
 
        // Connecting to mysql database
        $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
 
        // Check for database connection error
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $this->conn->query("SET NAMES utf8"); 
        // returing connection resource
        return $this->conn;
    }

     function close() {
        // closing db connection
        // mysql_close();
    }
 
}
 
?>