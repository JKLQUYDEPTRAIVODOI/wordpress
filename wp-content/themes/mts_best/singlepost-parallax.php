<?php /* 
* Parallx post template
*/ ?>
<?php get_header(); ?>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<div id="page" class="single paralax">
    <?php if (mts_get_thumbnail_url()) : ?>
        <div id="parallax" <?php echo 'style="background-image: url('.mts_get_thumbnail_url().');"'; ?>></div>
    <?php endif; ?>
    <article class="article" itemscope itemtype="http://schema.org/BlogPosting">
        <div id="content_box" >
            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
                    <div class="single_post">
                        <?php if ($mts_options['mts_breadcrumb'] == '1') { ?>
                            <div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#"><?php mts_the_breadcrumb(); ?></div>
                        <?php } ?>
                        <header>
                            <h1 class="title single-title entry-title" itemprop="headline"><?php the_title(); ?></h1>
                            <?php if($mts_options['mts_single_headline_meta'] == '1') { ?>
                                <div class="post-info">
                                    <?php if(isset($mts_options['mts_single_headline_meta_info']['category']) == '1' ) { ?>
                                        <span class="thecategory"><?php mts_the_category(' ') ?></span>
                                    <?php } ?>
                                    <?php if(isset($mts_options['mts_single_headline_meta_info']['date']) == '1') { ?>
                                        <span class="thetime updated" itemprop="datePublished"><?php the_time( get_option( 'date_format' ) ); ?></span>
                                    <?php } ?>
                                    <?php if(isset($mts_options['mts_single_headline_meta_info']['comment']) == '1') { ?>
                                        <span class="thecomment"><i class="fa fa-comments"></i> <a rel="nofollow" href="<?php comments_link(); ?>"><?php echo comments_number();?></a></span>
                                    <?php } ?>
                                    <?php if(isset($mts_options['mts_single_headline_meta_info']['author']) == '1') { ?>
                                        <span class="theauthor"><i class="fa fa-user"></i> <span itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php the_author_posts_link(); ?></span></span></span>
                                    <?php } ?>
                                    <?php if(isset($mts_options['mts_single_headline_meta_info']['tags']) == '1' && has_tag() ) { ?>
                                        <span class="thetags"><i class="fa fa-tags"></i> <?php mts_the_tags(''); ?></span>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <?php if($mts_options['mts_social_buttons'] == '1' && $mts_options['mts_social_button_position'] == '1') { ?>
                                <!-- Start Share Buttons -->
                                <div class="shareit top">
                                    <?php if($mts_options['mts_twitter'] == '1') { ?>
                                        <!-- Twitter -->
                                        <span class="share-item twitterbtn">
                                            <a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php echo $mts_options['mts_twitter_username']; ?>">Tweet</a>
                                        </span>
                                    <?php } ?>
                                    <?php if($mts_options['mts_gplus'] == '1') { ?>
                                        <!-- GPlus -->
                                        <span class="share-item gplusbtn">
                                            <g:plusone size="medium"></g:plusone>
                                        </span>
                                    <?php } ?>
                                    <?php if($mts_options['mts_facebook'] == '1') { ?>
                                        <!-- Facebook -->
                                        <span class="share-item facebookbtn">
                                            <div id="fb-root"></div>
                                            <div class="fb-like" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div>
                                        </span>
                                    <?php } ?>
                                    <?php if($mts_options['mts_linkedin'] == '1') { ?>
                                        <!--Linkedin -->
                                        <span class="share-item linkedinbtn">
                                            <script type="IN/Share" data-url="<?php get_permalink(); ?>"></script>
                                        </span>
                                    <?php } ?>
                                    <?php if($mts_options['mts_stumble'] == '1') { ?>
                                        <!-- Stumble -->
                                        <span class="share-item stumblebtn">
                                            <su:badge layout="1"></su:badge>
                                        </span>
                                    <?php } ?>
                                    <?php if($mts_options['mts_pinterest'] == '1') { ?>
                                        <!-- Pinterest -->
                                        <span class="share-item pinbtn">
                                            <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); echo $thumb['0']; ?>&description=<?php the_title(); ?>" class="pin-it-button" count-layout="horizontal">Pin It</a>
                                        </span>
                                    <?php } ?>
                                </div>
                                <!-- end Share Buttons -->
                            <?php } ?>
                        </header><!--.headline_area-->
                        <div class="post-single-content box mark-links entry-content">
                            <?php if($mts_options['mts_single_post_layout'] == 'rclayout' || $mts_options['mts_single_post_layout'] == 'crlayout') {  echo '<div class="post-single-content-inner">';}?>
                            <?php if ($mts_options['mts_posttop_adcode'] != '') { ?>
                                <?php $toptime = $mts_options['mts_posttop_adcode_time']; if (strcmp( date("Y-m-d", strtotime( "-$toptime day")), get_the_time("Y-m-d") ) >= 0) { ?>
                                    <div class="topad">
                                        <?php echo do_shortcode($mts_options['mts_posttop_adcode']); ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <?php the_content(); ?>
                            <?php wp_link_pages(array('before' => '<div class="pagination">', 'after' => '</div>', 'link_before'  => '<span class="current"><span class="currenttext">', 'link_after' => '</span></span>', 'next_or_number' => 'next_and_number', 'nextpagelink' => __('Next','mythemeshop'), 'previouspagelink' => __('Previous','mythemeshop'), 'pagelink' => '%','echo' => 1 )); ?>
                            <?php if ($mts_options['mts_postend_adcode'] != '') { ?>
                                <?php $endtime = $mts_options['mts_postend_adcode_time']; if (strcmp( date("Y-m-d", strtotime( "-$endtime day")), get_the_time("Y-m-d") ) >= 0) { ?>
                                    <div class="bottomad">
                                        <?php echo do_shortcode($mts_options['mts_postend_adcode']); ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>

                            <?php if($mts_options['mts_social_buttons'] == '1' && $mts_options['mts_social_button_position'] != '1') { ?>
                                <!-- Start Share Buttons -->
                                <div class="shareit">
                                    <?php if($mts_options['mts_twitter'] == '1') { ?>
                                        <!-- Twitter -->
                                        <span class="share-item twitterbtn">
                                            <a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php echo $mts_options['mts_twitter_username']; ?>">Tweet</a>
                                        </span>
                                    <?php } ?>
                                    <?php if($mts_options['mts_gplus'] == '1') { ?>
                                        <!-- GPlus -->
                                        <span class="share-item gplusbtn">
                                            <g:plusone size="medium"></g:plusone>
                                        </span>
                                    <?php } ?>
                                    <?php if($mts_options['mts_facebook'] == '1') { ?>
                                        <!-- Facebook -->
                                        <span class="share-item facebookbtn">
                                            <div id="fb-root"></div>
                                            <div class="fb-like" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div>
                                        </span>
                                    <?php } ?>
                                    <?php if($mts_options['mts_linkedin'] == '1') { ?>
                                        <!--Linkedin -->
                                        <span class="share-item linkedinbtn">
                                            <script type="IN/Share" data-url="<?php get_permalink(); ?>"></script>
                                        </span>
                                    <?php } ?>
                                    <?php if($mts_options['mts_stumble'] == '1') { ?>
                                        <!-- Stumble -->
                                        <span class="share-item stumblebtn">
                                            <su:badge layout="1"></su:badge>
                                        </span>
                                    <?php } ?>
                                    <?php if($mts_options['mts_pinterest'] == '1') { ?>
                                        <!-- Pinterest -->
                                        <span class="share-item pinbtn">
                                            <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); echo $thumb['0']; ?>&description=<?php the_title(); ?>" class="pin-it-button" count-layout="horizontal">Pin It</a>
                                        </span>
                                    <?php } ?>
                                </div>
                                <!-- end Share Buttons -->
                            <?php } ?>
                            <?php if($mts_options['mts_single_post_layout'] == 'rclayout' || $mts_options['mts_single_post_layout'] == 'crlayout') { ?>
                                </div>
                                <div class="singleleft <?php echo $mts_options['mts_single_post_layout']; ?>">  
                                    <!-- Start Related Posts -->
                                    <?php $categories = get_the_category($post->ID); if ($categories) { $category_ids = array(); foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id; $args=array( 'category__in' => $category_ids, 'post__not_in' => array($post->ID), 'showposts'=>4, 'ignore_sticky_posts' => 1, 'orderby' => 'rand' );
                                    $my_query = new wp_query( $args ); if( $my_query->have_posts() ) {
                                        echo '<div class="related-posts"><div class="postauthor-top"><h3>'.__('Related Posts','mythemeshop').'</h3></div><ul>';
                                        $counter = '0'; while( $my_query->have_posts() ) { ++$counter; if($counter == 4) { $postclass = 'last'; $counter = 0; } else { $postclass = ''; } $my_query->the_post(); $li = 1; ?>
                                        <li class="<?php echo $postclass; ?> relatepostli<?php echo $li+$counter; ?>">
                                            <a rel="nofollow" class="relatedthumb" href="<?php the_permalink()?>" title="<?php the_title(); ?>">
                                                <span class="rthumb">
                                                    <?php the_post_thumbnail('smallthumb', 'title='); ?>
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
                    <?php if($mts_options['mts_single_post_layout'] == 'cbrlayout') { ?>
                        <!-- Start Related Posts -->
                        <?php $categories = get_the_category($post->ID); if ($categories) { $category_ids = array(); foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id; $args=array( 'category__in' => $category_ids, 'post__not_in' => array($post->ID), 'showposts'=>4, 'ignore_sticky_posts' => 1, 'orderby' => 'rand' );
                        $my_query = new WP_Query( $args ); if( $my_query->have_posts() ) {
                            echo '<div class="related-posts"><div class="postauthor-top"><h3>'.__('Related Posts','mythemeshop').'</h3></div><ul>';
                            while( $my_query->have_posts() ) { $my_query->the_post(); ?>
                            <li class="post-box horizontal-small">
                                <div class="horizontal-container">
                                    <div class="horizontal-container-inner">
                                        <div class="post-img">
                                            <a rel="nofollow" href="<?php the_permalink()?>" title="<?php the_title(); ?>">
                                                <?php the_post_thumbnail('smallthumb',array('title' => '')); ?>
                                            </a>
                                        </div>
                                        <div class="post-data">
                                            <div class="post-data-container">
                                                <a class="post-title" href="<?php the_permalink()?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                                <?php if($mts_options['mts_single_headline_meta'] == '1') { ?>
                                                    <div class="post-info">
                                                        <?php if(isset($mts_options['mts_single_headline_meta_info']['date']) == '1') { ?>
                                                            <span class="thetime updated"><?php the_time( get_option( 'date_format' ) ); ?></span>
                                                        <?php } ?>
                                                        <?php if(isset($mts_options['mts_single_headline_meta_info']['comment']) == '1') { ?>
                                                            <span class="thecomment"><i class="fa fa-comments"></i> <a rel="nofollow" href="<?php comments_link(); ?>"><?php echo comments_number('0','1','%');?></a></span>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php } echo '</ul></div><!-- .related-posts -->'; }} wp_reset_postdata(); ?>
                    <?php }?>                   
                    <?php if($mts_options['mts_author_box'] == '1') { ?>
                        <div class="postauthor">
                            <h4><?php _e('About The Author', 'mythemeshop'); ?></h4>
                            <div class="author-box">
                                <?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '150' );  } ?>
                                <div class="author-box-content">
                                    <div class="vcard clearfix">
                                        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="nofollow" class="fn"><i class="fa fa-user"></i><?php the_author_meta( 'nickname' ); ?></a>
                                        <?php if($mts_options['mts_author_box_mail'] == '1') { ?>
                                        <a href="mailto:<?php echo antispambot(the_author_meta('user_email')); ?>" rel="nofollow" class="mail"><i class="fa fa-envelope"></i><?php _e('Email Author', 'mythemeshop');?></a>
                                        <?php } ?>
                                    </div>
                                    <?php if( get_the_author_meta( 'description' ) ) { ?>
                                    <p><?php the_author_meta('description') ?></p>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                </div><!--.g post-->
                <?php comments_template( '', true ); ?>
            <?php endwhile; /* end loop */ ?>
        </div>
    </article>
    <?php get_sidebar(); ?>
<?php get_footer(); ?>