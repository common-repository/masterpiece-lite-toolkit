<?php

add_shortcode('masterpiece_dropcap', 'masterpiece_toolkit_shortcode_dropcap');

function masterpiece_toolkit_shortcode_dropcap($atts, $content = null) {
    if ($content) {
        extract(shortcode_atts(array('class' => ''), $atts));
        $class = isset($atts['class']) ? $atts['class'] : 'kopa-dropcap style-1';
        return apply_filters('masterpiece_toolkit_shortcode_dropcap', sprintf('<span class="%s">%s</span>', $class, $content), $atts, $content);
    }
}