<?php
    session_start();
    include "../db.php";
    $num = $_GET['num'];
    $id = "";
    if(isset($_SESSION['session_id'])){
        $id = $_SESSION['session_id'];
    }
    else{
        ?><script>alert("로그인 후 이용 가능합니다.");location.href = "login.php";</script><?php
        exit;
    }
    $sql = "select * from download where num = $num";
    $result = mysqli_query($connect,$sql);
    $row = mysqli_fetch_array($result);
    if($id != $row['id']){
        ?><script>alert("게시글 작성자가 아닙니다.");history.back();</script><?php
        exit;
    }
    else{
        if($row['filename_0'] != ""){
            $isdownload = "select * from download where filename_0 = '".$row['filename_0']."' or filename_1 = '".$row['filename_0']."' or filename_2 = '".$row['filename_0']."'";
            $result = mysqli_query($connect,$isdownload);
            if(mysqli_num_rows($result)>1){//1개 이상 있을 때
                $unlink = "";
            }
            else{
                $unlink = 'download/'.$row['filename_0'];
                unlink($unlink);
            }
        }
        if($row['filename_1'] != ""){
            $isdownload = "select * from download where filename_0 = '".$row['filename_1']."' or filename_1 = '".$row['filename_1']."' or filename_2 = '".$row['filename_1']."'";
            $result = mysqli_query($connect,$isdownload);
            if(mysqli_num_rows($result)>1){//1개 이상 있을 때
                $unlink = "";
            }
            else{
                $unlink = 'download/'.$row['filename_1'];
                unlink($unlink);
            }
        }
        if($row['filename_2'] != ""){
            $isdownload = "select * from download where filename_0 = '".$row['filename_2']."' or filename_1 = '".$row['filename_2']."' or filename_2 = '".$row['filename_2']."'";
            $result = mysqli_query($connect,$isdownload);
            if(mysqli_num_rows($result)>1){//1개 이상 있을 때
                $unlink = "";
            }
            else{
                $unlink = 'download/'.$row['filename_2'];
                unlink($unlink);
            }
        }
        /*$findfiles = "select filename_0, filename_1, filename_2 from download where num = $num";
        $result = mysqli_query($connect,$findfiles);
        $row = mysqli_fetch_array($result);*/
        $sql = "delete from download where num = $num";
        if(mysqli_query($connect,$sql)){
            $sql1 = "set @count = 0";
            mysqli_query($connect, $sql1);
            $sql2 = "update download set num = @count:=@count+1;";
            mysqli_query($connect, $sql2);//삭제된 게시글 번호 동기화
            ?><script>alert("게시글이 삭제되었습니다.");location.href = "board_data.php";</script><?php
        }
    }
?>