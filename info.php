<?php
    include "../db.php";
    if(isset($_SESSION['ID'])){
        $sql = "select * from myhouse where id = '".$_SESSION['ID']."'";
        $result = mysqli_query($connect,$sql);
        $row = mysqli_fetch_array($result);
        $name = $row['name'];
    }
?>