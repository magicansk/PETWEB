<?php
require_once("connMysql.php"); //用來引入connMysql的php檔
session_start();
loginOut(); //執行登出
memberData(); //登入會員資料及判斷選單
?>
<HTML>

<HEAD>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <meta name="description" content="24小時寵物用品線上購物，提供您各種商品選擇，狗貓乾糧、罐頭、生食、零食、營養品、外出用品等，貓狗鼠兔應有盡有，培茲提供毛孩「健康幸福快樂」的生活。">
    <TITLE>培茲PETS-首頁:此網頁為非營利用途，以教學目的使用。</TITLE>
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel=stylesheet type="text/css" href="css/rwd.css">
    <link rel=stylesheet type="text/css" href="css/common.css">
    <link rel=stylesheet type="text/css" href="css/index.css">
</HEAD>
<?php include("_header.php"); ?>
<div class="nav2 media-m-hid media-l-center">
    <div class="location media-xl-10">
        <ul class="breadcrumb">
            <li><span>目前位置</span></li>
            <li><span>首頁</span></li>
        </ul>
    </div>
</div>
<div class="content">
    <div class="slick">
        <img src="images/banner3.png" alt="">
        <img src="images/banner1.png" alt="">
        <img src="images/banner2.png" alt="">
        <img src="images/banner4.png" alt="">
        <img src="images/banner5.png" alt="">
    </div>
</div>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="script/slick.min.js"></script>
<script type="text/javascript" src="script/slickset.js"></script>
<?php include("_footer.php"); ?>