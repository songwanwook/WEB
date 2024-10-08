<?php
    include "../db.php";
    $password = $_POST['password'];
    $passwordcheck = $_POST['passwordcheck'];
    $question = $_POST['question']." ".$_POST['answer'];
    $birthday = $_POST['birth'];
    $phone = $_POST['phone'].$_POST['phone2'].$_POST['phone3'];
    $email = $_POST['email1']."@".$_POST['email2'];

    if($password == "" || $passwordcheck == "" || $_POST['question'] == "" || $_POST['answer'] == "" || 
    $_POST['phone'] == "" || $_POST['phone2'] == "" || $_POST['phone3'] == "" || $_POST['email1'] == "" || $_POST['email2'] == ""){
        ?>
            <script>
                alert("회원정보 수정 입력란을 모두 작성하시기 바랍니다.");
                history.back();
            </script>
        <?php
        exit;
    }
    else if($password != $passwordcheck){
        ?>
            <script>
                alert("비밀번호 확인이 다릅니다.");
                history.back();
            </script>
        <?php
        exit;
    }
    else{
        $sql = "update youngjin set password = '$password', question = '$question', birthday = '$birthday', phone = '$phone', email = '$email'";
        if(mysqli_query($connect, $sql)){
            ?>
            <script>
                alert("회원정보 수정이 완료되었습니다.");
                location.href = "main.php";
            </script>
        <?php
        }
    }
?>