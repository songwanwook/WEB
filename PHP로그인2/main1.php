<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <style>
        *{
            align-items:center;
            margin:auto;
        }
        div{
            width:800px;
            height:40px;
            display:flex;
            text-align:right;
            background-color:lightgray;
        }
        a{
            text-decoration:none;
            color:black;
        }
    </style>
</head>
<body>
    <div>
        <?php
        session_start();
        if(!isset($_SESSION['session_id'])){
        ?>
            <a href = "login1.html">▶ 로그인</a>
            <a href = "join1.html">▶ 회원가입</a>
        <?php
        }
        else{
            echo $_SESSION['session_id']."님 환영합니다.";
        ?>
            <a href = "logout1.php">▶ 로그아웃</a>
        <?php
        }
        ?>
    </div>
</body>
</html>