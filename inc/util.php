<?php

function masterpiece_toolkit_get_post_widget_args(){
	
	$all_cats = get_categories();
	$categories = array('' => esc_html__('-- none --', 'masterpiece-lite-toolkit'));
	foreach ( $all_cats as $cat ) {
		$categories[ $cat->slug ] = $cat->name;
	}

	$all_tags = get_tags();
	$tags = array('' => esc_html__('-- none --', 'masterpiece-lite-toolkit'));
	foreach( $all_tags as $tag ) {
		$tags[ $tag->slug ] = $tag->name;
	}

	return array(
		'title'  => array(
			'type'  => 'text',
			'std'   => '',
			'label' => esc_html__( 'Title:', 'masterpiece-lite-toolkit' ),
		),
		'categories' => array(
			'type'    => 'multiselect',
			'std'     => '',
			'label'   => esc_html__( 'Categories:', 'masterpiece-lite-toolkit' ),
			'options' => $categories,
			'size'    => '5',
		),
		'relation'    => array(
			'type'    => 'select',
			'label'   => esc_html__( 'Relation:', 'masterpiece-lite-toolkit' ),
			'std'     => 'OR',
			'options' => array(
				'AND' => esc_html__( 'AND', 'masterpiece-lite-toolkit' ),
				'OR'  => esc_html__( 'OR', 'masterpiece-lite-toolkit' ),
			),
		),
		'tags' => array(
			'type'    => 'multiselect',
			'std'     => '',
			'label'   => esc_html__( 'Tags:', 'masterpiece-lite-toolkit' ),
			'options' => $tags,
			'size'    => '5',
		),
		'order' => array(
			'type'  => 'select',
			'std'   => 'DESC',
			'label' => esc_html__( 'Order:', 'masterpiece-lite-toolkit' ),
			'options' => array(
				'ASC'  => esc_html__( 'ASC', 'masterpiece-lite-toolkit' ),
				'DESC' => esc_html__( 'DESC', 'masterpiece-lite-toolkit' ),
			),
		),
		'orderby' => array(
			'type'  => 'select',
			'std'   => 'date',
			'label' => esc_html__( 'Orderby:', 'masterpiece-lite-toolkit' ),
			'options' => array(
				'date'          => esc_html__( 'Date', 'masterpiece-lite-toolkit' ),
				'rand'          => esc_html__( 'Random', 'masterpiece-lite-toolkit' ),
				'comment_count' => esc_html__( 'Number of comments', 'masterpiece-lite-toolkit' ),
			),
		),
		'number' => array(
			'type'    => 'number',
			'std'     => '5',
			'label'   => esc_html__( 'Number of posts:', 'masterpiece-lite-toolkit' ),
			'min'     => '1',
		)
	);
}

function masterpiece_toolkit_get_post_widget_query( $instance ){
	$query = array(
		'post_type'      => 'post',
		'posts_per_page' => $instance['number'],
		'order'          => $instance['order'] == 'ASC' ? 'ASC' : 'DESC',
		'orderby'        => $instance['orderby'],
		'ignore_sticky_posts' => true
	);

	if ( $instance['categories'] ) {		
		if($instance['categories'][0] == '')
			unset($instance['categories'][0]);

		if ( $instance['categories'] ) {
			$query['tax_query'][] = array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $instance['categories'],
			);
		}
	}

	if ( $instance['tags'] ) {
		if($instance['tags'][0] == '')
			unset($instance['tags'][0]);

		if ( $instance['tags'] ) {
			$query['tax_query'][] = array(
				'taxonomy' => 'post_tag',
				'field'    => 'slug',
				'terms'    => $instance['tags'],
			);
		}
	}

	if ( isset( $query['tax_query'] ) && 
		 count( $query['tax_query'] ) === 2 ) {
		$query['tax_query']['relation'] = $instance['relation'];
	}

	return apply_filters( 'masterpiece_toolkit_get_post_widget_query', $query );
}

function masterpiece_toolkit_get_shortcode($content, $enable_multi = false, $shortcodes = array()) {
    
	$codes         = array();
	$regex_matches = '';
	$regex_pattern = get_shortcode_regex();
    
    preg_match_all('/' . $regex_pattern . '/s', $content, $regex_matches);

    foreach ($regex_matches[0] as $shortcode) {
        $regex_matches_new = '';
        preg_match('/' . $regex_pattern . '/s', $shortcode, $regex_matches_new);

        if (in_array($regex_matches_new[2], $shortcodes)) :
            $codes[] = array(
				'shortcode' => $regex_matches_new[0],
				'type'      => $regex_matches_new[2],
				'content'   => $regex_matches_new[5],
				'atts'      => shortcode_parse_atts($regex_matches_new[3])
            );

            if (false == $enable_multi) {
                break;
            }
        endif;
    }

    return $codes;
}

function masterpiece_toolkit_set_view_count($post_id) {
    $new_view_count = 0;
    $meta_key = 'masterpiece_total_view';

    $current_views = (int) get_post_meta($post_id, $meta_key, true);

    if ($current_views) {
        $new_view_count = $current_views + 1;
        update_post_meta($post_id, $meta_key, $new_view_count);
    } else {
        $new_view_count = 1;
        add_post_meta($post_id, $meta_key, $new_view_count);
    }
    return $new_view_count;
}