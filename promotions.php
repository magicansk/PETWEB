<?php
//檢查登入狀態
require_once("connMysql.php"); //用來引入connMysql的php檔
session_start();
loginOut(); //執行登出
memberData(); //登入會員資料及判斷選單
?>
<HTML>

<HEAD>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <meta name="description" content="培茲k9健康乾燥生食優惠中!k9 Natural使用紐西蘭天然食材，利用特殊技術急速冷凍保留最新鮮最完整的營養，選擇培茲給家中毛小孩更好的。">
    <TITLE>培茲PETS-購物說明</TITLE>
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel=stylesheet type="text/css" href="css/rwd.css">
    <link rel=stylesheet type="text/css" href="css/common.css">
    <link rel=stylesheet type="text/css" href="css/promotions.css">
</HEAD>
<?php include("_header.php"); ?>
<div class="nav2 media-m-hid media-l-center">
    <div class="location media-xl-10">
        <ul class="breadcrumb">
            <li><span>目前位置</span></li>
            <li><span><a href="index.php">首頁</a></span></li>
            <li><span>購物說明</span></li>
        </ul>
    </div>
</div>
<div class="content">
    <div class="title media-m-12">
        <h3>無可比擬!今天就應該開始讓牠享受K9!</h3>
    </div>
    <div class="k9_item media-xl-10">
        <p>K9 Natural使用紐西蘭生鮮完全無烹煮的食材，用特殊技術生鮮急凍保留食材最新鮮完整的營養，優於一般常見乾飼料，是最天然的寵物食品。不論您是否願意開始給您的寵物嘗試生食，若您希望能找到一款對牠最好的寵物食品，那K9 Natural永遠會是您的第一選擇。</p>
    </div>
    <div class="k9_item media-xl-10">
        <h3>100%紐西蘭人類等級食材</h3>
        <p>堅持100%紐西蘭天然放牧草飼牛/羊/鹿與當季生鮮蔬果，以人類等級食材規格製作。</p>
    </div>
    <div class="k9_item media-xl-10">
        <h3>90%高含肉量</h3>
        <p>紐西蘭K9 Natural犬貓生食餐含有90%以上的新鮮生肉(含血液、內臟與絞碎生骨)，並搭配紐西蘭當季蔬果。高含肉量配方，以一種回歸自然的方式，用真正的肉滿足最原始的食性與生理需求。與現代社會近幾十年來用已經烹調和加工過的便利飼料來餵養犬貓的習慣截然不同。</p>
    </div>
    <div class="k9_item media-xl-10">
        <h3>生鮮急凍，新鮮吃的到</h3>
        <p>特殊低溫冷凍與低溫冷凍乾燥技術，食材營養完整保留，生鮮食材含有豐富蛋白質、脂肪、鈣質、維生素、礦物質、植物營養素、酵素、微量原素並且低碳水化合物。</p>
    </div>
    <div class="k9_item media-xl-10">
        <h3>紐西蘭綠唇貝添加</h3>
        <p>添加紐西蘭特有的綠唇貝，提供寵物足夠的Omega3、葡萄糖胺及軟骨素，打造強健有韌性的關節和軟骨，預防關節炎的發 生與老化。</p>
    </div>
    <div class="k9_item media-xl-10">
        <h3>零穀類與人工添加物</h3>
        <p>無小麥、米、穀類、玉米、大豆等致敏成份，絕不含食品添加劑、防腐劑等傷害寵物身體的成分，不含肉粉及加工骨粉。</p>
    </div>
    <div class="k9_item media-xl-10">
        <h3>單一蛋白質，低過敏源</h3>
        <p>單一口味，單一肉類蛋白質，使用原隻動物鮮肉、血液、內臟與生骨，降低寵物對特定肉類過敏的風險。 （雞肉與貓咪生食餐除外）</p>
    </div>
    <div class="title media-m-12">
        <h3>紐西蘭 K9 Natural狗狗乾燥生食優惠口味</h3>
        <img src="images/promotions/dog_top.jpg " alt="紐西蘭健康狗狗乾燥生食K9系列">
    </div>

    <div class="k9 media-m-10 media-l-9 media-xl-8">
        <div class="pic">
            <img src="images/promotions/beef_icon.png" alt="紐西蘭草飼牛口味乾燥生食">
        </div>
        <div class="text1">
            <h1>紐西蘭草飼牛</h1>
            <h2>牛肉富含優質蛋白質， 味道香濃，幫毛孩補血補鐵，頭好壯壯!</h2>
            <h3>成份</h3>
            <p>牛肉，牛肝，牛肚，牛腎，牛心，牛血，雞蛋，牛脾，磨碎牛骨，葵花籽油，亞麻籽殼，棕色海藻，紐西蘭綠唇貝，南瓜，綠花椰菜，花椰菜，甘藍菜，硫酸鉀，乾海藻，蘋果，梨，鹽，維生素E，鋅蛋白，鐵蛋白，氧化鎂，硒酵母，銅蛋白，錳蛋白，&beta;-胡蘿蔔素，維生素B1，維生素D3</p>
            <h3>營養分析(加水前)</h3>
            <p>優質蛋白質(至少)35%，粗脂肪(至少)37%，粗纖維(最多)2%，水分(最多)8%，Omega3脂肪酸(至少)0.55％，鈣2.33%，磷1.42%,鎂0.12%，卡路里：5,269kcal/1公斤; 237 kcal/杯</p>
        </div>
    </div>
    <div class="k9 media-m-10 media-l-9 media-xl-8">
        <div class="pic">
            <img src="images/promotions/chicken_icon.png" alt="紐西蘭放山雞口味乾燥生食">
        </div>
        <div class="text2">
            <h1>紐西蘭放山雞</h1>
            <h2>低脂肪高蛋白，生食入門的最佳選擇， 強烈推薦給挑嘴的毛孩。</h2>
            <h3>成份</h3>
            <p>雞肉，雞蛋，亞麻籽殼，鱈魚油，棕色海藻，紐西蘭綠唇貝，南瓜，綠花椰菜，花椰菜，甘藍菜，硫酸鉀，乾海藻，蘋果，梨，鹽，維生素E，鋅蛋白，鐵蛋白，葵花籽油，氧化鎂，硒酵母，銅蛋白，錳蛋白，&beta;-胡蘿蔔素，維生素B1，維生素D3</p>
            <h3>營養分析(加水前)</h3>
            <p>優質蛋白質(至少)48%，粗脂肪(至少)34%，粗纖維(最多)2%，水分(最多)8%，Omega3脂肪酸(至少)0.28％，鈣2.09%，磷1.25%，鎂0.12%，卡路里：4,986kcal/1公斤 ; 174 kcal/杯</p>
        </div>
    </div>
    <div class="k9 media-m-10 media-l-9 media-xl-8">
        <div class="pic">
            <img src="images/promotions/lamb_icon.png" alt=">紐西蘭草飼羊口味乾燥生食">
        </div>
        <div class="text3">
            <h1>紐西蘭草飼羊</h1>
            <h2>羊肉低致敏的特性，幫助皮膚毛髮健康更加亮麗，搔癢問題首選。</h2>
            <h3>成份</h3>
            <p>羊肉，羊肝，羊心，羊肚，羊血，雞蛋，羊脾，羊腎，磨碎羊骨，葵花籽油，亞麻籽殼，棕色海藻，紐西蘭綠唇貝，南瓜，綠花椰菜，花椰菜，甘藍菜，硫酸鉀，乾海藻，蘋果，梨，鹽，維生素E，鋅蛋白，鐵蛋白，氧化鎂，硒酵母，銅蛋白，錳蛋白，&beta;-胡蘿蔔素，維生素B1，維生素D3</p>
            <h3>營養分析(加水前)</h3>
            <p>優質蛋白質(至少)35%，粗脂肪(至少)37%，粗纖維(最多)2.5%，水分(最多)8%，Omega3脂肪酸(至少)0.97％，鈣2.27%，磷1.43%，鎂0.11%，卡路里：5,725kcal/1公斤; 258 kcal/杯</p>
        </div>
    </div>
</div>
<?php include("_footer.php"); ?>