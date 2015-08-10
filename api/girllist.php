<?php
 
/*
 * get girl list 
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/include/database.class.php'; 
 
// connecting to db
$db = new DbConnect();
$conn = $db->connect();

if ($_GET['ishot']) {
    // hot girl

}
 
// 默认页数
$size = 10;

$page = $_GET['p'];
if ($page == '' || !is_numeric($page)) {
    $page = 0;
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
echo $sql;
$result = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
if (!empty($result)) {

    // check for empty result
    // success
    $response["code"] = 1;
    $response["msg"] = "success";
    $response["list"] = $result;
    echo json_encode($response);
} else {
    // no girl found
    $response["code"] = 0;
    $response["msg"] = "No girl found";
    $response["list"] = array();
    echo json_encode($response);

}
    

?>