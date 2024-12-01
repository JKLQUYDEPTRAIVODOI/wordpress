<?php
/*-----------------------------------------------------------------------------------

	Plugin Name: MyThemeShop Tabs Widget v2
	Description: Display popular posts, recent posts, comments and tags in tabbed format
	Version: 1.0

-----------------------------------------------------------------------------------*/
class best_tabs_widget extends wpt_widget {

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'tabs' => array('recent' => 1, 'popular' => 1, 'comments' => 0, 'tags' => 0), 'tab_order' => array('popular' => 1, 'recent' => 2, 'comments' => 3, 'tags' => 4), 'allow_pagination' => 1, 'post_num' => '5', 'comment_num' => '5', 'show_thumb' => 1, 'thumb_size' => 'small', 'box_layout' => 'horizontal-small','show_date' => 1, 'show_excerpt' => 0, 'excerpt_length' => 10, 'show_comment_num' => 0, 'show_avatar' => 1) );
		extract($instance);
		?>
        <div class="wpt_options_form">
        
        <h4><?php _e('Select Tabs', 'mts_wpt'); ?></h4>
        
		<div class="wpt_select_tabs">
			<label class="alignleft" style="display: block; width: 50%; margin-bottom: 5px" for="<?php echo $this->get_field_id("tabs"); ?>_popular">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("tabs"); ?>_popular" name="<?php echo $this->get_field_name("tabs"); ?>[popular]" value="1" <?php if (isset($tabs['popular'])) { checked( 1, $tabs['popular'], true ); } ?> />
				<?php _e( 'Popular Tab', 'mts_wpt'); ?>
			</label>
			<label class="alignleft" style="display: block; width: 50%; margin-bottom: 5px;" for="<?php echo $this->get_field_id("tabs"); ?>_recent">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("tabs"); ?>_recent" name="<?php echo $this->get_field_name("tabs"); ?>[recent]" value="1" <?php if (isset($tabs['recent'])) { checked( 1, $tabs['recent'], true ); } ?> />		
				<?php _e( 'Recent Tab', 'mts_wpt'); ?>
			</label>
			<label class="alignleft" style="display: block; width: 50%;" for="<?php echo $this->get_field_id("tabs"); ?>_comments">
				<input type="checkbox" class="checkbox wpt_enable_comments" id="<?php echo $this->get_field_id("tabs"); ?>_comments" name="<?php echo $this->get_field_name("tabs"); ?>[comments]" value="1" <?php if (isset($tabs['comments'])) { checked( 1, $tabs['comments'], true ); } ?> />
				<?php _e( 'Comments Tab', 'mts_wpt'); ?>
			</label>
			<label class="alignleft" style="display: block; width: 50%;" for="<?php echo $this->get_field_id("tabs"); ?>_tags">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("tabs"); ?>_tags" name="<?php echo $this->get_field_name("tabs"); ?>[tags]" value="1" <?php if (isset($tabs['tags'])) { checked( 1, $tabs['tags'], true ); } ?> />
				<?php _e( 'Tags Tab', 'mts_wpt'); ?>
			</label>
		</div>
        <div class="clear"></div>
        
        <h4 class="wpt_tab_order_header"><a href="#"><?php _e('Tab Order', 'mts_wpt'); ?></a></h4>
        
        <div class="wpt_tab_order" style="display: none;">
            
            <label class="alignleft" for="<?php echo $this->get_field_id('tab_order'); ?>_popular" style="width: 50%;">
				<input id="<?php echo $this->get_field_id('tab_order'); ?>_popular" name="<?php echo $this->get_field_name('tab_order'); ?>[popular]" type="number" min="1" step="1" value="<?php echo $tab_order['popular']; ?>" style="width: 48px;" />
                <?php _e('Popular', 'mts_wpt'); ?>
            </label>
            <label class="alignleft" for="<?php echo $this->get_field_id('tab_order'); ?>_recent" style="width: 50%;">
				<input id="<?php echo $this->get_field_id('tab_order'); ?>_recent" name="<?php echo $this->get_field_name('tab_order'); ?>[recent]" type="number" min="1" step="1" value="<?php echo $tab_order['recent']; ?>" style="width: 48px;" />
                <?php _e('Recent', 'mts_wpt'); ?>
            </label>
            <label class="alignleft" for="<?php echo $this->get_field_id('tab_order'); ?>_comments" style="width: 50%;">
				<input id="<?php echo $this->get_field_id('tab_order'); ?>_comments" name="<?php echo $this->get_field_name('tab_order'); ?>[comments]" type="number" min="1" step="1" value="<?php echo $tab_order['comments']; ?>" style="width: 48px;" />
			    <?php _e('Comments', 'mts_wpt'); ?>
            </label>
            <label class="alignleft" for="<?php echo $this->get_field_id('tab_order'); ?>_tags" style="width: 50%;">
				<input id="<?php echo $this->get_field_id('tab_order'); ?>_tags" name="<?php echo $this->get_field_name('tab_order'); ?>[tags]" type="number" min="1" step="1" value="<?php echo $tab_order['tags']; ?>" style="width: 48px;" />
			    <?php _e('Tags', 'mts_wpt'); ?>
            </label>
        </div>
		<div class="clear"></div>
        
        <h4 class="wpt_advanced_options_header"><a href="#"><?php _e('Advanced Options', 'mts_wpt'); ?></a></h4>
        
        <div class="wpt_advanced_options" style="display: none;">
        <p>
			<label for="<?php echo $this->get_field_id("allow_pagination"); ?>">				
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("allow_pagination"); ?>" name="<?php echo $this->get_field_name("allow_pagination"); ?>" value="1" <?php if (isset($allow_pagination)) { checked( 1, $allow_pagination, true ); } ?> />
				<?php _e( 'Allow pagination', 'mts_wpt'); ?>
			</label>
		</p>
		
		<div class="wpt_post_options">

        <p>
			<label for="<?php echo $this->get_field_id('post_num'); ?>"><?php _e('Number of posts to show:', 'mts_wpt'); ?>
				<br />
				<input id="<?php echo $this->get_field_id('post_num'); ?>" name="<?php echo $this->get_field_name('post_num'); ?>" type="number" min="1" step="1" value="<?php echo $post_num; ?>" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("show_thumb"); ?>">
				<input type="checkbox" class="checkbox wpt_show_thumbnails" id="<?php echo $this->get_field_id("show_thumb"); ?>" name="<?php echo $this->get_field_name("show_thumb"); ?>" value="1" <?php if (isset($show_thumb)) { checked( 1, $show_thumb, true ); } ?> />
				<?php _e( 'Show post thumbnails', 'mts_wpt'); ?>
			</label>
		</p>   
		
		<p class="wpt_thumbnail_size" style="display: none!important;">
			<label for="<?php echo $this->get_field_id('thumb_size'); ?>"><?php _e('Thumbnail size:', 'mts_wpt'); ?></label> 
			<select id="<?php echo $this->get_field_id('thumb_size'); ?>" name="<?php echo $this->get_field_name('thumb_size'); ?>" style="margin-left: 12px;">
				<option value="small" <?php selected($thumb_size, 'small', true); ?>><?php _e('Small', 'mts_wpt'); ?></option>
				<option value="large" <?php selected($thumb_size, 'large', true); ?>><?php _e('Large', 'mts_wpt'); ?></option>    
			</select>       
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('box_layout'); ?>"><?php _e('Posts layout:', 'mts-review'); ?></label>
			<select id="<?php echo $this->get_field_id('box_layout'); ?>" name="<?php echo $this->get_field_name('box_layout'); ?>">
				<option value="horizontal-small" <?php selected($box_layout, 'horizontal-small', true); ?>><?php _e('Horizontal', 'mythemeshop'); ?></option>
				<option value="vertical-small" <?php selected($box_layout, 'vertical-small', true); ?>><?php _e('Vertical', 'mythemeshop'); ?></option>
			</select>
		</p>
		
		<p>			
			<label for="<?php echo $this->get_field_id("show_date"); ?>">	
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_date"); ?>" name="<?php echo $this->get_field_name("show_date"); ?>" value="1" <?php if (isset($show_date)) { checked( 1, $show_date, true ); } ?> />	
				<?php _e( 'Show post date', 'mts_wpt'); ?>	
			</label>	
		</p>
        
		<p>		
			<label for="<?php echo $this->get_field_id("show_comment_num"); ?>">		
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_comment_num"); ?>" name="<?php echo $this->get_field_name("show_comment_num"); ?>" value="1" <?php if (isset($show_comment_num)) { checked( 1, $show_comment_num, true ); } ?> />	
				<?php _e( 'Show number of comments', 'mts_wpt'); ?>		
			</label>	
		</p>    
		
		<p>			
			<label for="<?php echo $this->get_field_id("show_excerpt"); ?>">	
				<input type="checkbox" class="checkbox wpt_show_excerpt" id="<?php echo $this->get_field_id("show_excerpt"); ?>" name="<?php echo $this->get_field_name("show_excerpt"); ?>" value="1" <?php if (isset($show_excerpt)) { checked( 1, $show_excerpt, true ); } ?> />
				<?php _e( 'Show post excerpt', 'mts_wpt'); ?>
			</label>		
		</p>
		
		<p class="wpt_excerpt_length"<?php echo (empty($show_excerpt) ? ' style="display: none;"' : ''); ?>>
			<label for="<?php echo $this->get_field_id('excerpt_length'); ?>">
				<?php _e('Excerpt length (words):', 'mts_wpt'); ?>   
				<br />
				<input type="number" min="1" step="1" id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" value="<?php echo $excerpt_length; ?>" />
			</label>
		</p>	
		  
		</div>
        <div class="clear"></div>
        
        <div class="wpt_comment_options"<?php echo (empty($tabs['comments']) ? ' style="display: none;"' : ''); ?>>
		
        <p>
			<label for="<?php echo $this->get_field_id('comment_num'); ?>">
				<?php _e('Number of comments on Comments Tab:', 'mts_wpt'); ?>
				<br />
				<input type="number" min="1" step="1" id="<?php echo $this->get_field_id('comment_num'); ?>" name="<?php echo $this->get_field_name('comment_num'); ?>" value="<?php echo $comment_num; ?>" />
			</label>			
		</p>      
		
		<p>			
			<label for="<?php echo $this->get_field_id("show_avatar"); ?>">			
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_avatar"); ?>" name="<?php echo $this->get_field_name("show_avatar"); ?>" value="1" <?php if (isset($show_avatar)) { checked( 1, $show_avatar, true ); } ?> />
				<?php _e( 'Show avatars on Comments Tab', 'mts_wpt'); ?>	
			</label>	
		</p>
        </div><!-- .wpt_comment_options -->
        </div><!-- .wpt_advanced_options -->
		</div><!-- .wpt_options_form -->
		<?php 
	}

	function update( $new_instance, $old_instance ) {	
		$instance = $old_instance;    
		$instance['tabs'] = $new_instance['tabs'];  
        $instance['tab_order'] = $new_instance['tab_order'];  
		$instance['allow_pagination'] = $new_instance['allow_pagination'];	
		$instance['post_num'] = $new_instance['post_num'];	
		$instance['comment_num'] =  $new_instance['comment_num'];		
		$instance['show_thumb'] = $new_instance['show_thumb'];     
		$instance['thumb_size'] = $new_instance['thumb_size'];
		$instance['box_layout'] = $new_instance['box_layout'];		
		$instance['show_date'] = $new_instance['show_date'];    
		$instance['show_excerpt'] = $new_instance['show_excerpt'];  
		$instance['excerpt_length'] = $new_instance['excerpt_length'];	
		$instance['show_comment_num'] = $new_instance['show_comment_num'];  
		$instance['show_avatar'] = $new_instance['show_avatar'];	
		return $instance;	
	}

	function widget( $args, $instance ) {	
		extract($args);     
		extract($instance);    
		wp_enqueue_script('wpt_widget'); 
		//wp_enqueue_style('wpt_widget');  
		if (empty($tabs)) $tabs = array('recent' => 1, 'popular' => 1);    
		$tabs_count = count($tabs);     
		if ($tabs_count <= 1) {       
			$tabs_count = 1;       
		} elseif($tabs_count > 3) {   
			$tabs_count = 4;      
		}
        
        $available_tabs = array('popular' => __('Popular', 'mts_wpt'), 
            'recent' => __('Recent', 'mts_wpt'), 
            'comments' => __('Comments', 'mts_wpt'), 
            'tags' => __('Tags', 'mts_wpt'));
            
        array_multisort($tab_order, $available_tabs);
        
		?>	
		<?php echo $before_widget;
		if ( 1 === $tabs_count ) {
			$available_tab = array_values($available_tabs);
			$title = apply_filters( 'widget_title', $available_tab[0] );

			echo $before_title . $title . $after_title;
		}
		?>	
		<div class="wpt_widget_content" id="<?php echo $widget_id; ?>_content">		
			<ul class="wpt-tabs <?php echo "has-$tabs_count-"; ?>tabs">
                <?php foreach ($available_tabs as $tab => $label) { ?>
                    <?php if (!empty($tabs[$tab])): ?>
                        <li class="tab_title"><a href="#" id="<?php echo $tab; ?>-tab"><?php echo $label; ?></a></li>	
                    <?php endif; ?>
                <?php } ?> 
			</ul> <!--end .tabs-->	
			<div class="clear"></div>  
			<div class="inside">        
				<?php if (!empty($tabs['popular'])): ?>	
					<div id="popular-tab-content" class="tab-content">				
					</div> <!--end #popular-tab-content-->       
				<?php endif; ?>       
				<?php if (!empty($tabs['recent'])): ?>	
					<div id="recent-tab-content" class="tab-content"> 		 
					</div> <!--end #recent-tab-content-->		
				<?php endif; ?>                     
				<?php if (!empty($tabs['comments'])): ?>      
					<div id="comments-tab-content" class="tab-content"> 	
						<ul>                    		
						</ul>		
					</div> <!--end #comments-tab-content-->     
				<?php endif; ?>            
				<?php if (!empty($tabs['tags'])): ?>       
					<div id="tags-tab-content" class="tab-content"> 	
						<ul>                    	
						</ul>			 
					</div> <!--end #tags-tab-content-->  
				<?php endif; ?>	
				<div class="clear"></div>	
			</div> <!--end .inside -->	
			<div class="clear"></div>
		</div><!--end #tabber -->    
		<?php    
		// inline script 
		// to support multiple instances per page with different settings   
		
		unset($instance['tabs'], $instance['tab_order']); // unset unneeded  
		?>  
		<script type="text/javascript">  
			jQuery(function($) {    
				$('#<?php echo $widget_id; ?>_content').data('args', <?php echo json_encode($instance); ?>);  
			});  
		</script>  
		<?php echo $after_widget; ?>
		<?php 
	}

	function ajax_wpt_widget_content() {     
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
		$comment_num = (empty($args['comment_num']) ? 5 : intval($args['comment_num']));   
		if ($comment_num > 20 || $comment_num < 1) {  
			$comment_num = 5;    
		}       
		$show_thumb = !empty($args['show_thumb']);
		$thumb_size = $args['thumb_size'];
        if ($thumb_size != 'small' && $thumb_size != 'large') {
            $thumb_size = 'small'; // default
        }
		$show_date = !empty($args['show_date']);     
		$show_excerpt = !empty($args['show_excerpt']);  
		$excerpt_length = intval($args['excerpt_length']);
        if ($excerpt_length > 50 || $excerpt_length < 1) {  
			$excerpt_length = 10;   
		}   
		$show_comment_num = !empty($args['show_comment_num']);  
		$show_avatar = !empty($args['show_avatar']);   
		$allow_pagination = !empty($args['allow_pagination']);

		$box_layout = isset($args['box_layout']) ? $args['box_layout'] : 'horizontal-small';

		$no_image = ( $show_thumb ) ? '' : ' no-thumb';

		if ( 'horizontal-small' === $box_layout ) {
			$thumbnail     = 'smallthumb';
			$open_li_item  = '<li class="post-box horizontal-small horizontal-container'.$no_image.'"><div class="horizontal-container-inner">';
			$close_li_item = '</div></li>';
		} else {
			$thumbnail     = 'widgetfull';
			$open_li_item  = '<li class="post-box vertical-small'.$no_image.'">';
			$close_li_item = '</li>';
		}
        
		/* ---------- Tab Contents ---------- */    
		switch ($tab) {        
		  
			/* ---------- Popular Posts ---------- */   
			case "popular":      
				?>       
				<ul>				
					<?php 
					$popular = new WP_Query( array('ignore_sticky_posts' => 1, 'posts_per_page' => $post_num, 'post_status' => 'publish', 'orderby' => 'comment_count', 'order' => 'desc', 'paged' => $page));         
					$last_page = $popular->max_num_pages;      
					while ($popular->have_posts()) : $popular->the_post(); ?>
						<?php echo $open_li_item; ?>
						<?php if ( $show_thumb == 1 ) : ?>
						<div class="post-img">
							<a rel="nofollow" href="<?php the_permalink()?>" title="<?php the_title(); ?>">
								<?php the_post_thumbnail($thumbnail,array('title' => '')); ?>
							</a>
						</div>
						<?php endif; ?>
						<div class="post-data">
							<div class="post-data-container">
								<div class="post-title">
									<a href="<?php the_permalink()?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
								</div>
								<?php if ( $show_date == 1 || $show_comment_num == 1) : ?>
								<div class="post-info">
									<?php if ( $show_date == 1 ) : ?>
										<span class="thetime updated"><?php the_time( get_option( 'date_format' ) ); ?></span>
									<?php endif; ?>
									<?php if ( $show_comment_num == 1 ) : ?>
										<span class="thecomment"><i class="fa fa-comments"></i> <a rel="nofollow" href="<?php comments_link(); ?>"><?php echo comments_number('0','1','%');?></a></span>
									<?php endif; ?>
								</div><!--.post-info-->
								<?php endif; ?>
								<?php if ( $show_excerpt == 1 ) : ?>	
	                                <div class="post-excerpt">
	                                    <p><?php echo $this->excerpt($excerpt_length); ?></p>
	                                </div>
	                            <?php endif; ?>
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
			break;              
            
			/* ---------- Recent Posts ---------- */      
			case "recent":           
				?>         
				<ul>			
					<?php              
					$recent = new WP_Query('posts_per_page='. $post_num .'&orderby=post_date&order=desc&post_status=publish&paged='. $page);       
					$last_page = $recent->max_num_pages;      
					while ($recent->have_posts()) : $recent->the_post();    
						?>						         
						<?php echo $open_li_item; ?>
						<?php if ( $show_thumb == 1 ) : ?>
						<div class="post-img">
							<a rel="nofollow" href="<?php the_permalink()?>" title="<?php the_title(); ?>">
								<?php the_post_thumbnail($thumbnail,array('title' => '')); ?>
							</a>
						</div>
						<?php endif; ?>
						<div class="post-data">
							<div class="post-data-container">
								<div class="post-title">
									<a href="<?php the_permalink()?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
								</div>
								<?php if ( $show_date == 1 || $show_comment_num == 1) : ?>
								<div class="post-info">
									<?php if ( $show_date == 1 ) : ?>
										<span class="thetime updated"><?php the_time( get_option( 'date_format' ) ); ?></span>
									<?php endif; ?>
									<?php if ( $show_comment_num == 1 ) : ?>
										<span class="thecomment"><i class="fa fa-comments"></i> <a rel="nofollow" href="<?php comments_link(); ?>"><?php echo comments_number('0','1','%');?></a></span>
									<?php endif; ?>
								</div><!--.post-info-->
								<?php endif; ?>
								<?php if ( $show_excerpt == 1 ) : ?>	
	                                <div class="post-excerpt">
	                                    <p><?php echo $this->excerpt($excerpt_length); ?></p>
	                                </div>
	                            <?php endif; ?>
	                        </div>
						</div>
						<?php echo $close_li_item; ?>
					<?php endwhile; wp_reset_query(); ?>		
				</ul>
                <div class="clear"></div>
				<?php if ($allow_pagination) : ?>       
					<?php $this->tab_pagination($page, $last_page); ?>    
				<?php endif; ?>                 
				<?php       
			break;     
            
			/* ---------- Latest Comments ---------- */        
			case "comments":
				?>
				<ul>
					<?php
					$no_comments = false;
					$avatar_size = 115;
					$comment_length = $show_avatar ? 38 : 76; // max length for comments
					$comments_total = new WP_Comment_Query();
					$comments_total_number = $comments_total->query(array('count' => 1));
					$last_page = ceil($comments_total_number / $comment_num);
					$comments_query = new WP_Comment_Query();
					$offset = ($page-1) * $comment_num;
					$comments = $comments_query->query( array( 'number' => $comment_num, 'offset' => $offset ) );
					if ( $comments ) : foreach ( $comments as $comment ) : ?>
						<li>
							<a href="<?php echo get_comment_link($comment->comment_ID); ?>">
								<?php if ($show_avatar) : ?>
								<div class="wpt_avatar">
									<?php echo get_avatar( $comment->comment_author_email, $avatar_size ); ?>
								</div>
								<?php endif; ?>
								<div class="wpt_comment_data<?php if (!$show_avatar) echo ' no-avatar'?>">
									<div class="wpt_comment_content">
										<?php echo $this->truncate(strip_tags(apply_filters( 'get_comment_text', $comment->comment_content )), $comment_length);?>
									</div>
									<div class="wpt_comment_meta">
										<?php echo human_time_diff( mysql2date('U', $comment->comment_date, true ), current_time('timestamp') ) . __(' ago', 'mythemeshop'); ?>
									</div>
								</div>
							</a>
						</li>
					<?php endforeach; else : ?>
						<li>
							<div class="no-comments"><?php _e('No comments yet.', 'mts_wpt'); ?></div>
						</li>
						<?php $no_comments = true;
					endif; ?>
				</ul>
				<?php if ($allow_pagination && !$no_comments) : ?>
					<?php $this->tab_pagination($page, $last_page); ?>
				<?php endif; ?>
				<?php
			break;

			/* ---------- Tags ---------- */   
			case "tags":        
				?>           
				<ul>         
					<?php        
					$tags = get_tags(array('get'=>'all'));             
					if($tags) {               
						foreach ($tags as $tag): ?>    
							<li><a href="<?php echo get_term_link($tag); ?>"><?php echo $tag->name; ?></a></li>           
							<?php            
						endforeach;       
					} else {          
						_e('No tags created.', 'mts_wpt');           
					}            
					?>           
				</ul>            
				<?php            
			break;            
		}              
		die(); // required to return a proper result  
	}

	function tab_pagination( $page, $last_page ) {
		?>
		<div class="wpt-pagination pagination">
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