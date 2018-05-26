//ここに追加したいJavaScript、jQueryを記入してください。
//このJavaScriptファイルは、親テーマのJavaScriptファイルのあとに呼び出されます。
//JavaScriptやjQueryで親テーマのjavascript.jsに加えて関数を記入したい時に使用します。

//$の書き方ではバッティングするみたい

/////////////////////////////////
// 要素位置の調整
/////////////////////////////////
(function($){
  $('#gnav-menu').appendTo('#header');
  $('#h-top').append('<div class="siteSubDescription"><p>当サイトは「まち」に散らばる様々なトピックを扱い、<br>「まち」のこれまで・いま・これからについて伝えていくサイトです。</p></div>');
  $('#mobile-menu').remove();
  $('#chapter1_content p').replaceWith($('.widget_popular_ranking')).removeClass('default');
  //$('.widget_popular_ranking').appendTo('#chapter1_content').removeClass('default');
})(jQuery);

/////////////////////////////////
// メニューボタンの開閉
/////////////////////////////////
(function($){
  $(document).ready(function() {
    $('#gnav-menu-toggle').click(function(){
      var header_menu = $('#navi ul');
      if (header_menu.css('display') == 'none') {
        header_menu.slideDown();
      } else{
        header_menu.slideUp();
      }
    });
  });
})(jQuery);