<?php
require_once("connMysql.php");
session_start();
adminJudge(); //判斷是否為admin登入
loginOut(); //執行登出
memberData(); //登入會員資料及判斷選單
admUpdatemember(); //更新會員
recUpdatamember(); //繫結選取會員資料
?>
<html>

<HEAD>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <TITLE>培茲PETS-修改會員資料</TITLE>
    <link rel=stylesheet type="text/css" href="css/rwd.css">
    <link rel=stylesheet type="text/css" href="css/common.css">
    <link rel=stylesheet type="text/css" href="css/member_adminupdate.css">
    <script type="text/javascript" src="script/time.js"></script>
    <script type="text/javascript" src="script/checkForm.js"></script>
</HEAD>

<?php include("_header.php"); ?>
<div class="nav2 media-m-hid media-l-center">
    <div class="location media-xl-10">
        <ul class="breadcrumb">
            <li><span>目前位置</span></li>
            <li><span><a href="index.php">首頁</a></span></li>
            <li><span><a href="member_admin.php">網站會員管理</a></span></li>
            <li><span>修改資料</span></li>
        </ul>
    </div>
</div>

<div>
    <div class="m-adm">
        <div class="m-admbox"><label>帳號維護</label></div>
        <div class="m-admbox"><label>現在時間<div id="clock"></div></label></div>
        <div class="m-admbox"><label><a href="?logout=true">登出系統</a></label></div>
    </div>
    <form action="" method="POST" name="formJoin" id="formJoin" onSubmit="return checkForm();">
        <table class="tbregister">

            <tr>
                <td><input class="textbox" type="text" size="30" placeholder="帳號 <?php echo $row_Updatamember["m_username"]; ?>" name="m_username" id="m_username" disabled="disabled"></td>
            </tr>

            <tr>
                <td><input class="textbox" type="password" size="30" placeholder="密碼" name="m_passwd" id="m_passwd"></td>
            </tr>
            <!-- <tr>
                        <td><input name="m_passwdo" type="hidden" id="m_passwdo" value=""></td> 1212資安問題 1214整組關掉 沒用囉
                    </tr> -->
            <tr>
                <td><input class="textbox" type="password" size="30" placeholder="確認密碼" name="m_passwdrecheck" id="m_passwdrecheck"></td>
            </tr>
            <tr>
                <td class="mark">*若不修改密碼，請不要填寫。若要修改，請輸入密碼二次。</td>
            </tr>

            <tr>
                <td><input class="textbox" type="text" size="30" placeholder="真實姓名" name="m_name" id="m_name" value="<?php echo $row_Updatamember["m_name"]; ?>"></td>
            </tr>

            <tr>
                <td>
                    <span>性別
                        <input class="sex" name="m_sex" id="male" type="radio" value="男" <?php if ($row_Updatamember["m_sex"] == "男") echo "checked"; ?>><label for="male">男</label>
                        <input class="sex" name="m_sex" id="female" type="radio" value="女" <?php if ($row_Updatamember["m_sex"] == "女") echo "checked"; ?>><label for="female">女</label>
                        <input class="sex" name="m_sex" id="privacy" type="radio" value="不公開" <?php if ($row_Updatamember["m_sex"] == "不公開") echo "checked"; ?>><label for="privacy">不公開</label></span>
                </td>
            </tr>

            <tr>
                <td><input class="textbox" type="text" size="30" placeholder="生日" name="m_birthday" id="m_birthday" value="<?php echo $row_Updatamember["m_birthday"]; ?>"></td>
            </tr>
            <tr>
                <td class="mark">*為西元格式YYYY-MM-DD</td>
            </tr>

            <tr>
                <td><input class="textbox" type="text" size="30" placeholder="連絡電話" name="m_phone" id="m_phone" value="<?php echo $row_Updatamember["m_phone"]; ?>"></td>
            </tr>
            <tr>
                <td><input class="textbox" type="text" size="30" placeholder="居住地址" name="m_address" id="m_address" value="<?php echo $row_Updatamember["m_address"]; ?>"></td>
            </tr>
            <tr>
                <td><input class="textbox" type="text" size="30" placeholder="電子信箱" name="m_email" id="m_email" value="<?php echo $row_Updatamember["m_email"]; ?>"></td>
            </tr>
            <tr>
                <td class="mark">*請確認信箱可使用以確保會員權益，例：補寄密碼信</td>
            </tr>
            <tr>
                <td class="join" colspan="2">
                    <input name="m_id" type="hidden" id="m_id" value="<?php echo $row_Updatamember["m_id"]; ?>">
                    <input name="action" type="hidden" id="action" value="update">
                    <input class="submit" name="submit2" type="submit" value="修改資料">
                    <input class="reset" type="reset" value="重設資料">
                </td>
            </tr>
        </table>
    </form>
</div>
<?php include("_footer.php"); ?>
<?php $db_link->close(); ?>