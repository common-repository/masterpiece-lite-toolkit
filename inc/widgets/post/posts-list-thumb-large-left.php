<?php

add_action( 'widgets_init', array('MT_Widget_Posts_List_Thumb_Large_Left', 'register_widget'));

class MT_Widget_Posts_List_Thumb_Large_Left extends Kopa_Widget {

	public $kpb_group = 'post';
	public $lines = array();

	public static function register_widget(){
		register_widget('MT_Widget_Posts_List_Thumb_Large_Left');
	}

	public function __construct() {
		$this->widget_cssclass    = 'master-article-thum-large-category';
		$this->widget_description = esc_html__( 'Show posts list slider thumb large, thumb in left, content in right.', 'masterpiece-lite-toolkit' );
		$this->widget_id          = 'masterpiece-toolkit-widget-posts-list-thumb-large-left';
		$this->widget_name        = esc_html__( 'Masterpiece - Posts List Slider Thumb Large (Left)', 'masterpiece-lite-toolkit' );
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
		?>
			<?php 
				if($title){
					echo wp_kses_post( $before_title.$title.$after_title );
				}
			?>
			<div class="master-article-content">
				<div class="owl-carousel" data-lazyLoad="true" data-navigation="true" data-items="1">
				<?php while($result_set->have_posts()) : $result_set->the_post(); ?>
					<div class="item">
						<div class="row master-category2-section-custom-1">
							<?php if( has_post_thumbnail() ) : ?>
								<div class="col-sm-8 col-md-9 master-custom-left">
									<div class="widget master-widget-article-thum-large-left">
										<div class="entry-thum">
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail( 'masterpiece-lite-870x404' ); ?>
											</a>
											<?php echo masterpiece_lite_get_first_category(get_the_id()); ?>
										</div>
									</div>
								</div>
							<?php endif; ?>
							<?php 
								if( has_post_thumbnail() ) {
									echo '<div class="col-sm-4 col-md-3 master-custom-right">';
								}else{
									echo '<div class="col-sm-12 col-md-12">';
								}
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
						</div>
					</div>
				<?php endwhile; ?>
				</div>
			</div>
		<?php
		endif;
		wp_reset_postdata();
		echo  wp_kses_post( $after_widget );
	}
}