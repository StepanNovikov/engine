<?php
    if($_POST['login_f']){
        captcha_valid();
        message('Ок');
    } else if($_POST['register_f']){
        go('login');
    }

    else if($_POST['recovery_f']){
        message('Восстановление пароля');
    }


    else if($_POST['confirm_f']){
        message('Подтверждение');
    }

  