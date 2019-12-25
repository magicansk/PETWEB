<?php
require_once("connMysql.php");
session_start();
loginJudge(); //檢查是否經過登入
loginOut(); //執行登出
memberData(); //登入會員資料及判斷選單
deletePetdata(); //會員刪除寵物資料
$m_id = $row_RecMember['m_id'];
recUserpet(); //會員選取寵物
?>
<!------以下為html------->
<HTML>

<HEAD>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <TITLE>培茲PETS-我的毛孩</TITLE>
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme-mypet.css">
    <link rel=stylesheet type="text/css" href="../css/rwd.css">
    <link rel=stylesheet type="text/css" href="../css/common.css">
    <link rel=stylesheet type="text/css" href="../css/pet_mypet.css">
    <script type="text/javascript" src="script/time.js"></script>
    <script language="javascript">
        function deletesure() {
            if (confirm('\n您確定要刪除這個寵物資料嗎?\n刪除後無法恢復!\n')) return true;
            return false;
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
            <li><span>我的毛孩</span></li>
        </ul>
    </div>
</div>

<div class="content">
    <?php while ($row_RecPet = $RecPet->fetch_assoc()) { ?>
        <div class="item media-xl-3 media-l-4 media-m-11">
            <div class="slick">
                <?php
                $query_RecPhoto = "SELECT * FROM `petphoto` WHERE p_id='{$row_RecPet['p_id']}'";
                $RecPhoto = $db_link->query($query_RecPhoto);
                while ($row_photo = $RecPhoto->fetch_assoc()) { ?>
                    <img src="photos/<?php echo $row_photo['pp_picurl']; ?>" alt="" width="">
                <?php } ?>
            </div>
            <div class="text">
                <h1><?php echo $row_RecPet["p_name"]; ?></h1>
                <hr>
                <?php echo $row_RecPet["p_class"]; ?>
                <?php echo $row_RecPet["p_breed"]; ?>
                <?php echo $row_RecPet["p_sex"]; ?>
                <?php echo $row_RecPet["p_age"]; ?>歲
            </div>
            <div class="ctl">
                <a href="pet_update.php?id=<?php echo $row_RecPet["p_id"]; ?>">修改</a>
                <a href="?action=delete&id=<?php echo $row_RecPet["p_id"]; ?>" onClick="return deletesure();">刪除</a>
            </div>
        </div>
    <?php } ?>
    <?php
    //紹寧12.20->限制增加寵物數量
    $query_count = "SELECT `p_id` FROM petdata Where `m_id` = '{$m_id}'";
    $countdata = $db_link->query($query_count);
    $count = $countdata->num_rows;
    if ($count < 2) {
    ?>
        <div class="item media-xl-3 media-l-4 media-m-12">
            <a href="pet_add.php">
                <div class="addpet">
                    <img src="images/pair/add.png" alt="">
                </div>
                <div class="addtext">
                    新增毛孩
                </div>
            </a>
        </div>
    <?php } ?>

</div>

<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="script/slick.min.js"></script>
<script type="text/javascript" src="script/slickset-pair.js"></script>
<?php include("_footer.php"); ?>