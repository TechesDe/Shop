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
        <div></div>
        <img src="/img/k.png" />
        <p>irka</p>
    </div>

    <div class="middle">
      <!--
          <form action="/search.php">
            <p>Что желаете найти</p>
                <input name="search" type="text" value="" />
          </form>
          <h3>
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" version="1.1" viewBox="0 0 800.00001 800.00001">
            <defs>
            <linearGradient id="c" x1="349.66" x2="-68.235" y1="416.43" y2="847.86" gradientUnits="userSpaceOnUse">
            <stop stop-opacity=".4" offset="0"/>
            <stop stop-opacity="0" offset="1"/>
            </linearGradient>
            <mask id="b" maskUnits="userSpaceOnUse">
            <circle cx="400" cy="652.36" r="400" color="#000000" color-rendering="auto" fill="#fff" image-rendering="auto" shape-rendering="auto" solid-color="#000000" style="isolation:auto;mix-blend-mode:normal"/>
            </mask>
            <mask id="a" maskUnits="userSpaceOnUse">
            <circle cx="400" cy="400" r="400" color="#000000" color-rendering="auto" fill="#fff" image-rendering="auto" shape-rendering="auto" solid-color="#000000" style="isolation:auto;mix-blend-mode:normal"/>
            </mask>
            </defs>
            <g transform="translate(0 -252.36)" shape-rendering="auto">
            <circle cx="400" cy="652.36" r="400" color="#000000" color-rendering="auto" fill="#1c8adb" image-rendering="auto" solid-color="#000000" style="isolation:auto;mix-blend-mode:normal"/>
            <path transform="translate(0 252.36)" d="m348.33 193.95c-39.509 0-79.016 15.072-109.16 45.215l-235.31 235.31c29.254 173.81 108.78 311.28 360.03 324.62l242.17-242.16-126.92-126.92c38.052-60.904 29.082-140-21.641-190.84-30.145-30.143-69.654-45.215-109.16-45.215z" color="#000000" color-rendering="auto" fill="url(#c)" image-rendering="auto" mask="url(#a)" solid-color="#000000" style="isolation:auto;mix-blend-mode:normal"/>
            <path d="m239.17 491.53a154.38 154.38 0 0 0 0 218.32 154.38 154.38 0 0 0 190.84 21.641l126.92 126.92 49.123-49.121-126.92-126.92a154.38 154.38 0 0 0 -21.64 -190.84 154.38 154.38 0 0 0 -218.32 0zm36.394 36.395a102.92 102.92 0 0 1 145.53 0 102.92 102.92 0 0 1 0 145.54 102.92 102.92 0 0 1 -145.53 0 102.92 102.92 0 0 1 0 -145.54z" color="#000000" color-rendering="auto" fill="#fff" image-rendering="auto" mask="url(#b)" solid-color="#000000" style="isolation:auto;mix-blend-mode:normal"/>
            </g>
            </svg>
        </h3>
          -->
    </div>

    <div class="profile">
        <!--<img src="/img/13107160556333452.jpg" />-->
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
