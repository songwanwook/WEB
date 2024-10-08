<?php
    include "db.php";
    $userid = $_POST['userid'];
    $userpw = $_POST['userpw'];
    $userpwok = $_POST['userpwok'];
    $username = $_POST['username'];
    $address = $_POST['address'];
    $usersex = $_POST['sex'];
    $email = $_POST['email']."@".$_POST['emailaddress'];

    if($userpw!=$userpwok){
        ?>
        <script>
            alert("비밀번호 확인이 다릅니다.");
            history.back();
        </script>
        <?php
        exit;
    }
    else{
        $idcheck = "select * from dongeui_member where userid = '$userid'";
        $result = $connect->query($idcheck);
        if(mysqli_num_rows($result)>=1){
            echo "<script>alert('중복된 아이디가 있습니다.');history.back();</script>";
            exit;
        }
        else{
            $sql = "insert into dongeui_member values('$userid','$userpw','$username','$address','$usersex','$email')";
            mysqli_query($connect, $sql);
            echo "<script>alert('회원가입이 완료되었습니다.');location.href = 'ajaxboard.php';</script>";
        }
    }
?>