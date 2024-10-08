<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .footer{
            position:absolute;
            bottom:0;
            height:60px;
            padding:20px;
            background-color:rgb(243,239,236);
            border-bottom:1px solid brown;
            width:100%;
            display:flex;
            justify-content:space-between;
        }
        .footer > img{
            margin-left:70px;
        }
        ul{
            list-style:none;
            display:flex;
            padding-right:100px;
            font-size:12px;
        }
        .border{
            border-right:1px solid black;
            margin:10px 0px;
        }
    </style>
</head>
<body>
    <div class = "footer">
        <img src = "src/F_LOGO.gif">
        <ul>
            <li>이용약관</li><span class = "border"></span>
            <li>개인정보처리방침</li><span class = "border"></span>
            <li>사이트맵</li>
        </ul>
    </div>
</body>
</html>