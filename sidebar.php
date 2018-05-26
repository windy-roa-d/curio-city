<?php 
/****************************************

サイドバー用のphpファイルです

*****************************************/
?>
<div id="sidebar" role="complementary">
  <?php get_template_part('button-slide-sidebar-close');//スライドサイドバー用の閉じるボタン ?>
  <?php get_template_part('ad-sidebar');//サイドバートップ広告の呼び出し ?>

  <div id="sidebar-widget">
    <!-- 過去記事一覧へ -->
    <aside id="old_entries" class="widget">
      <h3 class="widget_title sidebar_widget_title"><a href="/list/" target="_blank">過去の記事一覧</a></h3>
      <p>記事検索はコチラ↓</p>
      <script>
        (function() {
          var cx = '010950947954796491421:xgukhz__vy0';
          var gcse = document.createElement('script');
          gcse.type = 'text/javascript';
          gcse.async = true;
          gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
          var s = document.getElementsByTagName('script')[0];
          s.parentNode.insertBefore(gcse, s);
        })();
      </script>
      <div id="gsc"><gcse:search></gcse:search><span>loading...</span></div>
    </aside>

    <!-- ウイジェット //Simplicityデフォルトの新着記事表示を設定 -->
    <?php if ( is_active_sidebar( 'sidebar-1' ) ) :
      dynamic_sidebar( 'sidebar-1' );
    endif;?>

    <!-- タブ切り替えエリア -->
    <div id="sideTabArea">
      <input id="chapter1" type="radio" name="tabItem" checked>
      <input id="chapter2" type="radio" name="tabItem">
      <input id="chapter3" type="radio" name="tabItem">

      <div class="sideTabList">
          <label class="tabItem chapter1" for="chapter1">人気記事</label>
          <label class="tabItem chapter2" for="chapter2">カテゴリ</label>
          <label class="tabItem chapter3" for="chapter3">タグ</label>
      </div>

      <div class="tabContent" id="chapter1_content">
        <p class="default">Loading...</p>
      </div>

      <div class="tabContent categoryList" id="chapter2_content">
        <ul>
          <?php wp_list_categories('orderby=ID&show_count=1&title_li='); ?>
        </ul>
      </div>

      <div class="tabContent tagcloud" id="chapter3_content">
          <?php
            $args = array(
                'order' 	=> "RAND",
                'number' 	=> 15,
                'format' 	=> "list",
                'smallest'  => 13,
                'largest'   => 13,
                'unit'   => "px"
            );
            $posttags = wp_tag_cloud( $args );
          ?>
      </div>

    </div>
      
    <!-- カスタム投稿タイプ「お知らせ」を表示 -->
    <aside id="information" class="widget">
        <h3 class="widget_title sidebar_widget_title">インフォメーション</h3>
        <?php
            $args = array(
                'post_type' 		=> 'information',
                'posts_per_page' 	=> 2 //【表示件数指定】
            );
            $information = new WP_Query( $args );
				if ( $information->have_posts() ) : ?>
					<ul>
						<?php while ( $information->have_posts() ) : $information->the_post(); ?>
							<li class="frontPage-infodate">
								<a href="<?php the_permalink(); ?>">
								<span><?php the_time('Y.m.d') ?>&nbsp;&nbsp;</span><span><?php the_title(); ?></span></a>
							</li>

						<?php endwhile; ?>
					</ul>
				<?php else : ?>
					<p>現在お知らせはありません。</p>
				<?php endif;
            wp_reset_postdata();
        ?>
    </aside>
    
    <!-- Twitterウィジェットを埋め込み -->
    <aside id="twitter-sidebar">
    <h3 class="widget_title sidebar_widget_title">Twitter</h3>
        <a class="twitter-timeline" data-width="300" data-height="700" href="https://twitter.com/matinote_tw" data-chrome="noheader noborders nofooter">Tweets by matinote_tw</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
    </aside>      
</div>

  <?php if (is_active_sidebar('sidebar-scroll') && !is_mobile() ): ?>
  <!--スクロール追従領域-->
  <div id="sidebar-scroll">
    <?php dynamic_sidebar('sidebar-scroll');?>
  </div>
  <?php endif; ?>

</div><!-- /#sidebar -->