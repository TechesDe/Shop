<!DOCTYPE html>
<html>
<head>
    <title><?php
    if(isset($_POST['type'])){
        $type=$_POST['type'];
        echo ("$type ");
      }
      if(isset($_POST['manafacturer'])){
        $manafacturer=$_POST['manafacturer'];
        echo ("$manafacturer ");
      }
      if(isset($_POST['model'])){
        $model=$_POST['model'];
        echo ("$model ");
      }
      echo ("Магазин");
      ?></title>
    <link rel="stylesheet" href="/css/main.css" />
    <link rel="stylesheet" href="/css/card.css">
</head>
<body>
  <?php
    require "special/header.php";
  ?>
  <div class="container row nowrap">
    <?php
        require_once "menu.php";
        require_once "box/infoContainer.php";
        if(count($models)>1)
          echo ('<a>next</a>');
    ?>
  </div>
  <?php require "special/footer.php"; ?>
</body>

</html>
