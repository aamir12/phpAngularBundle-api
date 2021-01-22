<?php
    date_default_timezone_set('Asia/Calcutta');  
    define('BASE_DIR', dirname(__FILE__));
    define("MODE","Development"); //Production

    if(MODE==="Development"){
        define("MAIN_URL","http://localhost/myrestapi/");
        define('DB_NAME', 'phprestapi');
        define('DB_USER', 'root');
        define('DB_PASSWORD', '');
        define('DB_HOST', 'localhost');
        define('SECRETE_KEY','123456');
        define('JWT_ISS','localhost');
    }else{
        define("MAIN_URL","https://meanstackapi.000webhostapp.com/");
        define('DB_NAME', 'id15867052_meanapidb');
        define('DB_USER', 'id15867052_meanapidbuser	');
        define('DB_PASSWORD', 'id15867052_meanapidb');
        define('DB_HOST', 'localhost');
        define('SECRETE_KEY','123456');
        define('JWT_ISS','localhost');
    }
    

?>