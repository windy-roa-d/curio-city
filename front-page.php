<?php
/****************************************

Template Name: Top
トップページ（フロントページ）用のphpファイルです。

*****************************************/
?>
<?php get_header(); ?>
<style type="text/css">
    /* 2カラム表示を取り消す処理 */
    #sidebar{
        display: none;
    }
    #main{
        width: auto;
        border: none;
    }
    .ad-right{
        float: left;
    }
    @media screen and (max-width: 639px){
        div #main{
            padding: 0;
        }
    }
</style>

<div id="frontPage-wrap">

  <div id="frontPage-body">
  
   <div id="frontPage-Side">
      <?php $users = get_users( array('orderby'=>ID,'order'=>ASC) ); ?>
      <div class="authors">
        <?php foreach($users as $user) {
        $uid = $user->ID; ?>
        <dl class="author-profile">
          <dt class="author-name">
            <a href="<?php echo get_bloginfo("url") . '/?author=' . $uid ?>"><?php echo $user->display_name ; ?></a>
          </dt>
          <dd class="author-thumbanil">
            <a href="<?php echo get_bloginfo("url") . '/?author=' . $uid ?>"><?php echo get_avatar( $uid ,100 ); ?></a>
          </dd>
          <dd class="author-description">
            <span><?php echo $user->user_description ; ?></span>
          </dd>
        </dl>
        <?php } ?>
      </div>
    </div>
    
    <div id="frontPage-topics">
      <div class="frontPage-newTopic">
        <?php
          if ( have_posts() ) :
            while ( have_posts() ) : the_post();
        ?>
          <article class="articleBlock">

            <!-- サムネイル画像 -->
            <div class="articleThumb">
              <a class="topicCard" href="<?php the_permalink() ?>">
                <?php the_post_thumbnail('medium'); ?>
              </a>
            </div>

            <div class="articleInfo">
              <h2>
                <?php the_title(); ?>
              </h2>
              <div class="frontPage-excerpt">
                <?php the_excerpt(); ?>
              </div>
              <div class="frontPage-date">
                <?php the_time('Y.m.d') ?>
              </div>
            </div>

            <!-- カテゴリ -->
            <?php if ( is_category_visible() &&  get_the_category() ): ?>
            <div class="categoryArea">
              <span class="category">
                  <?php the_category(', ') ?>
                </span>
            </div>
            <?php endif; //is_category_visible?>

          </article>
          <?php
          endwhile;
          else :
        ?>
            <div class="post">
              <h2>記事はありません</h2>
              <p>お探しの記事は見つかりませんでした。</p>
            </div>
            <?php
          // if 文終了
          endif; ?>

      </div>
    </div><!-- /frontPage-topics -->
    
  </div><!-- /frontPage-body -->
  
  <div class="frontpage-pager">
    <?php
      if ( is_list_pager_type_responsive() ) {
        //レスポンシブタイプのページャー関数の呼び出し
        responsive_pagination();
      } else {
        //旧タイプのページャー
        get_template_part('pager-paginate-links');
      }
      ?>
  </div><!-- /frontPage-pager -->
  
  <hr>
    
  <div id="frontPage-others">
        
        <div class="tag-and-search">
            <div class="googlesearch"><h2>サイト内検索</h2>
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
                <div id="gsc"><gcse:search></gcse:search></div>
            </div>
            <div class="tagcloud"><h2>タグから見る</h2>
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
                
        <div class="frontPage-info"><h2>インフォメーション</h2>
        <aside id="information">
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
				wp_reset_postdata(); ?>
		</aside><!-- / information -->
        </div>
    </div>
    
</div><!-- /frontPage-wrap -->

<?php get_footer(); ?>