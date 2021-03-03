<link rel="stylesheet" href="/css/info.css">
<link rel="stylesheet" href="/css/main.css">
<script type="text/javascript" src="/js/ShowAndHideFunctions.js"></script>
<?php
require_once "functions/selectors.php";
require_once "query/querys.php";
require_once "special/check.php";
if(isset($_POST['id']))
{
  $id=$_POST['id'];
  $models=$QUERY->ModelsByID($id);
  $alldescription=$QUERY->DescriptionByIdModel($id);
  if(count($models)==1){
    $modelname=$models[0][0];
    $manafacturer=$models[0][1];
    $type=$models[0][2];
    $img=$QUERY->ImagesByModelID($id);
    $price=$QUERY->LastPriceByModelId($id);
    $inner="";
    $image[0]='img/default.png';
    for($i=0;$i<count($img);$i++)
      $image[$i] = str_ireplace("\\","/",$img[$i][1]);
  }
}
?>

<?php
function descriptionTable($alldescription,$idmodel,$access){
    for($i=0;$i<count($alldescription);$i++)
      if($alldescription[$i][2]!='briefly'): ?>
        <tr>
          <td class="category"> <?php echo $alldescription[$i][2]?>:</td><td class="categorydesc"> <?php echo $alldescription[$i][1]?></td>
        <?php if($access=='seller'||$access=='admin'):?>
            <td><button onclick=
              " show('modDescritCategory<?php echo $i?>');
                show('modDescritDesc<?php echo $i?>');
                show('modbutton<?php echo $i?>');"
              >Изменить</button></td>
            <td>
              <form action="functions/deleteDescription.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $alldescription[$i][3]?>">
                <input type="hidden" name="idmodel" value="<?php echo $idmodel?>">
                <button class="deletebtm" type="submit">Удалить</button>
              </form>
            </td>
        </tr>
        <tr>
            <form action="functions/editDescription.php" method="POST">
              <td><input class="tableinput" id="modDescritCategory<?php echo $i?>" type="textarea" name="category" value="<?php echo $alldescription[$i][2]?>" style="display:none;"></td>
              <td><input class="tableinput" id="modDescritDesc<?php echo $i?>" type="textarea" name="description" value="<?php echo $alldescription[$i][1]?>" style="display:none;"></td>
              <td><button class="greenaccept" id="modbutton<?php echo $i?>" type="submit" style="display:None">Отправить</button></td>
              <input type="hidden" name="id" value="<?php echo $alldescription[$i][3]?>">
              <input type="hidden" name="idmodel" value="<?php echo $idmodel?>">
            </form>
        <?php endif;?>
        </tr>
      <?php endif?>

  <?php if($access=='seller'||$access=='admin'):?>
    <tr>
    <form action="functions/addDescription.php" method="POST">
      <td><input class="tableinput" type="textarea" name="category" placeholder="введите категорию"></td>
      <td><input class="tableinput" type="textarea" name="description" placeholder="введите описание"></td>
      <td><button class="greenaccept" type="submit">Добавить</button></td>
      <input type="hidden" name="idmodel" value="<?php echo $idmodel?>">
    </form>
    </tr>
  <?php endif;?>
<?php }?>

<?php
function editTypeForm($access,$id,$QUERY){
  if($access=='seller'||$access=='admin'):?>
    <button onclick="show('type')">Изменить</button>
    <form id="type" action="functions/editType.php" method="POST" style="display:none">
      <input type="hidden" name="idmodel" value="<?php echo $id?>">
      <?php echo createSelectorTypes($QUERY)?>
      <button class="greenaccept" type="submit">Отправить</button>'.
    </form>
  <?php endif; ?>
<?php }?>


<?php
function editManafacturerAndNameForm($access,$id,$QUERY,$modelname){
  if($access=='seller'||$access=='admin'):?>
    <button onclick="show('manafacturername')">Изменить</button>
    <form id="manafacturername" action="functions/editModel.php" method="POST" style="display:none">
      <input type="hidden" name="idmodel" value="<?php echo $id?>">
      <?php echo createSelectorManafacturers($QUERY)?>
      <input type="textarea" name="name" value="<?php echo $modelname?>">
      <button class="greenaccept" type="submit">Отправить</button>
    </form>
  <?php endif; } ?>

<div class="infocontainer">
<?php
  if(isset($COOKIE['message']))
    print_r($COOKIE['message']);
  if(isset($COOKIE['error']))
    print_r($COOKIE['error']);
?>

  <?php if(isset($_POST['id'])):?>
    <div class='typename'><h1><?php echo "$type"?></h1><?php editTypeForm($access,$id,$QUERY)?></div>
    <div class='modelname'><h2><?php echo "$manafacturer $modelname"?></h2><?php editManafacturerAndNameForm($access,$id,$QUERY,$modelname)?></div>
    <div class='content'>
      <?php if($access=='seller'||$access=='admin')
      echo createEditSelectorImage($image,$modelname,$id);
        else
      echo createSelectorImage($image,$modelname); ?>
      <div class='descriptions'>
        <div class="price"><?php echo $price?>₽</div>
        <h1>Характеристики</h1>
        <table>
          <?php descriptionTable($alldescription,$id,$access)?>
        </table>
      </div>
      <?php if($access=='seller'||$access=='admin'): ?>
        <form action="functions/deleteModel.php" method="POST">
          <input type="hidden" name="idmodel" value="<?php echo $id?>">
          <button type="submit">Удалить модель</button>
        </form>
      <?php endif;?>
    </div>
  <?php endif; ?>
</div>
