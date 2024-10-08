<?php
    session_start();
    if(!isset($_SESSION['session_id'])){
        echo json_encode(array("result"=>"f","msg"=>"로그인 해야 이용 가능합니다."));
        exit;
    }
    else{
        echo json_encode(array("result"=>"success","msg" => ""));
        exit;
    }
?>