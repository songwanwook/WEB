<?php
    session_start();
    include "../db.php";
    if(!isset($_POST['ID'])) exit;
    if(!isset($_POST['PW'])) exit;
    $ID = $_POST['ID'];//ID
    $PW = $_POST['PW'];//패스
    $sql = "select * from myhouse where ID = '$ID' and PW = '$PW'";
    $result = mysqli_query($connect,$sql);
    $rows = mysqli_num_rows($result);
    if($rows >= 1){
        $_SESSION['ID']=$ID;
        echo json_encode(array("msg"=>"success"));
    }
    else{
        echo json_encode(array("msg"=>"false"));
    }
?>