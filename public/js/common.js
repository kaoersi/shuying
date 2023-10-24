var windowWith,windowHeight;
var contanierW;
var morenC;


function getWindowSize(){
     windowWith = $(window).width();
     windowHeight = $(window).height();
     contanierW =$(".container").width();
}


function getfivemodule(picW,picH){
    var height = picH*contanierW*0.16666666/picW;
    var cur_height = picH*contanierW*0.3333333333/picW;
    var marginTop = -height/2;
    var marginTop_cur = -cur_height/2;
    return [height,marginTop,cur_height,marginTop_cur];
}




function getExplorer() {
    var type,explorer = window.navigator.userAgent ;
//ie
    if (explorer.indexOf("MSIE") >= 0) {type='ie';}
    //firefox
    else if (explorer.indexOf("Firefox") >= 0) {type='Firefox';}
    //Chrome
    else if(explorer.indexOf("Chrome") >= 0){type='Chrome';}
    //Opera
    else if(explorer.indexOf("Opera") >= 0){type='Opera';}
    //Safari
    else if(explorer.indexOf("Safari") >= 0){type='Safari';}
    return type;
}

var kao = {
    common: function () {

   $('#menu_mob_nav').mmenu();

        
$(document).ready(function() {
            $('.return').click(function(){
                $('html,body').animate({"scrollTop":0},300)
           })
        });

if($(".section_list_teacher").length > 0){

    if($(window).width() < 768){
        var num='1';
    }else{
        var num='5';
    }

       var teacherSwiper = new Swiper('.section_list_teacher .swiper-container', {
            speed: 500,
            loop: true,
            centeredSlides: true,
            slideToClickedSlide: true,
            spaceBetween:20,
            autoplay:false,
            slidesPerView:num,
            initialSlide: 2,
            navigation: {
                nextEl: '.section_list_teacher .next_btn_teacher',
                prevEl: '.section_list_teacher .prev_btn_teacher',
            },
            
          
        });  
}

$(".bm_item_top a").hover(function(){
    $(this).addClass('hover').siblings().removeClass('hover');
    var indexa=$(this).index();
    $(".bm_item_con ul").hide();
    $(".bm_item_con ul:eq("+indexa+")").show();
})

    function myNav(){
                var _winw = $(window).width();
                if( _winw>992 ){
                    $('.nav').show();
                    $('.nav li').bind('mouseenter',function() {
                        $(this).find('dl').stop().slideDown();
                        if( $(this).find('dl').length ){
                            $(this).addClass('ok');
                        }
                    });
                    $('.nav li').bind('mouseleave',function() {
                        $(this).removeClass('ok');
                        $(this).find('dl').stop().slideUp();
                    });
                   
                }else{
                    $('.nav li').unbind('mouseenter mouseleave');
                    
                }
            }
            myNav();
            $(window).resize(function(event) {
                myNav();
            }); 

        $("#aFloatTools_Show").mouseover(function(){
            $('#divFloatToolsView').show(300);
            $('#aFloatTools_Show').hide(300);
            $('#aFloatTools_Hide').show(300);              
        });
        $("#aFloatTools_Hide").mouseout(function(){
            $('#divFloatToolsView').hide(300);
            $('#aFloatTools_Show').show(300);
            $('#aFloatTools_Hide').hide(300);  
        });
        //  $("#aFloatTools_Hide").click(function(){
        //     $('#divFloatToolsView').animate({width:'hide', opacity:'hide'},100,function(){$('#divFloatToolsView').hide();});
        //     $('#aFloatTools_Show').show();
        //     $('#aFloatTools_Hide').hide();  
        // });
        // $("#aFloatTools_Show").click(function(){
        //     $('#divFloatToolsView').animate({width:'show',opacity:'show'},100,function(){$('#divFloatToolsView').show();});
        //     $('#aFloatTools_Show').hide();
        //     $('#aFloatTools_Hide').show();              
        // });
        // $("#aFloatTools_Show").hover(
        //   function () {    
        //     $("#divFloatToolsView").animate(function(){$('#divFloatToolsView').show();});    
        // },    
        // function () {    
        //     $("#divFloatToolsView").animate(function(){$('#divFloatToolsView').hide();});    
        // }    
        // );
        // $("#aFloatTools_Hide").mouseout(function(){
        //     $('#divFloatToolsView').hide(300);
        //     $('#aFloatTools_Show').show(300);
        //     $('#aFloatTools_Hide').hide(300);  
        // });

  $(".close-bottom-fixed").click(function(){
            $(".bottom-fixed").hide();
            if($(this).hasClass("active")){
                $(".botClose").show();
                $(".bottom-fixed").show();
                $(this).removeClass("active");
            }else{
                $(".botClose").hide();
                $(".bottom-fixed").hide();
                $(this).removeClass("active");
                $(this).addClass("active");
            } 
        })
        $(".botClose").click(function(){
            $(".bottom-fixed").hide();
            if($(".close-bottom-fixed").hasClass("active")){
                $(this).show();
                $(".bottom-fixed").show();
                $(".close-bottom-fixed").removeClass("active");
            }else{
                $(this).hide();
                $(".bottom-fixed").hide();
                $(".close-bottom-fixed").removeClass("active");
                $(".close-bottom-fixed").addClass("active");
            } 
        })


    //顶部搜索公用

    

 $(function() {
            $("#header-search-submit").click(function() {
                var keyword_header = $("#keyword_header").val();
                if(keyword_header == "" ) {
                    layer.msg("请输入要搜索的关键词");
                    $("#keyword_header").focus();
                    return false;
                }
                $("#site-search").submit();
            })


//搜搜列表页通用
 $("#banner_btn_search").click(function() {
                var keyword_header2 = $("#keyword_banner").val();
                if(keyword_header2 == "" ) {
                    layer.msg("请输入要搜索的关键词");
                    $("#keyword_banner").focus();
                    return false;
                }
                $("#site-search-banner").submit();
            })


            
        })




     
      
    },
    home:function(){
        var bannerSwiper = new Swiper('.banner .swiper-container', {
            direction: 'horizontal',
            loop: true,
            speed:1000,
            slidesPerView:1,
                 autoplay: {
       delay: 3000,
    disableOnInteraction: false,
  },
            pagination: {
                el: '.banner .swiper-pagination',
                clickable: true,
            },
             navigation: {
                nextEl: '.banner .swiper-bannerbtn-next',
                prevEl: '.banner .swiper-bannerbtn-prev',
            },
        });
       
     
        $(".section4-nav li").hover(function(){
            $(this).addClass("active").siblings().removeClass("active");
            $(".section4-show").eq($(this).index()).addClass("on").siblings().removeClass("on");

        })
        var viewSwiper = new Swiper('.view .swiper-container', {

            duration : 0,
            on:{
                slideChangeTransitionStart: function() {
                    updateNavPosition()
                }
            }
        })
        $('.view .arrow-left,.preview .arrow-left').on('click', function(e) {
            e.preventDefault()
            if (viewSwiper.activeIndex == 0) {
                viewSwiper.slideTo(viewSwiper.slides.length - 1, 1000);
                return
            }
            viewSwiper.slidePrev()
        })
        $('.view .arrow-right,.preview .arrow-right').on('click', function(e) {
            e.preventDefault()
            if (viewSwiper.activeIndex == viewSwiper.slides.length - 1) {
                viewSwiper.slideTo(0, 1000);
                return
            }
            viewSwiper.slideNext()
        })
        var previewSwiper = new Swiper('.preview .swiper-container', {
          //visibilityFullFit: true,
            slidesPerView: 'auto',
            allowTouchMove: false,
            on:{
                tap: function() {
                    viewSwiper.slideTo(previewSwiper.clickedIndex)
                }
            }
        })
        function updateNavPosition() {
            $('.preview .active-nav').removeClass('active-nav')
            var activeNav = $('.preview .swiper-slide').eq(viewSwiper.activeIndex).addClass('active-nav')
            if (!activeNav.hasClass('swiper-slide-visible')) {
                if (activeNav.index() > previewSwiper.activeIndex) {
                    var thumbsPerNav = Math.floor(previewSwiper.width / activeNav.width()) - 1
                    previewSwiper.slideTo(activeNav.index() - thumbsPerNav)
                } else {
                    previewSwiper.slideTo(activeNav.index())
                }
            }
        }
        $(".section6-l-body li").click(function(){
            $(this).addClass("active").siblings().removeClass("active");
            $(".section6-r-body").eq($(this).index()).addClass("on").siblings().removeClass("on");
        })
        var sec7Swiper = new Swiper('.section7-contianer .swiper-container', {
            speed: 500,
            loop: true,
            autoplay:true,
            spaceBetween:15,
            slidesPerView: 4,
            navigation: {
                nextEl: '.section7-contianer .swiper-button-next',
                prevEl: '.section7-contianer .swiper-button-prev',
            },
            breakpoints: {
                668: {
                    slidesPerView: 1,
                }
            }
        });
        $(".section8-nav li").hover(function(){
            $(this).addClass("on").siblings().removeClass("on");
            $(".section8-show").eq($(this).index()).addClass("active").siblings().removeClass("active");
        })
    },
        mobile:function(){
        
//banner
        var bannerSwiper = new Swiper('.swiper-container-banner', {
            direction: 'horizontal',
            loop: true,
            autoplay:true,
           autoHeight: true, //高度随内容变化
            slidesPerView:1,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
           
        });

  var mySwiper = new Swiper ('.swiper-container-tskc', {
    loop: true, // 循环模式选项
          autoHeight: true, //高度随内容变化
            slidesPerView:2,
            spaceBetween : 20,
    
    // 如果需要前进后退按钮
    navigation: {
      nextEl: '.swiper-container-tskc .swiper-button-next',
      prevEl: '.swiper-container-tskc .swiper-button-prev',
    },
    

  })     



$(".btn_ys").click(function(){
    var indexa=$(this).index();
    $(".fwyw_con .show_btn_ys").hide();
     $(".fwyw_con .show_btn_ys:eq("+indexa+")").show();
})



$(".btn_show_more").click(function(){
    $(".section-lxtj-mob dl").addClass('hover');
    $(this).hide();
})








 


    },
    tskc:function(){
        $(".eju_about_nav  a").click(function(){
            var index = $(this).index();
         $(this).addClass('hover').siblings().removeClass('hover');
          $(".eju_about_show.hover").removeClass('hover');
        $(".eju_about_show:eq("+index+")").addClass('hover');



        })


 $(".rxfd_nav  a").click(function(){
            var index = $(this).index();
         $(this).addClass('hover').siblings().removeClass('hover');
          $(".rxfd_con_show.hover").removeClass('hover');
        $(".rxfd_con_show:eq("+index+")").addClass('hover');



        })


$(".planright_box p").click(function(){
     var index = $(this).index();
    $(this).addClass('hover').siblings().removeClass('hover');
     $(".planbox.hover").removeClass('hover');
      $(".planbox:eq("+index+")").addClass('hover');

})


$(".eju_kc-nav li").click(function(){
     var index = $(this).index();
    $(this).addClass('hover').siblings().removeClass('hover');
     $(".xh_right_p.hover").removeClass('hover');
      $(".xh_right_p:eq("+index+")").addClass('hover');

})




    },
    case:function(){
         $(".Consultant_fx_nav   a").click(function(){
            var index = $(this).index();
         $(this).addClass('hover').siblings().removeClass('hover');
          $(".Consultant_fx_show.hover").removeClass('hover');
        $(".Consultant_fx_show:eq("+index+")").addClass('hover');



        })

          $(".match_teach_nav   a").click(function(){
            var index = $(this).index();
         $(this).addClass('hover').siblings().removeClass('hover');
          $(".match_teach_show.hover").removeClass('hover');
        $(".match_teach_show:eq("+index+")").addClass('hover');



        })

    },
    mxalk:function(){
           $(".yxk-show-nav   p").click(function(){
            var index = $(this).index();
         $(this).addClass('hover').siblings().removeClass('hover');
          $(".yxk-show-article-tab.hover").removeClass('hover');
        $(".yxk-show-article-tab:eq("+index+")").addClass('hover');



        })

    },
    clickMore: function(){
        $(function() {
            var $category = $('ul.show-wenda-div-ul li:gt(3)') 
            $category.hide(); 
            var $toggleBtn = $('div.showMore>a'); 
            $toggleBtn.click(function() {
                if($category.is(":visible")) { 
                    $category.hide(); 
                    $(this).find('span')
                        .text("点击查看更多");
                    $(".showMore").removeClass("clickMore");
                    
                } else {
                    $category.show(); 
                    $(this).find('span')
                        .text("点击收起列表");
                    $(".showMore").addClass("clickMore");
                }
                return false;
            })
        })
    },

   checkForm: function(){
        $(function() {

$(".flag").on('click',function(){
            $(this).addClass("on").siblings().removeClass("on");
        })

            
            $("#ajax_btn_submit").click(function() {
                var username = $("#username").val();
                var liflag=$(".flag.on").attr('data-id');
                $("#tsby").val(liflag)
                var tel = $("#tel").val();
               var email = $("#email").val();
                var content = $("#content").val();
                if(username == "" ) {
                    layer.msg("请填写您的姓名");
                    $("#username").focus();
                    return false;
                }
                var reg2 = /^1[3,4,5,8,6,7]\d{9}$/;
                if(!reg2.test(tel)) {
                    layer.msg("电话号码格式不正确");
                    $("#tel").focus();
                    return false;
                }
                var strRegex = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
                if(!strRegex.test(email)) {
                    layer.msg("邮箱格式不正确");
                    $("#email").focus();
                    return false;
                }

                if(content == "" ) {
                    layer.msg("留言内容不能为空");
                    $("#content").focus();
                    return false;
                }
               
                $.ajax({
                    'url':'/cms/form/feedback',
                    type : "POST",  
                    data :$("#myform").serialize(), 
                    dataType: "json",   
                    success : function(datasear){ 
                       if(datasear.status !=  0){
                            layer.msg(datasear.msg);
                            window.location.reload();

                        }else{
                           layer.msg(datasear.msg);
                        }
                    }, 
                    error: function () {  
                         layer.msg('抱歉！网络错误');
                    }

                })
            })
            
        })
        
    },
    dxy:function(){
        if($(window).width() < 768){
            $(".dxy_list_nav p.p1").click(function(){
                $(".dxy_ys_right,.dxy_ys_left").hide();
                 $(".dxy_ys_left").show();
            })
            $(".dxy_list_nav p.p2").click(function(){
                $(".dxy_ys_right,.dxy_ys_left").hide();
                 $(".dxy_ys_right").show();
            })
        }
       
    },
    success:function(){
        var success1Swiper = new Swiper('.swiper-success1 .swiper-container', {
            speed: 500,
            loop: true,
            autoplay:true,
            spaceBetween:20,
            slidesPerView: 4,
            navigation: {
                nextEl: '.swiper-success1 .next',
                prevEl: '.swiper-success1 .prev',
            },
            breakpoints: {
                668: {
                    slidesPerView: 1,
                    spaceBetween:0,
                }
            }
        });
        var success2Swiper = new Swiper('.swiper-success2 .swiper-container', {
            speed: 500,
            loop: true,
            autoplay:true,
            spaceBetween:30,
            slidesPerView: 4,
            navigation: {
                nextEl: '.swiper-success2 .swiper-button-next',
                prevEl: '.swiper-success2 .swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                668: {
                    slidesPerView: 1,
                    spaceBetween:0,
                }
            }
        });
    },
    about:function(){
        $(".pageBottom-nav li").hover(function(){
            $(this).addClass("on").siblings().removeClass("on");
            $(".pageBottom-tab-show").eq($(this).index()).addClass("active").siblings().removeClass("active");
        })
        $(function() {
            var $category = $('ul.history-ul li:gt(4)') 
            $category.hide(); 
            var $toggleBtn = $('div.load-more>a'); 
            $toggleBtn.click(function() {
                if($category.is(":visible")) { 
                    $category.hide(); 
                    $(this).find('span')
                        .css("background","url(images/inside/load-more.png) center no-repeat");
                    
                } else {
                    $category.show(); 
                    $(this).find('span')
                        .css("background","url(images/inside/load-back.png) center no-repeat");
                }
                return false;
            })
        })
        $(".contact-sec3-select li").on('click',function(){
            $(this).addClass("on").siblings().removeClass("on");
        })
    },
    yxk:function(){
        var yxkSwiper = new Swiper('.show-yxk-arc .swiper-container', {
            speed: 500,
            loop: true,
            autoplay:true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                668: {
                    slidesPerView: 1,
                    spaceBetween:0,
                }
            }
        });

    },
    mstd:function(){
        var galleryTop = new Swiper('.gallery-top', {
            loop: true,
            autoplay:true,
            loopedSlides: 8,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            spaceBetween: 15,
            slidesPerView: 8,
            touchRatio: 0.2,
            loop: true,
            autoplay:true,
            slideToClickedSlide: true,
            breakpoints: {
                668: {
                    slidesPerView: 3,
                    spaceBetween:10,
                }
            }
        });

        galleryTop.controller.control = galleryThumbs;
        galleryThumbs.controller.control = galleryTop;




    $('.pftx-nav li').click(function(){
        $('.pftx-nav li').removeClass('on');
        $(this).addClass('on');
        $('.pftx-tab li').hide();
        $('.pftx-tab li').eq($(this).index()).show();
    })
    $(".pftx-tab li").eq(0).css("display", "block");
    var showIndex = 0;
    $(".pftx-l-c").click(function(){
        if(showIndex == 0) showIndex = 5;
        showIndex--;
        showImg();

    })

    $(".pftx-r-c").click(function(){
        if(showIndex == 4) showIndex = -1;
        showIndex++;
        showImg();
    })

    function showImg() {
        $(".pftx-tab li").hide();
         $('.pftx-nav li').removeClass('on');
        $('.pftx-nav li').eq(showIndex).addClass('on').show();
        $(".pftx-tab li").eq(showIndex).show();
    }

  
    }
}