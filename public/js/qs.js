$(function(){
    var mySwiper = new Swiper('#index-banner-content', {
	    autoplay:true,//等同于以下设置
	    loop : true,
        speed:1000,
        pagination: {
          el:'#index-banner',
          clickable :true,
        }
	});
    var mySwiper = new Swiper('#ranking-list', {
        // delay: 1000,  // 几秒切换一次
        autoplay: {
            delay: 3000,  // 几秒切换一次
            disableOnInteraction: false,
        },
        loop : true,
        speed:1000, // 切换的时间
        // pagination: {
        //   el:'#index-banner',
        //   clickable :true,
        // },
        slidesPerView: 4,
        spaceBetween: 30,
        freeMode: true,


        navigation: {
          nextEl: '.ranking-right',
          prevEl: '.ranking-left',
        }
    });
    var mySwiper = new Swiper('#m-ranking-list', {
        // autoplay:true,//等同于以下设置
        loop : true,
        autoplay: {
            delay: 2000,  // 几秒切换一次
            disableOnInteraction: false,
        },
        // disableOnInteraction: false,  //用户手动触发后自动播放继续
        speed:1000, // 切换的时间
        slidesPerView: 2,
        spaceBetween: 10,
        freeMode: true,
        navigation: {
          nextEl: '.m-ranking-right',
          prevEl: '.m-ranking-left',
        }
        
    });
    $(".news-list li").click(function(){
        var i = $(this).index();//下标第一种写法
            //var i = $('tit').index(this);//下标第二种写法
        $(this).addClass('active-news').siblings().removeClass('active-news');
        $('.news-contnen>div').eq(i).show().siblings().hide();
    })
    $(".right-tab span").click(function(){
        var i = $(this).index();//下标第一种写法
            //var i = $('tit').index(this);//下标第二种写法
        $(this).addClass('active').siblings().removeClass('active');
        $('.right-tab-con>ul').eq(i).show().siblings().hide();
    })
    

})