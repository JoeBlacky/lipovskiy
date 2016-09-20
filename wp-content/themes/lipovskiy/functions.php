<?php
/**
 * Lipovskiy functions and definitions.
 *
 *
 * @package Lipovskiy
 */
/* Common theme setup ======================================================= */
	if (!function_exists( 'lipovskiy_setup' )) :

		function lipovskiy_setup() {
			add_theme_support('title-tag');
			add_theme_support('post-thumbnails');
			add_theme_support('excerpt');

			add_post_type_support('page', array('excerpt'));

			register_nav_menus(array(
				'primary' => esc_html__( 'Primary', 'lipovskiy' ),
			));
		}

	endif;

	add_action('after_setup_theme', 'lipovskiy_setup');
/* Add fields to admin settings page ======================================== */
	function addCustomSettings(){
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
				'createSettingsField',
				'general',
				'default',
				array(
					'id' => $code,
					'option_name' => $code
				)
			);
		}
	}
	add_action('admin_menu', 'addCustomSettings');

	function createSettingsField($val){
		$id = $val['id'];
		$option_name = $val['option_name'];
		?>
		<input type="text"
			   name="<?php echo $option_name; ?>"
			   id="<?php echo $id; ?>"
			   value="<?php echo esc_attr( get_option($option_name) ); ?>" />
		<?php
	}
/* Adding field to admin customizer ========================================= */
	function lipovskiyThemeCustomizer($wp_customize){
		$wp_customize->add_section('themeslug_logo_section', array(
			'title'       => __('Logo', 'themeslug'),
			'priority'    => 30,
			'description' => 'Upload a logo image.',
		));

		$wp_customize->add_setting( 'themeslug_logo' );

		$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'themeslug_logo', array(
			'label'    => __('Logo', 'themeslug'),
			'section'  => 'themeslug_logo_section',
			'settings' => 'themeslug_logo',
		)));
	}

	add_action('customize_register', 'lipovskiyThemeCustomizer');

	require get_template_directory() . '/inc/customizer.php';
/* Enqueue scripts and styles =============================================== */
	function themeAssets() {
		wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/dev/main.js', array(), null, true );

		//wp_enqueue_script('gmap-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAmgxRDjSbPmooKiBhBjJlpPEaKqI62U8I', array(), '', true );

		wp_register_style('main-css', get_template_directory_uri() . '/assets/css/main.css', array(), null, 'all');
	  wp_enqueue_style('main-css');

	  wp_deregister_script('wp-embed');
	}
	add_action('wp_enqueue_scripts', 'themeAssets');
/* Disable WP embeds ======================================================== */
	function disableEmbeds(){
	  remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
	  remove_action('rest_api_init', 'wp_oembed_register_route');
	  remove_action('wp_head', 'wp_oembed_add_discovery_links');
	  remove_action('wp_head', 'wp_oembed_add_host_js');
	  remove_action( 'wp_head', 'rest_output_link_wp_head', 10);
	}
/* Disable WP emoji ========================================================= */
	function disableEmoji(){
	  remove_action( 'admin_print_styles', 'print_emoji_styles' );
	  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	  remove_action( 'wp_print_styles', 'print_emoji_styles' );
	  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
	}
/* Removing unnecessary ===================================================== */
	function clearUnnecessary(){
		disableEmbeds();
		disableEmoji();
	}
	add_action('init', 'clearUnnecessary', 9999);
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
/* Breadcrumbs ============================================================== */
	function breadcrumbs() {
		echo '<ul class="mw flex b-crumbs">';
		if (!is_home()) {
			echo '<li class="crumb"><a href="';
			echo get_bloginfo('url');
			echo '">';
			echo get_the_title(get_option('page_on_front'));
			echo "</a></li>";
			if (is_category() || is_single()) {
				echo '<li class="crumb">';
				the_category(' </li><li> ');
				if (is_single()) {
					echo '</li><li class="crumb">';
					the_title();
					echo '</li>';
				}
			} elseif (is_page()) {
				echo '<li class="crumb">';
				echo the_title();
				echo '</li>';
			}
		}
		echo '</ul>';
	}
/* ========================================================================== */