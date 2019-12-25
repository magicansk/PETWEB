<?php
require_once("connMysql.php");
session_start();
login(); //登入
?>
<HTML>

<HEAD>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
	<TITLE>登入</TITLE>
	<link rel=stylesheet type="text/css" href="css/rwd.css">
	<link rel=stylesheet type="text/css" href="css/signin.css">
</HEAD>

<BODY>
	<div class="content">
		<div class="contentbox">
			<form name="form1" method="post" action="">
				<table class="tbsignin">
					<tr>
						<td colspan="2"><input class="textbox" type="text" size="30" placeholder="帳號" name="username" id="username" value="<?php if (isset($_COOKIE["remUser"]) && ($_COOKIE["remUser"] != "")) echo $_COOKIE["remUser"]; ?>"></td>
					</tr>
					<tr>
						<td colspan="2"><input class="textbox" type="password" size="30" placeholder="密碼" name="passwd" id="passwd" value="<?php if (isset($_COOKIE["remPass"]) && ($_COOKIE["remPass"] != "")) echo $_COOKIE["remPass"]; ?>"></td>
					</tr>
					<tr>
						<!-- 1212增加  點圖可以重整 onClick="this.src='showpic.php?nocache='+Math.random()-->
						<td colspan="2" class="test"><img src="./showpic.php" onClick="this.src='showpic.php?nocache='+Math.random()"><input class="test" type="text" name="anscheck" size="15" placeholder="請輸入左側驗證碼"></td>
					</tr>
					<?php if (isset($_GET["errMsg"]) && ($_GET["errMsg"] == "1")) { ?>
						<tr>
							<td colspan="2" class="err">帳號不存在或登入密碼錯誤!!</td>
						</tr>
					<?php } ?>
					<?php if (isset($_GET["errMsg"]) && ($_GET["errMsg"] == "2")) { ?>
						<tr>
							<td colspan="2" class="err">驗證碼輸入錯誤!!</td>
						</tr>
					<?php } ?>
					<tr>
						<td class="rpasswd"><input class="rpbox" name="rememberme" type="checkbox" id="rememberme" value="true">記住帳號密碼</td>
						<td class="fpasswd"><a href="admin_passmail.php">忘記密碼？</a></td>
					</tr>
					<tr>
						<td class="submit" colspan="2">
							<input class="submit" type="submit" name="button" id="button" value="登入">
							<input class="fabk" type="button" value="Facebook登入">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</BODY>

</HTML>
<?php
$db_link->close();
?>