<?php
    include "../db.php";
    $ID = $_POST['ID'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $contents = $_POST['contents'];
    $sql = "insert into quotation(ID, name, date, contents) values('$ID','$name','$date','$contents')";
    mysqli_query($connect, $sql);
    ?><script>alert("견적을 요청하였습니다.");location.href = "quotation.php";</script><?php
?>