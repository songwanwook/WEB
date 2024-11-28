<?php
    $mysql_host = "localhost";
    $mysql_user = "sgw";
    $mysql_password = "uk2643977!";
    $mysql_db = "sgw";
    $connect = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
    if(!$connect){
        die("연결 실패".mysqli_connect_error());
    }
    $name = $_POST['name'];
    $delete = $_POST['delete'];
    $contents = $_POST['contents'];
    if($name == NULL){
        ?>
            <script>
                $notice = "이름을 입력하세요!";
                location.href = 'board.php?notice='+$notice;
            </script>
        <?php
        exit();
    }
    else if($delete == NULL){
        ?>
            <script>
                $notice = "삭제키를 입력하세요!";
                location.href = 'board.php?notice='+$notice;    
            </script>
        <?php
        exit();
    }
    else if($contents == NULL){
        ?>
            <script>
                $notice = "내용을 입력하세요!";
                location.href = 'board.php?notice='+$notice;       
            </script>
        <?php
        exit();
    }
    else{
        $sql = "insert into board(name, free, Rdkey, date) values('$name','$contents','$delete', now())";
        $result = $connect->query($sql);
        $sql1 = "set @count = 0";
        mysqli_query($connect, $sql1);
        $sql2 = "update board set no = @count:=@count+1;";
        mysqli_query($connect, $sql2);
        if($result){
            ?>
            <script>
                alert("성공적으로 반영되었습니다.");
                location.href = "board.php?notice=";
            </script>
            <?php
        }
    }
?>