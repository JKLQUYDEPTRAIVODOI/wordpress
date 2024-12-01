<?php
/**
 * The template for displaying search results pages.
 */
?>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php get_header(); ?>
<div id="page">
	<div class="article">
		<div id="content_box">
			<h1 class="postsby">
				<span><?php _e("Search Results for:", "best"); ?></span> <?php the_search_query(); ?>
			</h1>
			<section id="latest-posts" class="clearfix">
			<?php $j = 1; $featured_category_layout = 'vertical';
			if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php best_the_homepage_article( $featured_category_layout, $j, true );?>
			<?php $j++; endwhile; else: ?>
				<div class="no-results">
					<h2><?php _e('We apologize for any inconvenience, please hit back on your browser or use the search form below.', 'best'); ?></h2>
					<?php get_search_form(); ?>
				</div><!--.no-results-->
			<?php endif; ?>
			<?php if ( $j !== 1 ) { // No pagination if there is no results ?>
			<!--Start Pagination-->
			<?php if (isset($mts_options['mts_pagenavigation_type']) && $mts_options['mts_pagenavigation_type'] == '1' ) { ?>
				<?php $additional_loop = 0; mts_pagination($additional_loop['max_num_pages']); ?>
			<?php } else { ?>
				<div class="pagination pagination-previous-next">
					<ul>
						<li class="nav-previous"><?php next_posts_link( '<i class="fa fa-chevron-left"></i> '. __( 'Previous', 'best' ) ); ?></li>
						<li class="nav-next"><?php previous_posts_link( __( 'Next', 'best' ).' <i class="fa fa-chevron-right"></i>' ); ?></li>
					</ul>
				</div>
			<?php } ?>
			<!--End Pagination-->
			<?php } ?>
			</section>
		</div>
	</div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>