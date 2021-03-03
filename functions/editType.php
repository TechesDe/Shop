<?php
require_once "../special/check.php";
if($access=='No'||$access=='customer'){
    if($access=='No')
        setcookie('error','Срок авторизации истек',time()+60,'/');
    else
        setcookie('error','Отказано в доступе',time()+60,'/');
    header('Location: /autorization.php');
    exit();
}

if(!isset($_POST['type'])){
  setcookie('error','Изменение типа без указания типа невозможно',time()+60,'/');
  header('Location: /');
}

if(!isset($_POST['idmodel'])){
  setcookie('error','Изменение типа без указания модель невозможно',time()+60,'/');
  header('Location: /');
}

$type=$_POST['type'];
$id=$_POST['idmodel'];

require_once "../query/querys.php";

$form='<form id="form" action="/info.php" method="POST">
<input type="hidden" name="id" value="'.$_POST['idmodel'].'">
</form>
<script>
    document.getElementById(\'form\').submit();
</script>
';

$QUERY->UpdateModelType($id,$type);
setcookie('message','Тип был изменен',time()+60,'/');
echo($form);
 ?>
