<?php

add_shortcode('masterpiece_blockquote', 'mastepiece_toolkit_shortcode_blockquote');

function mastepiece_toolkit_shortcode_blockquote($atts, $content = null) {
    extract(shortcode_atts(array('class' => '', 'author' => '', 'author_url' => ''), $atts));

    $output = NULL;

    if (!empty($content)) {
        $output .= '<div class="master-widget-category3-blockquote">';
        $output .= sprintf('<blockquote class="%s"><p>%s</p>', $atts['class'], $content);

        if (isset($atts['author'])) {
            $output.= sprintf('<p><a href="%s"><span>%s</span></a></p>', $atts['author_url'], $atts['author']);
        }

        $output.= '</blockquote>';
        $output.= '</div>';
    }

    return apply_filters('mastepiece_toolkit_shortcode_blockquote', $output, $atts, $content);
}
