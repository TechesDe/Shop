<?php
  require_once "query/querys.php";
  require_once "functions/card.php";
?>

<html>
<head>
    <title>Сайт Кирки</title>
    <link rel="stylesheet" href="/css/managment.css" />
    <link rel="stylesheet" href="/css/main.css">
</head>
  <body>
    <?php
        require "special/header.php";
    ?>

    <?php
    require_once "special/check.php";
    if($access=='customer'||$access=='No'){
      echo('<h1 class="access">У вас нет доступа к этой странице</h1>');
      exit();
    }
    ?>


    <div class="formbox">
      <?php
      echo('<div class="messege">');
      if(isset($_COOKIE['model'])){

          echo ('<h2>ID добавленой модели: '.$_COOKIE['model'].'</h2>');
          $model=$QUERY->ModelsByID($_COOKIE['model']);
          $modelid=$model[0][3];
          $modelimg=$QUERY->ImagesByModelID($modelid);
          if($modelimg)
            $modelimg=$modelimg[0][1];
          else
            $modelimg='';
          $modeltype=$model[0][2];
          $modelmanafacturer=$model[0][1];
          $modelname=$model[0][0];
          $description=$QUERY->BrieflyDescriptonByModelId($modelid);
          $price=$QUERY->LastPriceByModelId($modelid).'₽';
          echo (createCard($modelimg,$modeltype,$modelmanafacturer,$modelname,$modelid,$description,$price));
      }
      if(isset($_COOKIE['messege'])){
          echo ('<h2>'.$_COOKIE['messege'].'</h2>');
      }
      echo('</div>');
      ?>
    <?php
    $types=$QUERY->AllTypes();
    $manafacturers=$QUERY->AllManafacturers();
    echo('<link rel="stylesheet" href="/css/card.css">');
    echo (addCard());
    ?>
    <div class="column">
      <form class="add" action="functions/addType.php" method="POST">
        <h1>Добавить тип товаров</h1>
        <input type="text" placeholder="Введите новый тип" name='type' value='' />
        <button class="send" type="submit">Создать</button>
      </form>

      <form class="add" action="functions/addManafacturer.php" method="POST">
        <h1>Добавить нового произовдителя</h1>
        <input type="text" placeholder="Введите нового произовдителя" name='manafacturer' value='' />
        <button class="send" type="submit">Создать</button>
      </form>
    </div>

    </div>
    <?php
      require "special/footer.php";
    ?>
  </body>
</html>
