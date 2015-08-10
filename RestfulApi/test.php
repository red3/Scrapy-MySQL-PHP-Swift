<?php

require '../libs/Slim/Slim.php';
require_once __DIR__ . '/include/database.class.php'; 

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// connecting to db
$db = new DbConnect();
$conn = $db->connect();

$app->get('/girls', function () use ($app, $conn) {
    $page = $app->request->get('p');
    if ($page == '' || !is_numeric($page)) {
   		$page = 0;
   	}
    var_dump($name);
});

$app->get('/girls/:girlid', function ($girlid) use ($app, $conn) {
	if ($girlid == '' || !is_numeric($girlid)) {
    	$response["code"] = 0;
    	$response["msg"] = "oops, you need to tell me the girl's id";
     	exit(json_encode($response));
	}

	// let the girl's startcount + 1
	$result = $conn->query("UPDATE dbmeizi set startcount = startcount + 1 WHERE id = {$girlid}");

	if ($result) {
    	// success
		$response["code"] = 1;
		$response["msg"] = "success";
		echo json_encode($response);
		exit();
	} else {
    	// no girl found
		$response["code"] = 0;
		$response["msg"] = "failed";
		echo json_encode($response);
		exit();
	}
});


$app->run();
