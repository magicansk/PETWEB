<?php
//<!--套件使用-->
use PHPMailer\PHPMailer;
use PHPMailer\Exception;

require('PHPMailer/Exception.php');
require('PHPMailer/PHPMailer.php');
require('PHPMailer/SMTP.php');

function GetSQLValueStringUPW($theValue, $theType)
{
    switch ($theType) {
        case "string":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_MAGIC_QUOTES) : "";
            break;
        case "int":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_NUMBER_INT) : "";
            break;
        case "email":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_VALIDATE_EMAIL) : "";
            break;
        case "url":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_VALIDATE_URL) : "";
            break;
    }
    return $theValue;
}


function MakePass($length) //產生密碼
{
    $possible = "0123456789!@#$%^&*()_+abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $str = "";
    while (strlen($str) < $length) {
        $str .= substr($possible, rand(0, strlen($possible)), 1);
    }
    return ($str);
}

//檢查是否為會員
global $db_link;
if (isset($_POST["m_username"])) {
    $muser = GetSQLValueStringUPW($_POST["m_username"], 'string');
    $mmail = GetSQLValueStringUPW($_POST["m_email"], 'string');
    //找尋該會員資料
    $query_RecFindUser = "SELECT m_username, m_email FROM memberdata WHERE m_username='{$muser}'";
    $RecFindUser = $db_link->query($query_RecFindUser);
    if ($RecFindUser->num_rows == 0) {
        header("Location: admin_passmail.php?errMsg=1&username={$muser}");
    } else {
        //取出帳號密碼的值
        $row_RecFindUser = $RecFindUser->fetch_assoc();
        $username = $row_RecFindUser["m_username"];
        $usermail = $row_RecFindUser["m_email"];
        if ($_POST["m_email"] !== $usermail) { //驗證Email-11.24紹寧新增
            header("Location: admin_passmail.php?errMsg=2&usermail={$mmail}");
        } else
            //產生新密碼並更新
        $newpasswd = MakePass(10);
        $mpass = password_hash($newpasswd, PASSWORD_DEFAULT);
        $query_update = "UPDATE memberdata SET m_passwd='{$mpass}' WHERE m_username='{$username}'";
        $db_link->query($query_update);
        //補寄密碼信

        $mail = new PHPMailer(); //建立新物件   
        $mail->IsSMTP(); //使用SMTP方式寄信   
        $mail->SMTPAuth = true; //SMTP需要驗證   
        $mail->Host = "smtp.mailtrap.io"; //SMTP主機   
        $mail->Port = 587; //SMTP埠位
        $mail->CharSet = "UTF-8"; //郵件編碼   
        $mail->Username = "2349d01b99651f"; //郵件帳號   
        $mail->Password = "5c92d058cea4aa"; //郵件密碼   
        $mail->From = "Petd@inbox.mailtrap.io"; //寄件者信箱   
        $mail->FromName = "培茲Pets寵物網"; //寄件者姓名   
        $mail->Subject = "培茲Pets寵物網-密碼函！"; //郵件標題   
        $mail->Body = "親愛的".$_POST["m_username"]."您好，
        <br>您的新密碼是：" . $newpasswd . "<br>建議您在登入後置換安全的密碼，感謝您的配合！
        <br>***此為系統信件請勿直接回覆***"; //郵件內容 
        $mail->IsHTML(true); //設定郵件內容為HTML   
        $mail->AddAddress($_POST["m_email"], $_POST["m_username"]); //收件者郵件及名稱   
    
        //<!--判斷是否傳送成功-->  12.14紹寧--更新用js輸出訊息
        if (!$mail->Send()) {
            echo "<script type='text/javascript'>alert('郵件傳送失敗，原因:'" . $mail->ErrorInfo . ");</script>";
        } else {
            echo "<script type='text/javascript'>alert('" . $_POST['m_email'] . "郵件傳送成功');</script>";
        }

    }
}

