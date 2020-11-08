<?php
    if($_POST['login_f']){
        captcha_valid();
        message('Ок');
    } else if($_POST['register_f']){
        email_valid();
        password_valid();
        //captcha_valid();


        if(mysqli_num_rows(mysqli_query($connect,"select `id` from `users` where `email` = '$_POST[email]'"))){
            message("Email занят");
        }

        $code = randon_str(5);

        $_SESSION['confirm'] = array(
            'type' => 'register',
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'code' => $code,
        );

        mail($_POST['email'], "Регистрация" ,"Код подтверждения регистрации: <b>$code</b>");

        go("Confirm");
    }
    

    else if($_POST['recovery_f']){
        message('Восстановление пароля');
    }


    else if($_POST['confirm_f']){
        if($_SESSION['confirm']['type'] == 'register'){

            if($_SESSION['confirm']['code'] != $_POST['code']){
                message('Код подтверждения регистрации указан неверно');
            }
            mysqli_query($connect, 'INSERT INTO `users` (`email`, `password`) VALUES ("'.$_SESSION['confirm']['email'].'", "'.$_SESSION['confirm']['password'].'")');
            // unset($_SESSION['confirm']);
            
            message("OK");
            go('login');
        } else {
            not_found();
        }
    }

  