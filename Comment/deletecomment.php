<?php
    include "../db.php";
    $getnum = $_GET['num'];
    if(!$connect){
        die("연결 실패".mysqli_connect_error());
    }
    $sql = "delete from dongeui_guest where no = '$getnum'";
    mysqli_query($connect, $sql);
    ?>
        <script>
            alert("댓글이 삭제되었습니다.");
            location.href = "guestbook.php";
        </script>
    <?php
?>