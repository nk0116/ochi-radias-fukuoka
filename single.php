<?php get_header(); ?>

<main>
    <div class="page-content">
        <?php 
        if (have_posts()) :
            while (have_posts()) : the_post();
                the_content();
            endwhile;
        endif;
        ?>
        <?php get_template_part('template_parts/doctor'); ?>
        <?php get_template_part('template_parts/booking'); ?>
        </main>
    </div>
</main>

<?php get_footer(); ?>