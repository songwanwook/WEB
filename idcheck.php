<?php
    include "../db.php";
    $ID = $_GET["ID"];
    $sql = "select id from myhouse where id = '$ID'";
    $result = mysqli_query($connect,$sql);
    if(mysqli_num_rows($result)>=1){
        echo json_encode(array("msg"=>"false"));
    }
    else{
        echo json_encode(array("msg"=>"true"));
    }
?>