<?php
    include "../db.php";
    $name = $_POST['name'];
    $id = $_POST['id'];
    $password = $_POST['password'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $checksql = "select id from test_son where id = '$id'";
    $result = mysqli_query($connect, $checksql);
    if(mysqli_num_rows($result)>=1){
        
        ?>
        <script>alert("중복되는 아이디가 있습니다.");history.back();</script>
        <?php
        exit;
    }
    else{
    $sql = "insert into test_son(name, id, pw, tel, email, regdate, ip) values('$name','$id','$password','$tel','$email',now(),'".$_SERVER['REMOTE_ADDR']."')";
        if(mysqli_query($connect,$sql)){
            $sql1 = "set @count = 0";
            mysqli_query($connect, $sql1);
            $sql2 = "update test_son set no = @count:=@count+1;";
            mysqli_query($connect, $sql2);
            ?>
            <script>alert("회원가입이 완료되었습니다.");location.href = "index.php";</script>
            <?php
            exit;
        }else{
            ?>
            <script>alert("회원정보가 등록되지 않았습니다.");</script>
            <?php
            echo mysqli_error($connect);
        }
    }
    
?>