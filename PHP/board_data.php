<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>자료실</title>
</head>
<body>
    <?php
        include "../db.php";
        include "header.php";
        
        $count = "select count(*) from download";
        $countresult = mysqli_query($connect,$count);
        $rowcount = mysqli_fetch_array($countresult);
        if(!isset($_GET['page'])){
            $page = 1;
        }
        else{
            $page = $_GET['page'];
        }
        $last = 0;
        $previous;
        $next;
        if($rowcount['count(*)']%3==0){
            $last = floor($rowcount['count(*)']/3);
        }
        else{
            $last = floor($rowcount['count(*)']/3) + 1;
        }
        if($page > 1){
            $previous = $page -1;
        }
        else{
            $previous = 1;
        }
        if($page < $last){
            $next = (int)$page + (int)1;
        }
        else{
            $next = $last;
        }
        $start = ($page-1)*3;
        $sql = "select * from download order by num desc Limit $start, 3";
        $result = mysqli_query($connect,$sql);
    ?>
    <h1 class = 'width90'>자료실</h1>
    <hr>
    <div class = "board">
        <div>▷ 총 <?php echo $rowcount['count(*)']; ?>개의 게시물이 있습니다.</div>
        <table class = "boardtable">
            <thead>
                <tr>
                    <th class = "tnum">번호</th>
                    <th class = "ttitle">제목</th>
                    <th class = "tname">글쓴이</th>
                    <th class = "tdate">등록일</th>
                    <th class = "tview">조회수</th>
                <tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_array($result)){
                        echo '<tr><th class = "tnum">'.$row['num'].'</th>
                        <th class = "ttitle"><a href = "board_data_view.php?num='.$row['num'].'">'.$row['subject'].'</a></th>
                        <th class = "tname">'.$row['name'].'</th>
                        <th class = "tdate">'.$row['regdate'].'</th>
                        <th class = "tview">'.$row['hit'].'</th></tr>';
                    }
                ?>
            </tbody>
            <br>
        </table>
        <br>
        <button class = "boardwrite">글쓰기</button>
    </div>
    
    <?php
        if($last > 1){
            echo "<div class = 'paging flex'><a href = 'board_data.php?page=1' class = 'firstlast'>[처음]</a><a href = 'board_data.php?page=$previous' class = 'prevnext'>이전 페이지</a>
            <span class = 'flex'>";
            for($i = 1; $i <= $last; $i++){
                echo "<a href = 'board_data.php?page=$i'>$i</a>";
            }
            echo "</span><a href = 'board_data.php?page=$next' class = 'prevnext'>다음 페이지</a><a href = 'board_data.php?page=$last' class = 'firstlast'>[마지막]</a></div>";
        }
    ?>
    <script>
        $(".boardwrite").on("click",function(){
            location.href = "board_data_write.php";
        });
    </script>
</body>
</html>