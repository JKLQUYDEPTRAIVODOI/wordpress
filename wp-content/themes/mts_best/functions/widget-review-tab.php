<?php
class nt_wp_review_tab_widget extends wp_review_tab_widget {

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'tabs' => array('toprated' => 1, 'recent' => 1, 'mostvoted' => 0, 'custom' => 0),
			'tab_order' => array('toprated' => 1, 'recent' => 2, 'mostvoted' => 3, 'custom' => 4),
			'tab_titles' => array('toprated' => __('Top Rated'), 'recent' => __('Recent'), 'mostvoted' => __('Most Voted'), 'custom' => __('Editor\'s choice')),
			'allow_pagination' => 1,
			'review_type' => 'any',
			'post_num' => '5',
			'comment_num' => '5',
			'thumb_size' => 'small',// it's here to avoid php warnings if somebody remove filter which is adding this widget
			'box_layout' => 'horizontal-small',
			'show_date' => 1,
			'custom_reviews' => ''
		));
		extract($instance);
		?>
		<div class="wp_review_tab_options_form">
		<h4><?php _e('Select Tabs', 'mts-review'); ?></h4>
		<div class="wp_review_tab_select_tabs">
			<label class="alignleft" style="display: block; width: 50%; margin-bottom: 7px;" for="<?php echo $this->get_field_id("tabs"); ?>_toprated">
				<input type="checkbox" class="checkbox wp_review_tab_enable_toprated" id="<?php echo $this->get_field_id("tabs"); ?>_toprated" name="<?php echo $this->get_field_name("tabs"); ?>[toprated]" value="1" <?php if (isset($tabs['toprated'])) { checked( 1, $tabs['toprated'], true ); } ?> />
				<?php _e( 'Top Rated', 'mts-review'); ?>
			</label>
			<label class="alignleft" style="display: block; width: 50%; margin-bottom: 7px;" for="<?php echo $this->get_field_id("tabs"); ?>_recent">
				<input type="checkbox" class="checkbox wp_review_tab_enable_recent" id="<?php echo $this->get_field_id("tabs"); ?>_recent" name="<?php echo $this->get_field_name("tabs"); ?>[recent]" value="1" <?php if (isset($tabs['recent'])) { checked( 1, $tabs['recent'], true ); } ?> />		
				<?php _e( 'Recent', 'mts-review'); ?>
			</label>
			<label class="alignleft" style="display: block; width: 50%;" for="<?php echo $this->get_field_id("tabs"); ?>_mostvoted">
				<input type="checkbox" class="checkbox wp_review_tab_enable_mostvoted" id="<?php echo $this->get_field_id("tabs"); ?>_mostvoted" name="<?php echo $this->get_field_name("tabs"); ?>[mostvoted]" value="1" <?php if (isset($tabs['mostvoted'])) { checked( 1, $tabs['mostvoted'], true ); } ?> />
				<?php _e( 'Most Voted', 'mts-review'); ?>
			</label>
			<label class="alignleft" style="display: block; width: 50%;" for="<?php echo $this->get_field_id("tabs"); ?>_custom">
				<input type="checkbox" class="checkbox wp_review_tab_enable_custom" id="<?php echo $this->get_field_id("tabs"); ?>_custom" name="<?php echo $this->get_field_name("tabs"); ?>[custom]" value="1" <?php if (isset($tabs['custom'])) { checked( 1, $tabs['custom'], true ); } ?> />
				<?php _e( 'Custom', 'mts-review'); ?>
			</label>
		</div>
		<div class="clear"></div>

		<div class="wp_review_tab_advanced_options">

		<p class="wp_review_tab_review_type">
			<label for="<?php echo $this->get_field_id('review_type'); ?>"><?php _e('Review type:', 'mts-review'); ?></label> 
			<select id="<?php echo $this->get_field_id('review_type'); ?>" name="<?php echo $this->get_field_name('review_type'); ?>" style="margin-left: 12px;">
				<option value="any" <?php selected($review_type, 'any', true); ?>><?php _e('Any', 'mts-review'); ?></option>
				<option value="star" <?php selected($review_type, 'star', true); ?>><?php _e('Star', 'mts-review'); ?></option>
				<option value="point" <?php selected($review_type, 'point', true); ?>><?php _e('Point', 'mts-review'); ?></option>
				<option value="percentage" <?php selected($review_type, 'percentage', true); ?>><?php _e('Percentage', 'mts-review'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id("allow_pagination"); ?>">	
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("allow_pagination"); ?>" name="<?php echo $this->get_field_name("allow_pagination"); ?>" value="1" <?php if (isset($allow_pagination)) { checked( 1, $allow_pagination, true ); } ?> />
				<?php _e( 'Allow pagination', 'mts-review'); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('post_num'); ?>"><?php _e('Number of reviews to show:', 'mts-review'); ?>
				<br />
				<input id="<?php echo $this->get_field_id('post_num'); ?>" name="<?php echo $this->get_field_name('post_num'); ?>" type="number" min="1" step="1" value="<?php echo $post_num; ?>" />
			</label>
		</p>

		<p class="wp_review_tab_thumbnail_size" style="display:none!important">
			<label for="<?php echo $this->get_field_id('thumb_size'); ?>"><?php _e('Thumbnail size:', 'mts-review'); ?></label> 
			<select id="<?php echo $this->get_field_id('thumb_size'); ?>" name="<?php echo $this->get_field_name('thumb_size'); ?>" style="margin-left: 12px;">
				<option value="small" <?php selected($thumb_size, 'small', true); ?>><?php _e('Small', 'mts-review'); ?></option>
				<option value="large" <?php selected($thumb_size, 'large', true); ?>><?php _e('Large', 'mts-review'); ?></option>    
			</select>
		</p>

		<p class="wp_review_tab_box_layout">
			<label for="<?php echo $this->get_field_id('box_layout'); ?>"><?php _e('Posts layout:', 'mts-review'); ?></label>
			<select id="<?php echo $this->get_field_id('box_layout'); ?>" name="<?php echo $this->get_field_name('box_layout'); ?>">
				<option value="horizontal-small" <?php selected($box_layout, 'horizontal-small', true); ?>><?php _e('Horizontal', 'mythemeshop'); ?></option>
				<option value="vertical-small" <?php selected($box_layout, 'vertical-small', true); ?>><?php _e('Vertical', 'mythemeshop'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id("show_date"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_date"); ?>" name="<?php echo $this->get_field_name("show_date"); ?>" value="1" <?php if (isset($show_date)) { checked( 1, $show_date, true ); } ?> />
				<?php _e( 'Show date', 'mts-review'); ?>
			</label>
		</p>

		<p class="wp_review_tab_custom_reviews"<?php echo (empty($tabs['custom']) ? ' style="display: none;"' : ''); ?>>
			<label for="<?php echo $this->get_field_id('custom_reviews'); ?>"><?php _e('Reviews on Custom tab:', 'mts-review'); ?>
				<br />
				<input id="<?php echo $this->get_field_id('custom_reviews'); ?>" name="<?php echo $this->get_field_name('custom_reviews'); ?>" type="text" value="<?php echo $custom_reviews; ?>" />
				<br />
				<span style="color: #999;">Add IDs, separated by commas, eg. <em>145, 168, 229</em></span>
			</label>
		</p>

		<div class="clear"></div>

		<h4><a href="#" class="wp_review_tab_titles_header"><?php _e('Tab Titles', 'mts-review'); ?></a> | <a href="#" class="wp_review_tab_order_header"><?php _e('Tab Order', 'mts-review'); ?></a></h4>

		<div class="wp_review_tab_order" style="display: none;">

			<label class="alignleft wp_review_tab_toprated_order" for="<?php echo $this->get_field_id('tab_order'); ?>_toprated" style="width: 50%;<?php echo (empty($tabs['toprated']) ? ' display: none;' : ''); ?>">
				<input id="<?php echo $this->get_field_id('tab_order'); ?>_toprated" name="<?php echo $this->get_field_name('tab_order'); ?>[toprated]" type="number" min="1" step="1" value="<?php echo $tab_order['toprated']; ?>" style="width: 48px;" />
				<?php _e('Top Rated', 'mts-review'); ?>
			</label>
			<label class="alignleft wp_review_tab_recent_order" for="<?php echo $this->get_field_id('tab_order'); ?>_recent" style="width: 50%;<?php echo (empty($tabs['recent']) ? ' display: none;' : ''); ?>">
				<input id="<?php echo $this->get_field_id('tab_order'); ?>_recent" name="<?php echo $this->get_field_name('tab_order'); ?>[recent]" type="number" min="1" step="1" value="<?php echo $tab_order['recent']; ?>" style="width: 48px;" />
				<?php _e('Recent', 'mts-review'); ?>
			</label>
			<label class="alignleft wp_review_tab_mostvoted_order" for="<?php echo $this->get_field_id('tab_order'); ?>_mostvoted" style="width: 50%;<?php echo (empty($tabs['mostvoted']) ? ' display: none;' : ''); ?>">
				<input id="<?php echo $this->get_field_id('tab_order'); ?>_mostvoted" name="<?php echo $this->get_field_name('tab_order'); ?>[mostvoted]" type="number" min="1" step="1" value="<?php echo $tab_order['mostvoted']; ?>" style="width: 48px;" />
				<?php _e('Most Voted', 'mts-review'); ?>
			</label>
			<label class="alignleft wp_review_tab_custom_order" for="<?php echo $this->get_field_id('tab_order'); ?>_custom" style="width: 50%;<?php echo (empty($tabs['custom']) ? ' display: none;' : ''); ?>">
				<input id="<?php echo $this->get_field_id('tab_order'); ?>_custom" name="<?php echo $this->get_field_name('tab_order'); ?>[custom]" type="number" min="1" step="1" value="<?php echo $tab_order['custom']; ?>" style="width: 48px;" />
				<?php _e('Custom', 'mts-review'); ?>
			</label>
		</div>
		<div class="clear" style="margin-bottom: 15px;"></div>

		<div class="wp_review_tab_titles" style="display: none;">

			<label class="alignleft wp_review_tab_toprated_title" for="<?php echo $this->get_field_id('tab_titles'); ?>_toprated" style="width: 50%;<?php echo (empty($tabs['toprated']) ? ' display: none;' : ''); ?>">
				<?php _e('Top Rated', 'mts-review'); ?>
				<input id="<?php echo $this->get_field_id('tab_titles'); ?>_toprated" name="<?php echo $this->get_field_name('tab_titles'); ?>[toprated]" type="text" value="<?php echo esc_attr($tab_titles['toprated']); ?>" style="width: 98%;" />
			</label>
			<label class="alignleft wp_review_tab_recent_title" for="<?php echo $this->get_field_id('tab_titles'); ?>_recent" style="width: 50%;<?php echo (empty($tabs['recent']) ? ' display: none;' : ''); ?>">
				<?php _e('Recent', 'mts-review'); ?>
				<input id="<?php echo $this->get_field_id('tab_titles'); ?>_recent" name="<?php echo $this->get_field_name('tab_titles'); ?>[recent]" type="text" value="<?php echo esc_attr($tab_titles['recent']); ?>" style="width: 98%;" />
			</label>
			<label class="alignleft wp_review_tab_mostvoted_title" for="<?php echo $this->get_field_id('tab_titles'); ?>_mostvoted" style="width: 50%;<?php echo (empty($tabs['mostvoted']) ? ' display: none;' : ''); ?>">
				<?php _e('Most Voted', 'mts-review'); ?>
				<input id="<?php echo $this->get_field_id('tab_titles'); ?>_mostvoted" name="<?php echo $this->get_field_name('tab_titles'); ?>[mostvoted]" type="text" value="<?php echo esc_attr($tab_titles['mostvoted']); ?>" style="width: 98%;" />			    
			</label>
			<label class="alignleft wp_review_tab_custom_title" for="<?php echo $this->get_field_id('tab_titles'); ?>_custom" style="width: 50%;<?php echo (empty($tabs['custom']) ? ' display: none;' : ''); ?>">
				<?php _e('Custom', 'mts-review'); ?>
				<input id="<?php echo $this->get_field_id('tab_titles'); ?>_custom" name="<?php echo $this->get_field_name('tab_titles'); ?>[custom]" type="text" value="<?php echo esc_attr($tab_titles['custom']); ?>" style="width: 98%;" />
			</label>
		</div>
		<div class="clear" style="margin-bottom: 15px;"></div>

		</div><!-- .wp_review_tab_advanced_options -->
		</div><!-- .wp_review_tab_options_form -->
		<?php 
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['tabs'] = $new_instance['tabs'];
		$instance['tab_order'] = $new_instance['tab_order'];
		$instance['tab_titles'] = wp_kses_post($new_instance['tab_titles']);
		$instance['review_type'] = $new_instance['review_type'];
		$instance['allow_pagination'] = $new_instance['allow_pagination'];
		$instance['post_num'] = $new_instance['post_num'];
		$instance['thumb_size'] = $new_instance['thumb_size'];// it's here to avoid php warnings if somebody remove filter which is adding this widget
		$instance['box_layout'] = $new_instance['box_layout'];
		$instance['show_date'] = $new_instance['show_date'];
		$instance['custom_reviews'] = $new_instance['custom_reviews'];
		return $instance;
	}

	function widget( $args, $instance ) {
		extract($args, EXTR_SKIP);
		extract($instance, EXTR_SKIP);
		wp_enqueue_script('wp_review_tab_widget');
		wp_enqueue_style( 'wp_review-style', trailingslashit( WP_REVIEW_ASSETS ) . 'css/wp-review.css', array(), '1.0', 'all' );
		//wp_enqueue_style('wp_review_tab_widget');
		if (empty($tabs)) $tabs = array('recent' => 1, 'toprated' => 1);
		$tabs_count = count($tabs);
		if ($tabs_count <= 1) {
			$tabs_count = 1;
		} elseif($tabs_count > 3) {
			$tabs_count = 4;
		}

		$available_tabs = array(
			'toprated' => $tab_titles['toprated'],
			'recent' => $tab_titles['recent'],
			'mostvoted' => $tab_titles['mostvoted'],
			'custom' => $tab_titles['custom']
		);

		array_multisort($tab_order, $available_tabs);

		?>	
		<?php echo $before_widget;
		// Display tab title as widget title if there is only one tab 
		if ( 1 === $tabs_count ) {
			$available_tab = array_values($available_tabs);
			$title = apply_filters( 'widget_title', $available_tab[0] );

			echo $before_title . $title . $after_title;
		}
		?>
		<div class="wp_review_tab_widget_content" id="<?php echo $widget_id; ?>_content">
			<ul class="wp-review-tabs <?php echo "has-$tabs_count-"; ?>tabs">
				<?php foreach ($available_tabs as $tab => $label) : ?>
					<?php if (!empty($tabs[$tab])): ?>
						<li class="tab_title"><a href="#" id="<?php echo $tab; ?>-tab"><?php echo $label; ?></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul> <!--end .tabs-->
			<div class="clear"></div>
			<div class="inside">
				<?php if (!empty($tabs['toprated'])): ?>
					<div id="toprated-tab-content" class="tab-content">	
					</div> <!--end #toprated-tab-content-->
				<?php endif; ?>
				<?php if (!empty($tabs['recent'])): ?>
					<div id="recent-tab-content" class="tab-content">
					</div> <!--end #recent-tab-content-->
				<?php endif; ?>
				<?php if (!empty($tabs['mostvoted'])): ?>
					<div id="mostvoted-tab-content" class="tab-content">
						<ul>
						</ul>
					</div> <!--end #mostvoted-tab-content-->
				<?php endif; ?>
				<?php if (!empty($tabs['custom'])): ?>
					<div id="custom-tab-content" class="tab-content">
						<ul>     	
						</ul>
					</div> <!--end #custom-tab-content-->
				<?php endif; ?>
				<div class="clear"></div>
			</div> <!--end .inside -->
			<div class="clear"></div>
		</div><!--end #tabber -->
		<?php
		// inline script
		// to support multiple instances per page with different settings
		
		unset($instance['tabs'], $instance['tab_order'], $instance['tab_titles']); // unset unneeded
		?>
		<script type="text/javascript">
			jQuery(function($) {
				$('#<?php echo $widget_id; ?>_content').data('args', <?php echo json_encode($instance); ?>);
			});
		</script>
		<?php echo $after_widget; ?>
		<?php
	}

	function ajax_wp_review_tab_widget_content() {
		$tab = $_POST['tab'];
		$args = $_POST['args'];
		$page = intval($_POST['page']);
		if ($page < 1)
			$page = 1;
		if (!is_array($args))
			return '';

		// sanitize args
		$post_num = (empty($args['post_num']) ? 5 : intval($args['post_num']));
		if ($post_num > 20 || $post_num < 1) { // max 20 posts
			$post_num = 5;
		}

		$box_layout = isset($args['box_layout']) ? $args['box_layout'] : 'horizontal-small';

		if ( 'horizontal-small' === $box_layout ) {
			$thumbnail     = 'smallthumb';
			$open_li_item  = '<li class="post-box horizontal-small horizontal-container"><div class="horizontal-container-inner">';
			$close_li_item = '</div></li>';
		} else {
			$thumbnail     = 'widgetfull';
			$open_li_item  = '<li class="post-box vertical-small">';
			$close_li_item = '</li>';
		}

		$custom_reviews = array();
		if (!empty($args['custom_reviews'])) {
			$custom_reviews = explode(',', $args['custom_reviews']);
			$custom_reviews = array_map('trim', $custom_reviews);
			$custom_reviews = array_map('intval', $custom_reviews);
		}

		$show_date = !empty($args['show_date']);
		$allow_pagination = !empty($args['allow_pagination']);
		$review_type = '';
		if (in_array($args['review_type'], array('star', 'point', 'percentage'))) {
			$review_type = $args['review_type'];
		}

		switch ($tab) {
			case "toprated":
				$custom_query = array(
					'ignore_sticky_posts' => 1,
					'post_type' => 'any',
					'posts_per_page' => $post_num,
					'post_status' => 'publish',
					'orderby' => 'meta_value_num',
					'meta_key' => 'wp_review_total',
					'order' => 'desc',
					'paged' => $page
				);
				// Meta Query
				$custom_query['meta_query'] = array('relation' => 'AND');
				if (!empty($review_type)) {
					$custom_query['meta_query'][] = array(
						'key' => 'wp_review_type',
						'compare' => '=',
						'value' => $review_type
					);
				} else {
					$custom_query['meta_query'][] = array(
						'key' => 'wp_review_type',
						'compare' => '!=',
						'value' => ''
					);
				}
			break;

			case "mostvoted":
				$most_voted = $this->get_most_voted();
				$custom_query = array(
					'ignore_sticky_posts' => 1,
					'post_type' => 'any',
					'posts_per_page' => $post_num,
					'post_status' => 'publish',
					'orderby' => 'post__in',
					'post__in' => $most_voted,
					'paged' => $page
				);
				// Meta Query
				$custom_query['meta_query'] = array('relation' => 'AND');
				if (!empty($review_type)) {
					$custom_query['meta_query'][] = array(
						'key' => 'wp_review_type',
						'compare' => '=',
						'value' => $review_type
					);
				} else {
					$custom_query['meta_query'][] = array(
						'key' => 'wp_review_type',
						'compare' => '!=',
						'value' => ''
					);
				}
			break;

			case "custom":
				$custom_query = array(
					'ignore_sticky_posts' => 1,
					'post_type' => 'any',
					'posts_per_page' => $post_num,
					'post_status' => 'publish',
					'orderby' => 'post__in',
					'post__in' => $custom_reviews,
					'paged' => $page
				);
			break;

			case "recent":
			default:
				$custom_query = array(
					'ignore_sticky_posts' => 1,
					'post_type' => 'any',
					'posts_per_page' => $post_num,
					'post_status' => 'publish',
					'orderby' => 'date',
					'order' => 'desc',
					'paged' => $page
				);
				// Meta Query
				$custom_query['meta_query'] = array('relation' => 'AND');
				if (!empty($review_type)) {
					$custom_query['meta_query'][] = array(
						'key' => 'wp_review_type',
						'compare' => '=',
						'value' => $review_type
					);
				} else {
					$custom_query['meta_query'][] = array(
						'key' => 'wp_review_type',
						'compare' => '!=',
						'value' => ''
					);
				}
			break;
		}

		?>
		<ul>
			<?php
			$review_query = new WP_Query($custom_query);
			$last_page = $review_query->max_num_pages;
			while ($review_query->have_posts()) : $review_query->the_post(); ?>
				<?php echo $open_li_item; ?>
						<div class="post-img">
							<a rel="nofollow" href="<?php the_permalink()?>" title="<?php the_title(); ?>">
								<?php the_post_thumbnail($thumbnail,array('title' => '')); ?>
							</a>
						</div>
						<div class="post-data">
							<div class="post-data-container">
								<div class="post-title">
									<a href="<?php the_permalink()?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
								</div>
								<div class="post-info">
									<?php if ( $show_date ) : ?>
										<span class="thetime updated"><?php the_time( get_option( 'date_format' ) ); ?></span>
									<?php endif; ?>
									<?php wp_review_show_total(true, 'review-total-only'); ?>
								</div><!--.post-info-->
							</div>
						</div>
				<?php echo $close_li_item; ?>
			<?php $post_num++; endwhile; wp_reset_query(); ?>
		</ul>
		<div class="clear"></div>
		<?php if ($allow_pagination) : ?>
			<?php $this->tab_pagination($page, $last_page); ?>
		<?php endif; ?>
		<?php
		die(); // required to return a proper result
	}

	function tab_pagination($page, $last_page) {
		?>
		<div class="wp-review-tab-pagination pagination">
			<?php if ($page > 1) : ?>
				<a href="#" class="previous"><i class="fa fa-chevron-left"></i></a>
			<?php endif; ?>
			<?php if ($page != $last_page) : ?>
				<a href="#" class="next"><i class="fa fa-chevron-right"></i></a>
			<?php endif; ?>
		</div>
		<div class="clear"></div>
		<input type="hidden" class="page_num" name="page_num" value="<?php echo $page; ?>" />
		<?php   
	}
}
?>