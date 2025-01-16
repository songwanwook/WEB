<?php
    session_start();
    include "../db.php";
    $ID = $_SESSION['ID'];//전문가
    include "info.php";//전문가 이름
    $quono = $_POST['quono'];//견적 번호
    $cost = $_POST['cost'];//견적 가격
    $contents = $_POST['contents'];//견적 내용
    $sql = "insert into sendquotation(quono, cost, contents, specialist, specialistname) values($quono, $cost, '$contents','$ID','$name')";
    mysqli_query($connect, $sql);
    $sql = "update quotation set quocount = quocount + 1 where no = $quono";
    mysqli_query($connect, $sql);
    ?><script>alert("견적을 보냈습니다.");location.href = "quotation.php"</script><?php
?>