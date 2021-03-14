<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json; charset:utf-8');
header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

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
	$postdata    = file_get_contents("php://input");
    if(isset($postdata) && !empty($postdata)){
	   	$result     = json_decode($postdata,true);
	    responseHandler('get Successfully',$result);
    }
}

function verify($data){
	$postdata    = file_get_contents("php://input");
    if(isset($postdata) && !empty($postdata)){
	   	$result     = json_decode($postdata,true);
	    responseHandler('get Successfully',$result);
    }
}

?>