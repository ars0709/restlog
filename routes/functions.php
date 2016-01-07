<?php


/**
 * Validating email address
 */
function validateEmail($email) {
    $app = \Slim\Slim::getInstance();
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       errorMessage('Email not validate','email');
        return 0;
    }
}
function RequiredFields($getvars, $requiredfields,$echoErr = true) {
	$error_fields='';
	if(count($getvars)< count($requiredfields)){
		$error = implode(",",$requiredfields);

	    if($echoErr){
	      errorMessage(errorCode::$generic_param_missing.$error,errorCode::$generic_param_missing_code);
	    }
		//die();
		return 0;
	}
	// echo json_encode(array(
	// 	$getvars
	// ));
	

	foreach ($requiredfields as $field) {
        if (!isset($getvars[$field]) || strlen(trim($getvars[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }


	if(isset($error) && $echoErr){
		errorMessage(errorCode::$generic_param_missing.$error_fields,errorCode::$generic_param_missing_code);
		//die();
		return 0;
	}
	return 1;
}

//error message helper
function errorMessage($message,$errorcode =1) {
	echo json_encode(array(
		'error' => 1,
		'errorCode' => $errorcode,
		'message' => $message
	));
}

function response($message,$type, $typeMessage,$err){
	if ($err){
	echo json_encode(array(
		's' => 0,
		$type => $typeMessage,
		'message' => $message
	));
	}else{
		echo json_encode(array(
		's' => 1,
		$type => $typeMessage,
		'message' => $message
	));

	
	}
	
}
?>
