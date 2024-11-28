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
    if($name == NULL){
        ?>
            <script>
                alert("삭제할 글 번호를 입력하세요.");
                history.back();
            </script>
        <?php
    }
    else if($delete == NULL){
        ?>
            <script>
                alert("삭제키를 입력하세요.");
                history.back();
            </script>
        <?php
    }
    else{
        $sql = "select name, Rdkey from board where no = $name and Rdkey = '$delete'";
        $result = mysqli_query($connect, $sql);
        if(mysqli_num_rows($result)==1){
            $deletesql = "delete from board where no = $name and Rdkey = '$delete'";
            mysqli_query($connect, $deletesql);
            $sql1 = "set @count = 0";
            mysqli_query($connect, $sql1);
            $sql2 = "update board set no = @count:=@count+1;";
            mysqli_query($connect, $sql2);
            ?>
                <script>
                    alert("삭제하였습니다.");
                    location.href = "board.php?notice=";
                </script>
            <?php
        }
        else{
            ?>
                <script>
                    alert("삭제할 글 번호, 비밀번호가 다릅니다..");
                    location.href = "board.php?notice=";
                </script>
            <?php
        }
    }
?>