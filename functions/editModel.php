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

if(!isset($_POST['name'])){
  setcookie('error','Изменение названия без указания нового названия невозможно',time()+60,'/');
  header('Location: /');
}

if(!isset($_POST['manafacturer'])){
  setcookie('error','Изменение производителя без указания нового невозможно',time()+60,'/');
  header('Location: /');
}

if(!isset($_POST['idmodel'])){
  setcookie('error','Изменение модели без указания на модель невозможно',time()+60,'/');
  header('Location: /');
}

$name=$_POST['name'];
$manafacturer=$_POST['manafacturer'];
$id=$_POST['idmodel'];

require_once "../query/querys.php";

$form='<form id="form" action="/info.php" method="POST">
<input type="hidden" name="id" value="'.$_POST['idmodel'].'">
</form>
<script>
    document.getElementById(\'form\').submit();
</script>
';

$QUERY->UpdateModelName($id,$name);
$QUERY->UpdateModelManafacturer($id,$manafacturer);
setcookie('message','Производитель и название были изменены',time()+60,'/');
echo($form);
 ?>
