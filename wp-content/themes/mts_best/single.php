<?php
/**
 * The template for displaying all single posts.
 */
?>

<?php get_header(); ?>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<div id="page" class="<?php mts_single_page_class(); ?>">
	<?php $header_anim = mts_get_post_header_effect();
		if ( $header_anim == "parallax" || $header_anim == "zoomout" ) : ?>
		<?php if (mts_get_thumbnail_url()) : ?>
        	<div id="parallax" <?php echo 'style="background-image: url('.mts_get_thumbnail_url(). ');"'; ?>></div>
    	<?php endif; ?> 
    <?php endif; ?>
	<article class="<?php mts_article_class(); ?>">
		<div id="content_box" >
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
					<div class="single_post">
						<?php if ($mts_options['mts_breadcrumb'] == '1') { ?>
							<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#"><?php mts_the_breadcrumb(); ?></div>
						<?php } ?>
						<?php
						// Single post parts ordering
						if ( isset( $mts_options['mts_single_post_layout'] ) && is_array( $mts_options['mts_single_post_layout'] ) && array_key_exists( 'enabled', $mts_options['mts_single_post_layout'] ) ) {
							$single_post_parts = $mts_options['mts_single_post_layout']['enabled'];
						} else {
							$single_post_parts = array( 'content' => 'content', 'author' => 'author' );
						}
						foreach( $single_post_parts as $part => $label ) { 
							switch ($part) {
								case 'content': ?>
						<header>
							<h1 class="title single-title entry-title"><?php the_title(); ?></h1>
							<?php mts_the_postinfo( 'single' ); ?>
						</header><!--.headline_area-->
						<div class="post-single-content box mark-links entry-content">
							<?php if (isset($mts_options['mts_social_button_position']) && $mts_options['mts_social_button_position'] == 'top') mts_social_buttons(); ?>
							
                            <?php if($mts_options['mts_single_post_related'] == 'rclayout' || $mts_options['mts_single_post_related'] == 'crlayout') {  echo '<div class="post-single-content-inner">';}?>
							<?php if ($mts_options['mts_posttop_adcode'] != '') { ?>
								<?php $toptime = $mts_options['mts_posttop_adcode_time']; if (strcmp( date("Y-m-d", strtotime( "-$toptime day")), get_the_time("Y-m-d") ) >= 0) { ?>
									<div class="topad">
										<?php echo do_shortcode($mts_options['mts_posttop_adcode']); ?>
									</div>
								<?php } ?>
							<?php } ?>
							<?php the_content(); ?>
							<?php wp_link_pages(array('before' => '<div class="pagination">', 'after' => '</div>', 'link_before'  => '<span class="current">', 'link_after' => '</span>', 'next_or_number' => 'next_and_number', 'nextpagelink' => __('Next','best'), 'previouspagelink' => __('Previous','best'), 'pagelink' => '%','echo' => 1 )); ?>
							<?php if ($mts_options['mts_postend_adcode'] != '') { ?>
								<?php $endtime = $mts_options['mts_postend_adcode_time']; if (strcmp( date("Y-m-d", strtotime( "-$endtime day")), get_the_time("Y-m-d") ) >= 0) { ?>
									<div class="bottomad">
										<?php echo do_shortcode($mts_options['mts_postend_adcode']); ?>
									</div>
								<?php } ?>
							<?php } ?>

							<?php if (isset($mts_options['mts_social_button_position']) && $mts_options['mts_social_button_position'] !== 'top') mts_social_buttons(); ?>

                            <?php if($mts_options['mts_single_post_related'] == 'rclayout' || $mts_options['mts_single_post_related'] == 'crlayout') { ?>
                                </div>
                                <div class="singleleft <?php echo $mts_options['mts_single_post_related']; ?>">  
                                    <!-- Start Related Posts -->
                                    <?php $categories = get_the_category($post->ID); if ($categories) { $category_ids = array(); foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id; 
                                    
                                    $args = array( 
                                        'category__in' => $category_ids, 
                                        'post__not_in' => array($post->ID), 
                                        'showposts'=>isset( $mts_options['mts_related_postsnum'] ) ? $mts_options['mts_related_postsnum'] : 4,
                                        'ignore_sticky_posts' => 1, 
                                        'orderby' => 'rand' 
                                    );
                                    
                                    $my_query = new wp_query( $args ); if( $my_query->have_posts() ) {
                                        echo '<div class="related-posts"><div class="postauthor-top"><h3>'.__('Related','mythemeshop').'</h3></div><ul>';
                                        $counter = '0'; while( $my_query->have_posts() ) { ++$counter; if($counter == 4) { $postclass = 'last'; $counter = 0; } else { $postclass = ''; } $my_query->the_post(); $li = 1; ?>
                                        <li class="<?php echo $postclass; ?> relatepostli<?php echo $li+$counter; ?>">
                                            <a rel="nofollow" class="relatedthumb" href="<?php the_permalink()?>" title="<?php the_title(); ?>">
                                                <span class="rthumb">
                                                    <?php the_post_thumbnail('best-widgetthumb', array('title' => '')); ?>
                                                </span>
                                                <span><?php the_title(); ?></span>
                                            </a>
                                        </li>
                                        <?php } echo '</ul></div>'; }} wp_reset_query(); ?>
                                    <!-- .related-posts -->
                                </div><!-- .singleleft -->
                            <?php } ?>
						</div><!--.post-content box mark-links-->
					</div><!--.single_post-->
                    <?php if($mts_options['mts_single_post_related'] == 'cbrlayout') { ?>
						<!-- Start Related Posts -->
						<?php 
						$categories = get_the_category($post->ID); if ($categories) { $category_ids = array(); foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id; 
						
						$args = array( 
							'category__in' => $category_ids, 
							'post__not_in' => array($post->ID), 
							'showposts' => isset( $mts_options['mts_related_postsnum'] ) ? $mts_options['mts_related_postsnum'] : 4, 
							'ignore_sticky_posts' => 1, 
							'orderby' => 'rand' 
						);

						$my_query = new WP_Query( $args ); if( $my_query->have_posts() ) {
							echo '<div class="related-posts"><div class="postauthor-top"><h3>'.__('Related','best').'</h3></div><ul>';
							while( $my_query->have_posts() ) { $my_query->the_post(); ?>
							<li class="post-box horizontal-small">
								<div class="horizontal-container">
									<div class="horizontal-container-inner">
										<div class="post-img">
											<a rel="nofollow" href="<?php the_permalink()?>" title="<?php the_title(); ?>">
												<?php the_post_thumbnail('best-widgetthumb',array('title' => '')); ?>
											</a>
										</div>
										<div class="post-data">
											<div class="post-data-container">
												<div class="post-title">
													<a href="<?php the_permalink()?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
												</div>
												<div class="post-info">
													<span class="thetime updated"><?php the_time( get_option( 'date_format' ) ); ?></span>
													<span class="thecomment"><i class="fa fa-comments"></i> <a rel="nofollow" href="<?php comments_link(); ?>"><?php echo comments_number('0','1','%');?></a></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
							<?php } echo '</ul></div><!-- .related-posts -->'; }} wp_reset_postdata(); ?>
					<?php } ?>
                    <?php 
					break;

					case 'tags':

						if( has_tag() ) { ?>
							<span class="thetags"><?php mts_the_tags(''); ?></span>
						<?php
						}
					
					break;

					case 'author':
					?> 					
					
					<div class="postauthor">
						<h4><?php _e('About The Author', 'best'); ?></h4>
						<div class="author-box">
							<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '150' );  } ?>
							<div class="author-box-content">
								<div class="vcard clearfix">
									<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="nofollow" class="fn"><i class="fa fa-user"></i><?php the_author_meta( 'nickname' ); ?></a>
									<?php if($mts_options['mts_author_box_mail'] == '1') { ?>
									<a href="mailto:<?php echo antispambot(the_author_meta('user_email')); ?>" rel="nofollow" class="mail"><i class="fa fa-envelope"></i><?php _e('Email Author', 'best');?></a>
									<?php } ?>
								</div>
								<?php if( get_the_author_meta( 'description' ) ) { ?>
								<p><?php the_author_meta('description') ?></p>
								<?php }?>
							</div>
						</div>
					</div>
					<?php 
						} 
					} 
					?>
					
				</div><!--.g post-->
				<?php comments_template( '', true ); ?>
			<?php endwhile; /* end loop */ ?>
		</div>
	</article>
    <?php get_sidebar(); ?>
<?php get_footer(); ?>