<!DOCTYPE html>
<html lang="en">
<head>
    <script src = "js/jquery-1.10.2.js"></script>
    <script src = "js/script.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>내집 꾸미기</title>
</head>
<body>
    <?php include "side.php";include "header.php"; ?>
    <div class = "width100 slideshow">
        <span class = "prev">◀</span>
        <img src = "src/apartment-2094700_1920.jpg" class = "slideimg"></img>
        <img src = "src/apartment-lounge-3147892_1920.jpg" class = "slideimg"></img>
        <img src = "src/fireplace-416042_1280.jpg" class = "slideimg"></img>
        <span class = "next">▶</span>
    </div>
    <div class = "Online width100 flex column">
        <h1 class = "width100 textcenter">온라인 집들이 목록</h1>
        <div class = "flex width100 main">
            <div class = "review flex column">
                <a <?php if(!isset($_SESSION["ID"])){ echo "class = loginhref"; }else{ echo "href = 'onlineview.php?no=1'"; } ?>>
                <div class = "reviewimage">
                    <img src = "src/1_before.jpg" class = "before" alt = "before"></img>
                    <img src = "src/1_after.jpg" class = "after" alt = "after"></img>
                </div>
                </a>
                <p>리뷰자 ID : user1</p>
                <p>평점 <span class = "star">★★★★☆</span>4</p>
            </div>
            <div class = "review flex column">
            <a <?php if(!isset($_SESSION["ID"])){ echo "class = loginhref"; }else{ echo "href = 'onlineview.php?no=2'"; } ?>>
                <div class = "reviewimage">
                    <img src = "src/2_before.jpg" class = "before" alt = "before"></img>
                    <img src = "src/2_after.jpg" class = "after" alt = "after"></img>
                </div>
                </a>
                <p>리뷰자 ID : user2</p>
                <p>평점 <span class = "star">★★★☆☆</span>3</p>
            </div>
            <div class = "review flex column">
            <a <?php if(!isset($_SESSION["ID"])){ echo "class = loginhref"; }else{ echo "href = 'onlineview.php?no=3'"; } ?>>
                <div class = "reviewimage">
                    <img src = "src/3_before.jpg" class = "before" alt = "before"></img>
                    <img src = "src/3_after.jpg" class = "after" alt = "after"></img>
                </div>
                </a>
                <p>리뷰자 ID : user3</p>
                <p>평점 <span class = "star">★★★★★</span>5</p>
            </div>
            <div class = "review flex column">
            <a <?php if(!isset($_SESSION["ID"])){ echo "class = loginhref"; }else{ echo "href = 'onlineview.php?no=4'"; } ?>>
                <div class = "reviewimage">
                    <img src = "src/4_before.jpg" class = "before" alt = "before"></img>
                    <img src = "src/4_after.jpg" class = "after" alt = "after"></img>
                </div>
                </a>
                <p>리뷰자 ID : user4</p>
                <p>평점 <span class = "star">★★★☆☆</span>3</p>
            </div>
        </div> 
        <button class = "MORE <?php if(!isset($_SESSION["ID"])){ echo "loginhref"; }else{ echo "onlinehouse"; } ?>">MORE</button>
    </div>
    <div class = "professional width100 flex column">
        <h1 class = "width100 textcenter">전문가 목록</h1>
        <div class = "flex width100 main">
            <div class = "professionaldiv flex column">
                <div class = "professionalimage">
                    <img src = "src/specialist1.jpg" class = "before" alt = "before"></img>
                    <div class = "back flex column textcenter">
                        <p>이름 : 전문가1</p><p>아이디 : specialist1</p><br>
                        <button class = "detail <?php if(!isset($_SESSION["ID"])){ echo "loginhref"; }else{ echo "p1"; } ?>">자세히 보기</button>
                    </div>
                </div>
            </div>
            <div class = "professionaldiv flex column">
                <div class = "professionalimage">
                    <img src = "src/specialist2.jpg" class = "before" alt = "before"></img>
                    <div class = "back flex column textcenter">
                        <p>이름 : 전문가2</p><p>아이디 : specialist2</p><br>
                        <button class = "detail <?php if(!isset($_SESSION["ID"])){ echo "loginhref"; }else{ echo "p2"; } ?>">자세히 보기</button>
                    </div>
                </div>
            </div>
            <div class = "professionaldiv flex column">
                <div class = "professionalimage">
                    <img src = "src/specialist3.jpg" class = "before" alt = "before"></img>
                    <div class = "back flex column textcenter">
                        <p>이름 : 전문가3</p><p>아이디 : specialist3</p><br>
                        <button class = "detail <?php if(!isset($_SESSION["ID"])){ echo "loginhref"; }else{ echo "p3"; } ?>">자세히 보기</button>
                    </div>
                </div>
            </div>
            <div class = "professionaldiv flex column">
                <div class = "professionalimage">
                    <img src = "src/specialist4.jpg" class = "before" alt = "before"></img>
                    <div class = "back flex column textcenter">
                        <p>이름 : 전문가4</p><p>아이디 : specialist4</p><br>
                        <button class = "detail <?php if(!isset($_SESSION["ID"])){ echo "loginhref"; }else{ echo "p4"; } ?>">자세히 보기</button>
                    </div>
                </div>
            </div>
        </div>
        <button class = "MORE <?php if(!isset($_SESSION["ID"])){ echo "loginhref"; }else{ echo "goprofessional"; } ?>">MORE</button>
    </div>
    <div class = "reviewconst width100 flex column">
        <h1 class = "width100 textcenter">시공 후기<h1>
        <div class = "reviewdiv mainpreview flex column">
            <span>전문가 : <span class = "gopro <?php if(!isset($_SESSION["ID"])){ echo "loginhref"; }else{ echo "p2"; } ?>">전문가2(specialist2)</span></span>
            <span>작성자 : 박재현(park)</span>
            <span class = "cost">비용 : 3,200,000원</span>
            <img src = "src/ironmanhouse.jpg" class = "reviewpreviewimg"></img>
            <p>내용 : 원하던 아이언맨 컨셉으로 너무 잘 꾸며주셨습니다!</p>
            <div class = "score">평점 <span class = "star">★★★★★</span> 5</div>
            <button class = "detailreview textcenter <?php if(!isset($_SESSION["ID"])){ echo "loginhref"; }else{ echo "review1"; } ?>">자세히 보기</button>
        </div>
        <div class = "reviewdiv mainpreview flex column">
            <span>전문가 : <span class = "gopro <?php if(!isset($_SESSION["ID"])){ echo "loginhref"; }else{ echo "p4"; } ?>">전문가4(specialist4)</span></span>
            <span>작성자 : 김정수(kim)</span>
            <span class = "cost">비용 : 5,500,000원</span>
            <img src = "src/design-1162241_1920.jpg" class = "reviewpreviewimg"></img>
            <p>내용 : 요구사항대로 부드러운 느낌을 잘 살려주셨습니다.</p>
            <div class = "score">평점 <span class = "star">★★★★☆</span> 4</div>
            <button class = "detailreview textcenter <?php if(!isset($_SESSION["ID"])){ echo "loginhref"; }else{ echo "review2"; } ?>">자세히 보기</button>
        </div>
        <div class = "reviewdiv"><button class = "MORE <?php if(!isset($_SESSION["ID"])){ echo "loginhref"; }else{ echo "goprofessional"; } ?>">MORE</button></div>
    </div>
    <?php include "footer.php";?>
</body>
</html>