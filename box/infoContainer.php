<link rel="stylesheet" href="/css/info.css">
<link rel="stylesheet" href="/css/main.css">
<script>
  function showedit(category,description,model,button){
    category=document.getElementById(category);
    description=document.getElementById(description);
    button=document.getElementById(button);
    category.setAttribute("type","textarea");
    description.setAttribute("type","textarea");
    button.setAttribute("style","display:unset");
  }
  function show(id){
    toshow=document.getElementById(id);
    toshow.setAttribute("style","display:block");
  }
</script>
<?php
function descriptionTable($alldescription,$idmodel,$access){
  $description='';
    for($i=0;$i<count($alldescription);$i++)
      if($alldescription[$i][2]!='briefly'){
        $description=$description.'<tr>'.
        '<td class="category">'.$alldescription[$i][2].':</td><td class="categorydesc"> '.$alldescription[$i][1].'</td>';
        
        if($access=='seller'||$access=='admin'){
          $inputs='\'modDescritCategory'.$i.'\',\'modDescritDesc'.$i.'\',\'modDescritID'.$i.'\',\'modbutton'.$i.'\'';
          $description=$description.
          '<td><button onclick="showedit('.$inputs.')">Изменить</button></td>
          <td>
            <form action="functions/deleteDescription.php" method="POST">
            <input type="hidden" name="id" value="'.$alldescription[$i][3].'">
            <input type="hidden" name="idmodel" value="'.$idmodel.'">
            <button class="deletebtm" type="submit">Удалить</button>
            </form>
          </td>
          </tr>
          <tr>
          <form action="functions/editDescription.php" method="POST">
          <td>
          <input class="tableinput" id="modDescritCategory'.$i.'" type="hidden" name="category" value="'.$alldescription[$i][2].'"></td>
          <td><input class="tableinput" id="modDescritDesc'.$i.'" type="hidden" name="description" value="'.$alldescription[$i][1].'"></td>
          <input type="hidden" name="id" value="'.$alldescription[$i][3].'">
          <input type="hidden" name="idmodel" value="'.$idmodel.'">
          <td><button class="greenaccept" id="modbutton'.$i.'" type="submit" style="display:None">Отправить</button></td>
          </form>
          </tr>
          
          ';
        }
        else{
          $description=$description.'</tr>';
        }
      }
  if($access=='seller'||$access=='admin'){
    $description=$description.'
    <tr>
    <form action="functions/addDescription.php" method="POST">
    <td><input class="tableinput" type="textarea" name="category" placeholder="введите категорию"></td>
    <td><input class="tableinput" type="textarea" name="description" placeholder="введите описание"></td>
    <input type="hidden" name="idmodel" value="'.$idmodel.'">
    <td><button class="greenaccept" type="submit">Добавить</button></td>
    </form>
    </tr>';
  }
  return $description;
}
function editTypeForm($access,$id,$QUERY){
  $result='';
  if($access=='seller'||$access=='admin'){

    $result=$result.'<button onclick="show(\'type\')">Изменить</button>'.
    '<form id="type" action="functions/editType.php" method="POST" style="display:none">'.
    '<input type="hidden" name="idmodel" value="'.$id.'">'.
    createSelectorTypes($QUERY).
    '<button class="greenaccept" type="submit">Отправить</button>'.
    '</form>';
  }
  return $result;
}
function editManafacturerAndNameForm($access,$id,$QUERY,$modelname){
  $result='';
  if($access=='seller'||$access=='admin'){
    $result=$result.
    '<button onclick="show(\'manafacturername\')">Изменить</button>'.
    '<form id="manafacturername" action="functions/editModel.php" method="POST" style="display:none">'.
    '<input type="hidden" name="idmodel" value="'.$id.'">'.
    createSelectorManafacturers($QUERY).
    '<input type="textarea" name="name" value="'.$modelname.'">'.
    '<button class="greenaccept" type="submit">Отправить</button></form>';
  }
  return $result;
}

?>
<div class="infocontainer">
  <?php
  require_once "functions/selectors.php";
  require_once "query/querys.php";
  if(isset($COOKIE['message']))
    print_r($COOKIE['message']);
  if(isset($COOKIE['error']))
    print_r($COOKIE['error']);
  $models=$QUERY->AllModels();
  $description='';
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
    }
    require_once "special/check.php";
    $description=descriptionTable($alldescription,$id,$access);
    

    $inner="
    <div class='typename'><h1>$type</h1>".editTypeForm($access,$id,$QUERY)."</div>";
    $inner=$inner."
    <div class='modelname'><h2>$manafacturer $modelname</h2>".editManafacturerAndNameForm($access,$id,$QUERY,$modelname)."</div>";
    $image[0]='img/default.png';
    for($i=0;$i<count($img);$i++)
      $image[$i] = str_ireplace("\\","/",$img[$i][1]);
    $inner=$inner."
    <div class='content'>";
    if($access=='seller'||$access=='admin')
    $inner=$inner.createEditSelectorImage($image,$modelname,$id);
      else
    $inner=$inner.createSelectorImage($image,$modelname);

    $price=$QUERY->LastPriceByModelId($id);
    $price='<div class="price">'.$price.'₽</div>';
    $delete='';
    if($access=='seller'||$access=='admin')
      $delete=$delete.'<form action="functions/deleteModel.php" method="POST">'.
      '<input type="hidden" name="idmodel" value="'.$id.'">'.
      '<button type="submit">Удалить модель</button>'.
      '</form>';
    $inner=$inner."
      <div class='descriptions'>"
      .$price.
      "<h1>Характеристики</h1>
      <table>".$description."</table>
      </div>".
      $delete."
    </div>
    ";

    echo ($inner);
  }
  ?>
</div>

