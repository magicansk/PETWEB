<?php
//資料庫主機設定
$db_host = "localhost"; //主機位置->可換成IP
$db_username = "root";  //資料庫帳號
$db_password = "1234";  //資料庫密碼
$db_name = "phpmember"; //連接的資料庫名稱
//連線資料庫 
$db_link = @new mysqli($db_host, $db_username, $db_password, $db_name);
//錯誤處理
if ($db_link->connect_error != "") {
	echo "資料庫連結失敗！";
} else {
	//設定字元集與編碼
	$db_link->query("SET NAMES 'utf8'");
}

function adminJudge() //判斷是否為admin
{
	//檢查是否經過登入
	if (!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"] == "")) {
		header("Location: index.php");
	}
	//檢查權限是否足夠
	if ($_SESSION["memberLevel"] == "member") {
		header("Location: index.php");
	}
}

function recAllmemberdata() //選取所有一般會員資料
{
	global $db_link;
	global $RecMemberData;
	global $total_records;
	global $total_pages;
	global $num_pages;
	//預設每頁筆數
	$pageRow_records = 5;
	//預設頁數
	$num_pages = 1;
	//若已經有翻頁，將頁數更新
	if (isset($_GET['page'])) {
		$num_pages = $_GET['page'];
	}
	//本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
	$startRow_records = ($num_pages - 1) * $pageRow_records;
	//未加限制顯示筆數的SQL敘述句
	$query_RecMember = "SELECT * FROM memberdata WHERE m_level<>'admin' ORDER BY m_jointime DESC";
	//加上限制顯示筆數的SQL敘述句，由本頁開始記錄筆數開始，每頁顯示預設筆數
	$query_limit_RecMember = $query_RecMember . " LIMIT {$startRow_records}, {$pageRow_records}";
	//以加上限制顯示筆數的SQL敘述句查詢資料到 $resultMember 中
	$RecMemberData = $db_link->query($query_limit_RecMember);
	//以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_resultMember 中
	$all_RecMember = $db_link->query($query_RecMember);
	//計算總筆數
	$total_records = $all_RecMember->num_rows;
	//計算總頁數=(總筆數/每頁筆數)後無條件進位。
	$total_pages = ceil($total_records / $pageRow_records);
}

function deleteMamber() //刪除會員
{
	if (isset($_GET["action"]) && ($_GET["action"] == "delete")) {
		$query_delMember = "DELETE FROM memberdata WHERE m_id=?";
		global $db_link;
		$stmt = $db_link->prepare($query_delMember);
		$stmt->bind_param("i", $_GET["id"]);
		$stmt->execute();
		$stmt->close();
		//重新導向回到主畫面
		header("Location: member_admin.php");
	}
}


function recUpdatamember() //繫結選取會員資料
{
	global $db_link;
	global $row_Updatamember;
	$query_RecMember = "SELECT * FROM memberdata WHERE m_id='{$_GET["id"]}'";
	$RecMember = $db_link->query($query_RecMember);
	$row_Updatamember = $RecMember->fetch_assoc();
}

function admUpdatemember() //更新會員
{
	function GetSQLValueStringM($theValue, $theType)
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
	if (isset($_POST["action"]) && ($_POST["action"] == "update")) {
		global $db_link;
		$query_update = "UPDATE memberdata SET m_passwd=?, m_name=?, m_sex=?, m_birthday=?, m_email=?, m_phone=?, m_address=? WHERE m_id=?";
		$stmt = $db_link->prepare($query_update);
		//檢查是否有修改密碼 12.14組長+紹寧更新
		if ($_POST["m_passwd"] == "") {
			$query_updatepasswd = "SELECT m_passwd FROM memberdata WHERE m_id='{$_GET["id"]}'";
			$updatepasswd = $db_link->query($query_updatepasswd);
			$recPasswd = $updatepasswd->fetch_assoc();
			$mpass = $recPasswd['m_passwd'];
		} elseif (($_POST["m_passwd"] != "") && ($_POST["m_passwd"] == $_POST["m_passwdrecheck"])) {
			$mpass = password_hash($_POST["m_passwd"], PASSWORD_DEFAULT);
		}
		$stmt->bind_param(
			"sssssssi",
			$mpass,
			GetSQLValueStringM($_POST["m_name"], 'string'),
			GetSQLValueStringM($_POST["m_sex"], 'string'),
			GetSQLValueStringM($_POST["m_birthday"], 'string'),
			GetSQLValueStringM($_POST["m_email"], 'email'),

			GetSQLValueStringM($_POST["m_phone"], 'string'),
			GetSQLValueStringM($_POST["m_address"], 'string'),
			GetSQLValueStringM($_POST["m_id"], 'int')
		);
		$stmt->execute();
		$stmt->close();
		//重新導向
		header("Location: member_admin.php");
	}
}

function admDeletepetdata() //刪除寵物資料
{
	if (isset($_GET["action"]) && ($_GET["action"] == "delete")) {
		global $db_link;
		$query_delPhoto = "SELECT pp_picurl FROM petphoto WHERE p_id={$_GET["id"]} ";
		$delPhoto = $db_link->query($query_delPhoto);
		while ($row_delPhoto = $delPhoto->fetch_assoc()) {
			unlink("photos/" . $row_delPhoto["pp_picurl"]);
		} //12.4紹寧新增:刪除資料同時刪除資料夾中的檔案

		$query_delMember = "DELETE petdata,petphoto FROM petdata LEFT JOIN petphoto ON petdata.p_id = petphoto.p_id WHERE petdata.p_id=? ";
		$stmt = $db_link->prepare($query_delMember);
		$stmt->bind_param("i", $_GET["id"]);
		$stmt->execute();
		$stmt->close();

		//重新導向回到主畫面
		header("Location: pet_admin.php");
	}
}

function recAllpetdata() //選取所有寵物資料
{
	global $db_link;
	global $RecAllpet;
	global $total_records;
	global $total_pages;
	global $num_pages;
	//預設每頁筆數
	$pageRow_records = 5;
	//預設頁數
	$num_pages = 1;
	//若已經有翻頁，將頁數更新
	if (isset($_GET['page'])) {
		$num_pages = $_GET['page'];
	}
	//本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
	$startRow_records = ($num_pages - 1) * $pageRow_records;
	//未加限制顯示筆數的SQL敘述句
	$query_RecMember = "SELECT `p_id`,`p_name`,`p_class`,`p_sex`,`p_age`,`p_breed`,`m_id`,`m_username` FROM `petdata` JOIN `memberdata` USING(`m_id`)";
	//加上限制顯示筆數的SQL敘述句，由本頁開始記錄筆數開始，每頁顯示預設筆數
	$query_limit_RecMember = $query_RecMember . " LIMIT {$startRow_records}, {$pageRow_records}";
	//以加上限制顯示筆數的SQL敘述句查詢資料到 $resultMember 中
	$RecAllpet = $db_link->query($query_limit_RecMember);
	//以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_resultMember 中
	$all_RecMember = $db_link->query($query_RecMember);
	//計算總筆數
	$total_records = $all_RecMember->num_rows;
	//計算總頁數=(總筆數/每頁筆數)後無條件進位。
	$total_pages = ceil($total_records / $pageRow_records);
}

function recUpdatapet() //adm繫結登入寵物資料
{
	global $db_link;
	global $row_RecPet;
	$query_RecPet = "SELECT * FROM `petdata` WHERE p_id='{$_GET["id"]}'";
	$RecPet = $db_link->query($query_RecPet);
	$row_RecPet = $RecPet->fetch_assoc(); //存為陣列

	global $RecPhoto;
	$query_RecPhoto = "SELECT * FROM `petphoto` WHERE p_id='{$_GET["id"]}'";
	$RecPhoto = $db_link->query($query_RecPhoto);
}

function userUpdatemember() //會員更新資料
{
	function GetSQLValueStringUM($theValue, $theType)
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
	//執行更新動作
	if (isset($_POST["action"]) && ($_POST["action"] == "update")) {
		global $db_link;
		$query_update = "UPDATE memberdata SET m_passwd=?, m_name=?, m_sex=?, m_birthday=?, m_email=?, m_phone=?, m_address=? WHERE m_id=?";
		$stmt = $db_link->prepare($query_update);
		//檢查是否有修改密碼 12.14組長+紹寧更新
		if ($_POST["m_passwd"] == "") {
			$query_updatepasswd = "SELECT m_passwd FROM memberdata WHERE m_username = '{$_SESSION["loginMember"]}'";
			$updatepasswd = $db_link->query($query_updatepasswd);
			$recPasswd = $updatepasswd->fetch_assoc();
			$mpass = $recPasswd['m_passwd'];
		}
		if (($_POST["m_passwd"] != "") && ($_POST["m_passwd"] == $_POST["m_passwdrecheck"])) {
			$mpass = password_hash($_POST["m_passwd"], PASSWORD_DEFAULT);
		}
		$stmt->bind_param(
			"sssssssi",
			$mpass,
			GetSQLValueStringUM($_POST["m_name"], 'string'),
			GetSQLValueStringUM($_POST["m_sex"], 'string'),
			GetSQLValueStringUM($_POST["m_birthday"], 'string'),
			GetSQLValueStringUM($_POST["m_email"], 'email'),

			GetSQLValueStringUM($_POST["m_phone"], 'string'),
			GetSQLValueStringUM($_POST["m_address"], 'string'),
			GetSQLValueStringUM($_POST["m_id"], 'int')
		);
		$stmt->execute();
		$stmt->close();
		//若有修改密碼，則登出回到首頁。
		if (($_POST["m_passwd"] != "") && ($_POST["m_passwd"] == $_POST["m_passwdrecheck"])) {
			unset($_SESSION["loginMember"]);
			unset($_SESSION["memberLevel"]);
			header("Location: index.php");
		}
		//重新導向
		header("Location: index.php");
	}
}

function deletePetdata() //會員刪除寵物資料
{
	if (isset($_GET["action"]) && ($_GET["action"] == "delete")) {
		global $db_link;
		$query_delPhoto = "SELECT pp_picurl FROM petphoto WHERE p_id={$_GET["id"]} ";
		$delPhoto = $db_link->query($query_delPhoto);
		while ($row_delPhoto = $delPhoto->fetch_assoc()) {
			unlink("photos/" . $row_delPhoto["pp_picurl"]);
		} //12.4紹寧新增:刪除資料同時刪除資料夾中的檔案

		$query_delMember = "DELETE petdata,petphoto FROM petdata LEFT JOIN petphoto ON petdata.p_id = petphoto.p_id WHERE petdata.p_id=? ";
		$stmt = $db_link->prepare($query_delMember);
		$stmt->bind_param("i", $_GET["id"]);
		$stmt->execute();
		$stmt->close();

		//重新導向回到主畫面
		header("Location: pet_mypet.php");
	}
}

function recUserpet() //會員選取寵物
{
	global $db_link;
	global $RecPet;
	global $m_id;

	$query_RecPet = "SELECT * FROM `petdata` WHERE m_id='{$m_id}'";
	$RecPet = $db_link->query($query_RecPet);
}

function userPet() //會員繫結登入寵物資料
{
	global $db_link;
	global $row_RecMember;
	global $RecPhoto;
	global $row_RecPet;
	//繫結登入寵物資料
	$query_RecPet = "SELECT * FROM `petdata` WHERE p_id='{$_GET["id"]}' AND m_id='{$row_RecMember["m_id"]}'";
	$RecPet = $db_link->query($query_RecPet);
	$row_RecPet = $RecPet->fetch_assoc(); //存為陣列

	//繫結登入寵物照片
	$query_RecPhoto = "SELECT * FROM `petphoto` WHERE p_id='{$_GET["id"]}' AND p_id='{$row_RecPet["p_id"]}'";
	$RecPhoto = $db_link->query($query_RecPhoto);

	//12.6紹寧新增->如果撈不到資料自動跳轉
	if ($row_RecPet["p_name"] == "") {
		header("Location: pet_mypet.php");
	}
}

function register() //註冊
{
	function GetSQLValueStringRS($theValue, $theType)
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

	global $db_link;
	if (isset($_POST["action"]) && ($_POST["action"] == "join")) {
		require_once("connMysql.php");
		//找尋帳號是否已經註冊
		$query_RecFindUser = "SELECT m_username FROM memberdata WHERE m_username='{$_POST["m_username"]}'";
		$RecFindUser = $db_link->query($query_RecFindUser);
		if ($RecFindUser->num_rows > 0) {
			header("Location: register.php?errMsg=1&username={$_POST["m_username"]}");
		} else {
			//若沒有執行新增的動作	
			$query_insert = "INSERT INTO memberdata (m_name, m_username, m_passwd, m_sex, m_birthday, m_email, m_phone, m_address, m_jointime) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
			$stmt = $db_link->prepare($query_insert);
			$stmt->bind_param(
				"ssssssss",
				GetSQLValueStringRS($_POST["m_name"], 'string'),
				GetSQLValueStringRS($_POST["m_username"], 'string'),
				password_hash($_POST["m_passwd"], PASSWORD_DEFAULT), //password_hash做加密
				GetSQLValueStringRS($_POST["m_sex"], 'string'),
				GetSQLValueStringRS($_POST["m_birthday"], 'string'),
				GetSQLValueStringRS($_POST["m_email"], 'email'),

				GetSQLValueStringRS($_POST["m_phone"], 'string'),
				GetSQLValueStringRS($_POST["m_address"], 'string')
			);
			$stmt->execute();
			$stmt->close();
			$db_link->close();
			header("Location: register.php?loginStats=1");
		}
	}
}

function login() //登入
{
	global $db_link;
	if (isset($_POST["username"]) && isset($_POST["passwd"])) {
		if (($_POST['anscheck'] == "") || ($_POST['anscheck'] != $_SESSION['ans_ckword'])) { //11.27紹寧新增-執行登入驗證碼
			header("Location: signin.php?errMsg=2"); //登入頁
			//使用JS可調整不必重填帳號密碼
			//echo '<script type="text/javascript">alert("請填寫電子郵件!");</script>';
		} else {
			//繫結登入會員資料
			$query_RecLogin = "SELECT m_username, m_passwd, m_level FROM memberdata WHERE m_username=?";
			$stmt = $db_link->prepare($query_RecLogin);
			$stmt->bind_param("s", $_POST["username"]);
			$stmt->execute();
			//取出帳號密碼的值綁定結果
			$stmt->bind_result($username, $passwd, $level);
			$stmt->fetch();
			$stmt->close();
			//比對密碼，若登入成功則呈現登入狀態
			if (password_verify($_POST["passwd"], $passwd)) {
				//計算登入次數及更新登入時間
				$query_RecLoginUpdate = "UPDATE memberdata SET m_login=m_login+1, m_logintime=NOW() WHERE m_username=?";
				$stmt = $db_link->prepare($query_RecLoginUpdate);
				$stmt->bind_param("s", $username);
				$stmt->execute();
				$stmt->close();
				//設定登入者的名稱及等級
				$_SESSION["loginMember"] = $username;
				$_SESSION["memberLevel"] = $level;
				//使用Cookie記錄登入資料
				if (isset($_POST["rememberme"]) && ($_POST["rememberme"] == "true")) {
					setcookie("remUser", $_POST["username"], time() + 365 * 24 * 60);
					setcookie("remPass", $_POST["passwd"], time() + 365 * 24 * 60);
				} else {
					if (isset($_COOKIE["remUser"])) {
						setcookie("remUser", $_POST["username"], time() - 100);
						setcookie("remPass", $_POST["passwd"], time() - 100);
					}
				}
				//若帳號等級為 member 則導向會員中心
				if ($_SESSION["memberLevel"] == "member") {
					echo '<script type="text/javascript">top.location.href="index.php";</script>'; //header("Location: member_center.php");
					//否則則導向管理中心
				} else {
					echo '<script type="text/javascript">top.location.href="index.php";</script>'; //header("Location: member_center.php");	
				}
			} else {
				header("Location: signin.php?errMsg=1"); //登入頁
			}
		}
	}
}

function loginOut() //登出
{
	if (isset($_GET["logout"]) && ($_GET["logout"] == "true")) {
		unset($_SESSION["loginMember"]);
		unset($_SESSION["memberLevel"]);
		header("Location: index.php");
	}
}

function loginJudge() //判斷有登入-login
{
	if (!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"] == "")) {
		echo "<script>alert('請先登入!!');</script>";
		echo '<script>window.location.href="index.php";</script>';
	}
}

function signinJudge() //判斷沒登入-singin
{
	if (isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"] != "")) {
		header("Location: index.php");
	}
}

function memberData() //登入會員資料及判斷選單
{
	if (isset($_SESSION["loginMember"]) && ($_SESSION["memberLevel"] != "")) {
		global $db_link;
		global $row_RecMember;
		$query_RecMember = "SELECT * FROM memberdata WHERE m_username = '{$_SESSION["loginMember"]}'";
		$RecMember = $db_link->query($query_RecMember);
		$row_RecMember = $RecMember->fetch_assoc();
		//判別會員選單語法12.8紹寧新增
		global $Lbtn;
		global $Lbtn2;
		$query_Lbtn = "SELECT * FROM levelbutton WHERE m_level = '{$row_RecMember['m_level']}' ORDER BY lb_id";
		$Lbtn = $db_link->query($query_Lbtn);
		$Lbtn2 = $db_link->query($query_Lbtn);
	}
}

//NAV選單語法(11.30紹寧新增)
//撈取選單路徑、圖示、名稱、父層
$sql = "SELECT * FROM navbutton ORDER BY id ";
$result = $db_link->query($sql);
$sq_data = array();
while ($row = $result->fetch_assoc()) {
	$sq_data[] = array('id' => $row['id'], 'href' => $row['href'], 'icon' => $row['icon'], 'name' => $row['name'], 'parent_id' => $row['parent_id']);
}
//排序陣列
$menu = array();
foreach ($sq_data as $item) {
	$menu[$item['parent_id']][] = $item;
}
//輸出選單
function makeMenu($menu, $parent_id, $dep)
{
	$html = "";
	$html .= "<ul class='drop-down-menu'>";
	foreach ($menu[$parent_id] as $item) {
		$html .= "<li id='tree_{$item['id']}'><a class='media-m-pdd media-l-pdd media-xl-pdd' href='{$item['href']}'><img src='{$item['icon']}'>{$item['name']}</a>";
		if (isset($menu[$item['id']])) {
			$html .= makeMenu($menu, $item['id'], $dep);
			$dep++;
		}
		$html .= "</li>";
	}
	$html .= "</ul>";
	return $html;
}
