<?php //extraFunctions
function getListmanafacurers($id,$QUERY){
  $mafacters=$QUERY->getManafacrurersByIDType($id);
  for($j=0;$j<count($mafacters);$j++){
    $manafacturers[$j]=$mafacters[$j][1];
  }
  return $manafacturers;
}
?>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Play&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/menu2.css">
<script type='text/javascript' src='/js/cssRedactor.js'></script>
<nav>
<div id="navbtm" class="wrapper" onclick="showAndHideMenu()" style="margin:10px;"><span id="naviginner" class="orange-btm">Показать категории ❯</span></div>

<div class="menu">
<form id="menu" action="/index.php" method="post">
  <input id="menutype" type="hidden" name="type" value="">
  <input id="menumanufacturer" type="hidden" name="manufacturer" value="">
</form>
<?php if(isset($_POST['type'])): ?>
<div id="searchlable" class="search">Условия поиска:</div>
<?php endif?>

<?php
require_once "query/querys.php";
require_once "functions/createToggle.php";
$types=$QUERY->getTypesWithManafacrures();

for($i=0;$i<count($types);$i++){
  $typename=$types[$i][1];
  echo "<div id='$typename-box' class='box'>"
  ."<div class='typeName' onclick=\"showAndSubmit('$typename-box','$typename','$typename-manafacturerInput','$i-seletion');\" >
  <span id='$typename-name' typeName='$typename' class='nametype'>"
  .$typename."</span>
  </div>";
  echo "<div id='$i-seletion' class='seletion'>";
  $mafacters=getListmanafacurers($types[$i][0],$QUERY);
  echo createToggleFromMassiveVer2($mafacters,$typename.'-manafacturer','manufacturer');
  echo "</div>";
  echo "</div>";
}

?>
</div>
</nav>
<script>
  const ACTIVE_CLASS_BOX="activebox";
  const NOT_ACTIVE_CLASS_BOX="box";
  let menustate=false;
  let selections=document.getElementsByClassName('seletion');
  for(let i=0;i<selections.length;i++){
    selections[i].setAttribute('sizeH',selections[i].scrollHeight);
    selections[i].setAttribute('sizeW',selections[i].scrollWidth);
  }
  cssCorrect('menu2','.seletion','height','0px');
  function showAndSubmit(id,typeName,idinput,selec){
    let elem=document.getElementById(id);
    let typeInput=document.getElementById('menutype');
    typeInput.setAttribute('value',typeName);
    let manafactInput=document.getElementById('menumanufacturer');
    let option=document.getElementById(idinput);
    manafactInput.setAttribute('value',option.getAttribute('value'));
    if(elem.className==ACTIVE_CLASS_BOX){
      document.getElementById('menu').submit();
    }
    else{
      let elems=document.getElementsByClassName(ACTIVE_CLASS_BOX);
      while (elems.length>0) {
        elems[0].className=NOT_ACTIVE_CLASS_BOX;
      }
      elems=document.getElementsByClassName('nametype');
      for(let i=0;i<elems.length;i++){
        elems[i].innerHTML=elems[i].getAttribute('typeName');
      }
      elems=document.getElementById(typeName+'-name');
      elems.innerHTML="Искать";
      let selections=document.getElementsByClassName('seletion');
      for(let i=0;i<selections.length;i++){
        selections[i].removeAttribute('style');
      }
      selec=document.getElementById(selec);
      selec.setAttribute('style','height: '+selec.getAttribute('sizeH')+'px');
      elem.className=ACTIVE_CLASS_BOX;
    }
  }
  function showAndHideMenu(){
    if(!menustate){
      cssCorrect('menu2','.menu','left','0%');
      menustate=true;
      document.getElementById('naviginner').innerHTML="Спрятать категории ❮";
    }
    else {
      cssCorrect('menu2','.menu','left','-100%');
      menustate=false;
      document.getElementById('naviginner').innerHTML="Показать категории ❯";
    }
  }
</script>
