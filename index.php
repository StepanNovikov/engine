<?php 
    if($_SERVER['REQUEST_URI'] == '/engine/'){
        $page = 'home';
        echo $page;
    } else {
        $page = substr($_SERVER['REQUEST_URI'],strrpos($_SERVER['REQUEST_URI'], '/') + 1);
        if (!preg_match('/^[A-z0-9]{3,15}$/',$page)){
            not_found();
        }
    }

    $connect = mysqli_connect('localhost','root','root','engine');

    if(!$connect) exit('error');

    session_start();
     

    
    if(file_exists("all/".$page.".php")){
        
        include "all/".$page.".php";
    } else if($_SESSION['ulogin'] == 1 and file_exists("auth/".$page.".php")){
        echo "1";
        include "auth/".$page.".php";
    } else if($_SESSION['ulogin'] != 1 and file_exists("guest/".$page.".php")){
        include "guest/".$page.".php";
    } else {
        not_found();
    }



    function message($text){
        exit('{"message": "'.$text.'"}');
    }

    function go($url){
        exit('{"go": "'.$url.'"}');
    }

    function randon_str($num = 30){
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'),0,$num);
    }

    function not_found(){
        exit('Страница 404');
    }
    

    function captcha_show(){
        $questions = array(
            1=>'Столица России?',
            2=>'Столица Беларуси?',
            3=>'Столица США?',
        );

        $num = mt_rand(1,count($questions));
        $_SESSION['captcha'] = $num;
        echo $questions[$num];
    }

    function captcha_valid(){
        $answers = array(
            1=>'москва?',
            2=>'минск?',
            3=>'вашингтон',
        );

        if($_SESSION['captcha'] != array_search(strtolower($_POST['captcha']), $answers)){
            message("Ответ на вопрос указан неверно!");
        }
    }

    function email_valid(){
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            message('Email указан неверно');
        }
    }

    function password_valid(){
        if(!preg_match('/^[A-z0-9]{10,30}$/',$_POST['password'])){
            message('Пароль указан неверно и может содержать 10-30 символов');
        }
        $_POST['password'] = md5($_POST['password']);
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
  

    
