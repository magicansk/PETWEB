<?php

//error_reporting(E_ALL); //除錯用

if (!isset($_SESSION)) {
     session_start();
}  //判斷session是否已啟動

$ans_str = 0;
$ans_str2 = 0;
$ans_now = '';
$s_x = 0;
$s_y = 0;
$ans_right_move = '';
$_SESSION['ans_ckword'] = '';

$r =  mt_rand(0, 150);
$g =  mt_rand(0, 150);
$b =  mt_rand(0, 150); //11.27紹寧新增隨機色彩

mt_srand((float) microtime() * 1000000);  //重置隨機值

//隨機取得6個小寫英字a-z 11.27紹寧新增 i改成3 一次取兩個值->12.14小改版變隨機大小寫
for ($i = 0; $i < 4; $i++) { //6次迴圈
     $ans=mt_rand(1,2);
     if($ans==1){
          $ans_str = mt_rand(65, 90); //隨機在兩個值中間抽取一個值
     }else{
          $ans_str = mt_rand(97, 122);  //11.27紹寧新增小寫
     }
     $ans_now .= chr($ans_str); //串接+十進制轉換 => 48~57 = 1~9 / 65~90 = A~Z / 97~122 = a~z
}

$_SESSION['ans_ckword'] = $ans_now;  //將值放至session

//$ans_now='xyzabc';  //測試用

$im = imagecreate(90, 30); //圖片大小

$red2 = imagecolorallocate($im, $r, $g, $b);  //文字顏色

$gray2 = imagecolorallocate($im, 200, 200, 200);  //背影顏色

imagefill($im, 0, 0, $gray2);

//隨機30點
$s_dot = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 128));
for ($i = 0; $i < 30; $i++) {
     imagesetpixel($im, mt_rand(10, 75), mt_rand(5, 20), $s_dot);
}

//文字隨機浮動
$s_x = mt_rand(5, 10);
for ($i = 0; $i < 6; $i++) {
     $ans_right_move = substr($ans_now, $i, 1);
     $s_y = mt_rand(1, 8);
     imagestring($im, 5, $s_x, $s_y, $ans_right_move, $red2); //圖片大小,字型大小
     $s_x = $s_x + mt_rand(8, 14);
}

//輸出圖片
header('Content-type: image/png');

imagepng($im);

imagedestroy($im);
