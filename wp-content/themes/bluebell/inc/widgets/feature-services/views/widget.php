<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * @var string $before_widget
 * @var string $after_widget
 * @var string $title
 * @var string $id
 */
$services_id = explode(';', $id);
echo wp_kses_post($before_widget );
echo wp_kses_post($title);
    echo '<div class="services-features flw">';
    foreach($services_id as $key):
		$post = get_post($key);
		$url = get_permalink($key);
		$thumbnail = wp_get_attachment_url(get_post_thumbnail_id($key));
?>
		<div class="features-services-item">
			<div class="features-services-img">
				<img src="<?php echo esc_url($thumbnail); ?>" alt="<?php esc_attr_e('Image', 'topseo'); ?>">
			</div>
			<h3><a href="<?php echo esc_url($url); ?>"><?php echo esc_html($post->post_title); ?></a></h3>
		</div>
<?php
	endforeach;
    echo '</div>';
echo wp_kses_post($after_widget);