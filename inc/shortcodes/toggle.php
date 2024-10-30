<?php

add_shortcode('masterpiece_toggles', 'masterpiece_toolkit_shortcode_toggles');
add_shortcode('masterpiece_toggle', '__return_false');

function masterpiece_toolkit_shortcode_toggles($atts, $content = null) {
    extract(shortcode_atts(array(), $atts));

    $items = masterpiece_toolkit_get_shortcode($content, true, array('masterpiece_toggle'));

    $output = '';

    if ($items) {        
        $output .= '<div class="widget master-widget-menu-vertical-left">';
        $output .= '<div class="cssmenu">';
        $output .= '<ul>';

        foreach ($items as $item) {        
            $title    = $item['atts']['title'];
            $output .= sprintf( '<li class="has-sub"><a href="#"><span>%s</span></a><ul><li><p>%s</p></li></ul></li>', $title, do_shortcode($item['content']));
        }

        $output .= '</ul>';
        $output .= '</div>';
        $output .= '</div>';
    }

    return apply_filters('masterpiece_toolkit_shortcode_toggles', $output, $atts, $content);
}