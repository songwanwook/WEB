<?php
    include "../db.php";
    $name = $_GET["name"];
    $sql = "select ID from myhouse where name = '$name'";
    $result = mysqli_query($connect,$sql);
    $findname = "";
    $count = 0;
    if(mysqli_num_rows($result)>=1){
        while($row = mysqli_fetch_array($result)){
            $findname = $findname.$row['ID'];
            $count++;
            if(mysqli_num_rows($result)>=2 && $count < mysqli_num_rows($result)){
                $findname = $findname.",";
            }
        }
        echo json_encode(array("msg"=>$findname));
    }
    else{
        echo json_encode(array("msg"=>"false"));
    }
?>