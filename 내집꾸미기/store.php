<!DOCTYPE html>
<html lang="en">
<head>
    <script src = "js/jquery-1.10.2.js"></script>
    <script src = "js/jquery-3.4.1.min.js"></script>
    <script src = "js/jquery-ui.min.js"></script>
    <script src = "js/store.js"></script>
    <script src = "js/script.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STORE</title>
</head>
<body>
    <?php include "side.php"; include "header.php"; include "info.php";  ?>
    <div class = "bg width100">
    <button class = <?php if(!isset($_SESSION["ID"])) echo "loginplease"; else echo "purchaselist";
    //로그인 여부에따라 버튼 클래스명을 다르게 하여 로그인을 유도 ?>>구매 목록</button>
    <div class = "search flex">
        <input type = "text" placeholder = "상품명을 검색하세요" class = "keyword" autocomplete = "off"></input>
        <button class = "searchstore">검색</button>
        <button class = "showall">전체보기</button>
    </div>
    <div class = "store flex width100">

    </div>
    </div>
    <?php if(isset($_SESSION["ID"])) { ?>
    <div class = "storebox"><!--로그인 안했을때 비활성화.-->
        장바구니 0개
    </div>
    <?php } ?>
    <div class = "boxmodal">
        <div class = "box">
        <p class = "totalcost">결제 금액 : 0원</p>
        <button class = "close">X</button>
            <table class = "productlist">
                <thead>
                    <tr>
                        <th class = "productinfo">상품정보</th>
                        <th class = "priceover680">가격</th>
                        <th>수량</th>
                        <th>합계</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class = "tbody">

                </tbody>
            </table>
            <button class = "purchase">구매</button>
        </div>
        <div class = "purchaseokmodal flex column">
            <h3>위 상품을 구매 하시겠습니까?</h3>
            <table>
            <?php $ID = $_SESSION['ID']; echo "<tr><td style = 'width:20%'>구매자 : </td><td>".$name."(".$ID.")</td></tr>"; ?>
            <tr><td style = "vertical-align:text-top">발송 주소 : </td><td><textarea class = "location" required></textarea></td></tr>
            </table>
            <p class = "totalcost">결제 금액 : 0원</p>
            <div class = "flex"><button class = "purchaseok">구매</button><button class = "pokcancel">취소</button></div>
            <button class = "pokclose">X</button>
            <?php echo "<input type = 'hidden' class = 'myid' value = $ID>" ?>
        </div>
    </div>
    <div class = "purchasemodal">
        <div class = "box">
            <button class = "close">X</button>
            <table class = "purchasetable">
                <?php echo $name."님의 구매 목록"; ?>
                <thead>
                    <tr>
                        <th>상품정보</th>
                        <th>브랜드</th>
                        <th>상품명</th>
                        <th>가격</th>
                        <th class = "getpurchasecount">수량</th>
                        <th>합계</th>
                        <th class = "purchasetime">구매일시</th>
                        <th class = "locateth">발송 주소</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include "../db.php";
                        $sql = "select * from purchase where ID = '$ID'";
                        $result = mysqli_query($connect,$sql);
                        while($row = mysqli_fetch_array($result)){
                            echo "<tr><td><img src = '".$row['productimg']."' class = 'purchaseimg'/></td><td>".$row['brand']."</td><td>".$row['productname']."</td>
                            <td>".$row['price']."</td><td>".$row['count']."</td><td class = 'sum'>".$row['sum']."</td><td class = 'purchasetime'>".$row['purchasetime'].
                            "</td><td class = 'locateth'>".$row['location']."</td><td class = 'moreinfo'>
                            <button class = 'moreinfobutton' img = ".$row['productimg']." brand = ".$row['brand']." pname = ".$row['productname']."
                            price = ".$row['price']." count = ".$row['count']." sum = ".$row['sum']." ptime = ".$row['purchasetime']." location = '".$row['location']."'>
                            MORE</button></td></tr>";
                        }
                    ?>
                </tbody>
            </table>
            <div class = "sumdiv flex column">
                <?php echo "<p>".$name."님의 최종 결제 금액은</p>"; ?>
                <span class = "getsum"></span>
            </div>
        </div>
    </div>
    <div class = "moreinfobox">
        <div class = 'pinfomoreview flex column'>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>