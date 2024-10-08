<?php
    $filename = $_GET['filename'];
    $filepath = $_SERVER['DOCUMENT_ROOT'].'/손관욱/AJAX/PHP/download/'.$filename;
    echo $filepath;
    if(!is_file($filepath)||!file_exists($filepath)){
        ?><script>alert("파일이 존재하지 않습니다.");history.back();</script><?php
        exit;
    }
    $path_parts = pathinfo($filepath);
    $file_name = $path_parts['basename'];
    $file_size = filesize($filepath);
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=".$file_name."");
    header("Content-Length: ".$file_size);
    header("Pragma: no-cache");
    header("Expires: 0");
    $fp = fopen($filepath,"r");
    fpassthru($fp);
    fclose($fp);
?>