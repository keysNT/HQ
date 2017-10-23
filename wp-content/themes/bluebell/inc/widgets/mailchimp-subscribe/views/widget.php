<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/**
 * @var $number
 * @var $before_widget
 * @var $after_widget
 * @var $title
 * @var $flickr_id
 */

echo wp_kses_post($before_widget);
echo wp_kses_post($title); ?>
<div class="footer-email-widget flw">
	<form action="<?php echo esc_url($form_action) ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="footer-email-form flw">
		<label for="mce-NAME" class="footer-name-label flw wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
			<input type="text" placeholder="<?php esc_attr_e('Your name', 'consult'); ?>" name="NAME" id="mce-NAME" required>
		</label>
		<label for="mce-EMAIL" class="footer-email-label flw wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
			<input type="email" placeholder="<?php esc_attr_e('E-mail', 'consult'); ?>" name="EMAIL" id="mce-EMAIL" required>
		</label>
		<button id="mc-embedded-subscribe" type="submit" name="subscribe" class="footer-email-submit flw wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;"><?php esc_html_e('Subscribe us', 'consult' ); ?></button>
	</form>
	<p><?php echo esc_html('* We never spam your E-mail', 'consult'); ?></p>
</div>
<?php echo wp_kses_post($after_widget); ?>