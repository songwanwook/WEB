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
    <title>시공 견적</title>
    <script src = "js/jquery-1.10.2.js"></script>
    <script src = "js/script.js"></script>
    <script src = "js/quotation.js"></script>
    <link href = "css/professionalcss.css" rel = "stylesheet">
</head>
<body>
    <?php
        include "../db.php";
        include "side.php";
        include "header.php";
        include "info.php";
        $ID = $_SESSION['ID'];
    ?>
    <div class = "bg width100 quotation">
        <h1>시공 견적</h1>
        <div class = "quotationlist">
            <div class = "flex" style = "justify-content:space-between"><h1>시공 견적 요청 리스트</h1><button class = "call">견적 요청</button></div>
            <table class = "quotationtable width100 textcenter">
                <thead>
                    <tr><td>요청 번호</td><td>요청 회원</td><td class = "over680detail">시공일</td><td class = "over680detail">시공 내용</td>
                    <td class = "over680detail">시공 상태</td><td class = "over680detail">견적 갯수</td>
                    <td class = "under680"><!--680px미만 견적 자세히--></td><td><!--견적 보기 또는 보내기--></td></tr>
                </thead>
                <tbody>
                    <?php $sql = "select * from quotation"; $result = mysqli_query($connect,$sql); while($row = mysqli_fetch_array($result)){
                    $state = ""; $no = $row['no']; if($row['state'] == "processing"){ $state = "진행 중";}else{ $state = "완료";}
                    echo "<tr><td>".$no."</td><td>".$row['name']."(".$row['ID'].")"."</td><td class = 'over680detail'>".$row["date"]."</td>
                    <td class = 'over680detail'>".$row['contents']."</td><td class = 'over680detail'>".$state."</td>
                    <td class = 'over680detail'>".$row['quocount']."</td><td class = 'under680'>
                    <button class = 'quotationdetail' no = '".$row['no']."' name = '".$row['name']."' id = '".$row['ID']."' date = '".$row['date']."'
                     contents = '".$row['contents']."' state = ".$state." quocount = '".$row['quocount']."'>자세히</button></td><td>";
                    if($ID == $row['ID']){
                        echo "<button class = 'quobutton viewquo' value = '".$row['no']."'>견적 보기</button>";
                    }
                    $sql = "select * from professional where professionalID = '$ID'";//전문가 여부
                    $IDresult = mysqli_query($connect,$sql);
                    if(mysqli_num_rows($IDresult) != 0 && $row['state'] == "processing"){//전문가 여부, 진행중
                        $sql = "select * from sendquotation where specialist = '$ID' and quono = $no";
                        $quonoresult = mysqli_query($connect,$sql);
                        if(mysqli_num_rows($quonoresult) >= 1){
                            while($quorow = mysqli_fetch_array($quonoresult)){
                                if($no == $quorow['quono']){//보낸 견적
                                    echo "<span class = 'sentquo'>보낸 견적</span>";
                                }
                                else{//안보낸 견적
                                    echo "<button class = 'quobutton sendquo' value = '".$row['no']."'>견적 보내기</button>";
                                }
                            }
                        }
                        else{//안보낸 견적
                            echo "<button class = 'quobutton sendquo' value = '".$row['no']."'>견적 보내기</button>";
                        }
                    }
                    else if(mysqli_num_rows($IDresult) != 0 && $row['state'] == "finish"){
                        echo "<span class = 'sentquo'>완료된 견적</span>";
                    }
                        echo "</td></tr>";
                    } ?>
                </tbody>
            </table>
        </div>
        <?php $IDsql = "select * from professional where professionalID = '$ID'"; $IDresult = mysqli_query($connect,$IDsql);
        if(mysqli_num_rows($IDresult) != 0){ $row = mysqli_fetch_array($IDresult); ?>
        <?php echo "<h1>".$row['professionalNAME']."의 보낸 견적 리스트</h1>"; ?>
        <div>
            <table class = "sentquotation textcenter">
                <?php $sql = "select * from sendquotation where specialist = '$ID' order by quono"; $result = mysqli_query($connect,$sql);
                    if(mysqli_num_rows($result) >= 1){ ?>
                        <thead><tr><th>견적 번호</th><th class = 'over600detail'>견적 비용</th><th class = 'over600detail'>견적 내용</th>
                        <td class = "under600"><!--600px미만 견적 자세히--></td><th>상태</th></tr></thead>
                        <tbody>
                        <?php
                        while($row = mysqli_fetch_array($result)){
                            if($row['state'] == "nonselected"){ $state = "미선택"; }
                            else if($row['state'] == "processing"){ $state = "진행중"; }
                            else{$state = "완료";}
                            echo "<tr><td>".$row['quono']."</td><td class = 'over600detail'>".number_format($row['cost'])."원</td>
                            <td class = 'over600detail'>".$row['contents']."</td><td class = 'under600'>
                            <button class = 'sentquotationdetail' no = '".$row['quono']."' cost = '".$row['cost']."' contents = '".$row['contents']."' state = ".$state.">
                            자세히</button></td><td>".$state."</td></tr>";
                        }
                    }
                    else{
                        echo "보낸 견적 없음.";
                    }
                ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </div>
    <div class = "QuotationModal">
        <form class = "requestquotation flex column" method = "POST" action = "request.php" novalidate>
            <button type = "button" class = "close">X</button>
            <h1>견적 요청</h1>
            <span>견적 요청자 : <?php include "info.php"; echo $name."(".$ID.")" ?>
            <input type = "hidden" name = "ID" value = "<?php echo $ID; ?>"><input type = "hidden" name = "name" value = "<?php echo $name; ?>"></span>
            <span>견적 날짜 : <input type = "date" name = "date" class = "date" required ="required"></span>
            <textarea placeholder = "견적 내용을 입력하세요." name = "contents" class = "quotationcontents" required></textarea>
            <span class = "flex"><input type = "submit" value = "견적 요청하기" class = "callquotation"/><button type = "button" class = "cancelquotation">취소</button></span>
        </form>
        <form class = "sendquotation flex column" method = "POST" action = "sendquotation.php" novalidate>
            <button type = "button" class = "close">X</button>
            <h1>견적 보내기</h1>
            <input type = "hidden" class = "quono" name = "quono"/>
            <span>견적 가격 : <input type = "number" name = "cost" class = "costinput" required/>원</span>
            <textarea placeholder = "견적 내용을 입력하세요." name = "contents" class = "sendquotationcontents" required></textarea>
            <span><input type = "submit" value = "견적 보내기" class = "send"/></span>
        </form>
        <div class = "quotationview">
            <button type = "button" class = "viewclose">X</button>
            <h1>견적 모음</h1>
            <table>
                <tbody class = "tbody">

                </tbody>
            </table>

        </div>
        <div class = "quotationdetailview">
            <button type = "button" class = "viewclose">X</button>
            <div class = "flex column">

            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>