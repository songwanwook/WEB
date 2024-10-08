<?php
    session_start();
    include "../db.php";
    $name = ""; $id = "";
    if(isset($_SESSION['name'])){
        $name = $_SESSION['name'];
        $id = $_SESSION['session_id'];
    }
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    $file0 = $_FILES['file0']['name'];
    $file1 = $_FILES['file1']['name'];
    $file2 = $_FILES['file2']['name'];
    $uploads_dir = "data/";
    $upload_file = "";
    if($subject == "" || trim($subject) == ""){
        ?><script>alert("제목을 입력하세요.");history.back();</script><?php
        exit;
    }
    else if(($content == "" || trim($content) == "") && $file0 == "" && $file1 == "" && $file2 == ""){
        ?><script>alert("내용을 입력하세요.");history.back();</script><?php
        exit;
    }
    else{
        $sql = "insert into test_board(id, name, subject, content, regdate, filename_0, filename_1, filename_2) values('$id', '$name', '$subject', '$content', now(), '$file0', '$file1', '$file2')";
        if(mysqli_query($connect,$sql)){
            if($file0 != ""){
                $upload_file = $uploads_dir.$file0;
                move_uploaded_file($_FILES['file0']['tmp_name'], $upload_file);
            }
            if($file1 != ""){
                $upload_file = $uploads_dir.$file1;
                move_uploaded_file($_FILES['file1']['tmp_name'], $upload_file);
            }
            if($file2 != ""){
                $upload_file = $uploads_dir.$file2;
                move_uploaded_file($_FILES['file2']['tmp_name'], $upload_file);
            }
            $sql1 = "set @count = 0";
            mysqli_query($connect, $sql1);
            $sql2 = "update test_board set num = @count:=@count+1;";
            mysqli_query($connect, $sql2);
            ?><script>alert("게시글이 등록되었습니다.");location.href = "board.php"</script><?php
            exit;
        }
        else{
            ?><script>alert("게시글 작성 중 오류가 발생했습니다.");</script><?php
        }
    }
?>