<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

class Topseo_Widget_Feature_Services extends WP_Widget {

    /**
     * @internal
     */
    function __construct() {
        $widget_ops = array(
            'description' => esc_html__('Feature services detail page', 'consult'),
            'classname' => 'widget_feature_services'
        );
        parent::__construct( false, esc_html__( 'Feature Services', 'consult'), $widget_ops );
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

        $filepath = get_template_directory().'/inc/widgets/feature-services/views/widget.php';
        if ( file_exists( $filepath ) ) {
            include( $filepath );
        }
    }

    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'id' => '', 'title' => esc_html__('FEATURE SERVICES', 'topseo') ) );
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
