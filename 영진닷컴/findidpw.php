<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID 비밀번호 찾기</title>
    <script type = "text/javascript" src = "../jquery-1.10.2.js"></script>
    <style>
        .color{
            color:rgb(2,172,146);
        }
        .idpwheader{
            display:flex;
            justify-content:space-between;
            border-bottom:1px solid black;
        }
        .idpwheader > p{
            font-size:12px;
            margin-top:25px;
        }
        .idpw{
            width:80%;
            padding-top:30px;
            margin:auto;
        }
        .idpw > p{
            margin-top:30px;
            text-align:center;
            align-items:center;
        }
        .idpw > p > img{
            margin-left:30px;
        }
        .idpw > p > span{
            font-size:22px;
        }
        .findidpw{
            border:1px solid gray;
            height:300px;
            margin-top:60px;
            display:flex;
        }
        .id, .pw{
            width:50%;
            height:100%;
            padding:30px;
        }
        .border1{
            border-right:0.2px solid gray;
            height:100%;
        }
        input, select{
            background-color:rgb(250,250,250);
            border:1px solid lightgray;
            padding:5px;
        }
        label{
            font-weight:bold;
            width:70px;
            height:30px;
        }
        label{
            margin:0, 10px, 10px, 10px;
        }
        #id{
            margin:10px;
        }
        .name, .pwname{
            margin-left:26px;
        }
        input, .id > span, .pw > span{
            margin:10px;
        }
        .ok{
            background-color:rgb(50,50,50);
            border:unset;
            border-radius:5px;
            padding:3px 8px;
            color:white;
            width:70px;
            margin-left:330px;
        }
        .myid{
            color:red;
            font-weight:bold;
        }
    </style>
</head>
<body>
    <?php
        include "main.php";
    ?>
    <div class = "idpw">
        <div class = "idpwheader">
            <h2>아이디/비밀번호 찾기</h2>
            <p>홈 > 회원서비스 > <span class = "color">아이디/비밀번호 찾기</span></p>
        </div>
        <p><span>아이디, 비밀번호를 잊으셨나요?</span><img src = "src/image1.jpg"></p>
        <div class = "findidpw">
            <div class = "id">
                <h3>아이디찾기</h3>
                <br>
                <label for = "name">이름</label><input type = "text" name = "name" class = "name"><br>
                <label for = "name">이메일</label><input type = "text" name = "email1" class = "email1" size = 7>@<input type = "text" name = "email2" class = "email2" size = 7>
                <select name = "email" id = "email">
                    <option value = "none">선택하세요</option>
                    <option value = "gmail.com">gmail.com</option>
                    <option value = "naver.com">naver.com</option>
                    <option value = "daum.net">daum.net</option>
                    <option value = "hanmail.com">hanmail.com</option>
                </select>
                <br>
                <input type = "submit" class = "ok" id = "findid" value = "확인"><br><span class = "getid"></span>
            </div>
            <span class = "border1"></span>
            <div class = "pw">
                <h3>비밀번호찾기</h3>
                <br>
                <label for = "name">이름</label>
                <input type = "text" name = "name" class = "pwname" size = 10><label for = "id" id = "id">아이디</label><input type = "text" name = "id" class = "setid" size = 10>
                <br>
                <input type = "submit" class = "ok" id = "findpw" value = "확인"><br><span class = "getpw"></span>
            </div>
        </div>
    </div>
    <script>
        $("#email").on("change", function(){
            var email = $(this).find("option:selected").text();
            if(email == "선택하세요"){
                email = "";
            }
            $('.email2').val(email);
        });
        function CreateData(){
            var sendData = {name:$('.name').val(),email1:$('.email1').val(),email2:$('.email2').val()}
            return sendData;
        }
        function CreatePwData(){
            var sendData = {name:$('.pwname').val(),id:$('.setid').val()}
            return sendData;
        }
        $(document).ready(function(){
            //findpw.php
            $("#findid").click(function(){
                var name = $(".name").val();
                var email1 = $(".email1").val();
                var email2 = $(".email2").val();
                if(name == "" || email == "" || email2 == ""){
                    $(".getid").html("이름, 이메일을 모두 입력하시기 바랍니다.");
                    $(".getid").css('color','red');
                }
                else{
                    $.ajax({
                        url:"findid.php",type:"get",dataType:"JSON",data:CreateData(),success:function(data){
                            if(data['msg'] == "false"){
                                warn = "해당되는 아이디가 없습니다.";
                                $('.getid').html(warn);
                                $('.getid').css("color","red");
                            }
                            else{
                                var msg = data.msg;
                                $('.getid').html(msg);
                            }
                        },error:function(request, status, error){
                            console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                        }
                    });
                }
            });
            $("#findpw").click(function(){
                var name = $(".pwname").val();
                var id = $(".setid").val();
                if(name == "" || id == ""){
                    $(".getpw").html("이름, ID를 모두 입력하시기 바랍니다.");
                    $(".getpw").css('color','red');
                }
                else{
                    $.ajax({
                        url:"findpw.php",type:"get",dataType:"JSON",data:CreatePwData(),success:function(data){
                            if(data['msg'] == "false"){
                                warn = "해당되는 정보가 없습니다.";
                                $('.getpw').html(warn);
                                $('.getpw').css("color","red");
                            }
                            else{
                                var msg = data.msg;
                                $('.getpw').html(msg);
                            }
                        },error:function(request, status, error){
                            console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>