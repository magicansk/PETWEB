<?php
require_once("connMysql.php"); //用來引入connMysql的php檔
session_start();
loginOut(); //執行登出
memberData(); //登入會員資料及判斷選單
$m_id = $row_RecMember['m_id'];

//這是配對成功頁

//顯示成功的 pa_me 為T 且 pa_you 為T 有兩種情況 
// // 1.與某某某的寵物XXX成為好友   m_id是邀請人    p_id被邀請人的寵物id  pmid是被邀請人id
// $success_i = "SELECT * FROM `_paired_pets_mem`
//        WHERE `m_id`=$m_id AND `pa_me`='T' AND `pa_you`='T'";
// $success_I = $db_link->query($success_i);
// $sent_i = $success_I->fetch_assoc();
// $paired_n = $sent_i['pa_n']; //取配對編號
// $invitee_pid = $sent_i['p_id']; //取被邀請人的寵物id
// $invitee_id = $sent_i['pmid']; //取被邀請人id


// if (isset($sent_i)) { //當有值才執行



//   $invitee = "SELECT * FROM `_pet_mem` WHERE p_id =$invitee_pid"; //取受邀者的寵物及主人資料
//   $invitee_data = $db_link->query($invitee);

//   //   //繫結登入寵物照片
//   $query_RecPhoto = "SELECT `pp_picurl` fROM `petphoto` WHERE p_id=$invitee_pid"; //取寵物圖
//   $RecPhoto = $db_link->query($query_RecPhoto);
// }
?>

<HTML>

<HEAD>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
  <TITLE>培茲PETS-配對:配對成功</TITLE>
  <link rel="stylesheet" href="css/slick.css">
  <link rel="stylesheet" href="css/slick-theme-mypet.css">
  <link rel=stylesheet type="text/css" href="css/rwd.css">
  <link rel=stylesheet type="text/css" href="css/common.css">
  <link rel=stylesheet type="text/css" href="css/paired_success.css">
</HEAD>

<?php include("_header.php"); ?>

<div class="nav2 media-m-hid media-l-center">
  <div class="location media-xl-10">
    <ul class="breadcrumb">
      <li><span>目前位置</span></li>
      <li><span><a href="index.php">首頁</a></span></li>
      <li><span><a href="paired.php">配對系統</a></span></li>
      <li><span><a href="paired_result.php">配對紀錄</a></span></li>
      <li><span>配對成功</span></li>
    </ul>
  </div>
</div>

<div class="content">
  <?php
  //邀請人為我, m_id=$m_id
  $success_i = "SELECT * FROM `_paired_pets_mem`WHERE `m_id`=$m_id AND `pa_me`='T' AND `pa_you`='T'";
  $success_I = $db_link->query($success_i);
  $count_me = $success_I->num_rows;
  while ($sent_i = $success_I->fetch_assoc()) { //取配對結果
    $paired_n = $sent_i['pa_n'];
    $p_id = $sent_i['p_id']; //取被邀請人的寵物id
    $pmid = $sent_i['pmid']; //取被邀請人id
  ?>
    <?php
    $invitee = "SELECT * FROM `_pet_mem` WHERE p_id = $p_id";
    $invitee_data = $db_link->query($invitee);
    while ($row = $invitee_data->fetch_assoc()) {
    ?>
      <div class="rowpair media-m-11 media-l-10 media-xl-6">
        <div class="title">
          <p>我邀請
            <b><?php echo $row['p_name']; ?></b> 配對成功!! 聯繫資訊如下：</p>
        </div>
        <div class="text">
          <h1><?php echo $row['m_name']; ?></h1>
          <p><?php echo '電話 ' . $row['m_phone']; ?></p>
          <p><?php echo '信箱 ' . $row['m_email']; ?></p>
          <p><?php echo $row['p_name']; ?>
            <?php echo $row['p_class']; ?>
            <?php echo $row['p_breed']; ?>
            <?php echo $row['p_sex']; ?>
            <?php echo $row['p_age'] . "歲"; ?></p>
          <hr>
          <?php echo $row['p_introduction']; ?><br>
        </div>
        <div class="img">
          <div class="slick">
            <?php
            $query_RecPhoto = "SELECT `pp_picurl` fROM `petphoto` WHERE p_id=$p_id";
            $RecPhoto = $db_link->query($query_RecPhoto);
            while ($row_RecPhoto = $RecPhoto->fetch_assoc())  //取這個寵物的圖片       
            {
            ?>
              <img src="photos/<?php echo $row_RecPhoto['pp_picurl']; ?>">
            <?php } //取這個寵物的圖片
            ?>
          </div>
        </div>
      <?php } //寵物資料
      ?>
      </div>
    <?php } ?>

    <!-- 2.某某某與你的寵物OOO成為好友 p_id變成我的寵物的 -->

    <?php
    $success_you = "SELECT `pa_n`,`p_id`,`p_name`,`m_id` FROM `_paired_pets_mem` WHERE `pmid`=$m_id AND `pa_me`='T' AND `pa_you`='T'";
    $success_You = $db_link->query($success_you);
    $count_you = $success_You->num_rows;
    while ($sent_you = $success_You->fetch_assoc()) {  //我被邀請紀錄
      $m_id = $sent_you['m_id'];
    ?>
      <div class="rowpair2 media-m-11 media-l-10 media-xl-6">
        <?php
        $invite = "SELECT * FROM `memberdata` WHERE m_id =$m_id";
        $invite_data = $db_link->query($invite);
        while ($invite_pet = $invite_data->fetch_assoc()) { //邀請者的資料
        ?>
          <div class="title">
            <b><?php echo $invite_pet['m_name']; ?></b>
            喜歡我的寵物
            <b><?php echo $sent_you['p_name']; ?></b>
            配對成功!!
          </div>
          <div class="title2">
            聯繫資訊：
            電話 <?php echo $invite_pet['m_phone']; ?>
            信箱 <?php echo $invite_pet['m_email']; ?>
          </div>
        <?php } ?>

        <?php
        $invite = "SELECT * FROM `_pet_mem` WHERE m_id =$m_id"; //取邀請者的寵物(多隻)及主人資料
        $invite_data = $db_link->query($invite);
        while ($invite_pet = $invite_data->fetch_assoc()) { //邀請者的寵物資料
          $p_id = $invite_pet['p_id'];
        ?>
          <div class="text">
            <h1><?php echo $invite_pet['p_name']; ?></h1>
            <?php echo $invite_pet['p_class']; ?>
            <?php echo $invite_pet['p_breed']; ?>
            <?php echo $invite_pet['p_sex']; ?>
            <?php echo $invite_pet['p_age']; ?>
            <hr>
            <?php echo $invite_pet['p_introduction']; ?>
          </div>

          <div class="img2">
            <div class="slick">
              <?php
              $query_RecPhoto = "SELECT `pp_picurl` fROM `petphoto` WHERE p_id=$p_id"; //取寵物圖
              $RecPhoto = $db_link->query($query_RecPhoto);
              while ($row_RecPhoto = $RecPhoto->fetch_assoc())  //取這個寵物的圖片       
              {
              ?>
                <img src="photos/<?php echo $row_RecPhoto['pp_picurl']; ?>">
              <?php
              } //取這個寵物的圖片
              ?>
            </div>
          </div>
        <?php } //寵物資料
        ?>
      </div>
    <?php }
    //我被邀請
    ?>
    <?php if ($count_me == 0 && $count_you == 0) { ?>
      <div class="nodata media-m-10 media-l-10 media-xl-10">
        <h1>目前沒有任何配對紀錄唷！</h1>
      </div>
    <?php } ?>
</div>

<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="script/slick.min.js"></script>
<script type="text/javascript" src="script/slickset-pair.js"></script>

<?php include("_footer.php"); ?>