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
    $view = "update professionalreview set view = view + 1 where no = $no";//조회수 증가
    mysqli_query($connect,$view);
    $sql = "select * from professionalreview where no = $no";
    $result = mysqli_query($connect,$sql);
    $row1 = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src = "js/jquery-1.10.2.js"></script>
    <script src = "js/script.js"></script>
    <script src = "js/professional.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row1['specialistNAME'].' 시공 후기'; ?></title>
</head>
<body>
    <?php include "header.php"; include "side.php"; ?>
    <div class = "bg width100 professionalview">
        <h1 class = "width100">시공 후기</h1>
        <div class = "reviewdiv flex column">
            <div class = "flex width100" style = "justify-content:space-between">
                <div class = "flex column">
                    <span>전문가 : <span class = "gopro <?php switch($row1['specialistNAME']){
                        case "전문가1":echo 'p1'; break;case "전문가2":echo 'p2'; break;case "전문가3":echo 'p3'; break;case "전문가4":echo 'p4'; break;} ?>">
                        <?php echo $row1['specialistNAME'].'('.$row1['specialistID'].')'; ?></span></span>
                    <span>작성자 : <?php $userid = $row1['ID']; echo $row1['name'].'('.$userid.')'; ?></span>
                    <span class = "cost">비용 : <?php echo number_format($row1['cost']).'원'; ?></span>
                    <span>조회수 : <?php echo number_format($row1['view']); ?></span>
                </div>
                <div class = "flex professionalbutton">
                    <button class = "list">목록</button>
                    <button class = "write" style = "margin-left:30px;">글쓰기</button>
                </div>
            </div>   
            <img src = "professionalreview/<?php echo $row1['reviewimg']; ?>"></img>
            <p>내용 : <?php echo $row1['contents']; ?></p>
            <div class = "score">전문가 점수 <span><?php 
            $score = $row1['professionalscore'];
            for($n = 0; $n < 5; $n++){
                if($n < $score){
                    echo "<span class = 'positive'>★</span>";
                }
                else{
                    echo "<span class = 'negative'>☆</span>";
                }
            } ?></span> <?php echo $row1['professionalscore'].'점'; ?></div>
            <div class = "score">사용자 점수 <span><?php
            $score = $row1['score'];
            for($n = 0; $n < 5; $n++){
                if($n < $score){
                    echo "<span class = 'positive'>★</span>";
                }
                else{
                    echo "<span class = 'negative'>☆</span>";
                }
            } ?></span> <?php echo $row1['score'].'점'; ?>
            </div>
            <?php include "info.php"; $ID = $_SESSION['ID'];
                if($ID == $userid){//자신의 게시글에는 평점 줄 수 없음.
                    echo "자신의 게시물에는 평점을 줄 수 없습니다.";
                }
                else{//평점 주기
                    $sql = "select * from userscore where ID = '$ID' and PRO_VIEW_ID = '$no'";//전문가 시공 게시물을 검색
                    $result = mysqli_query($connect,$sql);
                    $rows = mysqli_fetch_array($result);
                    if($rows >= 1){//이미 평점 줌
                        $n = $rows['score'];
                        ?><span class = "score"><?php echo $name." 님의 점수는 : ".$n."점"; ?><span class = "score"><?php
                        for($n = 0; $n < 5; $n++){
                            if($n < $rows['score']){
                                echo '<span class = "positive">★</span>';
                            }
                            else{
                                echo '<span class = "negative">☆</span>';
                            }
                        }
                        ?></span></span><?php
                    }else{ ?>
                    <form action = "rating.php" method = "POST">
                        <span class = "score">사용자 점수 : <?php for($n = 1; $n <= 5; $n++){echo '<span class = "scorebutton" value = "'.$n.'">☆</span>';}?>
                        <input type = "hidden" name = "proviewno" value = <?php echo $no; ?>>
                        <input type = "hidden" class = "rate" name = "score"><input type = "submit" class = "rating" value = "평점 주기"/></span>
                    </form>
            <?php }} ?>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>