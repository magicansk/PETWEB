<?php
require_once("connMysql.php");
require_once("mail_password.php");
session_start();
signinJudge(); //判斷沒登入
?>
<HTML>
<HEAD>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"><!--宣告行動裝置RWD-->
    <link rel=stylesheet type="text/css" href="../css/admin_passmail.css">
</HEAD>
<BODY>
<?php if(isset($_GET["mailStats"]) && ($_GET["mailStats"]=="1")){?>
<script>alert('密碼信補寄成功！');window.location.href='index.php';</script>
<?php }?>

<?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
<div class="errDiv">帳號「 <strong><?php echo $_GET["username"];?></strong>」沒有人使用！</div>
<?php }?>
<?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="2")){?><!--驗證Email-11.24紹寧新增-->
<div class="errDiv">信箱「 <strong><?php echo $_GET["usermail"];?></strong>」輸入有誤！</div>
<?php }?>

<div class="content">
    <div class="passmail">
        <form name="form1" method="post" action="">
              <input name="m_username" type="text" class="textbox" id="m_username" placeholder="帳號" size="30"></br>
              <input name="m_email" type="text" class="textbox" id="m_email" placeholder="信箱" size="30"><!--驗證Email-11.24紹寧新增-->
              <p>請輸入您申請的帳號及信箱，系統將自動產生一個十位數的密碼寄到您註冊的信箱。</p>
              <input class="submit" type="submit" name="button" id="button" value="寄密碼信">
        </form>
    </div>
</div>
</BODY>
</HTML>