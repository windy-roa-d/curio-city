<?php //子テーマ用関数

//親skins の取得有無の設定
function include_parent_skins(){
  return true; //親skinsを含める場合はtrue、含めない場合はfalse
}

//子テーマ用のビジュアルエディタースタイルを適用
add_editor_style();

//以下にSimplicity子テーマ用の関数を書く

// ★☆★　ユーザープロフィールの項目のカスタマイズ　★☆★
function my_user_meta($wb)
{
  //項目の追加
  $wb['user_title'] = '肩書き';
  return $wb;
}
  add_filter('user_contactmethods', 'my_user_meta', 10, 1);

//★☆★　キャプション指定の設定　★☆★
//Wordpressのデフォルトで横幅が+10pxされてしまうため関数で上書きする
add_shortcode('caption', 'my_img_caption_shortcode');
function my_img_caption_shortcode($attr, $content = null) {
	if ( ! isset( $attr['caption'] ) ) {
		if ( preg_match( '#((?:<a [^>]+>s*)?<img [^>]+>(?:s*</a>)?)(.*)#is', $content, $matches ) ) {
			$content = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}
	}
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr, 'caption'));

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . $width . 'px">' . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

//★☆★　ブログページ内、関連記事の表示設定　★☆★
if ( !function_exists( 'get_related_wp_query_args' ) ):
function get_related_wp_query_args(){
  global $post;
  if ( is_related_entry_association_category() ) {
    //カテゴリ情報から関連記事をランダムに呼び出す
    $categories = get_the_category($post->ID);
    $category_IDs = array();
    foreach($categories as $category):
      array_push( $category_IDs, $category -> cat_ID);
    endforeach ;
    if ( empty($category_IDs) ) return;
    return $args = array(
      'post__not_in' => array($post -> ID),
      'posts_per_page'=> 2, //【表示件数の指定】
      'category__in' => $category_IDs,
      'orderby' => 'rand',
    );
  } else {
    //タグ情報から関連記事をランダムに呼び出す
    $tags = wp_get_post_tags($post->ID);
    $tag_IDs = array();
    foreach($tags as $tag):
      array_push( $tag_IDs, $tag -> term_id);
    endforeach ;
    if ( empty($tag_IDs) ) return;
    return $args = array(
      'post__not_in' => array($post -> ID),
      'posts_per_page'=> 2, //【表示件数の指定】
      'tag__in' => $tag_IDs,
      'orderby' => 'rand',
    );
  }
}
endif;