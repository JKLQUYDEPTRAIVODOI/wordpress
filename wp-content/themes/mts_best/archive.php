<?php
/**
 * The template for displaying archive pages.
 *
 * Used for displaying archive-type pages. These views can be further customized by
 * creating a separate template for each one.
 *
 * - author.php (Author archive)
 * - category.php (Category archive)
 * - date.php (Date archive)
 * - tag.php (Tag archive)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

$mts_options = get_option(MTS_THEME_NAME);
?>
<?php get_header(); ?>
<div id="page">
	<div class="<?php mts_article_class(); ?>">
		<div id="content_box">
			<h1 class="postsby">
				<span><?php the_archive_title(); ?></span>
			</h1>
			<section id="latest-posts" class="clearfix">
			<?php $j = 1; $featured_category_layout = 'vertical';
			if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php best_the_homepage_article( $featured_category_layout, $j, true );?>
			<?php $j++; endwhile; endif; ?>
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
			</section><!--#latest-posts-->
		</div>
	</div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>