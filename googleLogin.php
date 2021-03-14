<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json; charset:utf-8');
header ("Access-Control-Expose-Headers: Content-Length, X-JSON");
header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: Content-Type, Authorization, Accept, Accept-Language, X-Authorization");
header('Access-Control-Max-Age: 86400');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // The request is using the POST method
    header("HTTP/1.1 200 OK");
    return;

}

require_once('constant.php');
require_once('langConstant.php');
require_once('functions.php');

$action = isset($_REQUEST['action'])?trim($_REQUEST['action']) : ''; 



switch ($action){
    case 'request':
        request($_REQUEST);
        break;
    case 'verify':
        verify($_REQUEST);
        break;
    default:
    errorHandler('Unknown Request',INV_REQ);
}

function request($data){
    if(isset($data) && !empty($data)){
	    responseHandler('get Successfully',$data);
    }
}

function verify($data){
    if(isset($data) && !empty($data)){
	    responseHandler('get Successfully',$data);
    }
}

?>