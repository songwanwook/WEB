<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원정보 변경</title>
    <script type = "text/javascript" src = "../jquery-1.10.2.js"></script>
    <style>
        body{
            overflow:hidden;
        }
        .update{
            margin:auto;
            padding-top:30px;
            width:80%;
        }
        .updateheader{
            display:flex;
            justify-content:space-between;
            border-bottom:1px solid black;
        }
        .updateheader > p, form > p{
            font-size:12px;
            margin-top:25px;
        }
        .updatecolor{
            color:rgb(2,172,146);
        }
        .title{
            font-size:27px;
        }
        table{
            width:100%;
            margin:auto;
            border-spacing:0;
        }
        .form{
            margin-top:30px;
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
        .delete > table{
            border:1px solid color:rgb(2,172,146);
        }
        .deleteth{
            width:25%;
        }
        th > input, select, label, .Modal > input, .Modal > label{
            font-size:15px;
            padding:5px;
            margin:5px;
        }
        .label{
            padding:10px;
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
            margin-top:0px;
        }
        .reset{
            background-color:rgb(50,50,50);
        }
        .submit{
            background-color:rgb(2,172,146);
        }
        .underline{
            font-weight:bold;
            text-decoration:underline;
        }
        .underline:hover, .submit:hover, .reset:hover, select:hover, .X:hover, .delete.hover{
            cursor:pointer;
        }
        .deletemodal{
            display:none;
            width:100%;
            height:100%;
        }
        .Modal{
            position:absolute;
            top:30%;
            left:35%;
            width:500px;
            height:300px;
            background-color:rgb(2,172,146);
        }
        .X{
            position:absolute;
            background-color:red;
            color:white;
            font-size:15px;
            padding:5px;
            border:none;
            right:10px;
            top:10px;
        }
        .Modal > p{
            margin-left:10px;
        }
        .deletemember{
            border:unset;
            background-color:black;
            color:white;
            margin-left:20px;
            font-size:15px;
            padding:5px;
        }
    </style>
</head>
<body>
    <?php
        include "main.php";
        include "../db.php";
        $id = $_GET['id'];
        $sql = "select * from youngjin where id = '$id'";
        $result = mysqli_query($connect,$sql);
        $row = mysqli_fetch_array($result);
    ?>
    <div class = "update">
        <div class = "deletemodal">
            <div class = "Modal">
                <p>회원 탈퇴</p>
                <button class = "X">X</button>
                <form action = "delete.php" method = "get" class = "delete">
                    <table>
                        <tr>
                            <th class = "deleteth"><label>삭제할 ID</label></th>
                            <th><input type = "text" name = "id" value = "<?php echo $row['id'] ?>" readonly></input></th>
                        </tr>
                        <tr>
                            <th class = "deleteth"><label>비밀번호</label></th>
                            <th><input type = "password" name = "deletepassword" class = "deletepassword"></input></th>
                        </tr>
                        <tr>
                            <th class = "deleteth"><label>이메일 확인</label></th>
                            <th><input type = "text" name = "deleteemail1" class = "deleteemail1"></input>@</th> 
                        </tr>
                        <tr>
                        <th class = "deleteth"><label></label></th>
                            <th>
                                <input type = "text" name = "deleteemail2" class = "deleteemail2" size = 8></input>
                                <select name = "deleteemail" class = "deleteemail">
                                    <option value = "none">직접입력</option>
                                    <option value = "gmail">gmail.com</option>
                                    <option value = "naver">naver.com</option>
                                    <option value = "daum">daum.net</option>
                                    <option value = "hanmail">hanmail.com</option>
                                </select>
                            </th>
                        </tr>
                    </table>
                    <input type = "submit" value = "삭제하기" class = "deletemember"></input>
                </form>
            </div>
        </div>
        <div class = "updateheader">
            <h2>회원정보수정</h2>
            <p>홈 > 회원서비스 > <span class = "updatecolor">회원정보수정</span></p>
        </div>
        <form action = "update.php" method = "POST">
            <p>정보입력</p>
            <table>
                <tr>
                    <th class = "titleth">이름</th>
                    <th class = "label"><label><?php echo $row['name'] ?></label></th>
                </tr>
                <tr>
                    <th class = "titleth">아이디</th>
                    <th class = "label"><label><?php echo $row['id'] ?></label></th>
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
            <p>영진닷컴을 사용하지 않는다면 <span class = "updatecolor underline">회원탈퇴 바로가기</span></p>
            <div class = "center">
            <input type = "submit" value = "수정하기" class = "submit"></input>
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
            if(email=="직접입력"){
                $('.email2').attr("readonly",false);
                $('.email2').val("");
            }
            else{
                $('.email2').attr("readonly",true);
                $('.email2').val(email);
            }
        });
        $(".deleteemail").on("change", function(){
            var email = $(this).find("option:selected").text();
            if(email=="직접입력"){
                $('.deleteemail2').attr("readonly",false);
                $('.deleteemail2').val("");
            }
            else{
                $('.deleteemail2').attr("readonly",true);
                $('.deleteemail2').val(email);
            }
        });
        $(document).ready(function(){
            $(".underline").click(function(){
                $('.deletemodal').css('display','block');
            });
            $(".X").click(function(){
                $('.deletepassword').val("");
                $('.deleteemail1').val("");
                $('.deleteemail2').val("");
                $('.deletemodal').css('display','none');
            });
        });
    </script>
</body>
</html>