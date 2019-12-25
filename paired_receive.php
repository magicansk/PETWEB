<?php
require_once("connMysql.php");
session_start();
loginOut(); //執行登出
memberData(); //登入會員資料及判斷選單

$m_id = $row_RecMember['m_id'];

//這是收到邀請頁





//收到的配對要求 pa_me =T 我還沒確定的 pa_you N
$receive = "SELECT * FROM `_paired_pets_mem`
WHERE `pmid`=$m_id AND `pa_me`='T' AND `pa_you`='N'";

$result = $db_link->query($receive);
$sent = $result->fetch_assoc();

if (isset($sent)) { //當有值才執行
  $paired_n = $sent['pa_n']; //取配對編號
  $sent_id = $sent['m_id']; //取寄邀請給我的人id
  $receive_pid = $sent['p_id']; //取自己的寵物id

  $sentdata = "SELECT * FROM `_pet_mem` WHERE m_id =$sent_id"; //取寄邀請給我的人的寵物(多筆)及主人資料
  $receive_data = $db_link->query($sentdata);
  $sent_pet = $receive_data->fetch_assoc();

  //繫結登入寵物照片
  $query_RecPhoto = "SELECT `pp_picurl` fROM `petphoto` WHERE p_id='{$sent_pet['p_id']}'"; //取寵物圖
  $RecPhoto = $db_link->query($query_RecPhoto);
}
//這是我要跟這人做朋友
if (isset($_GET["action"]) && ($_GET["action"] == "iwant")) {
  $query_insert = "UPDATE paired set  pa_you = 'T' where pa_n=$paired_n ";
  $stmt = $db_link->prepare($query_insert);
  $stmt->execute();
  $stmt->close();

  //導向結果
  header("Location: paired_success.php");
}

//這是我不要這人做朋友
if (isset($_GET["action"]) && ($_GET["action"] == "notwant")) {
  $query_insert = "UPDATE paired set  pa_you ='F'   where pa_n=$paired_n";
  $stmt = $db_link->prepare($query_insert);
  $stmt->execute();
  $stmt->close();

  //導向結果
  header("Location:  paired_result.php");
}

?>

<HTML>

<HEAD>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
  <TITLE>培茲PETS-配對:收到邀請</TITLE>
  <link rel="stylesheet" href="css/slick-pair-receive.css">
  <link rel="stylesheet" href="css/slick-theme-pair-receive.css">
  <link rel=stylesheet type="text/css" href="css/rwd.css">
  <link rel=stylesheet type="text/css" href="css/common.css">
  <link rel=stylesheet type="text/css" href="css/paired_receive.css">
</HEAD>

<?php include("_header.php"); ?>

<div class="nav2 media-m-hid media-l-center">
  <div class="location media-xl-10">
    <ul class="breadcrumb">
      <li><span>目前位置</span></li>
      <li><span><a href="index.php">首頁</a></span></li>
      <li><span><a href="paired.php">配對系統</a></span></li>
      <li><span><a href="paired_result.php">配對紀錄</a></span></li>
      <li><span>收到邀請</span></li>
    </ul>
  </div>
</div>

<div class="content">
  <?php

  $result = $db_link->query($receive);

  while ($sent = $result->fetch_assoc()) {
    $sentdata = "SELECT * FROM `_pet_mem` WHERE m_id ='{$sent['m_id']}'"; //取寄邀請給我的人的寵物(多筆)及主人資料
    $receive_data = $db_link->query($sentdata);
    $sent_pet = $receive_data->fetch_assoc();

    $paired_n = $sent['pa_n'];
  ?>
    <div class="petdata media-m-12 media-l-10 media-xl-5">
      <div class="pettitle">
        <p><b><?php echo  $sent_pet['m_name']; ?></b>對您的<b><?php echo  $sent['p_name']; ?></b>有興趣</p>
        以下為他的毛孩資訊
      </div>
      <div class="rowpet">
        <?php
        //取這個人的寵物資料
        $receive_data = $db_link->query($sentdata); //這行要留在while前
        while ($sent_pet = $receive_data->fetch_assoc()) {
          $p_id = $sent_pet['p_id']; //
        ?>
          <div class="petuni">
            <div class="pettext">
              <h1><?php echo $sent_pet['p_name']; ?></h1>
              <?php echo $sent_pet['p_class']; ?>
              <?php echo $sent_pet['p_breed']; ?>
              <?php echo $sent_pet['p_sex']; ?>
              <?php echo $sent_pet['p_age'] . "歲"; ?>
              <hr>
              <?php echo $sent_pet['p_introduction']; ?>
            </div>
            <div class="petphoto">
              <div class="slick">
                <?php
                $query_RecPhoto = "SELECT `pp_picurl` fROM `petphoto` WHERE p_id='$p_id'"; //取寵物圖
                $RecPhoto = $db_link->query($query_RecPhoto);
                while ($row_RecPhoto = $RecPhoto->fetch_assoc()) { //取這個寵物的圖片                         
                ?>
                  <img src="photos/<?php echo $row_RecPhoto['pp_picurl']; ?>">
                <?php } ?>
              </div>
            </div>
          </div>
        <?php } ?>

      </div>
      <div class="action">
        <a href="?action=notwant&pan=<?php echo $paired_n; ?>">
          <img src="images/pairno.png" alt="">
        </a>
        <a href="?action=iwant&pan=<?php echo $paired_n; ?>">
          <img src="images/pairyes.png" alt="">
        </a>
      </div>
    </div>

  <?php }  //最外圍while的
  ?>
</div>
<?php $count = $result->num_rows; //1221紹寧->判別筆數
if ($count == 0) { ?>

  <div class="content">
    <div class="nodata media-m-10 media-l-10 media-xl-10">
      <h1>目前尚未收到任何邀請唷！</h1>
    </div>
  </div>

<?php } ?>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="script/slick.min.js"></script>
<script type="text/javascript" src="script/slickset-pair.js"></script>
<?php include("_footer.php"); ?>