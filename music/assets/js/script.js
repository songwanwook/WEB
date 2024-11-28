$(document).ready(function(){//메인 페이지
    showall();
    
    function showall(){
        $('.contents').empty();
        $('.active-menu').css('background','#C90000');
        $.ajax({
            url:"music_data.json",type:"get",datatype:"json",contentType:"application/x-www-form-urlencoded; charset=UTF-8",
            error:function(){
                alert("Fail");
                console.log("데이터 불러오기 실패");
            },success:function(data){
                count++;
                if(count < 2){
                    $.each(data.data,function(i,f){
                        var buttontext = "";
                        if(f.albumName == "Lovelyz 4th Mini Album"){
                            buttontext = " 추가하기 (1개)";
                        }
                        else{
                            buttontext = " 쇼핑카트담기";
                        }
                        var musicinfo = "<div class='col-md-2 col-sm-2 col-xs-2 product-grid'><div class='product-items'><div class='project-eff'><img class='img-responsive' src='images/"
                        +f.albumJaketImage+"' alt='Time for the moon night'></div><div class='produ-cost'><h5 class = '"+f.albumName+"'>"+ f.albumName +"</h5><span><i class='fa fa-microphone'> 아티스트</i> <p>" + f.artist + 
                        "</p></span><span><i class='fa  fa-calendar'> 발매일</i><p>" + f.release + "</p></span><span><i class='fa fa-money'> 가격</i><p>" + f.price + 
                        "</p></span><span class='shopbtn'><button class='btn btn-default btn-xs'><i class='fa fa-shopping-cart'></i> "+ buttontext +"</button></span></div></div></div>";
                        $(".contents").append(musicinfo);
                        
                    });
                }
                else{
                    count = 0;
                }
                var btnxs = $('.btn-xs');
                $('.btn-xs').click(function(){
                    btnxs.val("추가하기");
                    var name = $(this).parents('.produ-cost').children("h5").text();
                    var artist = $(this).parents('.produ-cost').children("span:nth-child(2)").children("p").text();
                    var date = $(this).parents('.produ-cost').children("span:nth-child(3)").children("p").text();
                    var price = $(this).parents('.produ-cost').children("span:nth-child(4)").children("p").text();
                    var img = $(this).parents('.product-grid > .product-items').children('.project-eff').children('.img-responsive').attr('src');
                    var addmusic = '<tr><td class="albuminfo"><img src="'+img+'"><div class="info"><h4>'+name+'</h4>'+
                                    '<span><i class="fa fa-microphone"> 아티스트</i><p>'+artist+'</p></span><span><i class="fa  fa-calendar"> 발매일</i><p>'+date+'</p>'+
                                    '</span></div></td><td class="albumprice">￦ '+price+'</td><td class="albumqty"><input type="number" class="form-control" min = "1" value="1"></td>' +
                                    '<td class="pricesum">￦ '+price+'</td><td><button class="btn btn-default"><i class="fa fa-trash-o"></i> 삭제</button></td></tr>';
                    $('.table-bordered > tbody').append(addmusic);
                    var totalprice = document.getElementsByClassName("pricesum");
                    var control = document.getElementsByClassName("form-control");
                    var albumprice = document.getElementsByClassName("albumprice");
                    let regex = /[^0-9]/g;
                    function getsum(){
                        var sum = 0;
                        
                        for(var i = 0; i < totalprice.length; i++){
                            let thisprice = albumprice[i].innerHTML;//현재가격
                            let result = thisprice.replace(regex, ""); // 콤마 제거
                            let cont = control[i].value;//구매개수
                            totalprice[i].innerHTML = "￦ "+result*cont+"원";
                            sum += Number(result)*Number(cont);//최종결제가격
                        }
                        $(".totalprice > h3 > span").empty();
                        $(".totalprice > h3 > span").append("￦ "+sum);
                    }
                    getsum();
                    //modal-body > div > h3 > span
                    $(".form-control").click(function(){
                        getsum();
                    })
                });
            }
        }); 
    }
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
    $('.active-menu').click(function(){
        $('.contents').empty();
        buttonreset();
        $('.active-menu').css('background','#C90000');
        /*var music = '<div class="col-md-2 col-sm-2 col-xs-2 product-grid"><div class="product-items"><div class="project-eff"><img class="img-responsive"' + 
        'src="images/20163624.jpg" alt="Time for the moon night"></div><div class="produ-cost"><h5 name = "Time for the moon night">Time for the moon night</h5>'+
        '<span><i class="fa fa-microphone"> 아티스트</i>' + 
        '<p>여자친구(GFRIEND)</p></span><span><i class="fa  fa-calendar"> 발매일</i><p>2018.04.30</p></span><span><i class="fa fa-money"> 가격</i><p>￦11,000</p></span>' +
        '<span class="shopbtn"><button class="btn btn-default btn-xs"><i class="fa fa-shopping-cart"></i> 쇼핑카트담기</button></span></div></div></div>' +
        '<div class="col-md-2 col-sm-2 col-xs-2 product-grid"><div class="product-items"><div class="project-eff">' +
        '<img class="img-responsive" src="images/20162259.jpg" alt="Time for the moon night"></div><div class="produ-cost">' +
        '<h5 name = "name" value = "Lovelyz 4th Mini Album">Lovelyz 4th Mini Album</h5><span>'+
        '<i class="fa fa-microphone"> 아티스트</i><p>러블리즈(Lovelyz)</p></span><span><i class="fa  fa-calendar"> 발매일</i><p>2018.04.23</p></span><span><i class="fa fa-money"> 가격</i>' +
        '<p>￦20,000</p></span><span class="shopbtn"><button class="btn btn-default btn-xs"><i class="fa fa-shopping-cart"></i> 추가하기 (1개) </button></span></div></div></div>';
        $(".contents").append(music);*/
        showall();
    });
    $('.balad').click(function(){
        buttonreset();
        $('.balad').css('background','#C90000');
        $('.contents').empty();
        $.ajax({
            url:"music_data.json",type:"get",datatype:"json",contentType:"application/x-www-form-urlencoded; charset=UTF-8",error:function(){
                alert("Fail");
                console.log("데이터 불러오기 실패");
            },
            success:function(data){
                count++;
                if(count < 2){//JSON이 중복 호출되는 문제가 있어 이를 방지하는 코드.
                    $.each(data.data,function(i,f){
                        if(f.category == "발라드"){
                            var buttontext = "";
                            if(f.albumName == "Lovelyz 4th Mini Album"){
                                buttontext = "추가하기 (1개)";
                            }
                            else{
                                buttontext = " 쇼핑카트담기";
                            }
                            var musicinfo = "<div class='col-md-2 col-sm-2 col-xs-2 product-grid'><div class='product-items'><div class='project-eff'><img class='img-responsive' src='images/"
                            +f.albumJaketImage+"' alt='Time for the moon night'></div><div class='produ-cost'><h5>"+ f.albumName +"</h5><span><i class='fa fa-microphone'> 아티스트</i> <p>" + f.artist + 
                            "</p></span><span><i class='fa  fa-calendar'> 발매일</i><p>" + f.release + "</p></span><span><i class='fa fa-money'> 가격</i><p>" + f.price + 
                            "</p></span><span class='shopbtn'><button class='btn btn-default btn-xs'><i class='fa fa-shopping-cart'></i> "+ buttontext +"</button></span></div></div></div>";
                            $(".contents").append(musicinfo);
                        }
                    });
                }
                else{
                    count = 0;
                }
                $('.btn-xs').click(function(){
                    $(this).val("추가하기");
                    var parents = $(this).parents('.product-grid').text();
                    var name = parents.substring(0,parents.indexOf(" 아티스트 "));
                    var artist = parents.substring(parents.indexOf(" 아티스트 ")+6,parents.indexOf(" 발매일"));
                    var date = parents.substring(parents.indexOf(" 발매일")+4,parents.indexOf(" 가격"));
                    var price = parents.substring(parents.indexOf(" 가격")+3,parents.indexOf("원"));
                    var img = $(this).parents('.product-grid > .product-items').children('.project-eff').children('.img-responsive').attr('src');
                    var addmusic = '<tr><td class="albuminfo"><img src="'+img+'"><div class="info"><h4>'+name+'</h4>'+
                                    '<span><i class="fa fa-microphone"> 아티스트</i><p>'+artist+')</p></span><span><i class="fa  fa-calendar"> 발매일</i><p>'+date+'</p>'+
                                    '</span></div></td><td class="albumprice">￦ '+price+'</td><td class="albumqty"><input type="number" class="form-control" value="1"></td>' +
                                    '<td class="pricesum">￦ '+price+'</td><td><button class="btn btn-default"><i class="fa fa-trash-o"></i> 삭제</button></td></tr>';
                    $('.table-bordered > tbody').append(addmusic);
                });
            }
        });
    });
    var count = 0;
    $('.dance').click(function(){
        buttonreset();
        $('.dance').css('background','#C90000');
        $('.contents').empty();
        $.ajax({
            url:"music_data.json",type:"get",datatype:"json",contentType:"application/x-www-form-urlencoded; charset=UTF-8",error:function(){
                alert("Fail");
                console.log("데이터 불러오기 실패");
            },
            success:function(data){
                count++;
                if(count < 2){
                    $.each(data.data,function(i,f){
                        if(f.category == "댄스"){
                            count++;
                            var buttontext = "";
                            if(f.albumName == "Lovelyz 4th Mini Album"){
                                buttontext = "추가하기 (1개)";
                            }
                            else{
                                buttontext = " 쇼핑카트담기";
                            }
                            var musicinfo = "<div class='col-md-2 col-sm-2 col-xs-2 product-grid'><div class='product-items'><div class='project-eff'><img class='img-responsive' src='images/"
                            +f.albumJaketImage+"' alt='Time for the moon night'></div><div class='produ-cost'><h5>"+ f.albumName +"</h5><span><i class='fa fa-microphone'> 아티스트</i> <p>" + f.artist + 
                            "</p></span><span><i class='fa  fa-calendar'> 발매일</i><p>" + f.release + "</p></span><span><i class='fa fa-money'> 가격</i><p>" + f.price + 
                            "</p></span><span class='shopbtn'><button class='btn btn-default btn-xs'><i class='fa fa-shopping-cart'></i> "+ buttontext +"</button></span></div></div></div>";
                            $(".contents").append(musicinfo);
                        }
                    });
                }
                else{
                    count = 0;
                }
                $('.btn-xs').click(function(){
                    $(this).val("추가하기");
                    var parents = $(this).parents('.product-grid').text();
                    var name = parents.substring(0,parents.indexOf(" 아티스트 "));
                    var artist = parents.substring(parents.indexOf(" 아티스트 ")+6,parents.indexOf(" 발매일"));
                    var date = parents.substring(parents.indexOf(" 발매일")+4,parents.indexOf(" 가격"));
                    var price = parents.substring(parents.indexOf(" 가격")+3,parents.indexOf("원"));
                    var img = $(this).parents('.product-grid > .product-items').children('.project-eff').children('.img-responsive').attr('src');
                    var addmusic = '<tr><td class="albuminfo"><img src="'+img+'"><div class="info"><h4>'+name+'</h4>'+
                                    '<span><i class="fa fa-microphone"> 아티스트</i><p>'+artist+')</p></span><span><i class="fa  fa-calendar"> 발매일</i><p>'+date+'</p>'+
                                    '</span></div></td><td class="albumprice">￦ '+price+'</td><td class="albumqty"><input type="number" class="form-control" value="1"></td>' +
                                    '<td class="pricesum">￦ '+price+'</td><td><button class="btn btn-default"><i class="fa fa-trash-o"></i> 삭제</button></td></tr>';
                    $('.table-bordered > tbody').append(addmusic);
                });
            }
        });
    });
    $('.pop').click(function(){
        buttonreset();
        $('.pop').css('background','#C90000');
        $('.contents').empty();
        $.ajax({
            url:"music_data.json",type:"get",datatype:"json",contentType:"application/x-www-form-urlencoded; charset=UTF-8",error:function(){
                alert("Fail");
                console.log("데이터 불러오기 실패");
            },
            success:function(data){
                count++;
                if(count < 2){
                    $.each(data.data,function(i,f){
                        if(f.category == "팝"){
                            count++;
                            var buttontext = "";
                            if(f.albumName == "Lovelyz 4th Mini Album"){
                                buttontext = "추가하기 (1개)";
                            }
                            else{
                                buttontext = " 쇼핑카트담기";
                            }
                            var musicinfo = "<div class='col-md-2 col-sm-2 col-xs-2 product-grid'><div class='product-items'><div class='project-eff'><img class='img-responsive' src='images/"
                            +f.albumJaketImage+"' alt='Time for the moon night'></div><div class='produ-cost'><h5>"+ f.albumName +"</h5><span><i class='fa fa-microphone'> 아티스트</i> <p>" + f.artist + 
                            "</p></span><span><i class='fa  fa-calendar'> 발매일</i><p>" + f.release + "</p></span><span><i class='fa fa-money'> 가격</i><p>" + f.price + 
                            "</p></span><span class='shopbtn'><button class='btn btn-default btn-xs'><i class='fa fa-shopping-cart'></i> "+ buttontext +"</button></span></div></div></div>";
                            $(".contents").append(musicinfo);
                        }
                    });
                    $('.btn-xs').click(function(){
                        $(this).val("추가하기");
                        var parents = $(this).parents('.product-grid').text();
                        var name = parents.substring(0,parents.indexOf(" 아티스트 "));
                        var artist = parents.substring(parents.indexOf(" 아티스트 ")+6,parents.indexOf(" 발매일"));
                        var date = parents.substring(parents.indexOf(" 발매일")+4,parents.indexOf(" 가격"));
                        var price = parents.substring(parents.indexOf(" 가격")+3,parents.indexOf("원"));
                        var img = $(this).parents('.product-grid > .product-items').children('.project-eff').children('.img-responsive').attr('src');
                        var addmusic = '<tr><td class="albuminfo"><img src="'+img+'"><div class="info"><h4>'+name+'</h4>'+
                                        '<span><i class="fa fa-microphone"> 아티스트</i><p>'+artist+')</p></span><span><i class="fa  fa-calendar"> 발매일</i><p>'+date+'</p>'+
                                        '</span></div></td><td class="albumprice">￦ '+price+'</td><td class="albumqty"><input type="number" class="form-control" value="1"></td>' +
                                        '<td class="pricesum">￦ '+price+'</td><td><button class="btn btn-default"><i class="fa fa-trash-o"></i> 삭제</button></td></tr>';
                        $('.table-bordered > tbody').append(addmusic);
                        });
                }
                else{
                    count = 0;
                }
            }
        });
    });
    $('.trot').click(function(){
        buttonreset();
        $('.trot').css('background','#C90000');
        $('.contents').empty();
        $.ajax({
            url:"music_data.json",type:"get",datatype:"json",contentType:"application/x-www-form-urlencoded; charset=UTF-8",error:function(){
                alert("Fail");
                console.log("데이터 불러오기 실패");
            },
            success:function(data){
                count++;
                if(count < 2){
                    $.each(data.data,function(i,f){
                        if(f.category == "트로트"){
                            var buttontext = "";
                            if(f.albumName == "Lovelyz 4th Mini Album"){
                                buttontext = "추가하기 (1개)";
                            }
                            else{
                                buttontext = " 쇼핑카트담기";
                            }
                            var musicinfo = "<div class='col-md-2 col-sm-2 col-xs-2 product-grid'><div class='product-items'><div class='project-eff'><img class='img-responsive' src='images/"
                            +f.albumJaketImage+"' alt='Time for the moon night'></div><div class='produ-cost'><h5>"+ f.albumName +"</h5><span><i class='fa fa-microphone'> 아티스트</i> <p>" + f.artist + 
                            "</p></span><span><i class='fa  fa-calendar'> 발매일</i><p>" + f.release + "</p></span><span><i class='fa fa-money'> 가격</i><p>" + f.price + 
                            "</p></span><span class='shopbtn'><button class='btn btn-default btn-xs'><i class='fa fa-shopping-cart'></i> "+ buttontext +"</button></span></div></div></div>";
                            $(".contents").append(musicinfo);
                        }
                    });
                    $('.btn-xs').click(function(){
                        $(this).val("추가하기");
                        var parents = $(this).parents('.product-grid').text();
                        var name = parents.substring(0,parents.indexOf(" 아티스트 "));
                        var artist = parents.substring(parents.indexOf(" 아티스트 ")+6,parents.indexOf(" 발매일"));
                        var date = parents.substring(parents.indexOf(" 발매일")+4,parents.indexOf(" 가격"));
                        var price = parents.substring(parents.indexOf(" 가격")+3,parents.indexOf("원"));
                        var img = $(this).parents('.product-grid > .product-items').children('.project-eff').children('.img-responsive').attr('src');
                        var addmusic = '<tr><td class="albuminfo"><img src="'+img+'"><div class="info"><h4>'+name+'</h4>'+
                                        '<span><i class="fa fa-microphone"> 아티스트</i><p>'+artist+')</p></span><span><i class="fa  fa-calendar"> 발매일</i><p>'+date+'</p>'+
                                        '</span></div></td><td class="albumprice">￦ '+price+'</td><td class="albumqty"><input type="number" class="form-control" value="1"></td>' +
                                        '<td class="pricesum">￦ '+price+'</td><td><button class="btn btn-default"><i class="fa fa-trash-o"></i> 삭제</button></td></tr>';
                        $('.table-bordered > tbody').append(addmusic);
                    });
                }
                else{
                    count = 0;
                }
            }
        });
    });
    $('.zazz').click(function(){
        buttonreset();
        $('.zazz').css('background','#C90000');
        $('.contents').empty();
        $.ajax({
            url:"music_data.json",type:"get",datatype:"json",contentType:"application/x-www-form-urlencoded; charset=UTF-8",error:function(){
                alert("Fail");
                console.log("데이터 불러오기 실패");
            },
            success:function(data){
                count++;
                if(count < 2){
                    $.each(data.data,function(i,f){
                        if(f.category == "재즈"){
                            count++;
                            var buttontext = "";
                            if(f.albumName == "Lovelyz 4th Mini Album"){
                                buttontext = "추가하기 (1개)";
                            }
                            else{
                                buttontext = " 쇼핑카트담기";
                            }
                            var musicinfo = "<div class='col-md-2 col-sm-2 col-xs-2 product-grid'><div class='product-items'><div class='project-eff'><img class='img-responsive' src='images/"
                            +f.albumJaketImage+"' alt='Time for the moon night'></div><div class='produ-cost'><h5>"+ f.albumName +"</h5><span><i class='fa fa-microphone'> 아티스트</i> <p>" + f.artist + 
                            "</p></span><span><i class='fa  fa-calendar'> 발매일</i><p>" + f.release + "</p></span><span><i class='fa fa-money'> 가격</i><p>" + f.price + 
                            "</p></span><span class='shopbtn'><button class='btn btn-default btn-xs'><i class='fa fa-shopping-cart'></i> "+ buttontext +"</button></span></div></div></div>";
                            $(".contents").append(musicinfo);
                        }
                    });
                    $('.btn-xs').click(function(){
                        $(this).val("추가하기");
                        var parents = $(this).parents('.product-grid').text();
                        var name = parents.substring(0,parents.indexOf(" 아티스트 "));
                        var artist = parents.substring(parents.indexOf(" 아티스트 ")+6,parents.indexOf(" 발매일"));
                        var date = parents.substring(parents.indexOf(" 발매일")+4,parents.indexOf(" 가격"));
                        var price = parents.substring(parents.indexOf(" 가격")+3,parents.indexOf("원"));
                        var img = $(this).parents('.product-grid > .product-items').children('.project-eff').children('.img-responsive').attr('src');
                        var addmusic = '<tr><td class="albuminfo"><img src="'+img+'"><div class="info"><h4>'+name+'</h4>'+
                                        '<span><i class="fa fa-microphone"> 아티스트</i><p>'+artist+')</p></span><span><i class="fa  fa-calendar"> 발매일</i><p>'+date+'</p>'+
                                        '</span></div></td><td class="albumprice">￦ '+price+'</td><td class="albumqty"><input type="number" class="form-control" value="1"></td>' +
                                        '<td class="pricesum">￦ '+price+'</td><td><button class="btn btn-default"><i class="fa fa-trash-o"></i> 삭제</button></td></tr>';
                        $('.table-bordered > tbody').append(addmusic);
                    });
                }
                else{
                    count = 0;
                }
            }
        });
    });
    $('.rock').click(function(){
        buttonreset();
        $('.rock').css('background','#C90000');
        $('.contents').empty();
        $.ajax({
            url:"music_data.json",type:"get",datatype:"json",contentType:"application/x-www-form-urlencoded; charset=UTF-8",error:function(){
                alert("Fail");
                console.log("데이터 불러오기 실패");
            },
            success:function(data){
                count++;
                if(count < 2){
                    $.each(data.data,function(i,f){
                        if(f.category == "락메탈"){
                            count++;
                            var buttontext = "";
                            if(f.albumName == "Lovelyz 4th Mini Album"){
                                buttontext = "추가하기 (1개)";
                            }
                            else{
                                buttontext = " 쇼핑카트담기";
                            }
                            var musicinfo = "<div class='col-md-2 col-sm-2 col-xs-2 product-grid'><div class='product-items'><div class='project-eff'><img class='img-responsive' src='images/"
                            +f.albumJaketImage+"' alt='Time for the moon night'></div><div class='produ-cost'><h5>"+ f.albumName +"</h5><span><i class='fa fa-microphone'> 아티스트</i> <p>" + f.artist + 
                            "</p></span><span><i class='fa  fa-calendar'> 발매일</i><p>" + f.release + "</p></span><span><i class='fa fa-money'> 가격</i><p>" + f.price + 
                            "</p></span><span class='shopbtn'><button class='btn btn-default btn-xs'><i class='fa fa-shopping-cart'></i> "+ buttontext +"</button></span></div></div></div>";
                            $(".contents").append(musicinfo);
                        }
                    });
                    $('.btn-xs').click(function(){
                        $(this).val("추가하기");
                        var parents = $(this).parents('.product-grid').text();
                        var name = parents.substring(0,parents.indexOf(" 아티스트 "));
                        var artist = parents.substring(parents.indexOf(" 아티스트 ")+6,parents.indexOf(" 발매일"));
                        var date = parents.substring(parents.indexOf(" 발매일")+4,parents.indexOf(" 가격"));
                        var price = parents.substring(parents.indexOf(" 가격")+3,parents.indexOf("원"));
                        var img = $(this).parents('.product-grid > .product-items').children('.project-eff').children('.img-responsive').attr('src');
                        var addmusic = '<tr><td class="albuminfo"><img src="'+img+'"><div class="info"><h4>'+name+'</h4>'+
                                        '<span><i class="fa fa-microphone"> 아티스트</i><p>'+artist+')</p></span><span><i class="fa  fa-calendar"> 발매일</i><p>'+date+'</p>'+
                                        '</span></div></td><td class="albumprice">￦ '+price+'</td><td class="albumqty"><input type="number" class="form-control" value="1"></td>' +
                                        '<td class="pricesum">￦ '+price+'</td><td><button class="btn btn-default"><i class="fa fa-trash-o"></i> 삭제</button></td></tr>';
                        $('.table-bordered > tbody').append(addmusic);
                    });
                }
                else{
                    count = 0;
                }
            }
        });
    });
    $('.hiphop').click(function(){
        buttonreset();
        $('.hiphop').css('background','#C90000');
        $('.contents').empty();
        $.ajax({
            url:"music_data.json",type:"get",datatype:"json",contentType:"application/x-www-form-urlencoded; charset=UTF-8",error:function(){
                alert("Fail");
                console.log("데이터 불러오기 실패");
            },
            success:function(data){
                count++;
                if(count < 2){
                    $.each(data.data,function(i,f){
                        if(f.category == "랩힙합"){
                            var buttontext = "";
                            if(f.albumName == "Lovelyz 4th Mini Album"){
                                buttontext = "추가하기 (1개)";
                            }
                            else{
                                buttontext = " 쇼핑카트담기";
                            }
                            var musicinfo = "<div class='col-md-2 col-sm-2 col-xs-2 product-grid'><div class='product-items'><div class='project-eff'><img class='img-responsive' src='images/"
                            +f.albumJaketImage+"' alt='Time for the moon night'></div><div class='produ-cost'><h5>"+ f.albumName +"</h5><span><i class='fa fa-microphone'> 아티스트</i> <p>" + f.artist + 
                            "</p></span><span><i class='fa  fa-calendar'> 발매일</i><p>" + f.release + "</p></span><span><i class='fa fa-money'> 가격</i><p>" + f.price + 
                            "</p></span><span class='shopbtn'><button class='btn btn-default btn-xs'><i class='fa fa-shopping-cart'></i> "+ buttontext +"</button></span></div></div></div>";
                            $(".contents").append(musicinfo);
                        }
                    });
                    $('.btn-xs').click(function(){
                        $(this).val("추가하기");
                        var parents = $(this).parents('.product-grid').text();
                        var name = parents.substring(0,parents.indexOf(" 아티스트 "));
                        var artist = parents.substring(parents.indexOf(" 아티스트 ")+6,parents.indexOf(" 발매일"));
                        var date = parents.substring(parents.indexOf(" 발매일")+4,parents.indexOf(" 가격"));
                        var price = parents.substring(parents.indexOf(" 가격")+3,parents.indexOf("원"));
                        var img = $(this).parents('.product-grid > .product-items').children('.project-eff').children('.img-responsive').attr('src');
                        var addmusic = '<tr><td class="albuminfo"><img src="'+img+'"><div class="info"><h4>'+name+'</h4>'+
                                        '<span><i class="fa fa-microphone"> 아티스트</i><p>'+artist+')</p></span><span><i class="fa  fa-calendar"> 발매일</i><p>'+date+'</p>'+
                                        '</span></div></td><td class="albumprice">￦ '+price+'</td><td class="albumqty"><input type="number" class="form-control" value="1"></td>' +
                                        '<td class="pricesum">￦ '+price+'</td><td><button class="btn btn-default"><i class="fa fa-trash-o"></i> 삭제</button></td></tr>';
                        $('.table-bordered > tbody').append(addmusic);
                    });
                }
                else{
                    count = 0;
                }
            }
        });
    });
    $('.folk').click(function(){
        buttonreset();
        $('.folk').css('background','#C90000');
        $('.contents').empty();
        $.ajax({
            url:"music_data.json",type:"get",datatype:"json",contentType:"application/x-www-form-urlencoded; charset=UTF-8",error:function(){
                alert("Fail");
                console.log("데이터 불러오기 실패");
            },
            success:function(data){
                count++;
                if(count < 2){
                    $.each(data.data,function(i,f){ 
                        if(f.category == "포크어코스틱"){
                            var buttontext = "";
                            if(f.albumName == "Lovelyz 4th Mini Album"){
                                buttontext = "추가하기 (1개)";
                            }
                            else{
                                buttontext = " 쇼핑카트담기";
                            }
                            var musicinfo = "<div class='col-md-2 col-sm-2 col-xs-2 product-grid'><div class='product-items'><div class='project-eff'><img class='img-responsive' src='images/"
                            +f.albumJaketImage+"' alt='Time for the moon night'></div><div class='produ-cost'><h5>"+ f.albumName +"</h5><span><i class='fa fa-microphone'> 아티스트</i> <p>" + f.artist + 
                            "</p></span><span><i class='fa  fa-calendar'> 발매일</i><p>" + f.release + "</p></span><span><i class='fa fa-money'> 가격</i><p>" + f.price + 
                            "</p></span><span class='shopbtn'><button class='btn btn-default btn-xs'><i class='fa fa-shopping-cart'></i> "+ buttontext +"</button></span></div></div></div>";
                            $(".contents").append(musicinfo);
                        }
                    });
                    $('.btn-xs').click(function(){
                        $(this).val("추가하기");
                        var parents = $(this).parents('.product-grid').text();
                        var name = parents.substring(0,parents.indexOf(" 아티스트 "));
                        var artist = parents.substring(parents.indexOf(" 아티스트 ")+6,parents.indexOf(" 발매일"));
                        var date = parents.substring(parents.indexOf(" 발매일")+4,parents.indexOf(" 가격"));
                        var price = parents.substring(parents.indexOf(" 가격")+3,parents.indexOf("원"));
                        var img = $(this).parents('.product-grid > .product-items').children('.project-eff').children('.img-responsive').attr('src');
                        var addmusic = '<tr><td class="albuminfo"><img src="'+img+'"><div class="info"><h4>'+name+'</h4>'+
                                        '<span><i class="fa fa-microphone"> 아티스트</i><p>'+artist+')</p></span><span><i class="fa  fa-calendar"> 발매일</i><p>'+date+'</p>'+
                                        '</span></div></td><td class="albumprice">￦ '+price+'</td><td class="albumqty"><input type="number" class="form-control" value="1"></td>' +
                                        '<td class="pricesum">￦ '+price+'</td><td><button class="btn btn-default"><i class="fa fa-trash-o"></i> 삭제</button></td></tr>';
                        $('.table-bordered > tbody').append(addmusic);
                    });
                }
                else{
                    count = 0;
                }
            }
        });
    });
    $('.RNB').click(function(){
        buttonreset();
        $('.RNB').css('background','#C90000');
        $('.contents').empty();
        $.ajax({
            url:"music_data.json",type:"get",datatype:"json",contentType:"application/x-www-form-urlencoded; charset=UTF-8",error:function(){
                alert("Fail");
                console.log("데이터 불러오기 실패");
            },
            success:function(data){
                count++;
                if(count < 2){
                    $.each(data.data,function(i,f){//1번만 호출하게...
                        if(f.category == "R&B"){
                            var buttontext = "";
                            if(f.albumName == "Lovelyz 4th Mini Album"){
                                buttontext = "추가하기 (1개)";
                            }
                            else{
                                buttontext = " 쇼핑카트담기";
                            }
                            var musicinfo = "<div class='col-md-2 col-sm-2 col-xs-2 product-grid'><div class='product-items'><div class='project-eff'><img class='img-responsive' src='images/"
                            +f.albumJaketImage+"' alt='Time for the moon night'></div><div class='produ-cost'><h5>"+ f.albumName +"</h5><span><i class='fa fa-microphone'> 아티스트</i> <p>" + f.artist + 
                            "</p></span><span><i class='fa  fa-calendar'> 발매일</i><p>" + f.release + "</p></span><span><i class='fa fa-money'> 가격</i><p>" + f.price + 
                            "</p></span><span class='shopbtn'><button class='btn btn-default btn-xs'><i class='fa fa-shopping-cart'></i> "+ buttontext +"</button></span></div></div></div>";
                            $(".contents").append(musicinfo);
                        }
                    });
                    $('.btn-xs').click(function(){
                        $(this).val("추가하기");
                        var parents = $(this).parents('.product-grid').text();
                        var name = parents.substring(0,parents.indexOf(" 아티스트 "));
                        var artist = parents.substring(parents.indexOf(" 아티스트 ")+6,parents.indexOf(" 발매일"));
                        var date = parents.substring(parents.indexOf(" 발매일")+4,parents.indexOf(" 가격"));
                        var price = parents.substring(parents.indexOf(" 가격")+3,parents.indexOf("원"));
                        var img = $(this).parents('.product-grid > .product-items').children('.project-eff').children('.img-responsive').attr('src');
                        var addmusic = '<tr><td class="albuminfo"><img src="'+img+'"><div class="info"><h4>'+name+'</h4>'+
                                        '<span><i class="fa fa-microphone"> 아티스트</i><p>'+artist+')</p></span><span><i class="fa  fa-calendar"> 발매일</i><p>'+date+'</p>'+
                                        '</span></div></td><td class="albumprice">￦ '+price+'</td><td class="albumqty"><input type="number" class="form-control" value="1"></td>' +
                                        '<td class="pricesum">￦ '+price+'</td><td><button class="btn btn-default"><i class="fa fa-trash-o"></i> 삭제</button></td></tr>';
                        $('.table-bordered > tbody').append(addmusic);
                    });
                }
                else{
                    count = 0;
                }
            }
        });
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
                        if(f.albumName == "Lovelyz 4th Mini Album"){
                            buttontext = " 추가하기 (1개)";
                        }
                        else{
                            buttontext = " 쇼핑카트담기";
                        }
                        var data_all = '<div class="col-md-2 col-sm-2 col-xs-2 product-grid">' + '<div class = "product-items">' + '<div class = "project-eff">' + '<img class = "img-responsive" src = "images/'
                         + f.albumJaketImage + '">' + '</div>' + '<div class = "produ-cost">' + '<h5>' + f.albumName + '</h5>' + '<span><i class = "fa fa-microphone">아티스트</i>' + '<p>' + f.artist + '</p>' 
                         + '</span>' + '<span><i class = "fa fa-calendar">발매일</i>' + '<p>' + f.release + '</p>' + '</span>' + '<span><i class = "fa fa-money">가격</i>' + '<p>' + f.price + '</p>' + '</span>' 
                         + '<span class = "shopbtn"><button class = "btn btn-default btn-xs"><i class = "fa fa-shopping-cart"><i> '+ buttontext +'</button></span>'+ '</div>' + '</div>' + '</div>';
                        $(data_all).appendTo('.contents');
                        c = c + 1;
                        
                    }
                });
                $('.btn-xs').click(function(){
                    $(this).val("추가하기");
                    var parents = $(this).parents('.product-grid').text();
                    var name = parents.substring(0,parents.indexOf("아티스트"));
                    var artist = parents.substring(parents.indexOf("아티스트")+5,parents.indexOf("발매일"));
                    var date = parents.substring(parents.indexOf("발매일")+3,parents.indexOf("가격"));
                    var price = parents.substring(parents.indexOf("가격")+2,parents.indexOf("원"));
                    var img = $(this).parents('.product-grid > .product-items').children('.project-eff').children('.img-responsive').attr('src');
                    var addmusic = '<tr><td class="albuminfo"><img src="'+img+'"><div class="info"><h4>'+name+'</h4>'+
                                    '<span><i class="fa fa-microphone"> 아티스트</i><p>'+artist+')</p></span><span><i class="fa  fa-calendar"> 발매일</i><p>'+date+'</p>'+
                                    '</span></div></td><td class="albumprice">￦ '+price+'</td><td class="albumqty"><input type="number" class="form-control" value="1"></td>' +
                                    '<td class="pricesum">￦ '+price+'</td><td><button class="btn btn-default"><i class="fa fa-trash-o"></i> 삭제</button></td></tr>';
                    $('.table-bordered > tbody').append(addmusic);
                    //console.log(parents);
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
    /*function purchase(){
        $(this).val("추가하기");
        var parents = $(this).parents('.product-grid').text();
        var name = parents.substring(0,parents.indexOf(" 아티스트 "));
        var artist = parents.substring(parents.indexOf(" 아티스트 ")+6,parents.indexOf(" 발매일"));
        var date = parents.substring(parents.indexOf(" 발매일")+4,parents.indexOf(" 가격"));
        var price = parents.substring(parents.indexOf(" 가격")+3,parents.indexOf("원"));
        console.log("노래 이름 : "+name);
        console.log("아티스트 : "+artist);
        console.log("발매일 : "+date);
        console.log("가격 : " + price);
    }*/
    /*$(".form-control").click(function(){
        console.log("OK");
        /*let count = 1;
        count++;
        $(".total-price > h3").val("총 합계금액 : " + count*20000);
    })*/
});
