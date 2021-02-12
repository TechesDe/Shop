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

    $types=$QUERY->AllTypes();
    $typeOptions='';
    for($i=0;$i<count($types);$i++){
      $typeid=$types[$i][0];
      $typeOptions=$typeOptions.'<option type="radio" value='.$typeid.'>'.$types[$i][1].'</option>';
    }
    $manafacturers=$QUERY->AllManafacturers();
    $manafacturersOptions='';
    for($i=0;$i<count($manafacturers);$i++){
      $manafacturersid=$manafacturers[$i][0];
      $manafacturername=$manafacturers[$i][1];
      if($manafacturername==''){
        $manafacturername='Производитель отсутствует';
      }
      $manafacturersOptions=$manafacturersOptions.'<option type="radio" value='.$manafacturersid.'>'.$manafacturername.'</option>';
    }
    return '
    <form enctype="multipart/form-data" class="addcardform" action="functions/addmodel.php" method="POST">
      <input id="imgfile" class="img" type="file" name="image"/>
      <p class="lable"><label for="imgfile">Load image</label></p>
      <select class="selecttype" name="type">'.$typeOptions.'</select>
      <div>
        <select class="addmanafacturer" name="manafacturer">'.$manafacturersOptions.'</select>
        <input class="addmodel" type="text" placeholder="Название модели" name="model" value="" />
      </div>
      <input type="number" min="0" placeholder="Штрих-код" name="barcode" value="" />
      <input type="text" placeholder="Краткое опиание" name="description" value="" />
      <input type="number" min="0" placeholder="Цена" name="price" value="" />
      <button type="submit" class="addcardbtm">Добавить
      </button>
    </form>';
  }
?>
