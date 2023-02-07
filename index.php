<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$uri = $_SERVER['REQUEST_URI'];

$server = $_SERVER['SERVER_NAME'];


if (file_exists($server)){
 
    
    
    $path = "$server".parse_url($uri, PHP_URL_PATH);
    
    
    
    if (file_exists($path)){
     
       
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if (is_dir($path)){
             chdir($path);
            if (file_exists("index.php")){
                include("./index.php");
            }
            elseif(file_exists("./index.html")){
                echo file_get_contents("./index.html");
            }
            else{
                echo "Silahkan upload file anda dengan extensi index.php atau html";
            }
            die();
        }
        
        
        elseif ($ext == "php"){
            $dirname = dirname($path);
            $basename = basename($path);
            chdir($dirname."/");
            include($basename);
           
            die();
            
        }
        elseif($ext == "html"){
            $dirname = dirname($path);
            $basename = basename($path);
            chdir($dirname);
            
            echo file_get_contents("$basename");
            die();
        }
        
    }
    else{
        echo "404 NOT FOUND";
    }
    
}
else{
    echo "PLEASE CONTACT ADMINISTRATOR TO USE THIS FUNCTION";
}