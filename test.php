<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src = "js/jquery-1.10.2.js"></script>
</head>
<body>
    <input type = "text" name = "ID" id = "ID"></input><button class = "OK">OK</button>
</body>
<script>
    function CreateData(){
        var sendData = {id:$('#ID').val()}
        return sendData;
    }
    $(".OK").click(function(){
        $.ajax({
            url:"idcheck.php",type:"get",dataType:"JSON",data:CreateData(),success:function(data){
                alert("성공");
            },error:function(request, status, error){
                console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
            }
        });
    });
</script>
</html>