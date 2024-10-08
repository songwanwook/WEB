<?php
    include "db.php";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $title = $_POST['title'];
    $contents = $_POST['contents'];
    if($name == NULL || $email == NULL || $password == NULL || $title == NULL || $contents == NULL ){//빈칸이 하나이상 있을 경우
        ?>
            <script>
                alert("모든 내용을 작성하시기 바랍니다.");
                history.back();
            </script>
        <?php
    }
    else{//글쓰기 실행
        $sql = "insert into ajax_board(name, email, password, title, contents, view, date) values('$name', '$email', '$password', '$title', '$contents',0,now())";
        if(mysqli_query($connect,$sql)){
            ?>
            <script>
                alert("성공적으로 등록되었습니다.");
                location.href = "ajaxboard.php";
            </script>
            <?php
            $sql1 = "set @count = 0";
            mysqli_query($connect, $sql1);
            $sql2 = "update ajax_board set no = @count:=@count+1;";
            mysqli_query($connect, $sql2);
        }
        else{
            ?>
            <script>
                alert("SQL에러");
            </script>
        <?php
        }
    }
?>