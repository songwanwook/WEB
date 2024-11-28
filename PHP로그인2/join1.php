<?php
    $mysql_host = "localhost";
    $mysql_user = "sgw";
    $mysql_password = "uk2643977!";
    $mysql_db = "sgw";
    $connect = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
    $id = $_POST['id'];
    $pw = $_POST['pw'];
    $pwc = $_POST['pwc'];
    $email = $_POST['email'];
    if($id==NULL||$pw==NULL||$pwc==NULL||$email==NULL){
        ?>
        <script>
            alert("필수입력란을 모두 작성하시기 바랍니다.");
            history.back();
        </script>
        <?php
        exit();
    }
    if($pw!=$pwc){//비밀번호틀림
        ?>
        <script>
            alert("비밀번호가 일치하지 않습니다.");
            location.href = "join1.html";
        </script>
        <?php
        exit();
    }

    $query = "insert into dongeui_info values('$id', '$pwc', '$email')";
    $result = $connect->query($query);
    if($result){
        ?>
        <script>
            alert("회원가입이 완료되었습니다.");
            location.href = "login1.html";
        </script>
        <?php 
    }
    else{
        ?>
        <script>
            alert("중복되는 아이디가 있습니다.");
            location.href = "join1.html";
        </script>
        <?php 
    }
?>