    $('.slick').slick({
	dots: true, //顯示輪播圖片會顯示圓圈
  arrows: true,
	prevArrow: '<button type="button" class="slick-prev Btn-prev">Previous</button>',
	nextArrow: '<button type="button" class="slick-next Btn-next">Next</button>',
	autoplay: true,         //autoplay : 自動播放
    responsive: [

    /*{
      breakpoint: 1000,
      settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          arrows:false
      }
    },困擾你整晚的功能*/
    {
      breakpoint: 480,
      settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows:false
      }
    }]
});