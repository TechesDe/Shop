<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/register.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Play&display=swap" rel="stylesheet">
</head>
<?php
    require "special/header.php";
?>
<div class="main">
    <form class="form" action="special/registration.php" method="POST">
        <h1>Регистрация</h1>
        <?php if(isset($_COOKIE['error'])){
            echo ('<h2>'.$_COOKIE['error'].'</h2>');
        }
        ?>

        <span>Email</span>
        <input class="inputText" type="textarea" name="email" placeholder="введите email" value=
        <?php if(isset($_COOKIE['email'])){echo ($_COOKIE['email']);}
                else{
                    echo('');
                    }
        ?>
        >

        <span>Телефон</span>
        <input class="inputText" type="number" min="0" name="phone" placeholder="введите телефон" value=
        <?php if(isset($_COOKIE['phone'])){echo ($_COOKIE['phone']);}
                else{
                    echo('');
                    }
        ?>
        >

        <span>Имя</span>
        <input class="inputText" type="textarea" name="fname" placeholder="введите пароль" value="">

        <span>Фамилия</span>
        <input class="inputText" type="textarea" name="sname" placeholder="введите пароль" value="">

        <span>Пароль</span>
        <input class="inputText" type="password" name="password" placeholder="введите пароль" value="">

        <span>Повторите пароль</span>
        <input  class="inputText" type="password" name="correctpassword" placeholder="повторите пароль" value="">

        <button class="send" type="submit">Отправить</button>
    </form>
</div>
</html>
