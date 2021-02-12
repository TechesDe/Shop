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
    setcookie('error','Изменение описания без указания категории невозможно',time()+60,'/');
    header('Location: /');
}

if(!isset($_POST['description']))
{
    setcookie('error','Изменение описания без указания на описание невозможно',time()+60,'/');
    header('Location: /');
}

if(!isset($_POST['idmodel']))
{
    setcookie('error','Изменение описания без указания на модель невозможно',time()+60,'/');
    header('Location: /');
}

if(!isset($_POST['id']))
{
    setcookie('error','Не указано изменяемое поле',time()+60,'/');
    header('Location: /');
}

require_once "../query/querys.php";

$QUERY->UpdateDescription($_POST['id'],$_POST['idmodel'],$_POST['category'],$_POST['description']);
setcookie('message','Описание было изменено',time()+60,'/');
header('Location: /');
?>