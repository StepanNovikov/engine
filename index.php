<?php 
    if($_SERVER['REQUEST_URI'] == '/engine/'){
        $page = 'home';
        echo $page;
    } else {
        $page = substr($_SERVER['REQUEST_URI'],strrpos($_SERVER['REQUEST_URI'], '/') + 1);
        if (!preg_match('/^[A-z0-9]{3,15}$/',$page)){
            exit('error url');
        }
    }

    session_start();
     
    
    if(file_exists("all/".$page.".php")){
        
        include "all/".$page.".php";
    } else if($_SESSION['ulogin'] == 1 and file_exists("auth/".$page.".php")){
        echo "1";
        include "auth/".$page.".php";
    } else if($_SESSION['ulogin'] != 1 and file_exists("guest/".$page.".php")){
        include "guest/".$page.".php";
    } else {
        exit("Страница 404");
    }



    function message($text){
        exit('{"message": "'.$text.'"}');
    }

    function go($url){
        exit('{"go": "'.$url.'"}');
    }



    function top($title){
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport " content="width=device-width, initial-scale=1.0">
            <title>'.$title.'</title>
            <link rel="stylesheet" href="style.css">
            <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
            <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="crossorigin="anonymous"></script>
            <script src="script.js"></script> 
        </head>
        <body>
        <div class="wrapper">
            <div class="menu">
                <a href="/engine">Main</a>
                <a href="/engine/login">Login</a>
                <a href="/engine/register">Register</a>
            </div>

            <div class="content">
                <div class="block">
                
                
        
        ';
    }

    
    function bottom(){
        echo '
                </div>
            </div>
        </div>
        </body>
        </html>';
    }
  

    
