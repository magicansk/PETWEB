<?php
session_start();
require_once("connMysql.php");
register(); //註冊

//12.14紹寧--無驗證跳轉
if(!isset($_SESSION["Verify"])){
	header("Location: register_verify.php"); //註冊頁
}
if($_SESSION["Verify"] != $_SESSION["registerVerify"]){
	header("Location: register_verify.php"); //註冊頁
}
?>
<HTML>

<HEAD>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
	<TITLE>會員註冊</TITLE>
	<link rel=stylesheet type="text/css" href="css/rwd.css">
	<link rel=stylesheet type="text/css" href="css/register.css">
	<script type="text/javascript" src="script/checkRegister.js"></script>
</HEAD>

<BODY>
	<?php if (isset($_GET["loginStats"]) && ($_GET["loginStats"] == "1")) { ?>
		<script language="javascript">
			alert('會員新增成功\n請用申請的帳號密碼登入。');
			top.location.href = 'login.php';
		</script>
	<?php } ?>
	<div id="content">
		<?php if (isset($_GET["errMsg"]) && ($_GET["errMsg"] == "1")) { ?>
			<div class="contentbox errDiv">帳號 <?php echo $_GET["username"]; ?> 已經有人使用！</div>
		<?php } ?>
		<form action="" method="POST" name="formJoin" id="formJoin" onSubmit="return checkForm();">
			<table class="tbregister">
				<tr>
					<td><input class="textbox" type="text" size="30" placeholder="帳號" name="m_username" id="m_username"></td>
				</tr>
				<tr>
					<td class="mark">*第一個字元為小寫英文，長度為5到12個字符，不可用特殊符號</td>
				</tr>
				<tr>
					<td><input class="textbox" type="password" size="30" placeholder="密碼" name="m_passwd" id="m_passwd"></td>
				</tr>
				<tr>
					<td class="mark">*需包含英文+數字，長度為8到12個字符，不可用空白及雙引號</td>
				</tr>
				<tr>
					<td><input class="textbox" type="password" size="30" placeholder="確認密碼" name="m_passwdrecheck" id="m_passwdrecheck"></td>
				</tr>
				<tr>
					<td><input class="textbox" type="text" size="30" placeholder="真實姓名" name="m_name" id="m_name"></td>
				</tr>
				<tr>
					<td>
						<span class="sex">性別
							<input class="sex" name="m_sex" id="male" type="radio" value="男" checked><label for="male">男</label>
							<input class="sex" name="m_sex" id="female" type="radio" value="女"><label for="female">女</label>
							<input class="sex" name="m_sex" id="privacy" type="radio" value="不公開"><label for="privacy">不公開</label></span>
					</td>
				</tr>
				<tr>
					<td>
						<span class="date">生日
							<input class="date" type="date" size="30" placeholder="生日" name="m_birthday" id="m_birthday" value="<?php $getDate = date("Y-m-d");
																																echo $getDate; ?>"></span>
					</td>
				</tr>
				<tr>
					<td><input class="textbox" type="text" size="30" placeholder="連絡電話" name="m_phone" id="m_phone"></td>
				</tr>
				<tr>
					<td><input class="textbox" type="text" size="30" placeholder="居住地址" name="m_address" id="m_address"></td>
				</tr>
				<tr>
					<td><input class="textbox" type="text" size="30" placeholder="電子信箱" name="m_email" id="m_email" value="<?php echo $_SESSION["m_email"]?>"></td>
				</tr>
				<tr>
					<td class="mark">*請確認信箱可使用以確保會員權益，例：補寄密碼信</td>
				</tr>
				<tr>
					<td class="join" colspan="2">
						<input name="action" type="hidden" id="action" value="join">
						<input class="submit" name="submit2" type="submit" value="加入">
						<input class="reset" type="reset" value="重設資料">
					</td>
				</tr>
				<!--<input type="button" name="Submit" value="回上一頁" onClick="window.history.back();"></td>-->
			</table>
		</form>
	</div>
	</div>
</BODY>

</HTML>