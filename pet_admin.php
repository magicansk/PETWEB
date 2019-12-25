<?php
require_once("connMysql.php");
session_start();
adminJudge(); //判斷是否為admin登入
loginOut(); //執行登出
memberData(); //登入會員資料及判斷選單
admDeletepetdata(); //刪除寵物資料
recAllpetdata(); //選取所有寵物資料
?>
<HTML>

<HEAD>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <TITLE>培茲PETS-毛孩名單管理</TITLE>
    <link rel=stylesheet type="text/css" href="css/rwd.css">
    <link rel=stylesheet type="text/css" href="css/common.css">
    <link rel=stylesheet type="text/css" href="css/pet_admin.css">
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
            <li><span>毛孩名單管理</span></li>
        </ul>
    </div>
</div>
<div class="m-adm">
    <div class="m-admbox"><label>毛孩名單管理</label></div>
    <div class="m-admbox"><label>本次登入時間<br><?php echo $row_RecMember["m_logintime"]; ?></label></div>
    <div class="m-admbox"><label>現在時間<div id="clock"></div></label></div>
    <div class="m-admbox"><label><a href="?logout=true">登出系統</a></label></div>
</div>
<div class="m-adm">
    <div class="m-adm-list">
        <table class="m-adm-list">
            <tr>
                <td class="m-adm-list-1">
                    <p>姓名</p>
                </td>
                <td class="m-adm-list-2">
                    <p>分類</p>
                </td>
                <td class="m-adm-list-3">
                    <p>品種</p>
                </td>
                <td class="m-adm-list-4">
                    <p>性別</p>
                </td>
                <td class="m-adm-list-5">
                    <p>歲數</p>
                </td>
                <td class="m-adm-list-5">
                    <p>主人</p>
                </td>
                <td class="m-adm-list-6">
                    <p>操作</p>
                </td>
            </tr>
            <?php while ($row_RecPet = $RecAllpet->fetch_assoc()) { ?>
                <tr>
                    <td class="m-adm-list">
                        <p><?php echo $row_RecPet["p_name"]; ?></p>
                    </td>
                    <td class="m-adm-list">
                        <p><?php echo $row_RecPet["p_class"]; ?></p>
                    </td>
                    <td class="m-adm-list">
                        <p><?php echo $row_RecPet["p_breed"]; ?></p>
                    </td>
                    <td class="m-adm-list">
                        <p><?php echo $row_RecPet["p_sex"]; ?></p>
                    </td>
                    <td class="m-adm-list">
                        <p><?php echo $row_RecPet["p_age"]; ?>歲</p>
                    </td>
                    <td class="m-adm-list">
                        <p><?php echo $row_RecPet["m_username"]; ?></p>
                    </td>
                    <td class="m-adm-list">
                        <p>
                            <a href="pet_adminupdate.php?id=<?php echo $row_RecPet["p_id"]; ?>">修改</a><br>
                            <a href="?action=delete&id=<?php echo $row_RecPet["p_id"]; ?>" onClick="return deletesure();">刪除</a>
                        </p>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <table class="m_adm_ctl">
            <tr>
                <td>
                    <a href="?page=1">第一頁</a> |
                    <a href="?page=<?php if ($num_pages > 1) {
                                                            echo $num_pages - 1;
                                                        } else echo $num_page = 1; ?>">上一頁</a> |
                    <a href="?page=<?php if ($num_pages < $total_pages) {
                                                            echo $num_pages + 1;
                                                        } else echo $num_pages = $total_pages; ?>">下一頁</a> |
                    <a href="?page=<?php echo $total_pages; ?>">最末頁</a>
                </td>
            </tr>
            <tr>
                <td><span>共<?php echo $total_records; ?>筆資料</span></td>
            </tr>
        </table>
    </div>
</div>
<?php include("_footer.php"); ?>