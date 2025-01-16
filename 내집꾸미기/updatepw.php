<?php
    include "../db.php";
    $myid = $_POST['myid'];//내ID
    $nowPW = $_POST['nowPW'];//현재패스
    $PW = $_POST['newPW'];//새 패스
    $sql = "select * from myhouse where ID = '$myid'";//현재패스 찾기
    $result = mysqli_query($connect,$sql);
    $row = mysqli_fetch_array($result);
    if($row['PW'] == $nowPW){
        $sql = "update myhouse set PW = '$PW' where ID = '$myid'";
        mysqli_query($connect,$sql);
        echo json_encode(array("msg"=>"true"));
    }
    else{
        echo json_encode(array("msg"=>"false"));
    }
?>