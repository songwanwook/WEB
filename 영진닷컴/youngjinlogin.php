<?php
    session_start();
    include "../db.php";
    $id = $_GET['id'];
    $password = $_GET['password'];
    $sql = "select * from youngjin where id = '$id' and password = '$password'";
    $result = mysqli_query($connect,$sql);
    if(mysqli_num_rows($result) >= 1){
        $_SESSION['session_id']=$id;
        ?>
            <script>
                alert("성공적으로 로그인 하였습니다.");
                location.href = "main.php";
            </script>
        <?php
        exit;
    }
    else{
        ?>
            <script>
                alert("아이디 또는 비밀번호가 다릅니다.");
                history.back();
            </script>
        <?php
        exit;
    }
?>