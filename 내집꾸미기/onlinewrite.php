<?php
    session_start();
    if(!isset($_SESSION['ID'])){
        ?>
        <script>
            alert("로그인 후 이용하실 수 있습니다.");
            location.href = "index.php";
        </script>
        <?php
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
    <script src = "js/jquery-1.10.2.js"></script>
    <script src = "js/online.js"></script>
    <script src = "js/script.js"></script>
    <script src = "js/exit.js"></script>
</head>
<body>
    <?php include "side.php"; include "header.php";?>
    <div class = "bg width100">
        <h1 style = "padding:40px;">온라인 집들이 후기 글쓰기</h1>
        <form class = "writing flex column" onsubmit="allowFormSubmission()" enctype = "multipart/form-data" action = "writing.php" method = "POST">
            <!--enctype = "multipart/form-data"가 있어야 파일 업로드 성공됨. -->
            <p style = "margin-bottom:10px;">작성자 : <?php include "info.php"; echo $name."(".$_SESSION["ID"].")" ?></p>
            <input type = "text" name = "subject" placeholder = "제목을 입력하세요" required></input>
            <textarea name = "contents" placeholder = "내용을 작성하세요" required></textarea>
            <div class = "flex" style = "padding:20px;">
                <div class = "flex column" style = "margin:10px;">
                    <img class = "reviewimg img1" alt = "집들이 전"/>
                    <input type = "file" class = "beforeimage" name = "beforeimage" accept=".jpg, .jpeg, .png" required></input>
                </div>
                <div class = "flex column" style = "margin:10px;">
                    <img class = "reviewimg img2" alt = "집들이 후"/>
                    <input type = "file" class = "afterimage" name = "afterimage" accept=".jpg, .jpeg, .png" required></input>
                </div>
            </div>
            <div class = "flex" style = "margin-bottom:30px;">
                <input type = "submit" value = "작성" class = "submit"/>
                <button type = "button" class = "cancelwrite">취소</button>
            </div>
        </form>
    </div>
    <?php include "footer.php";?>
</body>
</html>