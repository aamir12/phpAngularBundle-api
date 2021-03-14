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
        define("MAIN_URL","https://phprestapi8878.herokuapp.com/");
        define('DB_NAME', 'sql12391333');
        define('DB_USER', 'sql12391333	');
        define('DB_PASSWORD', 'GFUqL7f72F');
        define('DB_HOST', 'sql12.freemysqlhosting.net');
        define('SECRETE_KEY','123456');
        define('JWT_ISS','localhost');
    }
    

?>