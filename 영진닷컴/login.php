<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
    <script type = "text.javascript" src = "../jquery-1.10.2.js"></script>
    <style>
        .login{
            margin:auto;
            padding-top:30px;
            width:88%;
        }
        .loginheader{
            display:flex;
            justify-content:space-between;
            border-bottom:1px solid black;
        }
        .logincolor{
            color:rgb(2,172,146);
        }
        .loginheader > p{
            font-size:12px;
            margin-top:25px;
        }
        .bold{
            font-weight:bold;
        }
        .title{
            margin-top:60px;
            font-size:27px;
            text-align:center;
        }
        .loginform{
            width:400px;
            height:400px;
            margin:auto;
            background-color:rgb(250,250,250);
            border: 1px solid lightgray;
            align-items:center;
        }
        .loginform > h1{
            text-align:center;
        }
        .loginform > h1 > span{
            width:249px;
        }
        input{
            width:225px;
            font-size:15px;
            padding:10px;
        }
        .submit{
            width:249px;
            border:unset;
            background-color:rgb(2,172,146);
            color:white;
            text-decoration:underline;
        }
        .submenu{
            margin:auto;
            display:flex;
            font-size:10px;
            width:249px;
            text-align:left;
        }
        a{
            text-decoration:none;
            color:black;
        }
        .submenu > div{
            display:flex;
            flex-direction:column;
            width:50%;
        }
        .submenu > a{
            margin-top:10px;
        }
        .check{
            width:13px;
        }
    </style>
</head>
<body>
    <?php
        include "main.php";
    ?>
    <div class = "login">
        <div class = "loginheader">
            <h2>로그인</h2>
            <p>홈 > 회원서비스 > <span class = "logincolor">로그인</span></p>
        </div>
        <p class = "title">YOUNGJIN.COM 홈페이지를 이용하려면 <span class = "bold">로그인이 필요합니다.</bold></p>
        <form class = "loginform" action = "youngjinlogin.php">
            <h1><span class = "logincolor">YOUNGJIN.COM</span><br><span>LOGIN</span><h1>
            <input type = "text" name = "id" placeholder = "아이디" required></input>
            <input type = "password" name = "password" placeholder = "비밀번호" required></input>
            <input type = "submit" value = "확인" class = "submit"></input>
            <div class = "submenu">
                <div>
                    <div><label>ID저장</label><input type = "checkbox" class = "check"></div>
                    <a href = "findidpw.php">아이디/비밀번호 찾기</a>
                </div>
                <a href = "signin.php" class = "logincolor">회원가입</a>
            </div>
        </form>
    </div>
</body>
</html>