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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src = "js/jquery-1.10.2.js"></script>
    <script src = "js/script.js"></script>
    <script src = "js/professional.js"></script>
    <script src = "js/exit.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>시공 후기 작성</title>
    <link href = "css/professionalcss.css" rel = "stylesheet">
</head>
<body>
    <?php include "../db.php"; include "side.php"; include "header.php"; $sql = "select * from professional";
    if(isset($_GET['pid'])){ $pid = $_GET['pid']; $sql = $sql." where professionalID = '$pid'";}
    $result = mysqli_query($connect,$sql); 
    ?>
    <div class = "bg width100 professionalwritebg">
        <h1 class = "width100">시공 후기작성</h1>
        <form class = "reviewdiv flex column" onsubmit="allowFormSubmission()" enctype = "multipart/form-data" method = "POST" action = "proreviewwrite.php">
            <span>전문가 : <?php if(isset($_GET['pid'])){ $row = mysqli_fetch_array($result);
            echo $row['professionalNAME'].'('.$row['professionalID'].')<input type = "hidden" class = "proname" name = "proname" value = '.$row['professionalNAME'].'></input>
            <input type = "hidden" class = "professionalID" name = "professionalID" value = '.$row['professionalID'].'></input>';}
            else{ echo '<select name = "professionalID" class = "professionalID"><option value = "none">선택</option>';
                while($row = mysqli_fetch_array($result)){
                echo '<option value = "'.$row['professionalID'].'" pname = "'.$row['professionalNAME'].'">'.$row['professionalNAME'].'('.$row['professionalID'].')</option>';}
                echo '</select><input type = "hidden" class = "proname" name = "proname"></input>';
            } ?></span>
            <span>리뷰 내용</span>
            <textarea name = "contents" class = "professionalcontents" placeholder = "시공 후기를 간단하게 작성하세요." required></textarea>
            <span>비용 : <input type = "number" name = "cost" class = "costinput" required/>원</span>
            <span>리뷰 사진<input type = "file" class = "afterimage" name = "afterimage" accept=".jpg, .jpeg, .png" required></input></span>
            <img class = "professionalimg" alt = "리뷰 이미지를 등록하세요."></img>
            <span class = "score">점수 : <?php for($n = 1; $n <= 5; $n++){echo '<span class = "scorebutton" value = "'.$n.'">☆</span>';}?></span>
            <span class = "flex"><button class = "submit" name = "proscore">작성</button><button type = "button" class = "cancelwrite">취소</button></span>
        </form>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
