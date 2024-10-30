<?php

add_action( 'widgets_init', array('MT_Widget_Posts_List_Slider_Vertical_2_Columns', 'register_widget'));

class MT_Widget_Posts_List_Slider_Vertical_2_Columns extends Kopa_Widget {

	public $kpb_group = 'post';
	public $lines = array();

	public static function register_widget(){
		register_widget('MT_Widget_Posts_List_Slider_Vertical_2_Columns');
	}

	public function __construct() {
		$this->widget_cssclass    = 'master-tag-article-main master-slider-medium-category';
		$this->widget_description = esc_html__( 'Display posts list slider vertical 2 columns.', 'masterpiece-lite-toolkit' );
		$this->widget_id          = 'mt-widget-posts-list-slider-vertical-2-columns';
		$this->widget_name        = esc_html__( 'Masterpiece - Posts List Slider Vertical (2 Columns)', 'masterpiece-lite-toolkit' );
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
			$thumb   = '';
			$content = '';
		?>
			<?php 
				if($title){
					echo wp_kses_post( $before_title.$title.$after_title );
				}
			?>
			<?php 
				while($result_set->have_posts()) : $result_set->the_post(); 
				add_filter( 'excerpt_length', 'masterpiece_lite_custom_excerpt_lenght_widget_'.$excerpt_length.'', 999 );
				$thumb .= 	'<div class="sp-thumbnail">
								<div class="sp-thumbnail-image-container">
									'.get_the_post_thumbnail( get_the_id(), 'masterpiece-lite-380x220', array('class' => 'sp-thumbnail-image')).'
									<div class="entry-thum">
										'.masterpiece_lite_get_first_category(get_the_id()).'
									</div>
								</div>
							</div>';
				$content .= '<div class="sp-slide">
								<a href="'.get_permalink(get_the_id()).'">
									'.get_the_post_thumbnail( get_the_id(), 'masterpiece-lite-380x467', array('class' => 'sp-image')).'
								</a>
								<div class="sp-caption">
									<div class="entry-thum">
										'.masterpiece_lite_get_first_category(get_the_id()).'
									</div>
									<h2><a href="'.get_permalink().'">'.get_the_title().'</a></h2>
									<p>'.get_the_excerpt().'</p>
								</div>
							</div>';
					remove_filter( 'excerpt_length', 'masterpiece_lite_custom_excerpt_lenght_widget_'.$excerpt_length.'', 999 );
				endwhile; 
			?>
			<div class="master-tag-article-content">
				<div class="row">
					<div class="slider-pro">
						<div class="hidden-xs hidden-sm sp-thumbnails">
							<?php echo sprintf( '%s', $thumb ); ?>
						</div>
						<div class="sp-slides">
							<?php echo sprintf( '%s', $content ); ?>
						</div>
				    </div>
				</div>
			</div>
		<?php
		endif;
		wp_reset_postdata();
		echo  wp_kses_post( $after_widget );
	}
}