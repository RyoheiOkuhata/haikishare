import JQuery from 'jquery';
let $ = JQuery

/*---------------------------------------
spメニュー
----------------------------------------*/

$(function() {

 // SPメニュー
  $('.js-toggle-sp-menu').on('click', function () {
    $(this).toggleClass('active');
    $('.js-toggle-sp-menu-target').toggleClass('active');
    $('.mask').toggleClass('active');
  });
    // SPメニュー
    $('.menu-link').on('click', function () {
      $('.js-toggle-sp-menu-target').toggleClass('active');
      //nav-menuにつけてあげる
    });
/*-----------------------------------------
ドロップダウン
----------------------------------------*/
$("ul.menu li").hover(function(){
    $("ul.sub:not(:animated)",this).slideDown();
  },function(){
    $("ul.sub",this).slideUp();
  });
    $('.js').click(function(){
      $(this).next('answer-item').slideToggle();
    });
    $("#acMenu dt").on("click", function() {
    $(this).next().slideToggle();
    });
/*-----------------------------------------
フラッシュメッセージ
----------------------------------------*/
$('.flash_message').fadeOut(6000);
        return false;
});
/*-----------------------------------------
モーダル
----------------------------------------*/
$(function() {
 $('.js-modal-open').on('click',function(){
        $('.js-modal').fadeIn();
        return false;
    });
    $('.js-modal-close').on('click',function(){
        $('.js-modal').fadeOut();
        return false;
    })
});



$(function() {
    var $ftr = $('.l-footer');
    if( window.innerHeight > $ftr.offset().top + $ftr.outerHeight() ){
      $ftr.attr({'style': 'position:fixed; top:' + (window.innerHeight - $ftr.outerHeight()) +'px;' });
    }
   });
