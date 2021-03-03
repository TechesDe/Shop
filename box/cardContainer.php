<?php
//Формирует карточки предствленных товаров по и без условий поиска (пока что только тип и производитель)
    require_once "special/connect.php";
    require_once "functions/card.php";
    require_once "query/querys.php";
    echo('<link rel="stylesheet" href="/css/cardContainer.css">');
    echo('<div class="cardContainer">');
    if(isset($_POST['type'])){
        $searchtype=$_POST['type'];
    }
    else
        $searchtype='';
    if(isset($_POST['manufacturer'])){
        $searchmanafacturer=$_POST['manufacturer'];
    }
    else
        $searchmanafacturer='';
    $model=$QUERY->ModelByTypeAndManafacturer($searchtype,$searchmanafacturer);
    if(count($model)>0)
        for($i=0;$i<count($model);$i++){
            $modelid=$model[$i][3];
            $modeltype=$model[$i][2];
            $modelmanafacturer=$model[$i][1];
            $modelname=$model[$i][0];
            $image=$QUERY->ImagesByModelID($modelid);
            if($image!=null)
              $image=$image[0][1];
            else
              $image='';
            $description=$QUERY->BrieflyDescriptonByModelId($modelid);
            $price=$QUERY->LastPriceByModelId($modelid).'₽';
            echo (createCard($image,$modeltype,$modelmanafacturer,$modelname,$modelid,$description,$price));
        }
    else
        echo('<div class="card">Нет товаров в выбраной категории :(</div>');

    echo('</div>');
?>
