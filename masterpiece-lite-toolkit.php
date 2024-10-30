<?php
/*
Plugin Name: Masterpiece Lite Toolkit
Description: A specific plugin use in Masterpiece Lite Theme, included some custom widgets, and layout.
Version: 1.0.3
Author: Kopa Theme
Author URI: http://kopatheme.com
License: GNU General Public License v3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Masterpiece Toolkit plugin, Copyright 2015 Kopatheme.com
Masterpiece Toolkit is distributed under the terms of the GNU GPL

Requires at least: 3.8
Tested up to: 4.3.1
Text Domain: masterpiece-lite-toolkit
Domain Path: /languages/
*/

define('MASTERPIECE_LITE_DIR', plugin_dir_url(__FILE__));
define('MASTERPIECE_LITE_PATH', plugin_dir_path(__FILE__));

add_action('plugins_loaded', array('Masterpiece_Toolkit', 'plugins_loaded'));	
add_action('after_setup_theme', array('Masterpiece_Toolkit', 'after_setup_theme'), 20 );	

class Masterpiece_Toolkit {

	function __construct(){

		require MASTERPIECE_LITE_PATH . 'inc/hook.php';
		require MASTERPIECE_LITE_PATH . 'inc/util.php';
		require MASTERPIECE_LITE_PATH . 'inc/field.php';
		require MASTERPIECE_LITE_PATH . 'inc/widget.php';
		require MASTERPIECE_LITE_PATH . 'inc/shortcode.php';
		require MASTERPIECE_LITE_PATH . 'inc/ajax.php';
		require MASTERPIECE_LITE_PATH . 'inc/mega-menu/mega-menu.php';

		if(is_admin()){
			add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'), 20);
			add_action('admin_init', 'masterpiece_toolkit_register_metabox_post_featured');

			#metabox-custom-field
			add_filter('kopa_admin_meta_box_field_quote', 'masterpiece_toolkit_metabox_field_quote', 10, 5);
			add_filter('kopa_admin_meta_box_field_gallery', 'masterpiece_toolkit_metabox_field_gallery', 10, 5);

			#metabox-custom-wrap
			add_filter('kopa_admin_meta_box_wrap_start', 'masterpiece_toolkit_meta_box_wrap_start', 10, 3);
			add_filter('kopa_admin_meta_box_wrap_end', 'masterpiece_toolkit_meta_box_wrap_end', 10, 3);			
		}
		add_filter('user_contactmethods', 'masterpiece_toolkit_add_social_field');
		add_action('wp_footer', 'masterpiece_toolkit_footer');
		add_action('wp_enqueue_scripts', 'masterpiece_toolkit_enqueue_scripts');
		add_action('masterpiece_lite_left_post', 'masterpiece_toolkit_add_socials_share_left_post' );
		add_action('masterpiece_lite_bottom_title', 'masterpiece_toolkit_add_socials_share_bottom_title' );
	}

	public static function plugins_loaded(){
		load_plugin_textdomain('masterpiece-lite-toolkit', false, MASTERPIECE_LITE_PATH . '/languages/');
	}

	public static function after_setup_theme(){
		if (!class_exists('Kopa_Framework'))
			return; 		
		else	
			new Masterpiece_Toolkit();							
	}

	public function admin_enqueue_scripts($hook){
		if(in_array($hook, array('widgets.php', 'post.php', 'post-new.php'))){	        
	        wp_enqueue_style('masterpiece-toolkit-metabox', MASTERPIECE_LITE_DIR . "assets/css/metabox.css", array(), NULL);
	        wp_enqueue_style('masterpiece-toolkit-tinymce', MASTERPIECE_LITE_DIR . "assets/css/tinymce.css", array(), NULL);
       
	        wp_enqueue_script('masterpiece-toolkit-gallery', MASTERPIECE_LITE_DIR . "assets/js/gallery.js", array('jquery'), NULL, TRUE);        
	        wp_localize_script('jquery', 'masterpiece_toolkit', array(
	            'i18n' => array(
					'grid'           => esc_html__('Grid', 'masterpiece-lite-toolkit'),
					'shortcodes'     => esc_html__('Shortcodes', 'masterpiece-lite-toolkit'),
					'container'      => esc_html__('Container', 'masterpiece-lite-toolkit'),
					'tabs'           => esc_html__('Tabs', 'masterpiece-lite-toolkit'),
					'accordion'      => esc_html__('Accordion', 'masterpiece-lite-toolkit'),
					'toggle'         => esc_html__('Toggle', 'masterpiece-lite-toolkit'),
					'dropcap'        => esc_html__('Dropcap', 'masterpiece-lite-toolkit'),
					'dc_bg'          => esc_html__('Dropcap Background', 'masterpiece-lite-toolkit'),
					'dc_bd'          => esc_html__('Dropcap Boder', 'masterpiece-lite-toolkit'),
					'blockquote'     => esc_html__('Blockquote', 'masterpiece-lite-toolkit'),
					'bq_border'      => esc_html__('Border', 'masterpiece-lite-toolkit'),
					'bq_border_left' => esc_html__('Border Left', 'masterpiece-lite-toolkit'),
					'button'         => esc_html__('Button', 'masterpiece-lite-toolkit'),
					'bt_border'      => esc_html__('Border', 'masterpiece-lite-toolkit'),
					'bt_bg'          => esc_html__('Background', 'masterpiece-lite-toolkit'),
					'large'          => esc_html__('Large', 'masterpiece-lite-toolkit'),
					'medium'         => esc_html__('Medium', 'masterpiece-lite-toolkit'),
					'small'          => esc_html__('Small', 'masterpiece-lite-toolkit'),
					'large_text'     => esc_html__('Large Text', 'masterpiece-lite-toolkit'),
	            )
	        ));
	    }
	}

}