
<link rel="stylesheet" href="/css/menu.css">
<script type='text/javascript' src='/js/cssRedactor.js'></script>
<script type='text/javascript' src='/js/classChanger.js'></script>
<script>
function nameChange(id,first,second){
  let element=document.getElementById(id);

  let elements=document.getElementsByClassName('orange');
  Array.prototype.forEach.call(elements,function(item){
      item.className='empty';
      item.innerHTML=item.id;
  });

  if(element.innerHTML==first)
    {
      element.innerHTML=second;
      element.className='orange';
  }


}
</script>
<div class="menu">
    <div class="lable"><h1>Меню</h1></div>
    <div class="searching">
        <h3>
            <?php
                if(isset($_POST['type'])){
                    echo('Условия поиска: '.$_POST['type']);
                    $searchtype=$_POST['type'];
                }
                else
                    $searchtype='';
                if(isset($_POST['manufacturer'])){
                    echo(' '.$_POST['manufacturer']);
                    $searchmanafacturer=$_POST['manufacturer'];
                }
                else
                    $searchmanafacturer='';
            ?>
        </h3>
    </div>
    <?php
        require_once "special/connect.php";
        require_once "query/querys.php";
        $types=$QUERY->AllTypes();

        for($i=0;$i<count($types);$i++){
            $subtypetxt='';
            $name=$types[$i][1];
            $subtype=$QUERY->ManafacturerByName($name);
            if($subtype[0][1]!=''){
              $mafacters=array();
              for($j=0;$j<count($subtype);$j++){
                $mafacters[$j]=$subtype[$j][1];
              }
              require_once "functions/createToggle.php";
              $function="nameChange('$name','$name','Искать')";
              $subtypetxt="<div>Производитель</div>
              <div onclick=".$function.">";
              $subtypetxt=$subtypetxt.createToggleFromMassiveVer2($mafacters,$name.'-manafacturer','manufacturer');
              $subtypetxt=$subtypetxt."
              </div>";
            }else{
              $subtypetxt='';
            }
            echo '
            <div id="'.$name.'box" class="box">
                <form id="'.$name.'from" action="/index.php" method="POST">
                    <button type="submit" class="empty" id="'.$name.'">'.$name.'</button>
                    <input type="hidden" name="type" value='.$name.'></input>
                    <div class="selection">
                      <div class="manafacturerSelect">'.$subtypetxt.'</div>
                      <div style="width:100px">Еще селектор</div>
                      <div style="width:100px">Еще селектор</div>
                      <div style="width:100px">Еще селектор</div>
                    </div>
                </form>
            </div>';
        }
        echo "<div class='specialcontent'> Контейнер спец предложений</div>


        <script type='text/javascript'>
        let selections=document.getElementsByClassName('selection');
        let max=0;
        for(let i=0;i<selections.length;i++){
          if(max< selections[i].scrollWidth){
            max=selections[i].scrollWidth;
          }
        }
        cssCorrect('menu','.menu .box .selection','left','-'+max+'px');
        boxes=document.getElementsByClassName('box');
        for(let i=0;i<boxes.length;i++){
          boxes[i].addEventListener('click',setUniqueClass.bind(this,'boxactive','box'));
        }
        </script>";
    ?>
</div>
