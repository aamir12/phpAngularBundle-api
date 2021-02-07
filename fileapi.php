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
require_once('db.php');
require_once('libs/validation.php');
require_once('libs/jwt.php');
require_once('model/emp_mdl.php');
require_once('model/auth_mdl.php');
  
$data    = file_get_contents("php://input");
if(isset($data) && !empty($data)){
  $data = json_decode($data,true);
  $action = $data['action'];
  unset($data['action']);
  if($action==="addProfile"){
    addProfile($data);
  }else
  if($action==="allAuthor"){
    allAuthor();
  }
  if($action==="addEmployee"){
    addEmployee($data);
  }else
  if($action==="editEmployee"){
    editEmployee($data);
  }else
  if($action==="allEmployee"){
    allEmployee();
  }else
  if($action==="getEmployee"){
    getEmployee($data);
  }else
  if($action==="deleteEmployee"){
    deleteEmployee($data);
  }else
  if($action==="addEmpDocument"){
    addEmpDocument($data);
  }else
  if($action ==="getEmployeeDoc"){
    getEmployeeDoc($data);
  }else
  if($action==="updateEmployeeDoc"){
    updateEmployeeDoc($data);
  }else
  if($action==="deleteAllEmployeeDoc"){
    deleteAllEmployeeDoc($data);
  }else
  if($action==="infinitScroll"){
    infinitScroll($data);
  }else{
    errorHandler('Unknown Request',INV_REQ);
  }
}else{
  errorHandler('Unknown Request11',INV_REQ);
}
   
 
function addProfile($data){
    setupReq('POST');
    $filename = 'default.jpg';
    if(isset($data['image'])){
        $image_parts = explode(";base64,", $data['image']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $filename = uniqid() . '.'.$image_type;
        $file = 'uploads/' . $filename;
        file_put_contents($file, $image_base64);
    }
    $data['image'] = $filename;
    $author = new auth_mdl();
    $result = $author->addProfile($data);
    if($result){
      responseHandler('Register Successfully',['id'=>$result]);
    }else{
      errorHandler('Server Error',INV_REQ);
    }
}

function allAuthor(){
  $author = new auth_mdl();
  $result = $author->allAuthor();
  responseHandler('success',$result);
}

function addEmployee($data){
  
  $addressDetails= [];
  if(isset($data['addressDetails'])){
    $addressDetails = $data['addressDetails'];
    unset($data['addressDetails']);
  }
  $emp = new emp_mdl();
  $result = $emp->createEmp($data,$addressDetails);
  responseHandler('success',$result);
}

function editEmployee($data){
  $addressDetails= [];
  $id = $data['id'];
  if(isset($data['addressDetails'])){
    $addressDetails = $data['addressDetails'];
    unset($data['addressDetails']);
  }
  unset($data['id']);
  $emp = new emp_mdl();
  $result = $emp->updateEmp($id,$data,$addressDetails);
  responseHandler('success',$result);
}

function allEmployee(){
  $emp = new emp_mdl();
  $result = $emp->allEmp();
  responseHandler('success',$result);
}

function deleteEmployee($data){
  if(isset($data['id'])){
    $emp = new emp_mdl();
    $result = $emp->deleteEmp($data['id']);
    responseHandler('success',$result);
  }else{
    errorHandler('No data found',NOT_FOUND,404);
  }
  
}

function getEmployee($data){
  $id = $data['id'];
  $emp = new emp_mdl();
  $result = $emp->singleEmp($id);
  if($result){
    responseHandler('success',$result);
  }else{
    errorHandler('No data found',NOT_FOUND,404);
  }
}

function addEmpDocument($allData){

  $docArray = [];
  if(isset($allData['documentDetails'])){
    $docArray = $allData['documentDetails'];
    unset($allData['documentDetails']);
  }
  $emp_mdl = new emp_mdl();
  $docArr = [];
  
  foreach ($docArray as $data) {
    if($data['image']!=''){
      $image_parts = explode(";base64,", $data['image']);
      $image_type_aux = explode("image/", $image_parts[0]);
      $image_type = $image_type_aux[1];
      $image_base64 = base64_decode($image_parts[1]);
      $data['image'] =  uniqid() . '.'.$image_type;
      $file = 'uploads/documents/' .$data['image'];
      file_put_contents($file, $image_base64);
      $docArr[] = $data;
      
    }
  }
  $empid = $emp_mdl->createEmp2($allData,$docArr);
  responseHandler('success',$empid);
}

function getEmployeeDoc($data){
  $id = $data['id'];
  $emp = new emp_mdl();
  $result = $emp->singleEmp2($id);
  if($result){
    responseHandler('success',$result);
  }else{
    errorHandler('No data found',NOT_FOUND,404);
  }
}

function updateEmployeeDoc($allData){
  $id = $allData['id'];
  $dataArray = [];
  $preDocArray = [];
  if(isset($allData['documentDetails'])){
    $dataArray = $allData['documentDetails'];
    $preDocArray = $allData['tempDocDetails'];
    unset($allData['documentDetails']);
    unset($allData['tempDocDetails']);
  }
  
  $allFileNames = [];
  $i = 0;
  foreach ($dataArray as $data) {
    if($data['image']!='' && strpos($data['image'],";base64,")){
        $image_parts = explode(";base64,", $data['image']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName =  uniqid() . '.'.$image_type;
        $file = 'uploads/documents/' .$fileName;
        file_put_contents($file, $image_base64);
        $data['image'] = $fileName;
        if(isset($data['id']) && isset($preDocArray[$i]['image'])){
          @unlink('uploads/documents/' .$preDocArray[$i]['image']);
        }
        $i++;
    }
    array_push($allFileNames,$data); 
  }
  unset($allData['id']);
  $emp = new emp_mdl();
  $result = $emp->updateEmp2($id,$allData,$allFileNames);
  responseHandler('success',$result);
}

function deleteAllEmployeeDoc($data){
  if(isset($data['id'])){
    $emp = new emp_mdl();
    $allDocs = $emp->getAllDocs($data['id']);
    foreach($allDocs as $doc){
      @unlink('uploads/documents/' .$doc['image']);
    }
    $result = $emp->deleteEmp2($data['id']);
    responseHandler('success',$result);
  }else{
    errorHandler('No data found',NOT_FOUND,404);
  }
}

function infinitScroll($data){
  $str = file_get_contents('blogs.json');
  $json = json_decode($str, true);
  $total = count($json);
  $start = 0;
  $per_page = isset($data['limit'])?$data['limit']:9;
  if(isset($data['start'])){
     $start = $data['start'];
  }
  $data = array_slice($json, $start, $per_page); 
  responseHandler('success',$data);
}



?>