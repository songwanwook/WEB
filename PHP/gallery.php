<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>갤러리</title>
</head>
<body>
    <?php
        include "header.php";
        include "../db.php";
        if(!isset($_GET['page'])){
            $page = 1;
        }
        else{
            $page = $_GET['page'];
        }
        $count = "select count(*) from (select filename_0 from test_board where filename_0 != '' union select filename_1 from test_board 
        where filename_1 != '' union select filename_2 from test_board where filename_2 != '') as subquery";//합계 구하기

        $result = mysqli_query($connect,$count);
        $row = mysqli_fetch_array($result);
        $last = 0; $previous; $next;
        if($row['count(*)']%16==0){
            $last = floor($row['count(*)']/16);
        }
        else{
            $last = floor($row['count(*)']/16)+1;
        }
        if($page > 1){
            $previous = $page-1;
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
        $start = ($page-1)*16;
        $sql = "select filename_0, num, subject from test_board where filename_0 != '' union select filename_1, num, subject from test_board
        where filename_1 != '' union select filename_2, num, subject from test_board where filename_2 != '' order by num desc Limit $start, 16";
        $result = mysqli_query($connect,$sql);
    ?>
    <div class = "flex gallerydiv">
    <?php
        $n = ($page-1)*16;
        while($row = mysqli_fetch_array($result)){
            if($row['filename_0']!=""){

                echo "<div><img src = 'data/".$row['filename_0']."' class = 'gallery' id = '".$row['num']."' onclick = 'showModal();show($n)'></img><br><p>
                <a href = 'board_view.php?num=".$row['num']."' class = 'galleryhref'><input type = 'hidden' name = 'num' class = 'num' value = '$n'>".$row['subject']."</a></p></div>";
                $n++;
            }
        }
    ?>
    </div>
    <?php
        if($last > 1){
            echo "<div class = 'paging flex'><a href = 'gallery.php?page=1' class = 'firstlast'>[처음]</a><a href = 'gallery.php?page=$previous' class = 'prevnext'>이전 페이지</a>
            <span class = 'flex'>";
            for($i = 1; $i <= $last; $i++){
                echo "<a href = 'gallery.php?page=$i'>$i</a>";
            }
            echo "</span><a href = 'gallery.php?page=$next' class = 'prevnext'>다음 페이지</a><a href = 'gallery.php?page=$last' class = 'firstlast'>[마지막]</a></div>";
        }
        ?>
        <div class = "gallerymodal">
        <?php
        $sql = "select filename_0, num, subject from test_board where filename_0 != '' union select filename_1, num, subject from test_board
        where filename_1 != '' union select filename_2, num, subject from test_board where filename_2 != '' order by num desc";
        $result = mysqli_query($connect,$sql);
        while($row = mysqli_fetch_array($result)){//데이터베이스를 통해 Modal을 만들려면 SQL 호출을 한번 더 해야됨...
            if($row['filename_0']!=""){
                echo '<div class = "galleryModal">
                    <button class = "close">X</button>
                    <span class = "prev">◀</span>
                    <img id = "ModalImg" src = "data/'.$row['filename_0'].'"></img>
                    <span class = "next">▶</span>
                    <a href = "board_view.php?num='.$row['num'].'" class = "modalhref">'.$row['subject'].'</a>
                </div>';
            }
        }
        ?>
        </div>
    <script>
        
        var gallerymodal = document.getElementsByClassName("gallerymodal");
        function showModal(){
            gallerymodal[0].style.display = "block";
        }
        function Modal(n){
            var i;
            var imgs = document.getElementsByClassName("galleryModal");
            if(n >= imgs.length){n -= imgs.length;}
            if(n < 0){n += imgs.length;}
            console.log(n);
            for(i = 0; i < imgs.length; i++){
                if(i==n){
                    imgs[i].style.display = "block";
                }
                else{
                    imgs[i].style.display = "none";
                }
            }
        }
        var index = 1;
        Modal(index);
        function show(n){
            Modal(index = n);
        }
        function plus(n){
            Modal(index += n);
        }
        $(".close").on('click',function(){
            $('.gallerymodal').css('display','none');
        });
        $(".prev").on('click',function(){
            plus(-1);
        });
        $(".next").on('click',function(){
            plus(1);
        });//전체 코드라인 웹 : 1626, CSS : 335 총 코드라인 : 1961, php/html 클래스 : 30
    </script>
</body>
</html>