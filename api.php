<?php

//   header('Access-Control-Allow-Origin: *');
//   header('Access-Control-Allow-Credentials: true');
//   header('Content-Type: application/json; charset:utf-8');
//   header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE,OPTIONS');
//   header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


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
  
  require_once('model/auth_mdl.php');
    
  $action = isset($_REQUEST['action'])?trim($_REQUEST['action']) : ''; 
  
   switch ($action){
        case 'login':
            login();
            break;
        case 'registration':
            registration();
            break;
        case 'getCategory':
            getCategory($_REQUEST);
            break;

        case 'addPost':            
            addPost($_REQUEST);
            break;
        case 'addProfile1':
            addProfile1($_REQUEST);
            break;
        case 'addProfile':
            addProfile($_REQUEST);
            break;
        case 'multifiledropzone':
            multifiledropzone($_REQUEST);
            break;
        case 'sample':            
            sample($_REQUEST);
            break;

                

        default:
        errorHandler('Unknown Request',INV_REQ);
    }



    /*******TOKEN*********/

    function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }


    function getBearerToken() {
        $headers = getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            //it is only conception
            // if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            //     return $matches[1];
            // }
            return $headers;
        }        
        errorHandler('Unauthorized access',NOT_AUTH,404);
    }

    function auth(){
        try {
            $token = getBearerToken();
            $author = new auth_mdl();
            $payload = JWT::decode($token, SECRETE_KEY, ['HS256']);
            $result = $author->single($payload->userId);

            if(!$result) {
                errorHandler('Access denied',INV_TOKEN,404);
            }

            $userId = $payload->userId;
        } catch (Exception $e) {
            errorHandler('Session Expired',INV_TOK_EXP,404);
        }

    }

    /******End of Token****/


    /*******Login and registration********/ 
    //login and generate token
    //method : POST
    //@body : email | password
    function login(){
        //only POST method will allow for this api
        setupReq('POST'); 
        $data    = file_get_contents("php://input");
   	    if(isset($data) && !empty($data)){
            $data = json_decode($data,true);
            //validation 
            $v = new validation();
            $config = [
                [
                    'email',
                    'required|email',
                    'Email is required|Invalid email id'
                ],
                [
                    'password',
                    'required',
                    'Password is required'
                ]
            ];
            $check = $v->validated($data,$config);
            if(!$check['valid']){
                errorHandler($check['errors'],INV_DATA,400);
            }

            $author = new auth_mdl();
            $result = $author->login($data['email'],$data['password']);
            if($result){
            
                $paylod = [
                    'iat' => time(),
                    'iss' => JWT_ISS,
                    'exp' => time() + (15*60),
                    'userId' => $result['aid']
                ];

                $token = JWT::encode($paylod, SECRETE_KEY);
                $data = ['token' => $token];
                responseHandler('Login Successfully',$data);

            }else{
                errorHandler('Invalid username or password',INV_AUTH,404);
            }
        }else{
            errorHandler('Invalid Parameters',INV_PARAM,404);
        }
    }

     //registration
    //method : POST
    //@body : email | password | name

    function registration(){
        setupReq('POST');
        $data    = file_get_contents("php://input");
        if(isset($data) && !empty($data)){
            $data = json_decode($data,true);
           //validation 
            $v = new validation();
            $config = [
                [
                    'name',
                    'required',
                    'Name is required'
                ],
                [
                    'email',
                    'required|email|unique',
                    'Email is required|Invalid email id|Email id already exist',
                    'author.email'
                ],
                [
                    'password',
                    'required',
                    'Password is required'
                ]
            ];

            $check = $v->validated($data,$config);
            if(!$check['valid']){
                errorHandler($check['errors'],INV_DATA,400);
            }

            $author = new auth_mdl();
            $result = $author->create($data);
            if($result){
                responseHandler('Register Successfully',['id'=>$result]);
            }else{
                errorHandler('Server Error');
            }
        }else{
            errorHandler('Invalid Parameters',INV_PARAM,404);
        }
       


    }


    
    /**Start Category **/   

    //get single category
    //method : GET
    //url: URL?action=getCategory
    //@body : id
    function getCategory($data){
        setupReq('GET');
        auth(); // token based authorization
        $v = new validation();
        $config = [
            [
                'id',
                'required',
                'Id is required'
            ]
        ];
        $check = $v->validated($data,$config);
        if(!$check['valid']){
            errorHandler($check['errors'],INV_DATA,400);
        }

        require_once('model/category_mdl.php');
        $category = new category_mdl();
        $result = $category->single($data['id']);
        

        if($result){
            responseHandler('get Successfully',$result);
        }else{
            errorHandler('Not Found',NOT_FOUND,404);
        }
    }

    /******************/
    /*End of Category*/
    /****************/





    /*************/
    /* Start post */
    /************/

    //add post
    //method : POST
    //url: URL?action=addPost
    //@body : category_id/title/body/author/
    function addPost($data){
        setupReq('POST');
        if(isset($_FILES['resume'])){
            $data['filename'] = $_FILES;
        }
        responseHandler('get Successfully',$data);
    }


    /*************/
    /*End of Post*/
    /************/
 
    function addProfile(){
        setupReq('POST');
        $data    = file_get_contents("php://input");
        $data = json_decode($data,true);
        responseHandler('Register Successfully',$data);
   	    if(isset($data) && !empty($data)){
            $data = json_decode($data,true);
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

        }else{
            errorHandler('Invalid Parameters',INV_PARAM,404);
        }
    }

    function sample($data){
   	    $postdata    = file_get_contents("php://input");
   	    if(isset($postdata) && !empty($postdata)){
		   	$result     = json_decode($postdata,true);
            responseHandler('get Successfully',$result);
        }
    }

     
   function addProfile1($data){
        unset($data['action']);
        $filename = 'default.jpg';
        $imageName = $_FILES["image"]["name"];
       
        $imgErr = false;
        if(!empty($imageName)) {
            
            $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $fileAllow = array("jpg","jpeg","png","gif");
            if(in_array($fileExtension,$fileAllow)){
                if($_FILES["image"]["size"] < 3000000) {
                $strDtMix = @date("d").substr((string)microtime(), 2, 8);
                $filename = $strDtMix.".".pathinfo($imageName, PATHINFO_EXTENSION);
                
                move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$filename);
                }else{
                  $imgErr = "Image must be in size  100kb";
                }
            }else{
                $imgErr = "Invalid file type";
            }   
        }

        if($imgErr){
          errorHandler($imgErr,INV_DATA,400);
        }  
        $data['image'] = $filename;
        $author = new auth_mdl();
        $result = $author->addProfile($data);
        if($result){
            responseHandler('Register Successfully',['id'=>$result]);
        }else{
            errorHandler('Server Error');
        }
    }

    function multifiledropzone($data){
        unset($data['action']);
        ////////////////////////
        $total = count($_FILES['image']['name']);
        $filesNames = [];
        for( $i=0 ; $i < $total ; $i++ ) {
        $imageName = $_FILES['image']['name'][$i];
            if(!empty($imageName)) {
                $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
                $fileAllow = array("jpg","jpeg","png","gif");
                if(in_array($fileExtension,$fileAllow) && $_FILES["image"]["size"][$i] < 3000000){
                    $strDtMix = @date("d").substr((string)microtime(), 2, 8);
                    $filename = $strDtMix.".".pathinfo($imageName, PATHINFO_EXTENSION);
                    array_push($filesNames,$filename);
                    move_uploaded_file($_FILES['image']['tmp_name'][$i], "uploads/dropzone/".$filename);
                }
            }
        }
        ///////////////////////
        responseHandler('success',$filesNames);
    }
    
  



?>