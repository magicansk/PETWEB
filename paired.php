<?php

/*這是點了之後會跑出隨機配到結果頁*/
require_once("connMysql.php"); //用來引入connMysql的php檔
session_start();
loginOut(); //執行登出
memberData(); //登入會員資料及判斷選單
loginJudge(); //判斷有登入

?>

<HTML>

<HEAD>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <TITLE>培茲PETS-配對系統</TITLE>
    <link rel="stylesheet" href="css/slick-pair.css">
    <link rel="stylesheet" href="css/slick-theme-pair.css">
    <link rel=stylesheet type="text/css" href="css/rwd.css">
    <link rel=stylesheet type="text/css" href="css/common.css">
    <link rel=stylesheet type="text/css" href="css/paired.css">
</HEAD>

<body>
    <?php include("_header.php"); ?>

    <div class="nav2 media-m-hid media-l-center">
        <div class="location media-xl-10">
            <ul class="breadcrumb">
                <li><span>目前位置</span></li>
                <li><span><a href="index.php">首頁</a></span></li>
                <li><span>配對系統</span></li>
            </ul>
        </div>
    </div>

    <div class="content">
        <div class="item1 media-m-3 media-l-3 media-xl-2">
            <a href="pet_mypet.php">
                <img src="images/pair/mypet.png" alt="">我的毛孩
            </a>
        </div>
        <div class="item2 media-m-3 media-l-3 media-xl-2">
            <a href="paired_ing.php">
                <img src="images/pair/pair.png" alt="">每日配對
            </a>
        </div>
        <div class="item3 media-m-3 media-l-3 media-xl-2">
            <a href="paired_result.php">
                <img src="images/pair/result.png" alt="">配對紀錄
            </a>
        </div>
    </div>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="script/slick.min.js"></script>
    <script type="text/javascript" src="script/slickset-pair.js"></script>
    <?php include("_footer.php"); ?>