
<?php
setcookie('error','Incorrect email',time()-3600,'/autorization.php');
setcookie('email',$_POST['email'],time()-3600,'/');
setcookie('phone',$_POST['phone'],time()-3600,'/');
setcookie('pass',false,time()-3600,'/');
setcookie('email',trim($_POST['email']),time()+3600,'/');
setcookie('phone',$_POST['phone'],time()+3600,'/');

require_once "../query/querys.php";
if(isset($_POST['phone'])&&$_POST['phone']!=''){
  $phone=$_POST['phone'];
  $phone=str_replace('+7','8',$phone);
  $users=$QUERY->UsersByPhone($phone);
}
else
  if(isset($_POST['email'])&&$_POST['email']!='')
    $users=$QUERY->UsersByEmail($_POST['email']);
    else {
      setcookie('error','Нет данных',time()-60,'/autorization.php');
      header('Location: /autorization.php');
    }

if(count($users)==1){
  if($users[0][2]==md5($_POST['password'].'key')){
    setcookie('pass',md5($_POST['password'].'key'),time()+3600,'/');
    setcookie('user',$users[0][3],time()+3600,'/');
    header('Location: /index.php');
    exit();
  }
  else
  {
      setcookie('error','Неверный пароль',time()+3600,'/autorization.php');
      header('Location: /autorization.php');
      exit();
  }
}
else {
  setcookie('error','Аккаунт не найден или дублирован',time()+3600,'/autorization.php');
  header('Location: /autorization.php');
  exit();
}

?>
