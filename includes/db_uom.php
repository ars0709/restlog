<?php 
/**
* 
*/
class dbUom 
{
	private $conn;
	function __construct() {
        require_once dirname(__FILE__) . '/db_connect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    	/* ------------- `uom` table method ------------------ */
    	// creating uom 



	public function createUOM($fields) {
        $response = array();
        $qry="INSERT INTO il_uom (
						il_uom_id,
						il_company_acc,
						il_uom_desc) 
					values (?,?,?)";
	    $stmt = $this->conn->prepare($qry);
	    $stmt->bind_param("sss",
						$fields['il_uom_id'],
						$fields['il_company_acc'],
						$fields['il_uom_desc']);
	    $result = $stmt->execute();
	    $stmt->close();
	    // Check for successful insertion
	    if ($result) {
	        // User successfully inserted
	        return $result;
	    } else {
	        // Failed to create user
	        return 0;
	    }
        return $response;
    }
    public function updateUOM($fields) {
        $response = array();
        $qry="UPDATE il_uom set il_uom_desc=? WHERE il_uom_id =? AND il_company_acc=?";

	    $stmt = $this->conn->prepare($qry);
	    $stmt->bind_param("sss",
						$fields['il_uom_desc'],
						$fields['il_uom_id'],
						$fields['il_company_acc']);
	    $result = $stmt->execute();
	    $stmt->close();
	    // Check for successful insertion
	    if ($result) {
	        // User successfully inserted
	        return $result;
	    } else {
	        // Failed to create user
	        return 0;
	    }
        return $response;
    }

	public function deleteUOM($fields) {
        $response = array();
        $qry="DELETE FROM il_uom  WHERE il_uom_id =? AND il_company_acc=?";

	    $stmt = $this->conn->prepare($qry);
	    $stmt->bind_param("ss",
						$fields['il_uom_id'],
						$fields['il_company_acc']);
	    $result = $stmt->execute();
	    $stmt->close();
	    // Check for successful insertion
	    if ($result) {
	        // User successfully inserted
	        return $result;
	    } else {
	        // Failed to create user
	        return 0;
	    }
        return $response;
    }


}