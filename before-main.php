<?php
//メインカラムの手前に何かを挿入したいときは、このテンプレートを編集
//例えば、3カラムの左サイドバーなどをカスタマイズで作りたいときなどに利用します。
?>


<?php
//////////////////////////////////
// モバイルメニューボタンのテンプレート
//////////////////////////////////
if ( is_navi_visible() &&
     !is_mobile_menu_type_accordion_tree() ): //アコーディオンツリーメニュー設定（SlickNav）じゃないとい表示
  $button_id = 'gnav-menu-toggle';
  $href_val = '#';
  //モーダルメニューがオンのときIDとhrefの付け替え
  if ( is_mobile_menu_type_modal() && (is_mobile() || is_responsive_enable()) ) {
    $button_id = 'gnav-menu-modal';
    $href_val = '#animatedModal';
  } ?>
  
<div id="gnav-menu">
  <span class="menuTxt">MENU</span>
  <span class="fa <?php echo get_menu_button_icon_font(); //Font Awesomeアイコンフォントの取得 ?> fa-2x"></span>
</div>
<?php endif; ?>