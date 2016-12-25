<!-- sidebar -->
<div id="sidebar" role="complementary">
  <?php get_template_part('button-slide-sidebar-close');//スライドサイドバー用の閉じるボタン ?>
  <?php get_template_part('ad-sidebar');//サイドバートップ広告の呼び出し ?>

  <div id="sidebar-widget">
      <!-- ウイジェット //新着記事表示を設定 -->
      <?php if ( is_active_sidebar( 'sidebar-1' ) ) :
        dynamic_sidebar( 'sidebar-1' );
      endif;?>
      
      <!-- ランダム記事表示の手動設定 -->
      <aside id="new_entries" class="widget widget_new_entries">         
      <h3 class="widget_title sidebar_widget_title">ランダム記事</h3>
        <?php
        //グローバル変数の呼び出し
        global $g_widget_mode;//ウィジェットモード（全て表示するか、カテゴリ別に表示するか）
        global $g_entry_count;
        $args = array(
          'posts_per_page' => 3, 'orderby' => 'rand',
        );
        $cat_ids = get_category_ids();//カテゴリ配列の取得
        $has_cat_ids = $cat_ids && ($g_widget_mode == 'category');
        if ( $has_cat_ids ) {
          $args += array('category__in' => $cat_ids);
        }
        query_posts( $args ); //クエリの作成?>
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
    <aside id="information">
        <h3 class="widget_title sidebar_widget_title">インフォメーション</h3>
        <?php /** カスタム投稿タイプ「お知らせ」を表示 */
            $args = array(
                'post_type' 		=> 'information',
                'posts_per_page' 	=> 3,
            );
            $information = new WP_Query( $args );
				if ( $information->have_posts() ) : /** 「お知らせ」用のサブループ開始 */ ?>
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
				<?php endif; /** サブループ終了 */
            wp_reset_postdata();
        ?>
    </aside>
</div>

  <?php if (is_active_sidebar('sidebar-scroll') && !is_mobile() ): ?>
  <!--スクロール追従領域-->
  <div id="sidebar-scroll">
    <?php dynamic_sidebar('sidebar-scroll');?>
  </div>
  <?php endif; ?>

</div><!-- /#sidebar -->