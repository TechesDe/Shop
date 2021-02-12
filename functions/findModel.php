<?php
//Returns models relevant searching in DATABASE
  function findModel($model,$subtype,$type){
    require_once "../special/connect.php";

    $type=mysqli_query($connect,"SELECT `model`.`Name`, `subtype`.`name`, `type`.`name`, `model`.`ImgPath`
        FROM `model`
            LEFT JOIN `subtype` ON `model`.`ID_Subtype` = `subtype`.`ID_Subtype`
            LEFT JOIN `type` ON `subtype`.`ID_Type`=`type`.`ID_Type`
        WHERE `model`.`Name` LIKE ('%$model%')
        AND `subtype`.`name` LIKE ('%$subtype%')
        AND `type`.`name` LIKE ('%$type%')");
    $type=mysqli_fetch_all($type);
    return $type;
  }
  //Returns all models in DATABASE
  function findModel(){
    require_once "../special/connect.php";
    $type=mysqli_query($connect,"SELECT `model`.`Name`, `subtype`.`name`, `type`.`name`, `model`.`ImgPath`
        FROM `model`
            LEFT JOIN `subtype` ON `model`.`ID_Subtype` = `subtype`.`ID_Subtype`
            LEFT JOIN `type` ON `subtype`.`ID_Type`=`type`.`ID_Type`");
    $type=mysqli_fetch_all($type);
    return $type;
  }

?>
