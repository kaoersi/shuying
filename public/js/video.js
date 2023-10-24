			kao.common();	
			kao.home();

  $(".video-list-li .btn_on").click(function(){

      var img = $(this).attr('vpath');//获取视频预览图
                var video = $(this).attr('ipath');//获取视频路径
                $('body').append(" <div class='videos'><video id=\"video\" poster='"+img+"' style='width: 800px' src='"+video+"' preload=\"auto\" controls=\"controls\" autoplay=\"autoplay\"></video><img onClick=\"close1()\" class=\"vclose\" src=\"/public/images/gb.png\" width=\"25\" height=\"25\"/></div>");
                $('.videos').show();

  })  
function close1(){
            var v = document.getElementById('video');//获取视频节点
            $('.videos').hide();//点击关闭按钮关闭暂停视频
            v.pause();
            $('.videos').remove();
        }