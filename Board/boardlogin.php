<?php
    session_start();
    include "db.php";
    $userid = $_POST['id'];
    $userpw = $_POST['pw'];
    if($userid == ""){
        ?>
            <script>
                alert("ID를 입력하세요.");
                history.back();
            </script>
        <?php
        exit;
    }
    else if($userpw == ""){
        ?>
            <script>
                alert("비밀번호를 입력하세요.");
                history.back();
            </script>
        <?php
        exit;
    }
    else{
        $sql = "select * from dongeui_member where userid = '$userid' and userpw = '$userpw'";
        $result = mysqli_query($connect, $sql);
        if(mysqli_num_rows($result)==1){
            $_SESSION['session_id']=$userid;
            if(isset($_SESSION['session_id'])){
                header('Location: ./ajaxboard.php');
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
                    alert("ID 또는 비밀번호가 다릅니다.");
                    history.back();
                </script>
            <?php
        }
    }
?>