<?php
    include "../db.php";
    $name = mysqli_real_escape_string($connect,$_POST['name']);
    $address = mysqli_real_escape_string($connect,$_POST['address']);
    $gender = mysqli_real_escape_string($connect,$_POST['gender']);
    $job = mysqli_real_escape_string($connect,$_POST['job']);
    $age = $_POST['age'];
    $output = '';
    if($_POST['id']!=""){//수정
        $sql = "update employee set name = '$name', address = '$address', sex = '$gender', job = '$job', age = $age where id = ".$_POST['id'];
        $msg = "수정 완료";
    }
    else{
        $sql = "insert into employee(name,address,sex,job,age) values('$name','$address','$gender','$job','$age')";
        $msg = "삽입 완료";
    }
    if(mysqli_query($connect, $sql)){
        $output .= '<span>'.$msg.'</span>';
        $sql2 = "select * from employee order by id desc";
        $result = mysqli_query($connect, $sql2);
        $output .= '<table border = 1><tr>
            <th width = "70%">이름</th>
            <th width = "15%">보기</th>
            <th width = "15%">수정</th></tr>';
        while($row = mysqli_fetch_array($result)){
            $output .= '<tr><td>'.$row['name'].'</td>
            <td align = "center"><input type = "button" name = "detail" value = "자세히" id = "'.$row['id'].'" class = "detail"></td>
            <td align = "center"><input type = "button" name = "update" value = "수정" id = "'.$row['id'].'" class = "update"></td></tr>';
        }
        $output .= '</table>';
    }
    echo $output;
    $_POST['id'] == "";
?>