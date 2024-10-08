<?php $no = $_GET['no']; ?>
<script>
const deletealert = confirm("게시글을 삭제하시겠습니까? 삭제하실 경우 이 게시글의 댓글도 모두 삭제됩니다.");
if(deletealert){
location.href = "guest_delete_confirm.php?no=<?php echo $no; ?>";
}
else{
    history.back();
}
</script>