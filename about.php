<?php
//檢查登入狀態
require_once("connMysql.php"); //用來引入connMysql的php檔
session_start();
loginOut(); //執行登出
memberData(); //登入會員資料及判斷選單
?>
<HTML>

<HEAD>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <meta name="description" content="我們團隊希望能夠找出一個讓毛孩與社會一起幸福生活的方案，寵愛動物的同時也增進人與社會之間的聯繫，讓社會更多溫暖。">
    <TITLE>培茲PETS-關於我們</TITLE>
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel=stylesheet type="text/css" href="css/rwd.css">
    <link rel=stylesheet type="text/css" href="css/common.css">
    <link rel=stylesheet type="text/css" href="css/about.css">
</HEAD>
<?php include("_header.php"); ?>
<div class="nav2 media-m-hid media-l-center">
    <div class="location media-xl-10">
        <ul class="breadcrumb">
            <li><span>目前位置</span></li>
            <li><span><a href="index.php">首頁</a></span></li>
            <li><span>關於培茲</span></li>
        </ul>
    </div>
</div>
<div class="content">
    <div class="media-m-12 media-l-8 media-xl-5">
        <h1>:::　歡迎大家來到培茲 Pets　:::</h1>
        <h3>☆歡迎來到培茲 Welcome 歡迎來到培茲☆</h3>
        <p>「培茲」一詞源自於英文「Pets（寵物）」的諧音，我們的團隊希望能夠在這個時代的浪潮中，找出一個讓毛孩子們與社會可以進步共存的生活方案，為此我們建立了這個提供多元服務的購物網站，給大家一個可以安心為毛孩子們購物的地方；我們也提供許多異業的資訊讓大家參考，並提供平台給予喜愛互動的家長們一個良好的互動的空間，在寵愛動物的同時也增進人與社會之間的聯繫，讓毛小孩們與主人都能過上更高品質的生活，也讓期待能讓整體大環境更加友善！</p>
    </div>
</div>
<?php include("_footer.php"); ?>