<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/**
 * @var $number
 * @var $before_widget
 * @var $after_widget
 * @var $title
 * @var $tweets
 */

echo wp_kses_post($before_widget );
echo wp_kses_post($title);
?>
	<ul class="wrap-twitter">
		<?php
			foreach ( $tweets as $tweet ) {
				echo '<li>'
				.'<p>' . $tweet->text . '</p>'
				.'<a href="http://twitter.com/' . $tweet->user->screen_name . '">http://twitter.com/'. $tweet->user->screen_name . '</a>'
				.'<span>'.$created = date('F j, Y', strtotime($tweet->created_at)).'</span>'
				.'</li>';
			}
		?>
	</ul>
	<a href="http://twitter.com/_thaotn/" class="tweet-view-all"><?php esc_html_e('view all tweets >', 'topseo'); ?></a>
<?php echo wp_kses_post($after_widget); ?>