<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

class Topseo_Widget_Testimonials extends WP_Widget {

    /**
     * @internal
     */
    function __construct() {
        $widget_ops = array(
            'description' => esc_html__('Testimonials', 'consult'),
            'classname' => 'widget_testimonials'
        );
        parent::__construct( false, esc_html__( 'Testimonials posts', 'consult'), $widget_ops );
    }

    /**
     * @param array $args
     * @param array $instance
     */
    function widget( $args, $instance ) {
        extract( $args );
        $title     = esc_attr( $instance['title'] );
        $title = $before_title.$title.$after_title;
        $id     = esc_attr( $instance['id'] );
        $filepath = get_template_directory().'/inc/widgets/testimonials/views/widget.php';
        if ( file_exists( $filepath ) ) {
            include( $filepath );
        }
    }

    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'id' => '', 'title' => esc_html__('TESTIMONIALS', 'topseo') ) );
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title', 'topseo'); ?> </label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>"
                   value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat"
                   id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'id' )); ?>"><?php esc_html_e( 'ID of posts', 'topseo'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name( 'id' )); ?>"
                   value="<?php echo esc_attr( $instance['id'] ); ?>" class="widefat"
                   id="<?php echo esc_attr($this->get_field_id( 'id' )); ?>"/>
        </p>
    <?php
    }
}
