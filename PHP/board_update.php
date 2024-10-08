<?php
    include "../db.php";
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    $num = $_GET['num'];
    $file0 = "";$file1 = "";$file2 = "";
    $unlink = 'data/';
    $imgcheck = "select * from test_board where num = $num";//수정할 파일에 이미지가 있는지 확인
    $result = mysqli_query($connect,$imgcheck);
    $row = mysqli_fetch_array($result);
    if($row['filename_0'] != ""){//이미지가 있을때 처리
        if(isset($_POST['delete0'])){//이미지 삭제하기
            $deleteimageselect = "select * from test_board where filename_0 = '".$row['filename_0']."' or filename_1 = '".$row['filename_0']."' or filename_2 = '".$row['filename_0']."'";
            $result = mysqli_query($connect,$deleteimageselect);
            if(mysqli_num_rows($result)>1){//1개 이상 있을 때
                $file0 = "";
            }
            else{//하나만 있을때 이미지 삭제
                $unlink = $unlink.$_POST['file0'];
                unlink($unlink);
                $file0 = "";
            }
        }
        else{
            $file0 = $_POST['file0'];
        }
    }
    else{//이미지가 없을 때 재등록
        $file0 = $_FILES['file0']['name'];
        $upload_file = $unlink.$file0;
        move_uploaded_file($_FILES['file0']['tmp_name'], $upload_file);
    }
    if($row['filename_1'] != ""){//이미지가 있을때 처리
        if(isset($_POST['delete1'])){//이미지 삭제하기
            $deleteimageselect = "select * from test_board where filename_0 = '".$row['filename_1']."' or filename_1 = '".$row['filename_1']."' or filename_2 = '".$row['filename_1']."'";
            $result = mysqli_query($connect,$deleteimageselect);
            if(mysqli_num_rows($result)>1){//1개이상 있을 때
                $file1 = "";
            }
            else{//하나만 있을 때 이미지 삭제
                $unlink = $unlink.$_POST['file1'];
                unlink($unlink);
                $file1 = "";
            }
        }
        else{
            $file1 = $_POST['file1'];
        }
    }
    else{
        $file1 = $_FILES['file1']['name'];
        $upload_file = $unlink.$file1;
        move_uploaded_file($_FILES['file1']['tmp_name'], $upload_file);
    }
    if($row['filename_2'] != ""){//이미지가 있을때 처리
        if(isset($_POST['delete2'])){//이미지 삭제하기
            $deleteimageselect = "select * from test_board where filename_0 = '".$row['filename_2']."' or filename_1 = '".$row['filename_2']."' or filename_2 = '".$row['filename_2']."'";
            $result = mysqli_query($connect,$deleteimageselect);
            if(mysqli_num_rows($result)>1){//1개이상 있을 때
                $file2 = "";
            }
            else{//하나만 있을 때 삭제
                $unlink = $unlink.$_POST['file2'];
                unlink($unlink);
                $file2 = "";
            }
        }
        else{
            $file2 = $_POST['file2'];
        }
    }
    else{
        $file2 = $_FILES['file2']['name'];
        $upload_file = $unlink.$file2;
        move_uploaded_file($_FILES['file2']['tmp_name'], $upload_file);
    }
    if($subject == "" || trim($subject) == ""){
        ?><script>alert("제목을 입력하세요.");history.back();</script><?php
        exit;
    }
    if(($content == "" || trim($content) == "")&& $file0 == "" && $file1 == "" && $file2 == ""){
        ?><script>alert("내용을 입력하세요.");history.back();</script><?php
        exit;
    }
    $sql = "update test_board set subject = '$subject', content = '$content', filename_0 = '$file0', filename_1 = '$file1', filename_2 = '$file2' where num = $num";
    if(mysqli_query($connect,$sql)){
        ?><script>alert("게시글이 수정되었습니다.");location.href = "board_view.php?num=<?php echo $num ?>"</script><?php
    }
    else{
        ?><script>alert("게시글 수정 중 오류가 발생했습니다.");</script><?php
    }
?>