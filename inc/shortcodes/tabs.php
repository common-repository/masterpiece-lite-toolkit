<?php

add_shortcode('masterpiece_tabs', 'masterpiece_toolkit_shortcode_tabs');
add_shortcode('masterpiece_tab', '__return_false');

function masterpiece_toolkit_shortcode_tabs($atts, $content = null) {
    extract(shortcode_atts(array(), $atts));

    $items  = masterpiece_toolkit_get_shortcode($content, true, array('masterpiece_tab'));
    $navs   = array();
    $panels = array();

    if ($items) {
        $active = 'active';
        foreach ($items as $item) {
            $title    = $item['atts']['title'];
            $item_id  = 'tab-' . wp_generate_password(4, false, false);
            $navs[]   = sprintf('<li role="presentation" class="%s"><a href="#%s" data-toggle="tab" aria-expanded="false">%s</a></li>', $active, $item_id, do_shortcode($title));
            $panels[] = sprintf('<div class="tab-pane %s" id="%s">%s</div>', $active, $item_id, do_shortcode($item['content']));
            $active   = '';
        }
    }

    $output = '<div class="master-widget-category3-tab">';
    
    $output .= '<ul class="nav nav-tabs" role="tablist">';
    $output .= implode('', $navs);
    $output .= '</ul>';
    
    $output .= '<div class="tab-content">';
    $output .= implode('', $panels);
    $output .= '</div>';
    
    $output .= '</div>';

    return apply_filters('masterpiece_toolkit_shortcode_tabs', $output, $atts, $content);
}