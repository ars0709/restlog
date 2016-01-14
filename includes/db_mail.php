<?php 

class dbMail {

	private $conn;
	function __construct() {

        require_once dirname(__FILE__) . '/db_connect.php';
        require_once dirname(__FILE__) . '/mail/class.phpmailer.php';
        require_once dirname(__FILE__) . '/mail/class.smtp.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    public function setupMail($fields) {
    	
    	 $response = array();
        $qry="INSERT INTO il_mail_setup (
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

}
