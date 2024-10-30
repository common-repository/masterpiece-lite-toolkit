<?php

add_action( 'widgets_init', array('MT_Widget_Posts_List_Video', 'register_widget'));

class MT_Widget_Posts_List_Video extends Kopa_Widget {

	public $kpb_group = 'post';
	public $lines = array();

	public static function register_widget(){
		register_widget('MT_Widget_Posts_List_Video');
	}

	public function __construct() {
		$this->widget_cssclass    = 'master-widget-list-video';
		$this->widget_description = esc_html__( 'Displays posts list video. Only show post format Video', 'masterpiece-lite-toolkit' );
		$this->widget_id          = 'masterpiece-toolkit-widget-posts-list-video';
		$this->widget_name        = esc_html__( 'Masterpiece - Posts List Video', 'masterpiece-lite-toolkit' );
		$this->settings 		  = masterpiece_toolkit_get_post_widget_args();
		$this->settings['excerpt_length'] = array(
			'type'  => 'select',
			'std'   => 20,
			'label' => esc_html__( 'Excerpt length:', 'masterpiece-lite-toolkit' ),
			'options' => array(
				'0' => '0',
				'10' => '10',
				'15' => '15',
				'20' => '20',
				'25' => '25',
				'30' => '30',
				'35' => '35',
				'40' => '40',
				'50' => '50',
				'60' => '60',
				'80' => '80',
				'100' => '100',
			),
			'desc' => esc_html__( 'Enter 0 to hide the excerpt.', 'masterpiece-lite-toolkit' ),
		);

		parent::__construct();
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args((array) $instance, $this->get_default_instance());
		extract( $instance );
		$title      = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$query      = masterpiece_toolkit_get_post_widget_query($instance);
		$result_set = new WP_Query( $query );
		echo wp_kses_post( $before_widget );
		if($result_set->have_posts()) :
		?>
			<div class="master-border-video hidden-md">
				<div class="master-border-video-ipad"></div>
			</div>
			<?php 
				if($title){
					echo wp_kses_post( $before_title.$title.$after_title );
				}
			?>
			<div class="owl-carousel">
				<?php while($result_set->have_posts()) : $result_set->the_post(); ?>
					<div class="item">
						<?php 
						$custom = get_post_meta(get_the_ID(), 'masterpiece_toolkit_custom', true);
						$url    = masterpiece_lite_get_url_embed_string( $custom, 'video' );
						if( get_post_format() == 'video' && $url ): ?>
						            <div class="entry-thum">
										<div class="master-video-container">
											<?php echo wp_oembed_get( $url,array('height'=> 230) ); ?>
										</div>
										<?php echo masterpiece_lite_get_first_category(get_the_id()); ?>
									</div>
						    <?php
					    else: 
					        if(has_post_thumbnail()) : ?>
					            <div class="entry-thum">
										<?php the_post_thumbnail('masterpiece-lite-380x220'); ?>
									<?php echo masterpiece_lite_get_first_category(get_the_id()); ?>
								</div>
					        <?php endif;
					    endif;
						?>

						<div class="entry-content">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<?php
								add_filter( 'excerpt_length', 'masterpiece_lite_custom_excerpt_lenght_widget_'.$excerpt_length.'', 999 );
								the_excerpt();
								remove_filter( 'excerpt_length', 'masterpiece_lite_custom_excerpt_lenght_widget_'.$excerpt_length.'', 999 );
                            ?>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php
		endif;
		wp_reset_postdata();
		echo  wp_kses_post( $after_widget );
	}
}

add_filter( 'oembed_fetch_url','add_param_oembed_fetch_url', 10, 3);
add_filter( 'oembed_result', 'add_player_id_to_iframe', 10, 3);

/** add extra parameters to vimeo request api (oEmbed) */
function add_param_oembed_fetch_url( $provider, $url, $args) {
    // unset args that WP is already taking care
    $newargs = $args;
    unset( $newargs['discover'] );
    unset( $newargs['width'] );
    unset( $newargs['height'] );

    // build the query url
    $parameters = urlencode( http_build_query( $newargs ) );

    return $provider . '&'. $parameters;
}

/** add player id to iframe id on vimeo */
function add_player_id_to_iframe( $html, $url, $args ) {
    if( isset( $args['player_id'] ) ) {
        $html = str_replace( '<iframe', '<iframe id="'. $args['player_id'] .'"', $html );
    }
    return $html;
}