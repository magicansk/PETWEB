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
    <meta name="description" content="從今天開始，吃好一點，選擇培茲吧!新鮮、天然健康食材，讓家中毛寶貝更健康。">
    <TITLE>培茲PETS-購物說明</TITLE>
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel=stylesheet type="text/css" href="css/rwd.css">
    <link rel=stylesheet type="text/css" href="css/common.css">
    <link rel=stylesheet type="text/css" href="css/guide.css">
</HEAD>
<?php include("_header.php"); ?>
<div class="nav2 media-m-hid media-l-center">
    <div class="location media-xl-10">
        <ul class="breadcrumb">
            <li><span>目前位置</span></li>
            <li><span><a href="index.php">首頁</a></span></li>
            <li><span>購物說明</span></li>
        </ul>
    </div>
</div>
<div class="content">
    <div class="media-m-12 media-l-8 media-xl-4">
        <h1>:::　　購物說明　　:::</h1>
        <h2>☆歡迎來到培茲 Welcome 歡迎來到培茲☆</h2>

        <h3>●　購物流程　●</h3>
        <p class="title">【選購商品】</p>
        <p>選購商品並加入購物車，前往結帳前會再次確認您的購物明細。</p><br>

        <p class="title">【收件人資料】</p>
        請務必留下正確的聯絡資訊，您的大名、連絡電話及地址，以確保您能準時收到商品。<br>
        <br>
        <p class="title">【付款】</p>
        <p>我們提供了多元的付款方式，包含線上刷卡、貨到付款及ATM轉帳付款。</p>
        <br>
        <p class="title">【完成訂單】</p>
        <p>在收到訂單成立後，一般正常情況下，將於一至四個工作天內完成出貨（例假日及缺貨狀況除外）。</p>
        <br>

        <h3>●　運費配送說明　●</h3>
        <li>壹、全館購物滿1500元可享一箱本島免運費配送。</li>
        <li>貳、物流可選擇宅配服務、超商配送服務。</li>
        <li>叁、外島以郵局寄送並依重量、材積大小另收運費。</li>
        <br>

        <h3>●　退換貨說明　●</h3>
        <p>消費者均享有商品到貨七天鑑賞期（包含假日）之權益，鑑賞期並非試用期，若您已拆封商品使用，恕不退費。</p>
        <br>
        <h3>【退貨注意事項】</h3>
        <li>壹、退回商品必須是全新狀態，若有缺少零件或包裝不完整，恕無法退換貨品。</li>
        <li>貳、為避免傳染疾病，接觸型商品恕不接受退換（如睡床、衣服、籠子等）。</li>
        <li>叁、退貨請聯絡客服人員，待商品驗核符合退貨標準，將會馬上退款給您。</li>
    </div>
</div>
<?php include("_footer.php"); ?>