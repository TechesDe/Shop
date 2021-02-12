<link rel="stylesheet" href="/css/info.css">
<script>
  function showedit(category,description,model,button){
    category=document.getElementById(category);
    description=document.getElementById(description);
    button=document.getElementById(button);
    category.setAttribute("type","textarea");
    description.setAttribute("type","textarea");
    button.setAttribute("style","display:unset");
  }
</script>
<div class="infocontainer">
  <?php
  require_once "query/querys.php";
  $models=$QUERY->AllModels();
  $description='';
  if(isset($_POST['id']))
  {
    $id=$_POST['id'];
    $models=$QUERY->ModelsByID($id);
    $alldescription=$QUERY->DescriptionByIdModel($id);
  }
  
  if(isset($_POST['Page']))
    $page=$_POST['Page'];
  else
    $page=0;
  if(count($models)<=$page+1){
    $modelname=$models[$page][0];
    $manafacturer=$models[$page][1];
    $type=$models[$page][2];
    $img=$models[$page][3];
  }
  require_once "special/check.php";
  $description='';
  for($i=0;$i<count($alldescription);$i++)
    if($alldescription[$i][2]!='briefly'){
      $description=$description.'<tr><td class="category">'.$alldescription[$i][2].':</td><td class="categorydesc"> '.$alldescription[$i][1].'</td>';
      if($access=='seller'||$access=='admin'){
        $inputs='\''.$id.'modDescritCategory'.$i.'\',\''.$id.'modDescritDesc'.$i.'\',\''.$id.'modDescritID'.$i.'\',\''.$id.'modbutton'.$i.'\'';
        $description=$description.
        '<td><button onclick="
        showedit('.$inputs.')">Изменить</button>
        <form action="functions/editDescription.php" method="POST">'.
        '<input id="'.$id.'modDescritCategory'.$i.'" type="hidden" name="category" value="'.$alldescription[$i][2].'">'.
        '<input id="'.$id.'modDescritDesc'.$i.'" type="hidden" name="description" value="'.$alldescription[$i][1].'">'.
        '<input type="hidden" name="id" value="'.$alldescription[$i][3].'">'.
        '<input type="hidden" name="idmodel" value="'.$id.'">'.
        '<button id="'.$id.'modbutton'.$i.'" type="submit" style="display:None">Отправить</button></form></td>';
      }
      $description=$description.
      '</tr>';
    }
  
  $addDescription='';
  if($access=='seller'||$access=='admin'){
   
    $addDescription=$addDescription.'<form action="functions/addDescription.php" method="POST">'.
   '<input type="textarea" name="category" placeholder="введите категорию">:'.
   '<input type="textarea" name="description" placeholder="введите описание">'.
   '<input type="hidden" name="idmodel" value="'.$id.'">'.
   '<button type="submit">Добавить</button></form>';
  }

  $inner="
  <h1 class='typename'>$type</h1>";
  if($access=='seller'||$access=='admin'){
    $inner=$inner.'<form action="functions/editType.php" method="POST">'.
    '<input type="hidden" name="idmodel" value="'.$id.'">'.
    '<button type="submit">Изменить</button></form>';
  }
  $inner=$inner."
  <h2 class='modelname'>$manafacturer $modelname</h2>";
  if($access=='seller'||$access=='admin'){
    $inner=$inner.'<form action="functions/editModel.php" method="POST">'.
    '<input type="hidden" name="idmodel" value="'.$id.'">'.
    '<button type="submit">Изменить</button></form>';
  }
  $inner=$inner."
  <div class='content'>
    <image class='img' src='$img'/>
    <div class='descriptions'>
    <h1>Характеристики</h1>
    <table>".$description."</table>"
    .$addDescription."
    </div>
  </div>
  ";
  echo ($inner);
  ?>
</div>