<?php
//檢查登入狀態
require_once("connMysql.php"); //用來引入connMysql的php檔
session_start();
loginOut(); //執行登出
memberData(); //登入會員資料及判斷選單

//撈新品上市資料12.15紹寧
function recArrival()
{
    global $db_link;
    $Arrival = "SELECT * FROM arrival ORDER BY id";
    $recArrival = $db_link->query($Arrival);
    while ($row_Arrival = $recArrival->fetch_assoc()) {
        echo "<div class='media-xl-4 media-l-6 media-m-12'>";
        echo "<img src=" . $row_Arrival["image"] . ">";
        echo "<h1>" . $row_Arrival["h1"] . "</h1>";
        echo "<h2>" . $row_Arrival["h2"] . "</h2>";
        echo "<h3>" . $row_Arrival["h3"] . "</h3>";
        echo "<p>" . $row_Arrival["p1"] . "</p>";
        echo "<p class='text'>" . $row_Arrival["p2"] . "</p>";
        echo "</div>";
    }
}
?>
<HTML>

<HEAD>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <meta name="description" content="寵物泡泡潔淨露，嚴選天然精油無毒零污染，讓毛寶貝在家中也可享受芳療SPA。鮮食調味料，萃取天然食材，無鹽無油，無添加防腐劑及抗菌劑，讓毛孩吃更健康。">
    <TITLE>培茲PETS-新品上市</TITLE>
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel=stylesheet type="text/css" href="css/rwd.css">
    <link rel=stylesheet type="text/css" href="css/common.css">
    <link rel=stylesheet type="text/css" href="css/arrival.css">
</HEAD>
<?php include("_header.php"); ?>
<div class="nav2 media-m-hid media-l-center">
    <div class="location media-xl-10">
        <ul class="breadcrumb">
            <li><span>目前位置</span></li>
            <li><span><a href="index.php">首頁</a></span></li>
            <li><span>新品上市</span></li>
        </ul>
    </div>
</div>
<div class="content">
    <?php echo recArrival(); ?>
</div>
<?php include("_footer.php"); ?>