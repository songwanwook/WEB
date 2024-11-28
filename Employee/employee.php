<?php
    include "../db.php";
    $sql = "select * from employee order by id desc";
    $result = mysqli_query($connect, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type = "text/javascript" src = "jquery-1.10.2.js"></script>
    <style>
        #wrap{
            width:800px;
            margin:auto;
        }
        .pageheader{
            width:100%;
            float:right;
            margin-bottom:10px;
        }
        #add{
            float:right;
        }
        button{
            padding:10px;
        }
        table{
            width:100%;
            border-collapse:collapse;
            top:10px;
        }
        .addModal, .detailModal{
            position:absolute;
            width:100%;
            height:100%;
            top:0;
            background-color:rgba(0,0,0,0.2);
            display:none;
        }
        .Modal-Content{
            width:500px;
            background-color:#fff;
            position:relative;
            padding:10px;
            overflow:hidden;
            margin:auto;
            top:20%;
        }
        button:hover{
            cursor:pointer;
        }
        .x{
            position:absolute;
            right:10px;
            color:black;
            font-weight:bold;
            font-size:25px;
            background:unset;
            border:unset;
            padding:0;
        }
        .title{
            margin:0;
            border-bottom:1px solid lightgray;
            padding-bottom:20px;
        }
        #insert_employee input[type="text"] {width:300px;padding:5px;}
        #insert_employee select{padding:5px;}
        .Modal-Body, .Modal-Body-detail{
            margin:10px 0px;
        }
    </style>
</head>
<body>
    <div id = "wrap">
        <h1 style = "text-align: center;">employee data</h1>
        <div class = "pageheader">
            <button type = "button" name = "add" id = "add">추가</button>
        </div>
        <div class = "wrapper">
            <table border = 1>
                <tr>
                    <th width = "70%">이름</th>
                    <th width = "15%">보기</th>
                    <th width = "15%">수정</th>
                </tr>
                <?php
                    while($row = mysqli_fetch_array($result)){
                ?>
                    <tr>
                        <td><?php echo $row['name'];?></td>
                        <td align = "center"><input type = "button" name = "detail" value = "자세히" id = "<?php echo $row['id']; ?>" class = "detail"></td>
                        <td align = "center"><input type = "button" name = "update" value = "수정" id = "<?php echo $row['id']; ?>" class = "update"></td>
                    </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </div>
    <div class = "addModal">
        <div class = "Modal-Content">
            <div class = "header">
                <button type = "button" class = "close x">&times;</button>
                <h4 class = "title">직원 추가하기</h4>
            </div>
            <div class = "Modal-Body">
                <form method = "POST" id = "insert_employee">
                    <p>이름 : <input type = "text" name = "name" id = "name"></p>
                    <p>주소 : <input type = "text" name = "address" id = "address"></p>
                    <p>성별 : <select name = "gender" id = "gender">
                        <option value = "남">남</option>
                        <option value = "여">여</option>
                    </select></p>
                    <p>직업 : <input type = "text" name = "job" id = "job"></p>
                    <p>나이 : <input type = "text" name = "age" id = "age"></p>
                    <input type = "hidden" name = "id" id = "id">
                    <p><input type = "submit" value = "추가" name = "insert" id = "insert"></p>
                </form>
            </div>
            <div class = "Modal-Footer">
                <button type = "button" class = "close">닫기</button>
            </div>
        </div>
    </div>
    <div class = "detailModal">
        <div class = "Modal-Content">
            <div class = "header">
                <button type = "button" class = "close x">&times;</button>
                <h4 class = "title">직원 상세</h4>
            </div>
            <div class = "Modal-Body-detail">

            </div>
            <div class = "Modal-Footer">
                <button type = "button" class = "close">닫기</button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            //자세히
            $(document).on('click','.detail',function(){
                var id = $(this).attr("id");
                $.ajax({
                    url:"employee_select.php",method:"POST",data:{id:id},success:function(data){
                        $(".Modal-Body-detail").html(data);
                        $('.detailModal').css('display','block');
                    },error:function(data){
                        alert("error");
                    }
                });
            });
            //닫기
            $('.close').click(function(){
                $('.addModal').css('display','none');
                $('.detailModal').css('display','none');
                $('#insert_employee')[0].reset();
            });
            //추가
            $('#add').click(function(){
                $('#insert').val("추가");
                $('#insert_employee')[0].reset();
                $('.addModal').css('display','block');
            });
            //추가 - 추가
            $('#insert_employee').on('submit',function(event){
                event.preventDefault();
                if($('#name').val() == ""||$('#address').val() == ""||$('#job').val() == ""||$('#age').val() == ""){
                    alert("빈칸을 모두 입력하세요.");
                }
                else{
                    $.ajax({
                        url:"employee_insert.php",method:"POST",data:$("#insert_employee").serialize(),success:function(data){
                            $('#insert_employee')[0].reset(); //reset
                            $('.addModal').css('display','none');
                            $('.wrapper').html(data);

                        },error:function(data){
                            alert("error");
                        }
                    });
                }
            });
            //수정
            $(document).on('click','.update',function(){
                var id = $(this).attr("id");
                $.ajax({
                    url:"employee_update.php",method:"POST",dataType:"json",data:{id:id},success:function(data){
                        $('#name').val(data.name);
                        $('#address').val(data.address);
                        $('#gender').val(data.gender);
                        $('#job').val(data.job);
                        $('#age').val(data.age);
                        $('#id').val(data.id);
                        $('#insert').val("수정");
                        $('.addModal').css('display','block');
                    },error:function(request, status, error){
                        alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                    }
                })
            });
        });
    </script>
</body>
</html>