<?php 
/*
Template Name: About Case Page
*/
get_header(); ?>
<main>
	<div class="main_about_case main_case main_price">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php the_content(); ?>
			<?php endwhile; endif; ?>
	</div>
	<?php get_template_part('template_parts/booking', null); ?>
</main>
<?php get_footer(); ?>