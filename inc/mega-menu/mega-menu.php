<?php

if(!class_exists('MTP_Megamenu')){

    class MTP_Megamenu{

        public function __construct(){              
            add_action('init', array($this, 'init'), 0);            
            add_action('admin_init', array($this, 'register_metabox'));
            add_filter('manage_mega-menu_posts_columns', array($this, 'manage_colums'));            
            add_action('manage_mega-menu_posts_custom_column' , array($this, 'manage_colum'));              
        }

        public function require_widgets(){
        }

        public function init(){

            $labels = array(
                'name'               => _x('Mega Menus', 'masterpiece-lite-toolkit'),
                'singular_name'      => _x('Mega Menu', 'masterpiece-lite-toolkit'),
                'menu_name'          => _x('Mega Menus', 'masterpiece-lite-toolkit'),
                'name_admin_bar'     => _x('Mega Menus', 'masterpiece-lite-toolkit'),
                'add_new'            => _x('Add New', 'masterpiece-lite-toolkit'),
                'add_new_item'       => esc_html__('Add New Mega Menu', 'masterpiece-lite-toolkit'),
                'new_item'           => esc_html__('New Mega Menu', 'masterpiece-lite-toolkit'),
                'edit_item'          => esc_html__('Edit Mega Menu', 'masterpiece-lite-toolkit'),
                'view_item'          => esc_html__('View Mega Menu', 'masterpiece-lite-toolkit'),
                'all_items'          => esc_html__('All Mega Menus', 'masterpiece-lite-toolkit'),
                'search_items'       => esc_html__('Search Mega Menus', 'masterpiece-lite-toolkit'),
                'not_found'          => esc_html__('No mega menus found.', 'masterpiece-lite-toolkit'),
                'not_found_in_trash' => esc_html__('No mega menus found in Trash.', 'masterpiece-lite-toolkit')
            );

            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'menu_icon'          => 'dashicons-index-card',
                'query_var'          => true,
                'rewrite'            => array('slug' => 'mega-menu'),
                'capability_type'    => 'post',
                'has_archive'        => false,
                'hierarchical'       => false,
                'menu_position'      => 80,
                'supports'           => array('title')
            );

            register_post_type('mega-menu', $args);
        }

        public function register_metabox(){
            global $wp_registered_sidebars;

            $register_sidebar = array();
            $register_sidebar[''] = '--None--';
            foreach ( $wp_registered_sidebars as $k => $v ) {
                $register_sidebar[$k] = $v['name'];
            }
            $args = array(
                'id'          => 'megamenu-options-metabox',
                'title'       => esc_html__('Settings', 'masterpiece-lite-toolkit'),
                'desc'        => '',
                'pages'       => array( 'mega-menu' ),
                'context'     => 'normal',
                'priority'    => 'low',
                'fields'      => array(
                    array(
                        'title'   => 'Sidebar',
                        'type'    => 'select',
                        'id'      => 'mega_menu_sidebar',
                        'options' => $register_sidebar
                    ),
                )
            );

            kopa_register_metabox( $args );
        }

        public function manage_colums($columns){            
            $columns = array(
                'cb'                                 => esc_html__('<input type="checkbox" />', 'masterpiece-lite-toolkit'),
                'title'                              => esc_html__('Title', 'masterpiece-lite-toolkit'),
                'masterpiece-toolkit-plus-shortcode' => esc_html__('Shortcode', 'masterpiece-lite-toolkit')
            );

            return $columns;   
        }

        public function manage_colum($column){
            global $post;
            switch ($column) {
                case 'masterpiece-toolkit-plus-shortcode':
                    echo '[megamenu id=' . $post->ID . ']';
                    break;
            }
        }

    }

    $masterpiece_toolkit_plus_mega_menu = new MTP_Megamenu();
    $masterpiece_toolkit_plus_mega_menu->require_widgets();

}

class MTP_Mega_Menu_Walker_Nav_Menu extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        parent::start_el($output, $item, $depth, $args, $id);
            if (!empty($item->description)) {
                ob_start();
                echo do_shortcode($item->description);
                $output .= ob_get_contents();
                ob_end_clean();
            }
    }

}

add_shortcode('megamenu', 'masterpiece_toolkit_plus_shortcode_megamenu');

function masterpiece_toolkit_plus_shortcode_megamenu($atts, $content = null) {
    extract(shortcode_atts(array('id' => 0), $atts));
    $output = '';

    if (isset($atts['id']) && (int) $atts['id'] > 0) {
        $post_id = $atts['id'];
        ob_start();

            echo '<div class="sf-mega">';
            $sidebar = get_post_meta($post_id, 'mega_menu_sidebar', true);
            if ('sidebar_hide' != $sidebar && is_active_sidebar($sidebar)) {
                dynamic_sidebar($sidebar);
            }
            echo '</div>';

        $output .= ob_get_contents();
        ob_end_clean();
    }

    return apply_filters('masterpiece_toolkit_plus_shortcode_megamenu', $output);
}
