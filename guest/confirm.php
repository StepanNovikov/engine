<?php
    if(!$_SESSION['confirm']['code'] ){
        not_found();
    }
    top('Подтверждение');
?>

    <h1>Подтверждение</h1>
    <p><input type="text" placeholder="Код" id="code"></p>
    <p><input type="text" placeholder="<?php captcha_show() ?>" id="captcha"></p>
    <p><button onclick="post_query('gform','confirm','code.captcha')">Подтвердить</button></p> 

<?php bottom();