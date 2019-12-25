<?php
require_once("connMysql.php"); //用來引入connMysql的php檔
session_start();
loginOut(); //執行登出
memberData(); //登入會員資料及判斷選單
?>
<HTML>

<HEAD>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <TITLE>培茲PETS-狗狗專區</TITLE>
    <link rel=stylesheet type="text/css" href="css/rwd.css">
    <link rel=stylesheet type="text/css" href="css/common.css">
    <link rel=stylesheet type="text/css" href="css/product.css">
</HEAD>
<?php include("_header.php"); ?>

<div class="nav2 media-m-hid media-l-center">
    <div class="location media-xl-10">
        <ul class="breadcrumb">
            <li><span>目前位置</span></li>
            <li><span><a href="index.php">首頁</a></span></li>
            <li><span>狗狗商品-生食專區</span></li>
        </ul>
    </div>
</div>

<script>
    var requestURL = "json/AC_Product.json";
    var request = new XMLHttpRequest();
    request.open('GET', requestURL);
    request.responseType = 'json';
    request.send();

    request.onload = function() {
        var pets = request.response;;
        showProduct(pets);
    }

    function showProduct(jsonObj) {

        const man = jsonObj["AC"];

        for (i = 0; i < man.length; i++) {
            const myArticle = document.createElement('article');
            const myH2 = document.createElement('h2');
            const myPara1 = document.createElement('img');
            const mytext = document.createElement('div');
            const myPara2 = document.createElement('p');
            const myPara3 = document.createElement('p');
            const myPara4 = document.createElement('p');
            const myPara5 = document.createElement('p');
            const myPara6 = document.createElement('p');
            const myList = document.createElement('ul');
            const btn = document.createElement("BUTTON");
            myH2.textContent = man[i].ProdName;
            myPara1.src = man[i].Img;
            myPara2.textContent = '商品:' + man[i].ProdName;
            myPara3.textContent = '規格:' + man[i].Model;
            myPara4.textContent = '價格:' + man[i].PriceOrigin;
            myPara5.textContent = '內容:' + man[i].ProdDisc;
            myPara6.textContent = '類別:' + man[i].CategoryID;
            btn.innerHTML = "加入購物車";
            myArticle.appendChild(myH2).style.color = 'brown';
            myArticle.appendChild(myH2).style.fontFamily = "微軟正黑體";
            myArticle.appendChild(myPara1);
            mytext.appendChild(myPara2).style.color = '#AF5F3C';
            mytext.appendChild(myPara3).style.color = '#B17844';
            mytext.appendChild(myPara4).style.color = '#CB1B45';
            mytext.appendChild(myPara5).style.color = '#E79460';
            mytext.appendChild(myPara6).style.color = '#B4A582';
            myArticle.appendChild(mytext);
            myArticle.appendChild(myList);
            myArticle.appendChild(btn);
            content.appendChild(myArticle);
        }


    }
</script>


<!-- <div class="title">
    <h1>狗狗-生食專區</h1>
</div> -->


<section class="content">

</section>

<script>
    const content = document.querySelector('section');
</script>

<?php include("_footer.php"); ?>