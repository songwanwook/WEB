<?php
    $mysql_host = "localhost";
    $mysql_user = "sgw";
    $mysql_password = "uk2643977!";
    $mysql_db = "sgw";
    $connect = mysqli_connect($mysql_host,$mysql_user, $mysql_password, $mysql_db);
    $id = $_POST['id'];
    $pw = $_POST['pw'];
    $pwc = $_POST['pwc'];
    $email = $_POST['email'];
    //비밀번호 틀림
    if($pw!=$pwc){
?>
    <script>
        alert("비밀번호가 일치하지 않습니다.");
        location.href = "join.html";
    </script>
<?php
    exit();
    }
    //입력란 빈칸있음
    if($id==NULL||$pw=NULL||$pwc==NULL||$email==NULL){
?>
    <script>
        alert("입력란을 모두 입력하세요.");
        history.back();
    </script>
<?php
    exit();    
    }
    //중복ID
    $query_id_check = "select * from dongeui_info where id = '$id'";
    $result = $connect->query($query_id_check);
    if(mysqli_num_rows($result)==1){
?>
    <script>
        alert("중복 ID가 있습니다.");
        history.back();
    </script>
<?php
    exit();
    }
    //가입
    $query = "insert into dongeui_info values('$id','$pwc','$email')";
    $result = $connect->query($query);
    if($result){
        echo "회원가입 완료 <a href = "."login.html".">로그인 가기</a>";
    }
?>