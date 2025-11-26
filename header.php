<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?> - <?php wp_title(); ?></title>
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
  <?php wp_head(); ?>
</head>
<body>
  <header>
    <div class="header_information">
      <div class="header_information_phone">
        <img src="<?php echo get_template_directory_uri(); ?>/img/vector_phone.png" class="img_phone" alt="phone" loading="lazy">
        <p>092-791-5973</p>  
      </div>
      <p>診療時間　9:00〜18:00</p>
      <p>休診日：水・木</p>  
      <p class="res_sp">レディアス美容クリニック福岡</p>
    </div>
    <div class="header_content">
      <div class="header_toggle res_sp">
        <div></div>
        <div></div>
        <div></div>
      </div>
      <a href="/">
        <div class="header_logo">
          <img src="<?php echo get_template_directory_uri(); ?>/img/RBC_logo_1.webp" loading="lazy" alt="ロゴ画像">
          <h1><?php bloginfo('name'); ?></h1>
        </div>  
      </a>
      <div class="header_content_menu">
        <div class="header_menu_link">
          <a href="https://line.me/R/ti/p/@609fsprl?ts=03301632&oat_content=url" class="line_link"  target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/img/line-icon.png" loading="lazy" alt="lineアイコン">
            LINE予約
          </a>
          <a href="<?php echo get_page_link( 347 );?>" class="contact_link"  target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/img/web-icon.png" loading="lazy" alt="WEBサイトアイコン">
            お問い合わせ
          </a>
          <div class="res_sp">
            <p>営業時間</p>
            <p>9:00〜18:00</p>
          </div>
        </div>
        <ul>
          <li><a href="<?php echo home_url('/');?>">HOME</a></li>
          <li><a href="<?php echo home_url('/price');?>">料金表</a></li>
          <li><a href="<?php echo home_url('/treatment');?>">施術一覧</a></li>
          <li><a href="<?php echo home_url('/case');?>">症例一覧</a></li>
          <li><a href="<?php echo home_url('/about_clinic');?>">当院について</a></li>
          <li><a href="<?php echo home_url('/clinic');?>">各クリニック案内</a></li>
          <li><a href="<?php echo home_url('/flow');?>">施術の流れ</a></li>
          <li><a href="<?php echo home_url('/faq');?>">よくある質問</a></li>
          <li><a href="<?php echo home_url('/aftercare');?>">アフターケア</a></li>
          <li><a href="<?php echo home_url('/doctor');?>">ドクター紹介</a></li>
        </ul>
      </div>
    </div>
  </header>