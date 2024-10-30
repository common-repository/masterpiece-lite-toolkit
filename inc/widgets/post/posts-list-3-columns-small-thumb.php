<?php

add_action( 'widgets_init', array('MTP_Widget_Posts_List_3_Columns_Small_Thumb', 'register_widget'));
	
class MTP_Widget_Posts_List_3_Columns_Small_Thumb extends Kopa_Widget {

	public $kpb_group = 'post';
	
	public static function register_widget(){
       	register_widget('MTP_Widget_Posts_List_3_Columns_Small_Thumb');
    }
    
	public function __construct() {
		$this->widget_cssclass    = 'master-widget-sub-menu';
		$this->widget_description = esc_html__( 'Display posts list 3 columns (small thumb). Recommend use in Mega Menu.', 'masterpiece-toolkit-plus' );
		$this->widget_id          = 'mtp-widget-posts-list-3-columns-small-thumb';
		$this->widget_name        = esc_html__( 'Masterpiece - Posts List 3 Columns (Small Thumb)', 'masterpiece-toolkit-plus' );
		$this->settings 		  = masterpiece_toolkit_get_post_widget_args();

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
		$real_post  = count($result_set->posts);
		?>
			<?php 
				if($title){
					echo wp_kses_post( $before_title.$title.$after_title );
				}
			?>
			<?php if($result_set->have_posts()) : ?>
				<div class="sub-menu">
					<div class="row">
						<?php while( $result_set->have_posts() ) : $result_set->the_post(); ?>
							<div class="col-md-4 sf-mega-section">
								<div class="entry-item">
									<?php if( has_post_thumbnail() ) : ?>
					            		<div class="entry-thum">
							              	<?php the_post_thumbnail( 'masterpiece-lite-107x80' ); ?>
							            </div>
						            <?php endif; ?>
						            <div class="entry-content">
						              	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						            </div>
				            	</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php
		wp_reset_postdata();
		echo wp_kses_post( $after_widget );
	}

}