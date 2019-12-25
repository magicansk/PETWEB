<?php
require_once("connMysql.php"); //用來引入connMysql的php檔
session_start();


function GetSQLValueStringA($theValue, $theType)
{
    switch ($theType) {
        case "string":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_MAGIC_QUOTES) : "";
            break;
        case "int":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_NUMBER_INT) : "";
            break;
    }
    return $theValue;
}
if (isset($_POST["action"]) && ($_POST["action"] == "update")) {
    global $db_link;
    $query_update = "UPDATE petdata SET p_name=?, p_class=?, p_breed=?, p_sex=?, p_age=?, p_introduction=? WHERE p_id=?";
    $stmt = $db_link->prepare($query_update);
    $stmt->bind_param(
        "ssssisi",
        GetSQLValueStringA($_POST["p_name"], 'string'),
        GetSQLValueStringA($_POST["p_class"], 'string'),
        GetSQLValueStringA($_POST["p_breed"], 'string'),
        GetSQLValueStringA($_POST["p_sex"], 'string'),
        GetSQLValueStringA($_POST["p_age"], 'int'),
        GetSQLValueStringA($_POST["p_introduction"], 'string'),
        GetSQLValueStringA($_POST["p_id"], 'int')
    );
    $stmt->execute();
    $p_id = $_POST["p_id"];
    $stmt->close();

    //置換照片&解說 12.5紹寧新增
    for ($i = 0; $i < count($_FILES["c_pp_picurl"]["name"]); $i++) {
        if ($_FILES["c_pp_picurl"]["tmp_name"][$i] != "") {
            unlink("photos/" . $_POST["pp_picurl"][$i]);
            $query_insert = "UPDATE petphoto SET pp_picurl=? WHERE pp_id={$_POST["pp_id"][$i]}";
            $stmt = $db_link->prepare($query_insert);
            $rand = mt_rand(1,999);
            $stmt->bind_param(
                "s",
                GetSQLValueStringA($p_id . $rand . $_FILES["c_pp_picurl"]["name"][$i], "string")
            );
            $stmt->execute();

            $src = imagecreatefromjpeg($_FILES['c_pp_picurl']['tmp_name'][$i]); //壓縮圖片12.5紹寧新增->網路尋找
            // 取得來源圖片長寬
            $src_w = imagesx($src);
            $src_h = imagesy($src);
            // 依長與寬兩者最短的邊來算出要抓的正方形邊長
            if ($src_w > $src_h) {
                $new_w = $src_h;
                $new_h = $src_h;
            } else {
                $new_w = $src_w;
                $new_h = $src_w;
            }
            // 以長方形的中心來取得正方形的左上方原點
            $srt_w = ($src_w - $new_w) / 2;
            $srt_h = ($src_h - $new_h) / 2;
            // 定義一個圖形 ( 針對正方形圖形 )
            $newpc = imagecreatetruecolor($new_w, $new_h);
            // 抓取正方形的截圖
            imagecopy($newpc, $src, 0, 0, $srt_w, $srt_h, $new_w, $new_h);
            // 建立縮圖
            $finpic = imagecreatetruecolor(600, 600);
            // 開始縮圖
            imagecopyresampled($finpic, $newpc, 0, 0, 0, 0, 600, 600, $new_w, $new_h);
            // 儲存縮圖到指定 thumb 目錄
            imagejpeg($finpic, "photos/" . $p_id . $rand . $_FILES['c_pp_picurl']['name'][$i]);

            $stmt->close();
        }
    }
    for ($i = 0; $i < count($_FILES["c_pp_picurl"]); $i++) {
        if ($_POST["c_pp_subject"][$i] != "") {
            $query_insert = "UPDATE petphoto SET pp_subject=? WHERE pp_id={$_POST["pp_id"][$i]}";
            $stmt = $db_link->prepare($query_insert);
            $stmt->bind_param(
                "s",
                GetSQLValueStringA($_POST["c_pp_subject"][$i], "string")
            );
            $stmt->execute();
            $stmt->close();
        }
    }

    //新增照片
    for ($i = 0; $i < count($_FILES["pp_picurl"]["name"]); $i++) {
        if ($_FILES["pp_picurl"]["tmp_name"][$i] != "") {
            $query_insert = "INSERT INTO petphoto (p_id, pp_date, pp_picurl, pp_subject) VALUES (?, NOW(), ?, ?)";
            $stmt = $db_link->prepare($query_insert);
            $rand = mt_rand(1,999);
            $stmt->bind_param(
                "iss",
                GetSQLValueStringA($p_id, "int"),
                GetSQLValueStringA($p_id . $rand .$_FILES["pp_picurl"]["name"][$i], "string"),
                GetSQLValueStringA($_POST["pp_subject"][$i], "string")
            );
            $stmt->execute();

            $src = imagecreatefromjpeg($_FILES['pp_picurl']['tmp_name'][$i]); //壓縮圖片12.5紹寧新增->網路尋找
            // 取得來源圖片長寬
            $src_w = imagesx($src);
            $src_h = imagesy($src);
            // 依長與寬兩者最短的邊來算出要抓的正方形邊長
            if ($src_w > $src_h) {
                $new_w = $src_h;
                $new_h = $src_h;
            } else {
                $new_w = $src_w;
                $new_h = $src_w;
            }
            // 以長方形的中心來取得正方形的左上方原點
            $srt_w = ($src_w - $new_w) / 2;
            $srt_h = ($src_h - $new_h) / 2;
            // 定義一個圖形 ( 針對正方形圖形 )
            $newpc = imagecreatetruecolor($new_w, $new_h);
            // 抓取正方形的截圖
            imagecopy($newpc, $src, 0, 0, $srt_w, $srt_h, $new_w, $new_h);
            // 建立縮圖
            $finpic = imagecreatetruecolor(600, 600);
            // 開始縮圖
            imagecopyresampled($finpic, $newpc, 0, 0, 0, 0, 600, 600, $new_w, $new_h);
            // 儲存縮圖到指定 thumb 目錄
            imagejpeg($finpic, "photos/" . $p_id . $rand . $_FILES['pp_picurl']['name'][$i]);

            $stmt->close();
        }
    }

    //執行檔案刪除
    for ($i = 0; $i < count($_POST["delcheck"]); $i++) {
        $delid = $_POST["delcheck"][$i];
        $query_del = "DELETE FROM petphoto WHERE pp_id={$_POST["pp_id"][$delid]}";
        $db_link->query($query_del);
        unlink("photos/" . $_POST["delfile"][$delid]);
    }


    //重新導向
    header("Location: pet_adminupdate.php?id=" . $p_id);
}
