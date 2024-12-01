<?php
$mts_options = get_option(MTS_THEME_NAME);
if ( ! function_exists( 'mts_meta' ) ) {
    /**
     * Display necessary tags in the <head> section.
     */
	function mts_meta(){
        global $mts_options, $post;
        ?>

        <?php if ( !empty( $mts_options['mts_favicon'] ) ) { ?>
            <link rel="icon" href="<?php echo esc_url( $mts_options['mts_favicon'] ); ?>" type="image/x-icon" />
        <?php } elseif ( function_exists( 'has_site_icon' ) && has_site_icon() ) { ?>
            <?php printf( '<link rel="icon" href="%s" sizes="32x32" />', esc_url( get_site_icon_url( 32 ) ) ); ?>
            <?php sprintf( '<link rel="icon" href="%s" sizes="192x192" />', esc_url( get_site_icon_url( 192 ) ) ); ?>
        <?php } ?>

        <?php if ( !empty( $mts_options['mts_metro_icon'] ) ) { ?>
            <!-- IE10 Tile.-->
            <meta name="msapplication-TileColor" content="#FFFFFF">
            <meta name="msapplication-TileImage" content="<?php echo esc_url( $mts_options['mts_metro_icon'] ); ?>">
        <?php } elseif ( function_exists( 'has_site_icon' ) && has_site_icon( ) ) { ?>
            <?php printf( '<meta name="msapplication-TileImage" content="%s">', esc_url( get_site_icon_url( 270 ) ) ); ?>
        <?php } ?>

        <?php if ( !empty( $mts_options['mts_touch_icon'] ) ) { ?>
            <!--iOS/android/handheld specific -->
            <link rel="apple-touch-icon-precomposed" href="<?php echo esc_url( $mts_options['mts_touch_icon'] ); ?>" />
        <?php } elseif ( function_exists( 'has_site_icon' ) && has_site_icon() ) { ?>
            <?php printf( '<link rel="apple-touch-icon-precomposed" href="%s">', esc_url( get_site_icon_url( 180 ) ) ); ?>
        <?php } ?>

        <?php if ( ! empty( $mts_options['mts_responsive'] ) ) { ?>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <?php } ?>

        <?php if($mts_options['mts_prefetching'] == '1') { ?>
            <?php if (is_front_page()) { ?>
                <?php $my_query = new WP_Query('posts_per_page=1'); while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <link rel="prefetch" href="<?php the_permalink(); ?>">
                <link rel="prerender" href="<?php the_permalink(); ?>">
                <?php endwhile; wp_reset_postdata(); ?>
            <?php } elseif (is_singular()) { ?>
                <link rel="prefetch" href="<?php echo esc_url( home_url() ); ?>">
                <link rel="prerender" href="<?php echo esc_url( home_url() ); ?>">
            <?php } ?>
        <?php } ?>

        <meta itemprop="name" content="<?php bloginfo( 'name' ); ?>" />
        <meta itemprop="url" content="<?php echo esc_url( site_url() ); ?>" />

        <?php if ( is_singular() ) { ?>
            <?php $user_info = get_userdata($post->post_author); ?>
            <?php if ( $user_info && ! empty( $user_info->first_name ) && ! empty( $user_info->last_name ) ) : ?>
                <meta itemprop="creator accountablePerson" content="<?php echo $user_info->first_name.' '.$user_info->last_name; ?>" />
            <?php endif; ?>
        <?php } ?>
<?php
    }
}

if ( ! function_exists( 'mts_head' ) ){
    /**
     * Display header code from Theme Options.
     */
	function mts_head() {
	global $mts_options;
?>
<?php echo $mts_options['mts_header_code']; ?>
<?php }
}
add_action('wp_head', 'mts_head');

/*------------[ Copyrights ]-------------*/
if ( ! function_exists( 'mts_copyrights_credit' ) ) {
    function mts_copyrights_credit() { 
    global $mts_options;
?>
<!--start copyrights-->
<div id="copyright-note">
<span><a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>" rel="nofollow"><?php bloginfo('name'); ?></a> Copyright &copy; <?php echo date("Y") ?>.</span>
<div class="right"><?php echo $mts_options['mts_copyrights']; ?></div>
</div>
<!--end copyrights-->
<?php }
}


if ( ! function_exists( 'mts_footer' ) ) {
    /**
     * Display the analytics code in the footer.
     */
	function mts_footer() { 
	global $mts_options;
?>
    <?php if ($mts_options['mts_analytics_code'] != '') { ?>
    <!--start footer code-->
        <?php echo $mts_options['mts_analytics_code']; ?>
    <!--end footer code-->
    <?php }
    }
}

if (!function_exists('mts_the_breadcrumb')) {
    /**
     * Display the breadcrumbs.
     */
    function mts_the_breadcrumb() {
        echo '<div><i class="fa fa-home"></i></div> <div typeof="v:Breadcrumb" class="root"><a rel="v:url" property="v:title" href="';
        echo esc_url( home_url() );
        echo '">'.esc_html(sprintf( __( "Home", 'best' )));
        echo '</a></div><div><i class="fa fa-caret-right"></i></div>';
        if (is_single()) {
            $categories = get_the_category();
            if ( $categories ) {
                $level = 0;
                $hierarchy_arr = array();
                foreach ( $categories as $cat ) {
                    $anc = get_ancestors( $cat->term_id, 'category' );
                    $count_anc = count( $anc );
                    if (  0 < $count_anc && $level < $count_anc ) {
                        $level = $count_anc;
                        $hierarchy_arr = array_reverse( $anc );
                        array_push( $hierarchy_arr, $cat->term_id );
                    }
                }
                if ( empty( $hierarchy_arr ) ) {
                    $category = $categories[0];
                    echo '<div typeof="v:Breadcrumb"><a href="'. esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></div><div><i class="fa fa-caret-right"></i></div>';
                } else {
                    foreach ( $hierarchy_arr as $cat_id ) {
                        $category = get_term_by( 'id', $cat_id, 'category' );
                        echo '<div typeof="v:Breadcrumb"><a href="'. esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></div><div><i class="fa fa-caret-right"></i></div>';
                    }
                }
            }
            echo "<div><span>";
            the_title();
            echo "</span></div>";
        } elseif (is_page()) {
            $parent_id  = wp_get_post_parent_id( get_the_ID() );
            if ( $parent_id ) {
                $breadcrumbs = array();
                while ( $parent_id ) {
                    $page = get_page( $parent_id );
                    $breadcrumbs[] = '<div typeof="v:Breadcrumb"><a href="'.esc_url( get_permalink( $page->ID ) ).'" rel="v:url" property="v:title">'.esc_html( get_the_title($page->ID) ). '</a></div><div><i class="fa fa-caret-right"></i></div>';
                    $parent_id  = $page->post_parent;
                }
                $breadcrumbs = array_reverse( $breadcrumbs );
                foreach ( $breadcrumbs as $crumb ) { echo $crumb; }
            }
            echo "<div><span>";
            the_title();
            echo "</span></div>";
        } elseif (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $this_cat_id = $cat_obj->term_id;
            $hierarchy_arr = get_ancestors( $this_cat_id, 'category' );
            if ( $hierarchy_arr ) {
                $hierarchy_arr = array_reverse( $hierarchy_arr );
                foreach ( $hierarchy_arr as $cat_id ) {
                    $category = get_term_by( 'id', $cat_id, 'category' );
                    echo '<div typeof="v:Breadcrumb"><a href="'.esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></div><div><i class="fa fa-caret-right"></i></div>';
                }
            }
            echo "<div><span>";
            single_cat_title();
            echo "</span></div>";
        } elseif (is_author()) {
            echo "<div><span>";
            if(get_query_var('author_name')) :
                $curauth = get_user_by('slug', get_query_var('author_name'));
            else :
                $curauth = get_userdata(get_query_var('author'));
            endif;
            echo esc_html( $curauth->nickname );
            echo "</span></div>";
        } elseif (is_search()) {
            echo "<div><span>";
            the_search_query();
            echo "</span></div>";
        } elseif (is_tag()) {
            echo "<div><span>";
            single_tag_title();
            echo "</span></div>";
        }
    }
}

/**
 * Display schema-compliant the_category()
 *
 * @param string $separator
 */
function mts_the_category( $separator = ', ' ) {
    $categories = get_the_category();
    $count = count($categories);
    foreach ( $categories as $i => $category ) {
        echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . sprintf( __( "View all posts in %s", 'best' ), esc_attr( $category->name ) ) . '">' . esc_html( $category->name ).'</a>';
        if ( $i < $count - 1 )
            echo $separator;
    }
}

/**
 * Display schema-compliant the_tags()
 *
 * @param string $before
 * @param string $sep
 * @param string $after
 */
function mts_the_tags($before = '', $sep = ', ', $after = '</div>') {
    if ( empty( $before ) ) {
        $before = '<div class="tags border-bottom"><i class="fa fa-tags"></i> ';
    }

    $tags = get_the_tags();
    if (empty( $tags ) || is_wp_error( $tags ) ) {
        return;
    }
    $tag_links = array();
    foreach ($tags as $tag) {
        $link = get_tag_link($tag->term_id);
        $tag_links[] = '<a href="' . esc_url( $link ) . '" rel="tag">' . $tag->name . '</a>';
    }
    echo $before.join($sep, $tag_links).$after;
}


if (!function_exists('mts_pagination')) {
    /**
     * Display the pagination.
     *
     * @param string $pages
     * @param int $range
     */
    function mts_pagination($pages = '', $range = 3) {
        $mts_options = get_option(MTS_THEME_NAME);
        if (isset($mts_options['mts_pagenavigation_type']) && $mts_options['mts_pagenavigation_type'] == '1' ) { // numeric pagination
            the_posts_pagination( array(
                'mid_size' => 3,
                'prev_text' => __( 'Previous', 'best' ),
                'next_text' => __( 'Next', 'best' ),
            ) );
        } else { // traditional or ajax pagination
            ?>
            <div class="pagination pagination-previous-next">
            <ul>
                <li class="nav-previous"><?php next_posts_link( '<i class="fa fa-angle-left"></i> '. __( 'Previous', 'best' ) ); ?></li>
                <li class="nav-next"><?php previous_posts_link( __( 'Next', 'best' ).' <i class="fa fa-angle-right"></i>' ); ?></li>
            </ul>
            </div>
            <?php
        }
    }
}


if ( ! function_exists( 'mts_cart' ) ) {
    /**
     * Display the woo-commerce login/register link and the cart.
     */
	function mts_cart() { 
	   if (mts_is_wc_active()) {
	   global $mts_options;
?>
<div class="mts-cart">
	<?php global $woocommerce; ?>
	<span>
		<i class="fa fa-user"></i> 
		<?php if ( is_user_logged_in() ) { ?>
			<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php _e('My Account', 'best' ); ?>"><?php _e('My Account', 'best' ); ?></a>
		<?php } 
		else { ?>
			<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php _e('Login / Register', 'best' ); ?>"><?php _e('Login ', 'best' ); ?></a>
		<?php } ?>
	</span>
	<span>
		<i class="fa fa-shopping-cart"></i> <a class="cart-contents" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" title="<?php _e('View your shopping cart', 'best' ); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'best' ), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	</span>
</div>
<?php } 
    }
}

if (!function_exists('mts_related_posts')) {
    /**
     * Display the related posts.
     */
    function mts_related_posts() {
        $post_id = get_the_ID();
        $mts_options = get_option(MTS_THEME_NAME);
        //if(!empty($mts_options['mts_related_posts'])) { ?>	
    		<!-- Start Related Posts -->
    		<?php 
            $empty_taxonomy = false;
            if (empty($mts_options['mts_related_posts_taxonomy']) || $mts_options['mts_related_posts_taxonomy'] == 'tags') {
                // related posts based on tags
                $tags = get_the_tags($post_id);
                if (empty($tags)) { 
                    $empty_taxonomy = true;
                } else {
                    $tag_ids = array(); 
                    foreach($tags as $individual_tag) {
                        $tag_ids[] = $individual_tag->term_id; 
                    }
                    $args = array( 'tag__in' => $tag_ids, 
                        'post__not_in' => array($post_id),
                        'posts_per_page' => isset( $mts_options['mts_related_postsnum'] ) ? $mts_options['mts_related_postsnum'] : 3,
                        'ignore_sticky_posts' => 1, 
                        'orderby' => 'rand' 
                    );
                }
             } else {
                // related posts based on categories
                $categories = get_the_category($post_id);
                if (empty($categories)) { 
                    $empty_taxonomy = true;
                } else {
                    $category_ids = array(); 
                    foreach($categories as $individual_category) 
                        $category_ids[] = $individual_category->term_id; 
                    $args = array( 'category__in' => $category_ids, 
                        'post__not_in' => array($post_id),
                        'posts_per_page' => $mts_options['mts_related_postsnum'],  
                        'ignore_sticky_posts' => 1, 
                        'orderby' => 'rand' 
                    );
                }
             }
            if (!$empty_taxonomy) {
    		$my_query = new WP_Query( $args ); if( $my_query->have_posts() ) {
    			echo '<div class="related-posts">';
                echo '<h4>'.__('Related Posts', 'best' ).'</h4>';
                echo '<div class="clear">';
                $posts_per_row = 3;
                $j = 0;
    			while( $my_query->have_posts() ) { $my_query->the_post(); ?>
    			<article class="latestPost excerpt  <?php echo (++$j % $posts_per_row == 0) ? 'last' : ''; ?>">
					<header>
						<h2 class="title front-view-title"><a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h2>
					</header>
					<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" id="featured-thumbnail">
					    <?php echo '<div class="featured-thumbnail">'; the_post_thumbnail('best-featured',array('title' => '')); echo '</div>'; ?>
                        <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
					</a>
                </article><!--.post.excerpt-->
    			<?php } echo '</div></div>'; }} wp_reset_postdata(); ?>
    		<!-- .related-posts -->
    	<?php //}
    }
}

/*------------[ Post Meta Info ]-------------*/
if ( ! function_exists('mts_the_postinfo' ) ) {
    /**
     * Display the post info block.
     *
     * @param string $section
     */
    function mts_the_postinfo( $section = 'home' ) {
        $mts_options = get_option( MTS_THEME_NAME );
        $opt_key = 'mts_'.$section.'_headline_meta_info';
        
        if ( isset( $mts_options[ $opt_key ] ) && is_array( $mts_options[ $opt_key ] ) && array_key_exists( 'enabled', $mts_options[ $opt_key ] ) ) {
            $headline_meta_info = $mts_options[ $opt_key ]['enabled'];
        } else {
            $headline_meta_info = array();
        }
        if ( ! empty( $headline_meta_info ) ) { ?>
			<div class="post-info">
                <?php foreach( $headline_meta_info as $key => $meta ) { mts_the_postinfo_item( $key ); } ?>
                <?php if (function_exists('wp_review_show_total') && !is_singular()) wp_review_show_total(true, 'review-total-only'); ?>
			</div>
		<?php }
    }
}
if ( ! function_exists('mts_the_postinfo_item' ) ) {
    /**
     * Display information of an item.
     * @param $item
     */
    function mts_the_postinfo_item( $item ) {
        switch ( $item ) {
            case 'author':
            ?>
                <span class="theauthor"><i class="fa fa-user"></i> <span><?php the_author_posts_link(); ?></span></span>
            <?php
            break;
            case 'date':
            ?>
                <span class="thetime updated"><i class="fa fa-clock-o"></i> <span><?php the_time( get_option( 'date_format' ) ); ?></span></span>
            <?php
            break;
            case 'category':
            ?>
                <span class="thecategory"><?php mts_the_category(' ') ?></span>
            <?php
            break;
            case 'comment':
            ?>
                <span class="thecomment"><i class="fa fa-comments"></i> <a href="<?php echo esc_url( get_comments_link() ); ?>" itemprop="interactionCount"><?php comments_number('0','1','%'); ?></a></span>
            <?php
            break;
            case 'tags':
            ?>
                <span class="thetags"><?php mts_the_tags(''); ?></span>
            <?php
            break;
        }
    }
}

if (!function_exists('mts_social_buttons')) {
    /**
     * Display the social sharing buttons.
     */
    function mts_social_buttons() {
        $mts_options = get_option( MTS_THEME_NAME );
        $buttons = array();
        if ( isset( $mts_options['mts_social_buttons'] ) && is_array( $mts_options['mts_social_buttons'] ) && array_key_exists( 'enabled', $mts_options['mts_social_buttons'] ) ) {
            $buttons = $mts_options['mts_social_buttons']['enabled'];
        }
        if ( ! empty( $buttons ) ) {
        ?>
            <!-- Start Share Buttons -->
            <div class="shareit <?php echo $mts_options['mts_social_button_position']; ?>">
                <?php foreach( $buttons as $key => $button ) { mts_social_button( $key ); } ?>
            </div>
            <!-- end Share Buttons -->
        <?php
        }
    }
}
if ( ! function_exists('mts_social_button' ) ) {
    /**
     * Display network-independent sharing buttons.
     *
     * @param $button
     */
    function mts_social_button( $button ) {
        $mts_options = get_option( MTS_THEME_NAME );
        switch ( $button ) {
            case 'facebookshare':
            ?>
                <!-- Facebook Share-->
                <span class="share-item facebooksharebtn">
                    <div class="fb-share-button" data-layout="button_count"></div>
                </span>
            <?php
            break;
            case 'twitter':
            ?>
                <!-- Twitter -->
                <span class="share-item twitterbtn">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php echo esc_attr( $mts_options['mts_twitter_username'] ); ?>"><?php esc_html_e( 'Tweet', 'best' ); ?></a>
                </span>
            <?php
            break;
            case 'gplus':
            ?>
                <!-- GPlus -->
                <span class="share-item gplusbtn">
                    <g:plusone size="medium"></g:plusone>
                </span>
            <?php
            break;
            case 'facebook':
            ?>
                <!-- Facebook -->
                <span class="share-item facebookbtn">
                    <div id="fb-root"></div>
                    <div class="fb-like" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div>
                </span>
            <?php
            break;
            case 'pinterest':
            ?>
                <!-- Pinterest -->
                <span class="share-item pinbtn">
                    <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large' ); echo $thumb['0']; ?>&description=<?php the_title(); ?>" class="pin-it-button" count-layout="horizontal"><?php esc_html_e( 'Pin It', 'best' ); ?></a>
                </span>
            <?php
            break;
            case 'linkedin':
            ?>
                <!--Linkedin -->
                <span class="share-item linkedinbtn">
                    <script type="IN/Share" data-url="<?php echo esc_url( get_the_permalink() ); ?>"></script>
                </span>
            <?php
            break;
            case 'stumble':
            ?>
                <!-- Stumble -->
                <span class="share-item stumblebtn">
                    <su:badge layout="1"></su:badge>
                </span>
            <?php
            break;
        }
    }
}

if ( ! function_exists( 'mts_article_class' ) ) {
    /**
     * Custom `<article>` class name.
     */
    function mts_article_class() {
        $mts_options = get_option( MTS_THEME_NAME );
        $class = 'article';
        
        // sidebar or full width
        if ( mts_custom_sidebar() == 'mts_nosidebar' ) {
            $class = 'ss-full-width';
        }
        
        echo $class;
    }
}

if ( ! function_exists( 'mts_single_page_class' ) ) {
    /**
     * Custom `#page` class name.
     */
    function mts_single_page_class() {
        $class = '';

        if ( is_single() || is_page() ) {

            $class = 'single';

            $header_animation = mts_get_post_header_effect();
            if ( !empty( $header_animation )) $class .= ' '.$header_animation;
        }

        echo $class;
    }
}

if ( ! function_exists( 'mts_archive_post' ) ) {
    /**
     * Display a post of specific layout.
     * 
     * @param string $layout
     */
    function mts_archive_post( $layout = '' ) {

        $mts_options = get_option(MTS_THEME_NAME);

        ?>
        <header>
            <h2 class="title front-view-title"><a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h2>
            <?php mts_the_postinfo(); ?>
        </header>
        <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" class="post-image post-image-left">
            <?php echo '<div class="featured-thumbnail">'; the_post_thumbnail('best-featured',array('title' => '')); echo '</div>'; ?>
            <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'review-total-only'); ?>
        </a>
        <?php if (empty($mts_options['mts_full_posts'])) : ?>
            <div class="front-view-content">
                <?php echo mts_excerpt(29); ?>
            </div>
            <?php mts_readmore(); ?>
        <?php else : ?>
            <div class="front-view-content full-post">
                <?php the_content(); ?>
            </div>
            <?php if (mts_post_has_moretag()) : ?>
                <?php mts_readmore(); ?>
            <?php endif; ?>
        <?php endif;
    }
}


/*------------[ Homepage articles  ]-------------*/
function best_the_homepage_article( $layout, $j, $v_posts_num = 0, $latest = false ) {

    global $mts_options;

    $extra_article_class = ( $latest ) ? ' latest-post' : '';// needed for ajax load more

    switch ( $layout ) {
        case 'vertical':
        case 'mixed':

        $fc_mixed_type_class = '';
        // Other defaults
        $fc_post_loop_thumb  = ('vertical' == $layout) ? 'best-featured' : 'best-featured';

        $fc_show_author = true;
        $fc_show_excerpt = true;
        $fc_begin_extra_wrappers = '';
        $fc_end_extra_wrappers ='';
        $fc_clear_class = '';

        if ( $layout === 'mixed' ) {

            $fc_mixed_loop_params = best_mixed_layout_params( $v_posts_num, 2, $j );// see functions.php

            $fc_clear_class          = $fc_mixed_loop_params['clear_class'];
            $fc_mixed_type_class     = 'vertical-small';
            $fc_show_excerpt         = $fc_mixed_loop_params['show_excerpt'];
            $fc_show_author          = $fc_mixed_loop_params['show_author'];
            $fc_begin_extra_wrappers = $fc_mixed_loop_params['open_wrappers'];
            $fc_end_extra_wrappers   = $fc_mixed_loop_params['close_wrappers'];
        }
    ?>
        <article class="test latestPost<?php echo $extra_article_class;?> post-box <?php echo $layout;?> <?php echo $fc_mixed_type_class;?> <?php echo $fc_clear_class;?>">
            <?php echo $fc_begin_extra_wrappers; ?>
            <div class="post-img">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="nofollow">
                    <?php the_post_thumbnail( $fc_post_loop_thumb, array('title' => '') ); ?>
                </a>
            </div>
            <div class="post-data">
                <div class="post-data-container">
                    <header>
                        <h2 class="title post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                        <?php mts_the_postinfo(); ?>
                    </header>
                    <?php if ('vertical' == $layout) : ?>
                        <div class="post-excerpt">
                            <?php echo mts_excerpt(35); ?>
                        </div>
                        <?php mts_readmore(); ?>
                    <?php else: ?>
                        <div class="post-excerpt">
                            <?php echo mts_excerpt(16); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php echo $fc_end_extra_wrappers; ?>
        </article><!--.post-box-->
    <?php break;
    }
}