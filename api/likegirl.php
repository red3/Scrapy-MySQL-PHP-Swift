<?php
 
/*
 * like a girl 
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/include/database.class.php'; 
 
// connecting to db
$db = new DbConnect();
$conn = $db->connect();
 

// id of the girl
$girlid = $_GET['girlid'];
if ($girlid == '' || !is_numeric($girlid)) {
    $response["code"] = 0;
    $response["msg"] = "oops, you need to tell me the girl's id";
     exit(json_encode($response));

}

// let the girl's startcount + 1
$result = $conn->query("UPDATE dbmeizi set startcount = startcount + 1 WHERE id = {$girlid}");

if ($result) {
    // check for empty result
    // success
    $response["code"] = 1;
    $response["msg"] = "success";


    echo json_encode($response);
} else {
    // no girl found
    $response["code"] = 0;
    $response["msg"] = "failed";
    echo json_encode($response);

}
    

?>