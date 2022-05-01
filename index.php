<?php 

/* 
Plugin Name:Pull Git Repository 
Description: Get any company's repository data
Version : 1.0
Author : Dor Hasson
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AreYouPayingAttention {
  function __construct() {
    add_action('init', array($this, 'adminAssets'));
  }

  function adminAssets() {
    wp_register_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element','wp-editor'));
    register_block_type('ourplugin/pull-git-data', array(
      'editor_script' => 'ournewblocktype',
      'render_callback' => array($this, 'theHTML')
    ));
  }
  

  function theHTML($attributes) {
    if(!is_admin()){
      wp_enqueue_script('api_script', plugin_dir_url(__FILE__) . 'build/GetGitApi.js',array('wp-element'));
    }
    ob_start(); ?>
    <form class="formy" method="post" action="<?php echo esc_url(site_url(get_the_ID()))?>">
            <input class="form-control" type="text" name="searchInput" id="searchId" placeholder="   search repository" required/>
            <input id="send-request" class="btn btn-dark" type="button" value="SEARCH" />
        </form>

        <div id="main-div" class="table-container">
        <table id="api-results-div" class="table table-hover text-nowrap">
       
      </table>
      </div>
    <?php return ob_get_clean();
  }
}

$areYouPayingAttention = new AreYouPayingAttention();

function prefix_enqueue() 
{       
    // JS
    wp_register_script('prefix_bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array( 'jquery' ),'',true);
    wp_enqueue_script('prefix_bootstrap');


    // wp_register_script('prefix_api_script', plugin_dir_url(__FILE__) . 'src/modules/GetGitApi.js', array('jquery'),'',true);
    // wp_enqueue_script('prefix_api_script');

    
    // CSS
    wp_register_style('prefix_bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    wp_enqueue_style('prefix_bootstrap');

    wp_register_style('prefix_indexcss', plugin_dir_url(__FILE__) . 'src/index.css');
    wp_enqueue_style('prefix_indexcss');
}

add_action('wp_enqueue_scripts','prefix_enqueue');

?>
