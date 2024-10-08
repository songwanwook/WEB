<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel = "stylesheet" type = "text/css" href = "css/style.css?var1">
    <script type = "text/javascript" src = "../jquery-1.10.2.js"></script>
</head>
<body>
    <div class = "header flex">
        <a href = "index.php"><img src = "images/서진컴.jpg"></a>
        <ul class = "flex">
            <?php
            if(!isset($_SESSION['session_id']) || !isset($_SESSION['name'])){ ?>
            <a href = "login.php">로그인</a>
            <a href = "join_form.php">회원가입</a>
            <?php 
            }
            else{
            ?>
                <a href = "logout.php">로그아웃</a>
            <?php 
            }
             ?>
        </ul>
    </div>
    <div class = "headermenu">
        <ul class = "flex">
            <a href = "index.php">home</a>
            <a href = "guest.php">방명록</a>
            <a href = "board.php">게시판</a>
            <a href = "board_data.php">자료실</a>
            <a href = "gallery.php">갤러리</a>
        </ul>
    </div>
</body>
</html>