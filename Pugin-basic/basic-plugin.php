<?php
/*
 * Plugin Name: CUSTOM PLUGIN
 * Plugin URI: #
 * Description: Handle the basics with this plugin.
 * Version:  1.0.0
 * Author:   Ruhul Siddiki
 * Author URI: #
 * Text Domain:  first-plugin
 */


define("PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));
define("PLUGIN_DIR_URL", plugin_dir_url(__FILE__));
define("PLUGIN_VERSION", "1.0.0");
define("PLUGIN_BASENAME", plugin_basename(__FILE__));

class YOUR_PLUGIN
{

   public function __construct()
   {
      add_action('admin_menu', array($this, 'first_menu_plugin'));
      add_action('admin_enqueue_scripts', array($this, 'load_plugin_scripts'));
      add_action('add_meta_boxes', array($this, 'meta_box'));
      add_action('save_post', array($this, 'save_post'));
      add_filter('the_title', array($this, 'the_title_filter'));
      add_action('init', array($this, 'custom_post_type'));
   }

   public function first_menu_plugin()
   {
      add_menu_page('Custom Plugin', 'Custom Plugin', 'manage_options', 'custom-plugin', array($this, 'custom_plugin_func'), 'dashicons-camera-alt', 21);
      add_submenu_page('custom-plugin', 'Submenu', 'Submenu', 'manage_options', 'submenu-slag', array($this, 'submenu_func'));
      add_submenu_page('custom-plugin', 'Submenu 2', 'Submenu 2', 'manage_options', 'submenu-slag2', array($this, 'submenu_func2'));
   }

   public function custom_plugin_func()
   {
      echo "hello";
   }

   public function submenu_func()
   {
      include_once PLUGIN_DIR_PATH . '/views/submenu.php';
   }

   public function submenu_func2()
   {
      echo "submenu 2";
   }

   public function load_plugin_scripts()
   {
      wp_enqueue_style(
         'first-style',
         PLUGIN_DIR_URL . 'assets/style.css',
         array(),
         PLUGIN_VERSION,
      );
      wp_enqueue_script(
         'first-script',
         PLUGIN_DIR_URL . 'assets/script.js',
         array('jquery'),
         PLUGIN_VERSION,
         true
      );
   }

   public function meta_box()
   {
      add_meta_box('new-id', 'custom meta box', array($this, 'meta_func'), 'post', 'side', 'high');
   }

   public function meta_func($post)
   {
      echo "this is custom meta box";
?>

      <div>
         <label for="name">Name</label>
         <input type="text" name="new_user" value="<?php echo get_post_meta($post->ID, 'new_user', true); ?>">
      </div>

   <?php
   }

   public function save_post($post_id)
   {
      if (isset($_POST['new_user'])) {
         update_post_meta($post_id, 'new_user', $_POST['new_user']);
      }
   }

   public function the_title_filter($title)
   {
      $new = get_post_meta(get_the_ID(), 'new_user', true);
      return $title . " " . $new;
   }

   public function custom_post_type()
   {

      $arg = array(
         'public' => true,
         'label' => 'Books'
      );

      register_post_type('book', $arg);
   }
}

new YOUR_PLUGIN();

//add_action('admin_menu','first_menu_plugin');
//  function first_menu_plugin(){
//     add_menu_page('Custom Plugin','Custom Plugin','manage_options','custom-plugin','custom_plugin_func','dashicons-camera-alt',21);
//     add_submenu_page( 'custom-plugin', 'Submenu', 'Submenu', 'manage_options', 'submenu-slag', 'submenu_func');
//     add_submenu_page( 'themes.php', 'Submenu 2', 'Submenu 2', 'manage_options', 'submenu-slag2', 'submenu_func2');
//  }

//  function custom_plugin_func(){
//     echo "hello";
//  }

//  function submenu_func(){
//   include_once PLUGIN_DIR_PATH . '/views/submenu.php';
//  }
//  function submenu_func2(){
//    echo "submenu 2";
//  }

//  function load_plugin_scripts() {
//    wp_enqueue_style(
//       'first-style',
//       PLUGIN_DIR_URL . 'assets/style.css',
//       array(),
//       PLUGIN_VERSION,
//    );
//    wp_enqueue_script(
//       'first-script',
//       PLUGIN_DIR_URL . 'assets/script.js',
//       array('jquery'),
//       PLUGIN_VERSION,
//       true
//    );
// }
//add_action( 'admin_enqueue_scripts', 'load_plugin_scripts' );

// add_action('admin_bar_menu','admin_bar_func');
// function admin_bar_func($wp_admin_bar){
//    $arg = array(
//       "id" => 'smart-coder',
//       "title" => "Smart Coder",
//       "href" => "https://www.facebook.com/SmartCoderss",
//       "meta" => array(
//          "class" => "smart-coder",
//          "target" => "_blank"
//       )
//    );
//    $wp_admin_bar->add_node($arg);

//    $submenu1 = array(
//       "id" => 'smart-coder-youtube',
//       "title" => "Youtube",
//       "href" => "https://www.youtube.com/@smartcoder5045/videos",
//       "parent" => 'smart-coder',
//       "meta" => array(
//          "class" => "smart-coder",
//          "target" => "_blank"
//       )
//    );
//    $wp_admin_bar->add_node($submenu1);
//    $submenu2 = array(
//       "id" => 'smart-coder-facebook',
//       "title" => "Facebook",
//       "href" => "https://facebook.com/smartcoder",
//       "parent" => 'smart-coder',
//       "meta" => array(
//          "class" => "smart-coder",
//          "target" => "_blank"
//       )
//    );
//    $wp_admin_bar->add_node($submenu2);
// }

//add_action('admin_notices','add_notice');
function add_notice()
{
   ?>
   <div class="notice notice-success is-dismissible">
      <p>Add custom notice</p>
   </div>

<?php


}

//add_action('add_meta_boxes','meta_box');
// function meta_box(){
//    add_meta_box('new-id','custom meta box','meta_func','post','side','high');
// }

function meta_func($post)
{
   echo "this is custom meta box";
?>

   <div>
      <label for="name">Name</label>
      <input type="text" name="new_user" value="<?php echo get_post_meta($post->ID, 'new_user', true); ?>">
   </div>

<?php
}

//save meta value with save post hook
// add_action( 'save_post', function( $post_id ) {
// 	if ( isset( $_POST['new_user'] ) ) {
// 		update_post_meta( $post_id, 'new_user', $_POST['new_user'] );
// 	}
// } );

// add_filter('the_title','the_title_filter');
// function the_title_filter($title){

//    $new = get_post_meta(get_the_ID(),'new_user',true);

//    return $title . " " .$new;
// }

//add_action('init','custom_post_type');
// function custom_post_type(){

//    $arg = array(
//       'public' => true,
//       'label' => 'Books'
//    );

//    register_post_type('book',$arg);
// }

add_filter('manage_book_posts_columns', 'add_custom_columns');
function add_custom_columns($columns)
{
   $columns = array(
      'cb' => '<input type="checkbox" />',
      'title' => __('Title'),
      'content' => __('Content'),
      'amount' => __('Amount'),
      'date' => __('Date'),
      'book_email' => __('Book Email'),
      'book_author' => __('Book Author')
   );

   return $columns;
}

add_action('manage_book_posts_custom_column', 'custom_book_column', 10, 2);

function custom_book_column($column, $post_id)
{

   switch ($column) {
      case 'amount';
         echo "40";
         break;

      case 'content';
         echo get_the_content();
         break;

      case 'book_email';
         echo "raihan@gmail.com";
         break;
   }
}


add_shortcode('man', 'wpdocs_footag_func');
function wpdocs_footag_func($atts)
{
   $atts = shortcode_atts(array(
      'gender' => 'male',
      'name' => 'raihan',
      'email' => 'raihan@gmail.com'
   ), $atts, 'bartag');

   ob_start();

?>
   <h2>Gender:<?php echo $atts['gender']; ?></h2>
   <h2>Name:<?php echo $atts['name']; ?></h2>
   <h2>Email:<?php echo $atts['email']; ?></h2>


<?php

   return ob_get_clean();
}
