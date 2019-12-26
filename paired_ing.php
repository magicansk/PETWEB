<?php

/*這是點了之後會跑出隨機配到結果頁*/
require_once("connMysql.php"); //用來引入connMysql的php檔
session_start();
loginOut(); //執行登出
memberData(); //登入會員資料及判斷選單

$m_id = $row_RecMember['m_id']; //

?>

<HTML>

<HEAD>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
  <TITLE>培茲PETS-毛孩配對</TITLE>
  <link rel="stylesheet" href="css/slick-pair.css">
  <link rel="stylesheet" href="css/slick-theme-pair.css">
  <link rel=stylesheet type="text/css" href="css/rwd.css">
  <link rel=stylesheet type="text/css" href="css/common.css">
  <link rel=stylesheet type="text/css" href="css/paired_ing.css">

  <script language="javascript">
    function sorry() {
      function checkTime(i) {
        if (i < 10) {
          i = "0" + i;
        }
        return i;
      }
      var NowDate = new Date();
      var h = NowDate.getHours();
      var m = NowDate.getMinutes();
      var s = NowDate.getSeconds();
      // m = checkTime(m);
      // s = checkTime(s);
      var hours = 23 - h;
      var minutes = 59 - m;
      var seconds = 60 - s;
      minutes = checkTime(minutes);

      function nextdraw() {
        seconds = checkTime(seconds);
        alert("你今天已經抽過了\r距離下次抽卡時間還有:" + hours + "小時" + minutes + "分 ");
        seconds--;
        if (seconds < 0) {
          seconds = 59;
          minutes--;
          if (minutes < 0) {
            hours--;
            minutes = 59;
          }
        }
      }
      nextdraw();
      window.location.href = "paired.php";
    }

    function want() {
      if (confirm('\n祝你交友成功\n')) {
        return true;
      } else {
        return false;
      }
    }

    function notwant() {
      if (confirm('\n下一個會更好!\n')) {

        return true;
      } else {

        return false;
      }

    }
  </script>
</HEAD>

<body>
  <?php ob_start();
  include("_header.php");

  $pet_query = "SELECT * FROM `petdata` WHERE `m_id` = '{$m_id}'";
  $rec_pet = $db_link->query($pet_query);
  $countpet = $rec_pet->num_rows;
  if ($countpet == 0) {
    echo "<script>alert('您還尚未新增毛孩唷!!\t請快去新增吧^_^');</script>";
    echo "<script>window.location.href='pet_mypet.php';
    </script>";
    exit; //要加不然後續程式碼會跑
  }

  //判斷時間 今天是否有我抽卡紀錄或者還未決定的 pa_me為N一定是今天 因為之前的會被刪掉
  $sql = "SELECT * FROM `paired` WHERE TO_DAYS(`pa_time`) = TO_DAYS(NOW())  AND `m_id`=$m_id ";
  $draw = $db_link->query($sql);
  $count = $draw->num_rows;
  $draw_y = $draw->fetch_assoc();

  if ($count == 0) {
    //無資料才能配對
    $rand_p = "SELECT pd.`p_id`,pd.`p_name` FROM `petdata` pd WHERE pd.`m_id`!=$m_id AND NOT EXISTS(SELECT pa.`p_id` FROM `paired` pa WHERE pa.`m_id`=$m_id and pa.p_id=pd.p_id) ORDER BY RAND() Limit 1"; //隨機抽寵物
    $result = $db_link->query($rand_p);
    $row_RecPetid = $result->fetch_array();
    $p_id = $row_RecPetid['p_id']; //配到的寵物p_id
    if (!isset($p_id)) { //當配對無結果跳這個
      echo "<script>alert('尚未有毛孩能配對唷!!\t真是抱歉^_^');</script>";
      echo "<script>window.location.href='paired_result.php';</script>";
      exit;
    }
    $rand_save = "INSERT INTO paired (m_id, pa_me, p_id, pa_time, pa_you) VALUES ($m_id, 'N', $p_id, NOW(), 'N')";
    $stmt = $db_link->prepare($rand_save);
    $stmt->execute();
    $stmt->close();
  } elseif ($draw_y['pa_me'] == 'N') {
    //有抽但我未確認得寵物，顯示抽過的資料
    $sql = "SELECT  `pa_n`,`p_id`,`pa_time` from  paired where m_id=$m_id AND pa_me='N'";
    $notyes = $db_link->query($sql);
    $ckeck_Y = $notyes->fetch_assoc();
    $pa_n = $ckeck_Y['pa_n'];
    $p_id = $ckeck_Y['p_id'];
  } else {
    //已經抽過了 88
    echo "<script>sorry();</script> ";
    exit;
  }
  //繫結登入寵物照片
  $query_RecPhoto = "SELECT `pp_picurl` fROM `petphoto` WHERE p_id=$p_id";
  $RecPhoto = $db_link->query($query_RecPhoto);

  $query_petdata = "SELECT * from `petdata` where p_id=$p_id";
  $petdata = $db_link->query($query_petdata);
  $row_Pairpet = $petdata->fetch_array();
  //這是好,把pa_me更改為T
  if (isset($_GET["action"]) && ($_GET["action"] == "yes")) {
    $query_UPDATE = "UPDATE paired set pa_me='T',pa_time =NOW() where pa_n=$pa_n";
    $stmt = $db_link->prepare($query_UPDATE);
    $stmt->execute();
    $stmt->close();
    //導向對方尚未回覆
    header("Location: paired_notback.php");
  }
  //這是配對不好
  if (isset($_GET["action"]) && ($_GET["action"] == "no")) {
    $query_UPDATE = "UPDATE paired set pa_me='F',pa_time =NOW() where pa_n=$pa_n";
    $stmt = $db_link->prepare($query_UPDATE);
    $stmt->execute();
    $stmt->close();
    //重新導向回到主畫面
    header("Location: paired.php");
  }

  ?>

  <div class="nav2 media-m-hid media-l-center">
    <div class="location media-xl-10">
      <ul class="breadcrumb">
        <li><span>目前位置</span></li>
        <li><span><a href="index.php">首頁</a></span></li>
        <li><span><a href="paired.php">配對系統</a></span></li>
        <li><span>每日配對</span></li>
      </ul>
    </div>
  </div>

  <div class="content">
    <!-- <?php echo $row_Pairpet["p_id"]; ?> 測試寵物編號用-->
    <div class="slick media-m-10 media-l-6 media-xl-3">
      <?php
      $RecPhoto = $db_link->query($query_RecPhoto);
      while ($row_RecPhoto = $RecPhoto->fetch_assoc()) { ?>
        <img src="photos/<?php echo $row_RecPhoto['pp_picurl']; ?>">
      <?php }  ?>
    </div>
  </div>
  <div class="content">
    <div class="text media-m-10 media-l-6 media-xl-3">
      <h3><?php echo $row_Pairpet['p_name'] . ',' . $row_Pairpet['p_class'] . ',' . $row_Pairpet['p_sex'] . ',' . $row_Pairpet['p_age'] ?>歲</h3>
      <p><?php echo $row_Pairpet['p_introduction']; ?></p>
      <a href="?action=no&id=<?php echo $row_Pairpet["p_id"]; ?>" onClick="return notwant()">
        <img src="images/pairno.png" alt="">
      </a>
      <a href="?action=yes&id=<?php echo $row_Pairpet["p_id"]; ?>" onClick="return want()">
        <img src="images/pairyes.png" alt="">
      </a>
    </div>
  </div>
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="script/slick.min.js"></script>
  <script type="text/javascript" src="script/slickset-pair.js"></script>
  <?php include("_footer.php");
  ob_end_flush(); ?>
