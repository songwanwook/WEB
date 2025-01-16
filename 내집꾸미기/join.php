<?php
    include "../db.php";
    $name = $_POST['name'];//이름
    $ID = $_POST['ID'];//ID
    $PW = $_POST['PW'];//패스
    $file = $_POST['file'];//프사
    $sql = "insert into myhouse values('$name','$ID','$PW','$file')";
    mysqli_query($connect,$sql);
?>