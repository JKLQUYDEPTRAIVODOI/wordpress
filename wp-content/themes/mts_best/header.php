<?php
/**
 * The template for displaying the header.
 *
 * Displays everything from the doctype declaration down to the navigation.
 */
?>
<!DOCTYPE html>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<html class="no-js" <?php language_attributes(); ?>>
<head itemscope itemtype="http://schema.org/WebSite">
	<meta charset="<?php bloginfo('charset'); ?>">
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php mts_meta(); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body id ="blog" <?php body_class('main'); ?> itemscope itemtype="http://schema.org/WebPage">
	<div class="main-container-wrap">
		<header id="site-header" role="banner" class="main-header" itemscope itemtype="http://schema.org/WPHeader">
			<div id="header">
				<div class="container">
					<div class="header-inner">
						<div class="logo-wrap">
							<?php if ($mts_options['mts_logo'] != '') { ?>
								<?php if( is_front_page() || is_home() || is_404() ) { ?>
									<h1 id="logo" class="image-logo" itemprop="headline">
										<a href="<?php echo home_url(); ?>"><img src="<?php echo $mts_options['mts_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
									</h1><!-- END #logo -->
								<?php } else { ?>
									<h2 id="logo" class="image-logo" itemprop="headline">
										<a href="<?php echo home_url(); ?>"><img src="<?php echo $mts_options['mts_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
									</h2><!-- END #logo -->
								<?php } ?>
							<?php } else { ?>
								<?php if( is_front_page() || is_home() || is_404() ) { ?>
									<h1 id="logo" class="text-logo" itemprop="headline">
										<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
									</h1><!-- END #logo -->
								<?php } else { ?>
									<h2 id="logo" class="text-logo" itemprop="headline">
										<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
									</h2><!-- END #logo -->
								<?php } ?>
								<div class="site-description">
									<?php bloginfo( 'description' ); ?>
								</div>
							<?php } ?>
						</div>
						<?php dynamic_sidebar('Header Ad'); ?>
					</div>
				</div><!--.container-->
				
				<?php if ($mts_options['mts_show_secondary_nav'] == '1'): ?>
					<?php if($mts_options['mts_sticky_nav'] == '1') { ?>
						<div class="clear" id="catcher"></div>
						<div class="secondary-navigation sticky-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
					<?php } else { ?>
						<div class="secondary-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
					<?php } ?>
						<div class="container clearfix">
							<a href="#" id="pull" class="toggle-mobile-menu"><?php _e('Menu', 'best' ); ?></a>
							<?php if ( has_nav_menu( 'mobile' ) ) { ?>
								<nav id="navigation" class="clearfix">
									<?php if ( has_nav_menu( 'secondary-menu' ) ) { ?>
										<?php wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_class' => 'menu clearfix', 'container' => '', 'walker' => new mts_menu_walker ) ); ?>
									<?php } else { ?>
										<ul class="menu clearfix">
											<?php wp_list_categories('title_li='); ?>
										</ul>
									<?php } ?>
								</nav>
								<nav id="navigation" class="mobile-only clearfix mobile-menu-wrapper">
									<?php wp_nav_menu( array( 'theme_location' => 'mobile', 'menu_class' => 'menu clearfix', 'container' => '', 'walker' => new mts_menu_walker ) ); ?>
								</nav>
							<?php } else { ?>
								<nav id="navigation" class="clearfix mobile-menu-wrapper">
									<?php if ( has_nav_menu( 'secondary-menu' ) ) { ?>
										<?php wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_class' => 'menu clearfix', 'container' => '', 'walker' => new mts_menu_walker ) ); ?>
									<?php } else { ?>
										<ul class="menu clearfix">
											<?php wp_list_categories('title_li='); ?>
										</ul>
									<?php } ?>
								</nav>
							<?php } ?>
						</div>
					</div>
				<?php endif; ?>

			</div><!--#header-->
		</header>
		<div class="main-container">		