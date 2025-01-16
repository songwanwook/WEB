<?php
    session_start();
    include "info.php";
    include "../db.php";
    $ID = $_SESSION['ID'];
    $score = $_POST['score'];
    if(isset($_POST['onlineview'])){ 
        $no = $_POST['onlineview']; $table = "onlinehousing"; $rowname = 'view_ID'; $locationhref = 'onlineview.php?no='.$no;
    }
    else{ 
        $no = $_POST['proviewno']; $table = "professionalreview"; $rowname = 'PRO_VIEW_ID'; $locationhref = 'professionalview?no='.$no;
    }
    $sql = "insert into userscore(ID,$rowname,score) values('$ID',$no,$score)";
    mysqli_query($connect,$sql);
    $sql = "update $table set ratingcount = ratingcount + 1, totalscore = totalscore + $score, score = floor(totalscore/ratingcount) where no = $no";
    mysqli_query($connect,$sql);
    ?><script>alert("점수가 반영되었습니다.");history.back(); </script><?php
?>