$(document).ready(function(){
    $(".write").click(function(){
        location.href = "professionalwrite.php";
    });
    $(".list").click(function(){
        location.href = "professional.php";
    });
    $(".afterimage").change(function(){
        setImg(this, ".professionalimg");
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
    var scorebutton = document.getElementsByClassName("scorebutton");//점수 반영
    $(".scorebutton").click(function(){
        var score = $(this).attr("value");
        for(var i = 0; i < scorebutton.length; i++){
            if(i+1 <= score){
                scorebutton[i].style.color = "yellow";
                scorebutton[i].innerHTML = "★";
            }
            else{
                scorebutton[i].style.color = "black";
                scorebutton[i].innerHTML = "☆";
            }
        }
        $(".submit").attr("value",score);
    });
    $(".cancelwrite").click(function(){
        location.href = "online.php";
    });
    $(".professionalID").change(function(){
        var pname = $(".professionalID option:checked").text();
        pname = pname.substring(0, pname.indexOf('('));
        $(".proname").attr("value",pname);
    });
    var scorebutton = document.getElementsByClassName("scorebutton");//점수 반영
    $(".scorebutton").click(function(){
        var score = $(this).attr("value");
        $(".rate").attr("value",score);
    });
    $(".submit").on("click",function(e){//form의 빈 값 전송을 막기 위함
        if($(".proname").attr("value") == null || $(".proname").attr("value") == ""){
            e.preventDefault();
            alert("시공 전문가를 선택하세요.");
        }
        else if($(".professionalcontents").val().trim() == ""){
            e.preventDefault();
            alert("내용을 작성하세요.");
        }
        else if(Number($(".costinput").val()) < 100000){
            e.preventDefault();
            alert("시공 비용은 최소 10만원 입니다.");
        }
        else if($(".submit").attr("value") == null){
            e.preventDefault();
            alert("점수를 레이팅 하세요.");
        }
    });
});
