<?php
require_once("connMysql.php");
session_start();
adminJudge(); //判斷是否為admin登入
loginOut(); //執行登出
memberData(); //登入會員資料及判斷選單
recUpdatapet(); //繫結登入寵物資料
?>
<html>

<HEAD>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <TITLE>培茲PETS-修改毛孩資料</TITLE>
    <link rel=stylesheet type="text/css" href="css/rwd.css">
    <link rel=stylesheet type="text/css" href="css/common.css">
    <link rel=stylesheet type="text/css" href="css/pet_adminupdate.css">
</HEAD>

<?php include("_header.php"); ?>
<div class="nav2 media-m-hid media-l-center">
    <div class="location media-xl-10">
        <ul class="breadcrumb">
            <li><span>目前位置</span></li>
            <li><span><a href="index.php">首頁</a></span></li>
            <li><span><a href="pet_admin.php">毛孩名單管理</a></span></li>
            <li><span>修改毛孩資料</span></li>
        </ul>
    </div>
</div>

<div>
    <div class="m-adm">
        <div class="m-admbox"><label>修改資料</label></div>
        <div class="m-admbox"><label>本次登入時間<?php echo $row_RecMember["m_logintime"]; ?></label></div>
        <div class="m-admbox"><label>現在時間<div id="clock"></div></label></div>
    </div>
</div>

<div class="content">
    <div class="petadminupdate media-m-12 media-l-10 media-xl-10">
        <form action="crop_petadminupdate.php" method="POST" enctype="multipart/form-data" name="formJoin" id="formJoin" onSubmit="return checkForm();">
            <table>
                <?php $checkid = 0;
                                            $row_RecPhoto = $RecPhoto->fetch_all() ?>
                <?php if (count($row_RecPhoto) == 0) { ?>
                    <tr>
                        <td>您尚未上傳毛寶貝的照片唷~快點上傳吧!!</td>
                    </tr>
                <?php } ?>

                <?php if (isset($row_RecPhoto[0][4])) { ?>
                    <tr>
                        <td>
                            <img src="photos/<?php echo $row_RecPhoto[0][4] ?>" width="200" H>
                            <input name="pp_id[]" type="hidden" id="pp_id[]" value="<?php echo $row_RecPhoto[0][0]; ?>" />
                            <input name="delfile[]" type="hidden" id="delfile[]" value="<?php echo $row_RecPhoto[0][4]; ?>">
                            <input name="pp_picurl[]" type="hidden" id="pp_picurl[]" value="<?php echo $row_RecPhoto[0][4]; ?>" />
                            <input class="delete" name="delcheck[]" type="checkbox" id="delcheck[]" value="<?php echo $checkid;
                                                                                            $checkid++ ?>" />
                            <label class="delete" for="delcheck[]">刪除</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label id="cover" class="upload_cover">更換照片
                                <input id="file" type="file" accept=".jpg,.jpeg" name="c_pp_picurl[]" id="c_pp_picurl[]">
                                <input class="filename" id="aim" type="text" disabled="disable" value="檔名">
                                <input class="cancel" id="cancel" type="button" value="清除">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- <input type="text" name="c_pp_subject[]" id="c_pp_subject[]" value="<?php echo $row_RecPhoto[0][3]; ?>">相片解說用不到先關掉 -->
                            <hr>
                        </td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td>
                            <label id="cover" class="upload_cover">上傳照片
                                <input id="file" type="file" accept=".jpg,.jpeg" name="pp_picurl[]" id="pp_picurl[]">
                                <input class="filename" id="aim" type="text" disabled="disable" value="檔名">
                                <input class="cancel" id="cancel" type="button" value="清除">
                                <input type="hidden" name="pp_subject[]" id="pp_subject[]" />
                                <!--說明用不到先關掉-->
                            </label>
                        </td>
                    </tr>
                <?php } ?>

                <?php if (isset($row_RecPhoto[1][4])) { ?>
                    <tr>
                        <td>
                            <img src="photos/<?php echo $row_RecPhoto[1][4] ?>" width="200">
                            <input name="pp_id[]" type="hidden" id="pp_id[]" value="<?php echo $row_RecPhoto[1][0]; ?>" />
                            <input name="delfile[]" type="hidden" id="delfile[]" value="<?php echo $row_RecPhoto[1][4]; ?>">
                            <input name="pp_picurl[]" type="hidden" id="pp_picurl[]" value="<?php echo $row_RecPhoto[1][4]; ?>" />
                            <input class="delete" name="delcheck[]" type="checkbox" id="delcheck1[]" value="<?php echo $checkid;
                                                                                            $checkid++ ?>" />
                            <label class="delete" for="delcheck1[]">刪除</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label id="cover1" class="upload_cover">更換照片
                                <input id="file1" type="file" accept=".jpg,.jpeg" name="c_pp_picurl[]" id="c_pp_picurl[]">
                                <input class="filename" id="aim1" type="text" disabled="disable" value="檔名">
                                <input class="cancel" id="cancel1" type="button" value="清除">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- <input type="text" name="c_pp_subject[]" id="c_pp_subject[]" value="<?php echo $row_RecPhoto[1][3]; ?>">相片解說用不到先關掉 -->
                            <hr>
                        </td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td>
                            <label id="cover1" class="upload_cover">上傳照片
                                <input id="file1" type="file" accept=".jpg,.jpeg" name="pp_picurl[]" id="pp_picurl[]">
                                <input class="filename" id="aim1" type="text" disabled="disable" value="檔名">
                                <input class="cancel" id="cancel1" type="button" value="清除">
                                <input type="hidden" name="pp_subject[]" id="pp_subject[]" />
                                <!--說明用不到先關掉-->
                            </label>
                        </td>
                    </tr>
                <?php } ?>

                <?php if (isset($row_RecPhoto[2][4])) { ?>
                    <tr>
                        <td>
                            <img src="photos/<?php echo $row_RecPhoto[2][4] ?>" width="200">
                            <input name="pp_id[]" type="hidden" id="pp_id[]" value="<?php echo $row_RecPhoto[2][0]; ?>" />
                            <input name="delfile[]" type="hidden" id="delfile[]" value="<?php echo $row_RecPhoto[2][4]; ?>">
                            <input name="pp_picurl[]" type="hidden" id="pp_picurl[]" value="<?php echo $row_RecPhoto[2][4]; ?>" />
                            <input class="delete" name="delcheck[]" type="checkbox" id="delcheck2[]" value="<?php echo $checkid;
                                                                                            $checkid++ ?>" />
                            <label class="delete" for="delcheck2[]">刪除</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label id="cover2" class="upload_cover">更換照片
                                <input id="file2" type="file" accept=".jpg,.jpeg" name="c_pp_picurl[]" id="c_pp_picurl[]">
                                <input class="filename" id="aim2" type="text" disabled="disable" value="檔名">
                                <input class="cancel" id="cancel2" type="button" value="清除">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- <input type="text" name="c_pp_subject[]" id="c_pp_subject[]" value="<?php echo $row_RecPhoto[2][3]; ?>">相片解說用不到先關掉 -->
                            <hr>
                        </td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td>
                            <label id="cover2" class="upload_cover">上傳照片
                                <input id="file2" type="file" accept=".jpg,.jpeg" name="pp_picurl[]" id="pp_picurl[]">
                                <input class="filename" id="aim2" type="text" disabled="disable" value="檔名">
                                <input class="cancel" id="cancel2" type="button" value="清除">
                                <input type="hidden" name="pp_subject[]" id="pp_subject[]" />
                                <!--說明用不到先關掉-->
                            </label>
                        </td>
                    </tr>
                <?php } ?>

                <?php if (isset($row_RecPhoto[3][4])) { ?>
                    <tr>
                        <td>
                            <img src="photos/<?php echo $row_RecPhoto[3][4] ?>" width="200">
                            <input name="pp_id[]" type="hidden" id="pp_id[]" value="<?php echo $row_RecPhoto[3][0]; ?>" />
                            <input name="delfile[]" type="hidden" id="delfile[]" value="<?php echo $row_RecPhoto[3][4]; ?>">
                            <input name="pp_picurl[]" type="hidden" id="pp_picurl[]" value="<?php echo $row_RecPhoto[3][4]; ?>" />
                            <input class="delete" name="delcheck[]" type="checkbox" id="delcheck3[]" value="<?php echo $checkid;
                                                                                            $checkid++ ?>" />
                            <label class="delete" for="delcheck3[]">刪除</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label id="cover3" class="upload_cover">更換照片
                                <input id="file3" type="file" accept=".jpg,.jpeg" name="c_pp_picurl[]" id="c_pp_picurl[]">
                                <input class="filename" id="aim3" type="text" disabled="disable" value="檔名">
                                <input class="cancel" id="cancel3" type="button" value="清除">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- <input type="text" name="c_pp_subject[]" id="c_pp_subject[]" value="<?php echo $row_RecPhoto[3][3]; ?>">相片解說用不到先關掉-->
                            <hr>
                        </td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td>
                            <label id="cover3" class="upload_cover">上傳照片
                                <input id="file3" type="file" accept=".jpg,.jpeg" name="pp_picurl[]" id="pp_picurl[]">
                                <input class="filename" id="aim3" type="text" disabled="disable" value="檔名">
                                <input class="cancel" id="cancel3" type="button" value="清除">
                                <input type="hidden" name="pp_subject[]" id="pp_subject[]" />
                                <!--說明用不到先關掉-->
                            </label>
                        </td>
                    </tr>
                <?php } ?>

                <!-- 上傳檔名用--1217紹寧 -->
                <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script>
                <script type="text/javascript" src="script/petphoto.js"></script>

                <tr>
                    <td><input class="textbox" type="text" size="30" placeholder="名稱" name="p_name" id="p_name" value="<?php echo $row_RecPet["p_name"]; ?>"></td>
                </tr>

                <tr>
                    <td>
                        <span class="sex">分類
                            <input class="sex" name="p_class" id="cat" type="radio" value="貓咪" <?php if ($row_RecPet["p_class"] == "貓咪") echo "checked"; ?>><label for="cat">貓咪</label>
                            <input class="sex" name="p_class" id="dog" type="radio" value="狗狗" <?php if ($row_RecPet["p_class"] == "狗狗") echo "checked"; ?>><label for="dog">狗狗</label>
                    </td>
                </tr>

                <tr>
                    <td><input class="textbox" type="text" size="30" placeholder="品種" name="p_breed" id="p_breed" value="<?php echo $row_RecPet["p_breed"]; ?>"></td>
                </tr>

                <tr>
                    <td>
                        <span class="sex">性別
                            <input class="sex" name="p_sex" id="male" type="radio" value="男生" <?php if ($row_RecPet["p_sex"] == "男生") echo "checked"; ?>><label for="male">男生</label>
                            <input class="sex" name="p_sex" id="female" type="radio" value="女生" <?php if ($row_RecPet["p_sex"] == "女生") echo "checked"; ?>><label for="female">女生</label>
                    </td>
                </tr>

                <tr>
                    <td><input class="textbox" type="text" size="30" placeholder="歲數" name="p_age" id="p_age" value="<?php echo $row_RecPet["p_age"]; ?>"></td>
                </tr>

                <tr>
                    <td><input class="textbox" type="text" size="30" placeholder="自我介紹" name="p_introduction" id="p_introduction" value="<?php echo $row_RecPet["p_introduction"]; ?>"></td>
                </tr>

                <!--可用 multiple="multiple" 屬性一次上傳多個檔案-->
                <tr>
                    <td class="join" colspan="2">
                        <input name="p_id" type="hidden" id="p_id" value="<?php echo $row_RecPet["p_id"]; ?>">
                        <input name="action" type="hidden" id="action" value="update">
                        <input class="submit" name="submit2" type="submit" value="修改資料">
                        <input class="reset" type="reset" value="重設資料">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include("_footer.php"); ?>
<?php $db_link->close(); ?>