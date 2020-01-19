<div class="footer media-m-center media-l-center">
        <div class="left media-m-text media-l-text media-l-12 media-xl-6">
            <ul class="footerlink">
                <li><a href="#"><img src="images/facebook.png">Facebook</a></li>
                <li><a href="#"><img src="images/line.png">Line生活圈</a></li>
                <li><a href="#"><img src="images/youtube.png">Youtube頻道</a></li>
            </ul>
        </div>
        <div class="right media-m-text media-l-text media-l-12 media-xl-6">
            Copyright © 2019 培茲 Pets Inc. All rights reserved</br>
            客服專線: 0800-000-000</br>
            營業時間: 週一至週五 AM 10:00-12:00, PM 13:30-18:00</br>
            E-mail: service@pets.com.tw</br>
            <b>Website Environment is Maintained and Run by github user: @magicansk
              此網頁為非營利用途，以教學目的使用，謝謝!!</b>
        </div>
    </div>
    <div class="sidebar">
        <input type="checkbox" id="side-menu-switch">
        <div class="side-menu">
            <div class="snav">
                <form>
                    <input tpye="serach">
                    <button><img src="../images/magnifier-w.png"></button>
                </form>
                <span class="title"><img src="../images/member-w.png"><?php echo $row_RecMember["m_name"]; ?> 您好</span>
                <?php while ($row_Lbtn2 = $Lbtn2->fetch_assoc()) { ?>
                    <a href="<?php echo $row_Lbtn2["href"] ?>"><?php echo $row_Lbtn2["name"] ?></a>
                <?php } ?>
            </div>
            <label class="side-menu-switch" for="side-menu-switch"></label>
        </div>
    </div>
</BODY>

</HTML>
