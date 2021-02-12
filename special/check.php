<?php
$access='No';
if(file_exists("query/querys.php"))
  require_once "query/querys.php";
  else {
    if(file_exists("../query/querys.php"))
      require_once "../query/querys.php";
  }

if(isset($_COOKIE['pass'])&&isset($_COOKIE['user'])){
  $users=$QUERY->UserByID($_COOKIE['user']);
  if(count($users)==1){
    if($_COOKIE['pass']==$users[0][3])
      $access=$users[0][4];
  }
}
?>
