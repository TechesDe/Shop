<?php
require_once "../special/check.php";
require_once "../query/querys.php";

if($access=='customer'){
  echo ("Нет авторизации для выполнения действия");
  echo ('<script>
          function toMain(){
              document.location.href = "/index.php";
          }
        </script>
        <div class="logo" onclick="toMain()">Нажмите, здесь чтобы вернуться на главную.</div>');
  exit();
}


if($_POST['type']!=''){
    $name=$_POST['type'];
    $QUERY->addType($name);
    setcookie('messege','Тип техники успешно добавлен',time()+60,'/management.php');
}

header('Location: /management.php')
?>
