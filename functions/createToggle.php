<link rel="stylesheet" href="/css/toggle.css">
<?php
function getOptionToSelect($i,$prefix,$mass){
  $transToogle2="transToogle('$i','$mass','$prefix')";
  return
  "<div class=\"opt\" onclick=\"$transToogle2\">
      <div class=\"non-active circle\" id=\"$prefix$i\" pos=\"$i\" val=\"$mass\" currntpos=\"$i\" style=\"top:0px; opacity:1\"></div>
      <p class=\"option\">$mass</p>
  </div>";
}
function getControlOption($prefix,$num){
  $id=$prefix.'active';
  return
  "<div class=\"active circle\" id=\"$id\" val=\"\" pos=\"$num\" currntpos=\"$num\" style=\"top:0px;\"></div>";
}
?>

<?php
function createToggleFromMassiveVer2($massive,$prefix,$name){
  $toggle='
  <div class="toggle">
      <input id="'.$prefix.'Input" style="display:none" type="text" name="'.$name.'" value="">';
  for($i=0;$i<count($massive);$i++){
    $toggle=$toggle.getOptionToSelect($i,$prefix,$massive[$i]);
  }
  $toggle=$toggle.'
    <div class="opt">
      '.getControlOption($prefix,count($massive)).'
      <div class="redbtm" onclick="clearToggle(\''.$prefix.'\')">Очистить</div>
    </div>
  </div>';
  return $toggle;
}
?>
<script type="text/javascript" src="/js/toggle.js"></script>
