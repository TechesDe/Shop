<link rel="stylesheet" href="/css/header.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Play&display=swap" rel="stylesheet">
<header>
    <script>
        function toIndex(){
            document.location.href = "/index.php";
        }
    </script>
    <div class="logo" onclick="toIndex()">
        <h1>К</h1>
        <div class="firstO"></div>
        <div class="secondO"></div>
        <h1>ператор</h1>
    </div>

    <div class="middle">
    </div>

    <div class="profile">
        <?php
        if(isset($_COOKIE['pass'])):?>
          <div>
            <a href="../special/deauto.php">Выйти</a>
            <a href="../management.php">Управление</a>
          </div>
        <?php else:?>
        <div class="enter">
            <form action="/autorization.php">
                <input name="myActionName" type="submit" value="Войти" />
            </form>
            <form action="/register.php">
                <input name="registration" type="submit" value="Регистрация" />
            </form>
        </div>
        <?php endif ?>
    </div>
</header>
