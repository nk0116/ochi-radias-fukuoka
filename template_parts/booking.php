  <?php 
  /*
    Template Name: Booking Template
  */
  ?>

  <?php
  $post_obj = get_page_by_path('booking');
  $post_id = $post_obj->ID;
  ?>

  <div class="main_booking">
    <div class="booking_content">
        <h3>ご予約・お問い合わせはこちらから</h3>
        
        <?php if (get_field('phone_number', $post_id)): ?>
            <h2><?php echo get_field('phone_number', $post_id) ?></h2>
        <?php endif; ?>
        
        <div class="booking_content_link">
            <?php if (get_field('line_link', $post_id)): ?>
                <a href="https://line.me/R/ti/p/@609fsprl?ts=03301632&oat_content=url" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/line-icon-white.png" alt="LINEアイコン" loading="lazy">LINE
                </a>
            <?php endif; ?>

            <?php if (get_field('web_link', $post_id)): ?>
                <a href="<?php echo home_url('/contact');?>" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/web-icon-white.png" alt="WEBアイコン" loading="lazy">WEB予約
                </a>
            <?php endif; ?>

            <?php if (get_field('phone_number', $post_id)): ?>
                <a href="tel:092-791-5973">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/vector_phone.png" alt="電話" loading="lazy">電話予約
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

