<?php
    include "../db.php";
    $name = $_GET['name'];
    $id = $_GET['id'];
    $sql = "select password from youngjin where id = '$id' and name = '$name'";
    $result = mysqli_query($connect, $sql);
    if(mysqli_num_rows($result)>=1){
        $row = mysqli_fetch_array($result);
        echo json_encode(array("msg"=>"회원님의 비밀번호는 <span class = 'myid'>".$row['password']."</span> 입니다."));
    }
    else{
        echo json_encode(array("msg"=>"false"));
    }
?>