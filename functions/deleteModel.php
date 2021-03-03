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

if(!isset($_POST['idmodel']))
{
    setcookie('error','Удаление модели без указания на модель невозможно',time()+60,'/');
    header('Location: /');
}

$id=$_POST['idmodel'];
require_once "../query/querys.php";
$QUERY->deleteModel($id);
setcookie('message','Модель удалена',time()+60,'/');
header('Location: /');
?>
