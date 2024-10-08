<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
</head>
<body>
    <?php include "header.php" ?>
    <h1>회원가입</h1>
    <hr>
    <form action = "join.php" method = "POST" class = "joinphp">
        <table class = "bordernonetable">
            <tr>
                <th class = "headth">이름 : </th>
                <th><input type = "text" name = "name" size = "25" class = "name"><span class = "require">* <span class = "requirename"></span></span></th>
            </tr>
            <tr>
                <th class = "headth">아이디 : </th>
                <th><input type = "text" name = "id" size = "25" class = "id"><button type = "button" class = "idcheck">중복확인</button> <span class = "require">* <span class = "requireid"></span></span></th>
            </tr>
            <tr>
                <th class = "headth">비밀번호 : </th>
                <th><input type = "password" name = "password" size = "25" class = "password"><span class = "require">* <span class = "requirepw"></span></span></th>
            </tr>
            <tr>
                <th class = "headth">전화번호 : </th>
                <th><input type = "text" name = "tel" size = "25"></th>
            </tr>
            <tr>
                <th class = "headth">이메일 : </th>
                <th><input type = "text" name = "email" size = "25"></th>
            </tr>
        </table>
        <div class = "submitdiv">
            <input type = "submit" value = "가입" class = "submit"><input type = "reset" value = "취소" class = "cancel">
        </div>
    </form>
    <script>
        $(".cancel").on("click",function(){
            location.href = "index.php";
        });
        $('.submit').on('click',function(event){
            var id = $('.id').val();
            var pw = $('.password').val();
            var name = $('.name').val();
            if(name == "" || name.trim() == "" || id == "" || id.trim() == "" || pw == ""|| pw.trim() == "" ){
                if(name==""|| name.trim() == "")$('.requirename').html("이름이 없습니다.");
                if(id == ""|| id.trim() == "")$('.requireid').html("아이디가 없습니다.");
                if(pw == ""|| pw.trim() == "")$('.requirepw').html("비밀번호가 없습니다.");
                event.preventDefault();//특정 조건에서 form 전송을 취소할때 사용
            }
        });
        function CreateData(){
            var sendData = {id:$('.id').val()}
            return sendData;
        }        
        $(document).ready(function(){
            $(".idcheck").click(function(){
                var id = $('.id').val();
                if(id == ""|| id.trim() == ""){
                    $('.requireid').html("아이디가 없습니다.");
                }
                else{
                    $.ajax({
                        url:"check_id.php",type:"get",dataType:"json",data:CreateData(),success:function(data){
                            if(data['msg']=="false"){
                                $('.requireid').html("중복되는 아이디가 있습니다.");
                            }
                            else{
                                $('.requireid').html("사용 가능한 ID입니다.");
                                $('.requireid').css("color","blue");
                            }
                        },error:function(request, status, error){
                            console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                        }
                    })
                }
            });
            
        });
        
    </script>
</body>
</html>