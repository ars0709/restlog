<?php 

class dbExists {
	private $conn;
	function __construct() {
        require_once dirname(__FILE__) . '/db_connect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

	/* ------------- Cek table if exist------------------ */
	
    public function isDataExists($qry) {
        $stmt = $this->conn->prepare($qry);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }
	
}