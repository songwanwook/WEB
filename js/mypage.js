$(document).ready(function(){
    $(".altpw").click(function(){
        $(".boxmodal").css("display","block");
        $(".nowpw").css("display","block");
    });
    $(".cancelpw").click(function(){
        if($(".nowPW").val().length >= 1 || $(".newPW").val().length >= 1  || $(".newPWCH").val().length >= 1 ){
            const close = confirm("지금 창을 닫으면 수정중인 정보가 사라집니다. 실행하시겠습니까?");
            if(close){
                closealt();
            }
        }
        else{
            $(".boxmodal").css("display","none");
        }
    });
    function closealt(){
        $(".boxmodal").css("display","none");
        $(".nowPW").val("");
        $(".newPW").val("");
        $(".newPWCH").val("");
    }
    $(".OK").click(function(){
        if($('.nowPW').val().trim() == ""){
            alert("현재 패스워드를 입력하세요.");
        }
        else if($('.newPW').val().trim() == "" || $('.newPWCH').val().trim() == ""){
            alert("수정할 패스워드와 확인란를 모두 입력하세요.");
        }
        else if($('.newPW').val() != $('.newPWCH').val()){
            alert("수정할 패스워드와 확인란를 똑같이 입력하세요.");
        }
        else if($('.nowPW').val() == $('.newPW').val()){
            alert("수정할 패스워드가 같습니다.");
        }
        else{
            var data = {myid:$(".myid").val(),nowPW:$(".nowPW").val(),newPW:$(".newPW").val()}
            $.ajax({
                url:"updatepw.php",type:"POST",datatype:"JSON",data:data,success:function(data){
                    var msg = JSON.parse(data);//JSON 리턴값이 undefined 결과가 떴을 때 JSON 값을 파싱해서 해결
                    if(msg.msg == "true"){
                        alert("패스워드를 수정하였습니다.");
                        closealt();
                    }
                    else{
                        alert("현재 패스워드가 틀렸습니다.");
                        $(".nowPW").val("");
                    }
                },error:function(data,status,err){
                    alert("error " + data + "\nstatus " + status + "\nMessage : " + err);
                }
            });
        }
    });
});
function CreateData(){
    var sendData = {id:$('#ID').val()}
    return sendData;
}