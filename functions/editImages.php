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

if(!isset($_POST['image'])){
  setcookie('error','Не ясно место изменения',time()+60,'/');
  header('Location: /');
}

if(!isset($_POST['doing'])){
  setcookie('error','Действие не указано',time()+60,'/');
  header('Location: /');
}

if(!isset($_POST['idmodel'])){
  setcookie('error','Изменение модели без указания на модель невозможно',time()+60,'/');
  header('Location: /');
}

$image=$_POST['image'];
$doing=$_POST['doing'];
$id=$_POST['idmodel'];

$model=$QUERY->ModelsByID($id);
$typename=$model[0][2];
$barcode=$model[0][4];
if($doing=='None')
  if(isset($_FILES['sourse'])){
      $namef=$_FILES['sourse']['name'];
      $tmp_name=$_FILES['sourse']['tmp_name'];
      $typefile=$_FILES['sourse']['type'];
      $typefile=stristr($_FILES['sourse']['type'],'/',true);
      $file=substr($namef,-4);

      if($file=='.png'||$file=='.jpg'||$file=='jpeg')
      {
        $c=$QUERY->numderLastImage()+1;
          if($file=='jpeg')
              $file='.'.$file;
          $newpath="../img/".$typename."/".$barcode.'-'.$c.$file;
          if(!file_exists("../img/".$typename))
              mkdir("../img/".$typename, 0777, true);
          move_uploaded_file($tmp_name,$newpath);
          $QUERY->addImage($id,$newpath);
      }
      else {
        setcookie('error','Неверный формат изображения',time()+60,'/');
        header('Location: /');
      }
  }
if($doing=='replase'){
  if(isset($_FILES['sourse'])){
    $namef=$_FILES['sourse']['name'];
    $tmp_name=$_FILES['sourse']['tmp_name'];
    $typefile=$_FILES['sourse']['type'];
    $typefile=stristr($_FILES['sourse']['type'],'/',true);
    $file=substr($namef,-4);
    if($file=='.png'||$file=='.jpg'||$file=='jpeg')
    {
      $c=$QUERY->numderLastImage()+1;
        if($file=='jpeg')
            $file='.'.$file;
        $newpath="../img/".$typename."/".$barcode.'-'.$c.$file;
        if(!file_exists("../img/".$typename))
            mkdir("../img/".$typename, 0777, true);
        move_uploaded_file($tmp_name,$newpath);
        $QUERY->updateImage($newpath,$id);
    }else{
      setcookie('error','Неверный формат изображения',time()+60,'/');
      header('Location: /');
    }
  }
  else{
    setcookie('error','Отсутсвует изображение',time()+60,'/');
    header('Location: /');
  }
}

if($doing=='delete'){
  if(file_exists($image))
    unlink($image);
  $QUERY->deleteImage($image);
}

require_once "../query/querys.php";

$form='<form id="form" action="/info.php" method="POST">
<input type="hidden" name="id" value="'.$_POST['idmodel'].'">
</form>
<script>
    document.getElementById(\'form\').submit();
</script>
';
setcookie('message','Производитель и название были изменены',time()+60,'/');
echo($form);
 ?>
