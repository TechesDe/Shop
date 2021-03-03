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

if(!isset($_POST['id']))
{
    setcookie('error','Удаление описания без указания на модель невозможно',time()+60,'/');
    header('Location: /');
}

if(!isset($_POST['idmodel']))
{
    setcookie('error','Изменение описания без указания на модель невозможно',time()+60,'/');
    header('Location: /');
}

$form='<form id="form" action="/info.php" method="POST">
<input type="hidden" name="id" value="'.$_POST['idmodel'].'">
</form>
<script>
    document.getElementById(\'form\').submit();
</script>
';

$id=$_POST['id'];
require_once "../query/querys.php";
$QUERY->deleteDescription($id);
setcookie('message','Оприсание удалено',time()+60,'/');
echo($form);
?>