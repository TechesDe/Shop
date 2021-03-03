

<?php
function createSelectorTypes($QUERY){
  $types=$QUERY->AllTypes();
  $typeOptions='';
  for($i=0;$i<count($types);$i++){
    $typeid=$types[$i][0];
    $typeOptions=$typeOptions.'<option type="radio" value='.$typeid.'>'.$types[$i][1].'</option>';
  }
?>
  <select class="selecttype" name="type"><?=$typeOptions?></select>';
<?=}?>


<?php
function createSelectorManafacturers($QUERY){
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

  ?> <select class="addmanafacturer" name="manafacturer"><?=$manafacturersOptions?></select>
<?=}?>

<?php
function createSelectorImage($massive,$prefix){
  ?>
  <script>
  function imagechanger(there,img){
    there=document.getElementById(there);
    there.setAttribute('src',img);
  }
  </script>
  <link href="/css/imageselector.css" rel="stylesheet">
  <?=
  $result='<div class="imageSelector">';
  $result=$result.'<img id="'.$prefix.'" class="selectimage" src="'.$massive[0].'">';
  if(count($massive)<=6)
    $result=$result.'<div class="selectimagebox" style="overflow-x: hidden;">';
  else
    $result=$result.'<div class="selectimagebox">';
  for($i=0;$i<count($massive);$i++){
    $result=$result.'<img class="miniimage" onclick="imagechanger(\''.$prefix.'\',\''.$massive[$i].'\')" src="'.$massive[$i].'">';
  }
  $result=$result.'</div></div>';
  echo $result;
}
?>

<?php
function createEditSelectorImage($massive,$prefix,$id){
  $script="<script>
  document.getElementById('file').onchange = function() {
    if(document.getElementById('file').value!=''&&document.getElementById('file').files[0].type.startsWith('image/')){
      document.getElementById('lablefile').innerHTML='';
      var img = document.createElement(\"img\");
      img.classList.add(\"miniimage\");
      img.file = file;
      document.getElementById('lablefile').appendChild(img);

      var reader = new FileReader();
      reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
      reader.readAsDataURL(document.getElementById('file').files[0]);
    }
    else
      document.getElementById('lablefile').innerHTML='Файл не выбран';
  };

  </script>";
  $result='<script>
  function imageeditchanger(there,img){
    let s=\'input\'+there;
    there=document.getElementById(there);
    there.setAttribute(\'src\',img);
    let input=document.getElementById(s);
    input.setAttribute(\'value\',img);
  }
  function setdeleteimage(from,prefix){
    let input=document.getElementById(\'inputdoing\'+prefix);
    input.setAttribute(\'value\',\'delete\');
    chagecolorsbtm(from)
  }
  function setreplaseimage(from,prefix){
    let input=document.getElementById(\'inputdoing\'+prefix);
    input.setAttribute(\'value\',\'replase\');
    chagecolorsbtm(from)
  }
  function setNone(from,prefix){
    let input=document.getElementById(\'inputdoing\'+prefix);
    input.setAttribute(\'value\',\'None\');
    chagecolorsbtm(from)
  }
  function chagecolorsbtm(from){
    let elements=document.getElementsByClassName(\'ADEbtms\');
    for(elem of elements){
      elem.setAttribute(\'class\',\'greenbtm ADEbtms\');
    }
    from=document.getElementById(from);
    from.setAttribute(\'class\',\'orangebtm ADEbtms\');
  }

  </script>
  <link href="/css/imageselector.css" rel="stylesheet">
  <form enctype="multipart/form-data" class="imageSelector" id="imagechange" action="functions/editImages.php" method="POST" >';
  $result=$result.'<img id="'.$prefix.'" class="selectimage" src="'.$massive[0].'">';
  $result=$result.'<input id="input'.$prefix.'" type="hidden" name="image" value="'.$massive[0].'">';
  $result=$result.'<input id="inputdoing'.$prefix.'" type="hidden" name="doing" value="None">';
  $result=$result.'<input type="hidden" name="idmodel" value="'.$id.'">';
  if(count($massive)<=3)
    $result=$result.'<div class="selectimagebox" style="overflow-x: hidden;">';
  else
    $result=$result.'<div class="selectimagebox">';
  for($i=0;$i<count($massive);$i++){
    $result=$result.'<img class="miniimage" onclick="imageeditchanger(\''.$prefix.'\',\''.$massive[$i].'\')" src="'.$massive[$i].'">';
  }
  $result=$result.'
  <label for="file" class="uploadimagelabel" id="lablefile"><div>Выберите изображение</div></label>
  <input type="file" class="uploadimage" id="file" name="sourse" multiple>
  ';

  $result=$result.'</div>
  <div class="buttons">
  <div id="None'.$prefix.'" class="orangebtm ADEbtms" onclick="setNone(\'None'.$prefix.'\',\''.$prefix.'\')">Добавление</div>
  <div id="delete'.$prefix.'" class="greenbtm ADEbtms" onclick="setdeleteimage(\'delete'.$prefix.'\',\''.$prefix.'\')">Удалить выбранное</div>
  <div id="replase'.$prefix.'" class="greenbtm ADEbtms" onclick="setreplaseimage(\'replase'.$prefix.'\',\''.$prefix.'\')">Заменить выбранное</div>
  <button class="redbtm" type="submit">Отправить</button>
  </div>
  </form>'.$script;
  return $result;
}

?>
