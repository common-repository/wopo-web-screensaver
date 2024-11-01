<?php
/**
 * Plugin Name:       WoPo Web Screensaver
 * Plugin URI:        https://wopoweb.com/contact-us/
 * Description:       Web based screensaver for your site
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.1
 * Author:            WoPo Web
 * Author URI:        https://wopoweb.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wopo-web-screensaver
 * Domain Path:       /languages
 */

function wopocc_get_app_url(){
    return plugins_url('html/app/index.html#%7B%22hideUI%22%3Atrue%7D',__FILE__);
}

add_action('wp_enqueue_scripts', 'wopocc_enqueue_scripts');

function wopocc_enqueue_scripts(){
    global $post;
    $is_shortcode = intval(has_shortcode( $post->post_content, 'wopo-web-screensaver'));
    if ((function_exists('wopopp_add_drawing_button') && is_singular()) || $is_shortcode){
        wp_enqueue_style('wopo-web-screensaver',plugins_url( '/assets/css/main.css', __FILE__ ));
        wp_enqueue_script('wopo-web-screensaver', plugins_url( '/assets/js/main.js', __FILE__ ),array('jquery'));
        wp_localize_script( 'wopo-web-screensaver', 'wopo_web_screensaver', array(
            'app_url' => wopocc_get_app_url(),
            'is_shortcode' => $is_shortcode,
        ) ); 
        do_action('wopo_web_screensaver_enqueue_scripts');
    }
}

add_shortcode('wopo-web-screensaver', 'wopo_web_screensaver_shortcode');
function wopo_web_screensaver_shortcode( $atts = [], $content = null) {
    ob_start();?>
    <div id="wopo_web_screensaver_window">
        <iframe id="wopo_web_screensaver"></iframe>
        <div id="wopo_web_screensaver_overlay"></div>
    </div>
    <?php
    $content = ob_get_clean();
    return $content;
}
