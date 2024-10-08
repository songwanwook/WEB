<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type = "text.javascript" src = "../jquery-1.10.2.js"></script>
    <style>
        .header{
            display:flex;
            justify-content:space-between;
            padding:20px;
        }
        ul{
            list-style:none;
            display:flex;
            padding-right:100px;
            font-size:12px;
        }
        .header > img{
            margin-left:80px;
            height:50px;
        }
        li{
            margin:10px;
        }
        a{
            text-decoration:none;
            color:black;
        }
        .bg{
            height:40px;
            background-color:rgb(2,172,146);
        }
        .border{
            border-right:1px solid black;
            margin:10px 0px;
        }
    </style>
</head>
<body>
    <div class = "header">
        <a href = "main.php"><img src = "src/LOGO.jpg"></a>
        <ul class = "menu">
            <?php
                if(!isset($_SESSION['session_id'])){ ?>
                    <li><a href = "main.php">홈</a></li><span class = "border"></span>
                    <li><a href = "login.php">로그인</a></li><span class = "border"></span>
                    <li><a href = "signin.php">회원가입</a></li><span class = "border"></span>
                    <li><a href = "findidpw.php">아이디/비밀번호 찾기</a></li>
                <?php }
                else{ ?>
                    <li><a href = "main.php">홈</a></li><span class = "border"></span>
                    <li><a href = "logout.php">로그아웃</a></li><span class = "border"></span>
                    <li><a href = "updateinfo.php?id=<?php echo $_SESSION['session_id']; ?>">정보변경</a></li>
            <?php } ?>
        </ul>
    </div>
    <div class = "bg">
</body>
</html>