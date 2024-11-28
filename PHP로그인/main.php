<?php
session_start();
if(!isset($_SESSION['session_id'])){
    header('Location: ./login.html');
}
echo "로그인 성공!<br>";
echo "<a href = 'logout.php'>로그아웃</a>";
?>