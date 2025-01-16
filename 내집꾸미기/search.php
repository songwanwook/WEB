<?php
    include "../db.php";
    $keyword = $_POST['keyword'];
    $option = $_POST['option'];
    if($keyword == "" || trim($keyword) == ""){
        ?><script>alert("검색어를 입력하세요.");history.back();</script><?php
        exit;
    }
    else if($option == "none"){
        ?><script>alert("검색 옵션을 선택하세요.");history.back();</script><?php
        exit;
    }
    else{
        switch($option){//검색 옵션
            case "subject":
                $subject = $keyword;
                ?><script>location.href = "online.php?subject=<?php echo $subject; ?>";</script><?php
                break;//제목
            case "nameorID":
                $nameorID = $keyword;
                ?><script>location.href = "online.php?nameorID=<?php echo $nameorID; ?>";</script><?php
                break;//ID 또는 이름
            case "contents":
                $contents = $keyword;
                ?><script>location.href = "online.php?contents=<?php echo $contents; ?>";</script><?php
                break;//내용
        }
    }
?>

