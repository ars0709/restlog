<?php
ini_set('display_errors','on');
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

require 'Slim/Middleware/jsonP.php';
require 'Slim/Middleware/bitConvert.php';
require 'Slim/Extras/Middleware/HttpBasicAuthRoute.php';

session_cache_limiter(false);

$app = new \Slim\Slim(array(
	'debug' => true
));
//includes for configurations
// require_once 'includes/db_config.php';
require_once 'includes/db_user.php';
require_once 'includes/db_exists.php';
require_once 'includes/db_company.php';
require_once 'includes/db_uom.php';
require_once 'includes/errorCodes.php';
//include the routes
require_once 'routes/api_user.php';
require_once 'routes/api_company.php';
require_once 'routes/api_uom.php';
require_once 'routes/site.php';
require_once 'routes/functions.php';


$user_id = {};

/**
 * Adding Middle Layer to authenticate every request
 * Checking if the request has valid api key in the 'Authorization' header
 */
function authenticate(\Slim\Route $route) {
    // Getting request headers
    $headers = apache_request_headers();
    $response = array();
    $app = \Slim\Slim::getInstance();
    // Verifying Authorization Header
    if (isset($headers['Authorization'])) {
        $db = new dbUser();
        // get the api key
        $api_key = $headers['Authorization'];
        // validating api key
        if (!$db->isValidApiKey($api_key)) {
            // api key is not present in users table
            response('Invalid user ','Authorization', 'failed',true);
            $app->stop();
        } else {
            global $user_id;
            // get user primary key id
            $user_id = $db->getUserId($api_key);
        }
    } else {
        // api key is missing in header
        response('Api Key is missing ','Authorization', 'failed',true);
        $app->stop();
    }
}

//run slim
$app->add(new \Slim\Middleware\JSONPMiddleware());
$app->add(new \Slim\Middleware\BitConvertMiddleware());
$app->contentType('application/json');
$app->run();
?>
