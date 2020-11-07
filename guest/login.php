<?php
    top('Вход');
?> 
    <h1>Вход</h1>
    <p><input type="text" placeholder="E-mail" id="email"></p>
    <p><input type="password" placeholder="Пароль" id="password"></p>
    <p><input type="text" placeholder="<?php captcha_show() ?>" id="captcha"></p>
    <p><button onclick="post_query('gform','login','email.password.captcha')">Войти</button> <button>Восстановить пароль</button></p>

<?php bottom();