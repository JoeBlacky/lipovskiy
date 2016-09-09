<?php
/**
 * Lipovskiy functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Lipovskiy
 */

if ( ! function_exists( 'lipovskiy_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function lipovskiy_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Creative Seo, use a find and replace
	 * to change 'lipovskiy' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'lipovskiy', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'excerpt' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'lipovskiy' ),
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'lipovskiy_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'lipovskiy_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lipovskiy_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lipovskiy_content_width', 640 );
}
add_action( 'after_setup_theme', 'lipovskiy_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lipovskiy_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'lipovskiy' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'lipovskiy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar(array(
		'name' => __('Footer', 'lipovskiy'),
		'description'   => __('Footer Sidebar', 'lipovskiy'),
		'id'            => 'footer-sidebar',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
}
add_action( 'widgets_init', 'lipovskiy_widgets_init' );

/**
 * Add fields to admin settings page
 */
function add_custom_settings_to_general_page(){
	$fields = array(
		'address' 			=> 'Address',
		'opening_hours' => 'Opening Hours',
		'phone_number'  => 'Phone Number',
		'contact_email' => 'Contact Email'
	);
	foreach ($fields as $code => $label) {
		register_setting( 'general', $code );
		add_settings_field(
			$code,
			$label,
			'new_settings_field_callback',
			'general',
			'default',
			array(
				'id' => $code,
				'option_name' => $code
			)
		);
	}
}
add_action('admin_menu', 'add_custom_settings_to_general_page');

function new_settings_field_callback( $val ){
	$id = $val['id'];
	$option_name = $val['option_name'];
	?>
	<input type="text"
		   name="<?php echo $option_name; ?>"
		   id="<?php echo $id; ?>"
		   value="<?php echo esc_attr( get_option($option_name) ); ?>" />
	<?php
}
/* Add excerpts to page ===================================================== */
	function addPageExcerpt() {
	    add_post_type_support('page', array('excerpt'));
	}
	add_action('init', 'addPageExcerpt');
/* Add excerpts to page ===================================================== */
/**
 * Enqueue scripts and styles.
 */


function lip_assets() {
	wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/main.js', array(), '', true );

	wp_enqueue_script('gmap-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAmgxRDjSbPmooKiBhBjJlpPEaKqI62U8I', array(), '', true );

	wp_register_style('main-css', get_template_directory_uri() . '/assets/css/main.css', array(), 'all');
  wp_enqueue_style('main-css');
}
add_action('wp_enqueue_scripts', 'lip_assets');

/* Adding field to admin customizer ========================================= */
function lipovskiyThemeCustomizer($wp_customize){
	$wp_customize->add_section( 'themeslug_logo_section' , array(
		'title'       => __( 'Logo', 'themeslug' ),
		'priority'    => 30,
		'description' => 'Upload a logo image.',
	));

	$wp_customize->add_setting( 'themeslug_logo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
		'label'    => __('Logo', 'themeslug'),
		'section'  => 'themeslug_logo_section',
		'settings' => 'themeslug_logo',
	)));
}
add_action( 'customize_register', 'lipovskiyThemeCustomizer' );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/* Custom String Length ===================================================== */
	function customStringLength($srting, $length){
	  $stringLength = strlen($srting);

	  if ($stringLength > $length) {
	    return substr($srting, 0, $length) . '...';
	  }
	  else {
	    return $srting;
	  }
	}
/* Custom Post Listing ====================================================== */
	function customPostListing($postType, $showPerPage = '-1', $category = '') {
	  $args = array(
      'post_type'      => $postType,
      'post_status'    => 'publish',
      'post__not_in'   => array(get_post()->ID),
      'posts_per_page' => $showPerPage,
      'category_name'  => $category
	  );
	  $postList = new WP_Query($args);
    return $postList;
  }
/* Posts by category ======================================================== */
	function getCategoryPosts($postType, $showPerPage = -1, $category){
		$args = array(
      'post_type'      => $postType,
      'post_status'    => 'publish',
      'post__not_in'   => array(get_post()->ID),
      'posts_per_page' => $showPerPage,
      'category_name'  => $category
	  );

	  $postList = get_posts($args);
    return $postList;
	}
/* Custom Placeholder ======================================================= */
	function getPlaceholder() {
		$themePath   = get_template_directory_uri();
		$assetsPath  = '/assets/img/';
		$largeImage  = 'placeholder.png';
		$smallImage  = 'placeholder-small.png';
		$postType    = get_post_type();

		if ($postType == 'works'){
			$placeholder = $themePath . $assetsPath . $smallImage;
		} else {
			$placeholder = $themePath . $assetsPath . $largeImage;
		}

		return $placeholder;
	}
/* Additional Block ========================================================= */
	function getAdditionalBlock($name){
		if(post_type_exists('additional')){
			$post = get_posts(array(
				'name' => $name,
				'post_type' => 'additional'
			));
		  return array_shift($post) ?: null;
		}

		return null;
	}
/* Allowing .SVG to be uploaded ============================================= */
  function customMimeTypes($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter('upload_mimes', 'customMimeTypes');
/* ========================================================================== */
	function getFirstParagraph($content) {
    $str = wpautop($content);
    $str = substr( $str, 0, strpos( $str, '</p>' ) + 4 );
    $str = strip_tags($str, '<a><strong><em>');

    return '<p>' . $str . '</p>';
	}