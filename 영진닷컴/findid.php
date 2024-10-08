<?php
    include "../db.php";
    $name = $_GET['name'];
    $email = $_GET['email1']."@".$_GET['email2'];
    $sql = "select id from youngjin where name = '$name' and email = '$email'";
    $result = mysqli_query($connect,$sql);
    if(mysqli_num_rows($result)>=1){
        $row = mysqli_fetch_array($result);
        echo json_encode(array("msg"=>"회원님의 ID는 <span class = 'myid'>".$row['id']."</span> 입니다."));
    }
    else{
        echo json_encode(array("msg"=>"false"));
    }
?>