<?php

add_action( 'widgets_init', array('MT_Widget_Posts_List_Slider_Vertical_1_Column', 'register_widget'));

class MT_Widget_Posts_List_Slider_Vertical_1_Column extends Kopa_Widget {

	public $kpb_group = 'post';
	public $lines = array();

	public static function register_widget(){
		register_widget('MT_Widget_Posts_List_Slider_Vertical_1_Column');
	}

	public function __construct() {
		$this->widget_cssclass    = 'master-widget-gallery';
		$this->widget_description = esc_html__( 'Display posts list slider vertical 1 columns.', 'masterpiece-lite-toolkit' );
		$this->widget_id          = 'mt-widget-posts-list-slider-vertical-1-column';
		$this->widget_name        = esc_html__( 'Masterpiece - Posts List Slider Vertical (1 Column)', 'masterpiece-lite-toolkit' );
		$this->settings 		  = masterpiece_toolkit_get_post_widget_args();
		$this->settings['num_post_per_page'] = array(
			'type'  => 'number',
			'std'   => 5,
			'label' => esc_html__( 'Number post in page:', 'masterpiece-lite-toolkit' ),
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
			$index = 0;
		?>
			<?php 
				if($title){
					echo wp_kses_post( $before_title.$title.$after_title );
				}
			?>
			<div class="master-gallery">
				<div class="owl-carousel" data-lazyLoad="true" data-navigation="true" data-items="1">
					<div class="item">
						<div class="entry-thum">
							<ul class="gallery clearfix">
								<?php while($result_set->have_posts()) : $result_set->the_post(); ?>
										<?php if( $index > 0 & $index % $num_post_per_page == 0){
											echo 	'</ul>
														</div>
															</div>
													<div class="item">
																<div class="entry-thum">
																	<ul class="gallery clearfix">';
											}
											$index++;
										?>
											<li>
												<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
													<?php the_post_thumbnail( 'masterpiece-lite-376x180' ); ?>
												</a>
											</li>
									
								<?php endwhile; ?>
							</ul>
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