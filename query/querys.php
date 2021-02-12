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
        SELECT `model`.`name`, `manufacturer`.`name`, `type`.`name`,`model`.`ImgPath`, `model`.`ID_model`
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
        INSERT INTO `characteristics` (`ID_Model`, `Description`, `Category`, `ID_Characteristic`) VALUES ('$model', '$category', '$description', NULL)
        ");
    }

    function ModelsByID($id){
        $models=mysqli_query($this->connect,"
        SELECT `model`.`name`, `manufacturer`.`name`, `type`.`name`,`model`.`ImgPath`, `model`.`ID_model`
        FROM `model`
        INNER JOIN `manufacturer` ON `manufacturer`.`ID_manufacturer`=`model`.`ID_manufacturer`
        INNER JOIN `type` ON `type`.`ID_Type`=`model`.`ID_type`
        WHERE `model`.`ID_model` =$id
        ");
        $models=mysqli_fetch_all($models);
        return $models;
    }

    function ModelByName($name){
        $model=mysqli_query($this->connect,"
        SELECT *
        FROM `model`
        INNER JOIN `manufacturer` ON `manufacturer`.`ID_manufacturer`=`model`.`ID_manufacturer`
        INNER JOIN `type` ON `type`.`ID_Type`=`model`.`ID_type`
        WHERE `model`.`name` LIKE ('%$name%')
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
            SELECT `model`.`name`, `manufacturer`.`name`, `type`.`name`,`model`.`ImgPath`, `model`.`ID_model`
            FROM `model`
            INNER JOIN `manufacturer` ON `manufacturer`.`ID_manufacturer`=`model`.`ID_manufacturer`
            INNER JOIN `type` ON `type`.`ID_Type`=`model`.`ID_type`
            WHERE `manufacturer`.`name` LIKE ('%$manafacturer%') AND `type`.`name` LIKE ('%$type%')
        ");

        $model=mysqli_fetch_all($model);
        return $model;
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
        INSERT INTO `model` (`ID_model`, `BarCode`, `name`, `ID_type`, `ID_manufacturer`, `ImgPath`)
        VALUES (NULL, '$barcode', '$name', '$IdType', '$IdManafacturer', '$imgpath')
    ");
    }

    function addModelWithoutImg($barcode,$name,$IdType,$IdManafacturer){
        mysqli_query($this->connect,"
        INSERT INTO `model` (`ID_model`, `BarCode`, `name`, `ID_type`, `ID_manufacturer`, `ImgPath`)
        VALUES (NULL, '$barcode', '$name', '$IdType', '$IdManafacturer', NULL)
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
}


?>
