<?php

add_shortcode('masterpiece_button', 'masterpiece_toolkit_shortcode_button');

function masterpiece_toolkit_shortcode_button($atts, $content = null) {
    extract(shortcode_atts(array('class' => '', 'link' => '', 'target' => ''), $atts));

    $link    = isset($atts['link']) ? $atts['link'] : '#';
    $class   = isset($atts['class']) ? $atts['class'] : '';
    $target  = isset($atts['target']) ? $atts['target'] : '';    
    $classes = explode(' ', $class);

    if(!$target){
        $target = '_self';
    }
    if( $content ){
        $output = sprintf('<div class="%s"><a href="%s" target="%s">%s</a></div>',$class ,$link ,$target, do_shortcode($content));
    }
    return apply_filters('masterpiece_toolkit_shortcode_button', $output);
}
