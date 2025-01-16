<?php
    session_start();
    if(!isset($_SESSION['ID'])){
        ?>
        <script>
            alert("로그인 후 이용하실 수 있습니다.");
            location.href = "index.php";
        </script>
        <?php
    }
    else{
        $ID = $_SESSION['ID'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>마이페이지</title>
    <script src = "js/jquery-1.10.2.js"></script>
    <script src = "js/script.js"></script>
    <script src = "js/mypage.js"></script>
</head>
<body>
    <?php
        include "../db.php";
        include "side.php";
        include "header.php";
        include "info.php";
    ?>
    <div class = "bg width100">
        <h1 class = "textcenter" style="padding-top:30px">마이페이지</h1>
        <div class = "mypageinfo">
            <table class = "mypagetable">
                <tr>
                    <td>이름</td>
                    <td><?php echo $name; ?></td>
                </tr>
                <tr>
                    <td>아이디</td>
                    <td><?php echo $ID; ?><button class = "altpw">비밀번호변경</button></td>
                </tr>
                <tr>
                    <td>프로필사진</td>
                    <td><?php $sql = "select profile from myhouse where ID = '$ID'"; $result = mysqli_query($connect,$sql);
                    $row = mysqli_fetch_array($result); echo '<img src = "src/'.$row['profile'].'"/>'; ?></td>
                </tr>
            </table>
            <h2>작성 리뷰 보기</h2>
            <?php
                $sql = "select * from onlinehousing where ID = '$ID'"; $result1 = mysqli_query($connect,$sql);
                while($row = mysqli_fetch_array($result1)){
                    echo '<hr><a href = "onlineview.php?no='.$row['no'].'">'.$row['title']."</a><br>";
                }
                $sql = "select * from professionalreview where ID = '$ID'"; $result2 = mysqli_query($connect,$sql);
                while($row = mysqli_fetch_array($result2)){
                    echo '<hr><a href = "professionalview.php?no='.$row['no'].'">'.$row['contents']."</a><br>";
                }
                if(mysqli_num_rows($result1)+mysqli_num_rows($result2)>=1){
                    echo '<hr>';
                }
                else{
                    echo "<p>작성된 게시물이 없습니다.</p>";
                }
            ?>
        </div>
    </div>
    <div class = "boxmodal">
        <form class = "logindiv flex column">
            <h4>비밀번호 수정</h4>
            <span>현재 비밀번호</span>
            <input type = "password" class = "nowPW"></input>
            <span>새 비밀번호</span>
            <input type = "password" class = "newPW"></input>
            <span>비밀번호 확인</span>
            <input type = "password" class = "newPWCH"></input>
            <span class = "flex"><input type = "button" class = "OK" value = "확인"/><input type = "button" class = "cancelpw" value = "취소"/></span>
            <input type = "hidden" class = "myid" value = "<?php echo $ID; ?>"/>
        </form>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>