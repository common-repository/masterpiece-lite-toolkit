<?php

function masterpiece_toolkit_footer(){
    wp_nonce_field('masterpiece_toolkit_set_view_count', 'masterpiece_toolkit_set_view_count_wpnonce', false);
}

function masterpiece_toolkit_enqueue_scripts(){
	wp_enqueue_script('masterpiece-toolkit-set-view-count', MASTERPIECE_LITE_DIR . '/assets/js/set-view-count.js', array('jquery'), null, true);
}

function masterpiece_toolkit_meta_box_wrap_start($wrap, $value, $loop_index){
	if(0 == $loop_index){
		$wrap = '<div class="fd-metabox-wrap fd-metabox-wrap-first fd-row">';
	}else{
		$wrap = '<div class="fd-metabox-wrap fd-row">';	
	}
	
	if ( $value['title'] ) {
		$wrap .= '<div class="fd-col-xs-3">';
		$wrap .= esc_html($value['title']);
		$wrap .= '</div>';
		$wrap .= '<div class="fd-col-xs-9">';
	}else{
		$wrap .= '<div class="fd-col-xs-12">';
	}

	return $wrap;
}

function masterpiece_toolkit_meta_box_wrap_end($wrap, $value, $loop_index){
	$wrap = '';

	if ( $value['desc'] ) {
		$wrap .= '<p class="fd-help">'. $value['desc'] . '</p>';		
	}

	$wrap .= '</div>';
	$wrap .= '</div>';

	return $wrap;
}

function masterpiece_toolkit_register_metabox_post_featured(){
    $post_type = array('post');
    
    $args = array(
		'id'       => 'masterpiece-post-options-metabox',
		'title'    => esc_html__('Featured content', 'masterpiece-lite-toolkit'),
		'desc'     => '',
		'pages'    => $post_type,
		'context'  => 'normal',
		'priority' => 'low',
		'fields'   => array(    
			array(
				'title' => esc_html__('Show / Hide featured in single.', 'masterpiece-lite-toolkit'),
				'type'  => 'select',
				'id'    => 'masterpiece_toolkit_featured_status',
				'default' => 'show',
				'options' => array(
					'show'   => esc_html__('Show', 'masterpiece-lite-toolkit'),
					'hide'   => esc_html__('Hide', 'masterpiece-lite-toolkit'),
				),
            ),                     
            array(
				'title' => esc_html__('Gallery:', 'masterpiece-lite-toolkit'),
				'type'  => 'gallery',
				'id'    => 'masterpiece_toolkit_gallery',
				'desc'  => esc_html__('This option only apply for post-format "Gallery".', 'masterpiece-lite-toolkit'),
            ),
            array(
				'title' => esc_html__('Quote:', 'masterpiece-lite-toolkit'),
				'type'  => 'quote',
				'id'    => 'masterpiece_toolkit_quote',
				'desc'  => esc_html__('This option only apply for post-format "Quote".', 'masterpiece-lite-toolkit'),
            ),
            array(
				'title' => esc_html__('Custom:', 'masterpiece-lite-toolkit'),
				'type'  => 'textarea',
				'id'    => 'masterpiece_toolkit_custom',
				'desc'  => esc_html__('Enter custom content as shortcode or custom HTML, ...', 'masterpiece-lite-toolkit'),
            ),                  
        )
    );          
    
    kopa_register_metabox( $args );	
}

function masterpiece_toolkit_add_social_field($profile_fields){
	// Add new fields
	$profile_fields['facebook']  = 'Facebook URL';
	$profile_fields['youtube']   = 'Youtube URL';
	$profile_fields['twitter']   = 'Twitter URL';
	$profile_fields['pinterest'] = 'Pinterest URL';
	$profile_fields['tumblr']    = 'Tumblr URL';

	return $profile_fields;
}

function masterpiece_toolkit_add_socials_share_left_post() {
	$id = get_the_id();
	?>
		<p class="master-social-fist"><a target="_blank" rel="nofollow" href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink($id)); ?>"><i class="fa fa-envelope"></i> <?php esc_html_e('G+', 'masterpiece-lite'); ?></a></p>
		<p><a target="_blank" rel="nofollow" href="https://www.facebook.com/share.php?u=<?php echo esc_url(get_permalink($id)); ?>" class="master-social-other"><i class="fa fa-facebook-official"></i> <?php esc_html_e('FB', 'masterpiece-lite'); ?></a></p>
		<p><a target="_blank" rel="nofollow" href="https://twitter.com/home?status=<?php echo str_replace(' ', '%20', get_the_title($id)). ':' . esc_url(get_permalink($id)); ?>"><i class="fa fa-twitter"></i> <?php esc_html_e('Tweet', 'masterpiece-lite'); ?></a></p>
		<p><a href="javascript:window.print()"><i class="fa fa-print"></i> <?php esc_html_e('Print', 'masterpiece-lite'); ?></a></p>
	<?php
}

function masterpiece_toolkit_add_socials_share_bottom_title() {
	$id = get_the_id();
	?>
	<div class="master-social">
		<a target="_blank" rel="nofollow" href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink($id)); ?>"><i class="fa fa-envelope"></i> <?php esc_html_e('G+', 'masterpiece-lite'); ?></a>
		<a target="_blank" rel="nofollow" href="https://www.facebook.com/share.php?u=<?php echo esc_url(get_permalink($id)); ?>" class="master-social-other"><i class="fa fa-facebook-official"></i> <?php esc_html_e('Facebook', 'masterpiece-lite'); ?></a>
		<a target="_blank" rel="nofollow" href="https://twitter.com/home?status=<?php echo str_replace(' ', '%20', get_the_title($id)). ':' . esc_url(get_permalink($id)); ?>"><i class="fa fa-twitter"></i> <?php esc_html_e('Tweet', 'masterpiece-lite'); ?></a>
		<a href="javascript:window.print()"><i class="fa fa-print"></i> <?php esc_html_e('Print', 'masterpiece-lite'); ?></a>
	</div>
	<?php
}
