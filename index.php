<!DOCTYPE html>
<html>
<head>
    <title>Сайт Кирки</title>
    <link rel="stylesheet" href="/css/main.css" />
    <link rel="stylesheet" href="/css/card.css">
</head>
<body>

    <?php
        if(isset($_COOKIE['message']))
            print_r($_COOKIE['message']);
        if(isset($_COOKIE['error']))
            print_r($_COOKIE['error']);
        require "special/header.php";
        //require "special/deauto.php";
    ?>
    <div class="container">
        <?php
            require_once "menu.php";
            require_once "box/cardContainer.php"
        ?>
    </div>
    <?php
        require "special/footer.php";
    ?>
</body>
</html>
