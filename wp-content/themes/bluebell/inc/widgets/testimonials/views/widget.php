<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * @var string $before_widget
 * @var string $after_widget
 * @var string $title
 * @var string $id
 */
$tes_id = explode(';', $id);
echo wp_kses_post($before_widget );
echo wp_kses_post($title);
    echo '<div class="services-testimonials">';
    foreach($tes_id as $key):
		$post = get_post($key);
		$rating = fw_get_db_post_option($key, 'rating');
		$name = fw_get_db_post_option($key, 'name');
		$position = fw_get_db_post_option($key, 'position');
?>
	<div class="services-testimonials-item">
		<div class="services-tes-rate">
			<?php topseo_testimonial_rating($rating); ?>
		</div>
		<h3 class="services-tes-title"><?php echo esc_html($name); ?></h3>
		<p class="services-tes-desc"><?php echo wp_kses_post($post->post_content); ?></p>
		<h4 class="services-tes-author"><?php echo esc_html($position); ?></h4>
	</div>
<?php
	endforeach;
    echo '</div>';
echo wp_kses_post($after_widget);