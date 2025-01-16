<?php
    include "../db.php";
    $quono = $_POST['quono'];
    $specialist = $_POST['specialist'];
    $sql = "update sendquotation set state = 'finish' where quono = $quono and specialist = '$specialist'";
    mysqli_query($connect,$sql);
    $sql = "update sendquotation set state = 'nonselected' where quono = $quono and specialist != '$specialist' and state = 'processing'";
    mysqli_query($connect,$sql);
    $sql = "select * from sendquotation where state != 'finish' and quono = $quono";//요청이 모두 선택되면 완료
    $result = mysqli_query($connect,$sql);
    if(mysqli_num_rows($result)<=0){
        $sql = "update quotation set state = 'finish' where no = $quono";
        mysqli_query($connect,$sql);
        ?><script>alert("견적이 완료되었습니다.");history.back();</script><?php
    }
    else{
        ?><script>alert("견적이 선택되었습니다.");history.back();</script><?php
    }
?>