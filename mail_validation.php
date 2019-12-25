<?php
//<!--套件使用-->
use PHPMailer\PHPMailer;
use PHPMailer\Exception;

require('PHPMailer/Exception.php');
require('PHPMailer/PHPMailer.php');
require('PHPMailer/SMTP.php');

set_time_limit(1800); //30分鐘存活

//<!--創造一個六碼亂數驗證，將0、o、O拿掉以防混淆-->
function MakePass($length){
    $possible="123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ";
    $str="";
    while(strlen($str)<$length){
        $str .= substr($possible,rand(0,strlen($possible)),1);
    }
    return($str);
}

if(isset($_POST["m_email"])){

global $code; //12.14紹寧
$code = MakePass(6);//系統創造的亂數

$mail= new PHPMailer(); //建立新物件   
$mail->IsSMTP(); //使用SMTP方式寄信   
$mail->SMTPAuth = true; //SMTP需要驗證   
$mail->Host = "smtp.mailtrap.io"; //SMTP主機   
$mail->Port = 587; //SMTP埠位
$mail->CharSet = "UTF-8"; //郵件編碼   
$mail->Username = "2349d01b99651f"; //郵件帳號   
$mail->Password = "5c92d058cea4aa"; //郵件密碼   
$mail->From = "Petd@inbox.mailtrap.io"; //寄件者信箱   
$mail->FromName = "培茲Pets寵物網"; //寄件者姓名   
$mail->Subject = "來自培茲的歡迎信！"; //郵件標題   
$mail->Body = "親愛的會員您好，
    <br>歡迎您加入培茲的大家庭，您的驗證碼是：".$code."<br>請在30分鐘內輸入回到註冊頁面驗證，感謝您的配合！
    <br>***此為系統信件請勿直接回覆***"; //郵件內容 
$mail->IsHTML(true); //設定郵件內容為HTML   
$mail->AddAddress($_POST["m_email"], "新會員"); //收件者郵件及名稱   

$_SESSION["m_email"] = $_POST["m_email"]; //12.14紹寧
$_SESSION["registerVerify"] = $code; //12.14紹寧

//<!--判斷是否傳送成功-->  12.14紹寧--更新用js輸出訊息
if(!$mail->Send()) { 
echo "<script type='text/javascript'>alert('郵件傳送失敗，原因:'" . $mail->ErrorInfo . ");</script>";

} else {   
echo "<script type='text/javascript'>alert('" . $_POST['m_email'] ."郵件傳送成功');</script>";   
}
}
?>