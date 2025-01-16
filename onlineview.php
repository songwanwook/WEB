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
    include "../db.php";
    $no = $_GET['no'];
    $sql = "select * from onlinehousing where no = $no";
    $result = mysqli_query($connect,$sql);
    $row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['title'];//게시글 제목으로 설정 ?></title>
    <script src = "js/jquery-1.10.2.js"></script>
    <script src = "js/online.js"></script>
    <script src = "js/script.js"></script>
</head>
<body>
    <?php
        include "side.php"; include "header.php";
        $view = "update onlinehousing set view = view + 1 where no = $no";//조회수 증가
        mysqli_query($connect,$view);
        $no = $_GET['no'];
        $sql = "select * from onlinehousing where no = $no";
        $result = mysqli_query($connect,$sql);
        $row = mysqli_fetch_array($result);
        $userid = $row['ID'];
    ?>
    <div class = "bg width100">
        <div class = "view width100 flex column">
            <h2 class = "width100"><?php echo $row['title']; ?></h2>
            <div class = "flex column viewheader">
                <span><?php echo $row['name'].'('.$row['ID'].')'; ?></span>
                <div class = "flex">
                    <span><?php echo $row['Date']; ?></span>
                    <span style = "margin-left:10px;">조회수 <?php echo $row['view']; ?></span>
                </div>
            </div>
            <div class = "beforeonline">
                <h1>BEFORE</h1>
                <img src = "review/<?php echo $row['beforeimg']; ?>"></img>
            </div>
            <div class = "afteronline">
                <h1>AFTER</h1>
                <img src = "review/<?php echo $row['afterimg']; ?>"></img>
            </div>
            <div class = "contents"><?php echo $row['contents']; ?></div>
            <div class = "flex"><span class = "score">평점 <?php echo $row['score']; ?></span><span class = "score"><?php 
                for($n = 0; $n < 5; $n++){
                    if($n < $row['score']){
                        echo '<span class = "positive">★</span>';
                    }
                    else{
                        echo '<span class = "negative">☆</span>';
                    }
                }  ?></span>
            </div>
            <div class = "flex">
                <?php
                include "info.php";
                $ID = $_SESSION['ID'];
                if($ID == $userid){//자신의 게시글에는 평점 줄 수 없음.
                    echo "자신의 게시물에는 평점을 줄 수 없습니다.";
                }
                else{//평점 주기
                    $sql = "select * from userscore where ID = '$ID' and view_ID = '$no'";//온라인 뷰 게시물을 검색
                    $result = mysqli_query($connect,$sql);
                    $rows = mysqli_fetch_array($result);
                    if($rows >= 1){//이미 평점 줌
                        $n = $rows['score'];
                        ?><span class = "score"><?php echo $name." 님의 점수는 : ".$n."점"; ?></span><span class = "score"><?php
                        for($n = 0; $n < 5; $n++){
                            if($n < $rows['score']){
                                echo '<span class = "positive">★</span>';
                            }
                            else{
                                echo '<span class = "negative">☆</span>';
                            }
                        }
                        ?></span><?php
                    }
                    else{
                        ?>
                        <form action = "rating.php" method = "POST">
                        <span class = "score">
                        <?php
                        for($n = 1; $n <= 5; $n++){
                            echo '<span class = "scorebutton" value = "'.$n.'">☆</span>';
                        }
                        ?>
                        </span><input type = "hidden" name = "onlineview" value = <?php echo $no; ?>>
                        <input type = "hidden" class = "rate" name = "score"><input type = "submit" class = "rating" value = "평점 주기"/></form><?php
                    }
                }
                ?>
            </div>
            <div class = "flex" style = "width:50%; margin:10px">
                <button class = "list">목록</button>
                <button class = "write" style = "margin-left:30px;">글쓰기</button>
            </div>
        </div>
    </div>
    <?php
        include "footer.php";
    ?>
</body>
</html>