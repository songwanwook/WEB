//script.js의 코드를 최적화 하기 위한 js파일
$(document).ready(function(){//수정된 js가 없뎃 안되면 Ctrl F5
    function buttonreset(){
        $('.active-menu').css('background','#202020');
        $('.select').css('background','#202020');
        $('.pop').css('background','#202020');
        $('.dance').css('background','#202020');
        $('.balad').css('background','#202020');
        $('.trot').css('background','#202020');
        $('.zazz').css('background','#202020');
        $('.rock').css('background','#202020');
        $('.hiphop').css('background','#202020');
        $('.folk').css('background','#202020');
        $('.RNB').css('background','#202020');
    }
    showall();
    var genre = "";
    var table = document.getElementsByClassName('table');
    $('.active-menu').css('background','#C90000');
    function showall(){
        $.ajax({
            url:"music_data.json",type:"get",datatype:"json",contentType:"application/x-www-form-urlencoded; charset=UTF-8",
            error:function(){
                alert("Fail");
                console.log("데이터 불러오기 실패");
            },success:function(data){
                $('.contents').empty();
                var count = 0;
                count++;
                if(count < 2){
                    $.each(data.data,function(i,f){
                        if(genre == "ALL" || genre == ""){
                            var buttontext = "";
                            var cvalue;
                            if($(".table > tbody tr").length >= 1){//장바구니에 1개 이상 담겨 있을 경우 추가하기로 설정
                                for(var i = 0; i < table[0].rows.length; i++){//장바구니 이미지와 매치하는지 확인
                                    if(table[0].rows.length == 1){//1개가 담겼을때(child 없음.)
                                        if($('tr > .albuminfo > img').attr("src") == 'images/'+f.albumJaketImage){//#myModal > div > div > div.modal-body > table > tbody > tr
                                            var pvalue = $('tr > .albumqty > .form-control').attr('value');
                                            buttontext = " 추가하기 ("+pvalue+")개";//장바구니 담은 갯수 만큼 증가
                                            cvalue = pvalue;
                                        }
                                        else{
                                            buttontext = " 쇼핑카트담기";
                                            cvalue = 0;
                                        }
                                    }
                                    else{
                                        if($('tr:nth-child('+i+') > .albuminfo > img').attr("src") == 'images/'+f.albumJaketImage){//#myModal > div > div > div.modal-body > table > tbody > tr
                                            var pvalue = $('tr:nth-child('+i+') > .albumqty > .form-control').attr('value');
                                            buttontext = " 추가하기 ("+pvalue+")개";//장바구니 담은 갯수 만큼 증가
                                            cvalue = pvalue;
                                        }
                                        else{
                                            buttontext = " 쇼핑카트담기";
                                            cvalue = 0;
                                        }
                                    }
                                }
                            }
                            else{
                                buttontext = " 쇼핑카트담기";
                                cvalue = 0;
                            }
                            var musicinfo = "<div class='col-md-2 col-sm-2 col-xs-2 product-grid'><div class='product-items'><div class='project-eff'><img class='img-responsive' src='images/"
                            +f.albumJaketImage+"' alt='Time for the moon night'></div><div class='produ-cost'><h5 class = '"+f.albumName+"'>"+ f.albumName +"</h5><span><i class='fa fa-microphone'> 아티스트</i> <p>" + f.artist + 
                            "</p></span><span><i class='fa  fa-calendar'> 발매일</i><p>" + f.release + "</p></span><span><i class='fa fa-money'> 가격</i><p> " + f.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + 
                            " </p></span><span class='shopbtn'><button class='btn btn-default btn-xs' value = "+cvalue+"><i class='fa fa-shopping-cart'></i> "+ buttontext +"</button></span></div></div></div>";
                            $(".contents").append(musicinfo);
                        }
                        else{
                            if(f.category == genre){
                                var buttontext = "";
                                var cvalue;
                                if($(".table > tbody tr").length >= 1){//장바구니에 1개 이상 담겨 있을 경우 추가하기로 설정
                                    for(var i = 0; i < table[0].rows.length; i++){//장바구니 이미지와 매치하는지 확인
                                        if(table[0].rows.length == 1){//1개가 담겼을때(child 없음.)
                                            if($('tr > .albuminfo > img').attr("src") == 'images/'+f.albumJaketImage){//#myModal > div > div > div.modal-body > table > tbody > tr
                                                var pvalue = $('tr > .albumqty > .form-control').attr('value');
                                                buttontext = " 추가하기 ("+pvalue+")개";//장바구니 담은 갯수 만큼 증가
                                                cvalue = pvalue;
                                            }
                                            else{
                                                buttontext = " 쇼핑카트담기";
                                                cvalue = 0;
                                            }
                                        }
                                        else{
                                            if($('tr:nth-child('+i+') > .albuminfo > img').attr("src") == 'images/'+f.albumJaketImage){//#myModal > div > div > div.modal-body > table > tbody > tr
                                                var pvalue = $('tr:nth-child('+i+') > .albumqty > .form-control').attr('value');
                                                buttontext = " 추가하기 ("+pvalue+")개";//장바구니 담은 갯수 만큼 증가
                                                cvalue = pvalue;
                                            }
                                            else{
                                                buttontext = " 쇼핑카트담기";
                                                cvalue = 0;
                                            }
                                        }
                                    }
                                }
                                else{
                                    buttontext = " 쇼핑카트담기";
                                    cvalue = 0;
                                }
                                var musicinfo = "<div class='col-md-2 col-sm-2 col-xs-2 product-grid'><div class='product-items'><div class='project-eff'><img class='img-responsive' src='images/"
                                +f.albumJaketImage+"' alt='Time for the moon night'></div><div class='produ-cost'><h5 class = '"+f.albumName+"'>"+ f.albumName +"</h5><span><i class='fa fa-microphone'> 아티스트</i> <p>" + f.artist + 
                                "</p></span><span><i class='fa  fa-calendar'> 발매일</i><p>" + f.release + "</p></span><span><i class='fa fa-money'> 가격</i><p> " + f.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + 
                                " </p></span><span class='shopbtn'><button class='btn btn-default btn-xs' value = "+cvalue+"><i class='fa fa-shopping-cart'></i> "+ buttontext +"</button></span></div></div></div>";
                                $(".contents").append(musicinfo);
                            }
                        }
                    });
                }
                else{
                    count = 0;
                }
                $('.btn-xs').click(function(){
                    var name = $(this).parents('.produ-cost').children("h5").text();
                    var artist = $(this).parents('.produ-cost').children("span:nth-child(2)").children("p").text();
                    var date = $(this).parents('.produ-cost').children("span:nth-child(3)").children("p").text();
                    var price = $(this).parents('.produ-cost').children("span:nth-child(4)").children("p").text();
                    var img = $(this).parents('.product-grid > .product-items').children('.project-eff').children('.img-responsive').attr('src');
                    if($(this).text().match("추가하기")){//같은 앨범 선택시
                        $(this).attr('value',parseInt($(this).val())+1);
                        var avalue = parseInt($(this).val());
                        $(this).html('<i class="fa fa-shopping-cart"></i> 추가하기 ('+avalue+')개');//클릭 횟수만큼 수량 증가.
                        
                        for(var i = 0; i < table[0].rows.length; i++){//증가한 수량만큼 폼 컨트롤도 증가.
                            if($('tr:nth-child('+i+') > .albuminfo > img').attr("src") == img){
                                $('tr:nth-child('+i+') > .albumqty > .form-control').attr('value',avalue);
                                console.log(avalue);
                                getsum();
                            }
                        }
                    }
                    else{
                        var addmusic = '<tr><td class="albuminfo"><img src="'+img+'"><div class="info"><h4>'+name+'</h4>'+
                                        '<span><i class="fa fa-microphone"> 아티스트</i><p>'+artist+'</p></span><span><i class="fa  fa-calendar"> 발매일</i><p>'+date+'</p>'+
                                        '</span></div></td><td class="albumprice">￦ '+price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td><td class="albumqty"><input type="number" class="form-control" min = "1" value="1"></td>' +
                                        '<td class="pricesum">￦ '+price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td><td><button class="btn btn-default"><i class="fa fa-trash-o"></i> 삭제</button></td></tr>';
                        $(this).html('<i class="fa fa-shopping-cart"></i> 추가하기 (1)개');
                        $(this).attr('value',1);
                    }
                    $('.table-bordered > tbody').append(addmusic);
                    $(".fa-trash-o").parents('.btn').click(function(){//삭제(테이블 안에 있는 삭제 버튼은 전역으로 빼도 작동이 안한다...)
                        const del = confirm("삭제하시겠습니까?");
                        if(del == true){
                            var imgres = document.getElementsByClassName("img-responsive");
                            var thisimg = $(this).closest('tr').children('.albuminfo').children('img').attr('src');
                            //var control = document.getElementsByClassName("form-control");
                            for(var i = 0; i < imgres.length; i++){//장바구니 물품 삭제 시 추가하기 버튼을 장바구니담기로 초기화
                                if(thisimg == $("div:nth-child("+i+") > .product-items > .project-eff > .img-responsive").attr("src")){
                                    $("div:nth-child("+i+") > .product-items > .produ-cost > .shopbtn > .btn-xs").attr('value',0);
                                    $("div:nth-child("+i+") > .product-items > .produ-cost > .shopbtn > .btn-xs").html("<i class='fa fa-shopping-cart'></i> 쇼핑카트담기");
                                }
                            }
                            $(this).closest('tr').remove();
                            getsum();
                        }
                    });//그리고 1번만 떠야 될 삭제 알림창이 테이블 form-control의 합계만큼 작동한다.
                    $(".form-control").click(function(){//수량변경, form control 값만큼 추가하기 수량 증가해야됨.
                        var control = document.getElementsByClassName("form-control");
                        var imgres = document.getElementsByClassName("img-responsive");
                        var contval = [];
                        for(var i = 0; i < control.length-1; i++){
                            //console.log(control[i].value);
                            for(var j = 1; j <= imgres.length; j++){//증가한 수량만큼 폼 컨트롤도 증가(연동이 안됨.)
                                if($(this).closest('tr').children('.albuminfo').children('img').attr('src') == $("div:nth-child("+j+") > .product-items > .project-eff > .img-responsive").attr("src")){
                                    let cont = control[i].value;
                                    //$("div:nth-child("+j+") > .product-items > .produ-cost > .shopbtn > .btn-xs").attr('value',Number(cont));
                                    control[i].setAttribute("value",cont);
                                    contval[i] = cont;
                                    //console.log(contval[i]);
                                    $("div:nth-child("+j+") > .product-items > .produ-cost > .shopbtn > .btn-xs").html("<i class='fa fa-shopping-cart'></i> 추가하기 (" + contval[i] + ")개");
                                    $("div:nth-child("+j+") > .product-items > .produ-cost > .shopbtn > .btn-xs").attr("value",contval[i]);

                                }   
                            }
                        }
                        getsum();
                    })//문제점 : form-control에서 조정한 갯수와 추가하기 버튼을 클릭했을 때 더 추가되는 갯수와 연동이 안됨.
                    getsum();
                });
            }
        }); 
    }
    $(".fa-trash-o").parents('.btn').click(function(){//삭제
        const del = confirm("삭제하시겠습니까?");
        if(del == true){
            var imgres = document.getElementsByClassName("img-responsive");
            var thisimg = $(this).closest('tr').children('.albuminfo').children('img').attr('src');
            for(var i = 0; i < imgres.length; i++){//장바구니 물품 삭제 시 추가하기 버튼을 장바구니담기로 초기화
                if(thisimg == $("div:nth-child("+i+") > .product-items > .project-eff > .img-responsive").attr("src")){
                    console.log(thisimg);
                    console.log($("div:nth-child("+i+") > .product-items > .project-eff > .img-responsive").attr("src"));
                    $("div:nth-child("+i+") > .product-items > .produ-cost > .shopbtn > .btn-xs").attr('value',0);
                    $("div:nth-child("+i+") > .product-items > .produ-cost > .shopbtn > .btn-xs").html("<i class='fa fa-shopping-cart'></i> 쇼핑카트담기");
                }
            }
            $(this).closest('tr').remove();
            getsum();
        }
    });
    function getsum(){//최종결제가격
        var totalprice = document.getElementsByClassName("pricesum");
        var control = document.getElementsByClassName("form-control");
        var albumprice = document.getElementsByClassName("albumprice");
        let regex = /[^0-9]/g;
        var sum = 0;
        var val = 0;
        
        for(var i = 0; i < totalprice.length; i++){
            let thisprice = albumprice[i].innerHTML;//현재가격
            let result = thisprice.replace(regex, ""); // 콤마 제거
            let cont = control[i].value;//구매개수
            
            totalprice[i].innerHTML = "￦ "+result*cont+"원";
            sum += Number(result)*Number(cont);//최종결제가격
            val += Number(control[i].value);
        }
        $(".totalprice > h3 > span").empty();
        $(".totalprice > h3 > span").append("￦ "+sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        var btnprimary = document.getElementsByClassName("btn-primary");
        btnprimary[0].innerHTML = '<i class="fa fa-shopping-cart"></i> 쇼핑카트 <strong>'+val+'</strong> 개 금액 ￦ '+sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'원';
    }
    //modal-body > div > h3 > span
    $(".form-control").click(function(){//수량변경
        getsum();
        
    })
    $('.click').click(function(){
        genre = $(this).children("a").children("span").text();
        buttonreset();
        switch(genre){
            case"ALL":$('.active-menu').css('background','#C90000');break;
            case"발라드":$('.balad').css('background','#C90000');break;
            case"댄스":$('.dance').css('background','#C90000');break;
            case"팝":$('.pop').css('background','#C90000');break;
            case"트로트":$('.trot').css('background','#C90000');break;
            case"재즈":$('.zazz').css('background','#C90000');break;
            case"락메탈":$('.rock').css('background','#C90000');break;
            case"랩힙합":$('.hiphop').css('background','#C90000');break;
            case"포크어코스틱":$('.folk').css('background','#C90000');break;
            case"R&B":$('.RNB').css('background','#C90000');break;
        }
        showall();
    });
    $('.input-group-btn > button').click(function(event){
        buttonreset();
        var value = "";
        value = $('.form-group > .form-control').val();
        data_search(value);
    });
    $('.form-group > .form-control').keydown(function(key){
        if(key.keyCode==13){
            buttonreset();
            var value = "";
            value = $('.form-group > .form-control').val();
            data_search(value);
        }
    });
    function data_search(value){
        var c = 0;
        $('.contents').empty();
        $.ajax({
            url:"music_data.json",type:"get",datatype:"json",contentType:"application/x-www-form-urlencoded; charset=UTF-8",error:function(){
                alert("Fail");
                console.log("데이터 불러오기 실패");
            }, success:function(data){
                $.each(data.data, function(i,f){
                    if(f.albumName.indexOf(value)!=-1||f.artist.indexOf(value)!=-1){
                        var buttontext = "";
                        var cvalue;
                        if($(".table > tbody tr").length >= 1){//장바구니에 1개 이상 담겨 있을 경우 추가하기로 설정
                            for(var i = 0; i < table[0].rows.length; i++){//장바구니 이미지와 매치하는지 확인
                                if(table[0].rows.length == 1){//1개가 담겼을때(child 없음.)
                                    if($('tr > .albuminfo > img').attr("src") == 'images/'+f.albumJaketImage){//#myModal > div > div > div.modal-body > table > tbody > tr
                                        var pvalue = $('tr > .albumqty > .form-control').attr('value');
                                        buttontext = " 추가하기 ("+pvalue+")개";//장바구니 담은 갯수 만큼 증가
                                        cvalue = pvalue;
                                    }
                                    else{
                                        buttontext = " 쇼핑카트담기";
                                        cvalue = 0;
                                    }
                                }
                                else{
                                    if($('tr:nth-child('+i+') > .albuminfo > img').attr("src") == 'images/'+f.albumJaketImage){//#myModal > div > div > div.modal-body > table > tbody > tr
                                        var pvalue = $('tr:nth-child('+i+') > .albumqty > .form-control').attr('value');
                                        buttontext = " 추가하기 ("+pvalue+")개";//장바구니 담은 갯수 만큼 증가
                                        cvalue = pvalue;
                                    }
                                    else{
                                        buttontext = " 쇼핑카트담기";
                                        cvalue = 0;
                                    }
                                }
                            }
                        }
                        else{
                            buttontext = " 쇼핑카트담기";
                            cvalue = 0;
                        }
                        var data_all = '<div class="col-md-2 col-sm-2 col-xs-2 product-grid">' + '<div class = "product-items">' + '<div class = "project-eff">' + '<img class = "img-responsive" src = "images/'
                         + f.albumJaketImage + '">' + '</div>' + '<div class = "produ-cost">' + '<h5>' + f.albumName + '</h5>' + '<span><i class = "fa fa-microphone">아티스트</i>' + '<p>' + f.artist + '</p>' 
                         + '</span>' + '<span><i class = "fa fa-calendar">발매일</i>' + '<p>' + f.release + '</p>' + '</span>' + '<span><i class = "fa fa-money">가격</i>' + '<p>' + f.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '</p>' + '</span>' 
                         + '<span class = "shopbtn"><button class = "btn btn-default btn-xs" value = '+cvalue+'><i class = "fa fa-shopping-cart"><i> '+ buttontext +'</button></span>'+ '</div>' + '</div>' + '</div>';
                        $(data_all).appendTo('.contents');
                        c = c + 1;
                        
                    }
                });
                $('.btn-xs').click(function(){
                    $(this).innerHTML = '<i class="fa fa-shopping-cart"></i> 추가하기 (1)개';
                    var name = $(this).parents('.produ-cost').children("h5").text();
                    var artist = $(this).parents('.produ-cost').children("span:nth-child(2)").children("p").text();
                    var date = $(this).parents('.produ-cost').children("span:nth-child(3)").children("p").text();
                    var price = $(this).parents('.produ-cost').children("span:nth-child(4)").children("p").text();
                    var img = $(this).parents('.product-grid > .product-items').children('.project-eff').children('.img-responsive').attr('src');
                    if($(this).text().match("추가하기")){//같은 앨범 선택시
                        $(this).attr('value',parseInt($(this).val())+1);
                        var avalue = parseInt($(this).val());
                        $(this).html('<i class="fa fa-shopping-cart"></i> 추가하기 ('+avalue+')개');//클릭 횟수만큼 수량 증가.
                        var table = document.getElementsByClassName('table');
                        for(var i = 0; i < table[0].rows.length; i++){//증가한 수량만큼 폼 컨트롤도 증가.
                            if($('tr:nth-child('+i+') > .albuminfo > img').attr("src") == img){
                                $('tr:nth-child('+i+') > .albumqty > .form-control').attr('value',avalue);
                                getsum();
                            }
                        }
                    }
                    else{
                        var addmusic = '<tr><td class="albuminfo"><img src="'+img+'"><div class="info"><h4>'+name+'</h4>'+
                                        '<span><i class="fa fa-microphone"> 아티스트</i><p>'+artist+'</p></span><span><i class="fa  fa-calendar"> 발매일</i><p>'+date+'</p>'+
                                        '</span></div></td><td class="albumprice">￦ '+price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td><td class="albumqty"><input type="number" class="form-control" min = "1" value="1"></td>' +
                                        '<td class="pricesum">￦ '+price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td><td><button class="btn btn-default"><i class="fa fa-trash-o"></i> 삭제</button></td></tr>';
                        $(this).html('<i class="fa fa-shopping-cart"></i> 추가하기 (1)개');
                        $(this).attr('value',1);
                    }
                    $('.table-bordered > tbody').append(addmusic);
                    $(".fa-trash-o").parents('.btn').click(function(){//삭제
                        const del = confirm("삭제하시겠습니까?");
                        if(del == true){//러블리즈 노래를 검색하면 Undefined로 뜬다.
                            var imgres = document.getElementsByClassName("img-responsive");
                            var thisimg = $(this).closest('tr').children('.albuminfo').children('img').attr('src');
                            for(var i = 1; i <= imgres.length; i++){//장바구니 물품 삭제 시 추가하기 버튼을 장바구니담기로 초기화
                                if(thisimg == $("div:nth-child("+i+") > .product-items > .project-eff > .img-responsive").attr("src")){
                                    $("div:nth-child("+i+") > .product-items > .produ-cost > .shopbtn > .btn-xs").attr('value',0);
                                    $("div:nth-child("+i+") > .product-items > .produ-cost > .shopbtn > .btn-xs").html("<i class='fa fa-shopping-cart'></i> 쇼핑카트담기");
                                }
                            }
                            $(this).closest('tr').remove();
                            getsum();
                        }
                        else{
                            return false;
                        }
                    });
                    $(".form-control").click(function(){//수량변경
                        var control = document.getElementsByClassName("form-control");
                        var imgres = document.getElementsByClassName("img-responsive");
                        var contval = [];
                        for(var i = 0; i < control.length-1; i++){
                            //console.log(control[i].value);
                            for(var j = 1; j <= imgres.length; j++){//증가한 수량만큼 폼 컨트롤도 증가(연동이 안됨.)
                                if($(this).closest('tr').children('.albuminfo').children('img').attr('src') == $("div:nth-child("+j+") > .product-items > .project-eff > .img-responsive").attr("src")){
                                    let cont = control[i].value;
                                    //$("div:nth-child("+j+") > .product-items > .produ-cost > .shopbtn > .btn-xs").attr('value',Number(cont));
                                    control[i].setAttribute("value",cont);
                                    contval[i] = cont;
                                    //console.log(contval[i]);
                                    $("div:nth-child("+j+") > .product-items > .produ-cost > .shopbtn > .btn-xs").html("<i class='fa fa-shopping-cart'></i> 추가하기 (" + contval[i] + ")개");
                                    $("div:nth-child("+j+") > .product-items > .produ-cost > .shopbtn > .btn-xs").attr("value",contval[i]);

                                }   
                            }
                        }
                        getsum();
                    })
                    getsum();
                    
                });
                if(c==0){
                    alert("검색된 앨범이 없습니다.");
                }
                $(".produ-cost > h5:contains('"+value+"')").each(function(){
                    var regex = new RegExp(value,'gi');
                    $(this).html($(this).text().replace(regex,"<span>"+value+"</span>"));
                    $('.produ-cost > h5 > span').css({'display':'inline','background-color':'yellow'});
                });
                $(".produ-cost > h5 + span > p:contains('"+value+"')").each(function(){
                    var regex = new RegExp(value,'gi');
                    $(this).html($(this).text().replace(regex,"<span>" + value + "</span>"));
                    $('.produ-cost > h5 + span > p > span').css({'display':'inline','background-color':'yellow'});
                });
            }
        })    
    }
    var btnxs = document.getElementsByClassName("btn-xs");
    $('.btn-primary').click(function(){
        if($(this).text()=="결제하기"){
            var btnprimary = document.getElementsByClassName("btn-primary");
            var btntext = btnprimary[0].innerText;
            var price = btntext.substring(btntext.indexOf("￦")+1,btntext.indexOf("원")).trim();
            price = price.replace(',',"");
            const conf = confirm("총 금액은 "+price+"원 입니다. 결제하시겠습니까?");
            if(conf == true){
                var nowprice = 100000;
                if(nowprice < Number(price)){//10만원 넘어가면 잔액 부족
                    alert("잔액이 부족합니다.");
                }
                else{
                    alert("성공적으로 결제하였습니다.");
                    $('.table > tbody').empty();
                    getsum();//테이블을 삭제한 뒤 결제금액 함수를 호출해 결제할 금액을 다시 초기화
                    $(".modal-backdrop").css("display","none");
                    $("#myModal").css("display","none");
                    for(var i = 0; i < btnxs.length; i++){
                        if(btnxs[i].innerHTML.match("추가하기"))
                        btnxs[i].innerHTML = "<i class='fa fa-shopping-cart'></i> 쇼핑카트담기";
                    }
                    $('.btn-lg').click(function(){
                        $(".modal-backdrop").css("display","block");
                        $("#myModal").css("display","block");
                    });
                }
            }
        }
    })
});