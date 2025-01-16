$(document).ready(function(){
    showall();
    var total = 0;
    window.onbeforeunload = function() {
        if(total >= 1){
            return "이 페이지를 벗어나면 장바구니의 내역들이 사라집니다. 계속 하시겠습니까?";
        }
    }
    function showall(){
        $.ajax({
            url:"js/store.json",type:"get",datatype:"json",contentType:"application/x-www-form-urlencoded; charset=UTF-8",error:function(){
                alert("데이터 불러오기 실패");
                console.log("데이터 불러오기 실패");
            },success:function(data){
                $('.store').empty();
                $.each(data, function(i,f){
                    var storelist = "<div class = 'storelist flex'><span class = 'fid'>"+f.id+
                    "</span><img src = 'src/"+f.photo+"' class = 'product' id = '"+f.id+"' name = '"+f.product_name+"' brand = '"+f.brand+"' price = '"+f.price+"'>"+
                    "<div class = 'flex column'><p class = 'mbrand'>브랜드 <span>"+f.brand+"</span></p><p class = 'mname'>상품명 <span>"
                    +f.product_name+"</span></p><p class = 'mprice'>가격 <span>"+f.price+"원</span></p></div>"+
                    "<button class = 'mobileadd' img = 'src/"+f.photo+"' id = '"+f.id+"' name = '"+f.product_name+"' brand = '"+f.brand+"' price = '"+f.price+"'>담기</button></div>";
                    $('.store').append(storelist);
                    
                });
            }
        });
        $(document).on('mouseenter','.product',function(){
            $('.product').draggable({
                revert:true,
                helper:"clone"
            });
            $("body").css("overflow-x","hidden");
        });
        
        $(".storebox").droppable({//PC버전 상품 드래그
            drop:function(e,ui){
                ui.helper.remove();
                var pid = ui.draggable.attr('id');//id속성을 지정하면 상품 중복 여부가 인식됨
                if($('.'+pid).length >= 1){
                    alert("이미 장바구니에 상품이 담겨있습니다!");
                    return;
                }
                var src = ui.draggable.attr("src");
                var name = ui.draggable.attr("name");
                var brand = ui.draggable.attr("brand");
                var price = ui.draggable.attr("price");
                rows = "<tr class = 'pdata'><td class = 'flex flextd'><img src = '"+src+"' value = '"+src+"' class = 'pimg "+pid+"' id = 'productimg'></img>"+
                "<div class = 'flex column'><p>브랜드명 : <span class = 'brand'>"+brand+"</span></p><p>상품명 : <span class = 'pname'>"+name+"</span></p>"+
                "<p class = 'priceunder680'>가격 : <span>"+price+"</span></p></div></td><td class = 'price priceover680'>"
                +price+"원</td><td><input type = 'number' value=1 min = 1 class = 'count'></td><td class = 'sumprice'>"+price+"원</td><td><button class = 'delete'>삭제</button></td></tr>";
                $(".productlist > tbody").append(rows);
                total++;
                $(this).text("장바구니 " + total + "개");
                alert("상품이 추가되었습니다.");
                totalcost();
                $(".count").click(function(){//테이블 숫자 input 데이터 역시 동적으로 생성되서 함수 안에 작성해야됨.
                    $(this).attr("value",$(this).val());
                    totalcost();
                });
                var input = document.getElementsByClassName("count");
                for(var i = 0; i < input.length; i++){
                    input[i].addEventListener("input",function(e){
                        totalcost();
                    });
                }
                $(".delete").off("click").on("click",function(e){
                    e.preventDefault();
                    const deleteproduct = confirm("상품을 삭제하시겠습니까?");
                    if(deleteproduct){
                        $(this).closest("tr").remove();
                        totalcost();
                        var pdata = document.getElementsByClassName("pdata");
                        if(pdata.length == 0){//상품을 모두 삭제할 경우 구매창도 비활성화.
                            total = 0;
                            $(".boxmodal").css("display","none");
                        }
                    }
                });

            }
        });
        //모바일 상품 구매
        $(document).on('click','.mobileadd',function(){
            if($(".loginplease").length >= 1){
                const login = confirm("이 기능은 로그인을 해야 사용할 수 있습니다. 로그인 하시겠습니까?");
                if(login){
                    $(".loginform").css("display","block");
                }
            }
            else{
                var id = $(this).attr("id");
                if($('.'+id).length >= 1){
                    alert("이미 장바구니에 상품이 담겨있습니다!");
                    return;
                }
                var img = $(this).attr("img");
                var name = $(this).attr("name");
                var brand = $(this).attr("brand");
                var price = $(this).attr("price");
                rows = "<tr class = 'pdata'><td class = 'flex flextd'><img src = '"+img+"' value = '"+img+"' class = 'pimg "+id+"' id = 'productimg'></img>"+
                "<div class = 'flex column'><p>브랜드명 : <span class = 'brand'>"+brand+"</span></p><p>상품명 : <span class = 'pname'>"+name+"</span></p>"+
                "<p class = 'priceunder680'>가격 : <span>"+price+"</span></p></div></td><td class = 'price priceover680'>"
                +price+"원</td><td><input type = 'number' value=1 min = 1 class = 'count'></td><td class = 'sumprice'>"+price+"원</td><td><button class = 'delete'>삭제</button></td></tr>";
                $(".productlist > tbody").append(rows);
                total++;
                alert("상품이 추가되었습니다.");
                totalcost();
                $(".count").click(function(){//테이블 숫자 input 데이터 역시 동적으로 생성되서 함수 안에 작성해야됨.
                    $(this).attr("value",$(this).val());
                    totalcost();
                });
                var input = document.getElementsByClassName("count");
                for(var i = 0; i < input.length; i++){
                    input[i].addEventListener("input",function(e){
                        totalcost();
                    });
                }
                $(".delete").off("click").on("click",function(e){
                    e.preventDefault();
                    const deleteproduct = confirm("상품을 삭제하시겠습니까?");
                    if(deleteproduct){
                        $(this).closest("tr").remove();
                        totalcost();
                        var pdata = document.getElementsByClassName("pdata");
                        if(pdata.length == 0){//상품을 모두 삭제할 경우 구매창도 비활성화.
                            total = 0;
                            $(".boxmodal").css("display","none");
                        }
                    }
                });
            }
        });
        function totalcost(){
            var cost = 0;
            var pdata = document.getElementsByClassName("pdata");
            var count = document.getElementsByClassName("count");
            var price = document.getElementsByClassName("price");
            var sumprice = document.getElementsByClassName("sumprice");
            var counttotal = 0;
            let regex = /[^0-9]/g;
            for(var i = 0; i < pdata.length; i++){
                var tosum = Number(price[i].innerHTML.replace(regex,"")) * Number(count[i].value);
                sumprice[i].innerHTML = tosum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원";
                cost += Number(price[i].innerHTML.replace(regex,"")) * Number(count[i].value);
                counttotal += Number(count[i].value);
            }
            $(".storebox").text("장바구니 " + counttotal + "개");
            $(".totalcost").text("결제금액 : " + cost.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원");
        }
        $(".purchase").off("click").click(function(){//구매
            var count = document.getElementsByClassName("count");
            for(var i = 0; i < count.length; i++){
                if(count[i].value <= 0 || Number.isInteger(Number(count[i].value)) == false){
                    alert("잘못된 값을 입력하였습니다.\n수량은 1 이상의 정수만 입력할 수 있습니다.");
                    return;
                }   
            }
            $(".box").css("display","none");
            $(".purchaseokmodal").css('display','block');
        });
        $(".pokclose").click(function(){
            $(".box").css("display","block");
            $(".purchaseokmodal").css('display','none');
        });
        $(".pokcancel").click(function(){
            $(".box").css("display","block");
            $(".purchaseokmodal").css('display','none');
        });
        $(".purchaseok").click(function(){
            if($(".location").val() == "" || $(".location").val().trim("") == ""){
                alert("발송 주소를 정확하게 입력하세요.");
            }
            else{
                $(".purchaseokmodal").css("display","none");
                purchase();
                showpurchase();
            }
        });
        function showpurchase(){
            $(".purchasemodal").css("display","block");
        }
        function purchase(){
            $(".new").text("");
            $(".new").removeClass("new");
            var location = $(".location").val();
            var pdata = document.getElementsByClassName("pdata");
            var brand = document.getElementsByClassName("brand");//브랜드
            var name = document.getElementsByClassName("pname");//상품명
            var count = document.getElementsByClassName("count");//구매갯수
            var price = document.getElementsByClassName("price");//가격
            var sumprice = document.getElementsByClassName("sumprice");//총가격
            var img = document.getElementsByClassName("pimg");
            for(var i = 0; i < pdata.length; i++){
                var pimg = img[i].getAttribute("value");
                var pbrand = brand[i].innerHTML;//브랜드
                var pname = name[i].innerHTML;//상품명
                var pnum = Number(count[i].value);//구매 갯수
                var pprice = price[i].innerHTML;//가격
                var psumprice = sumprice[i].innerHTML;//총가격
                var myid = $(".myid").attr("value");
                (function(i){
                    $.ajax({
                        url:'purchase.php',
                        method:'post',
                        data:{pimg:pimg, pbrand:pbrand, pname:pname, pnum:pnum , pprice:pprice, psumprice:psumprice, myid:myid, location:location}
                    });
                })(i);//반복문으로 기존 location.href = purchase.php로 데이터를 넘기는 것은 데이터 누락이 발생하여 ajax로 넘겨준다.
                var today = new Date();
                var year = today.getFullYear();
                var month = ('0' + (today.getMonth() + 1)).slice(-2);
                var day = ('0' + today.getDate()).slice(-2);
                var nowdate = year + '-' + month  + '-' + day;//현재시간 출력
                var purchaseinfo = "<tr><td class = 'newpurchase'><img src = '"+pimg+"' class = 'purchaseimg'><span class = 'new' value = '1'>NEW</span></img></td><td>"+pbrand+"</td><td>"+pname+"</td><td>"
                +pprice+"</td><td>"+pnum+"</td><td class = 'sum'>"+psumprice+"</td><td>"+nowdate+"</td><td>"+location+"</td></tr>";
                $(".purchasetable > tbody").append(purchaseinfo);//구매 즉시 구매한 물품을 구매목록 테이블에 즉시 반영한다. 데이터베이스의 경우 새로고침을 해야 반영이 되기 때문.
            }
            $(".tbody").empty();
            total = 0;
            $(".storebox").text("장바구니 0개");
            alert("성공적으로 결제하였습니다.");
            $(".location").val("");
            sum();
        }
        $(".storebox").off("click").click(function(){
            if(total == 0){
                alert("장바구니가 비어있습니다.");
            }
            else{
                $(".boxmodal").css("display","block");
            }
        });
    }
    function sum(){
        var sumtd = document.getElementsByClassName("sum");
        var sum = 0;
        let regex = /[^0-9]/g;
        for(var i = 0; i < sumtd.length; i++){
            sum += Number(sumtd[i].innerHTML.replace(regex,""));
        }
        $('.getsum').text(sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
    }
    $(".close").click(function(){
        $(".boxmodal").css("display","none");
        $(".purchasemodal").css("display","none");
    });
    $(".purchaselist").click(function(){
        if(document.getElementsByClassName('sum').length==0){
            alert("구매한 물품이 없습니다.");
        }
        else{
            sum();
            $(".purchasemodal").css("display","block");
        }
    });
    var keyword = "";
    $(".searchstore").click(function(){//검색하기
        if($(".keyword").val().trim() == ""){
            alert("키워드를 1글자 이상 입력하세요.");
        }
        else{
            keyword = $(".keyword").val();
            search(keyword);
        }
    });
    $('.keyword').keydown(function(key){//엔터키 검색
        if(key.keyCode==13){
            if($(".keyword").val().trim() == ""){
                alert("키워드를 1글자 이상 입력하세요.");
            }
            else{
                keyword = $(".keyword").val();
                search(keyword);
            }
        }
    });
    $(".showall").click(function(){
        $('.keyword').val("");
        showall();
    });
    function search(keyword){//검색
        var c = 0;
        $('.store').empty();
        $.ajax({
            url:"js/store.json",type:"get",datatype:"json",contentType:"application/x-www-form-urlencoded; charset=UTF-8",error:function(){
                alert("데이터 불러오기 실패");
                console.log("데이터 불러오기 실패");
            },success:function(data){
                $.each(data,function(i,f){
                    if(f.product_name.indexOf(keyword)!=-1||f.brand.indexOf(keyword)!=-1){
                        var storelist = "<div class = 'storelist flex'><span class = 'fid'>"+f.id+
                        "</span><img src = 'src/"+f.photo+"' class = 'product' id = '"+f.id+"' name = '"+f.product_name+"' brand = '"+f.brand+"' price = '"+f.price+"'>"+
                        "<div class = 'flex column'><p class = 'mbrand'>브랜드 <span>"+f.brand+"</span></p><p class = 'mname'>상품명 <span>"
                        +f.product_name+"</span></p><p class = 'mprice'>가격 <span>"+f.price+"원</span></p></div>"+
                        "<button class = 'mobileadd' img = 'src/"+f.photo+"' id = '"+f.id+"' name = '"+f.product_name+"' brand = '"+f.brand+"' price = '"+f.price+"'>담기</button></div>";
                        $('.store').append(storelist);
                        c += 1;
                    }
                });
                if(c==0){
                    alert("일치하는 상품이 없습니다.");
                    showall(); 
                }
                $(".brand:contains('"+keyword+"')").each(function(){
                    var regex = new RegExp(keyword,'gi');
                    $(this).html($(this).text().replace(regex,"<span>"+keyword+"</span>"));
                    $('.brand > span').css({'display':'inline','color':'red','font-weight':'bold'});
                });
                $(".pname:contains('"+keyword+"')").each(function(){
                    var regex = new RegExp(keyword,'gi');
                    $(this).html($(this).text().replace(regex,"<span>" + keyword + "</span>"));
                    $('.pname > span').css({'display':'inline','color':'red','font-weight':'bold'});
                });
            }
        });
    }
    $(".moreinfobutton").click(function(){
        $(".moreinfobox").css('display','block');
        $(".pinfomoreview").append("<button class = 'moreclose'>X</button><h3 style = 'text-align:center'>상세 정보</h3>");
        var moreinfo = "<img class = 'detailimg' src = '"+$(this).attr("img")+"'>"+"<span class = 'moreinfospan flex'>브랜드<span>"+$(this).attr("brand")+
        "</span></span><span class = 'moreinfospan flex'>상품명<span>"+$(this).attr("pname")+"</span></span><span class = 'moreinfospan flex'>가격<span>"+$(this).attr("price")+
        "</span></span><span class = 'moreinfospan flex'>구매수량<span>"+$(this).attr("count")+"</span></span><span class = 'moreinfospan flex'>합계<span>"+$(this).attr("sum")+
        "</span></span><span class = 'moreinfospan flex'>구매일자<span>"+$(this).attr("ptime")+"</span></span><span style = 'margin:0px 5px'>발송주소</span>"+
        "<span class = 'moreinfolocation'>"+$(this).attr("location")+"</span>";
        $(".pinfomoreview").append(moreinfo);
        $(".moreclose").click(function(){
            $(".pinfomoreview").empty();
            $(".moreinfobox").css('display','none');
            console.log("close");
        });
    });
});
