<?php
require_once "../special/check.php";
require_once "../query/querys.php";
setcookie('messege','NNN',time()-60,'/management.php');
setcookie('model','$id',time()-300,'/management.php');
if($access=='customer'||$access=='No'){
  echo ("Нет авторизации для выполнения действия");
  echo ('<script>
          function toMain(){
              document.location.href = "/index.php";
          }
        </script>
        <div class="logo" onclick="toMain()">Нажмите, здесь чтобы вернуться на главную.</div>');
  exit();
}
if(isset($_POST['barcode'])&&$_POST['barcode']!='')
  $barcode=$_POST['barcode'];
else{
  setcookie('messege','Отсутсвует штрихкод',time()+60,'/management.php');
  header('Location: /management.php');
  exit();
}
if(isset($_POST['model'])&&$_POST['model']!='')
  $name=$_POST['model'];
else{
  setcookie('messege','Отсутсвует модель',time()+60,'/management.php');
  header('Location: /management.php');
  exit();
}
if(isset($_POST['type'])&&$_POST['type']!='')
  $idtype=$_POST['type'];
else{
  setcookie('messege','Отсутсвует тип',time()+60,'/management.php');
  header('Location: /management.php');
  exit();
}
if(isset($_POST['manafacturer']))
  $idmanafacturer=$_POST['manafacturer'];
else{
  setcookie('messege','Отсутсвует производитель',time()+60,'/management.php');
  header('Location: /management.php');
  exit();
}
$description=$_POST['description'];
$price=$_POST['price'];

$models=$QUERY->AllModels();

for($i=0;$i<count($models);$i++){
    if($barcode==$models[$i][1]){
        setcookie('messege','Такой штрихкод уже существует',time()+60,'/management.php');
        header('Location: /management.php');
        exit();
    }
}


//INSERT model
{
  if(isset($_FILES['image'])){
      $namef=$_FILES['image']['name'];
      $tmp_name=$_FILES['image']['tmp_name'];
      $typefile=$_FILES['image']['type'];
      $typefile=stristr($_FILES['image']['type'],'/',true);
      $file=substr($namef,-4);

      if($file=='.png'||$file=='.jpg'||$file=='jpeg')
      {
          if($file=='jpeg')
              $file='.'.$file;
          $typename=$QUERY->TypeByID($idtype);
          if(!isset($typename))
          {
              setcookie('messege','Тип не найден',time()+60,'/management.php');
              header('Location: /management.php');
              exit();
          }
          $newpath="../img/".$typename[0][1]."/".$barcode.$file;
          if(!file_exists("../img/".$typename[0][1]))
              mkdir("../img/".$typename[0][1], 0777, true);
          move_uploaded_file($tmp_name,$newpath);

          $QUERY->addModel($barcode,$name,$idtype,$idmanafacturer,$newpath);
          setcookie('messege','Модель успешно добавлена',time()+60,'/management.php');
      }
          else
          {
            $QUERY->addModelWithoutImg($barcode,$name,$idtype,$idmanafacturer);
            setcookie('messege','Модель успешно добавлена',time()+60,'/management.php');
          }
      }
      else
      {
        $QUERY->addModelWithoutImg($barcode,$name,$idtype,$idmanafacturer);
        if($_POST['manafacturer']=='')
          setcookie('messege','Модель успешно добавлена, <b>обратите внимание </b>, что производитель отсутвует',time()+60,'/management.php');
        else
        setcookie('messege','Модель успешно добавлена',time()+60,'/management.php');
      }
  setcookie('model',$QUERY->ModelByBarcode($barcode)[0][0],time()+60,'/management.php');
  if($description!='')
    $QUERY->addBrieflyDescripton($QUERY->ModelByName($name)[0][0],$description);
  if($price!='')
    $QUERY->addPriceToday($QUERY->ModelByName($name)[0][0],$price);
  header('Location: /management.php');
}
?>
