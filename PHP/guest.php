<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>방명록</title>
    <link rel = "stylesheet" type = "text/css" href = "css/style.css?var1">
</head>
<body>
    <?php
        include "header.php";
        include "../db.php";
        $name = "";
        if(isset($_SESSION['name'])){
            $name = $_SESSION['name'];
        }
        echo "<p class = 'width90'>작성자 : ".$name."</p>";
        if(!isset($_GET['page'])){
            $page = 1;
        }
        else{
            $page = $_GET['page'];
        }
        $sql = "select count(*) from memo";
        $result = mysqli_query($connect,$sql);
        $row = mysqli_fetch_array($result);
        $last = 0;
        $previous;
        $next;
        if($row['count(*)']%3==0){
            $last = floor($row['count(*)']/3);
        }
        else{
            $last = floor($row['count(*)']/3) + 1;
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
        
    ?>
    <form action = "guest_insert.php" method = "POST" class = "guestcomment flex width90">
        <textarea name = "contents"></textarea><input type = "submit" value = "작성하기">
    </form>
    <?php
        $start = ($page-1)*3;
        $sql = "select * from memo order by no desc Limit $start, 3";
        $result = mysqli_query($connect,$sql);
        while($row = mysqli_fetch_array($result)){
            $no = $row['no'];
            echo "<div class = 'memos'><hr class = 'memohr'><p class = 'width90'><input type = 'hidden' name = 'num' value = '".$no."'>".$no." ".$row['name']." ".$row['regdate']." ";
            if($row['name'] == $name){
                echo "<a href = 'guest_delete.php?no=".$no."'>삭제</a>";
            }
            echo "</p><hr class = 'memodothr'><p class = 'width90'>".$row['content']."</p></div><span class = 'getcomment width90'>덧글</span><div class = 'comments column'>";
            $sql2 = "select * from memo_reply where parent = '".$row['content']."' order by no desc";
            $result2 = mysqli_query($connect,$sql2);
            while($row2 = mysqli_fetch_array($result2)){
                echo "<div class = 'yourcomment'><div>".$row2['name']." ".$row2['regdate']." <input type = 'hidden' name = 'commentno' value = '".$row2['no']."'>";
                if($row2['name'] == $name){
                    echo "<a href = 'guest_reply_delete.php?no=".$no."&commentno=".$row2['no']."'>삭제</a>";
                }
                echo "</div><div>".$row2['content']."</div><hr class = 'memodothr'></div>";
            }
            echo "<form action = 'guest_reply_insert.php' method = 'POST' class = 'flex margin10'><input type = 'hidden' name = 'parents' value = '".$row['content']."'>
            <textarea name = 'reply' class = 'reply'></textarea><input type = 'submit' class = 'submit' value = '덧글입력'></form></input></div>";//</form>을 안 닫아줘서 데이터 전송이 끊기는 오류 발생
        }
        if($last > 1){
            echo "<div class = 'paging flex'><a href = 'guest.php?page=1' class = 'firstlast'>[처음]</a><a href = 'guest.php?page=$previous' class = 'prevnext'>이전 페이지</a>
            <span class = 'flex'>";
            for($i = 1; $i <= $last; $i++){
                echo "<a href = 'guest.php?page=$i'>$i</a>";
            }
            echo "</span><a href = 'guest.php?page=$next' class = 'prevnext'>다음 페이지</a><a href = 'guest.php?page=$last' class = 'firstlast'>[마지막]</a></div>";
        }
    ?>
</body>
</html>