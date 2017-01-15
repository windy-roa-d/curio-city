<?php 
/****************************************

サイドバー用のphpファイルです

*****************************************/
?>
<div id="sidebar" role="complementary">
  <?php get_template_part('button-slide-sidebar-close');//スライドサイドバー用の閉じるボタン ?>
  <?php get_template_part('ad-sidebar');//サイドバートップ広告の呼び出し ?>

  <div id="sidebar-widget">
      <!-- ウイジェット //Simplicityデフォルトの新着記事表示を設定 -->
      <?php if ( is_active_sidebar( 'sidebar-1' ) ) :
        dynamic_sidebar( 'sidebar-1' );
      endif;?>
      
      <!-- ランダム記事表示の手動設定 -->
      <aside id="new_entries" class="widget widget_new_entries">         
      <h3 class="widget_title sidebar_widget_title">ランダム記事</h3>
        <?php
        //グローバル変数の呼び出し
        global $g_widget_mode;
        global $g_entry_count;
        $args = array(
          'posts_per_page' => 3, //【表示件数指定】
          'orderby' => 'rand',
        );
        $cat_ids = get_category_ids();
        $has_cat_ids = $cat_ids && ($g_widget_mode == 'category');
        if ( $has_cat_ids ) {
          $args += array('category__in' => $cat_ids);
        }
        query_posts( $args ); ?>
        <ul class="new-entrys">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <li class="new-entry">
          <div class="new-entry-thumb">
          <?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
            <a href="<?php the_permalink(); ?>" class="new-entry-image" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'thumb100', array('alt' => get_the_title()) ); ?></a>
          <?php else: // サムネイルを持っていないときの処理 ?>
            <a href="<?php the_permalink(); ?>" class="new-entry-image" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" alt="NO IMAGE" class="no-image new-list-no-image" /></a>
          <?php endif; ?>
          </div><!-- /.new-entry-thumb -->

          <div class="new-entry-content">
            <a href="<?php the_permalink(); ?>" class="new-entry-title" title="<?php the_title(); ?>"><?php the_title();?></a>
          </div><!-- /.new-entry-content -->

        </li><!-- /.new-entry -->
        <?php endwhile;
        else :
          echo '<p>'.get_theme_text_not_found_message().'</p>';//見つからない時のメッセージ
        endif; ?>
        <?php wp_reset_query(); ?>
        </ul>
        <div class="clear"></div>
    </aside>
    
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