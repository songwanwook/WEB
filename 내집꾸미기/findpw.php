<?php
    include "../db.php";
    $ID = $_GET["ID"];
    $sql = "select PW from myhouse where ID = '$ID'";
    $result = mysqli_query($connect,$sql);
    $PW = "";
    if(mysqli_num_rows($result)>=1){
        if($row = mysqli_fetch_array($result)){
            $PW = $row['PW'];
        }
        echo json_encode(array("msg"=>$PW));
    }
    else{
        echo json_encode(array("msg"=>"false"));
    }
?>