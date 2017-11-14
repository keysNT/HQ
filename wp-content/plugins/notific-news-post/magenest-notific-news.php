<?php
/**
Plugin Name: Magenest notific news
Plugin URI: http://store.magenest.com/
Description:
Version: 1.0
Author: Magenest-Keysnt
Author URI: http://magenest.com/
License:
Text Domain: NOTIFICNEWS
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly
if (!defined('NOTIFICNEWS_TEXT_DOMAIN'))
    define('NOTIFICNEWS_TEXT_DOMAIN', 'NOTIFICNEWS');
// Plugin Folder Path
if (!defined('NOTIFICNEWS_PATH'))
    define('NOTIFICNEWS_PATH', plugin_dir_path(__FILE__));
// Plugin Folder URL
if (!defined('NOTIFICNEWS_URL'))
    define('NOTIFICNEWS_URL', plugins_url('notific-news-post', 'magenest-notific-news.php'));
// Plugin Root File
if (!defined('NOTIFICNEWS_FILE'))
    define('NOTIFICNEWS_FILE', plugin_basename(__FILE__));
class MAGENEST_NOTIFIC_NEWS{
    //Plugin version
    const VERSION = '1.0';
    private static $notific_news;
    public function __construct(){
        global $wpdb;
        register_activation_hook(NOTIFICNEWS_FILE, array($this, 'init'));
        require NOTIFICNEWS_PATH .'includes/admin-settings.php';
        add_action('wp_enqueue_scripts', array($this,'addStyles'));
        add_action('wp_enqueue_scripts', array($this,'addScripts'));
        add_action('wp_ajax_remove_news_seen', array($this, 'remove_news_seen'));
        add_action('wp_ajax_remove_notific_seen', array($this, 'remove_notific_seen') );
        add_action('wp_ajax_add_news_icon', array($this, 'add_news_icon') );
        add_action('wp_ajax_create_notification', array($this, 'create_notification'));
        add_action('wp_ajax_add_highlight', array($this, 'add_highlight'));
        add_action('publish_post', array('ADMIN_SETTINGS','save_post_publish_update'), 10);
        add_action('publish_page', array('ADMIN_SETTINGS','save_post_publish_update'), 10);
        add_action('new_event_cronJob', array($this, 'cronJob_daily') );
        if (is_admin ()) {
            add_action ( 'admin_enqueue_scripts', array ($this,'load_admin_scripts' ), 99 );
            add_action('admin_menu', array($this, 'create_admin_menu'), 5);
        }
    }
    //find all post and page update or publish
    public function create_notification(){
        global $wpdb;
        $pageTbl = $wpdb->prefix.'posts';
        $title_arrs = $_REQUEST['title'];
        $data = array();
        foreach ($title_arrs as $title_arr){
            if($title_arr == 'Pedagogical Toolbox'){
                $sql = "SELECT * FROM ".$pageTbl." WHERE `post_type` = 'page' AND `post_title` = '$title_arr'";
                $pages = $wpdb->get_results($sql, ARRAY_A);
                foreach ($pages as $page){
                    $number = $this->check_link_page($page['post_content']);
                    $data[] = array($title_arr,$page['ID'],$number);
                }
            }elseif ($title_arr == 'Training Family Community'){
                $user_id = get_current_user_id();
                $query = $wpdb->prepare( " SELECT count(*) FROM $wpdb->ap_notifications n LEFT JOIN $wpdb->ap_activity a ON noti_activity_id = a.id WHERE n.noti_status = 0 AND n.noti_user_id = %d AND a.status != 'trash'", $user_id );
                $count = $wpdb->get_var($query);
                if(isset($count) && $count > 0){
                    $data[] = array($title_arr,'', true);
                }else{
                    $data[] = array($title_arr,'', false);
                }
            }else{
                $sql = "SELECT * FROM ".$pageTbl." WHERE `post_type` = 'page' AND `post_title` = '$title_arr'";
                $pages = $wpdb->get_results($sql, ARRAY_A);
                foreach ($pages as $page){
                    $number = $this->check_link_post($page['post_content']);
                    $data[] = array($title_arr,$page['ID'],$number);
                }
            }
        }
        $output['title'] = $data;
        $output['type'] = 'success';
        echo json_encode($output);
        wp_die();
    }
    public function add_highlight(){
        global $wpdb;
        $postTbl = $wpdb->prefix.'posts';
        $title = $_REQUEST['title'];//$_REQUEST['link'];
        $links_arr = array();
        $number = false;
        $query = $wpdb->prepare( "SELECT * FROM $postTbl WHERE `post_title` = %s AND `post_type` = %s", $title,'page');
        $results = $wpdb->get_results($query, ARRAY_A);
        foreach ($results as $result){
            $content = $result['post_content'];
            if($title == 'Pedagogical Toolbox'){
                $number = $this->check_add_hightlight_page($result['ID']);
                if($number){
                    $links_arr[] = get_permalink($result['ID']);
                }
            }elseif ($title == 'Training Family Community'){
            }else{
                $number = $this->check_add_hightlight_post($content);
                if($number){
                    $links_arr[] = get_permalink($result['ID']);
                }
            }
        }
        $output['links'] = $links_arr;
        $output['type'] = 'success';
        echo json_encode($output);
        wp_die();
    }
    public function check_add_hightlight_page($post_id){
        $user_id = get_current_user_id();
        $strdata = get_user_meta($user_id, 'page_id_seen');
        $number = false;
        $post = get_post($post_id);
        $post_content = $post->post_content;
        if(isset($strdata)) {
            $data = explode(' ', $strdata[0]);
            for($i = 0; $i < count($data); $i++){
                if(get_the_title($post_id) == get_the_title($data[$i])){
                    continue;
                }else{
                    $links = get_permalink($data[$i]);
                    $lenght = strlen($links);
                    $sub = substr($links,$lenght-1,1);
                    if($sub == '/'){
                        $links = substr($links,0,$lenght-1);;
                    }
                    $number = strpos($post_content, $links);
                    if($number){
                        break;
                    }
                }
            }
        }
        return $number;
    }
    public function check_add_hightlight_post($post_content){
        $user_id = get_current_user_id();
        $strdata = get_user_meta($user_id, 'post_id_seen');
        $number = false;
        if(isset($strdata)) {
            $data = explode(' ', $strdata[0]);
            for($i = 0; $i <= count($data); $i++){
                $links = get_permalink($data[$i]);
                $number = strpos($post_content, $links);
                if($number){
                    $lenght = strlen($links);
                    $sub = substr($links,$lenght-2);
                    $number = strpos($post_content, $links);
                    if($number){
                        break;
                    }
                }
            }
        }
        return $number;
    }
    public function check_link_page($post_content){
        $user_id = get_current_user_id();
        $strdata = get_user_meta($user_id, 'page_id_seen');
        $number = false;
        if(isset($strdata)){
            $data = explode(' ', $strdata[0]);
            for($i = 0; $i <= count($data); $i++){
                $links = get_permalink($data[$i]);
                $number = strpos($post_content, $links);
                if($number){
                    $lenght = strlen($links);
                    $sub = substr($links,$lenght-2);
                    $number = strpos($post_content, $sub);
                    if($number){
                        break;
                    }
                }
            }
        }
        return $number;
    }
    public function check_link_post($post_content){
        $user_id = get_current_user_id();
        $strdata = get_user_meta($user_id, 'post_id_seen');
        $number = false;
        if(isset($strdata)) {
            $data = explode(' ', $strdata[0]);
            for($i = 0; $i <= count($data); $i++){
                $links = get_permalink($data[$i]);
                $number = strpos($post_content, $links);
                if($number){
                    $lenght = strlen($links);
                    $sub = substr($links,$lenght-2);
                    $number = strpos($post_content, $links);
                    if($number){
                        break;
                    }
                }
            }
        }
        return $number;
    }
    public function add_news_icon(){
        global $wpdb;
        $data_links = $_REQUEST['link'];
        $title = $_REQUEST['title'];
        $user_id = get_current_user_id();
        if($title == 'Pedagogical Toolbox'){
            $page_seen = get_user_meta($user_id,'page_id_seen');
            $page_seen = trim($page_seen[0]);
            $page_arrs = explode(' ',$page_seen);
            $data = array();
            $i = 0;
            foreach ($page_arrs as $page_arr){
                $link = get_permalink($page_arr);
                foreach ($data_links as $data_link){
                    $lenght = strlen($data_link[0]);
                    $sub = substr($data_link[0],$lenght-1,1);
                    if($sub != '/'){
                        $data_link[0] .= '/';
                    }
                    if($link == $data_link[0]){
                        $data[$i] = array($data_link[1],$page_arr);
                        $i++;
                    }
                }
            }
        }elseif($title == 'Professional Development' || $title == 'Communication Development' || $title == 'Leadership & Managerial Development'){
            $post_seen = get_user_meta($user_id,'post_id_seen');
            $post_seen = trim($post_seen[0]);
            $post_arrs = explode(' ',$post_seen);
            $data = array();
            $i = 0;
            foreach ($post_arrs as $post_arr){
                $link = get_permalink($post_arr);
                foreach ($data_links as $data_link){
                    if($link == $data_link[0]){
                        $data[$i] = array($data_link[1],$post_arr);
                        $i++;
                    }
                }
            }
        }
        $output['link'] = $data;
        $output['type'] = 'success';
        echo json_encode($output);
        wp_die();
    }
    public function remove_news_seen(){
        // do something ...
        $user_id = get_current_user_id();
        $post_id = $_REQUEST['post_id'];
        $post_type = get_post_type($post_id);
        if($post_type == 'post'){
            $strdata = get_user_meta($user_id, 'post_id_seen');
            if(isset($strdata)){
                $data = explode(' ', $strdata[0]);
            }
            $strdata = str_replace( $post_id, '', $strdata[0] );
            update_user_meta($user_id, 'post_id_seen', $strdata);
        }elseif($post_type == 'page'){
            $strdata = get_user_meta($user_id, 'page_id_seen');
            if(isset($strdata)){
                $data = explode(' ', $strdata[0]);
            }
            $strdata = str_replace( $post_id, '', $strdata[0] );
            update_user_meta($user_id, 'page_id_seen', $strdata);
        }
        $output['id'] = $post_id;
        $output['type'] = 'success';
        echo json_encode($output);
        wp_die();
    }
    public function remove_notific_seen(){
        global $wpdb;
        $tbl = $wpdb->ap_notifications;
        $post_id = $_REQUEST['post_id'];
        $data['noti_status'] = 1;
        $user_id = get_current_user_id();
        $wpdb->update($tbl,$data,array('noti_activity_id' => $post_id, 'noti_user_id' => $user_id));
        $sql = $wpdb->prepare("SELECT noti_id FROM $tbl WHERE noti_activity_id = %d AND noti_user_id = %d", $post_id, $user_id);
        $noti_id = $wpdb->get_row($sql, ARRAY_A);
        $row = $wpdb->query(
            $wpdb->prepare(
                'DELETE FROM '.$wpdb->ap_notifications.' WHERE noti_id = %d',
                $noti_id
            )
        );
        if ( false !== $row ) {
            /**
             * Action to do after deleting a notification.
             * @param integer $noti_id Notification ID.
             */
            do_action( 'ap_delete_notification', $noti_id );
        }
        $output['type'] = 'success';
        echo json_encode($output);
        wp_die();
    }
    public function cronJob_daily(){
        error_log('chay cron job');
        global $wpdb;
        $postTbl = $wpdb->prefix.'posts';
        $numberdate = get_option('numberdate');
        $today = new DateTime();
        $toDay = $today->format('Y-m-d');
        $sql = "SELECT ID FROM $postTbl WHERE DATE_FORMAT(post_modified, '%Y-%m-%d') >= DATE_SUB('$toDay', INTERVAL $numberdate DAY) AND `post_type` = 'post'";
        $results = $wpdb->get_results($sql, ARRAY_A);
        $users = get_users(array('fields' => array('ID' )));
        $string = '';
        foreach ($users as $user){
            $user_id = $user->ID;
            $strdata = get_user_meta($user_id, 'post_id_seen');
            if(isset($strdata)){
                $data = explode(' ', $strdata[0]);
                for($i = 0; $i < count($data); $i++){
                    foreach ($results as $result){
                        if($data[$i] == $result['ID']){
                            $string .= $data[$i].' ';
                        }
                    }
                }
            }
            update_option($user_id, 'post_id_seen', $string);
        }
        $query = "SELECT ID FROM $postTbl WHERE DATE_FORMAT(post_modified, '%Y-%m-%d') >= DATE_SUB('$toDay', INTERVAL $numberdate DAY) AND `post_type` = 'page'";
        $records = $wpdb->get_results($query, ARRAY_A);
        $page = '';
        foreach ($users as $user){
            $user_id = $user->ID;
            $strdata = get_user_meta($user_id, 'page_id_seen');
            if(isset($strdata)){
                $data = explode(' ', $strdata[0]);
                for($i = 0; $i < count($data); $i++){
                    foreach ($records as $result){
                        if($data[$i] == $result['ID']){
                            $page .= $data[$i].' ';
                        }
                    }
                }
            }
            update_option($user_id, 'page_id_seen', $page);
        }
    }
    public function create_admin_menu(){
        global $menu;
        $admin = new ADMIN_SETTINGS();
        add_menu_page(__('Setting notifict news', NOTIFICNEWS_TEXT_DOMAIN), __('Setting notifict news', NOTIFICNEWS_TEXT_DOMAIN), 'manage_options','notific_news', array($admin,'index'));
    }
    public function init(){
        error_log('chay init');
        global $wpdb;
        $installed_version = get_option( 'magenest_giftregistry_version', true);
        $postTbl = $wpdb->prefix.'posts';
        $string1 = $string2 ='';
        $number_date = 30;
        update_option('numberdate',$number_date);
        $today = new DateTime();
        $toDay = $today->format('Y-m-d');
        $sql1 = "SELECT ID FROM $postTbl WHERE DATE_FORMAT(post_modified, '%Y-%m-%d') >= DATE_SUB('$toDay', INTERVAL $number_date DAY) AND `post_type` = 'post'";
        $sql2 = "SELECT ID FROM $postTbl WHERE DATE_FORMAT(post_modified, '%Y-%m-%d') >= DATE_SUB('$toDay', INTERVAL $number_date DAY) AND `post_type` = 'page'";
        $results1 = $wpdb->get_results($sql1, ARRAY_A);
        $results2 = $wpdb->get_results($sql2, ARRAY_A);
        foreach ($results1 as $result){
            $string1 .= $result['ID'].' ';
        }
        foreach ($results2 as $result){
            $string2 .= $result['ID'].' ';
        }
        $users = get_users( array('fields' => array( 'ID' )));
        foreach ($users as $user){
            update_user_meta($user->ID, 'post_id_seen', $string1);
        }
        foreach ($users as $user){
            update_user_meta($user->ID, 'page_id_seen', $string2);
        }
        update_option('magenest_notificnews_version', self::VERSION);
        wp_schedule_single_event( time() + 60, 'new_event_cronJob');
        $this->cronJob_daily();
    }
    public function addStyles(){
        wp_enqueue_media();
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('	jquery-ui-datepicker');
        wp_enqueue_script('jquery-ui-widget');
    }
    public function addScripts(){
        wp_enqueue_media();
        if (!wp_script_is('jquery', 'queue')){
            wp_enqueue_script('jquery');
        }
        if (!wp_script_is('jquery-ui-sortable', 'queue')){
            wp_enqueue_script('jquery-ui-sortable');
        }
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('	jquery-ui-datepicker');
        wp_enqueue_script('jquery-ui-widget');
        wp_enqueue_style('magenestnotific' , NOTIFICNEWS_URL .'/assets/style.css');
        wp_enqueue_script('magenestnotificjs', NOTIFICNEWS_URL . '/assets/magenest-notification.js' );
    }
    public function load_admin_scripts($hook){
        global $woocommerce;
        if (is_object($woocommerce))
            wp_enqueue_style ( 'woocommerce_admin_styles', $woocommerce->plugin_url () . '/assets/css/admin.css' );
    }
    /**
     * Get the singleton instance of our plugin
     *
     * @return class The Instance
     * @access public
     */
    public static function getInstance() {
        if (! self::$notific_news) {
            self::$notific_news = new MAGENEST_NOTIFIC_NEWS();
        }
        return self::$notific_news;
    }
}
return new MAGENEST_NOTIFIC_NEWS();
?>