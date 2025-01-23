<?php
    session_start();
    $ID = $_SESSION['ID'];
    include "../db.php";
    include "info.php";
    $professionalID = $_POST['professionalID'];
    $proname = $_POST['proname'];
    $contents = $_POST['contents'];
    $cost = $_POST['cost'];
    $score = $_POST['proscore'];
    $sql = "update professional set professionalCOUNT = professionalCOUNT + 1, professionalSUM = professionalSUM + $score,
     professionalAVG = professionalSUM/professionalCOUNT where professionalID = '$professionalID'";
    mysqli_query($connect, $sql);
    $img = $_FILES['afterimage']['name'];
    $uploads_dir = "professionalreview/";
    $upload_file = "";
    $sql = "insert into professionalreview(name, ID, contents, reviewimg, cost, specialistID, specialistNAME, professionalscore, date)
     values('$name','$ID','$contents','$img',$cost,'$professionalID','$proname',$score,now())";
    if(mysqli_query($connect,$sql)){
        $upload_file = $uploads_dir.$img;
        move_uploaded_file($_FILES['afterimage']['tmp_name'], $upload_file);
        ?><script>alert("게시글이 등록되었습니다.");location.href = "professional.php"</script><?php
        exit;
    }
?>
