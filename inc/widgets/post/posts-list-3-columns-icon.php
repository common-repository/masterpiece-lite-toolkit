<?php

add_action( 'kpb_get_widgets_list', array('MTP_Widget_Posts_List_3_Columns_Icon', 'register_block'));
	
class MTP_Widget_Posts_List_3_Columns_Icon extends Kopa_Widget {

	public $kpb_group = 'post';
	
	public static function register_block($blocks){
       	$blocks['MTP_Widget_Posts_List_3_Columns_Icon'] = new MTP_Widget_Posts_List_3_Columns_Icon();
        return $blocks;
    }
    
	public function __construct() {
		$this->widget_cssclass    = 'master-article-thumb-medium';
		$this->widget_description = esc_html__( 'Display posts list 3 columns. Icon postformat.', 'masterpiece-lite-toolkit' );
		$this->widget_id          = 'masterpiece-toolkit-plus-widget-posts-list-3-columns-icon';
		$this->widget_name        = esc_html__( 'Masterpiece - Posts List 3 Columns ( Icon )', 'masterpiece-lite-toolkit' );
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
			'desc' => esc_html__( 'Select 0 to hide the excerpt.', 'masterpiece-lite-toolkit' ),
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
		$index = 1;
		?>
			<?php 
				if($title){
					echo wp_kses_post( $before_title.$title.$after_title );
				}
			?>
			<?php if($result_set->have_posts()) : ?>
				<div class="row">
					<?php while( $result_set->have_posts() ) : $result_set->the_post(); ?>
						<div class="col-xs-12 col-sm-12 col-md-4">
							<?php if(has_post_thumbnail()) : ?>
								<div class="entry-thum">
									<a href="<?php the_permalink();?>">
										<?php the_post_thumbnail( 'masterpiece-lite-380x245', array( 'class' => 'lazyOwl') ); ?>
									</a>
									<?php echo masterpiece_lite_get_first_category(get_the_id()); ?>
									<?php echo masterpiece_lite_get_icon_postformat(get_the_id()); ?>
								</div>
							<?php endif; ?>
							<div class="entry-content">
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<?php
									add_filter( 'excerpt_length', 'masterpiece_lite_custom_excerpt_lenght_widget_'.$excerpt_length.'', 999 );
									the_excerpt();
									remove_filter( 'excerpt_length', 'masterpiece_lite_custom_excerpt_lenght_widget_'.$excerpt_length.'', 999 );
                                ?>
							</div>
						</div>
						<?php if($index % 3 == 0){
								echo '</div><div class="row">';
							}
						?>
					<?php $index++; endwhile; ?>
	            </div>
        	<?php endif; ?>
		<?php
		wp_reset_postdata();
		echo wp_kses_post( $after_widget );
	}

}