<?php
  function createCard($img, $type, $manafacturer, $model, $id,$description,$price)
  {
    if($img==''){
      $img='/img/default.png';
    }
    return '
    <form class="cardform" action="/info.php" method="POST">
      <button type="submit" class="card">
        <img src="'.$img.'" />
        <h3>'.$type.'</h3>
        <p>'.$manafacturer.' '.$model.'</p>
        <p>'.$description.'</p>
        <p>'.$price.'</p>
      </button>
      <input type="hidden" name="id" value='.$id.'>
    </form>';
  }

  function addCard(){
    require_once "query/querys.php";
    require_once "selectors.php";
    return '
    <link rel="stylesheet" href="/css/card.css">
    <form enctype="multipart/form-data" class="addcardform" action="functions/addmodel.php" method="POST">
      <input id="imgfile" class="img" type="file" name="image"/>
      <p class="lable"><label for="imgfile">Load image</label></p>
      '.createSelectorTypes($QUERY).'
      <div>
        '.createSelectorManafacturers($QUERY).'
        <input class="addmodel" type="text" placeholder="Название модели" name="model" value="" />
      </div>
      <input class="addbarcode" type="number" min="0" placeholder="Штрих-код" name="barcode" value="" />
      <input class="addbriefly" type="text" placeholder="Краткое опиание" name="description" value="" />
      <input class="addprice" type="number" min="0" placeholder="Цена" name="price" value="" />
      <button type="submit" class="addcardbtm">Добавить
      </button>
    </form>';
  }
?>
