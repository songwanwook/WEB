<?php
    include "../db.php";
    $id = $_POST['id'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $passwordcheck = $_POST['passwordcheck'];
    $question = $_POST['question']." ".$_POST['answer'];
    $birthday = $_POST['birth'];
    $phone = $_POST['phone'].$_POST['phone2'].$_POST['phone3'];
    $email = $_POST['email1']."@".$_POST['email2'];

    if($id == "" || $name == "" || $password == "" || $passwordcheck == "" || $_POST['question'] == "" || $_POST['answer'] == "" || 
    $_POST['phone'] == "" || $_POST['phone2'] == "" || $_POST['phone3'] == "" || $_POST['email1'] == "" || $_POST['email2'] == ""){
        ?>
            <script>
                alert("가입 입력란을 모두 작성하시기 바랍니다.");
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
        $sql1 = "select id from youngjin where id = '$id'";
        $result = mysqli_query($connect,$sql1);
        if(mysqli_fetch_array($result)>=1){
            ?>
                <script>
                    alert("중복되는 아이디가 있습니다.");
                    history.back();
                </script>
            <?php
            exit;
        }else{
            $sql = "insert into youngjin values('$id','$name','$password','$question','$birthday','$phone','$email')";
            if(mysqli_query($connect,$sql)){
                ?>
                    <script>
                        alert("회원 가입이 완료되었습니다. 이제 로그인 하시기 바랍니다.");
                        location.href = "login.php";
                    </script>
                <?php
                exit;
            }
            else{
                ?>
                    <script>
                        alert("SQL문 에러");
                        history.back();
                    </script>
                <?php
                exit;
            }
        }
    }
?>