<?php
    include "../db.php";
    $search = $_POST['search'];
    if($search == "" || trim($search) == ""){
        ?><script>alert("검색어를 입력하세요.");history.back();</script><?php
        exit;
    }
    $option = $_POST['option'];
    $sql = "";
    $count = "";
    switch($option){
        case "subject":
            $subject = $search;
            ?><script>location.href = "board.php?subject=<?php echo $subject; ?>";</script><?php
            break;//제목
        case "id":
            $id = $search;
            ?><script>location.href = "board.php?id=<?php echo $id; ?>";</script><?php
            break;//ID
        case "name":
            $name = $search;
            ?><script>location.href = "board.php?name=<?php echo $name; ?>";</script><?php
            break;//이름
        case "contents":
            $contents = $search;
            ?><script>location.href = "board.php?contents=<?php echo $contents; ?>";</script><?php
            break;//내용
    }
?>