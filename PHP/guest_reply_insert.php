<?php
    session_start();
    include "../db.php";
    $reply = $_POST['reply'];
    if(!isset($_SESSION['name'])){
        ?><script>alert("로그인 후 이용 가능합니다.");location.href = "login.php";</script><?php
    }
    else if($reply == "" || trim($reply) == ""){
        ?><script>alert("내용을 한 글자 이상 작성하세요.");history.back();</script><?php
    }
    else{
        $parents = $_POST['parents'];
        $id = $_SESSION['session_id'];
        $name = $_SESSION['name'];
        $sql = "insert into memo_reply(parent, id, name, content, regdate) values('$parents','$id','$name','$reply',now())";
        if(mysqli_query($connect, $sql)){
            $sql1 = "set @count = 0";
            mysqli_query($connect, $sql1);
            $sql2 = "update memo_reply set no = @count:=@count+1;";
            mysqli_query($connect, $sql2);
            ?><script>alert("성공적으로 작성되었습니다.");location.href = "guest.php";</script><?php
        }
        else{
            ?><script>alert("실행 중 오류가 발생하였습니다.");history.back();</script><?php
        }
    }
?>