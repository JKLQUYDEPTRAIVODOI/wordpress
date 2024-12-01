<?php
/**
 * The template for displaying the footer.
 */
?>
<?php $mts_options = get_option(MTS_THEME_NAME);
// default = 3
$top_footer_num = (!empty($mts_options['mts_top_footer_num']) && $mts_options['mts_top_footer_num'] == 4) ? 4 : 3; ?>
        </div><!--#page-->
    </div><!--.main-container-->
    <footer id="site-footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
        <?php
        if ( is_single() && 'post' === get_post_type() ) {
            $show_carousel = isset($mts_options['mts_footer_carousel_location']['single']) == '1';
        } elseif ( is_home() ) {
            $show_carousel = isset($mts_options['mts_footer_carousel_location']['home']) == '1';
        } else {
            $show_carousel = isset($mts_options['mts_footer_carousel_location']['other']) == '1';
        }

        if ( $mts_options['mts_footer_carousel'] && $show_carousel ) {

            if ( empty($mts_options['mts_footer_carousel_cat']) || !is_array($mts_options['mts_footer_carousel_cat']) ) {
                $mts_options['mts_footer_carousel_cat'] = array('0');
            }
            $carousel_cat = implode(",", $mts_options['mts_footer_carousel_cat']);

        $car_query = new WP_Query('cat='.$carousel_cat.'&posts_per_page=12');

        $count = 0; if ( $car_query->have_posts() ) :
        ?>
        <div class="footer-carousel-wrap">
            <div class="container">
                <div class="slider-container">
                    <div class="owl-container loading">
                        <div id="footer-post-carousel" class="slides">
                            <?php while ( $car_query->have_posts() ) : $car_query->the_post(); ?>
                            <div class="<?php echo 'footer-carousel-item'; if($count === 0) echo ' show-post-data'; ?>">
                                <div class="dark-style post-box">
                                    <div class="post-data">
                                        <header>
                                            <a href="<?php the_permalink(); ?>" class="title post-title" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                                <div class="post-info">  
                                                    <span class="thetime updated"><?php the_time( get_option( 'date_format' ) ); ?></span>    
                                                </div>
                                        </header>
                                    </div>
                                </div>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('best-widgetthumb',array('title' => '')); ?>
                                </a>
                            </div>
                            <?php $count++; endwhile; ?>
                        </div>
                    </div>
                </div><!-- slider-container -->
            </div>
        </div>
        <?php endif; wp_reset_postdata(); }?>
        
            <div class="container">
            <?php if ($mts_options['mts_top_footer']) : ?>
                <div class="footer-widgets top-footer-widgets widgets-num-<?php echo $top_footer_num; ?>">
                <?php
                for ( $i=1; $i <= $top_footer_num; $i++ ) { 
                    $sidebar = ( $i == 1 ) ? 'footer-top' : 'footer-top-'.$i;
                    $class = 'f-widget f-widget-'.$i;
                ?>
                    <div class="<?php echo esc_attr($class); ?>">
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( $sidebar ) ) : ?><?php endif; ?>
                    </div>
                    <?php } ?>
                </div><!--.top-footer-widgets-->
            <?php endif; ?>
            </div>
            
        <div class="copyrights">
            <div class="container">
                <?php mts_copyrights_credit(); ?>
            </div><!--.container-->
        </div><!--.copyrights-->
    </footer><!--footer-->
</div><!--.main-container-wrap-->
<?php mts_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>