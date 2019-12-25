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
    <TITLE>培茲PETS-配對紀錄</TITLE>
    <link rel="stylesheet" href="css/slick-pair.css">
    <link rel="stylesheet" href="css/slick-theme-pair.css">
    <link rel=stylesheet type="text/css" href="css/rwd.css">
    <link rel=stylesheet type="text/css" href="css/common.css">
    <link rel=stylesheet type="text/css" href="css/paired_result.css">
</HEAD>


<?php include("_header.php"); ?>

<div class="nav2 media-m-hid media-l-center">
    <div class="location media-xl-10">
        <ul class="breadcrumb">
            <li><span>目前位置</span></li>
            <li><span><a href="index.php">首頁</a></span></li>
            <li><span><a href="paired.php">配對系統</a></span></li>
            <li><span>配對結果</span></li>
        </ul>
    </div>
</div>

<div class="content">
    <div class="item media-xl-2 media-l-5 media-m-12">
        <a href="paired_notback.php">
            <div class="img">
                <img src="images/pair/time.png" alt="">
            </div>
            <div class="text">
                等待回應
            </div>
        </a>
    </div>
    <div class="item media-xl-2 media-l-5 media-m-12">
        <a href="paired_receive.php">
            <div class="img">
                <img src="images/pair/receive.png" alt="">
            </div>

            <div class="text">
                收到邀請
            </div>
        </a>
    </div>
    <div class="item media-xl-2 media-l-5 media-m-12">
        <a href="paired_success.php">
            <div class="img">
                <img src="images/pair/success.png" alt="">
            </div>
            <div class="text">
                配對成功
            </div>
        </a>
    </div>
    <div class="item media-xl-2 media-l-5 media-m-12">
        <a href="paired_failure.php">
            <div class="img">
                <img src="images/pair/failure.png" alt="">
            </div>
            <div class="text">
                配對失敗
            </div>
        </a>
    </div>
</div>

<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="script/slick.min.js"></script>
<script type="text/javascript" src="script/slickset-pair.js"></script>
<?php include("_footer.php"); ?>