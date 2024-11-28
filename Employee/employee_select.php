<?php
    include "../db.php";
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $sql = "select * from employee where id = $id";
        $output = '';
        $result = mysqli_query($connect, $sql);
        $output .= '
            <div>
                <table border = 1>';
                while($row = mysqli_fetch_array($result)){
                    $output .= '<tr>
                        <td width = 20%><label>이름</label></td>
                        <td width = 80%><label>'.$row['name'].'</label></td>
                    </tr>
                    <tr>
                        <td width = 20%><label>주소</label></td>
                        <td width = 80%><label>'.$row['address'].'</label></td>
                    </tr>
                    <tr>
                        <td width = 20%><label>성별</label></td>
                        <td width = 80%><label>'.$row['sex'].'</label></td>
                    </tr>
                    <tr>
                        <td width = 20%><label>직업</label></td>
                        <td width = 80%><label>'.$row['job'].'</label></td>
                    </tr>
                    <tr>
                        <td width = 20%><label>나이</label></td>
                        <td width = 80%><label>'.$row['age'].'</label></td>
                    </tr>';
                }
        $output .= '</table></div>';
        echo $output;
    }
    
?>