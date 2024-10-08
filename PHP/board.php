<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
</head>
<body>
    <?php
        include "header.php";
        include "../db.php";
        $sql = "";$countsql = "";$option = "";
        if(isset($_GET['subject'])){//제목
            $option = $_GET['subject'];
            $countsql = "select count(*) from test_board where subject like '%$option%'";
            $sql = "select * from test_board where subject like '%$option%'";
        }
        else if(isset($_GET['id'])){
            $option = $_GET['id'];
            $countsql = "select count(*) from test_board where id = '$option'";
            $sql = "select * from test_board where id = '$option'";
        }
        else if(isset($_GET['name'])){
            $option = $_GET['name'];
            $countsql = "select count(*) from test_board where name = '$option'";
            $sql = "select * from test_board where name = '$option'";
        }
        else if(isset($_GET['contents'])){//내용
            $option = $_GET['contents'];
            $countsql = "select count(*) from test_board where content like '%$option%'";
            $sql = "select * from test_board where content like '%$option%'";
        }
        else{
            $sql = "select * from test_board";
            $countsql = "select count(*) from test_board";
        }
        $result = mysqli_query($connect,$countsql);
        $row = mysqli_fetch_array($result);
        if(!isset($_GET['page'])){
            $page = 1;
        }
        else{
            $page = $_GET['page'];
        }
        $last = 0;
        $previous; $next;
        if($row['count(*)']%3==0){
            $last = floor($row['count(*)']/3);
        }
        else{
            $last = floor($row['count(*)']/3) + 1;
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
    <h1 class = "width90">게시판</h1>
    <hr>
    <div class = "board">
        <div class = "flex header2">
            <div>▷ 총 <?php echo $row['count(*)']; ?>개의 게시물이 있습니다.</div>
            <form method = "POST" action = "search.php"><span style = "color:darkgray">SELECT</span>
            <select class = "searchmenu" name = "option">
                <option value = "subject">제목</option>
                <option value = "id">ID</option>
                <option value = "name">작성자</option>
                <option value = "contents">내용</option>
            </select><input type = "text" name = "search" class = "search" size = "12"></input><input type = "submit" class = "gosearch" value = "검색"></form>
        </div>
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
                    $start = ($page-1)*3;
                    $sql = $sql." order by num desc Limit $start, 3";
                    $result = mysqli_query($connect,$sql);
                    while($row = mysqli_fetch_array($result)){
                        echo '<tr><th class = "tnum">'.$row['num'].'</th>
                        <th class = "ttitle"><a href = "board_view.php?num='.$row['num'].'">'.$row['subject'].'</a></th>
                        <th class = "tname">'.$row['name'].'</th>
                        <th class = "tdate">'.$row['regdate'].'</th>
                        <th class = "tview">'.$row['hit'].'</th></tr>';
                    }
                ?>
            </tbody>
            <br>
        </table>
        <br>
        <button class = "boardlist">목록</button><button class = "boardwrite">글쓰기</button>
    </div>
    
    <?php
        if($last > 1){
            echo "<div class = 'paging flex'><a href = 'board.php?page=1' class = 'firstlast'>[처음]</a><a href = 'board.php?page=$previous' class = 'prevnext'>이전 페이지</a>
            <span class = 'flex'>";
            for($i = 1; $i <= $last; $i++){
                if(isset($_GET['subject'])){
                    echo "<a href = 'board.php?page=$i&subject=$option'>$i</a>";
                }
                else if(isset($_GET['id'])){
                    echo "<a href = 'board.php?page=$i&id=$option'>$i</a>";
                }
                else if(isset($_GET['name'])){
                    echo "<a href = 'board.php?page=$i&name=$option'>$i</a>";
                }
                else if(isset($_GET['contents'])){
                    echo "<a href = 'board.php?page=$i&contents=$option'>$i</a>";
                }
                else{
                    echo "<a href = 'board.php?page=$i'>$i</a>";
                }
            }
            echo "</span><a href = 'board.php?page=$next' class = 'prevnext'>다음 페이지</a><a href = 'board.php?page=$last' class = 'firstlast'>[마지막]</a></div>";
        }
    ?>
    <script>
        $(".boardwrite").on("click",function(){
            location.href = "board_write_form.php";
        });
        $(".boardlist").on("click",function(){
            location.href = "board.php";
        });
    </script>
</body>
</html>