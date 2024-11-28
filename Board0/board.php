<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
    <style>
        *{
            margin:auto;
        }
        .wrapper{
            width:1000px;
        }
        h1{
            background-color:bisque;
            width:100%;
            text-align:center;
        }
        .deleteboard{
            width:60%;
            padding:20px;
        }
        .name{
            width:20%;
        }
        .delete{
            width:40%;
        }
        .board{
            border: 1px solid black;
            width:80%;
            padding:10px;
        }
        p{
            width:100%;
        }
        .center{
            align-items:center;
            text-align:center;
        }
        .name1, .delete1{
            width:40%;
        }
        .contents{
            width:99%;
            height:200px;
        }
        .comment{
            margin-top:50px;
        }
        #notice{
            color:red;
        }
        .commentcontents{
            display:flex;
            justify-content:space-between;
        }
        .cancel{
            appearance: auto;
            user-select: none;
            align-items: flex-start;
            text-align: center;
            cursor: default;
            box-sizing: border-box;
            background-color: buttonface;
            color: black;
            white-space: pre;
            padding-block: 1px;
            padding-inline: 6px;
            border-width: 1px;
            font-size:15px;
            border-style: outset;
            border-color: black;
            border-image: initial;
            border-radius:2px;
            text-decoration:none;
        }
    </style>
</head>
<body>
    <div class = wrapper>
        <h1>게시판</h1>
        <form action = "deleteboard.php" method = "POST" class = "deleteboard">
            No : 
            <input type = "text" name = "name" class = "name">
            삭제키 : 
            <input type = "text" name = "delete" class = "delete">
            <input type = "submit" value = "삭제">
        </form>
        <a href = 'cancel.php' class = 'center' id = 'error' onclick = 'disableerror()'>경고문 없애기</a>
        <?php
            $notice = $_GET['notice'];
            ?>
            <?php
            if($notice == $_GET['notice']){
                echo "<p class = 'center' id = 'notice'>".$notice."</p>";
            }

                
        ?>
        <div class = "board">
        <form action = "writeboard.php" method = "POST" name = "write">
            <p class = "center">
                이름 : 
                <input type = "text" name = "name" class = "name1">
                삭제키 : 
                <input type = "text" name = "delete" class = "delete1">
            </p>
            <p>내용</p>
            <input type = "textarea" name = "contents" class = "contents">
            <p class = "center">
                <input type = "submit" value = "쓰기">
                <a href = "cancel.php" class = "cancel">취소</a>
            </p>
        </form>
    </div>
        <div class = "comment">
            <hr>
            <?php
                $mysql_host = "localhost";
                $mysql_user = "sgw";
                $mysql_password = "uk2643977!";
                $mysql_db = "sgw";
                $connect = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
                if(!$connect){
                    die("연결 실패".mysqli_connect_error());
                }
                $sql = "select * from board";
                $result = mysqli_query($connect, $sql);
                if(mysqli_num_rows($result)==0){
                    echo "<br><p>댓글이 없습니다.</p>";
                }
                else{
                    while($row = mysqli_fetch_array($result)){
                        echo "<br><p class = 'commentcontents'>[NO.".$row['no']."] 이름 : ".$row['name']."<span></span>입력날짜 : ".$row['date']."</p>";
                        echo "<hr>".$row['free']."<br>";
                    }
                }
            ?>
        </div>
    </div>
    <script>
        var error = document.getElementById('error');
        function disableerror(){
            console.log("error displayed");
            error.style.display = "none";
        }
    </script>
</body>
</html>