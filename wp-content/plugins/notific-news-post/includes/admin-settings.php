<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class ADMIN_SETTINGS{
    public function __construct(){

    }
    public function index(){
        if(isset($_POST['btnSubmit'])){
            global $wpdb;
            $number_date = isset($_POST['date'])?$_POST['date']:5;
            update_option('numberdate',$number_date);

            $postTbl = $wpdb->prefix.'posts';
            $string = '';
            $today = new DateTime();
            $toDay = $today->format('Y-m-d');
            $sql = "SELECT ID FROM $postTbl WHERE DATE_FORMAT(post_modified, '%Y-%m-%d') >= DATE_SUB('$toDay', INTERVAL $number_date DAY) AND ID IN ( SELECT ID FROM $postTbl WHERE `post_type` = 'page' OR `post_type` = 'post')";
            $results = $wpdb->get_results($sql, ARRAY_A);
            foreach ($results as $result){
                $string .= $result['ID'].' ';
            }
            $users = get_users( array( 'fields' => array( 'ID' ) ) );
            foreach ($users as $user){
                update_user_meta($user->ID, 'post_id_seen', $string);
            }
	        echo 'data saved';
        }
        $number = get_option('numberdate');
?>
        <form method="post">
            <h2>a post will has new status within x days</h2>
            <input type="text" name="date" required value="<?= isset($number)?$number:''; ?>" style="text-align: center;"/>
            <input type="submit" name="btnSubmit" value="Save changes"/>
        </form>
<?php
    }
    public function save_post_publish_update($post_id){
        $data = array();
        $i = 0;
        $users = get_users(array( 'fields' => array( 'ID' )));
        $post_type = get_post_type($post_id);
        if($post_type == 'page'){
            foreach ($users as $user){
                $post_each_person = get_user_meta($user->ID,'page_id_seen');
                $strdata = explode(' ', $post_each_person[0]);
                $flag = true;
                foreach ($strdata as $str){
                    if($str == $post_id){
                        $flag = false;
                        break;
                    }
                }
                if($flag){
                    $post_each_person[0] .= ' '.$post_id;
                    update_user_meta($user->ID, 'page_id_seen', $post_each_person[0]);
                }
            }
        }elseif($post_type == 'post'){
            foreach ($users as $user){
                $post_each_person = get_user_meta($user->ID,'post_id_seen');
                $strdata = explode(' ', $post_each_person[0]);
                $flag = true;
                foreach ($strdata as $str){
                    if($str == $post_id){
                        $flag = false;
                        break;
                    }
                }
                if($flag){
                    $post_each_person[0] .= ' '.$post_id;
                    update_user_meta($user->ID, 'post_id_seen', $post_each_person[0]);
                }
            }
        }
    }
    public function insert_notific( $nav_menu, $args ){

        static $menu_id_slugs = array();

        $defaults = array( 'menu' => '', 'container' => 'div', 'container_class' => '', 'container_id' => '', 'menu_class' => 'menu', 'menu_id' => '',
            'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'item_spacing' => 'preserve',
            'depth' => 0, 'walker' => '', 'theme_location' => '' );

        $args = wp_parse_args( $args, $defaults );

        if ( ! in_array( $args['item_spacing'], array( 'preserve', 'discard' ), true ) ) {
            // invalid value, fall back to default.
            $args['item_spacing'] = $defaults['item_spacing'];
        }
        
        $args = apply_filters( 'wp_nav_menu_args', $args );
        $args = (object) $args;
        $nav_menu = apply_filters( 'pre_wp_nav_menu', null, $args );

        if ( null !== $nav_menu ) {
            if ( $args->echo ) {
                echo $nav_menu;
                return;
            }

            return $nav_menu;
        }

        // Get the nav menu based on the requested menu
        $menu = wp_get_nav_menu_object( $args->menu );

        // Get the nav menu based on the theme_location
        if ( ! $menu && $args->theme_location && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $args->theme_location ] ) )
            $menu = wp_get_nav_menu_object( $locations[ $args->theme_location ] );

        // get the first menu that has items if we still can't find a menu
        if ( ! $menu && !$args->theme_location ) {
            $menus = wp_get_nav_menus();
            foreach ( $menus as $menu_maybe ) {
                if ( $menu_items = wp_get_nav_menu_items( $menu_maybe->term_id, array( 'update_post_term_cache' => false ) ) ) {
                    $menu = $menu_maybe;
                    break;
                }
            }
        }

        if ( empty( $args->menu ) ) {
            $args->menu = $menu;
        }

        // If the menu exists, get its items.
        if ( $menu && ! is_wp_error($menu) && !isset($menu_items) )
            $menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'update_post_term_cache' => false ) );

        if ( ( !$menu || is_wp_error($menu) || ( isset($menu_items) && empty($menu_items) && !$args->theme_location ) )
            && isset( $args->fallback_cb ) && $args->fallback_cb && is_callable( $args->fallback_cb ) )
            return call_user_func( $args->fallback_cb, (array) $args );

        if ( ! $menu || is_wp_error( $menu ) )
            return false;

        $nav_menu = $items = '';

        $show_container = false;
        if ( $args->container ) {
            $allowed_tags = apply_filters( 'wp_nav_menu_container_allowedtags', array( 'div', 'nav' ) );
            if ( is_string( $args->container ) && in_array( $args->container, $allowed_tags ) ) {
                $show_container = true;
                $class = $args->container_class ? ' class="' . esc_attr( $args->container_class ) . '"' : ' class="menu-'. $menu->slug .'-container"';
                $id = $args->container_id ? ' id="' . esc_attr( $args->container_id ) . '"' : '';
                $nav_menu .= '<'. $args->container . $id . $class . '>';
            }
        }
        
        // Set up the $menu_item variables
        _wp_menu_item_classes_by_context( $menu_items );

        $sorted_menu_items = $menu_items_with_children = array();

        $number_date = get_option('numberdate');

        $number2 = 0;
        $count = 0;
        $form = "</a><ul class='notific_new'><li>The articles you haven't read</li>";
        if(isset($number_date)) {
            $posts = get_posts(array(
                'numberposts' => -1,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
                'date_query' => array(
                    'column' => 'post_modified',
                    'after' => '- ' . $number_date . ' days'  // -7 Means last 7 days
                )));
        }
        $user_id = get_current_user_id();
       // var_dump(count($posts));
        foreach ($posts as $post){
            $strdata = get_user_meta($user_id, 'post_id_seen');
            if(isset($strdata)){
                $data = explode(' ', $strdata[0]);
                foreach ($data as $value => $key){
                    if($key == $post->ID){
                        $count++;
                        //$postcat = get_the_category($post->ID);
                        //$post_term_id = $postcat[0]->term_id;
                        foreach ( (array) $menu_items as $menu_item ) {
                            //if($post_term_id == $menu_item->object_id){
                                // onclick='insertDatabase(".$post->ID.")'
				                //$url = get_permalink($post->ID);
                                $item = "<li class='items'><span style='display: none;' id='".$post->ID."'>".get_permalink($post->ID)."</span><a href='#'  onclick='insertDatabase(".$post->ID.")'>-> ".get_the_title($post->ID)."</a></li>";
                                $parent = 10;
                            //}
                        }
                        $form .= $item;
                    }
                }
            }
        }
        $form .= "</ul><a>";
        foreach ( (array) $menu_items as $menu_item ) {
            $sorted_menu_items[ $menu_item->menu_order ] = $menu_item;
            if ( $menu_item->menu_item_parent ){
                $menu_items_with_children[ $menu_item->menu_item_parent ] = true;
            }elseif($menu_item->ID == $parent){
                $menu_item->title = "<span>$menu_item->title"."<span id='count_notific'><img src='".NOTIFICNEWS_URL."/assets/icon notification.png' style='width:20px; height:15px;' ></span></span>";//NOTIFICNEWS_URL .'/assets
            }
        }
        // Add the menu-item-has-children class where applicable
        if ( $menu_items_with_children ) {
            foreach ( $sorted_menu_items as &$menu_item ) {
                if ( isset( $menu_items_with_children[ $menu_item->ID ] ) )
                    $menu_item->classes[] = 'menu-item-has-children';
            }
        }
        unset( $menu_items, $menu_item );

        $sorted_menu_items = apply_filters( 'wp_nav_menu_objects', $sorted_menu_items, $args );

        $items .= walk_nav_menu_tree( $sorted_menu_items, $args->depth, $args );
        unset($sorted_menu_items);

        // Attributes
        if ( ! empty( $args->menu_id ) ) {
            $wrap_id = $args->menu_id;
        } else {
            $wrap_id = 'menu-' . $menu->slug;
            while ( in_array( $wrap_id, $menu_id_slugs ) ) {
                if ( preg_match( '#-(\d+)$#', $wrap_id, $matches ) )
                    $wrap_id = preg_replace('#-(\d+)$#', '-' . ++$matches[1], $wrap_id );
                else
                    $wrap_id = $wrap_id . '-1';
            }
        }
        $menu_id_slugs[] = $wrap_id;

        $wrap_class = $args->menu_class ? $args->menu_class : '';
        
        $items = apply_filters( 'wp_nav_menu_items', $items, $args );
        
        $items = apply_filters( "wp_nav_menu_{$menu->slug}_items", $items, $args );

        // Don't print any markup if there are no items at this point.
        if ( empty( $items ) )
            return false;

        $nav_menu .= sprintf( $args->items_wrap, esc_attr( $wrap_id ), esc_attr( $wrap_class ), $items );
        unset( $items );

        if ( $show_container )
            $nav_menu .= '</' . $args->container . '>';
        
        return $nav_menu;
    }
    public static function get_all_notific($content, $args){
        
    }
}
