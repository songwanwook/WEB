<?php
    $no = $_GET['no'];
    $commentno = $_GET['commentno'];
?>
<script>
const deletealert = confirm("댓글을 삭제하시겠습니까?");
if(deletealert){
    
    location.href = "guest_reply_delete_confirm.php?no=<?php echo $no ?>&commentno=<?php echo $commentno ?>";
}
else{
    history.back();
}
</script>