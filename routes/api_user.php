<?php 

ini_set('display_errors','on');


/**
 * User Registration
 * url - /register
 * method - POST
 * params - name, email, password
 */
$app->post('/register', function() use ($app) {
	// check for required params
	$requiredfields = array('name','email','password','company');
	$req = $_REQUEST;

	if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $req);
    }

  // validate required fields
	if(!RequiredFields($req, $requiredfields)){
		return false;
	}

	$name =$req['name'];
	$email = $req['email'];
	$password = $req['password'];
	$company=$req['company']
	if(validateEmail($email)){
		return false;
	}else{
		$db = new dbUser();
		 $res=$db->createUser($name,$email,$password,$company);
		if ($res==0){
			response('Failed to register','register', 'failed',true);
		}elseif ($res==1) {
			response('Register Success','register', 'success',false);
		}else{
			response('User name already exists','register', 'failed',true);
		}

	}	
	return true;
});

/**
 * User Login
 * url - /login
 * method - POST
 * params - email, password
 */
$app->post('/login', function() use ($app) {
	$requiredfields = array('email','password');
	$req = $_REQUEST;
	if(!RequiredFields($req, $requiredfields)){
		return false;
	}
	$email=$req['email'];
	$password=$req['password'];
	$db = new dbUser();
	$res=$db->checkLogin($email,$password);
	if ($res==0){
			response('Failed to Login','Login', 'failed',true);
			return false;
	}elseif ($res==1) {
			$res=$db->getUserByEmail($email);
			if ($res==0){
				response('login failed','Login', 'Failed',true);	
			}else{
				response($res,'Login', 'Success',false);	
			}
		}
		return true;
});
