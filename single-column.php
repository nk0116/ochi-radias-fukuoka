<?php 
/*
Template Name: Column Single Post
Template Post Type: post
*/
get_header(); ?>
<main>
  <div class="main_about_column main_column">
    <div class="about_column_content_header column_content_header">
      <h2>Column</h2>
      <div class="features_bar"></div>
      <h3>コラム</h3>
    </div>
    <div class="about_column_bg"></div>
    <div class="about_column_content_wrapper">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <!-- アイキャッチ画像 -->
        <?php if (has_post_thumbnail()) : ?>
          <div class="article-thumbnail">
            <?php the_post_thumbnail('large'); ?>
          </div>
        <?php endif; ?>
        
        <!-- カテゴリラベル -->
        <?php 
        $categories = get_the_category();
        if (!empty($categories)) : ?>
          <div class="category-labels">
            <?php foreach($categories as $category) : ?>
              <span class="category-label">
                <?php echo esc_html($category->name); ?>
              </span>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        
        <!-- 記事タイトル -->
        <h1><?php the_title(); ?></h1>
        
        <!-- 本文 -->
        <div class="post-content">
          <?php the_content(); ?>
        </div>
        
        <!-- コラム一覧に戻るボタン -->
        <div class="back-to-list">
          <?php 
          // コラム一覧ページのURLを適宜変更してください
          // 例: カテゴリーページの場合 → get_category_link()
          // 例: 固定ページの場合 → get_permalink(ページID)
          ?>
          <a href="<?php echo home_url('/column/'); ?>" class="back-to-list-button">コラム一覧に戻る</a>
        </div>
        
      <?php endwhile; endif; ?>
    </div>
  </div>
  <?php get_template_part('template_parts/doctor'); ?>
  <?php get_template_part('template_parts/booking'); ?>
</main>
<?php get_footer(); ?>

<style>
.table-of-contents ul {
  margin: 0;
  padding-left: 24px;
}/* コラム記事詳細ページのスタイル */

/* メインコンテナ */
.main_about_column.main_column {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 40px 20px;
}

/* ヘッダー部分 */
.about_column_content_header.column_content_header {
  text-align: center;
  margin-bottom: 40px;
}

.about_column_content_header h2 {
  font-family: 'Noto Serif JP', serif;
  font-size: 36px;
  font-weight: 700;
  margin-bottom: 10px;
}

.features_bar {
  width: 60px;
  height: 3px;
  background-color: #AD7F52;
  margin: 0 auto 20px;
}

.about_column_content_header h3 {
  font-family: 'YuMincho', '游明朝', serif;
  font-size: 20px;
  font-weight: 500;
  color: #666666;
}

/* 記事コンテンツラッパー */
.about_column_content_wrapper {
  max-width: 1000px;
  width: 100%;
  margin: 0 auto;
  gap: 32px;
}

/* アイキャッチ画像 */
.article-thumbnail {
  width: 100%;
  height: 440px;
  margin-bottom: 24px;
  overflow: hidden;
  border-radius: 10px;
}

.article-thumbnail img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  opacity: 1;
}

/* カテゴリラベルコンテナ */
.category-labels {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 24px;
}

/* カテゴリラベル */
.category-label {
  display: inline-block;
  font-family: 'Noto Serif JP', serif;
  font-weight: 500;
  font-size: 12px;
  line-height: 12px;
  letter-spacing: 0.04em;
  text-align: center;
  color: #FFFFFF;
  background: #AD7F52;
  padding: 4px 8px;
  border-radius: 10px;
  min-width: 78px;
  height: 20px;
  opacity: 1;
}

.category-label a {
  color: #FFFFFF;
  text-decoration: none;
}

/* 見出しスタイル */
.about_column_content_wrapper h1 {
  font-family: 'YuMincho', '游明朝', serif;
  font-weight: 800;
  font-size: 36px;
  line-height: 150%;
  letter-spacing: 0;
  color: #AD7F52;
  margin: 0 0 24px;
}

.about_column_content_wrapper h2 {
  font-family: 'YuMincho', '游明朝', serif;
  font-weight: 800;
  font-size: 24px;
  line-height: 150%;
  letter-spacing: 0;
  color: #AD7F52;
  margin: 32px 0 20px;
}

.about_column_content_wrapper h3 {
  font-family: 'YuMincho', '游明朝', serif;
  font-weight: 800;
  font-size: 20px;
  line-height: 150%;
  letter-spacing: 0;
  color: #AD7F52;
  margin: 24px 0 16px;
}

.about_column_content_wrapper h4 {
  font-family: 'YuMincho', '游明朝', serif;
  font-weight: 700;
  font-size: 18px;
  line-height: 150%;
  letter-spacing: 0;
  color: #AD7F52;
  margin: 20px 0 12px;
}

/* 通常テキスト */
.about_column_content_wrapper p {
  font-family: 'YuMincho', '游明朝', serif;
  font-weight: 500;
  font-size: 16px;
  line-height: 178%;
  letter-spacing: 0;
  color: #666666;
  margin-bottom: 20px;
}

/* 目次スタイル */
.table-of-contents {
  width: 100%;
  border: 1px solid #CCCCCC;
  border-radius: 8px;
  padding: 16px 32px;
  margin: 32px 0;
  opacity: 1;
}

.table-of-contents-title {
  font-family: 'YuMincho', '游明朝', serif;
  font-weight: 700;
  font-size: 20px;
  line-height: 32px;
  letter-spacing: 0;
  color: #ffffff;
  background: #C09D7B;
  margin: -16px -32px 16px;
  padding: 16px 32px;
  border-radius: 8px 8px 0 0;
}

.table-of-contents ol {
  margin: 0;
  padding-left: 24px;
}

.table-of-contents ul {
  margin: 0;
  padding-left: 24px;
}

.table-of-contents ol ol {
  margin-top: 4px;
}

.table-of-contents ol ol ol {
  font-size: 16px;
}

.table-of-contents li {
  font-family: 'YuMincho', '游明朝', serif;
  font-weight: 500;
  font-size: 18px;
  line-height: 32px;
  letter-spacing: 0;
  color: #666666;
  margin-bottom: 8px;
}

.table-of-contents a {
  color: #666666;
  text-decoration: none;
  transition: color 0.3s ease;
}

.table-of-contents a:hover {
  color: #AD7F52;
  text-decoration: underline;
}

/* リストスタイル */
.about_column_content_wrapper ul,
.about_column_content_wrapper ol {
  font-family: 'YuMincho', '游明朝', serif;
  font-weight: 500;
  font-size: 16px;
  line-height: 178%;
  letter-spacing: 0;
  color: #666666;
  margin: 20px 0;
  padding-left: 32px;
}

.about_column_content_wrapper li {
  margin-bottom: 12px;
}

/* 引用スタイル */
.about_column_content_wrapper blockquote {
  font-family: 'YuMincho', '游明朝', serif;
  font-weight: 500;
  font-size: 16px;
  line-height: 178%;
  color: #666666;
  margin: 24px 0;
  padding: 20px;
  background: #F9F9F9;
  border-left: 4px solid #C09D7B;
  font-style: italic;
}

/* 画像の中央配置 */
.about_column_content_wrapper img {
  max-width: 100%;
  height: auto;
  display: block;
  margin: 24px auto;
  border-radius: 8px;
}

/* テーブルスタイル */
.about_column_content_wrapper table {
  width: 100%;
  border-collapse: collapse;
  margin: 24px 0;
  font-family: 'YuMincho', '游明朝', serif;
  font-size: 16px;
  color: #666666;
}

.about_column_content_wrapper th,
.about_column_content_wrapper td {
  border: 1px solid #CCCCCC;
  padding: 12px 16px;
  text-align: left;
}

.about_column_content_wrapper th {
  background: #F5F5F5;
  font-weight: 700;
  color: #333333;
}

/* 投稿日時 */
.post-meta {
  font-family: 'Noto Serif JP', serif;
  font-size: 14px;
  color: #999999;
  margin-bottom: 32px;
  padding-bottom: 16px;
  border-bottom: 1px solid #E5E5E5;
}

/* コラム一覧に戻るボタン */
.back-to-list {
  text-align: center;
  margin: 48px 0 32px;
}

.back-to-list-button {
  display: inline-block;
  font-family: 'Noto Serif JP', serif;
  font-size: 16px;
  font-weight: 500;
  color: #FFFFFF;
  background-color: #AD7F52;
  padding: 16px 48px;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.back-to-list-button:hover {
  background-color: #8B6841;
}

/* レスポンシブ対応 */
@media (max-width: 1040px) {
  .article-thumbnail {
    height: auto;
    aspect-ratio: 1000 / 440;
    margin-left: -20px;
    margin-right: -20px;
    width: calc(100% + 40px);
    border-radius: 0;
  }
  
  .about_column_content_wrapper {
    padding: 0 20px;
  }
  
  .table-of-contents {
        margin: 0 auto;
        border-radius: 10px;
  }
  
  .about_column_content_wrapper img {
    margin-left: -20px;
    margin-right: -20px;
    width: calc(100% + 40px);
    max-width: none;
    border-radius: 0;
  }
}

@media (max-width: 768px) {
  .main_about_column.main_column {
    padding: 20px 0;
  }
  
  .about_column_content_wrapper {
    margin: 0 20px;
    padding: 0;
  }
  
  .article-thumbnail {
    margin-left: -20px;
    margin-right: -20px;
    width: calc(100% + 40px);
    max-width: none;
    border-radius: 0;
  }
  
  .about_column_content_header h2 {
    font-size: 28px;
  }
  
  .about_column_content_wrapper h1 {
    font-size: 28px;
  }
  
  .about_column_content_wrapper h2 {
    font-size: 20px;
  }
  
  .about_column_content_wrapper h3 {
    font-size: 18px;
  }
  
  .about_column_content_wrapper h4 {
    font-size: 16px;
  }
  
  .table-of-contents {
    margin-left: -20px;
    margin-right: -20px;
    width: calc(100% + 40px);
    border-radius: 0;
    padding: 12px 20px;
  }
  
  .table-of-contents-title {
    margin: -12px -20px 12px;
    padding: 12px 20px;
  }
  
  .table-of-contents li {
    font-size: 16px;
    line-height: 28px;
  }
  
  .table-of-contents li:first-child {
    margin-right: -20px;
  }
  
  .about_column_content_wrapper p,
  .about_column_content_wrapper ul,
  .about_column_content_wrapper ol {
    font-size: 15px;
  }
  
  .about_column_content_wrapper img {
    margin-left: -20px;
    margin-right: -20px;
    width: calc(100% + 40px);
    max-width: none;
    border-radius: 0;
  }
  
  .about_column_content_wrapper blockquote {
    margin-left: 0;
    margin-right: 0;
  }
  
  .back-to-list-button {
    display: block;
    width: 100%;
    max-width: 300px;
    margin: 0 auto;
  }
  .main_about_column .about_column_content_wrapper {
    padding: clamp(32px, 2.5rem, 60px) 0;
	width:auto;
  }
  .table-of-contents {
	  width: 100%;
	  margin: 0 auto;
	  border-radius: 10px;
	  padding: 12px 20px;
  }
}
</style>