<?php
    include "../db.php";
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    $num = $_GET['num'];
    $file0 = "";$file1 = "";$file2 = "";
    $unlink = 'download/';
    $filecheck = "select * from download where num = $num";//수정할 파일이 있는지 확인
    $result = mysqli_query($connect,$filecheck);
    $row = mysqli_fetch_array($result);
    $filetype0 = "";$filetype1 = "";$filetype2 = "";
    if($subject == "" || trim($subject) == ""){
        ?><script>alert("제목을 입력하세요.");history.back();</script><?php
        exit;
    }
    if($row['filename_0'] != ""){//파일이 있을때 처리
        if(isset($_POST['delete0'])){//파일 삭제하기
            $isfileselect = "select * from download where filename_0 = '".$row['filename_0']."' or filename_1 = '".$row['filename_0']."' or filename_2 = '".$row['filename_0']."'";
            $result = mysqli_query($connect,$isfileselect);
            if(mysqli_num_rows($result)>=2){//2개 이상 있을 때
                $file0 = "";
            }
            else{//하나만 있을때 파일 삭제
                $unlink = $unlink.$_POST['file0'];
                unlink($unlink);
                $file0 = "";
            }
            $filetype0 = "";
        }
        else{
            $file0 = $_POST['file0'];
            $filetype0 = substr(strrchr($file0, "."), 1);
        }
    }
    else{//파일이 없을 때 재등록
        $file0 = $_FILES['file0']['name'];
        $filetype0 = substr(strrchr($file0, "."), 1);
        $upload_file = $unlink.$file0;
        move_uploaded_file($_FILES['file0']['tmp_name'], $upload_file);
    }
    if($row['filename_1'] != ""){//파일이 있을때 처리
        if(isset($_POST['delete1'])){//파일 삭제하기
            $isfileselect = "select * from download where filename_0 = '".$row['filename_1']."' or filename_1 = '".$row['filename_1']."' or filename_2 = '".$row['filename_1']."'";
            $result = mysqli_query($connect,$isfileselect);
            if(mysqli_num_rows($result)>=2){//2개이상 있을 때
                $file1 = "";
            }
            else{//하나만 있을 때 파일 삭제
                $unlink = $unlink.$_POST['file1'];
                unlink($unlink);
                $file1 = "";
            }
            $filetype1 = "";
        }
        else{
            $file1 = $_POST['file1'];
            $filetype1 = substr(strrchr($file1, "."), 1);
        }
    }
    else{
        $file1 = $_FILES['file1']['name'];
        $filetype1 = substr(strrchr($file1, "."), 1);
        $upload_file = $unlink.$file1;
        move_uploaded_file($_FILES['file1']['tmp_name'], $upload_file);
    }
    if($row['filename_2'] != ""){//파일이 있을때 처리
        if(isset($_POST['delete2'])){//파일 삭제하기
            $isfileselect = "select * from download where filename_0 = '".$row['filename_2']."' or filename_1 = '".$row['filename_2']."' or filename_2 = '".$row['filename_2']."'";
            $result = mysqli_query($connect,$isfileselect);
            if(mysqli_num_rows($result)>=2){//2개이상 있을 때
                $file2 = "";
            }
            else{//하나만 있을 때 삭제
                $unlink = $unlink.$_POST['file2'];
                unlink($unlink);
                $file2 = "";
            }
            $filetype2 = "";
        }
        else{
            $file2 = $_POST['file2'];
            $filetype2 = substr(strrchr($file2, "."), 1);
        }
    }
    else{
        $file2 = $_FILES['file2']['name'];
        $filetype2 = substr(strrchr($file2, "."), 1);
        $upload_file = $unlink.$file2;
        move_uploaded_file($_FILES['file2']['tmp_name'], $upload_file);
    }
    if(($content == "" || trim($content) == "")&& $file0 == "" && $file1 == "" && $file2 == ""){
        ?><script>alert("내용을 입력하세요.");history.back();</script><?php
        exit;
    }
    $sql = "update download set subject = '$subject', content = '$content', filename_0 = '$file0', filename_1 = '$file1', filename_2 = '$file2',
     file_type_0 = '$filetype0', file_type_1 = '$filetype1', file_type_2 = '$filetype2' where num = $num";
    if(mysqli_query($connect,$sql)){
        ?><script>alert("게시글이 수정되었습니다.");location.href = "board_data_view.php?num=<?php echo $num ?>"</script><?php
    }
    else{
        ?><script>alert("게시글 수정 중 오류가 발생했습니다.");</script><?php
    }
?>