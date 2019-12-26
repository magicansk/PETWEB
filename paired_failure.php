<?php
require_once("connMysql.php");
session_start();
loginOut(); //執行登出
memberData(); //登入會員資料及判斷選單

$m_id = $row_RecMember['m_id']; //     $row_RecMember=$RecMember->fetch_assoc();取全部存成陣列

//這是被拒絕了
$failure = "SELECT `pa_n`,`p_id`,`p_name` FROM `_paired_pets_mem` WHERE `m_id`=$m_id AND `pa_me`='T' AND `pa_you`='F' AND look='N'";
//用事件 click 點完後 UPDATE paired set  look='Y' WHERE `m_id`=$m_id AND `pa_you`='F'
$notlook = $db_link->query($failure);
$goodman = $notlook->fetch_assoc();
$paired_n = $goodman['pa_n'];
$p_id = $goodman['p_id'];
//這是我要跟這人做朋友但他不要 讀完之後 就不會顯示
if (isset($_GET["action"]) && ($_GET["action"] == "iread")) {
  $query_update = "UPDATE paired set look = 'T' where pa_n=$paired_n ";
  $stmt = $db_link->prepare($query_update);
  $stmt->execute();
  $stmt->close();

  //導向結果
  header("Location: paired_result.php");
}
?>


<HTML>

<HEAD>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
  <TITLE>培茲PETS-配對:配對失敗</TITLE>
  <link rel="stylesheet" href="css/slick.css">
  <link rel="stylesheet" href="css/slick-theme-mypet.css">
  <link rel=stylesheet type="text/css" href="css/rwd.css">
  <link rel=stylesheet type="text/css" href="css/common.css">
  <link rel=stylesheet type="text/css" href="css/paired_failure.css">
  <script language="javascript">
    function goodman() {
      alert("你是個好人");
    }
  </script>
</HEAD>

<?php include("_header.php"); ?>

<div class="nav2 media-m-hid media-l-center">
  <div class="location media-xl-10">
    <ul class="breadcrumb">
      <li><span>目前位置</span></li>
      <li><span><a href="index.php">首頁</a></span></li>
      <li><span><a href="paired.php">配對系統</a></span></li>
      <li><span><a href="paired_result.php">配對紀錄</a></span></li>
      <li><span>配對失敗</span></li>
    </ul>
  </div>
</div>

<div class="content">
  <?php
  $notlook = $db_link->query($failure);
  $count = $notlook->num_rows;
  while ($goodman = $notlook->fetch_assoc()) {
    $paired_n = $goodman['pa_n'];
    $p_id = $goodman['p_id'];
  ?>
    <div class="petfail media-m-12 media-l-10 media-xl-6">
      <div class="sorry">
        <p>很遺憾...</p>
      </div>
      <div class="img">
        <?php
        $query_photo = "SELECT `pp_picurl` FROM petphoto WHERE `p_id` = $p_id GROUP BY `p_id`";
        $photo = $db_link->query($query_photo);
        while ($row_photo = $photo->fetch_assoc()) { ?>
          <img src="photos/<?php echo $row_photo['pp_picurl'] ?>" alt="">
        <?php } ?>
      </div>
      <div class="text">
        <div class="title">
          <h1><?php echo $goodman['p_name']; ?>的主人</h1>
          <hr>
          拒絕了你的請求
        </div>
        <div class="check">
          <a href="?action=iread&pan=<?php echo $paired_n; ?>" onClick="return goodman()">刪除</a>
        </div>
      </div>
    </div>
  <?php } ?>
  <?php if ($count == 0) { ?>
    <div class="nodata media-m-10 media-l-10 media-xl-10">
      <h1>目前沒有任何配對紀錄唷！</h1>
    </div>
  <?php } ?>
</div>

<?php include("_footer.php"); ?>
