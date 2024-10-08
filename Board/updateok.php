<?php
    include "db.php";
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $contents = $_POST['contents'];
        if($title==NULL||$contents==NULL){
            ?>
                <script>
                    alert("모든 내용을 작성하시기 바랍니다.");
                    history.back();
                </script>
            <?php
            exit;//이거 없으면 밑에꺼 실행됨.
        }
        $sql = "update ajax_board set title = '$title', contents = '$contents' where no = $id";
        if(mysqli_query($connect,$sql)){
            ?>
                <script>
                    alert("게시글을 수정하였습니다.");
                    location.href = "view.php?no=<?php echo $id; ?>";
                </script>
            <?php
        }
    }
    
?>