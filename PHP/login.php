<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
</head>
<body>
    <?php
        include "header.php";
    ?>
    <h1>로그인 페이지</h1>
    <hr>
    <form action = "loginok.php" method = "POST" class = "loginform">
        <p>로그인 폼</p>
        <p><label for = "id">아이디 : </label><input type = "text" name = "id" size = "20"></p>
        <p><label for = "password">비밀번호 : </label><input type = "password" name = "password" size = "20"></p>
        <div class = "submitdiv"><input type = "submit" class = "submit" value = "로그인"><input type = "reset" class = "cancel" value = "취소"></div>
    </form>
    <script>
        $(".cancel").on("click",function(){
            location.href = "index.php";
        });
    </script>
</body>
</html>