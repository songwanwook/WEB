<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
</head>
<body>
    <?php
        include "header.php";
        include "../db.php";
        $id = "";$num = "";$name = "";
        if(isset($_SESSION['session_id'])){
            $id = $_SESSION['session_id'];
            $name = $_SESSION['name'];
        }
        else{
            ?><script>alert("로그인 후 이용 가능합니다.");location.href = "login.php";</script><?php
        }
        if(isset($_GET['num'])){
            $num = $_GET['num'];
            $sql = "select * from download where num = $num";
            $result = mysqli_query($connect,$sql);
            $row = mysqli_fetch_array($result);
            if($id != $row['id']){
                ?><script>alert("게시글 작성자가 아닙니다.");history.back();</script><?php
                exit;
            }
        }
    ?>
    <h1>게시판</h1>
    <hr>
    <div class = "board">
        <div class = "title">글쓰기</div>
        <form action = <?php if(isset($_GET['num'])){echo "board_data_update.php?num=$num";}else{ echo "download_insert.php";}?> enctype = "multipart/form-data" method = "POST">
            <!--enctype = "multipart/form-data"가 있어야 파일 업로드 성공됨. -->
            <table class = "writetable">
                <tr class = "bordertop">
                    <th class = 'writehead'>별명</th>
                    <th style = "padding-left:5px;"><?php if(isset($_GET['num'])){echo $row['name'];}else{ echo $name; } ?></th>
                </tr>
                <tr class = "bordertop">
                    <th class = 'writehead'>제목</th>
                    <th><input type = "text" class = "writeinput" name = "subject" <?php if(isset($_GET['num'])){echo "value = '".$row['subject']."'";} ?>></th>
                </tr>
                <tr class = "bordertop">
                    <th class = 'writehead'>내용</th>
                    <th><textarea class = "writecontent" name = "content"><?php if(isset($_GET['num'])){echo $row['content'];} ?></textarea></th>
                </tr>
                <tr class = "bordertop">
                    <th class = 'writehead'>이미지파일1</th>
                    <th><?php 
                        if(isset($_GET['num']) && $row['filename_0'] != ""){
                            echo $row['filename_0']."이 등록되어 있습니다.<input type = 'hidden' name = 'file0' value = '".$row['filename_0']."'><input type = 'checkbox' name = 'delete0'>삭제</input>";
                        }else{ echo '<input type = "file" class = "fileupload file0" name = "file0">* 5MB까지 업로드 가능!';}?></th>
                </tr>
                <tr class = "bordertop">
                    <th class = 'writehead'>이미지파일2</th>
                    <th><?php 
                        if(isset($_GET['num']) && $row['filename_1'] != ""){
                            echo $row['filename_1']."이 등록되어 있습니다.<input type = 'hidden' name = 'file1' value = '".$row['filename_1']."'><input type = 'checkbox' name = 'delete1'>삭제</input>";
                        }else{ echo '<input type = "file" class = "fileupload file1" name = "file1">* 5MB까지 업로드 가능!';}?></th>
                </tr>
                <tr class = "bordertop bottom">
                    <th class = 'writehead'>이미지파일3</th>
                    <th><?php 
                        if(isset($_GET['num']) && $row['filename_2'] != ""){
                            echo $row['filename_2']."이 등록되어 있습니다.<input type = 'hidden' name = 'file2' value = '".$row['filename_2']."'><input type = 'checkbox' name = 'delete2'>삭제</input>";
                        }else{ echo '<input type = "file" class = "fileupload file2" name = "file2">* 5MB까지 업로드 가능!';}?></th>
                </tr>
            </table>
            <div class = "submitdiv1"><input type = "submit" class = "write" <?php if(isset($_GET['num'])){echo "value = '수정'";}else{echo 'value = "글쓰기"';}?>>
            <input type = "reset" class = "list" value = "목록"></div>
        </form>
    </div>
    <script>
        $(".file0").on("change", function(){
            let maxSize = 5 * 1024 * 1024; //* 5MB 사이즈 제한
            let fileSize = this.files[0].size; //업로드한 파일용량
            if(fileSize > maxSize){
                alert("파일첨부 사이즈는 5MB 이내로 가능합니다.");
                $(this).val(''); //업로드한 파일 제거
                return; 
            }
        });
        $(".file1").on("change", function(){
            let maxSize = 5 * 1024 * 1024; //* 5MB 사이즈 제한
            let fileSize = this.files[0].size; //업로드한 파일용량
            if(fileSize > maxSize){
                alert("파일첨부 사이즈는 5MB 이내로 가능합니다.");
                $(this).val(''); //업로드한 파일 제거
                return; 
            }
        });
        $(".file2").on("change", function(){
            let maxSize = 5 * 1024 * 1024; //* 5MB 사이즈 제한
            let fileSize = this.files[0].size; //업로드한 파일용량
            if(fileSize > maxSize){
                alert("파일첨부 사이즈는 5MB 이내로 가능합니다.");
                $(this).val(''); //업로드한 파일 제거
                return; 
            }
        });
        $(".list").on("click",function(){
            location.href = "board_data.php";
        });
    </script>
</body>
</html>