<?php 
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>狗狗專區</title>

    <style>
        section h2 {
            font-size: 20pt;
            font-family: 微軟正黑體;
            color:peru;
        }
        section p {
            font-size: 16pt;
            font-family: 微軟正黑體;
        }

        section button {
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid rgb(50, 50, 50);
            cursor: pointer;
            background-color: white;
            padding: 6px 15px; 
            /* transition: all 0.5s ease 0s; 
            padding: 6px 15px; 
            outline: none; 
            background-color: transparent;  */

        }

        section button:hover {
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 2px solid;
            cursor: pointer;
            transition: all 0.5s ease 0s;
            outline: none;
            padding: 6px 15px; 
            background-color: #E1A679 ;

        }
    </style>


    <link rel="stylesheet" href="">
    <script>

        var requestURL = "http://localhost/json/AA_Product.json";
        var request = new XMLHttpRequest();
        request.open('GET', requestURL);
        request.responseType = 'json';
        request.send();

        request.onload = function () {
            var pets = request.response;;
            showProduct(pets);
        }

        function showProduct(jsonObj) {

            const man = jsonObj["AA"];

            for (i = 0; i < man.length; i++) {
                const myArticle = document.createElement('article');
                const myH2 = document.createElement('h2');
                const myPara1 = document.createElement('img');
                const myPara2 = document.createElement('p');
                const myPara3 = document.createElement('p');
                const myPara4 = document.createElement('p');
                const myPara5 = document.createElement('p');
                const myPara6 = document.createElement('p');
                const myList = document.createElement('ul');
                const btn = document.createElement("BUTTON");
                myH2.textContent = man[i].ProdName;
                myPara1.src = man[i].Img;
                myPara2.textContent = '商品名稱: ' + man[i].ProdName;
                myPara3.textContent = '商品規格: ' + man[i].Model;
                myPara4.textContent = '商品價格: ' + man[i].PriceOrigin;
                myPara5.textContent = '商品內容: ' + man[i].ProdDisc;
                myPara6.textContent = '商品類別: ' + man[i].CategoryID;
                btn.innerHTML = "加入購物車";
                myArticle.appendChild(myH2);
                myArticle.appendChild(myPara1);
                myArticle.appendChild(myPara2).style.color = '#AF5F3C';
                myArticle.appendChild(myPara3).style.color = '#B17844';
                myArticle.appendChild(myPara4).style.color = '#CB1B45';
                myArticle.appendChild(myPara5).style.color = '#E79460';
                myArticle.appendChild(myPara6).style.color = '#B4A582';
                myArticle.appendChild(myList);
                myArticle.appendChild(btn);
                section.appendChild(myArticle);
            }


        }


    </script>


<body>

    <header>

    </header>

    <section>

    </section>

    <script>
        const header = document.querySelector('header');
        const section = document.querySelector('section');
    </script>
</body>

</html>