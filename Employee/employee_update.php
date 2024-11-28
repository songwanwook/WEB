<?php
    include "../db.php";
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $sql = "select * from employee where id = '$id'";
        $result = mysqli_query($connect, $sql);
        while($row = mysqli_fetch_array($result)){
            $output['id'] = $row['id'];
            $output['name'] = $row['name'];
            $output['address'] = $row['address'];
            $output['gender'] = $row['sex'];
            $output['job'] = $row['job'];
            $output['age'] = $row['age'];
        }
        echo json_encode($output);
    }
?>