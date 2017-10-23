<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * @var string $before_widget
 * @var string $after_widget
 * @var string $title
 * @var string $number
 */

echo wp_kses_post($before_widget );
echo wp_kses_post($title);
$query = new WP_Query('post_type=post&post_status=publish&ignore_sticky_posts=true&posts_per_page='.$number);
if( $query->have_posts() ):
    echo '<dl class="footer-popular-post">';
    while($query->have_posts()): $query->the_post(); ?>
	<dt><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dt>
	<dd><?php echo get_the_date(); ?></dd>
<?php endwhile;
echo '</dl>';
endif;
wp_reset_postdata();
echo wp_kses_post($after_widget);