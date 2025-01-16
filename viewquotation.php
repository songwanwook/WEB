<?php
    include "../db.php";
    if(isset($_POST['quono'])){
        $output = "";
        $quono = $_POST['quono'];
        $sql = "select * from sendquotation where quono = $quono";
        $result = mysqli_query($connect,$sql);
        if(mysqli_num_rows($result) >= 1){
            while($row = mysqli_fetch_array($result)){
                if($row['state'] == "nonselected"){ $state = "미선택"; }
                else if($row['state'] == "processing"){ $state = "진행중"; }
                else{$state = "완료";}
                $output .= "<tr><td>".$row['specialistname']."(".$row['specialist'].")</td><td>".$row['contents'].
                "</td><td style = 'min-width:90px'>".number_format($row['cost'])."원</td><td style = 'min-width:32px'>".$state."</td><td style = 'min-width:37px'>";
                if($row['state'] == "finish"){
                    $output .= "<span class = 'finished'>완료</span></td></tr>";
                }
                else{
                    $output .= "<form method = 'POST' action = 'selectquotation.php'><input type = 'hidden' name = 'specialist' value = '".$row['specialist']."'/>
                    <input type = 'hidden' name = 'quono' value = '".$quono."'/><button class = 'selectquo'>선택</button></form></td></tr>";
                }
            }
        }
        else{
            $output.="받은 견적 없음.";
        }
        echo $output;
    }
?>