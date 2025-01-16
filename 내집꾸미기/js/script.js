$(document).ready(function(){
    var slideimg = document.getElementsByClassName("slideimg");
    var count = 0;
    SlideImage();
    function SlideImage(){
        for(var i = 0; i < slideimg.length; i++){
            if(i == count%3){
                slideimg[i].style.display = "block";
            }
            else{
                slideimg[i].style.display = "none";
            }
        }
        count++;
    }
    function SlideImageReverse(){
        count--;
        if(count < 0){
            count = 2;
        }
        for(var i = 0; i < slideimg.length; i++){
            slideimg[i].style.display = "none";
            if(i == count%3){
                slideimg[i].style.display = "block";
            }
        }
    }
    setInterval(SlideImage,2000);
    $(".prev").click(function(){
        SlideImageReverse();
    });
    $(".next").click(function(){
        SlideImage();
    });
    var click680 = 0;
    $(".under680btn").click(function(){
        click680++;
        if(click680%2==1){
            $(".side").css({"left":"0px","transition":"0.5s"});
            $(".under680btn").css({"left":"200px","transition":"0.5s"});
        }
        else{
            $(".side").css({"left":"-200px","transition":"0.5s"});
            $(".under680btn").css({"left":"0px","transition":"0.5s"});
        }
    });
    $(".sideul > li > a").click(function(){
        click680 = 0;
        $(".side").css({"left":"-200px","transition":"0.5s"});
        $(".under680btn").css({"left":"0px","transition":"0.5s"});
    });
    $(".login").click(function(){
        $(".loginform").css("display","block");
    });
    $(".getlogin").click(function(){//로그인
        if($(".ID").val().trim("") == "" || $(".PW").val().trim("") == ""){
            alert("ID, 패스워드를 입력하세요.");
        }
        else{
            var data = {ID:$(".ID").val(),PW:$(".PW").val()}
            $.ajax({//AJAX로 로그인을 시도하면 화면을 전환 안해도 세션을 갱신할 수 있다.
                type:"POST",url:"login.php",dataType:"JSON",data:data,success:function(data){
                    if(data['msg']=="success"){
                        alert("성공적으로 로그인 하였습니다.");
                        $(".loginform").css("display","none");
                        document.location.reload();
                    }
                    else{
                        alert("아이디 또는 패스워드가 다릅니다.");
                    }
                },error:function(data,status,err){
                    alert("error " + data + "\nstatus " + status + "\nMessage : " + err);
                }
            });
        }
    });
    $(".join").click(function(){
        $(".loginform").css("display","none");
        $(".joinform").css("display","block");
    });
    $(".joinbutton").click(function(){
        $(".loginform").css("display","none");
        $(".joinform").css("display","block");
    });
    $(".findidpw").click(function(){
        $(".logindiv").css("display","none");
        $(".findidpwdiv").css("display","flex");
    });
    $(".LOGIN").click(function(){
        $(".logindiv").css("display","flex");
        $(".findidpwdiv").css("display","none");
    });
    $(".cancel").click(function(){
        reset();
    });
    function reset(){
        $(".loginform").css("display","none");
        $(".joinform").css("display","none");
        $(".PW").removeAttr("readonly");
        $(".PWCH").removeAttr("readonly");
        $(".distinct").text("");
        $(".pwok").text("");
        $(".ID").val("");
        $(".PW").val("");
        $(".PWCH").val("");
        $(".name").val("");
        $(".file").val("");
        $(".capttext").val("");
    }
    $(".loginplease").click(function(){
        const login = confirm("이 기능은 로그인을 해야 사용할 수 있습니다. 로그인 하시겠습니까?");
        if(login){
            $(".loginform").css("display","block");
        }
    });
    $(".loginhref").click(function(){
        const login = confirm("이 기능은 로그인을 해야 사용할 수 있습니다. 로그인 하시겠습니까?");
        if(login){
            $(".loginform").css("display","block");
        }
    });
    function captcha(length){
        var result = "";
        var c = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var clength = c.length;
        for(var i = 0; i < clength; i++){
            result += c.charAt(Math.floor(Math.random()*clength));
        }
        return result;
    }
    var captchar = captcha(8).substring(0,8);
    $(".captcha").text(captchar);
    $(".captcha").attr("value",captchar);
    $(".IDCK").click(function(){
        var id = $('#ID').val();
        if($('#ID').val().trim() == ""){
            $(".distinct").attr("value","아이디를 입력하세요.");
            $(".distinct").css("color","red");
        }
        else{
            $.ajax({
                url:"idcheck.php?ID="+id,type:"get",dataType:"JSON",data:CreateData(),success:function(data){//?표기법을 사용하면 PHP에서 Undefined Index 에러 해결됨
                    if(data['msg'] == "false"){
                        $(".distinct").attr("value","이미 가입된 아이디가 있습니다.");
                        $(".distinct").css("color","red");
                    }
                    else{
                        $(".distinct").attr("value","사용 가능한 아이디입니다.");
                        $(".distinct").css("color","blue");
                    }
                },error:function(request, status, error){
                    console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });
        }
    });
    $(".ID").keydown(function(event) {
        $(".distinct").attr("value","");
    });
    $(".PW").keydown(function(event) {
        $(".pwok").attr("value","");
    });
    $(".PWOK").keydown(function(event) {
        $(".distinct").attr("value","");
    });
    let PW = document.querySelector('.PW');
    PW.addEventListener('keyup', function(){
        $(".pwok").attr("value","");
    });
    let PWCH = document.querySelector('.PWCH');
    PWCH.addEventListener('keyup', function(){
        $(".pwok").attr("value","");
    });
    $(".PWCK").click(function(){//비밀번호 확인
        if($("#PW").val().trim("") == "" || $("#PWCH").val().trim("") == ""){
            $(".pwok").attr("value","패스워드와 확인란을 모두 입력하세요.");
            $(".pwok").css("color","red");
        }
        else if($("#PW").val() != $("#PWCH").val()){
            $(".pwok").attr("value","패스워드 확인이 다릅니다.");
            $(".pwok").css("color","red");
        }
        else{
            $(".pwok").attr("value","패스워드 확인이 되었습니다.");
            $(".pwok").css("color","blue");
        }
        console.log($(".pwok").val());
    });
    $(".getjoin").click(function(){
        
        if($(".name").val().trim("") == ""){
            alert("이름을 입력하세요.");
        }
        else if($(".joinID").val().trim("") == ""){
            alert("아이디를 입력하세요.");
        }
        else if($(".joinPW").val().trim("") == ""){
            alert("패스워드를 입력하세요.");
        }
        else if($(".pwok").val() == "" || $(".pwok").val() == "패스워드와 확인란을 모두 입력하세요."){
            alert("패스워드를 확인하세요.");
        }
        else if($(".pwok").val() == "패스워드 확인이 다릅니다."){
            alert("패스워드와 확인란을 같은 번호로 입력하세요.");
        }
        else if($(".file").val() == ""){
            alert("프로필 사진을 등록하세요.");
        }
        else if($(".capttext").val() == ""){
            alert("자동입력방지 문자를 입력하세요.");
        }
        else if($(".capttext").val() != $(".captcha").val()){
            alert("자동입력방지 문자가 맞지 않습니다.");
        }
        else if($(".distinct").val() == "" || $(".distinct").val() == "아이디를 입력하세요."){
            alert("중복 아이디인지 확인하세요.");
        }
        else if($(".distinct").val() == "이미 가입된 아이디가 있습니다."){
            alert("이미 가입된 아이디가 있습니다. 다른 ID로 가입하세요.");
        }
        else{
            var data = {name:$(".name").val(),ID:$(".joinID").val(),PW:$(".joinPW").val(),file:$(".file").val()}
            $.ajax({
                type:"POST",url:"join.php",data:data,success:function(data){
                    alert("성공적으로 회원가입 하였습니다.");
                    $(".joinform").css("display","none");
                },error:function(data,status,err){
                    alert("error " + data + "\nstatus " + status + "\nMessage : " + err);
                }
            });
        }
    });
    $(".findidok").click(function(){
        var name = $('.inputname').val();
        if($('.inputname').val().trim() == ""){
            alert("이름을 입력하세요.");
        }
        else{
            $.ajax({
                url:"findid.php?name="+name,type:"get",dataType:"JSON",data:CreateData(),success:function(data){//?표기법을 사용하면 PHP에서 Undefined Index 에러 해결됨
                    if(data['msg'] == "false"){
                        alert("가입된 아이디가 없습니다.");
                    }
                    else{
                        alert("가입된 아이디는" + data['msg'] + " 입니다.");
                    }
                },error:function(request, status, error){
                    console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });
            $('.inputname').val("");
        }
    });
    $(".findpwok").click(function(){
        var ID = $('.inputID').val();
        if($('.inputID').val().trim() == ""){
            alert("이름을 입력하세요.");
        }
        else{
            $.ajax({
                url:"findpw.php?ID="+ID,type:"get",dataType:"JSON",data:CreateData(),success:function(data){//?표기법을 사용하면 PHP에서 Undefined Index 에러 해결됨
                    if(data['msg'] == "false"){
                        alert("해당 아이디가 없습니다.");
                    }
                    else{
                        alert("해당 아이디의 비밀번호는 " + data['msg'] + " 입니다.");
                    }
                },error:function(request, status, error){
                    console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });
            $('.inputID').val("");
        }
    });
    $(".logout").click(function(){
        console.log("로그아웃");
        location.href = "logout.php";
    });
    $(".onlinehouse").click(function(){
        location.href = "online.php";
    });
    $(".goprofessional").click(function(){
        location.href = "professional.php";
    });
    $(".p1").click(function(){
        location.href = "professional.php#p1";
    });
    $(".p2").click(function(){
        location.href = "professional.php#p2";
    });
    $(".p3").click(function(){
        location.href = "professional.php#p3";
    });
    $(".p4").click(function(){
        location.href = "professional.php#p4";
    });
    $(".file").change(function(){
        setImg(this, ".profileimg");
    });
    function setImg(input, expression){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $(expression).attr('src',e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".review2").click(function(){
        location.href = "professionalview.php?no=2";
    });
    $(".review1").click(function(){
        location.href = "professionalview.php?no=1";
    });
    $(".mypage").click(function(){
        location.href = "mypage.php";
    });
});
function CreateData(){
    var sendData = {id:$('#ID').val()}
    return sendData;
}