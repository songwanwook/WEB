<?php
    include "../db.php";
    $id = $_GET['id'];
    $sql = "select id from youngjin where id = '$id'";
    $result = mysqli_query($connect,$sql);
    if(mysqli_num_rows($result)>=1){
        echo json_encode(array("msg"=>"false"));
    }
    else{
        echo json_encode(array("msg"=>"true"));
    }
?>