<?php
    session_start();
    $ID = $_SESSION['ID'];
    include "../db.php";
    include "info.php";
    $subject = $_POST['subject'];
    $contents = $_POST['contents'];
    $beforeimg = $_FILES['beforeimage']['name'];
    $afterimg = $_FILES['afterimage']['name'];
    $uploads_dir = "review/";
    $upload_file_before = "";
    $upload_file_after = "";
    if(trim($subject) == ""){
        ?><script>alert("제목을 작성하세요.");history.back();</script><?php
    }
    else if(trim($contents) == "" || $contents == ""){
        ?><script>alert("내용을 작성하세요.");history.back();</script><?php
    }
    else{
        $sql = "insert into onlinehousing(title, contents, name, ID, beforeimg, afterimg, Date) values('$subject','$contents','$name','$ID','$beforeimg', '$afterimg', now())";
        if(mysqli_query($connect,$sql)){
            $upload_file_before = $uploads_dir.$beforeimg;
            $upload_file_after = $uploads_dir.$afterimg;
            move_uploaded_file($_FILES['beforeimage']['tmp_name'], $upload_file_before);
            move_uploaded_file($_FILES['afterimage']['tmp_name'], $upload_file_after);
            ?><script>alert("게시글이 등록되었습니다.");location.href = "online.php"</script><?php
            exit;
        }
        else{
            ?><script>alert("게시글 작성 중 오류가 발생했습니다.");//php측 에러 원인을 체크해야됨.</script><?php
        }
    }
?>