<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php	wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="page flex not-handheld">
	<header class="header" id="header">
    <div class="links header-info-bar">
      <ul class="mw flex">
      	<?php if(get_option('address')): ?>
      		<li>
	          <span class="link i-link icn pin scroll">
	          	<?php echo get_option('address'); ?>
          	</span>
	        </li>
				<?php endif; ?>
				<?php if(get_option('opening_hours')): ?>
      		<li>
	          <span class="link i-link icn time scroll">
	          	<?php echo get_option('opening_hours'); ?>
	          </span>
	        </li>
				<?php endif; ?>
				<?php if(get_option('phone_number')):?>
					<li>
	          <a href="tel:<?php echo urlencode(get_option('phone_number')); ?>" class="i-link link icn phone">
	          	<?php echo get_option('phone_number'); ?>
          	</a>
	        </li>
				<?php endif; ?>
      </ul>
    </div>
    <div class="header-main-bar">
      <div class="mw flex">
      	<?php if (get_theme_mod('themeslug_logo')): ?>
					<a href='<?php echo esc_url(home_url( '/' )); ?>' class="logo flex" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
						<img src='<?php echo esc_url(get_theme_mod('themeslug_logo')); ?>' alt='<?php echo esc_attr(get_bloginfo('name', 'display')); ?>' width="50" height="50" />
						<span>
	            <small>Стоматологическая студия</small>
	            Доктора Липовского
	          </span>
					</a>
				<?php endif; ?>
        <div class="nav-wrapper">
          <span class="item-trigger icn menu" data-trigger="menu-primary"></span>
          <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class'=> 'flex main-nav')); ?>
        </div>
      </div>
    </div>
  </header>
	<main class="main">