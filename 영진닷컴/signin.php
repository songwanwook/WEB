<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <script type = "text/javascript" src = "../jquery-1.10.2.js"></script>
    <style>
        .signin{
            margin:auto;
            padding-top:30px;
            width:88%;
        }
        .signinheader{
            display:flex;
            justify-content:space-between;
            border-bottom:1px solid black;
        }
        .signinheader > p{
            font-size:12px;
            margin-top:25px;
        }
        .signincolor{
            color:rgb(2,172,146);
        }
        .title{
            font-size:27px;
        }
        .center{
            text-align:center;
            align-items:center;
        }
        table{
            width:88%;
            margin:auto;
            border-spacing:0;
        }
        th{
            text-align:start;
            align-items:start;
            border-top:1px solid lightgray;
        }
        th, tr{
            padding-left:15px;
        }
        .titleth{
            width:20%;
            border-right:1px solid lightgray;
        }
        th > input, select{
            font-size:15px;
            padding:5px;
            margin:5px;
        }
        input, select{
            background-color:rgb(250,250,250);
            border:1px solid lightgray;
        }
        button:hover,.submit:hover, .reset:hover{
            cursor:pointer;
        }
        .bottom > th{
            border-bottom:1px solid lightgray;
        }
        .check{
            background-color:rgb(50,50,50);
            border:unset;
            border-radius:5px;
            padding:3px 8px;
            color:white;
        }
        .submit, .reset{
            font-size:20px;
            width:150px;
            padding:8px;
            color:white;
            margin-top:20px;
        }
        .reset{
            background-color:rgb(50,50,50);
        }
        .submit{
            background-color:rgb(2,172,146);
        }
    </style>
</head>
<body>
    <?php
        include "main.php";
    ?>
    <div class = "signin">
        <div class = "signinheader">
            <h2>회원가입</h2>
            <p>홈 > 회원서비스 > <span class = "signincolor">회원가입</span></p>
        </div>
        <p class = "title center">영진닷컴 통합ID 회원가입 절차입니다.</p>
        <p class = "center">사용자의 개인정보를 위해 회원님께서 입력하신 비밀번호는 암호화 되어 처리되며, 회원님의 사전 동의 없이는 개인의 신상정보를 공개 또는 타 업체 등에 제공되지 않습니다.</p>
        <form action = "signinok.php" method = "POST">
            <table>
                <tr>
                    <th class = "titleth">아이디</th>
                    <th><input type = "text" name = "id" class = "id" size = 26><button type = "button" class = "check">아이디중복확인</button>
                    <span class = "distinct" name = "distinct"></span></th>
                </tr>
                <tr>
                    <th class = "titleth">이름</th>
                    <th><input type = "text" name = "name" size = 17></th>
                </tr>
                <tr>
                    <th class = "titleth">비밀번호</th>
                    <th><input type = "password" name = "password"></th>
                </tr>
                <tr>
                    <th class = "titleth">비밀번호확인</th>
                    <th><input type = "password" name = "passwordcheck"></th>
                </tr>
                <tr>
                    <th class = "titleth">본인확인질문</th>
                    <th>
                        <select name = "question">
                            <option value = "인상 깊게 읽은 책 이름은">인상 깊게 읽은 책 이름은</option>
                            <option value = "나의 출신 학교는">나의 출신 학교는</option>
                            <option value = "내가 사는 지역은">내가 사는 지역은</option>
                            <option value = "가장 기억에 남는 장소는">가장 기억에 남는 장소는</option>
                        </select>비밀번호 분실 시 본인확인 용도
                    </th>
                </tr>
                <tr>
                    <th class = "titleth">본인확인답변</th>
                    <th><input type = "text" name = "answer"></th>
                </tr>
                <tr>
                    <th class = "titleth">생년월일</th>
                    <th><input type = "text" name = "birth"></th>
                </tr>
                <tr>
                    <th class = "titleth">휴대폰 번호</th>
                    <th>
                        <select name = "phone">
                            <option value = "010">010</option>
                            <option value = "011">011</option>
                            <option value = "017">017</option>
                        </select> - <input type = "text" name = "phone2" size = 5> - <input type = "text" name = "phone3" size = 5>
                        <input type = "checkbox"><label>SMS 수신동의</label>
                    </th>
                </tr>
                <tr class = "bottom">
                    <th class = "titleth">이메일</th>
                    <th>
                        <input type = "text" name = "email1" size = 8>@<input type = "text" name = "email2" class = "email2" size = 8>
                        <select name = "email" id = "email">
                            <option value = "none">직접입력</option>
                            <option value = "gmail">gmail.com</option>
                            <option value = "naver">naver.com</option>
                            <option value = "daum">daum.net</option>
                            <option value = "hanmail">hanmail.com</option>
                        </select>
                        다양한 정보를 이메일로 받을 수 있습니다.
                    </th>
                </tr>
            </table>
            <div class = "center">
            <input type = "submit" value = "가입하기" class = "submit"></input>
            <input type = "reset" value = "취소" class = "reset"></input>
            </div>
        </form>
    </div>
    <script>
        $(".reset").on("click",function(){
            location.href = "main.php";
        });
        $("#email").on("change", function(){
            var email = $(this).find("option:selected").text();
            if(email == "직접입력"){
                $('.email2').val("");
                $('.email2').attr("readonly",false);
            }
            else{
                $('.email2').val(email);
                $('.email2').attr("readonly",true);
            }
        });
        function CreateData(){
            var sendData = {id:$('.id').val()}
            return sendData;
        }
        $(document).ready(function(){
            $(".check").click(function(){
                var id = $(".id").val();
                var warn = "";
                if(id == ""){
                    warn = "아이디를 입력하세요.";
                    $('.distinct').html(warn);
                    $('.distinct').css("color","red");
                }
                else{
                    $.ajax({
                        url:"idcheck.php",type:"get",dataType:"JSON",data:CreateData(),success:function(data){
                            if(data['msg'] == "false"){
                                warn = "중복되는 아이디가 있습니다.";
                                $('.distinct').html(warn);
                                $('.distinct').css("color","red");
                            }
                            else{
                                warn = "사용 가능한 아이디입니다.";
                                $('.distinct').html(warn);
                                $('.distinct').css("color","blue");
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