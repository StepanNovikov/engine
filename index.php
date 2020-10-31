<?php 
    if($_SERVER['REQUEST_URI'] == '/engine/'){
        $page = 'home';
    } else {
        $page = substr($_SERVER['REQUEST_URI'],1);
        if (!preg_match('/^[A-z0-9]{3,15}$/',$page)){
            exit('error url');
        }
    }

    session_start();
     
    if(file_exists('all/'.$page.'.php')){
        include 'all/'.$page.'.php';
    } else if($_SESSION['ulogin'] == 1 and file_exists('auth/'.$page.'.php')){
        include 'all/'.$page.'.php';
    } else if($_SESSION['ulogin'] != 1 and file_exists(include 'guest/'.$page.'.php')){
        include 'guest/'.$page.'.php';
    } else {
        exit('Страница 404');
    }
  