<?php 

class dbCompany {
	private $conn;
	function __construct() {
        require_once dirname(__FILE__) . '/db_connect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

	/* ------------- `il_company` table method ------------------ */
	public function createCompany($fields) {
        $response = array();
        $qry="INSERT INTO il_company (
						il_company_acc,
						il_company_name,
						il_company_addr1,
						il_company_addr2,
						il_company_cityId,
						il_company_post,
						il_company_email,
						il_company_phone,
						il_company_contact,
						il_company_fax,
						il_company_notes) 
					values (?,?,?,?,?,?,?,?,?,?,?)";
	    $stmt = $this->conn->prepare($qry);
	    $stmt->bind_param("sssssssssss", $fields['il_company_acc'],
						$fields['il_company_name'],
						$fields['il_company_addr1'],
						$fields['il_company_addr2'],
						$fields['il_company_cityId'],
						$fields['il_company_post'],
						$fields['il_company_email'],
						$fields['il_company_phone'],
						$fields['il_company_contact'],
						$fields['il_company_fax'],
						$fields['il_company_notes']);
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
    
    // public function getCompanyByAccount($account){
    //    $stmt = $this->conn->prepare("SELECT * FROM il_company WHERE acc = ?");
    //     $stmt->bind_param("s", $email);
    //     if ($stmt->execute()) {
    //          $rslt = $stmt->get_result()->fetch_assoc();
    //         // $stmt->bind_result();
    //          // $rslt=$stmt;   
    //         $stmt->close();
    //         return $rslt;
    //     } else {
    //         return false;
    //     }

    // } 

}