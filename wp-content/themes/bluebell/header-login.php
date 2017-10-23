<?php
/**
 * The header for our theme.
 * Displays all of the <head> section
 * @package consult
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="bluebell-wrap">
		<div class="menu-mobile">
			<button class="btn-left-sidebar">
				<span></span>
				<span></span>
				<span></span>
			</button>
		</div>
		<div class="left-sidebar">
			<div class="lg">
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<img src="<?php echo get_template_directory_uri() . '/images/primary-lg.png'; ?>">
				</a>
			</div>
			<div class="menu-box">
				<?php
					if(has_nav_menu('login')){
		                wp_nav_menu( array( 'theme_location' => 'login', 'menu_class' => 'bluebell-primary-menu' ) );
		            }
				?>
			</div>
			<div class="sidebar-bottom">
				<div class="copy-right">
					© 2016 <a href="#">Bluebell Retail Academy.</a> <br>
					All Rights Reserved.
				</div>
			</div>
		</div>