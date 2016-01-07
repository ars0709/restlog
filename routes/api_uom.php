<?php 

ini_set('display_errors','on');


/**
 * UOM
 * url - /uom
 * method - POST
 * params - uom_
 */
$app->post('/uom', 'authenticate',function() use ($app) {
	// check for required params
	$requiredfields = array('uom_id','uom_desc','company_acc');
	$req = $_REQUEST;
	if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $req);
    }
  	// validate required fields
	if(!RequiredFields($req, $requiredfields)){
		return false;
	}

	$data = array('il_uom_id' =>$req['uom_id'] ,
		'il_uom_desc' =>$req['uom_desc'] ,
		'il_company_acc' =>$req['company_acc'] 
	 );

	$db = new dbExists();
	$res=$db->isDataExists("select il_uom_id from il_uom where il_uom_id='".$$req['uom_id']."' and il_company_acc='".$req['company_acc']."'");
	if ($res>0){
		response('Data already exists','UOM', $fa,true);
		return false;
	}else{
		$db=new dbUom();
		$res=$db->createUOM($data);
		if ($res==0){
			response('Failed to insert UOM Data','UOM', $fa,true);
		}elseif ($res==1) {
			response('Insert UOM Success','UOM', $su,false);
		}
	}				

	
	return true;
});
