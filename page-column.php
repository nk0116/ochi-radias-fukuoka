<?php 
/*
Template Name: Column Page
*/
get_header(); 

// Check if a specific category is requested
$current_category = isset($_GET['category']) ? intval($_GET['category']) : 0;
?>
<main class="main_column">
	
    <div class="main_price">
      <h2>Price</h2>
      <div class="features_bar"></div>
      <h3>特徴</h3>
      <div class="main_column_bg"></div>
		<div class="column_content_wrapper">
			<div class="column_content">
				<div class="column_content_button">
					<a href="<?php echo get_permalink(get_the_ID()); ?>">view all column</a>
					<div class="column_border"></div>
					<h4>Category</h4>
					<div class="column_category_link">
						<?php
						// Get all categories
						$categories = get_categories(array(
							'orderby' => 'id',
							'order'   => 'ASC',
							'hide_empty' => false
						));

						// Loop through categories and display them
						foreach ($categories as $category) {
							$active_class = ($current_category == $category->term_id) ? 'active' : '';
							echo '<a href="' . add_query_arg('category', $category->term_id, get_permalink(get_the_ID())) . '" class="' . $active_class . '">' . $category->name . '</a>';
						}
						?>
					</div>
				</div>
				<div class="column_artice_wrapper">
					<div class="column_border"></div>
					<?php
					// Set up the query
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args = array(
						'post_type' => 'column',
						'posts_per_page' => 4,
						'paged' => $paged
					);

					// Add category parameter if a category is selected
					if ($current_category > 0) {
						$args['tax_query'] = array(
							array(
								'taxonomy' => 'category',
								'field'    => 'term_id',
								'terms'    => $current_category,
							),
						);
					}

					$column_query = new WP_Query($args);

					// The Loop
					if ($column_query->have_posts()) :
						while ($column_query->have_posts()) : $column_query->the_post();
					?>
						<div class="column_article">
							<?php if (has_post_thumbnail()) : ?>
								<?php the_post_thumbnail('medium'); ?>
							<?php else : ?>
								<img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="No Image">
							<?php endif; ?>
							<div class="column_article_text">
								<div>
									<time><?php echo get_the_date('Y.m.d'); ?></time>
									<?php
									$categories = get_the_category();
									if (!empty($categories)) {
										echo '<a href="' . add_query_arg('category', $categories[0]->term_id, get_permalink(get_the_ID())) . '">' . esc_html($categories[0]->name) . '</a>';
									}
									?>
								</div>
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							</div>
							<a class="arrow_button" href="<?php the_permalink(); ?>">
								<div></div>
							</a>
						</div>
						<div class="column_border"></div>
					<?php
						endwhile;
					else :
						echo '<p>このカテゴリにはコラムが見つかりません。</p>';
					endif;

					// Reset post data
					wp_reset_postdata();
					?>
				</div>
			</div>

			<div class="column_pagenation">
				<?php
				$total_pages = $column_query->max_num_pages;

				if ($total_pages > 1) {
					$current_page = max(1, get_query_var('paged'));

					// Base URL for pagination that preserves the category filter
					$base_url = add_query_arg(null, null);
					if (strpos($base_url, 'paged=') !== false) {
						$base_url = remove_query_arg('paged', $base_url);
					}

					// Display page numbers
					for ($i = 1; $i <= min(3, $total_pages); $i++) {
						$active_class = ($i == $current_page) ? 'active' : '';
						$page_link = add_query_arg('paged', $i, $base_url);
						echo '<a href="' . $page_link . '" class="' . $active_class . '">' . $i . '</a>';
					}

					// Display "Next" link if not on the last page
					if ($current_page < $total_pages) {
						$next_link = add_query_arg('paged', $current_page + 1, $base_url);
						echo '<a href="' . $next_link . '" class="next">Next</a>';
					}
				}
				?>
			</div>
		</div>
	</div>
    <?php get_template_part('template_parts/booking'); ?>
</main>
<?php get_footer(); ?>