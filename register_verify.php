<?php
session_start();
require_once("connMysql.php");
require_once("mail_validation.php");

//12.14紹寧--信箱驗證碼
if (isset($_POST["m_verification"]) && $_POST["m_verification"] != "") {
    if ($_POST["m_verification"] != $_SESSION["registerVerify"]) {
        echo '<script type="text/javascript">alert("驗證碼填寫錯誤");</script>';
    } else {
        $_SESSION["Verify"] = $_POST["m_verification"];
        header("Location: register.php"); //註冊頁
    }
}

?>
<HTML>

<HEAD>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <TITLE>會員註冊驗證信箱</TITLE>
    <link rel=stylesheet type="text/css" href="css/rwd.css">
    <link rel=stylesheet type="text/css" href="css/common.css">
    <link rel=stylesheet type="text/css" href="css/register_verify.css">
    <script language="javascript">
        function checkForm() {
            if (document.formsend.m_email.value == "") {
                alert("請填寫電子郵件!");
                document.formsend.m_email.focus();
                return false;
            }
            if (!checkmail(document.formsend.m_email)) {
                document.formsend.m_email.focus();
                return false;
            }
            return confirm('確定送出嗎？');
        }

        function checkmail(myEmail) {
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (filter.test(myEmail.value)) {
                return true;
            }
            alert("電子郵件格式不正確");
            return false;
        }

        function checkForm2() {
            if (document.formferify.m_verification.value == "") {
                alert("請填寫驗證碼!");
                document.formferify.m_verification.focus();
                return false;
            }
        }
    </script>
</HEAD>

<BODY>
    <div id="content">
        <form action="" method="POST" name="formsend" id="formsend" onSubmit="return checkForm();">
            <table class="tbregister">
                <tr>
                    <td><input class="textbox" type="text" size="30" placeholder="電子信箱" name="m_email" id="m_email" value="<?php if (isset($_SESSION["m_email"])) {
                                                                                                                                echo $_SESSION["m_email"];
                                                                                                                            } ?>"></td>
                </tr>
                <tr>
                    <td class="mark">*系統會寄一封驗證碼信函到您的信箱，驗證後才能註冊</td>
                </tr>
                <tr>
                    <td class="join">
                        <input class="submit" name="submit2" type="submit" value="寄出驗證碼">
                    </td>
                </tr>
            </table>
        </form>
        <form action="" method="POST" name="formferify" id="formferify" onSubmit="return checkForm2();">
            <table class="tbregister">
                <td><input class="textbox" type="text" size="30" placeholder="請輸入註冊驗證碼" name="m_verification" id="m_verification"></td>
                </tr>
                <tr>
                    <td class="join" colspan="2">
                        <input name="action" type="hidden" id="action" value="join">
                        <input class="submit" name="submit2" type="submit" value="驗證">
                        <input class="reset" type="reset" value="重設資料">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    </div>
</BODY>

</HTML>