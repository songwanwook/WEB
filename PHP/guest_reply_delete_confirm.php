<?php
    include "../db.php";
    $no = $_GET['no'];
    $commentno = $_GET['commentno'];
    $sql = "delete memo_reply from memo, memo_reply where memo.content = memo_reply.parent and memo.no = $no and memo_reply.no = $commentno";//JOIN을 이용하는 삭제방법   
    if(mysqli_query($connect, $sql)){
        $sql1 = "set @count = 0";
        mysqli_query($connect, $sql1);
        $sql2 = "update memo_reply set no = @count:=@count+1;";
        mysqli_query($connect, $sql2);
        ?><script>alert("삭제하였습니다.");location.href = "guest.php";</script><?php
    }
    else{
        ?><script>alert("삭제하는 중 기술적인 오류가 발생하였습니다. 빠른 시일 내로 고치도록 하겠습니다.");</script><?php
    }
?>