<?php 
/*
Template Name: Price Page
*/
get_header(); ?>
<main>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php the_content(); ?>
  <?php endwhile; endif; ?>
	<?php get_template_part('template_parts/booking'); ?>
</main>
<?php get_footer(); ?>