<?php

add_action( 'kpb_get_widgets_list', array('MTP_Widget_Posts_List_Slider_Large_Thumb', 'register_block'));
	
class MTP_Widget_Posts_List_Slider_Large_Thumb extends Kopa_Widget {

	public $kpb_group = 'post';
	
	public static function register_block($blocks){
       	$blocks['MTP_Widget_Posts_List_Slider_Large_Thumb'] = new MTP_Widget_Posts_List_Slider_Large_Thumb();
        return $blocks;
    }
    
	public function __construct() {
		$this->widget_cssclass    = 'master-widget-slider-article';
		$this->widget_description = esc_html__( 'Display posts list slider thumb large. Title and content show on thumbnail.', 'masterpiece-lite-toolkit' );
		$this->widget_id          = 'masterpiece-toolkit-plus-widget-posts-list-slider-thumb-large';
		$this->widget_name        = esc_html__( 'Masterpiece - Posts List Slider Thumb Large', 'masterpiece-lite-toolkit' );
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
		$instance   = wp_parse_args((array) $instance, $this->get_default_instance());
		extract( $instance );
		$title      = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		echo wp_kses_post( $before_widget );
		$query      = masterpiece_toolkit_get_post_widget_query($instance);
		$result_set = new WP_Query( $query );
		$first      = true;
		?>
			<?php 
				if($title){
					echo wp_kses_post( $before_title.$title.$after_title );
				}
			?>
			<?php if($result_set->have_posts()) : ?>
				<div class="carousel slide" data-ride="carousel">
					<div class="carousel-inner" role="listbox">
						<?php while( $result_set->have_posts() ) : $result_set->the_post(); ?>
							<?php 
								if( $first ) {
									echo '<div class="item master-bg-slider-home2 active">';
									$first = false;
								}else{
									echo '<div class="item master-bg-slider-home2">';
								}
							?>
								<?php if(has_post_thumbnail()) : ?>
						      		<a href="<?php the_permalink(); ?>">
						      		<?php the_post_thumbnail( 'masterpiece-lite-870x355' ); ?>
						      		</a>
						      	<?php endif; ?>
						      	<div class="carousel-caption">
									<div class="entry-thum">
										<?php echo masterpiece_lite_get_first_category(get_the_id()); ?>
						       	 	</div>
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
						<?php endwhile; ?>
					</div>
				  	<a class="left carousel-control hidden-xs hidden-sm" href=".carousel" role="button" data-slide="prev">
					    <span class="fa fa-long-arrow-left" aria-hidden="true"></span>
					    <span class="sr-only"><?php esc_html_e('Previous', 'masterpiece-lite-toolkit'); ?></span>
				  	</a>
				  	<a class="right carousel-control hidden-xs hidden-sm" href=".carousel" role="button" data-slide="next">
					    <span class="fa fa-long-arrow-right" aria-hidden="true"></span>
					    <span class="sr-only"><?php esc_html_e('Next', 'masterpiece-lite-toolkit'); ?></span>
				  	</a>
	            </div>
        	<?php endif; ?>
		<?php
		wp_reset_postdata();
		echo wp_kses_post( $after_widget );
	}

}