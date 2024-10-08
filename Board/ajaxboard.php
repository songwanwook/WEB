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
        #wrapper{
            width:1000px;
        }
        h1, table{
            text-align:center;
        }
        p{
            text-align:right;
            width:100%;
        }
        p > a{
            text-decoration:none;
            color:black;
        }
        table{
            width:100%;
            border: 1px solid lightgray;
        }
        .tr{
            background-color:lightgray;
            border:none;
        }
        .write{
            background:unset;
            border:unset;
            font-size:16px;
        }
        .title{
            font-size:18px;
        }
        .writeform{
            display:grid;
            justify-content:right;
        }
        input:hover{
            cursor:pointer;
        }
        .member{
            color:blue;
        }
        .view{
            border:unset;
            background-color:white;
            width:100%;
        }
    </style>
</head>
<body>
    <div id = "wrapper">
        <?php
        session_start();
        if(!isset($_SESSION['session_id'])){ ?>
        <p class = "title"><a href = "boardlogin.html">로그인</a><p>
        <?php }else{ ?>
        <p class = "title"><span class = "member"><?php echo $_SESSION['session_id']; ?></span>님 환영합니다. <a href = "logout.php">로그아웃</a><p><?php } ?>
        <h1>board</h1>
        <table>
            <thead style = "border-color:lightgray">
                <tr class = "tr">
                    <th>번호</th>
                    <th>제목</th>
                    <th>글쓴이</th>
                    <th style = "width:40%">날짜</th>
                    <th>조회수</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include "db.php";
                $sql = "select * from ajax_board";
                $result = mysqli_query($connect, $sql);
                while($row = mysqli_fetch_array($result)){
                ?>
                    <form action = 'view.php?no=<?php echo $row['no']; ?>' method = 'POST'><tr>
                    <th name = 'no'><button class = 'view' name = 'no' id = '<?php echo $row['no']; ?>'><?php echo $row['no']; ?></button></th>
                    <th><button class = 'view' name = 'no' id = '<?php echo $row['no']; ?>'><?php echo $row['title']; ?></button></th>
                    <th><button class = 'view' name = 'no' id = '<?php echo $row['no']; ?>'><?php echo $row['name']; ?></button></th>
                    <th style = 'width:40%'><button class = 'view' name = 'no' id = '<?php echo $row['no']; ?>'><?php echo $row['date']; ?></button></th>
                    <th><button class = 'view' name = 'no' id = '<?php echo $row['no']; ?>'><?php echo $row['view']; ?></button></th>
                    </tr></form>
                <?php
                }
            ?>
            </tbody>
        </table>
        <form action = "islogin.php" class = "writeform" onSubmit = "return islogin(this)"><input type = "submit" value = "[글쓰기]" class = "write"></input></form>
    </div>
    <script>
        function islogin(id){
            $.ajax({
                url:$(id).attr('action'),dataType:"json",type:"get",data:$(id).serialize(),success:function(data){
                    if(data['result']=='f'){
                        alert(data['msg']);
                        location.href = "boardlogin.html";
                    }
                    else if(data['result']=='success'){
                        location.href = "ajaxboard.html";
                    }
                },error:function(request, status, error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });
        }
        /*function view(login){
            $.ajax({
                url:$(login).attr('action'),dataType:"json",type:"get",data:$(login).serialize(),success:function(data){
                    if(data['result']=='f'){
                        alert(data['msg']);
                        location.href = "boardlogin.html";
                    }
                    else if(data['result']=='success'){
                        location.href = "view.php";
                    }
                },error:function(request, status, error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });
        }*/
    </script>
</body>
</html>