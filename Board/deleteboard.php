<?php
    include "db.php";
    $id = $_POST['id'];
    $password = $_POST['password'];
    $sql = "select * from ajax_board where no = $id and password = '$password'";
    $result = mysqli_query($connect,$sql);
    if(mysqli_num_rows($result)==1){
        $sql = "delete from ajax_board where no = $id";
        mysqli_query($connect, $sql);
        ?> 
            <script>
                alert("삭제 성공.");
                location.href = "ajaxboard.php";
            </script>
        <?php
        $sql1 = "set @count = 0";
        mysqli_query($connect, $sql1);
        $sql2 = "update ajax_board set no = @count:=@count+1;";
        mysqli_query($connect, $sql2);
    }
    else{
        ?>
            <script>
                alert("비밀번호가 틀립니다.");
                location.href = "view.php?no=<?php echo $id; ?>"
            </script>
        <?php
    }
?>