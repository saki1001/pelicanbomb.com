<?php
/**
 * Cleanslate functions and definitions
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */

 // DEBUGGING
 if(!function_exists('_log')){
     function _log( $message ) {
         if( WP_DEBUG === true ){
             if( is_array( $message ) || is_object( $message ) ){
                 error_log( print_r( $message, true ) );
             } else {
                 error_log( $message );
             }
         }
     }
 }

  if ( ! function_exists( 'cleanslate_setup' ) ):
 /**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override cleanslate_setup() in a child theme, add your own cleanslate_setup to your child theme's
 * functions.php file.
 */
 function cleanslate_setup() {
  /**
   * Add default posts and comments RSS feed links to head
   */
  add_theme_support( 'automatic-feed-links' );

  /**
   * This theme uses wp_nav_menu() in one location.
   */
  register_nav_menus( array(
      'primary' => __( 'Primary Menu', 'cleanslate' ),
      'footer-pages' => __( 'Footer Pages', 'cleanslate' ),
      'footer-cats' => __( 'Footer Categories', 'cleanslate' )
  ) );

  /**
   * Add support for the Gallery and Video Post Formats
   */
  // add_theme_support( 'post-formats', array( 'gallery' ) );
 }
 endif; // cleanslate_setup

 /**
 * Tell WordPress to run cleanslate_setup() when the 'after_setup_theme' hook is run.
 */
 add_action( 'after_setup_theme', 'cleanslate_setup' );

 /**
 * Register widgetized area and update sidebar with default widgets
 */

 if ( function_exists ('register_sidebar')) { 
  // register_sidebar( array(
  //     'name' => __( 'cat-posts' ),
  //     'id' => 'cat-posts'
  // ) );

  register_sidebar();
 }
 // add_action( 'init', 'cleanslate_widgets_init' );

 // Add and enqueue jQuery
 function register_jquery() {
     wp_enqueue_script( 'jquery' );
 }
 add_action('wp_enqueue_scripts', 'register_jquery');
 
 // CUSTOM ADMIN MENUS
 // Add 'Read' to menu
 function read_menu() {
     add_submenu_page('edit.php', 'Read', 'Read', 'manage_options', 'edit.php?category_name=read' );
 }
 add_action('admin_menu', 'read_menu');
 
 // Add 'See' to menu
 function see_menu() {
     add_submenu_page('edit.php', 'See', 'See', 'manage_options', 'edit.php?category_name=see' );
 }
 add_action('admin_menu', 'see_menu');
 
 // Add 'Events' to menu
 function events_menu() {
     add_submenu_page('edit.php', 'Events', 'Events', 'manage_options', 'edit.php?category_name=events' );
 }
 add_action('admin_menu', 'events_menu');
 
 // Add 'Spaces' to menu
 function spaces_menu() {
     add_submenu_page('edit.php', 'Spaces', 'Spaces', 'manage_options', 'edit.php?category_name=spaces' );
 }
 add_action('admin_menu', 'spaces_menu');


 /* ADMIN COLUMNS
 http://wp.tutsplus.com/tutorials/creative-coding/add-a-custom-column-in-posts-and-custom-post-types-admin-screen/
 ----------------------------------------------------------- */
 
 /* FEATURED IMAGE COLUMN
 ----------------------------------------------------------- */
 
 // GET FEATURED IMAGE  
 function ST4_get_featured_image($post_ID) {  
     $post_thumbnail_id = get_post_thumbnail_id($post_ID);  
     if ($post_thumbnail_id) {  
         $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'small-thumbnail');  
         return $post_thumbnail_img[0];  
     }  
 }
 
 // ADD NEW COLUMN  
 function ST4_columns_head($defaults) {  
     $defaults['featured_image'] = 'Thumbnail';  
     return $defaults;  
 }  
 
 // SHOW THE FEATURED IMAGE  
 function ST4_columns_content($column_name, $post_ID) {  
     if ($column_name == 'featured_image') {  
         $post_featured_image = ST4_get_featured_image($post_ID);  
         if ($post_featured_image) {  
             echo '<img src="' . $post_featured_image . '" width="50" height="50" />';  
         }  
     }  
 }
 
 // ADJUST COLUMN WIDTH
 function ST4_columns_width() {
     echo '<style type="text/css">';
     echo '.column-featured_image { width:10% !important; }';
     echo '</style>';
 }
 
 add_action('admin_head', 'ST4_columns_width');
 add_filter('manage_posts_columns', 'ST4_columns_head');  
 add_action('manage_posts_custom_column', 'ST4_columns_content', 10, 2);
 
 
 
 /* FEATURED POST COLUMN
 ----------------------------------------------------------- */
 
 // GET FEATURED POST META
 function get_featured_posts_meta($post_ID) {
     $featured = (get_post_meta($post_ID, 'featured', true) === '1' ? 'Featured' : '');
     $homeBanner = (get_post_meta($post_ID, 'home-banner', true) === '1' ? 'Home' : '');
     
     $featured_post_meta = array(
        'featured' => $featured,
        'home_banner' => $homeBanner,
     );
     
     return $featured_post_meta;
 }
 
 // ADD NEW COLUMN  
 function featured_posts_columns_head($defaults) {  
     $defaults['featured_post'] = 'Featured?';  
     return $defaults;  
 }
 
 // SHOW THE FEATURED OPTION
 function featured_posts_columns_content($column_name, $post_ID) {  
     if ($column_name == 'featured_post') {  
         $post_featured_meta = get_featured_posts_meta($post_ID);  
         
         if( $post_featured_meta['featured'] === 'Featured' && $post_featured_meta['home_banner'] === 'Home' ) {
             echo $post_featured_meta['featured'] . ', ';
             echo $post_featured_meta['home_banner'];
         } else {
             echo $post_featured_meta['featured'];
             echo $post_featured_meta['home_banner'];
         }
         
     }  
 }
 
 // ADJUST COLUMN WIDTH
 function featured_posts_column_width() {
     echo '<style type="text/css">';
     echo '.column-featured_post { width:10% !important; }';
     echo '</style>';
 }
 
 add_action('admin_head', 'featured_posts_column_width');
 add_filter('manage_posts_columns', 'featured_posts_columns_head');  
 add_action('manage_posts_custom_column', 'featured_posts_columns_content', 10, 2);
 

function get_first_attachment() {
    global $post;
    
    $id = $post->ID;
    $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'DESC', 'orderby' => 'menu_order ASC') );
    $tpl = get_bloginfo('template_url');
    // $nothing = $tpl.'/nothing.jpg';
    $nothing = '';
    
    if ( empty($attachments) )
        return $nothing;
        
        foreach ( $attachments as $id => $attachment )
            $link = wp_get_attachment_url($id);
        return $link;
}

function the_excerpt_max_charlength($charlength, $excerpt) {
    
    if( !$excerpt ){
        $excerpt = get_the_excerpt();
    }
    
    $charlength++;
    
    if ( mb_strlen( $excerpt ) > $charlength ) {
        $subex = mb_substr( $excerpt, 0, $charlength - 5 );
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            echo mb_substr( $subex, 0, $excut );
        } else {
            echo $subex;
        }
        echo '[...]';
    } else {
        echo $excerpt;
    }
}

function get_category_tags($args) {
    global $wpdb;
    $tags = $wpdb->get_results
    ("
        SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name, null as tag_link
        FROM
            wp_posts as p1
            LEFT JOIN wp_term_relationships as r1 ON p1.ID = r1.object_ID
            LEFT JOIN wp_term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
            LEFT JOIN wp_terms as terms1 ON t1.term_id = terms1.term_id,

            wp_posts as p2
            LEFT JOIN wp_term_relationships as r2 ON p2.ID = r2.object_ID
            LEFT JOIN wp_term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
            LEFT JOIN wp_terms as terms2 ON t2.term_id = terms2.term_id
        WHERE
            t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id IN (".$args['categories'].") AND
            t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
            AND p1.ID = p2.ID
        ORDER by tag_name
    ");
    
    return $tags;
}

// Adding Thumbnails
add_theme_support( 'post-thumbnails' );

// Add "last" class to last post in loop
add_filter('post_class', 'my_post_class');

function my_post_class($classes){
    global $wp_query;
    
    // $classes = '';
    
    // // Add row classes to Press posts
    // if ( $wp_query->is_category('press') && $wp_query->is_main_query() ) :
    //     
    //     if ( ($wp_query->current_post) % 8 == 0 ) $classes[] = 'new-row';
    //     
    // endif;
    
    // Add 'first' class
    if ( ($wp_query->current_post) == 0 ) $classes[] = 'first';
    
    // Add 'last' class
    if ( ($wp_query->current_post+1) == $wp_query->post_count && $wp_query->post_count > 1 ) $classes[] = 'last';
    
    return $classes;
}

// Adding Thumbnails
add_theme_support( 'post-thumbnails' );

// Adding Custom Thumbnail Size;
add_image_size( 'feature-thumbnail', 240, 170, true );

// Adding Custom Thumbnail Size;
add_image_size( 'small-thumbnail', 115, 115, true );

// Prevent from adding link to inserted imgaes
update_option('image_default_link_type','none');

// Custom Thumbnail Retreival
include('php/get-thumbnail-custom.php');

// Home Primary Image section
include('php/get-home-image.php');

// Get featured posts
include('php/get-featured-posts.php');

/**
 * This theme was built with PHP, Semantic HTML, CSS, love, and a Toolbox.
 */