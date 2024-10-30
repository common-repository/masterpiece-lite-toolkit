<?php

class MP_Shortcode{
	
	function __construct(){
		add_action('admin_init', array($this, 'admin_init'));
	}

	public function admin_init(){
		if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
			add_filter('mce_external_plugins', array($this, 'mce_external_plugins'));
			add_filter('mce_buttons', array($this, 'mce_buttons'));
		}
	}

	public function mce_external_plugins($plugin_array) {
	    $plugin_array['masterpiece_shortcodes'] = MASTERPIECE_LITE_DIR . "assets/js/tinymce.js";
	    return $plugin_array;
	}

	public function mce_buttons($buttons) {
	    $buttons[] = 'masterpiece_shortcodes';
	    return $buttons;
	}

	public function load_shortcodes(){
		require MASTERPIECE_LITE_PATH . 'inc/shortcodes/tabs.php';		
		require MASTERPIECE_LITE_PATH . 'inc/shortcodes/accordions.php';
		require MASTERPIECE_LITE_PATH . 'inc/shortcodes/toggle.php';
		require MASTERPIECE_LITE_PATH . 'inc/shortcodes/dropcaps.php';
		require MASTERPIECE_LITE_PATH . 'inc/shortcodes/blockquote.php';
		require MASTERPIECE_LITE_PATH . 'inc/shortcodes/button.php';
		require MASTERPIECE_LITE_PATH . 'inc/shortcodes/grid.php';
	}
}

$masterpiece_toolkit_shortcodes = new MP_Shortcode();
$masterpiece_toolkit_shortcodes->load_shortcodes();