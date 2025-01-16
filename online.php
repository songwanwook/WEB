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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>온라인 집들이</title>
    <script src = "js/jquery-1.10.2.js"></script>
    <script src = "js/script.js"></script>
    <script src = "js/online.js"></script>
</head>
<body>
    <?php
        include "../db.php";
        include "side.php"; include "header.php";
        $sql = "";$countsql = "";$option="";
        if(isset($_GET['subject'])){//제목
            $option = $_GET['subject'];
            $countsql = "select count(*) from onlinehousing where title like '%$option%'";
            $sql = "select * from onlinehousing where title like '%$option%'";
        }
        else if(isset($_GET['contents'])){//내용
            $option = $_GET['contents'];
            $countsql = "select count(*) from onlinehousing where contents like '%$option%'";
            $sql = "select * from onlinehousing where contents like '%$option%'";
        }
        else if(isset($_GET['nameorID'])){//작성자
            $option = $_GET['nameorID'];
            $countsql = "select count(*) from onlinehousing where ID = '$option' or name = '$option'";
            $sql = "select * from onlinehousing where ID = '$option' or name = '$option'";
        }
        else{
            $sql = "select * from onlinehousing order by no desc";
            $countsql = "select count(*) from onlinehousing";
        }
        $result = mysqli_query($connect,$countsql);
        $countrow = mysqli_fetch_array($result);
        if($countrow['count(*)'] == 0){
            ?><script>alert("검색 결과가 없습니다.");location.href = "online.php";</script><?php
        }
        //페이징 처리
        if(!isset($_GET['page'])){
            $page = 1;
        }
        else{
            $page = $_GET['page'];
        }
        $last = 0;
        $previous; $next;
        if($countrow['count(*)']%5==0){
            $last = floor($countrow['count(*)']/5);
        }
        else{
            $last = floor($countrow['count(*)']/5) + 1;
        }
        if($page>1){
            $previous = $page-1;
        }
        else{
            $previous = 1;
        }
        if($page < $last){
            $next = (int)$page + (int)1;
        }
        else{
            $next = $page;
        }
    ?>
    <div class = "bg width100">
        <div class = "Online width100 flex column">
            <h1 class = "width100 textcenter">온라인 집들이 목록</h1>
            <div class = "flex width100 main">
                <div class = "review flex column">
                    <div class = "reviewimage">
                        <img src = "src/1_before.jpg" class = "before" alt = "before"></img>
                        <img src = "src/1_after.jpg" class = "after" alt = "after"></img>
                    </div>
                    <p>리뷰자 ID : user1</p>
                    <p>평점 <span class = "star">★★★★☆</span>4</p>
                </div>
                <div class = "review flex column">
                    <div class = "reviewimage">
                        <img src = "src/2_before.jpg" class = "before" alt = "before"></img>
                        <img src = "src/2_after.jpg" class = "after" alt = "after"></img>
                    </div>
                    <p>리뷰자 ID : user2</p>
                    <p>평점 <span class = "star">★★★☆☆</span>3</p>
                </div>
                <div class = "review flex column">
                    <div class = "reviewimage">
                        <img src = "src/3_before.jpg" class = "before" alt = "before"></img>
                        <img src = "src/3_after.jpg" class = "after" alt = "after"></img>
                    </div>
                    <p>리뷰자 ID : user3</p>
                    <p>평점 <span class = "star">★★★★★</span>5</p>
                </div>
                <div class = "review flex column">
                    <div class = "reviewimage">
                        <img src = "src/4_before.jpg" class = "before" alt = "before"></img>
                        <img src = "src/4_after.jpg" class = "after" alt = "after"></img>
                    </div>
                    <p>리뷰자 ID : user4</p>
                    <p>평점 <span class = "star">★★★☆☆</span>3</p>
                </div>
            </div>
            <h1>더 많은 집들이 후기는 밑에 게시글에 있습니다.</h1>
        </div>
        <div class = "flex subtitle"><span>총 <?php echo $countrow['count(*)']; ?>개의 게시물이 있습니다.</span><button class = "write">글쓰기</button></div>
        <table class = "onlinetable" id = "showall">
            <thead>
                <tr>
                    <th class = "onlinenum">번호</th>
                    <th class = "onlinetitle">제목</th>
                    <th class = "onlinename">글쓴이</th>
                    <th class = "onlinedate">작성일</th>
                    <th class = "onlineview">조회수</th>
                    <th class = "onlinescore">평점</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $start = ($page-1)*5;
                    $sql = $sql." Limit $start, 5";
                    $result = mysqli_query($connect,$sql);
                    while($row = mysqli_fetch_array($result)){
                        echo '<tr>
                            <th class = "onlinenum">'.$row['no'].'</th>
                            <th class = "onlinetitle"><a href = "onlineview.php?no='.$row['no'].'">'.$row['title'].'</a></th>
                            <th class = "onlinename">'.$row['name'].'<span class = "userid">('.$row['ID'].')</span></th>
                            <th class = "onlinedate">'.$row['Date'].'</th>
                            <th class = "onlineview">'.$row['view'].'</th>
                            <th class = "onlinescore">'.$row['score'].'</th>
                        </tr>';
                    }
                ?>
            </tbody>
        </table>
        <?php
            if($last > 1){//페이징 처리
                echo "<div class = 'paging flex'><a href = 'online.php?page=1' class = 'firstlast'>◀◀</a><a href = 'online.php?page=$previous' class = 'prevnext'>◀</a>
                <span class = 'flex'>";
                for($i = 1; $i <= $last; $i++){
                    if($i == $page){
                        echo "<span class = 'nowpage'>";
                        if(isset($_GET['subject'])){
                            echo "<a href = 'online.php?page=$i&subject=$option'>$i</a>";
                        }
                        else if(isset($_GET['id'])){
                            echo "<a href = 'online.php?page=$i&id=$option'>$i</a>";
                        }
                        else if(isset($_GET['name'])){
                            echo "<a href = 'online.php?page=$i&name=$option'>$i</a>";
                        }
                        else if(isset($_GET['contents'])){
                            echo "<a href = 'online.php?page=$i&contents=$option'>$i</a>";
                        }
                        else{
                            echo "<a href = 'online.php?page=$i'>$i</a>";
                        }
                        echo "</span>";
                    }
                    else{
                        if(isset($_GET['subject'])){
                            echo "<a href = 'online.php?page=$i&subject=$option'>$i</a>";
                        }
                        else if(isset($_GET['id'])){
                            echo "<a href = 'online.php?page=$i&id=$option'>$i</a>";
                        }
                        else if(isset($_GET['name'])){
                            echo "<a href = 'online.php?page=$i&name=$option'>$i</a>";
                        }
                        else if(isset($_GET['contents'])){
                            echo "<a href = 'online.php?page=$i&contents=$option'>$i</a>";
                        }
                        else{
                            echo "<a href = 'online.php?page=$i'>$i</a>";
                        }
                    }
                    
                }
                echo "</span><a href = 'online.php?page=$next' class = 'prevnext'>▶</a><a href = 'online.php?page=$last' class = 'firstlast'>▶▶</a></div>";
            }
        ?>
        <form class = "searchonline flex" action = "search.php" method = "POST">
            <select name = "option">
                <option value = "none">선택</option>
                <option value = "subject">제목</option>
                <option value = "contents">내용</option>
                <option value = "nameorID">글작성자</option>
            </select>
            <input type = "text" placeholder = "게시물을 검색하세요" class = "keyword" name = "keyword" autocomplete = "off"></input>
            <button class = "searchstore">검색</button>
            <button type = "button" class = "showall">전체보기</button>
        </form>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>