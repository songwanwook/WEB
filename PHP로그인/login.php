<?php
    session_start();
    $mysql_host = "localhost";
    $mysql_user = "sgw";
    $mysql_password = "uk2643977!";
    $mysql_db = "sgw";
    $connect = mysqli_connect($mysql_host,$mysql_user, $mysql_password, $mysql_db);
    $userid = $_POST['userid'];
    $pw = $_POST['pw'];
    $query = "select * from dongeui_info where id = '$userid'";
    $result = $connect->query($query);
    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_array($result);
        if($row['pw']==$pw){
            $_SESSION['session_id']=$userid;
            if(isset($_SESSION['session_id'])){
                header('Location: ./main.php');
            }
            else{
                ?>
                <script>
                    alert("session fail");
                </script>
                <?php
            }
        }
        else{
            ?>
            <script>
                alert("아이디 또는 비밀번호가 틀립니다.");
                history.back();
            </script>
            <?php
        }
    }
    else{
        ?>
        <script>
                alert("해당되는 ID가 없습니다.");
                history.back();
            </script>
        <?php
    }
?>
