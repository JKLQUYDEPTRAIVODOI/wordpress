<?php

defined('ABSPATH') or die;

/*
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 *
 */
require_once( dirname( __FILE__ ) . '/options/options.php' );
/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
	
	//$sections = array();
	$sections[] = array(
				'title' => __('A Section added by hook', 'best' ),
				'desc' => '<p class="description">' . __('This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.', 'best' ) . '</p>',
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
				//Lets leave this as a blank section, no options just some intro text set above.
				'fields' => array()
				);
	
	return $sections;
	
}//function
//add_filter('nhp-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
	
	//$args['dev_mode'] = false;
	
	return $args;
	
}//function
//add_filter('nhp-opts-args-twenty_eleven', 'change_framework_args');

/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */

function setup_framework_options(){
$args = array();

//Set it to dev mode to view the class settings/info in the form - default is false
$args['dev_mode'] = false;
//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!
//$args['stylesheet_override'] = true;

//Add HTML before the form
//$args['intro_text'] = __('<p>This is the HTML which can be displayed before the form, it isnt required, but more info is always better. Anything goes in terms of markup here, any HTML.</p>', 'best' );

if ( ! MTS_THEME_WHITE_LABEL ) {
	//Setup custom links in the footer for share icons
	$args['share_icons']['twitter'] = array(
		'link' => 'http://twitter.com/mythemeshopteam',
		'title' => __( 'Follow Us on Twitter', 'best' ),
		'img' => 'fa fa-twitter-square'
	);
	$args['share_icons']['facebook'] = array(
		'link' => 'http://www.facebook.com/mythemeshop',
		'title' => __( 'Like us on Facebook', 'best' ),
		'img' => 'fa fa-facebook-square'
	);
}

//Choose to disable the import/export feature
//$args['show_import_export'] = false;

//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$args['opt_name'] = MTS_THEME_NAME;

//Custom menu icon
//$args['menu_icon'] = '';

//Custom menu title for options page - default is "Options"
$args['menu_title'] = __('Theme Options', 'best' );

//Custom Page Title for options page - default is "Options"
$args['page_title'] = __('Theme Options', 'best' );

//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
$args['page_slug'] = 'theme_options';

//Custom page capability - default is set to "manage_options"
//$args['page_cap'] = 'manage_options';

//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
//$args['page_type'] = 'submenu';

//parent menu - default is set to "themes.php" (Appearance)
//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
//$args['page_parent'] = 'themes.php';

//custom page location - default 100 - must be unique or will override other items
$args['page_position'] = 62;

//Custom page icon class (used to override the page icon next to heading)
//$args['page_icon'] = 'icon-themes';

if ( ! MTS_THEME_WHITE_LABEL ) {
	//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition
	$args['help_tabs'][] = array(
		'id' => 'nhp-opts-1',
		'title' => __('Support', 'best' ),
		'content' => '<p>' . __('If you are facing any problem with our theme or theme option panel, head over to our', 'best' ) . ' <a href="http://community.mythemeshop.com/">Support Forums</a>.</p>'
	);
	$args['help_tabs'][] = array(
		'id' => 'nhp-opts-2',
		'title' => __('Earn Money', 'best' ),
		'content' => '<p>' . __('Earn 70% commision on every sale by refering your friends and readers. Join our', 'best' ) . ' <a href="http://mythemeshop.com/affiliate-program/">Affiliate Program</a>.</p>'
	);
}

//Set the Help Sidebar for the options page - no sidebar by default										
//$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'best' );

$mts_patterns = array(
	'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
	'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
	'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
	'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
	'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
	'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
	'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
	'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
	'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
	'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
	'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
	'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
	'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
	'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
	'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
	'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
	'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
	'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
	'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
	'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
	'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
	'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
	'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
	'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
	'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
	'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
	'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
	'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
	'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
	'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
	'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
	'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
	'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
	'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
	'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
	'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
	'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
	'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
	'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png'),
	'hbg' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg.png'),
	'hbg2' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg2.png'),
	'hbg3' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg3.png'),
	'hbg4' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg4.png'),
	'hbg5' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg5.png'),
	'hbg6' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg6.png'),
	'hbg7' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg7.png'),
	'hbg8' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg8.png'),
	'hbg9' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg9.png'),
	'hbg10' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg10.png'),
	'hbg11' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg11.png'),
	'hbg12' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg12.png'),
	'hbg13' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg13.png'),
	'hbg14' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg14.png'),
	'hbg15' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg15.png'),
	'hbg16' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg16.png'),
	'hbg17' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg17.png'),
	'hbg18' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg18.png'),
	'hbg19' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg19.png'),
	'hbg20' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg20.png'),
	'hbg21' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg21.png'),
	'hbg22' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg22.png'),
	'hbg23' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg23.png'),
	'hbg24' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg24.png'),
	'hbg25' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg25.png')
);

$sections = array();

$sections[] = array(
				'icon' => 'fa fa-cogs',
				'title' => __('General Settings', 'best'),
				'desc' => '<p class="description">' . __('This tab contains common setting options which will be applied to the whole theme.', 'best'). '</p>',
				'fields' => array(
				
					array(
						'id' => 'mts_logo',
						'type' => 'upload',
						'title' => __('Logo Image', 'best'), 
						'sub_desc' => __('Upload your logo using the Upload Button or insert image URL.', 'best')
						),
					array(
						'id' => 'mts_favicon',
						'type' => 'upload',
						'title' => __('Favicon', 'best'), 
						'sub_desc' => wp_kses( __('Upload a <strong>32 x 32 px</strong> image that will represent your website\'s favicon.', 'best' ), array( 'strong' ) )
						),
					array(
						'id' => 'mts_touch_icon',
						'type' => 'upload',
						'title' => __('Touch icon', 'best' ),
						'sub_desc' => wp_kses( __('Upload a <strong>152 x 152 px</strong> image that will represent your website\'s touch icon for iOS 2.0+ and Android 2.1+ devices.', 'best' ), array( 'strong' ) )
						),
					array(
						'id' => 'mts_metro_icon',
						'type' => 'upload',
						'title' => __('Metro icon', 'best' ),
						'sub_desc' => wp_kses( __('Upload a <strong>144 x 144 px</strong> image that will represent your website\'s IE 10 Metro tile icon.', 'best' ), array( 'strong' ) )
						),
					array(
						'id' => 'mts_twitter_username',
						'type' => 'text',
						'title' => __('Twitter Username', 'best'),
						'sub_desc' => __('Enter your Username here.', 'best'),
						),
					array(
						'id' => 'mts_feedburner',
						'type' => 'text',
						'title' => __('FeedBurner URL', 'best'),
						'sub_desc' => wp_kses( __('Enter your FeedBurner\'s URL here, ex: <strong>http://feeds.feedburner.com/mythemeshop</strong> and your main feed (http://example.com/feed) will get redirected to the FeedBurner ID entered here.)', 'best' ), array( 'strong', 'a' => array( 'href' => array() ) ) ),
						'validate' => 'url'
						),
					array(
						'id' => 'mts_header_code',
						'type' => 'textarea',
						'title' => __('Header Code', 'best'), 
						'sub_desc' => wp_kses( __('Enter the code which you need to place <strong>before closing &lt;/head&gt; tag</strong>. (ex: Google Webmaster Tools verification, Bing Webmaster Center, BuySellAds Script, Alexa verification etc.)', 'best' ), array( 'strong', 'a' => array( 'href' => array() ) ) )
						),
					array(
						'id' => 'mts_analytics_code',
						'type' => 'textarea',
						'title' => __('Footer Code', 'best'), 
						'sub_desc' => wp_kses( __('Enter the codes which you need to place in your footer. <strong>(ex: Google Analytics, Clicky, STATCOUNTER, Woopra, Histats, etc.)</strong>.', 'best' ), array( 'strong', 'a' => array( 'href' => array() ) ) )
						),
					array(
                        'id' => 'mts_pagenavigation_type',
                        'type' => 'radio',
                        'title' => __('Pagination Type', 'best'),
                        'sub_desc' => __('Select pagination type.', 'best'),
                        'options' => array(
                                        '0'=> __('Default (Next / Previous)', 'best' ),
                                        '1' => __('Numbered (1 2 3 4...)', 'best' ),
                                        '2' => __( 'AJAX (Load More Button)', 'best' ),
                                        '3' => __( 'AJAX (Auto Infinite Scroll)', 'best' ) ),
                        'std' => '1'
                        ),
                    array(
                        'id' => 'mts_ajax_search',
                        'type' => 'button_set',
                        'title' => __('AJAX Quick search', 'best'), 
						'options' => array('0' => __('Off', 'best'), '1' => __('On', 'best') ),
						'sub_desc' => __('Enable or disable search results appearing instantly below the search form', 'best'),
						'std' => '0'
                        ),
					array(
						'id' => 'mts_responsive',
						'type' => 'button_set',
						'title' => __('Responsiveness', 'best' ),
						'options' => array( '0' => __( 'Off', 'best' ), '1' => __( 'On', 'best' ) ),
						'sub_desc' => __('MyThemeShop themes are responsive, which means they adapt to tablet and mobile devices, ensuring that your content is always displayed beautifully no matter what device visitors are using. Enable or disable responsiveness using this option.', 'best' ),
						'std' => '1'
						),
					array(
						'id' => 'mts_shop_products',
						'type' => 'text',
						'title' => __('No. of Products', 'best' ),
						'sub_desc' => __('Enter the total number of products which you want to show on shop page (WooCommerce plugin must be enabled).', 'best' ),
						'validate' => 'numeric',
						'std' => '9',
						'class' => 'small-text',
                        'reset_at_version' => '2.0'
						),
					)
				);

$sections[] = array(
				'icon' => 'fa fa-bolt',
				'title' => __('Performance', 'best' ),
				'desc' => '<p class="description">' . __('This tab contains performance-related options which can help speed up your website.', 'best' ) . '</p>',
				'fields' => array(
					array(
						'id' => 'mts_prefetching',
						'type' => 'button_set',
						'title' => __('Prefetching', 'best' ),
						'options' => array( '0' => __( 'Off', 'best' ), '1' => __( 'On', 'best' ) ),
						'sub_desc' => __('Enable or disable prefetching. If user is on homepage, then single page will load faster and if user is on single page, homepage will load faster in modern browsers.', 'best' ),
						'std' => '0'
						),
					array(
						'id' => 'mts_lazy_load',
						'type' => 'button_set_hide_below',
						'title' => __('Lazy Load', 'best' ),
						'options' => array( '0' => __( 'Off', 'best' ), '1' => __( 'On', 'best' ) ),
						'sub_desc' => __('Delay loading of images outside of viewport, until user scrolls to them.', 'best' ),
						'std' => '0',
                        'reset_at_version' => '2.0',
						'args' => array('hide' => 2)
						),
					array(
						'id' => 'mts_lazy_load_thumbs',
						'type' => 'button_set',
						'title' => __('Lazy load featured images', 'best' ),
						'options' => array( '0' => __( 'Off', 'best' ), '1' => __( 'On', 'best' ) ),
						'sub_desc' => __('Enable or disable Lazy load of featured images across site.', 'best' ),
						'std' => '0',
                        'reset_at_version' => '2.0'
						),
					array(
						'id' => 'mts_lazy_load_content',
						'type' => 'button_set',
						'title' => __('Lazy load post content images', 'best' ),
						'options' => array( '0' => __( 'Off', 'best' ), '1' => __( 'On', 'best' ) ),
						'sub_desc' => __('Enable or disable Lazy load of images inside post/page content.', 'best' ),
						'std' => '0',
                        'reset_at_version' => '2.0'
						),
					array(
						'id' => 'mts_async_js',
						'type' => 'button_set',
						'title' => __('Async JavaScript', 'best' ),
						'options' => array( '0' => __( 'Off', 'best' ), '1' => __( 'On', 'best' ) ),
						'sub_desc' => sprintf( __('Add %s attribute to script tags to improve page download speed.', 'best' ), '<code>async</code>' ),
						'std' => '1',
                        'reset_at_version' => '2.0'
						),
					array(
						'id' => 'mts_remove_ver_params',
						'type' => 'button_set',
						'title' => __('Remove ver parameters', 'best' ),
						'options' => array( '0' => __( 'Off', 'best' ), '1' => __( 'On', 'best' ) ),
						'sub_desc' => sprintf( __('Remove %s parameter from CSS and JS file calls. It may improve speed in some browsers which do not cache files having the parameter.', 'best' ), '<code>ver</code>' ),
						'std' => '1',
                        'reset_at_version' => '2.0'
						),
					array(
						'id' => 'mts_optimize_wc',
						'type' => 'button_set',
						'title' => __('Optimize WooCommerce scripts', 'best' ),
						'options' => array( '0' => __( 'Off', 'best' ), '1' => __( 'On', 'best' ) ),
						'sub_desc' => __('Load WooCommerce scripts and styles only on WooCommerce pages (WooCommerce plugin must be enabled).', 'best' ),
						'std' => '0',
                        'reset_at_version' => '2.0'
						),
					'cache_message' => array(
						'id' => 'mts_cache_message',
						'type' => 'info',
						'title' => __('Use Cache', 'best' ),
						'desc' => sprintf(
							__('A cache plugin can increase page download speed dramatically. We recommend using %1$s or %2$s.', 'best' ),
							'<a href="'.admin_url( 'plugin-install.php?tab=plugin-information&plugin=w3-total-cache&TB_iframe=true&width=772&height=574' ).'" class="thickbox" title="W3 Total Cache">W3 Total Cache</a>',
							'<a href="'.admin_url( 'plugin-install.php?tab=plugin-information&plugin=wp-super-cache&TB_iframe=true&width=772&height=574' ).'" class="thickbox" title="WP Super Cache">WP Super Cache</a>'
						),
					),
				)
			);

// Hide cache message on multisite or if a chache plugin is active already
if ( is_multisite() || strstr( join( ';', get_option( 'active_plugins' ) ), 'cache' ) ) {
	unset( $sections[1]['fields']['cache_message'] );
}

$sections[] = array(
				'icon' => 'fa fa-adjust',
				'title' => __('Styling Options', 'best'),
				'desc' => '<p class="description">' . __('Control the visual appearance of your theme, such as colors, layout and patterns, from here.', 'best') . '</p>',
				'fields' => array(
					array(
						'id' => 'mts_color_scheme',
						'type' => 'color',
						'title' => __('Color Scheme', 'best'), 
						'sub_desc' => __('The theme comes with unlimited color schemes for your theme\'s styling.', 'best'),
						'std' => '#3498db'
						),
					array(
						'id' => 'mts_layout',
						'type' => 'radio_img',
						'title' => __('Layout Style', 'best'), 
						'sub_desc' => wp_kses_post( __('Choose the <strong>default sidebar position</strong> for your site. The position of the sidebar for individual posts can be set in the post editor.', 'best' ) ),
						'options' => array(
										'cslayout' => array('img' => NHP_OPTIONS_URL.'img/layouts/cs.png'),
										'sclayout' => array('img' => NHP_OPTIONS_URL.'img/layouts/sc.png')
											),
						'std' => 'cslayout'
						),
					array(
						'id' => 'mts_background',
						'type' => 'background',
						'title' => __('Site Background', 'best' ),
						'sub_desc' => __('Set background color, pattern and image from here.', 'best' ),
						'options' => array(
							'color'         => '',            // false to disable, not needed otherwise
							'image_pattern' => $mts_patterns, // false to disable, array of options otherwise ( required !!! )
							'image_upload'  => '',            // false to disable, not needed otherwise
							'repeat'        => array(),       // false to disable, array of options to override default ( optional )
							'attachment'    => array(),       // false to disable, array of options to override default ( optional )
							'position'      => array(),       // false to disable, array of options to override default ( optional )
							'size'          => array(),       // false to disable, array of options to override default ( optional )
							'gradient'      => '',            // false to disable, not needed otherwise
							'parallax'      => array(),       // false to disable, array of options to override default ( optional )
						),
						'std' => array(
							'color'         => '#ffffff',
							'use'           => 'pattern',
							'image_pattern' => 'nobg',
							'image_upload'  => '',
							'repeat'        => 'repeat',
							'attachment'    => 'scroll',
							'position'      => 'left top',
							'size'          => 'cover',
							'gradient'      => array('from' => '#ffffff', 'to' => '#000000', 'direction' => 'horizontal' ),
							'parallax'      => '0',
						),
                        'reset_at_version' => '2.0'
					),
					array(
						'id' => 'mts_custom_css',
						'type' => 'textarea',
						'title' => __('Custom CSS', 'best'), 
						'sub_desc' => __('You can enter custom CSS code here to further customize your theme. This will override the default CSS used on your site.', 'best')
						),
					array(
						'id' => 'mts_lightbox',
						'type' => 'button_set',
						'title' => __('Lightbox', 'best'),
						'options' => array('0' => __('Off', 'best'), '1' => __('On', 'best') ),
						'sub_desc' => __('A lightbox is a stylized pop-up that allows your visitors to view larger versions of images without leaving the current page. You can enable or disable the lightbox here.', 'best'),
						'std' => '0'
						),																		
					)
				);
$sections[] = array(
				'icon' => 'fa fa-credit-card',
				'title' => __('Header', 'best'),
				'desc' => '<p class="description">' . __('From here, you can control the elements of header section.', 'best') . '</p>',
				'fields' => array(
					array(
						'id' => 'mts_navigation_background',
						'type' => 'background',
						'title' => __('Navigation Background', 'best' ),
						'sub_desc' => __('Set background color, pattern and image from here.', 'best' ),
						'options' => array(
							'color'         => '',            // false to disable, not needed otherwise
							'image_pattern' => $mts_patterns, // false to disable, array of options otherwise ( required !!! )
							'image_upload'  => '',            // false to disable, not needed otherwise
							'repeat'        => array(),       // false to disable, array of options to override default ( optional )
							'attachment'    => array(),       // false to disable, array of options to override default ( optional )
							'position'      => array(),       // false to disable, array of options to override default ( optional )
							'size'          => array(),       // false to disable, array of options to override default ( optional )
							'gradient'      => '',            // false to disable, not needed otherwise
							'parallax'      => false,       // false to disable, array of options to override default ( optional )
						),
						'std' => array(
							'color'         => '#3498db',
							'use'           => 'pattern',
							'image_pattern' => 'nobg',
							'image_upload'  => '',
							'repeat'        => 'repeat',
							'attachment'    => 'scroll',
							'position'      => 'left top',
							'size'          => 'cover',
							'gradient'      => array('from' => '#ffffff', 'to' => '#000000', 'direction' => 'horizontal' ),
						),
                        'reset_at_version' => '2.0'
					),
					array(
						'id' => 'mts_header_background',
						'type' => 'background',
						'title' => __('Header Background', 'best' ),
						'sub_desc' => __('Set background color, pattern and image from here.', 'best' ),
						'options' => array(
							'color'         => '',            // false to disable, not needed otherwise
							'image_pattern' => $mts_patterns, // false to disable, array of options otherwise ( required !!! )
							'image_upload'  => '',            // false to disable, not needed otherwise
							'repeat'        => array(),       // false to disable, array of options to override default ( optional )
							'attachment'    => array(),       // false to disable, array of options to override default ( optional )
							'position'      => array(),       // false to disable, array of options to override default ( optional )
							'size'          => array(),       // false to disable, array of options to override default ( optional )
							'gradient'      => '',            // false to disable, not needed otherwise
							'parallax'      => array(),       // false to disable, array of options to override default ( optional )
						),
						'std' => array(
							'color'         => '#ffffff',
							'use'           => 'pattern',
							'image_pattern' => 'nobg',
							'image_upload'  => '',
							'repeat'        => 'repeat',
							'attachment'    => 'scroll',
							'position'      => 'left top',
							'size'          => 'cover',
							'gradient'      => array('from' => '#ffffff', 'to' => '#000000', 'direction' => 'horizontal' ),
							'parallax'      => '0',
						),
                        'reset_at_version' => '2.0'
					),
					array(
						'id' => 'mts_header_section2',
						'type' => 'button_set',
						'title' => __('Show Header', 'best'), 
						'options' => array('0' => __('Off', 'best'), '1' => __('On', 'best') ),
						'sub_desc' => wp_kses_post( __('Use this button to Show or Hide <strong>Header Section</strong> completely.', 'best' ) ),
						'std' => '1'
						),
					array(
						'id' => 'mts_show_secondary_nav',
						'type' => 'button_set',
						'title' => __('Show Primary Menu', 'best'), 
						'options' => array('0' => __('Off', 'best'), '1' => __('On', 'best') ),
						'sub_desc' => wp_kses_post( __('Use this button to enable <strong>Secondary Navigation Menu</strong>.', 'best' ) ),
						'std' => '1'
						),
					array(
						'id' => 'mts_sticky_nav',
						'type' => 'button_set',
						'title' => __('Floating Navigation Menu', 'best'), 
						'options' => array('0' => __('Off', 'best'), '1' => __('On', 'best') ),
						'sub_desc' => wp_kses_post( __('Use this button to enable <strong>Floating Navigation Menu</strong>.', 'best' ) ),
						'std' => '0'
						),
					)
				);	
$sections[] = array(
				'icon' => 'fa fa-home',
				'title' => __('HomePage', 'best'),
				'desc' => '<p class="description">' . __('From here, you can control the elements of the homepage.', 'best') . '</p>',
				'fields' => array(
					array(
						'id' => 'mts_featured_slider',
						'type' => 'button_set_hide_below',
						'title' => __('Homepage Slider', 'best'), 
						'options' => array('0' => __('Off', 'best'), '1' => __('On', 'best') ),
						'sub_desc' => wp_kses_post( __('<strong>Enable or Disable</strong> homepage slider with this button. The slider will show recent articles from the selected categories.', 'best' ) ),
						'std' => '0',
                        'args' => array('hide' => 2)
						),
						array(
						'id' => 'mts_featured_slider_cat',
						'type' => 'cats_multi_select',
						'title' => __('Slider Category(s)', 'best'), 
						'sub_desc' => wp_kses_post( __('Select a category from the drop-down menu, latest articles from this category will be shown <strong>in the slider</strong>.', 'best' ) ),
						'args' => array('number' => '100')
						),
                        array(
						'id' => 'mts_featured_slider_num',
						'type' => 'text',
                        'class' => 'small-text',
						'title' => __('Number of posts', 'best'), 
						'sub_desc' => __('Enter the number of posts to show in the slider', 'best'),
                        'std' => '3',
                        'args' => array('type' => 'number')
						),
						array(
                        'id'        => 'mts_custom_slider',
                        'type'      => 'group',
                        'title'     => __('Custom Slider', 'best' ),
                        'sub_desc'  => __('With this option you can set up a slider with custom image and text instead of the default slider automatically generated from your posts.', 'best' ),
                        'groupname' => __('Slider', 'best' ), // Group name
                        'subfields' => 
                            array(
                                array(
                                    'id' => 'mts_custom_slider_title',
            						'type' => 'text',
            						'title' => __('Title', 'best' ),
            						'sub_desc' => __('Title of the slide', 'best' ),
                                    ),
                                array(
                                    'id' => 'mts_custom_slider_image',
            						'type' => 'upload',
            						'title' => __('Image', 'best' ),
            						'sub_desc' => __('Upload or select an image for this slide', 'best' ),
                                    'return' => 'id'
            						),	
                                array('id' => 'mts_custom_slider_text',
            						'type' => 'text',
            						'title' => __('Text', 'best' ),
            						'sub_desc' => __('Description of the slide', 'best' ),
                                    ), 
                                array('id' => 'mts_custom_slider_link',
            						'type' => 'text',
            						'title' => __('Link', 'best' ),
            						'sub_desc' => __('Insert a link URL for the slide', 'best' ),
                                    'std' => '#'
                                    ),
                            ),
                        ),
					array(
						'id' => 'mts_featured_section_2',
						'type' => 'button_set_hide_below',
						'title' => __('Featured Section', 'best'), 
						'options' => array('0' => __('Off', 'best'), '1' => __('On', 'best') ),
						'sub_desc' => __('<strong>Enable or Disable</strong> Featured Section above Latest Posts.', 'best'),
						'std' => '0',
                        'args' => array('hide' => 2)
						),
						array(
						'id' => 'mts_featured_section_2_title',
						'type' => 'text',
						'title' => __('Featured Section Title', 'best'),
						'sub_desc' => __('Enter the title for this section.', 'best')
						),
						array(
						'id' => 'mts_featured_section_2_cat',
						'type' => 'cats_multi_select',
						'title' => __('Featured Section Category(s)', 'best'), 
						'sub_desc' => __('Select a category from the drop-down menu, latest articles from this category will be shown <strong>in this section</strong>.', 'best'),
						'args' => array('number' => '100')
						),
					array(
						'id' => 'mts_featured_categories',
						'type' => 'group',
						'title' => __('Home Sections', 'best') ,
						'sub_desc' => __('Select category sections appearing on the homepage.', 'best') ,
						'groupname' => __('Section', 'best') , // Group name
						'subfields' => array(
							array(
								'id' => 'mts_featured_category',
								'type' => 'cats_select',
								'title' => __('Category', 'best') ,
								'sub_desc' => __('Select a category or the latest posts for this section', 'best') ,
								'std' => 'latest',
								'args' => array(
									'include_latest' => 1,
									'hide_empty' => 0,
									'number' => 200
								),
							),
							array(
								'id' => 'mts_featured_category_layout',
								'type' => 'select',
								'title' => __('Posts Layout', 'best'),
								'sub_desc' => __('Select the posts layout for this section.', 'best') ,
								'options' => array(
									'vertical' => 'Vertical - 1 column',
									'mixed'=> 'Grid - 2 column'
								),
								'std' => 'vertical'
							),
							array(
								'id' => 'mts_featured_category_postsnum',
								'type' => 'text',
								'class' => 'small-text',
								'title' => __('Number of posts', 'best') ,
								'sub_desc' => sprintf( wp_kses_post( __('Enter the number of posts to show in this section.<br/><strong>For Latest Posts</strong>, this setting will be ignored, and number set in <a href="%s" target="_blank">Settings&nbsp;&gt;&nbsp;Reading</a> will be used instead.', 'best' ) ), admin_url('options-reading.php')),
								'std' => '4',
								'args' => array(
									'type' => 'number'
								)
							),
						),
						'std' => array(
							'1' => array(
								'group_title' => '',
								'group_sort' => '1',
								'mts_featured_category' => 'latest',
								'mts_featured_category_postsnum' => get_option('posts_per_page'),
								'mts_featured_category_layout' => 'vertical',
								'mts_featured_category_vert_postsnum' => '2'
							)
						)
					),
					array(
                        'id'       => 'mts_home_headline_meta_info',
                        'type'     => 'layout',
                        'title'    => __('HomePage Post Meta Info', 'best' ),
                        'sub_desc' => __('Organize how you want the post meta info to appear on the homepage', 'best' ),
                        'options'  => array(
                            'enabled'  => array(
                                'date'     => __('Date', 'best' ),
                                'comment'  => __('Comment Count', 'best' )
                            ),
                            'disabled' => array(
                            	'category' => __('Categories', 'best' ),
                            	'author'   => __('Author Name', 'best' )
                            )
                        ),
                        'std'  => array(
                            'enabled'  => array(
                                'date'     => __('Date', 'best' ),
                                'comment'  => __('Comment Count', 'best' )
                            ),
                            'disabled' => array(
                            	'category' => __('Categories', 'best' ),
                            	'author'   => __('Author Name', 'best' )
                            )
                        ),
                        'reset_at_version' => '2.0'
                    ),
				)
			);
$sections[] = array(
				'icon' => 'fa fa-table',
				'title' => __('Footer', 'best' ),
				'desc' => '<p class="description">' . __('From here, you can control the elements of Footer section.', 'best' ) . '</p>',
				'fields' => array(
					array(
						'id' => 'mts_copyrights',
						'type' => 'textarea',
						'title' => __('Copyrights Text', 'best'), 
						'sub_desc' => __( 'You can change or remove our link from footer and use your own custom text.', 'best' ) . ( MTS_THEME_WHITE_LABEL ? '' : sprintf( __('(You can also use your affiliate link to %1$searn 70%% of sales%2$s. Ex: %3$s)', 'best' ), '<strong>', '</strong>', '<a href="https://mythemeshop.com/go/aff/aff" target="_blank">https://mythemeshop.com/?ref=username</a>' ) ),
						'std' => 'Theme by <a href="http://mythemeshop.com/" rel="nofollow">MyThemeShop</a>'
						),
					array(
						'id' => 'mts_footer_carousel',
						'type' => 'button_set_hide_below',
						'title' => __('Footer Carousel', 'best'), 
						'sub_desc' => __('Enable or disable footer posts carousel.', 'best'),
						'options' => array(
										'0' => 'Off',
										'1' => 'On'
											),
						'std' => '0',
						'args' => array('hide' => 3)
						),
                        array(
						'id' => 'mts_footer_carousel_cat',
						'type' => 'cats_multi_select',
						'title' => __('Footer Carousel Category(s)', 'best'), 
						'sub_desc' => __('Select a category from the drop-down menu, latest articles from this category will be shown <strong>in the carousel</strong>.', 'best'),
						'args' => array('number' => '100')
						),
						array(
 						'id' => 'mts_footer_carousel_location',
 						'type' => 'multi_checkbox',
 						'title' => __('Footer Carousel Locations', 'best'),
 						'sub_desc' => __('Choose where would you like footer carousel to appear.', 'best'),
 						'options' => array('home' => __('Home','best'),'single' => __('Single Post','best'),'other' => __('Other Pages','best') ),
 						'std' => array('home' => '1', 'single' => '1', 'other' => '1')
 						),
 						array(
						'id' => 'mts_footer_carousel_bg_color',
						'type' => 'color',
						'title' => __('Footer Carousel Background Color', 'best'), 
						'sub_desc' => __('Pick a color for the footer carousel background color.', 'best'),
						'std' => '#3498db'
						),
					array(
						'id' => 'mts_top_footer',
						'type' => 'button_set_hide_below',
						'title' => __('Footer Widgets', 'best'), 
						'sub_desc' => __('Enable or disable footer with this option.', 'best'),
						'options' => array(
										'0' => 'Off',
										'1' => 'On'
											),
						'std' => '0',
						'args' => array('hide' => 4)
						),
						array(
						'id' => 'mts_top_footer_num',
						'type' => 'radio_img',
						'title' => __('Footer Layout', 'best'), 
						'sub_desc' => __('Choose the number of widget areas in the <strong>footer</strong>', 'best'),
						'options' => array(
										'3' => array('img' => NHP_OPTIONS_URL.'img/layouts/footer-3.png'),
										'4' => array('img' => NHP_OPTIONS_URL.'img/layouts/footer-4.png')
											),
						'std' => '3'
						),
					array(
						'id' => 'mts_footer_background',
						'type' => 'background',
						'title' => __('Footer Background', 'best' ),
						'sub_desc' => __('Set background color, pattern and image from here.', 'best' ),
						'options' => array(
							'color'         => '',            // false to disable, not needed otherwise
							'image_pattern' => $mts_patterns, // false to disable, array of options otherwise ( required !!! )
							'image_upload'  => '',            // false to disable, not needed otherwise
							'repeat'        => array(),       // false to disable, array of options to override default ( optional )
							'attachment'    => array(),       // false to disable, array of options to override default ( optional )
							'position'      => array(),       // false to disable, array of options to override default ( optional )
							'size'          => array(),       // false to disable, array of options to override default ( optional )
							'gradient'      => '',            // false to disable, not needed otherwise
							'parallax'      => array(),       // false to disable, array of options to override default ( optional )
						),
						'std' => array(
							'color'         => '#eeeeee',
							'use'           => 'pattern',
							'image_pattern' => 'nobg',
							'image_upload'  => '',
							'repeat'        => 'repeat',
							'attachment'    => 'scroll',
							'position'      => 'left top',
							'size'          => 'cover',
							'gradient'      => array('from' => '#ffffff', 'to' => '#000000', 'direction' => 'horizontal' ),
							'parallax'      => '0',
						),
                        'reset_at_version' => '2.0'
					),
					array(
						'id' => 'mts_copyrights_bg_color',
						'type' => 'color',
						'title' => __('Copyrights Background Color', 'best') ,
						'sub_desc' => __('Pick a color for the copyrights background color.', 'best') ,
						'std' => '#FFFFFF'
					),
				)
			);
$sections[] = array(
				'icon' => 'fa fa-file-text',
				'title' => __('Single Posts', 'best'),
				'desc' => '<p class="description">' . __('From here, you can control the appearance and functionality of your single posts page.', 'best') . '</p>',
				'fields' => array(
					array(
                        'id'       => 'mts_single_post_layout',
                        'type'     => 'layout2',
                        'title'    => __('Single Post Layout', 'best' ),
                        'sub_desc' => __('Customize the look of single posts', 'best' ),
                        'options'  => array(
                            'enabled'  => array(
                                'content'   => array(
                                	'label' 	=> __('Post Content', 'best' ),
                                	'subfields'	=> array(
                                		array(
											'id' => 'mts_single_post_related',
											'type' => 'radio_img',
											'title' => __('Related Post Layout', 'mythemeshop'), 
											'sub_desc' => __('Choose from <strong>4 different single post layouts</strong> for your site. Sidebar\'s position can be adjusted from HomePage Layout options.', 'mythemeshop'),
											'options' => array(
												'crlayout' => array('img' => NHP_OPTIONS_URL.'img/layouts/cr.png'),
												'rclayout' => array('img' => NHP_OPTIONS_URL.'img/layouts/rc.png'),
												'cbrlayout' => array('img' => NHP_OPTIONS_URL.'img/layouts/cbr.png'),
												'clayout' => array('img' => NHP_OPTIONS_URL.'img/layouts/c.png')
												),
											'std' => 'cbrlayout',
                        					'reset_at_version' => '2.0'
										),
					        			array(
					        				'id' => 'mts_related_postsnum',
					        				'type' => 'text',
					        				'class' => 'small-text',
					        				'title' => __('Number of related posts', 'best' ) ,
					        				'sub_desc' => __('Enter the number of posts to show in the related posts section.', 'best' ) ,
					        				'std' => '4',
                        					'reset_at_version' => '2.0',
					        				'args' => array(
					        					'type' => 'number'
					        				)
					        			),
                                	)
                                ),
                                'author'   => array(
                                	'label' 	=> __('Author Box', 'best' ),
                                	'subfields'	=> array(
                            			array(
											'id' => 'mts_author_box_mail',
											'type' => 'button_set',
											'title' => __('Email Author Link', 'best'), 
											'options' => array('0' => __('Off', 'best'), '1' => __('On', 'best') ),
											'sub_desc' => __('Use this button to Show or Hide <strong>Email Author</strong> link.', 'best'),
											'std' => '1',
                        					'reset_at_version' => '2.0'
										),
                                	)
                                ),
                            ),
                            'disabled' => array(
                            	'tags'   => array(
                                	'label' 	=> __('Tags', 'best' ),
                                	'subfields'	=> array(
                                	)
                                ),
                            )
                        )
                    ),
					array(
	                    'id'       => 'mts_single_headline_meta_info',
	                    'type'     => 'layout',
	                    'title'    => __('Meta Info to Show', 'best' ),
	                    'sub_desc' => __('Organize how you want the post meta info to appear', 'best' ),
	                    'options'  => array(
	                        'enabled'  => array(
	                            'category' => __('Categories', 'best' ),
	                        	'date'     => __('Date', 'best' ),
	                        	'comment'  => __('Comment Count', 'best' ),
	                            'author'   => __('Author Name', 'best' ),
	                            'tags'	   => __( 'Tags', 'best' )
	                        ),
	                        'disabled' => array(
	                        )
	                    ),
	                    'std'  => array(
	                        'enabled'  => array(
	                        	'category' => __('Categories', 'best' ),
	                        	'date'     => __('Date', 'best' ),
	                        	'comment'  => __('Comment Count', 'best' ),
	                            'author'   => __('Author Name', 'best' ),
	                            'tags'	   => __( 'Tags', 'best' )
	                        ),
	                        'disabled' => array(
	                        )
	                    ),
	                    'reset_at_version' => '2.0'
	                ),
					array(
						'id' => 'mts_breadcrumb',
						'type' => 'button_set',
						'title' => __('Breadcrumbs', 'best'), 
						'options' => array('0' => __('Off', 'best'), '1' => __('On', 'best') ),
						'sub_desc' => __('Breadcrumbs are a great way to make your site more user-friendly. You can enable them by checking this box.', 'best'),
						'std' => '1'
						),
					array(
						'id' => 'mts_author_comment',
						'type' => 'button_set',
						'title' => __('Highlight Author Comment', 'best'), 
						'options' => array('0' => __('Off', 'best'), '1' => __('On', 'best') ),
						'sub_desc' => __('Use this button to highlight author comments.', 'best'),
						'std' => '1'
						),
					array(
						'id' => 'mts_comment_date',
						'type' => 'button_set',
						'title' => __('Date in Comments', 'best'), 
						'options' => array('0' => __('Off', 'best'), '1' => __('On', 'best') ),
						'sub_desc' => __('Use this button to show the date for comments.', 'best'),
						'std' => '1'
						),
					)
				);
$sections[] = array(
				'icon' => 'fa fa-group',
				'title' => __('Social Buttons', 'best' ),
				'desc' => '<p class="description">' . __('Enable or disable social sharing buttons on single posts using these buttons.', 'best' ) . '</p>',
				'fields' => array(
					array(
						'id' => 'mts_social_button_position',
						'type' => 'button_set',
						'title' => __('Social Sharing Buttons Position', 'best' ),
						'options' => array('top' => __('Above Content', 'best' ), 'bottom' => __('Below Content', 'best' ), 'floating' => __('Floating', 'best' )),
						'sub_desc' => __('Choose position for Social Sharing Buttons.', 'best' ),
						'std' => 'floating',
						'class' => 'green',
						'reset_at_version' => '2.0'
					),
					array(
						'id' => 'mts_social_buttons_on_pages',
						'type' => 'button_set',
						'title' => __('Social Sharing Buttons on Pages', 'best' ),
						'options' => array('0' => __('Off', 'best' ), '1' => __('On', 'best' )),
						'sub_desc' => __('Enable the sharing buttons for pages too, not just posts.', 'best' ),
						'std' => '0',
						'reset_at_version' => '2.0'
					),
					array(
                        'id'       => 'mts_social_buttons',
                        'type'     => 'layout',
                        'title'    => __('Social Media Buttons', 'best' ),
                        'sub_desc' => __('Organize how you want the social sharing buttons to appear on single posts', 'best' ),
                        'options'  => array(
                            'enabled'  => array(
                            	'facebookshare'   => __('Facebook Share', 'best' ),
                            	'facebook'  => __('Facebook Like', 'best' ),
                                'twitter'   => __('Twitter', 'best' ),
                                'gplus'     => __('Google Plus', 'best' ),
                                'pinterest' => __('Pinterest', 'best' ),
                            ),
                            'disabled' => array(
                            	'linkedin'  => __('LinkedIn', 'best' ),
                                'stumble'   => __('StumbleUpon', 'best' ),
                            )
                        ),
                        'std'  => array(
                            'enabled'  => array(
                            	'facebookshare'   => __('Facebook Share', 'best' ),
                            	'facebook'  => __('Facebook Like', 'best' ),
                                'twitter'   => __('Twitter', 'best' ),
                                'gplus'     => __('Google Plus', 'best' ),
                                'pinterest' => __('Pinterest', 'best' ),
                            ),
                            'disabled' => array(
                            	'linkedin'  => __('LinkedIn', 'best' ),
                                'stumble'   => __('StumbleUpon', 'best' ),
                            )
                        ),
						'reset_at_version' => '2.0'
                    ),
				)
			);
$sections[] = array(
				'icon' => 'fa fa-bar-chart-o',
				'title' => __('Ad Management', 'best'),
				'desc' => '<p class="description">' . __('Now, ad management is easy with our options panel. You can control everything from here, without using separate plugins.', 'best') . '</p>',
				'fields' => array(
					array(
						'id' => 'mts_posttop_adcode',
						'type' => 'textarea',
						'title' => __('Below Post Title', 'best'), 
						'sub_desc' => __('Paste your Adsense, BSA or other ad code here to show ads below your article title on single posts.', 'best')
						),
					array(
						'id' => 'mts_posttop_adcode_time',
						'type' => 'text',
						'title' => __('Show After X Days', 'best'), 
						'sub_desc' => __('Enter the number of days after which you want to show the Below Post Title Ad before it expires. Enter 0 to disable this feature.', 'best'),
						'validate' => 'numeric',
						'std' => '0',
						'class' => 'small-text',
                        'args' => array('type' => 'number')
						),
					array(
						'id' => 'mts_postend_adcode',
						'type' => 'textarea',
						'title' => __('Below Post Content', 'best'), 
						'sub_desc' => __('Paste your Adsense, BSA or other ad code here to show ads below the post content on single posts.', 'best')
						),
					array(
						'id' => 'mts_postend_adcode_time',
						'type' => 'text',
						'title' => __('Show After X Days', 'best'), 
						'sub_desc' => __('Enter the number of days after which you want to show the Below Post Title Ad before it expires. Enter 0 to disable this feature.', 'best'),
						'validate' => 'numeric',
						'std' => '0',
						'class' => 'small-text',
                        'args' => array('type' => 'number')
						),
					)
				);
$sections[] = array(
				'icon' => 'fa fa-columns',
				'title' => __('Sidebars', 'best'),
				'desc' => '<p class="description">' . __('Now you have full control over the sidebars. Here you can manage sidebars and select one for each section of your site, or select a custom sidebar on a per-post basis in the post editor.', 'best') . '</p>',
                'fields' => array(
                    array(
                        'id'        => 'mts_custom_sidebars',
                        'type'      => 'group', //doesn't need to be called for callback fields
                        'title'     => __('Custom Sidebars', 'best'), 
                        'sub_desc'  => wp_kses_post( __('Add custom sidebars. <strong style="font-weight: 800;">You need to save the changes to use the sidebars in the dropdowns below.</strong><br />You can add content to the sidebars in Appearance &gt; Widgets.', 'best' ) ),
                        'groupname' => __('Sidebar', 'best'), // Group name
                        'subfields' => 
                            array(
                                array(
                                    'id' => 'mts_custom_sidebar_name',
            						'type' => 'text',
            						'title' => __('Name', 'best'), 
            						'sub_desc' => __('Example: Homepage Sidebar', 'best')
            						),	
                                array(
                                    'id' => 'mts_custom_sidebar_id',
            						'type' => 'text',
            						'title' => __('ID', 'best'), 
            						'sub_desc' => __('Enter a unique ID for the sidebar. Use only alphanumeric characters, underscores (_) and dashes (-), eg. "sidebar-home"', 'best'),
            						'std' => 'sidebar-'
            						),
                            ),
                        ),
                    array(
						'id' => 'mts_sidebar_for_home',
						'type' => 'sidebars_select',
						'title' => __('Homepage', 'best'), 
						'sub_desc' => __('Select a sidebar for the homepage.', 'best'),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'widget-header', 'shop-sidebar', 'product-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_post',
						'type' => 'sidebars_select',
						'title' => __('Single post', 'best'), 
						'sub_desc' => __('Select a sidebar for the single posts. If a post has a custom sidebar set, it will override this.', 'best'),
                        'args' => array('exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'widget-header', 'shop-sidebar', 'product-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_page',
						'type' => 'sidebars_select',
						'title' => __('Single page', 'best'), 
						'sub_desc' => __('Select a sidebar for the single pages. If a page has a custom sidebar set, it will override this.', 'best'),
                        'args' => array('exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'widget-header', 'shop-sidebar', 'product-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_archive',
						'type' => 'sidebars_select',
						'title' => __('Archive', 'best'), 
						'sub_desc' => __('Select a sidebar for the archives. Specific archive sidebars will override this setting (see below).', 'best'),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'widget-header', 'shop-sidebar', 'product-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_category',
						'type' => 'sidebars_select',
						'title' => __('Category Archive', 'best'), 
						'sub_desc' => __('Select a sidebar for the category archives.', 'best'),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'widget-header', 'shop-sidebar', 'product-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_tag',
						'type' => 'sidebars_select',
						'title' => __('Tag Archive', 'best'), 
						'sub_desc' => __('Select a sidebar for the tag archives.', 'best'),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'widget-header', 'shop-sidebar', 'product-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_date',
						'type' => 'sidebars_select',
						'title' => __('Date Archive', 'best'), 
						'sub_desc' => __('Select a sidebar for the date archives.', 'best'),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'widget-header', 'shop-sidebar', 'product-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_author',
						'type' => 'sidebars_select',
						'title' => __('Author Archive', 'best'), 
						'sub_desc' => __('Select a sidebar for the author archives.', 'best'),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'widget-header', 'shop-sidebar', 'product-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_search',
						'type' => 'sidebars_select',
						'title' => __('Search', 'best'), 
						'sub_desc' => __('Select a sidebar for the search results.', 'best'),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'widget-header', 'shop-sidebar', 'product-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_notfound',
						'type' => 'sidebars_select',
						'title' => __('404 Error', 'best'), 
						'sub_desc' => __('Select a sidebar for the 404 Not found pages.', 'best'),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'widget-header', 'shop-sidebar', 'product-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_shop',
						'type' => 'sidebars_select',
						'title' => __('Shop Pages', 'best' ),
						'sub_desc' => wp_kses_post( __('Select a sidebar for Shop main page and product archive pages (WooCommerce plugin must be enabled). Default is <strong>Shop Page Sidebar</strong>.', 'best' ) ),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'widget-header','shop-sidebar', 'product-sidebar')),
                        'std' => 'shop-sidebar'
						),
                    array(
						'id' => 'mts_sidebar_for_product',
						'type' => 'sidebars_select',
						'title' => __('Single Product', 'best' ),
						'sub_desc' => wp_kses_post( __('Select a sidebar for single products (WooCommerce plugin must be enabled). Default is <strong>Single Product Sidebar</strong>.', 'best' ) ),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'widget-header','shop-sidebar', 'product-sidebar')),
                        'std' => 'product-sidebar'
						),
                    ),
				);
//$sections[] = array(
//				'icon' => NHP_OPTIONS_URL.'img/glyphicons/fontsetting.png',
//				'title' => __('Fonts', 'best'),
//				'desc' => __('<p class="description"><div class="controls">You can find theme font options under the Appearance Section named <a href="themes.php?page=typography"><b>Theme Typography</b></a>, which will allow you to configure the typography used on your site.<br></div></p>', 'best'),
//				);
$sections[] = array(
	'icon' => 'fa fa-list-alt',
	'title' => __('Navigation', 'MTSTHEMENAME' ),
	'desc' => '<p class="description"><div class="controls">' . sprintf( __('Navigation settings can now be modified from the %s.', 'MTSTHEMENAME' ), '<a href="nav-menus.php"><b>' . __( 'Menus Section', 'MTSTHEMENAME' ) . '</b></a>' ) . '<br></div></p>'
);
				
				
	$tabs = array();

	$args['presets'] = array();
	include('theme-presets.php');

	global $NHP_Options;
	$NHP_Options = new NHP_Options($sections, $args, $tabs);

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value){
	print_r($field);
	print_r($value);

}//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;
	$value =  'just testing';
	/*
	do your validation
	
	if(something){
		$value = $value;
	}elseif(somthing else){
		$error = true;
		$value = $existing_value;
		$field['msg'] = 'your custom error message';
	}
	*/
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}//function

/*--------------------------------------------------------------------
 * 
 * Default Font Settings
 *
 --------------------------------------------------------------------*/
if(function_exists('mts_register_typography')) { 
  mts_register_typography(array(
  	'logo_font' => array(
      'preview_text' => 'Logo',
      'preview_color' => 'light',
      'font_family' => 'Roboto',
      'font_variant' => '700',
      'font_size' => '36px',
      'font_color' => '#3498db',
      'css_selectors' => '#logo a',
      'additional_css' => 'text-transform: uppercase;'
    ),
    'navigation_font' => array(
      'preview_text' => 'Navigation Font',
      'preview_color' => 'dark',
      'font_family' => 'Roboto',
      'font_variant' => 'normal',
      'font_size' => '15px',
      'font_color' => '#FFFFFF',
      'css_selectors' => '#navigation .menu li, #navigation .menu li a'
    ),
    'content_font' => array(
      'preview_text' => 'Content Font',
      'preview_color' => 'light',
      'font_family' => 'Roboto',
      'font_size' => '15px',
	  'font_variant' => 'normal',
      'font_color' => '#444444',
      'css_selectors' => 'body'
    ),
	'post_box_title' => array(
      'preview_text' => 'Homepage Article Title',
      'preview_color' => 'light',
      'font_family' => 'Roboto',
      'font_variant' => '700',
      'font_size' => '16px',
      'font_color' => '#444444',
      'css_selectors' => '.post-data .post-title a, #comments-tab-content a',
      'additional_css' => 'text-transform: uppercase;'
    ),
    'single_post_title' => array(
      'preview_text' => 'Single Post Title',
      'preview_color' => 'light',
      'font_family' => 'Roboto',
      'font_variant' => '700',
      'font_size' => '25px',
      'font_color' => '#444444',
      'css_selectors' => '.hentry .entry-title',
      'additional_css' => 'text-transform: uppercase;'
    ),
	'sidebar_font' => array(
      'preview_text' => 'Sidebar Font',
      'preview_color' => 'light',
      'font_family' => 'Roboto',
      'font_variant' => 'normal',
      'font_size' => '15px',
      'font_color' => '#444444',
      'css_selectors' => '#sidebars .widget'
    ),
	'footer_font' => array(
      'preview_text' => 'Footer Font',
      'preview_color' => 'light',
      'font_family' => 'Roboto',
      'font_variant' => 'normal',
      'font_size' => '15px',
      'font_color' => '#444444',
      'css_selectors' => '.footer-widgets, #site-footer'
    ),
    'h1_headline' => array(
      'preview_text' => 'H1 Headline',
      'preview_color' => 'light',
      'font_family' => 'Roboto',
      'font_variant' => '700',
      'font_size' => '30px',
      'font_color' => '#444444',
      'css_selectors' => 'h1',
      'additional_css' => 'text-transform: uppercase;'
    ),
	'h2_headline' => array(
      'preview_text' => 'H2 Headline',
      'preview_color' => 'light',
      'font_family' => 'Roboto',
      'font_variant' => '700',
      'font_size' => '25px',
      'font_color' => '#444444',
      'css_selectors' => 'h2',
      'additional_css' => 'text-transform: uppercase;'
    ),
	'h3_headline' => array(
      'preview_text' => 'H3 Headline',
      'preview_color' => 'light',
      'font_family' => 'Roboto',
      'font_variant' => '700',
      'font_size' => '20px',
      'font_color' => '#444444',
      'css_selectors' => 'h3',
      'additional_css' => 'text-transform: uppercase;'
    ),
	'h4_headline' => array(
      'preview_text' => 'H4 Headline',
      'preview_color' => 'light',
      'font_family' => 'Roboto',
      'font_variant' => '700',
      'font_size' => '18px',
      'font_color' => '#444444',
      'css_selectors' => 'h4',
      'additional_css' => 'text-transform: uppercase;'
    ),
	'h5_headline' => array(
      'preview_text' => 'H5 Headline',
      'preview_color' => 'light',
      'font_family' => 'Roboto',
      'font_variant' => '700',
      'font_size' => '15px',
      'font_color' => '#444444',
      'css_selectors' => 'h5',
      'additional_css' => 'text-transform: uppercase;'
    ),
	'h6_headline' => array(
      'preview_text' => 'H6 Headline',
      'preview_color' => 'light',
      'font_family' => 'Roboto',
      'font_variant' => '700',
      'font_size' => '13px',
      'font_color' => '#444444',
      'css_selectors' => 'h6',
      'additional_css' => 'text-transform: uppercase;'
    ),
  ));
}

?>
