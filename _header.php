<BODY onload="startTime();">
    <div class="header media-m-center media-l-center">
        <div class="left"><a href="index.php"><img src="images/logo1.jpg"></a></div>
        <div class="right">
            <ul class="rightheader">
                <li class="step1"><a class="step1 media-m-pdd media-l-pdd media-xl-pdd" href="guide.php"><img src="../images/description.png">購物說明</a></li>
            </ul>
            <?php if (isset($_SESSION["loginMember"]) && ($_SESSION["memberLevel"] != "")) { ?>
                <ul class="rightheader">
                    <li class="step1 media-m-hid"><a class="step1 media-m-pdd media-l-pdd media-xl-pdd" href="#"><img src="../images/hmbbutton.png"><?php echo $row_RecMember["m_name"]; ?> 您好</a>
                        <ul class="step2">
                            <?php while ($row_Lbtn = $Lbtn->fetch_assoc()) { ?>
                                <li class="step2"><a class="step2" href="<?php echo $row_Lbtn['href']; ?>"><?php echo $row_Lbtn["name"]; ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
                <ul class="rightheader">
                    <li class="step1 media-l-hid media-xl-hid"><label class="ctlside media-l-pdd media-xl-pdd" for="side-menu-switch"><img src="../images/hmbbutton.png"><?php echo $row_RecMember["m_name"]; ?> 你好</label></li>
                </ul>
            <?php } else { ?>
                <ul class="rightheader">
                    <li class="step1"><a class="step1 media-m-pdd media-l-pdd media-xl-pdd" href="login.php"><img src="../images/login.png">登入/註冊</a></li>
                </ul>
            <?php } ?>
            <ul class="rightheader">
                <li class="step1"><a class="step1 media-m-pdd media-l-pdd media-xl-pdd" href="uc.php"><img src="../images/scar.png">購物車</a></li>
            </ul>
            <ul class="rightheader">
                <li class="step1">
                    <form><input tpye="serach" placeholder="搜尋"><button type="button"><img class="ser" src="../images/magnifier.png"></button></form>
                </li>
            </ul>
        </div>
    </div>
    <div>
        <?php echo makeMenu($menu, 0, 0); ?>
    </div>


    <!-- 右下角控制項12.23紹寧 -->
    <div class="windowsctl media-m-hid">
        <div class="item">
            <a href="index.php">
                <img src="images/index-w.png" alt="">
            </a>
        </div>

        <div class="item">
            <a href="javascript:;" onClick="javascript:history.go(-1);">
                <img src="images/goback.png" alt="">
            </a>
        </div>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script>
        <script>
            $(function() {
                $('#BackTop').click(function() {
                    $('html,body').animate({
                        scrollTop: 0
                    }, 333);
                });
            });
        </script>
        <div class="item">
            <a href="" id="BackTop">
                <img src="images/gotop.png" alt="">
            </a>
        </div>
    </div>