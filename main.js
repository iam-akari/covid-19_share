
$(function () {
  $('#navi1').on('click',function(){
    $('body,html').animate({
      scrollTop:$('#nav1').offset().top
    },700);
  });
  $('#navi2').on('click',function(){
    $('body,html').animate({
      scrollTop:$('#nav2').offset().top
    },700);
  });
});

// $(function(){
//   var mvh = $('header').height();
//   $(window).scroll(function() {
//     var top = $(window).scrollTop();
//     if (mvh > top) {
//       $('header').css('background-color', 'rgba(0,0,0,0)')
//       .animate({'marginTop':'0px'},1);
//       } else {
//       $('header').css('background-color', 'rgba(0,0,0,0.9)').css('position','fixed')
//       .animate({'marginTop':'-55px'},1);
//     }
//   });
// });

$(function(){
  $('.top').hide();  //TOPページボタン非表示
  $(window).scroll(function(){
    if ($(this).scrollTop() > 100 ) {  //スクロールが100より大きい場合
      $('.top').fadeIn();  //フェードイン
    }else{
      $('.top').fadeOut();  //フェードアウト
    }
  });

$('.top').click(function(){
  $('.body,html').animate({scrollTop: 0},500);  //TOPへスクロール
  return false;
});
});


$(function(){
  $('.modal').modaal({
    overlay_opacity: '0.5',
    boolean: false
  });
});

// $(function(){
//   $('.modal').click(function(){
//     $('#modal').slideUp();
//   });
// });
