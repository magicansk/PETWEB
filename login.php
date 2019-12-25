<?php
require_once("connMysql.php");
session_start();
signinJudge(); //判斷未登入
?>
<HTML>

<HEAD>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <TITLE>培茲PETS-登入/註冊</TITLE>
    <link rel=stylesheet type="text/css" href="css/rwd.css">
    <link rel=stylesheet type="text/css" href="css/common.css">
    <link rel=stylesheet type="text/css" href="css/login.css">
    <script language="javascript" type="text/javascript">
        function iframeLoad() {
            document.getElementById("myiframe").height = 0;
            document.getElementById("myiframe").height = document.getElementById("myiframe").contentWindow.document.body.scrollHeight;
        } //抓iframe高度用
        function changesrc(link) {
            document.getElementById("myiframe").src = link;
        } //切換視窗用
    </script>
</HEAD>
<?php include("_header.php"); ?>
<div class="nav2 media-m-hid media-l-center">
    <div class="location media-xl-10">
        <ul class="breadcrumb">
            <li><span>目前位置</span></li>
            <li><span><a href="index.php">首頁</a></span></li>
            <li><span>登入/註冊</span></li>
        </ul>
    </div>
</div>
<div class="login">
    <div class="loginbtm">
        <input id="register" name="login" type="radio" onclick="changesrc('register_verify.php')"><label for="register">註冊</label>
        <input id="signin" name="login" type="radio" onclick="changesrc('signin.php')" checked><label for="signin">登入</label>
    </div>
</div>
<div class="content">
    <div class="contentbox">
        <iframe id="myiframe" name="myiframe" src="signin.php" width="100%" frameborder="0" scrolling="no" onload="iframeLoad();"></iframe>
    </div>
</div>
<?php include("_footer.php"); ?>