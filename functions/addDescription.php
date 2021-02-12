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

if(!isset($_POST['category']))
{
    setcookie('error','Добавление описания без указания категории невозможно',time()+60,'/');
    header('Location: /');
}

if(!isset($_POST['description']))
{
    setcookie('error','Добавление описания без указания на описание невозможно',time()+60,'/');
    header('Location: /');
}

if(!isset($_POST['idmodel']))
{
    setcookie('error','Добавление описания без указания на модель невозможно',time()+60,'/');
    header('Location: /');
}

require_once "../query/querys.php";

$QUERY->addDescription($_POST['idmodel'],$_POST['category'],$_POST['description']);
setcookie('message','Описание было добавлено',time()+60,'/');
header('Location: /');
?>