<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type = "text/javascript" src = "jquery-1.10.2.js"></script>
    <style>
        *{
            margin:auto;
        }
        .wrapper{
            border: 1px solid lightgray;
            width:1000px;
        }
        h1{
            background-color: lightgray;
            text-align:center;
        }
        table{
            border:none;
            width:100%;
        }
        .head{
            width:10%;
        }
        textarea{
            width:98%;
            height:200px;
        }
        td{
            padding:5px;
        }
        .buttondiv{
            width:60%;
            display:flex;
            justify-content: space-between;
            padding-bottom:20px;
        }
    </style>
</head>
<body>
    <?php
        include "db.php";
        $id = $_POST['id'];
        $password = $_POST['password'];
        $sql = "select * from ajax_board where no = $id and password = '$password'";
        $result = mysqli_query($connect,$sql);
        if(mysqli_num_rows($result)==1){
            $row = mysqli_fetch_array($result);
            echo '<div class = "wrapper">
                <h1>글 수정하기</h1>
                <form method = "POST" class = "update" action = "updateok.php">
                <input type = "hidden" name = "id" value = "'.$row['no'].'" class = "id">
                    <table>
                        <tbody>
                            <tr>
                                <td class = "head"><label for = "name">이름</label></td>
                                <td class = "input"><input type = "text" class = "name" name = "name" size = "50" "val" disabled value = "'.$row['name'].'"></td>
                            </tr>
                            <tr>
                                <td class = "head"><label for = "email">이메일</label></td>
                                <td class = "input"><input type = "text" class = "email" name = "email" size = "50" disabled value = "'.$row['email'].'"></td>
                            </tr>
                            <tr>
                                <td class = "head"><label for = "password">비밀번호</label></td>
                                <td class = "input"><input type = "password" class = "password" name = "password" size = "25" disabled value = "'.$row['password'].'"></td>
                            </tr>
                            <tr>
                                <td class = "head"><label for = "title">제목</label></td>
                                <td class = "input"><input type = "text" class = "title" name = "title" size = "80" value = "'.$row['title'].'"></td>
                            </tr>
                            <tr>
                                <td class = "head"><label for = "contents">내용</label></td>
                                <td class = "input"><textarea name = "contents" class = "contents">'.$row['contents'].'</textarea></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class = "buttondiv">
                        <input type = "submit" value = "수정하기"><button type = "reset">다시 쓰기</button><button type = "reset" onclick="viewphp()">되돌아가기</button>
                    </div>
                </form>
            </div>';
        }
        else{
            ?>
            <script>
                alert("비밀번호가 틀립니다.");
                history.back();
            </script>
            <?php
        }
    ?>
    <script>
        function viewphp(){
            location.href = "view.php?no=<?php echo $id ?>";
        }
    </script>
</body>
</html>
