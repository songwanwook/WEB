$(document).ready(function(){
    $(".call").click(function(){
        $(".QuotationModal").css('display','block');
        $(".requestquotation").css('display','flex');
    });
    $(".close").click(function(){
        close();
    });
    $(".cancelquotation").click(function(){
        close();
    });
    function close(){
        const close = confirm("지금 창을 닫으시면 작성중인 내용도 삭제됩니다. 창을 닫으시겠습니까?");
        if(close){
            $(".QuotationModal").css('display','none');
            $(".requestquotation").css('display','none');
            $(".sendquotation").css('display','none');
            $(".quotationcontents").val("");
            $(".costinput").val("");
            $(".date").val("");
        }
    }
    $(".viewclose").click(function(){
        $(".QuotationModal").css('display','none');
        $(".quotationdetailview").css('display','none');
        $(".quotationview").css('display','none');
    });
    $(".callquotation").on("click",function(e){//form의 빈 값 전송을 막기 위함
        if($(".date").val().trim() == ""){
            e.preventDefault();
            alert("날짜를 작성하세요.");
        }
        else if($(".quotationcontents").val().trim() == ""){
            e.preventDefault();
            alert("견적 내용을 작성하세요.");
        }
        
    });
    $(".quobutton").click(function(){
        $(".QuotationModal").css('display','block');
        $(".quono").attr("value",$(this).val());
    });
    $(".sendquo").click(function(){
        $(".sendquotation").css('display','flex');
    });
    $(".viewquo").click(function(){
        var quono = $(this).val();
        $.ajax({
            url:"viewquotation.php",method:"POST",data:{quono:quono},success:function(data){
                $(".tbody").html(data);
                $(".quotationview").css('display','block');
            },error:function(data){
                alert("error");
            }
        });
    });
    $(".send").on("click",function(e){//form의 빈 값 전송을 막기 위함
        if(Number($(".costinput").val()) < 100000){
            e.preventDefault();
            alert("견적 비용은 최소 10만원 입니다.");
        }
        else if($(".sendquotationcontents").val().trim() == ""){
            e.preventDefault();
            alert("견적 내용을 작성하세요.");
        }
    });
    $(".quotationdetail").click(function(){
        $(".QuotationModal").css('display','block');
        $(".quotationdetailview").css('display','block');
        $(".quotationdetailview > .flex").empty();
        var info = "<p>"+$(this).attr("no")+"</p><span>요청 회원 : "+$(this).attr("name")+"("+$(this).attr("ID")+")</span><span>요청 내용 : "+$(this).attr("contents")+
        "</span><span>견적 날짜 : "+$(this).attr("date")+"</span><span>진행 상태 : "+$(this).attr("state")+"</span><span>견적 개수 : "+$(this).attr("quocount")+"</span>";
        $(".quotationdetailview > .flex").append(info);
    });
    $(".sentquotationdetail").click(function(){
        $(".QuotationModal").css('display','block');
        $(".quotationdetailview").css('display','block');
        $(".quotationdetailview > .flex").empty();
        var info = "<p>"+$(this).attr("no")+"</p><span>가격 : "+$(this).attr("cost")+"</span><span>견적 내용 : "+$(this).attr("contents")+
        "</span><span>진행 상태 : "+$(this).attr("state")+"</span>";
        $(".quotationdetailview > .flex").append(info);
    });
});