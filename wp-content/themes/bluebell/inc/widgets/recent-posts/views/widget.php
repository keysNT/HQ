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
    echo '<div class="widget_recent_entries flw">';
        echo '<ul>';
    while($query->have_posts()): $query->the_post();
?>
        <li>
            <div class="blog-recent-img">
	             <a href="<?php the_permalink(); ?>">
	             	<?php
	                    if(has_post_thumbnail()){
	                        the_post_thumbnail(
	                            array(100,100, true),
	                            array('alt' => get_the_title())
	                        );
	                    }else{
	                    	echo '<img height="90" width="100" alt="'. get_the_title() .'" src="'. get_template_directory_uri().'/images/thumbnail-default.jpg' .'">';
	                    }
	                ?>
	             </a>
            </div>
            <dl>
				<dt><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dt>
				<dd><?php echo get_the_date(); ?></dd>
			</dl>
        </li>
<?php
    endwhile;
        echo '</ul>';
    echo '</div>';
endif;
wp_reset_postdata();
echo wp_kses_post($after_widget);