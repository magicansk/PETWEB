<?php
require_once("connMysql.php"); //用來引入connMysql的php檔
session_start();


function GetSQLValueStringUA($theValue, $theType)
{
    switch ($theType) {
        case "string":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_MAGIC_QUOTES) : "";
            break;
        case "int":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_NUMBER_INT) : "";
            break;
        case "email":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_VALIDATE_EMAIL) : "";
            break;
    }
    return $theValue;
}

//新增毛孩資訊
global $db_link;
// global $m_id;


if (isset($_POST["action"]) && ($_POST["action"] == "add")) {
    $query_insert = "INSERT INTO petdata (p_name, p_class, p_breed, p_sex, p_age, p_introduction, m_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db_link->prepare($query_insert);
    $stmt->bind_param(
        "ssssisi",
        GetSQLValueStringUA($_POST["p_name"], "string"),
        GetSQLValueStringUA($_POST["p_class"], "string"),
        GetSQLValueStringUA($_POST["p_breed"], "string"),
        GetSQLValueStringUA($_POST["p_sex"], "string"),
        GetSQLValueStringUA($_POST["p_age"], "int"),
        GetSQLValueStringUA($_POST["p_introduction"], "string"),
        GetSQLValueStringUA($_POST["m_id"], "int")
    );
    $stmt->execute();

    //取得新增的相簿編號
    $p_id = $stmt->insert_id;
    $stmt->close();

    //新增照片
    for ($i = 0; $i < count($_FILES["pp_picurl"]["name"]); $i++) {
        if ($_FILES["pp_picurl"]["tmp_name"][$i] != "") {
            $query_insert = "INSERT INTO petphoto (p_id, pp_date, pp_picurl, pp_subject) VALUES (?, NOW(), ?, ?)";
            $stmt = $db_link->prepare($query_insert);
            $rand = mt_rand(1,999);
            $stmt->bind_param(
                "iss",
                GetSQLValueStringUA($p_id, "int"),
                GetSQLValueStringUA($p_id . $rand . $_FILES["pp_picurl"]["name"][$i], "string"),
                GetSQLValueStringUA($_POST["pp_picurl"][$i], "string")
            );
            $stmt->execute();
            // if (!move_uploaded_file($_FILES["pp_picurl"]["tmp_name"][$i], "photos/" . $p_id . $_FILES["pp_picurl"]["name"][$i])) die("檔案上傳失敗！");

            $src = imagecreatefromjpeg($_FILES['pp_picurl']['tmp_name'][$i]); //壓縮圖片12.5紹寧新增->網路尋找->12.23與跳轉衝突->關閉
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
    //重新導向
    sleep(2);
    header("Location: pet_mypet.php");
}
