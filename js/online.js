$(document).ready(function(){
    $(".write").click(function(){
        location.href = "onlinewrite.php";
    });
    $(".list").click(function(){
        location.href = "online.php";
    });
    $(".beforeimage").change(function(){
        setImg(this, ".img1");
    });
    $(".afterimage").change(function(){
        setImg(this, ".img2");
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
    $(".cancelwrite").click(function(){
        location.href = "online.php";
    });
    var scorebutton = document.getElementsByClassName("scorebutton");
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
        $(".rate").attr("value",score);
    });
    $(".rating").on("click",function(e){//form의 빈 값 전송을 막기 위함
        if($(".rate").attr("value") == null){
            e.preventDefault();
            alert("점수를 레이팅 하세요.");
        }
    });
    $(".showall").click(function(){
        location.href = "online.php#showall";
    });
})