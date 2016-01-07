<?php
/**
 * Insert Company
 * url - /company
 * method - POST
 * Parameters
 * 		@name 
 * 		@address1
 * 		@address2 
 * 		@city 
 * 		@post 
 * 		@email 
 * 		@phone 
 * 		@contact 
 * 		@notes
 */
$app->post('/company', function() use ($app) {
	// check for required params
	$requiredfields = array('name','address1','city');
	$req = $_REQUEST;
	if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $req);
    }
  	// validate required fields
	if(!RequiredFields($req, $requiredfields)){
		return false;
	}
// il_company_acc
// il_company_name
// il_company_addr1
// il_company_addr2
// il_company_cityId
// il_company_post
// il_company_email
// il_company_phone
// il_company_contact
// il_company_fax
// il_company_notes

	if (isset($req['name'])){$name =$req['name'];}else{$name='-';}
	$acc=mt_rand(100000,999999);
	if (isset($req['address1'])){$address1 =$req['address1'];}else{$address1='-';}
	if (isset($req['address2'])){$address1 =$req['address2'];}else{$address2='-';}
	if (isset($req['city'])){$city =$req['city'];}else{$city='-';}
	if (isset($req['post'])){$post =$req['post'];}else{$post='-';}
	if (isset($req['email'])){$post =$req['email'];}else{$email='-';}
	if (isset($req['phone'])){$post =$req['phone'];}else{$phone='-';}
	if (isset($req['contact'])){$post =$req['contact'];}else{$contact='-';}
	if (isset($req['fax'])){$post =$req['fax'];}else{$fax='-';}
	if (isset($req['notes'])){$post =$req['notes'];}else{$notes='-';}
	
	$data = array('il_company_acc' =>$acc ,
		'il_company_name' =>$name ,
		'il_company_addr1' => $address1,
		'il_company_addr2' =>$address2 ,
		'il_company_cityId' =>$city ,
		'il_company_post' => $post,
		'il_company_email' => $email,
		'il_company_phone' =>$phone ,
		'il_company_contact' => $contact,
		'il_company_fax' => $fax,
		'il_company_notes' => $notes
	 );

	$db = new dbExists();
	$res=$db->isDataExists("select il_company_acc from il_company where il_company_name='".$name."'");
	if ($res>0){
		response('Data already exists','company', $fa,true);
		return false;
	}else{
		$db=new dbCompany();
		$res=$db->createCompany($data);
		if ($res==0){
			response('Failed to Company Data','company', $fa,true);
		}elseif ($res==1) {
			response('Insert Company Success','company', $su,false);
		}
	}				


	
	return true;
});


