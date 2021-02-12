<!DOCTYPE html>
<html>
<head>
    <title>Autorization</title>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/register.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Play&display=swap" rel="stylesheet">
</head>
<?php require "special/header.php" ?>
<div class="main">
    <form class="form" action="special/auto.php" method="POST">
        <h1>Авторизация</h1>
        <?php if(isset($_COOKIE['error'])){echo ('<h2 class=error>'.$_COOKIE['error'].'</h2>');}?>
        <div>
            <span>Email</span>
            <input class="inputText" type="textarea" name="email" placeholder="введите email" value=
            <?php if(isset($_COOKIE['email'])){echo ($_COOKIE['email']);}else{echo('');}?>>
            <span>Телефон</span>
            <input class="inputText" type="tel" min="0" name="phone" placeholder="введите телефон" value=
            <?php if(isset($_COOKIE['phone'])){echo ($_COOKIE['phone']);}else{echo('');}?>>
        </div>
        <span>Пароль</span>
        <input class="inputText" type="password" name="password" placeholder="введите пароль" value="">
        <button class="send" type="submit">Войти</button>
    </form>
</div>
</html>
