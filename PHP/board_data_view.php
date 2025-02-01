<?php
    include "../db.php";
    $num = $_GET['num'];
    $view = "update download set hit = hit + 1 where num = $num";
    mysqli_query($connect,$view);
    $sql = "select * from download where num = $num";
    $result = mysqli_query($connect,$sql);
    $row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['subject']; ?></title>
</head>
<body>
    <?php
        include "header.php";  
    ?>
    <h1 class = 'width90'>자료실</h1>
    <hr>
    <div class = "title header flex" style = "padding:5px"><span><?php echo $row['subject']; ?></span>
    <span style = "padding-right:5px"><?php echo $row['name']."  |  조회 : ".$row['hit']."  |"; ?></div>
    <div class = "boardcontents">
        <?php echo $row['content'].'<br>'; 
            if($row['filename_0']!=""){
                echo "▷ 첨부 파일 : ".$row['filename_0']." (".filesize('download/'.$row['filename_0'])." Byte)  
                <a href = 'download.php?filename=".$row['filename_0']."'>[저장]</a><br>";
            }
            if($row['filename_1']!=""){
                echo "▷ 첨부 파일 : ".$row['filename_1']." (".filesize('download/'.$row['filename_1'])." Byte)  
                <a href = 'download.php?filename=".$row['filename_1']."'>[저장]</a><br>";
            }
            if($row['filename_2']!=""){
                echo "▷ 첨부 파일 : ".$row['filename_2']." (".filesize('download/'.$row['filename_2'])." Byte)  
                <a href = 'download.php?filename=".$row['filename_2']."'>[저장]</a><br>";
            }
        ?>
    </div>
    <div class = "boardbutton"><button class = "listbutton">목록</button><button class = "updatebutton">수정</button>
    <button class = "deletebutton">삭제</button><button class = "writebutton">글쓰기</button></div>
    <script>
        $(".listbutton").on("click",function(){
            location.href = "board_data.php";
        });
        $(".updatebutton").on("click",function(){
            location.href = "board_data_write.php?num=<?php echo $num; ?>";
        });
        $(".deletebutton").on("click",function(){
            const deletealert = confirm("게시글 삭제 시 올라온 자료들도 삭제됩니다.\n게시글을 삭제하시겠습니까?");
            if(deletealert){
                location.href = "download_delete.php?num=<?php echo $num; ?>";
            }
        });
        $(".writebutton").on("click",function(){
            location.href = "board_data_write.php";
        });
    </script>
</body>
</html>
