<?php

require '../libs/Slim/Slim.php';
require_once '../include/database.class.php'; 

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

// connecting to db
$db = new DbConnect();
$conn = $db->connect();

/**
 * Echoing json response to client
 * @param String $status_code Http response code
 * @param Int $response Json response
 */
function echoRespnse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);
 
    // setting response content type to json
    $app->contentType('application/json');
 
    echo json_encode($response);
}

// get
$app->get('/girls', function () use ($app, $conn) {
    $page = $app->request->get('p');
    // let the default page be 0
    if ($page == '' || !is_numeric($page)) {
   		$page = 0;
   	}
   	$size = $app->request->get('size');
   	// let the default size be 10
   	if ($size == '' || !is_numeric($size)) {
   		$size = 10;
   	}
   	$start = $size * intval($page);
 
	// get girl list from table
   	if ($_GET['ishot']) {
    // hot girl
   		$sql = "SELECT * FROM meizi WHERE 1 = 1 ORDER BY star_count DESC, id DESC LIMIT {$start}, {$size} ";
   	} else {
    // new girl
   		$sql = "SELECT * FROM meizi WHERE 1 = 1 ORDER BY id DESC LIMIT {$start}, {$size}";
   	}

   	$result = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
   	if (!empty($result)) {

    // check for empty result
    // success
   		$response["code"] = 1;
   		$response["msg"] = "success";
   		$response["list"] = $result;
   		echoRespnse(200, $response);
   	} else {
    // no girl found
   		$response["code"] = 0;
   		$response["msg"] = "No girl found";
   		$response["list"] = array();
   		echoRespnse(200, $response);

   	}
});

// put
$app->put('/girls/:girlid', function ($girlid) use ($app, $conn) {
	if ($girlid == '' || !is_numeric($girlid)) {
    	$response["code"] = 0;
    	$response["msg"] = "oops, you need to tell me the girl's id";
     	exit(json_encode($response));
	}

	// let the girl's star_count + 1
	$result = $conn->query("UPDATE meizi set star_count = star_count + 1 WHERE id = {$girlid}");

	if ($result) {
    	// success
		$response["code"] = 1;
		$response["msg"] = "success";
		echoRespnse(200, $response);
	} else {
    	// no girl found
		$response["code"] = 0;
		$response["msg"] = "failed";
		echoRespnse(200, $response);
	}
});


$app->run();
