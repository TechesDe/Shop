
<?php
setcookie('error','Incorrect email',time()-3600,'/register.php');
setcookie('email',$_POST['email'],time()-3600,'/register.php');
setcookie('phone',$_POST['phone'],time()-3600,'/register.php');

setcookie('email',$_POST['email'],time()+3600,'/register.php');
setcookie('phone',$_POST['phone'],time()+3600,'/register.php');

if($_POST==null){
    header('Location: /register.php?'.'registration=Регистрация');
    exit();
}

if(strripos($_POST['email'],'@')==false){
    setcookie('error','Неправильный email',time()+3600,'/register.php');
    header('Location: /register.php');
    exit();
}

if($_POST['phone']==null){
    setcookie('error','Номер телефона отсутствует',time()+3600,'/register.php');
    header('Location: /register.php');
    exit();
}

if($_POST['password']!=$_POST['correctpassword']){
    setcookie('error','Пароли не совпадают',time()+3600,'/register.php');
    header('Location: /register.php');
    exit();
}

if(strlen(trim($_POST['password']))<5){
    setcookie('error','Пароль слишком короткий, минимум 5 символов',time()+3600,'/register.php');
    header('Location: /register.php');
    exit();
}

if(strlen(trim($_POST['password']))>32){
    setcookie('error','Пароль слишком длинный, максимум 32 символа',time()+3600,'/register.php');
    header('Location: /register.php');
    exit();
}

require_once "../query/querys.php";


$users=$QUERY->UsersByEmail($_POST['email']);
if(count($users)>0){
    setcookie('error','Email уже зарегистрирован',time()+3600,'/register.php');
    header('Location: /register.php');
    exit();
}
$users=$QUERY->UsersByPhone($_POST['phone']);
if(count($users)>0){
    setcookie('error','Номер телефона уже зарегистрирован',time()+3600,'/register.php');
    header('Location: /register.php');
    exit();
}


$email=trim($_POST['email']);
$phone=$_POST['phone'];
$pass=trim($_POST['password']);
$pass=md5($_POST['password'].'key');
if(isset($_POST['fname']))
  $first_name=$_POST['fname'];
  else
  $first_name='';

if(isset($_POST['sname']))
  $second_name=$_POST['sname'];
  else
  $second_name='';

if(isset($_POST['lname']))
  $last_name=$_POST['lname'];
  else
  $last_name='';

$QUERY->addUser($email,$phone,$pass,$first_name,$second_name,$last_name);


header('Location: /index.php')

?>
