<?php

function enqueue_my_styles() {
  // jQueryリセット
  wp_deregister_script('jquery');

  // リセットCSS
  wp_enqueue_style('reset-style', get_template_directory_uri() . '/css/ress.css');

  // Google Fonts
  wp_enqueue_style('google-fonts-mincho', 'https://fonts.googleapis.com/css2?family=Zen+Old+Mincho:wght@400;500;600;700;900&display=swap', [], null);
  wp_enqueue_style('google-fonts-noto', 'https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200..900&display=swap', [], null);
  wp_enqueue_style('google-fonts-gothic', 'https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@300;400;500;700;900&display=swap', [], null);

  // Font Awesome
  wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css', [], null);

  // Slick CSS
  wp_enqueue_style('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', [], null);
  wp_enqueue_style('slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css', [], null);

  // メインスタイル
  wp_enqueue_style('main-style', get_template_directory_uri() . '/css/style.css');

  // jQuery UI CSS
  wp_enqueue_style('jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css', [], null);

  // Calendar_CSS
  // wp_enqueue_style('calendar-css', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css', [], null);
  wp_enqueue_style('calendar-css', get_template_directory_uri() . '/css/calendar.css', [], null);

  // jQuery
  wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', [], null, false);

  // Slick
  wp_enqueue_script('slick', get_template_directory_uri() . '/slick.js', ['jquery'], null, false);

  // jQuery UI
  wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', ['jquery'], null, false);

  // 自作スクリプト
  wp_enqueue_script('custom-script', get_template_directory_uri() . '/script.js', ['jquery', 'slick'], null, true);

  // jQuery calendar

  wp_enqueue_script('calendar', get_template_directory_uri() . '/script_calendar.js', ['jquery', 'slick'], null, true);

  wp_enqueue_script('datapicker', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-datepicker/1.13.0/i18n/datepicker-ja.min.js', ['jquery', 'slick'], null, true);

  wp_enqueue_script('calendar_script', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', ['jquery'], null, false);

  wp_enqueue_script('calendar_library', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js', ['jquery'], null, false);

}
add_action('wp_enqueue_scripts', 'enqueue_my_styles');

function my_custom_editor_styles() {
  // Gutenbergエディタ用のスタイルを読み込む
  add_theme_support('editor-styles');
  add_editor_style(get_template_directory_uri() . '/css/editor-style.css');
}
add_action('admin_init', 'my_custom_editor_styles');

function disable_gutenberg_layout_support() {
  remove_theme_support('block-templates');
  remove_theme_support('layout');
}
add_action('after_setup_theme', 'disable_gutenberg_layout_support');

// function register_custom_blocks() {
//   wp_register_script(
//       'custom-group-block',
//       get_template_directory_uri() . '/blocks/custom-group/index.js',
//       array('wp-blocks', 'wp-element', 'wp-editor'),
//       null,
//       true
//   );
//   wp_register_style(
//       'custom-group-style',
//       get_template_directory_uri() . '/blocks/custom-group/style.css'
//   );

//   register_block_type('mytheme/custom-group', array(
//       'editor_script' => 'custom-group-block',
//       'style' => 'custom-group-style',
//   ));
// }
// add_action('init', 'register_custom_blocks');

/****************************/
/**  自動整形機能を無効化  **/
/****************************/
add_filter('the_content', 'wpautop_filter', 9);
function wpautop_filter($content) {
    global $post;
    $remove_filter = false;
 
    $arr_types = array('page'); //自動整形を無効にする投稿タイプを記述
    $post_type = get_post_type( $post->ID );
    if (in_array($post_type, $arr_types)) $remove_filter = true;
 
    if ( $remove_filter ) {
        remove_filter('the_content', 'wpautop');
        remove_filter('the_excerpt', 'wpautop');
    }
 
    return $content;
}

function my_tiny_mce_before_init( $init_array ) {
  $init_array['valid_elements']          = '*[*]';
  $init_array['extended_valid_elements'] = '*[*]';

  return $init_array;
}
add_filter( 'tiny_mce_before_init' , 'my_tiny_mce_before_init' );

add_action('init', function() {
  remove_filter('the_title', 'wptexturize');
  remove_filter('the_content', 'wptexturize');
  remove_filter('the_excerpt', 'wptexturize');
  remove_filter('the_title', 'wpautop');
  remove_filter('the_content', 'wpautop');
  remove_filter('the_excerpt', 'wpautop');
  remove_filter('the_editor_content', 'wp_richedit_pre');
});
add_filter('tiny_mce_before_init', function($init) {
  $init['wpautop'] = false;
  $init['apply_source_formatting'] = true;
  return $init;
});

function theme_setup() {
  add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
}
add_action('after_setup_theme', 'theme_setup');

// divを含むリンクをショートコードで出力
// 相対パスに対応したリンクショートコード
function div_in_a_shortcode($atts, $content = null) {
  // ショートコードの属性を取得
  $atts = shortcode_atts(array(
      'url' => '',  // 相対パスを指定
  ), $atts);

  // サイトURLを取得して相対パスを補完
  $full_url = home_url($atts['url']);

  return '<a href="' . esc_url($full_url) . '">' . do_shortcode($content) . '<div class="price_arrow"></div></a>';
}
add_shortcode('div_link', 'div_in_a_shortcode');



// divを含むリンクをショートコードで出力
// 相対パスに対応したリンクショートコード
function price_div_in_a_shortcode($atts, $content = null) {

  $atts = shortcode_atts(array(
    'target' => '',
    'class' => '',
  ), $atts);

  return '<a class="'.esc_attr($atts['class']).'" data-target="'.esc_attr($atts['target']).'">' . do_shortcode($content) . '<div class="price_arrow"></div></a>';
}
add_shortcode('div_link_null', 'price_div_in_a_shortcode');


// divを含むリンクをショートコードで出力
// 相対パスに対応したリンクショートコード
function flow_div_in_a_shortcode($atts, $content = null) {
  // ショートコードの属性を取得
  $atts = shortcode_atts(array(
      'url' => '',  // 相対パスを指定
  ), $atts);

  // サイトURLを取得して相対パスを補完
  $full_url = home_url($atts['url']);

  return '<a href="' . esc_url($full_url) . '"><div>' . do_shortcode($content) . '<div></div></div></a>';
}
add_shortcode('flow_div_link', 'flow_div_in_a_shortcode');


// カスタム投稿タイプのアーカイブ一覧を表示するショートコード
function custom_post_type_archive($atts) {
  // ショートコードの属性を取得
  $atts = shortcode_atts(array(
      'post_type' => 'case',      // カスタム投稿タイプ（デフォルト：news）
      'posts_per_page' => 16,      // 表示件数（デフォルト：5件）
      'order' => 'DESC',          // 並び順（デフォルト：降順）
  ), $atts);

  // クエリを設定
  $query = new WP_Query(array(
      'post_type' => $atts['post_type'],
      'posts_per_page' => intval($atts['posts_per_page']),
      'order' => $atts['order'],
  ));

  // 出力用の変数
  $output = '<div class="case_link_wrapper">';

  if ($query->have_posts()) {
      while ($query->have_posts()) {
          $query->the_post();
          $output .= '<a href="' . get_permalink() . '">';
          $output .= '<div class="case_link">';
          $output .= '<div class="case_link_img">';
          $output .= '<div><p>Before</p></div>';
          $output .= '<div><p>After</p></div>';
          $output .= '</div>';
          $output .= '<div class="case_content_text">';
          $output .= '<h4>施術名</h4>';
          $output .= '<p>' . get_the_title() . '</p>';
          $output .= '</div>';
          $output .= '</div>';
          $output .= '</a>';
      }
      wp_reset_postdata();
  } else {
      $output .= '<p>記事が見つかりませんでした。</p>';
  }

  $output .= '</div>';
  return $output;
}
add_shortcode('case_archive', 'custom_post_type_archive');

function treatment_h2_div_shortcode($atts, $content = null) {
  return '<h2><div>Medical</div><div>Treatment</div></h2>';
}
add_shortcode('treatment_h2_div', 'treatment_h2_div_shortcode');

function wordpress_a_shortcode($atts, $content = null) {
    // ショートコードの属性を取得
    $atts = shortcode_atts(array(
      'url' => '',  // 相対パスを指定
      'class' => '',
  ), $atts);

  // サイトURLを取得して相対パスを補完
  $full_url = home_url($atts['url']);

  return '<a href="' . esc_url($full_url) . '" class="'. esc_attr($atts['class']).'">'. do_shortcode($content) .'</a>';
}
add_shortcode('link_a', 'wordpress_a_shortcode');

function wordpress_div_shortcode($atts, $content = null) {
  $atts = shortcode_atts(array(
            'class' => '',
          ),$atts);

return '<div class="'.esc_attr($atts['class']).'">'. do_shortcode($content) .'</div>';
}
add_shortcode('div', 'wordpress_div_shortcode');

function form_shortcode($atts, $content = null) {

  $atts = shortcode_atts(array(
    'class' => '',
  ), $atts);

  // thanksページのURLを取得（固定ページ「thanks」が存在する必要あり）
  $action_url = esc_url(get_permalink(get_page_by_path('thanks')));

  // class属性があれば付ける
  $class_attr = !empty($atts['class']) ? ' class="' . esc_attr($atts['class']) . '"' : '';

  return '<form action="'. esc_url(home_url('thanks')).'" method="POST" id="f318e93"' . $class_attr . '>' . do_shortcode($content) . '</form>';

}
add_shortcode('wordpress_form_contact', 'form_shortcode');

add_filter('wpcf7_autop_or_not', '__return_false');



// カスタム投稿タイプの追加
add_action( 'init', 'my_custom_post_type', 0 );
function my_custom_post_type() {
	$calendar = array( 
		'name'=> 'カレンダー',
		'singular_name' =>  'calendar',
		'all_items' => 'カレンダー一覧' 
	);
	$calendar2 = array( 
		'labels'=> $calendar,
		'rewrite'        => array( 'slug' => 'calendar' ),
        'description' =>'カレンダー一覧です。',
		'public'        => true,
		'show_ui'       => true,
		'menu_position' => 5,
		'has_archive'   => true,
		'supports'      => array( 'title','author','editor','comments','trackbacks', 'revisions','thumbnail','custom-fields','excerpt','page-attributes'),
		'taxonomies' => array('category', 'post_tag'),
	);
	register_post_type( 'calendar', $calendar2 );
	$schedule = array( 
		'name'=> 'スケジュール',
		'singular_name' =>  'schedule',
		'all_items' => 'スケジュール一覧' 
	);
	$schedule2 = array( 
		'labels'=> $schedule,
		'rewrite'        => array( 'slug' => 'schedule' ),
        'description' =>'スケジュール一覧です。',
		'public'        => true,
		'show_ui'       => true,
		'menu_position' => 5,
		'has_archive'   => true,
		'supports'      => array( 'title','author','editor','comments','trackbacks', 'revisions','thumbnail','custom-fields','excerpt','page-attributes'),
		'taxonomies' => array('category', 'post_tag'),
	);
	register_post_type( 'schedule', $schedule2 );
	
	$medical_treatment = array( 
		'name'=> '施術',
		'singular_name' =>  '施術',
		'all_items' => '施術 一覧'
	);
	$medical_treatment2 = array( 
		'labels'=> $medical_treatment,
        'rewrite'       => array( 'slug' => 'medical-treatment' ),
        'description' =>'アリエル美容クリニック大宮院の施術一覧ページです。埼玉県さいたま市大宮区の二重整形・クマ取り小顔などの美容外科手術、美肌治療・ボトックス・ヒアルロン酸注射などの美容皮膚科ならアリエル美容クリニックへ。',
		'public'        => true,
		'show_ui'       => true,
		'menu_position' => 5,
		'has_archive'   => true,
        'hierarchical' => true,
		'supports'      => array( 'title','author','editor','comments','trackbacks', 'revisions','thumbnail','custom-fields','excerpt','page-attributes'),
		'taxonomies' => array('category', 'post_tag'),
	);
	register_post_type( 'medical_treatment', $medical_treatment2 );
	
    $cam = array( 
		'name'=> 'マンスリーバナー',
		'singular_name' =>  'マンスリーバナー',
		'all_items' => 'マンスリーバナー 一覧'
	);

	$cam2 = array( 
		'labels'=> $cam,
        'rewrite'       => array( 'slug' => 'cam' ),
        'description' =>'アリエル美容クリニックのマンスリーバナーの一覧です。',
		'public'        => true,
		'show_ui'       => true,
		'menu_position' => 5,
		'has_archive'   => true,
		'supports'      => array( 'title','author','editor','comments','trackbacks', 'revisions','thumbnail','custom-fields','excerpt','page-attributes'),
		'taxonomies' => array('category', 'post_tag'),
	);
	register_post_type( 'cam', $cam2 );

}

$calendar = array( 
    'name'=> 'カレンダー',
    'singular_name' =>  'calendar',
    'all_items' => 'カレンダー一覧' 
);
$calendar2 = array( 
    'labels'=> $calendar,
    'rewrite'        => array( 'slug' => 'calendar' ),
    'description' =>'カレンダー一覧です。',
    'public'        => true,
    'show_ui'       => true,
    'menu_position' => 5,
    'has_archive'   => true,
    'supports'      => array( 'title','author','editor','comments','trackbacks', 'revisions','thumbnail','custom-fields','excerpt','page-attributes'),
    'taxonomies' => array('category', 'post_tag'),
);
register_post_type( 'calendar', $calendar2 );
$schedule = array( 
    'name'=> 'スケジュール',
    'singular_name' =>  'schedule',
    'all_items' => 'スケジュール一覧' 
);
$schedule2 = array( 
    'labels'=> $schedule,
    'rewrite'        => array( 'slug' => 'schedule' ),
    'description' =>'スケジュール一覧です。',
    'public'        => true,
    'show_ui'       => true,
    'menu_position' => 5,
    'has_archive'   => true,
    'supports'      => array( 'title','author','editor','comments','trackbacks', 'revisions','thumbnail','custom-fields','excerpt','page-attributes'),
    'taxonomies' => array('category', 'post_tag'),
);
register_post_type( 'schedule', $schedule2 );

function get_calendar_object($start_date, $start_week = 0)
{
	$weekdays = [
		['label' => "⽇", 'value' => 0],
		['label' => "⽉", 'value' => 1],
		['label' => "⽕", 'value' => 2],
		['label' => "⽔", 'value' => 3],
		['label' => "⽊", 'value' => 4],
		['label' => "⾦", 'value' => 5],
		['label' => "⼟", 'value' => 6],
	];
	$start_date = new \DateTime($start_date);
	$days_list  = [];

	for ($i = 0; $i < 7; $i++) {
		$day_cell = $weekdays[$i];
		array_push($days_list, $day_cell);
	}

	// reassign the day_list order by weekday setting
	if ($start_week !== 7) {
		$sw = $start_week;
	} else {
		$sw = $start_date->format('w');
	}

	for ($weekHeIndex = 0; $weekHeIndex < $sw; $weekHeIndex++) {
		array_shift($days_list);
		array_push($days_list, $weekdays[$weekHeIndex]);
	}

	// Create the table body rows
	$year_list = [];
	$month_captions = [];
	for ($j = 0; $j < 3; $j++) {
		$month_list = [];

		$orign_date = clone $start_date;
		$orign_date->modify("+$j months");

		$added_next_month = clone $start_date;
		$added_next_month->modify(($j + 1) . "months");

		array_push($month_captions, $orign_date->format("Y.m"));
		for ($i = 0; $i < 42; $i++) {
			$added_date = clone $orign_date;
			$added_date->modify("+$i days");

			if ($added_date < $added_next_month) {
				$month_list[] = $added_date->format("Y-m-d");
			} else {
				$month_list[] = "";
			}
		}

		$start_day_of_month = (int)$orign_date->format('w');  // Get the weekday of the 1st day of the month
		$week_diff = ($start_day_of_month - $start_week + 7) % 7;

		for ($i = 0; $i < $week_diff; $i++) {
			array_unshift($month_list, "");  // Add empty strings for padding before the first day of the month
			array_pop($month_list);  // Remove extra days at the end
		}

		$date_list = [];
		while (count($month_list) > 0) {
			array_push($date_list, array_splice($month_list, 0, 7));
		}

		// removed empty 6rows
		foreach($date_list as $week_nth => $rows) {
			$is_all_null = every($rows, function ($date_val) {
				return $date_val == "";
			});
			if($is_all_null) {
				array_pop($date_list);
			}
		}
		array_push($year_list, $date_list);
	}
	return [
		"date_list"      => $year_list,
		"days_list"      => $days_list,
		"month_captions" => $month_captions,
	];
}

function every($array, $callback)
{
	return array_reduce(
		$array,
		function ($carry, $item) use ($callback) {
			return $carry && call_user_func($callback, $item);
		},
		true
	);
}

function date_filter($schedule, $date)
{
	$filtered_item = array_filter($schedule, function ($item) use ($date) {
		return strtotime($item['work_date']) == strtotime($date);
	});
    
    // 配列が空かどうかを最初にチェック
    if (empty($filtered_item)) {
        return [
            'is_holiday' => null,
            'doctor_1' => null,
        ];
    }


	$filtered_item = array_values($filtered_item)[0];
	if (!empty($filtered_item)) {
		return [
			'is_holiday' => $filtered_item['is_holiday'],
			'doctor_1'   => $filtered_item['doctor_1'],
		];
	} else {
		return [
			'is_holiday' => null,
			'doctor_1' => null,
		];
	}
}

function filter_by_work_date(array $data, string $date): array {
    return array_filter($data, function($entry) use ($date) {
        return $entry['work_date'] === $date;
    });
}


//ブログカード無効化
remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result');
// 固定ページビジュアルエディター無効化
function disable_visual_editor( $wp_rich_edit ) {
    $posttype = get_post_type();
    if ( $posttype === 'medical_treatment' ) {
        return false;
    } else {
        return $wp_rich_edit;
    }
}
add_filter( 'user_can_richedit', 'disable_visual_editor' );

function booking_template_shortcode() {
  ob_start();
  get_template_part('template_parts/booking');
  return ob_get_clean();
}
add_shortcode('booking_template', 'booking_template_shortcode');

// コラム記事詳細ページ用の設定（軽量版）

// アイキャッチ画像のサポート
add_theme_support('post-thumbnails');

// カスタム画像サイズの追加
add_image_size('column-thumbnail', 1000, 440, true);

// スタイルシートの読み込み
function enqueue_column_styles() {
    if (is_singular('post') || is_page_template('single-column.php')) {
        // Google Fontsの読み込み
        wp_enqueue_style('google-fonts-noto', 'https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;500;700&display=swap', array(), null);
        
        // コラム詳細ページ用CSS
        wp_enqueue_style('column-detail', get_template_directory_uri() . '/css/column-detail.css', array(), '1.0.0');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_column_styles');

// JavaScriptの読み込み
function enqueue_column_scripts() {
    if (is_singular('post') || is_page_template('single-column.php')) {
        wp_enqueue_script('column-detail', get_template_directory_uri() . '/js/column-detail.js', array(), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_column_scripts');

// 抜粋の文字数を変更（必要に応じて）
function custom_excerpt_length($length) {
    return 100;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

// 抜粋の末尾を変更（必要に応じて）
function custom_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');

// 目次の自動生成
function auto_generate_toc($content) {
    if (!is_single()) {
        return $content;
    }
    
    // H2、H3、H4タグを検索
    $pattern = '/<h([234]).*?>(.*?)<\/h[234]>/i';
    preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
    
    if (empty($matches)) {
        return $content;
    }
    
    // 目次HTMLの生成
    $toc = '<div class="table-of-contents">';
    $toc .= '<div class="table-of-contents-title">目次</div>';
    $toc .= '<ol>';
    
    $h2_counter = 0;
    $h3_open = false;
    $h4_open = false;
    
    foreach ($matches as $index => $match) {
        $level = $match[1];
        $title = strip_tags($match[2]);
        $id = 'heading-' . ($index + 1);
        
        // 前のレベルのリストを閉じる
        if ($level == 2) {
            if ($h4_open) {
                $toc .= '</ol></li>';
                $h4_open = false;
            }
            if ($h3_open) {
                $toc .= '</ol></li>';
                $h3_open = false;
            }
            $h2_counter++;
            $toc .= '<li><a href="#' . $id . '">' . $title . '</a>';
        } elseif ($level == 3) {
            if ($h4_open) {
                $toc .= '</ol></li>';
                $h4_open = false;
            }
            if (!$h3_open && $h2_counter > 0) {
                $toc .= '<ol>';
                $h3_open = true;
            }
            $toc .= '<li><a href="#' . $id . '">' . $title . '</a>';
        } elseif ($level == 4) {
            if (!$h4_open && $h3_open) {
                $toc .= '<ol>';
                $h4_open = true;
            }
            $toc .= '<li><a href="#' . $id . '">' . $title . '</a></li>';
        }
        
        // コンテンツ内の見出しにIDを追加
        $replacement = '<h' . $level . ' id="' . $id . '">' . $match[2] . '</h' . $level . '>';
        $content = str_replace($match[0], $replacement, $content);
    }
    
    // 開いているリストを閉じる
    if ($h4_open) {
        $toc .= '</ol></li>';
    }
    if ($h3_open) {
        $toc .= '</ol></li>';
    }
    
    $toc .= '</ol></div>';
    
    // 最初のH2タグの前に目次を挿入
    $first_h2_pos = strpos($content, '<h2');
    if ($first_h2_pos !== false) {
        $content = substr_replace($content, $toc, $first_h2_pos, 0);
    }
    
    return $content;
}
add_filter('the_content', 'auto_generate_toc');
