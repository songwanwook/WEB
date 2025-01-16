<?php
    session_start();
?>
<header class = "flex width100">
    <a href = "index.php"><img src = "src/logo.jpg" class = "logo"></img></a>
    <ul class = "flex ul">
        <li><a href = "index.php">HOME</a></li>
        <li><a <?php if(!isset($_SESSION["ID"])){ echo 'class = "loginhref"'; }else{ echo "href = 'online.php'"; } ?>>온라인 집들이</a></li>
        <li><a href = "store.php">STORE</a></li>
        <li><a <?php if(!isset($_SESSION["ID"])){ echo 'class = "loginhref"'; }else{ echo "href = 'professional.php'"; } ?>>전문가</a></li>
        <li><a <?php if(!isset($_SESSION["ID"])){ echo 'class = "loginhref"'; }else{ echo "href = 'quotation.php'"; } ?>>시공 견적</a></li>
    </ul>
    <?php if(!isset($_SESSION["ID"])){ ?>
    <div class = "flex column buttondiv">
        <button class = "login">로그인</button>
        <button class = "join">회원가입</button>
    </div>
    <?php }else{ ?>
        
    <div class = "flex column buttondiv">
        <?php include "info.php"; echo $name."(".$_SESSION["ID"].")" ?>
        <button class = "mypage">마이페이지</button>
        <button class = "logout">로그아웃</button>
    </div>
    <?php } ?>
</header>
<button class = "under680btn">≡</button>
<?php include "loginform.php"; include "joinform.php";?>