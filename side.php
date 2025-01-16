<?php
    session_start();
?>
<div class = "side">
    <ul class = "flex column sideul">
        <li><a href = "index.php">HOME</a></li>
        <li><a <?php if(!isset($_SESSION["ID"])){ echo 'class = "loginhref"'; }else{ echo "href = 'online.php'"; } ?>>온라인 집들이</a></li>
        <li><a href = "store.php">STORE</a></li>
        <li><a <?php if(!isset($_SESSION["ID"])){ echo 'class = "loginhref"'; }else{ echo "href = 'professional.php'"; } ?>>전문가</a></li>
        <li><a <?php if(!isset($_SESSION["ID"])){ echo 'class = "loginhref"'; }else{ echo "href = 'quotation.php'"; } ?>>시공 견적</a></li>
    </ul>
</div>