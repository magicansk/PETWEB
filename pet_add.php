<?php
require_once("connMysql.php");
session_start();
loginJudge(); //判斷有登入
loginOut(); //執行登出
memberData(); //登入會員資料及判斷選單

$m_id = $row_RecMember['m_id'];

?>
<html>

<HEAD>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <TITLE>培茲PETS-新增毛孩</TITLE>
    <link rel=stylesheet type="text/css" href="css/rwd.css">
    <link rel=stylesheet type="text/css" href="css/common.css">
    <link rel=stylesheet type="text/css" href="css/pet_add.css">
    <script type="text/javascript" src="script/time.js"></script>
</HEAD>

<?php include("_header.php"); ?>

<div class="nav2 media-m-hid media-l-center">
    <div class="location media-xl-10">
        <ul class="breadcrumb">
            <li><span>目前位置</span></li>
            <li><span><a href="index.php">首頁</a></span></li>
            <li><span><a href="paired.php">配對系統</a></span></li>
            <li><span><a href="pet_mypet.php">我的毛孩</a></span></li>
            <li><span>新增毛孩</span></li>
        </ul>
    </div>
</div>

<div>
    <div class="m-adm media-m-10 media-l-7">
        <div class="m-admbox"><label>修改資料</label></div>
        <div class="m-admbox"><label>本次登入時間<?php echo $row_RecMember["m_logintime"]; ?></label></div>
        <div class="m-admbox"><label>現在時間<div id="clock"></div></label></div>
    </div>
</div>

<div class="content">
    <?php
    //紹寧12.20->限制上傳寵物數量->跳轉
    $query_count = "SELECT `p_id` FROM petdata Where `m_id` = '{$m_id}'";
    $countdata = $db_link->query($query_count);
    $row_count = $countdata->fetch_all();
    $count = count($row_count);
    if ($count >= 2) {
        echo '<script>window.location.href="pet_mypet.php";</script>';
    } ?>

    <div class="addpet media-m-10 media-l-10 media-xl-10">
        <form action="crop_petadd.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <table>
                <tr>
                    <td><input class="textbox" type="text" name="p_name" id="p_name" placeholder="寵物姓名"></td>
                </tr>
                <tr>
                    <td>
                        <span class="sex">分類
                            <input class="sex" name="p_class" id="cat" type="radio" value="貓咪" checked><label for="cat">貓咪</label>
                            <input class="sex" name="p_class" id="dog" type="radio" value="狗狗"><label for="dog">狗狗</label>
                    </td>
                </tr>
                <tr>
                    <td><input class="textbox" type="text" name="p_breed" id="p_breed" placeholder="品種"></td>
                </tr>
                <tr>
                    <td>
                        <span class="sex">性別
                            <input class="sex" name="p_sex" id="male" type="radio" value="男生" checked><label for="male">男生</label>
                            <input class="sex" name="p_sex" id="female" type="radio" value="女生"><label for="female">女生</label>
                    </td>
                </tr>
                <tr>
                    <td><input class="textbox" type="text" name="p_age" id="p_age" placeholder="歲數"></td>
                </tr>
                <tr>
                    <td><textarea name="p_introduction" id="p_introduction" placeholder="自我介紹(限100字)"></textarea></td>
                    <input name="m_id" type="hidden" id="m_id" value="<?php echo $row_RecMember["m_id"] ?>">
                </tr>

                <!-- <tr>
                    <td>
                        <div class="preview">
                            <img id="pp" src="" alt="">
                        </div>
                    </td>
                </tr> -->
                <!-- 1223紹寧->預覽裁切尚未完成，暫時關閉 -->

                <tr>
                    <td>
                        <label id="cover" class="upload_cover"><span>上傳照片</span>
                            <input id="file" type="file" accept=".jpg,.jpeg" name="pp_picurl[]" id="pp_picurl[]">
                            <input type="hidden" name="pp_subject[]" id="pp_subject[]" />
                            <!--說明用不到先關掉-->
                            <input class="filename" id="aim" type="text" disabled="disable" value="檔名">
                            <input class="cancel" id="cancel" type="button" value="清除">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label id="cover1" class="upload_cover"><span>上傳照片</span>
                            <input id="file1" type="file" accept=".jpg,.jpeg" name="pp_picurl[]" id="pp_picurl[]">
                            <input type="hidden" name="pp_subject[]" id="pp_subject[]" />
                            <!--說明用不到先關掉-->
                            <input class="filename" id="aim1" type="text" disabled="disable" value="檔名">
                            <input class="cancel" id="cancel1" type="button" value="清除">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label id="cover2" class="upload_cover"><span>上傳照片</span>
                            <input id="file2" type="file" accept=".jpg,.jpeg" name="pp_picurl[]" id="pp_picurl[]">
                            <input type="hidden" name="pp_subject[]" id="pp_subject[]" />
                            <!--說明用不到先關掉-->
                            <input class="filename" id="aim2" type="text" disabled="disable" value="檔名">
                            <input class="cancel" id="cancel2" type="button" value="清除">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label id="cover3" class="upload_cover"><span>上傳照片</span>
                            <input id="file3" type="file" accept=".jpg,.jpeg" name="pp_picurl[]" id="pp_picurl[]">
                            <input type="hidden" name="pp_subject[]" id="pp_subject[]" />
                            <!--說明用不到先關掉-->
                            <input class="filename" id="aim3" type="text" disabled="disable" value="檔名">
                            <input class="cancel" id="cancel3" type="button" value="清除">
                        </label>
                    </td>
                </tr>

                <!-- 上傳檔名用--1217紹寧 -->
                <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script>
                <script type="text/javascript" src="script/petphoto.js"></script>

                <tr>
                    <td>
                        <p>
                            <input name="action" type="hidden" id="action" value="add">
                            <input class="submit" type="submit" name="button" id="button" value="確定新增">
                            <!-- <input type="button" name="button2" id="button2" value="回上一頁" onClick="window.history.back();" > -->
                        </p>
                    </td>
                <tr>
            </table>
        </form>
    </div>
</div>


<?php include("_footer.php"); ?>