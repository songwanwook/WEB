<?php
    session_start();
    if(!isset($_SESSION['ID'])){
        ?>
        <script>
            alert("로그인 후 이용하실 수 있습니다.");
            location.href = "index.php";
        </script>
        <?php
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>전문가</title>
    <script src = "js/jquery-1.10.2.js"></script>
    <script src = "js/script.js"></script>
</head>
<body>
    <?php
        include "../db.php";
        include "side.php";
        include "header.php";
    ?>
    <div class = "bg width100">
        <h1 class = "width100 textcenter" style="padding:20px 0px">전문가 목록</h1>
        <div class = "flex column width100">
            <?php $sql = "select * from professional"; $result = mysqli_query($connect,$sql); $pn = 1; $pname = "";
            while($row = mysqli_fetch_array($result)){ ?>
            <div class = "flex professionallist" id= "p<?php echo $pn; ?>">
                <div class = "flex professionalprofile"><img src = "src/<?php echo $row['professionalID']; ?>.jpg" class = "professionaldetail"></img>
                <div class = "flex column professionallist">
                    <p>이름 : <?php $pname = $row['professionalNAME']; echo $pname; ?></p><p>아이디 : <?php echo $row['professionalID']; ?></p>
                    <p>평점 : <span class = "star"><?php $AVG = $row['professionalAVG']; 
                    for($n = 0; $n < 5; $n++){
                        if($n < $AVG){
                            echo "★";
                        }
                        else{
                            echo "☆";
                        }
                    } ?></span> <?php echo $AVG; ?>점</p>
                    <a class = "professionalwrite" href = "professionalwrite.php?pid=<?php echo $row['professionalID']; ?>">시공 후기작성</a>
                </div>
                </div>
                <div class = "flexcolumn">
                    <h1 style = "margin:5px 0px">리   뷰</h1>
                    <div class = "flex proreviewdiv">
                        <?php $sql2 = "select * from professionalreview where specialistNAME = '$pname'"; $result2 = mysqli_query($connect,$sql2);
                        while($row2 = mysqli_fetch_array($result2)){
                            echo '<div class = "flexcolumn" style = "padding-right:5px">
                            <a href = "professionalview.php?no='.$row2['no'].'"><img src = professionalreview/'.$row2['reviewimg'].' class = "professionalimageview"></a>
                            <p>작성자 '.$row2['name'].'('.$row2['ID'].')</p><p>조회수 '.$row2['view'].'</p><p>평점 ';
                            $score = $row2['professionalscore'];
                            for($n = 0; $n < 5; $n++){
                                if($n < $score){
                                    echo "<span class = 'positive'>★</span>";
                                }
                                else{
                                    echo "<span class = 'negative'>☆</span>";
                                }
                            }
                            echo '</p></div>';
                        } ?>
                    </div>
                </div>
            </div>
            <?php $pn++; } ?>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>