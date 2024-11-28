<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>방명록</title>
    <style>
        *{
            margin:auto;
        }
        h2{
            width:100%;
            border:5px solid gray;
            text-align:center;
        }
        .wrapper{
            width:1000px;
        }
        form{
            width:100%;
        }
        .comment{
            width:90%;
        }
        .save{
            margin:10px;
        }
        .commentlist{
            border: 1px solid black;
            text-align:center;
        }
        .delete{
            background-color:red;
            color:white;
            width:5%;
            text-decoration:none;
        }
        p{
            display:flex;
            flex-direction:row;
        }
        input:hover{
            cursor:pointer;
        }
    </style>
</head>
<body>
    <div class = "wrapper">
        <h2>방명록</h2>
        <form action = "submitcomment.php" method = "POST">
            <input type = "text" name = "comments" class = "comment">
            <input type = "submit" value = "저장" class = "save">
        </form>

        <div class = "commentlist">내용
    <?php
        include "../db.php";
        if(!$connect){
            die("연결 실패".mysqli_connect_error());
        }
        $sql = "select * from dongeui_guest";
        $result = mysqli_query($connect, $sql);
        while($row = mysqli_fetch_array($result)){//java에서는 while(rs.next())와 같음.
            $num = $row['no'];
            echo "<hr><p><span class = 'comment' name = 'comment'>".$row['contents'].
            "</span><a href = 'deletecomment.php?num=$num' class = 'delete'>삭제</a>";
            //GET 메서드에서는 굳이 form으로 쓰지 않고, 바로 URL로 넘겨줘도 됨.
        }
    ?>
        </div>
    </div>
</body>
</html>