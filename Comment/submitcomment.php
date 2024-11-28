<?php
    include "../db.php";
    $comments = $_POST['comments'];
    if($comments == NULL || $comments == ""){
        ?>
            <script>
                alert("댓글을 입력하지 않았습니다.");
                history.back();
            </script>
        <?php
    }
    else{
        $sql = "insert into dongeui_guest(contents) values('$comments')";
        mysqli_query($connect, $sql);
        ?>
            <script>
                alert("댓글이 등록되었습니다.");
                location.href = "guestbook.php";
            </script>
        <?php
    }
?>