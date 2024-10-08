<?php
    session_start();
    if(!isset($_SESSION['session_id'])){
        ?>
            <script>
                alert("로그인 해야 이용 가능합니다.");
                location.href = "boardlogin.html";
            </script>
        <?php
    }
    else{
        $no = $_GET['no'];
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type = "text/javascript" src = "jquery-1.10.2.js"></script>
    <style>
        .backgroundlightgray{
            background-color:lightgray;
        }
        .boardview{
            width:1000px;
        }
        *{
            margin:auto;
        }
        table{
            width:100%;
            border: 1px solid lightgray;
        }
        th{
            padding:5px;
        }
        .title{
            width:100px;
        }
        .contents{
            text-align:start;
        }
        th > button{
            background:unset;
            border:unset;
            margin:5px;
        }
        button:hover{
            cursor:pointer;
        }
        a{
            text-decoration:none;
            font-size:13.3333px;
            color:black;
            font-weight:normal;
            margin:5px;
        }
        .updateModalBG{
            position:absolute;
            top:0;
            display:none;
            width:100%;
            height:100%;
            background-color:rgba(0,0,0,0.5);
            margin:auto;
        }
        .updateModal{
            position:absolute;
            width:400px;
            height:200px;
            top:35%;
            left:35%;
        }
        .updateModal > h1{
            width:100%;
            background-color:lightgray;
            text-align:center;
        }
        .updateform, .deleteform{
            display:none;
        }
        label{
            color:white;
        }
        .form{
            background-color:darkgray;
            height:100%;
        }
        form{
            height:33.33%;
        }
        p{
            height:100%;
        }
        p > input, p > button{
            height:60%;
        }
        .cancel{
            width:50px;
            height:50px;
            margin-left:10px;
        }
    </style>
</head>
<body>
    <div class = "boardview">
        <?php
        if(isset($no)){
            include "db.php";
            $viewsql = "update ajax_board set view = view + 1 where no = $no";
            mysqli_query($connect,$viewsql);
            $sql = "select * from ajax_board where no = $no";
            $result = mysqli_query($connect, $sql);
            while($row = mysqli_fetch_array($result)){
                echo '<table>
                    <tr class = "backgroundlightgray">
                        <th class = "title">제목</th>
                        <th class = "contents" colspan = "3">'.$row['title'].'</th>
                    </tr>
                    <tr>
                        <th class = "title backgroundlightgray">글쓴이</th>
                        <th class = "contents">'.$row['name'].'</th>
                        <th class = "title backgroundlightgray">이메일</th>
                        <th class = "contents">'.$row['email'].'</th>
                    </tr>
                    <tr>
                        <th class = "title backgroundlightgray">날짜</th>
                        <th class = "contents">'.$row['date'].'</th>
                        <th class = "title backgroundlightgray">조회수</th>
                        <th class = "contents">'.$row['view'].'</th>
                    </tr>
                    <tr>
                        <th class = "backgroundlightgray" colspan = "4">내용</th>
                    </tr>
                    <tr>
                        <th class = "contents" colspan = "4">'.$row['contents'].'</th>
                    </tr>
                    <tr>
                        <th colspan = "4"><button onclick = "list()">[목록보기]</button><a href = "ajaxboard.html">[글쓰기]</a>
                        <button class = "update" name = "id" value = "'.$row['no'].'">[수정]</button><button class = "delete" name = "id" value = "'.$row['no'].'">[삭제]</button></th>
                    </tr>
                </table>';
            ?>
    </div>
    <div class = "updateModalBG">
        <div class = "updateModal">
            <h1>비밀번호 확인</h1>
            <div class = "form">
            <form class = "updateform" method = "POST" action = "updateboard.php">
                <p>
                    <label for = "password">비밀번호 : </label><input type = "password" class = "password" name = "password"><input type = "submit" value = "확인">
                    <input type = "hidden" name = "id" id = "id" value = "<?php echo $row['no']; ?>">
                    
                </p>
                
            </form>
            <form class = "deleteform" method = "POST" action = "deleteboard.php">
                <p>
                    <label for = "password">비밀번호 : </label><input type = "password" class = "password" name = "password"><input type = "submit" value = "확인">
                    <input type = "hidden" name = "id" id = "id" value = "<?php echo $row['no']; ?>">
                </p>
            </form>
            <button class = "cancel">취소</button>
            </div>
        </div>
    </div>
    <?php
        }
        }
        else{
            echo "no result";
        }
    ?>
    <script>
        function list(){
            location.href = "ajaxboard.php";
        }
        function write(){
            console.log("글쓰기");
            location.href = "ajaxboard.html";
        }
        $(document).ready(function(){
            $('.update').click(function(){
                $('.updateModalBG').css('display','block');
                $('.updateform').css('display','block');
            });
            $('.delete').click(function(){
                $('.updateModalBG').css('display','block');
                $('.deleteform').css('display','block');
            });
            $('.cancel').click(function(){
                $('.updateModalBG').css('display','none');
                $('.updateform').css('display','none');
                $('.deleteform').css('display','none');
            });
            /*$('.updateform').on('submit',function(event){
                event.preventDefault();
                if($('.password').val() == ""){
                    alert("비밀번호를 입력하세요.");
                }
                else{
                    location.href = "updateboard.php";
                }
            });*/
        });
    </script>
</body>
</html>
<?php 
} 
?>