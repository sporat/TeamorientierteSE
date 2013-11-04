<?php
    /*define('mysqlhost', 'localhost'); 
    define('mysqluser', 'admin'); 
    define('mysqlpassword', 'admin'); 
    define('mysqldatabase', 'testdatenbank');
    */
    
    define('mysqlhost', 'localhost'); 
    define('mysqluser', 'eule'); 
    define('mysqlpassword', 'teamseminar'); 
    define('mysqldatabase', 'testdatenbank');
    
    class DBConnection {

        private $connection;
         
        public function __construct() {
            //$connStr = "'mysqlhost', 'mysqluser', 'mysqlpassword'";
            $this->connection = mysql_connect(mysqlhost, mysqluser, mysqlpassword);
            //mysql_select_db(mysqldatabase, mysqlhost) or die("Datenbank existiert nicht");
            if($this->connection) {
                echo "geht";
            } else echo "geht nicht";
        }
        public function __destruct() {
            if (is_resource($this->connection)) {
                mysql_close($this->connection);
            }
        }
        public function getConnection() {
            return $this->connection;
        }
    } 
?>