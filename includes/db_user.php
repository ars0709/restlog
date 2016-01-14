<?php 

class dbUser {
	private $conn;
	function __construct() {
        require_once dirname(__FILE__) . '/db_connect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

	/* ------------- `users` table method ------------------ */
	/**
     * Creating new user
     * @param String $name User full name
     * @param String $email User login email id
     * @param String $password User login password
     */


	public function createUser($name, $email, $password,$comp) {
        require_once 'PassHash.php';
        $response = array();
        // First check if user already existed in db
        if (!$this->isUserExists($email)) {
            // Generating password hash
            $password_hash = PassHash::hash($password);
            // Generating API key
            $api_key = $this->generateApiKey();
            // insert query
            $stmt = $this->conn->prepare("INSERT INTO il_user(name, email, password_hash, api_key, status,il_company_acc) values(?, ?, ?, ?, 1,?)");
            $stmt->bind_param("sssss", $name, $email, $password_hash, $api_key,$comp);
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
        } else {
            // User with same email already existed in the db
            return 2;
        }

        return $response;
    }
    // cek user mail for login 
    public function checkLogin($email,$password){
        require_once 'PassHash.php';
        $stmt = $this->conn->prepare("SELECT password_hash FROM il_user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($password_hash);
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            // Found user with the email
            // Now verify the password
            $stmt->fetch();
            $stmt->close();
            if (PassHash::check_password($password_hash, $password)) {
                // User password is correct
                return TRUE ;
            } else {
                // user password is incorrect
                return FALSE;
            }
        } else {
            $stmt->close();
            // user not existed with the email
            return FALSE;
        }
    } 

    public function getUserByEmail($email){
       $stmt = $this->conn->prepare("SELECT name, email, api_key, status, created_at,il_company_acc FROM il_user WHERE email = ?");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            $rslt = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $rslt;
        } else {
            return false;
        }

    } 
    private function isUserExists($email) {
        $stmt = $this->conn->prepare("SELECT id from il_user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }
	private function generateApiKey() {
        return md5(uniqid(rand(), true));
    }
    public function isValidApiKey($api_key) {
        $stmt = $this->conn->prepare("SELECT id from il_user WHERE api_key = ?");
        $stmt->bind_param("s", $api_key);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }
    public function getUserId($api_key) {
        $stmt = $this->conn->prepare("SELECT name,email,il_company_acc FROM il_user WHERE api_key = ?");
        $stmt->bind_param("s", $api_key);
        if ($stmt->execute()) {
             $rslt = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $rslt;
        } else {
            return false;
        }
    }




}