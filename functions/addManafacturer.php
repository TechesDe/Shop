<?php
require_once "../special/check.php";
require_once "../query/querys.php";

if($access=='customer'||$access='No'){
  echo ("Нет авторизации для выполнения действия");
  echo ('<script>
          function toMain(){
              document.location.href = "/index.php";
          }
        </script>
        <div class="logo" onclick="toMain()">Нажмите, здесь чтобы вернуться на главную.</div>');
  exit();
}


if($_POST['manafacturer']!=''){
    $name=$_POST['manafacturer'];
    $QUERY->addManafacturer($name);
    setcookie('messege','Производитель успешно добавлен',time()+60,'/management.php');
}

header('Location: /management.php')
?>
