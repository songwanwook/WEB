<?php
    include "../db.php";
    $ID = $_POST['myid'];
    $img = $_POST['pimg'];
    $brand = $_POST['pbrand'];
    $name = $_POST['pname'];
    $price = $_POST['pprice'];
    $num = $_POST['pnum'];
    $sum = $_POST['psumprice'];
    $location = $_POST['location'];
    $sql = "insert into purchase values('$ID','$img','$brand','$name','$price',$num,'$sum',now(),'$location')";
    mysqli_query($connect,$sql);
?>