<?php
$QUERY=new Query('localhost','root','','production');

class Query{
    public $connect;

    function __construct($site,$login,$password,$database)
    {
        $this->connect=mysqli_connect($site,$login,$password,$database);
        if(!isset($this->connect)){
            echo('Error to connection at database');
            $this->connect=mysqli_connect('localhost','root','','production');
        }
    }

    function AllModels(){
        $models=mysqli_query($this->connect,"
        SELECT `model`.`name`, `manufacturer`.`name`, `type`.`name`, `model`.`ID_model`
        FROM `model`
        INNER JOIN `manufacturer` ON `manufacturer`.`ID_manufacturer`=`model`.`ID_manufacturer`
        INNER JOIN `type` ON `type`.`ID_Type`=`model`.`ID_type`
        ");
        $models=mysqli_fetch_all($models);
        return $models;
    }


    function AllTypes(){
        return mysqli_fetch_all(mysqli_query($this->connect,"
        SELECT * FROM `type`
        "));
    }

    function AllManafacturers(){
        return mysqli_fetch_all(mysqli_query($this->connect,"
        SELECT * FROM `manufacturer`
        "));
    }

    function getTypesWithManafacrures(){
        return mysqli_fetch_all(mysqli_query($this->connect,"
        SELECT `type`.`ID_Type`,`type`.`name`
        FROM `type`
        INNER JOIN `model`
        ON `type`.`ID_Type`=`model`.`ID_type`
        INNER JOIN `manufacturer`
        ON `manufacturer`.`ID_manufacturer`=`model`.`ID_manufacturer`
        GROUP BY `type`.`name`
        "));
    }
    function getManafacrurersByIDType($id){
        return mysqli_fetch_all(mysqli_query($this->connect,"
              SELECT `manufacturer`.`ID_manufacturer`,`manufacturer`.`name`
          FROM `manufacturer`
          INNER JOIN `model`
          ON `manufacturer`.`ID_manufacturer`=`model`.`ID_manufacturer`
          INNER JOIN `type`
          ON `type`.`ID_Type`=`model`.`ID_type`
          WHERE `type`.`ID_Type`='$id'
          GROUP BY `manufacturer`.`name`
          "));
    }

    function UsersByPhone($phone){
      $users=mysqli_query($this->connect,
      "
      SELECT `user`.`Email`, `user`.`Phone`, `user`.`password`,`user`.`ID_User`
      FROM `user`
      WHERE `Phone` = $phone
      ");
      $users=mysqli_fetch_all($users);
      return $users;
    }

    function UsersByEmail($email){
      $users=mysqli_query($this->connect,
      "
      SELECT `user`.`Email`, `user`.`Phone`, `user`.`password`,`user`.`ID_User`
      FROM `user`
      WHERE `Email` LIKE('%$email%')
      ");
      $users=mysqli_fetch_all($users);
      return $users;
    }

    function addUser($email,$phone,$pass,$first_name,$second_name,$last_name){
      if($first_name=='')
        $first_name='NULL';
      if($second_name=='')
        $second_name='NULL';
      if($last_name=='')
        $last_name='NULL';
      mysqli_query($this->connect,"
      INSERT INTO `user` (`ID_User`, `Email`, `Phone`, `Password`, `Access`, `First_Name`, `Second_Name`, `Extra_Name`)
      VALUES (NULL, '$email', $phone, '$pass', 'customer', '$first_name', '$second_name', '$last_name');
      ");
    }

    function UserByID($id){
      $users=mysqli_query($this->connect,
      "
      SELECT *
      FROM `user`
      WHERE `user`.`ID_User` = $id
      ");
      $users=mysqli_fetch_all($users);
      return $users;
    }

    function DescriptionByIdModel($id)
    {
        $alldescription=mysqli_query($this->connect,"
            SELECT *
            FROM `characteristics`
            WHERE `characteristics`.`ID_Model` =$id
        ");
        $alldescription=mysqli_fetch_all($alldescription);
        return $alldescription;
    }

    function IDDescriptionByIDModelCategoryAndDescription($id,$category,$descript){
        $alldescription=mysqli_query($this->connect,"
            SELECT `characteristics`.`ID_Characteristic`
            FROM `characteristics`
            WHERE `characteristics`.`ID_Model` =$id
            AND `characteristics`.`Category` LIKE ('$category')
            AND `characteristics`.`Description` LIKE ('$descript')
        ");
        $alldescription=mysqli_fetch_all($alldescription);
        return $alldescription;
    }

    function UpdateDescription($id,$model,$category,$description){
        mysqli_query($this->connect,"
        UPDATE  `characteristics` SET
        `ID_Model` = $model,
        `Description` = '$description',
        `Category` = '$category'
        WHERE `characteristics`.`ID_Characteristic` = $id
        ");
    }

    function addDescription($model,$category,$description){
        mysqli_query($this->connect,"
        INSERT INTO `characteristics` (`ID_Model`, `Description`, `Category`, `ID_Characteristic`) VALUES ('$model', '$description', '$category', NULL)
        ");
    }

    function ModelsByID($id){
        $models=mysqli_query($this->connect,"
        SELECT `model`.`name`, `manufacturer`.`name`, `type`.`name`, `model`.`ID_model`,`model`.`BarCode`
        FROM `model`
        INNER JOIN `manufacturer` ON `manufacturer`.`ID_manufacturer`=`model`.`ID_manufacturer`
        INNER JOIN `type` ON `type`.`ID_Type`=`model`.`ID_type`
        WHERE `model`.`ID_model` =$id
        ");
        $models=mysqli_fetch_all($models);
        return $models;
    }

    function ModelByName($name){
        $models=mysqli_query($this->connect,"
        SELECT *
        FROM `model`
        INNER JOIN `manufacturer` ON `manufacturer`.`ID_manufacturer`=`model`.`ID_manufacturer`
        INNER JOIN `type` ON `type`.`ID_Type`=`model`.`ID_type`
        WHERE `model`.`name` LIKE ('%$name%')
        ");
        return mysqli_fetch_all($models);
    }

    function ModelByBarcode($barcode){
      $model=mysqli_query($this->connect,"
      SELECT *
      FROM `model`
      INNER JOIN `manufacturer` ON `manufacturer`.`ID_manufacturer`=`model`.`ID_manufacturer`
      INNER JOIN `type` ON `type`.`ID_Type`=`model`.`ID_type`
      WHERE `model`.`BarCode`=$barcode
      ");
      return mysqli_fetch_all($model);
    }

    function LastPriceByModelId($id){
        $price=mysqli_query($this->connect,"
        SELECT *
        FROM `model_price`
        WHERE `model_price`.`ID_model` = $id
        ORDER BY `Date` DESC
        ");
        $price=mysqli_fetch_all($price);
        if(count($price)>0)
            $price=$price[0][1];
        else
            $price='NO Price';
        return $price;
    }

    function addPriceToday($id,$price){
        $date=date('y-m-j');
        mysqli_query($this->connect,"
        INSERT INTO `model_price` (`ID_model`, `Price`, `Date`) VALUES ('$id', '$price', '$date')
        ");
    }

    function BrieflyDescriptonByModelId($id){
        $desc=mysqli_query($this->connect,"
            SELECT *
            FROM `characteristics`
            WHERE `characteristics`.`ID_Model` =$id AND `characteristics`.`Category` LIKE ('%briefly%')
        ");
        $desc=mysqli_fetch_all($desc);
        if(count($desc)>0)
            $description=$desc[0][1];
        else
            $description='Краткое описание отсутсвует';
        return $description;
    }

    function addBrieflyDescripton($id,$description){
        mysqli_query($this->connect,"
        INSERT INTO `characteristics` (`ID_Model`, `Description`, `Category`, `ID_Characteristic`)
        VALUES ('$id', '$description', 'briefly', NULL)
        ");
    }

    function ModelByType($type){
        $model=mysqli_query($this->connect,"
            SELECT `model`.`name`, `manufacturer`.`name`, `type`.`name`,`model`.`ImgPath`, `model`.`ID_model`
            FROM `model`
            INNER JOIN `manufacturer` ON `manufacturer`.`ID_manufacturer`=`model`.`ID_manufacturer`
            INNER JOIN `type` ON `type`.`ID_Type`=`model`.`ID_type`
            WHERE `type`.`name` LIKE ('%$type%')
        ");

        $model=mysqli_fetch_all($model);
        return $model;
    }

    function ModelByManafacturer($manafacturer){
        $model=mysqli_query($this->connect,"
            SELECT `model`.`name`, `manufacturer`.`name`, `type`.`name`,`model`.`ImgPath`, `model`.`ID_model`
            FROM `model`
            INNER JOIN `manufacturer` ON `manufacturer`.`ID_manufacturer`=`model`.`ID_manufacturer`
            INNER JOIN `type` ON `type`.`ID_Type`=`model`.`ID_type`
            WHERE `manufacturer`.`name` LIKE ('%$manafacturer%')
        ");

        $model=mysqli_fetch_all($model);
        return $model;
    }

    function ModelByTypeAndManafacturer($type,$manafacturer){
        $model=mysqli_query($this->connect,"
            SELECT `model`.`name`, `manufacturer`.`name`, `type`.`name`, `model`.`ID_model`
            FROM `model`
            INNER JOIN `manufacturer` ON `manufacturer`.`ID_manufacturer`=`model`.`ID_manufacturer`
            INNER JOIN `type` ON `type`.`ID_Type`=`model`.`ID_type`
            WHERE `manufacturer`.`name` LIKE ('%$manafacturer%') AND `type`.`name` LIKE ('%$type%')
        ");

        $model=mysqli_fetch_all($model);
        return $model;
    }

    function UpdateModelName($id,$name){
        mysqli_query($this->connect,"
            UPDATE `model` SET `name` = '$name' WHERE `model`.`ID_model` = $id
        ");
    }

    function UpdateModelManafacturer($id,$manafacturer){
        mysqli_query($this->connect,"
            UPDATE `model` SET `ID_manufacturer` = '$manafacturer' WHERE `model`.`ID_model` = $id
        ");
    }

    function UpdateModelType($id,$type){
        mysqli_query($this->connect,"
            UPDATE `model` SET `ID_type` = '$type' WHERE `model`.`ID_model` = $id
        ");
    }

    function ManafacturerByName($name){
        $manufacturer=mysqli_query($this->connect,
                "SELECT `type`.`name`, `manufacturer`.`name`
                FROM `type`
                LEFT JOIN `model` ON `type`.`ID_Type`=`model`.`ID_type`
                LEFT JOIN `manufacturer` ON `model`.`ID_manufacturer`=`manufacturer`.`ID_manufacturer`
                WHERE `type`.`name` LIKE ('$name')
                GROUP BY `manufacturer`.`name`
                ");
        $manufacturer=mysqli_fetch_all($manufacturer);
        return $manufacturer;
    }

    function addModel($barcode,$name,$IdType,$IdManafacturer,$imgpath){
        mysqli_query($this->connect,"
        INSERT INTO `model` (`ID_model`, `BarCode`, `name`, `ID_type`, `ID_manufacturer`)
        VALUES (NULL, '$barcode', '$name', '$IdType', '$IdManafacturer')
        ");
        $id=$this->ModelByBarcode($barcode);
        $id=$id[0][0];
        $this->addImage($id,$imgpath);
    }

    function addModelWithoutImg($barcode,$name,$IdType,$IdManafacturer){
        mysqli_query($this->connect,"
        INSERT INTO `model` (`ID_model`, `BarCode`, `name`, `ID_type`, `ID_manufacturer`)
        VALUES (NULL, '$barcode', '$name', '$IdType', '$IdManafacturer')
    ");
    }

    function TypeByID($id){
        return mysqli_fetch_all(mysqli_query($this->connect,"
        SELECT * FROM `type`
        WHERE `type`.`ID_Type`=$id
        "));
    }

    function addType($name){
        mysqli_query($this->connect,"
        INSERT INTO `type` (`ID_Type`, `name`) VALUES (NULL, '$name')
        ");
    }

    function addManafacturer($name){
        mysqli_query($this->connect,"
        INSERT INTO `manufacturer` (`ID_manufacturer`, `name`) VALUES (NULL, '$name')
        ");
    }

    function ImagesByModelID($id){
      return mysqli_fetch_all(mysqli_query($this->connect,"
      SELECT * FROM `images`
      WHERE `images`.`ID_Model`=$id
      "));
    }

    function addImage($id,$path){
      mysqli_query($this->connect,"
      INSERT INTO `images` (`ID_Model`, `Path`, `number`) VALUES ('$id', '$path', NULL)
      ");
    }

    function updateImage($path,$id){
      mysqli_query($this->connect,"
      UPDATE `images` SET `Path`='$path' WHERE `ID_Model`=$id
      ");
    }

    function deleteImage($path){
      mysqli_query($this->connect,"
      DELETE FROM `images` WHERE `Path` LIKE ('$path')
      ");
    }

    function deleteModel($id){
    mysqli_query($this->connect,"
      DELETE FROM `model` WHERE `ID_model`=$id
      ");
    }

    function deleteDescription($id){
    mysqli_query($this->connect,"
      DELETE FROM `characteristics` WHERE `ID_Characteristic`=$id
      ");
    }

    function numderLastImage(){
        $result=mysqli_fetch_all(mysqli_query($this->connect,"
        SELECT `number` FROM `images` ORDER BY `number` DESC LIMIT 1
        "));
        $result=$result[0][0];
        return $result;
    }

    function error(){
      return(mysqli_error($this->connect));
    }
}
?>
