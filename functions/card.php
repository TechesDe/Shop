<?php
  function createCard($img, $type, $manafacturer, $model, $id,$description,$price)
  {
    if($img==''){
      $img='/img/default.png';
    }
    return '
    <form class="cardform" action="/info.php" method="POST">
      <button type="submit" class="card">

        <img class="cardimage" src="'.$img.'" />
        <div class="prices">
        <p class="cardprice">'.$price.'</p>
        <p class="cardsale">-5%</p>
        </div>
        <div class="cardname">
        <h3>'.$type.'</h3>
        <p>'.$manafacturer.' '.$model.'</p>
        </div>
        <p>'.$description.'</p>

      </button>
      <input type="hidden" name="id" value='.$id.'>
      <input type="hidden" name="type" value='.$type.'>
      <input type="hidden" name="manafacturer" value='.$manafacturer.'>
      <input type="hidden" name="model" value='.$model.'>
    </form>';
  }

  function addCard(){
    require_once "query/querys.php";
    $QUERY=new Query('localhost','root','','production');
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
      $manafacturersOptions=$manafacturersOptions.'<option type="radio" value='.$manafacturersid.'>'.$manafacturers[$i][1].'</option>';
    }
    $script="<script>
    document.getElementById('imgfile').onchange = function() {
      if(document.getElementById('imgfile').value!=''&&document.getElementById('imgfile').files[0].type.startsWith('image/')){
        document.getElementById('imglable').style.display=\"none\";
        var img = document.createElement(\"img\");
        img.classList.add(\"addCardImg\");
        //img.file = file;
        //Created By TechesDePainture
        document.getElementsByClassName('lable')[0].appendChild(img);

        var reader = new FileReader();
        reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
        reader.readAsDataURL(document.getElementById('imgfile').files[0]);
      }
      else
        {
          document.getElementsByClassName('lable')[0].lastElementChild.remove();
          document.getElementById('imglable').style.display=\"unset\";
          document.getElementById('imglable').innerHTML='Файл не выбран';
        }

    };

    </script>";
    return '
    <form enctype="multipart/form-data" class="addcardform" action="functions/addmodel.php" method="POST">
      <input id="imgfile" class="img" type="file" name="image"/>
      <p class="lable"><label id="imglable" for="imgfile">Load image</label></p>
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
    </form>'.$script;
  }
?>
