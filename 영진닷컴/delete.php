<?php
    include "../db.php";
    $id = $_GET['id'];
    $password = $_GET['deletepassword'];
    $email = $_GET['deleteemail1']."@".$_GET['deleteemail2'];
    if($password==""||$_GET['deleteemail1']==""||$_GET['deleteemail2']==""){
        ?>
            <script>
                alert("비밀번호, 이메일을 모두 작성하시기 바랍니다.");
                history.back();
            </script>
        <?php
        exit;
    }
    else{
        $sql = "select * from youngjin where id = '$id' and password = '$password' and email = '$email'";
        $result = mysqli_query($connect,$sql);
        if(mysqli_num_rows($result)>=1){
            $sql2 = "delete from youngjin where id = '$id' and password = '$password' and email = '$email'";
            mysqli_query($connect,$sql2);
            ?>
                <script>
                    alert("해당 아이디를 성공적으로 탈퇴하였습니다.");
                    location.href = "logout.php";
                </script>
            <?php
            exit;  
        }
        else{
            ?>
                <script>
                    alert("입력한 정보가 맞지 않습니다.");
                    location.href = "updateinfo.php?id=<?php echo $id ?>";
                </script>
            <?php
            exit;
        }
    }
?>
