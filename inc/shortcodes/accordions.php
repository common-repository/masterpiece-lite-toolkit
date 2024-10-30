<?php

add_shortcode('masterpiece_accordions', 'materpiece_toolkit_shortcode_accordions');
add_shortcode('masterpiece_accordion', '__return_false');

function materpiece_toolkit_shortcode_accordions($atts, $content = null) {
    extract(shortcode_atts(array(), $atts));

    $items = masterpiece_toolkit_get_shortcode($content, true, array('masterpiece_accordion'));

    $output = '';

    if ($items) {        
        $output .= '<div class="widget master-widget-menu-vertical-right">';
        $output .= '<div class="cssmenu2">';
        $output .= '<ul class="master-toggle-menu">';

        foreach ($items as $item) {        
            $title    = $item['atts']['title'];
            $output .= sprintf( '<li class="has-sub"><a href="#"><span>%s</span></a><ul><li><p>%s</p></li></ul></li>', $title, do_shortcode($item['content']));
        }

        $output .= '</ul>';
        $output .= '</div>';
        $output .= '</div>';
    }

    return apply_filters('materpiece_toolkit_shortcode_accordions', $output, $atts, $content);
}