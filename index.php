<!DOCTYPE html>
<html>
<head>
    <title>Кооператор Бытовая Техника</title>
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
      <div class="headerbtms">
        <?php require_once "box/menu.php"; ?>
        <div></div>
        <?php require_once "box/contacts.php"; ?>
      </div>
      <?php require_once "box/saleContainer.php"; ?>
      <?php require_once "box/cardContainer.php"; ?>

    </div>
    <?php
        require "special/footer.php";
    ?>
</body>
</html>
