//ここに追加したいJavaScript、jQueryを記入してください。
//このJavaScriptファイルは、親テーマのJavaScriptファイルのあとに呼び出されます。
//JavaScriptやjQueryで親テーマのjavascript.jsに加えて関数を記入したい時に使用します。

//$の書き方ではバッティングするみたい

jQuery(function($){
  $('#h-top').append('<div class="siteSubDescription"><p>当サイトは「まち」に散らばる様々なトピックを扱い、<br>「まち」のこれまで・いま・これからについて伝えていくサイトです。</p></div>');
});