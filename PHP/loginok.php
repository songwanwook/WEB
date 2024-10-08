<?php
    include "../db.php";
    session_start();
    $id = $_POST['id'];
    $password = $_POST['password'];
    if($id == "" || trim($id) == "" || $password == "" || trim($password) == ""){
        ?>
        <script>alert("정보를 입력하세요.");history.back();</script>
        <?php
        exit;
    }
    else{
        $sql = "select * from test_son where id = '$id' and pw = '$password'";
        $result = mysqli_query($connect,$sql);
        if(mysqli_num_rows($result) >= 1){
            $row = mysqli_fetch_array($result);
            
            $_SESSION['session_id'] = $id;
            $_SESSION['name'] = $row['name'];
            ?>
            <script>alert("로그인 되었습니다.");location.href = "index.php";</script>
            <?php
            exit;
        }
        else{
            ?>
            <script>alert("ID 또는 패스워드가 틀렸습니다.");history.back();</script>
            <?php
            exit;
        }
    }
?>