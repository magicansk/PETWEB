<?php
require_once("connMysql.php"); //用來引入connMysql的php檔
session_start();
loginOut(); //執行登出
memberData(); //登入會員資料及判斷選單
$m_id = $row_RecMember['m_id'];


//這是 對方未回覆的頁
//尚未回覆的 pa_me 為T 且 pa_you 為 N 
$notback = "SELECT `p_id`, `p_name` FROM `_paired_pets_mem` WHERE `m_id`=$m_id AND `pa_me`='T' AND `pa_you`='N'";
$result = $db_link->query($notback);
$stmt = $db_link->prepare($notback);


?>

<HTML>

<HEAD>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
  <TITLE>培茲PETS-配對:等待回應</TITLE>
  <link rel=stylesheet type="text/css" href="css/rwd.css">
  <link rel=stylesheet type="text/css" href="css/common.css">
  <link rel=stylesheet type="text/css" href="css/paired_notback.css">
</HEAD>

<?php include("_header.php"); ?>

<div class="nav2 media-m-hid media-l-center">
  <div class="location media-xl-10">
    <ul class="breadcrumb">
      <li><span>目前位置</span></li>
      <li><span><a href="index.php">首頁</a></span></li>
      <li><span><a href="paired.php">配對系統</a></span></li>
      <li><span><a href="paired_result.php">配對紀錄</a></span></li>
      <li><span>等待回應</span></li>
    </ul>
  </div>
</div>

<?php
$result = $db_link->query($notback);

$count = $result->num_rows; //1221紹寧->判別筆數
if ($count == 0) { ?>

  <div class="content">
    <div class="nodata media-m-10 media-l-10 media-xl-10">
      <h1>您尚未送出任何配對要求~趕快去配對吧!!</h1>
    </div>
  </div>

  <?php } else {
  while ($row = $result->fetch_assoc()) { //尚未回覆
    $p_id = $row['p_id'];
  ?>
    <div class="content">
      <div class="petdata media-m-12 media-l-10 media-xl-6">
        <div class="back">
          <p>正在等待<b><?php echo $row['p_name']; ?></b>的回應...</p>
        </div>
        <div class="name">
          <h1><?php echo $row['p_name']; ?></h1>
          <?php
          $sentdata = "SELECT * FROM `_pet_mem` WHERE p_id ='{$p_id}'"; //取寄邀請給我的人的寵物跟主人的資料
          $receive_data = $db_link->query($sentdata); //這行要留在while前
          while ($sent_pet = $receive_data->fetch_assoc()) { //寵物資料
          ?>
            <span class="text1">
              <?php echo $sent_pet['p_class'] . " /"; ?>
              <?php echo $sent_pet['p_breed'] . " /"; ?>
              <?php echo $sent_pet['p_sex'] . " /"; ?>
              <?php echo $sent_pet['p_age'] . "歲"; ?>
            </span>
            <hr>
            <span class="text2">
              <?php echo "" . $sent_pet['p_introduction']; ?>
            </span>
        </div>
        <?php
            $query_RecPhoto = "SELECT `pp_picurl` fROM `petphoto` WHERE p_id='$p_id' GROUP BY p_id"; //取寵物圖 1219->鈺勳:只取一張
            $RecPhoto = $db_link->query($query_RecPhoto);
            while ($row_RecPhoto = $RecPhoto->fetch_assoc())  //取這個寵物的圖片       
            {
        ?>
          <div class="img">
            <img src="photos/<?php echo $row_RecPhoto['pp_picurl']; ?>">
          </div>
      <?php
            } //取這個寵物的圖片
          } //寵物資料
      ?>
      </div>
    </div>
<?php
  }
} //尚未回覆
?>

<?php include("_footer.php"); ?>