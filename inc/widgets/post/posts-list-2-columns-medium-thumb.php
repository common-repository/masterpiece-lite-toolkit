<?php

add_action( 'kpb_get_widgets_list', array('MTP_Widget_Posts_List_2_Columns_Medium_Thumb', 'register_block'));
	
class MTP_Widget_Posts_List_2_Columns_Medium_Thumb extends Kopa_Widget {

	public $kpb_group = 'post';
	
	public static function register_block($blocks){
       	$blocks['MTP_Widget_Posts_List_2_Columns_Medium_Thumb'] = new MTP_Widget_Posts_List_2_Columns_Medium_Thumb();
        return $blocks;
    }
    
	public function __construct() {
		$this->widget_cssclass    = 'master-widget-article-category-thumb-medium';
		$this->widget_description = esc_html__( 'Display posts list 2 columns. Medium thumb.', 'masterpiece-lite-toolkit' );
		$this->widget_id          = 'masterpiece-toolkit-plus-widget-posts-list-2-columns-medium-thumb';
		$this->widget_name        = esc_html__( 'Masterpiece - Posts List 2 Columns (Medium Thumb)', 'masterpiece-lite-toolkit' );
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
		$this->settings['number_of_page'] = array(
			'type'  => 'number',
			'std'   => 2,
			'label' => esc_html__( 'Number of pages:', 'masterpiece-lite-toolkit' ),
			'desc' => esc_html__( 'Realy post per page is : Number of pages x 2', 'masterpiece-lite-toolkit' ),
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
		$real_post  = count( $result_set->posts );
		$first      = true;
		$index      = 2;
		?>
			<?php 
				if($title){
					echo wp_kses_post( $before_title.$title.$after_title );
				}
			?>
			<?php if($result_set->have_posts()) : ?>
				<?php $number_items = $real_post / 2; ?>
				<input type="hidden" id="current_page_<?php echo esc_attr($this->number);?>">
                <input type="hidden" id="show_per_page_<?php echo esc_attr($this->number);?>">
                <div id="kopa-pagination-ul-<?php echo esc_attr($this->number); ?>" 
                        data-currentpage="#current_page_<?php echo esc_attr($this->number);?>"
                        data-showperpage="#show_per_page_<?php echo esc_attr($this->number);?>"
                        data-pagination="#kopa-pagination-<?php echo esc_attr($this->number);?>"
                        data-id="#kopa-pagination-ul-<?php echo esc_attr($this->number);?>"
                        data-number-of-page="<?php echo esc_attr( $number_of_page ); ?>"
                        data-number-items="<?php echo esc_attr( $number_items ); ?>"
                        class="idstart" >
				<?php while( $result_set->have_posts() ) : $result_set->the_post(); ?>
						<?php 
							if( $index % 2 == 0 && $first ) {
								echo '<div class="row master-row-custom-other">';
								$first = false;
							}elseif( $index % 2 == 0){
								echo '<div class="row master-row-custom-other">';
							}
						?>
							<div class="col-xs-12 col-md-6 master-thum-article">
								<?php if(has_post_thumbnail()) : ?>
									<div class="entry-thum">
										<a href="<?php the_permalink();?>">
											<?php the_post_thumbnail( 'masterpiece-lite-584x350' ); ?>
										</a>
										<?php echo masterpiece_lite_get_first_category(get_the_id()); ?>
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
						<?php 
							if($index % 2 == 1 || $index == $real_post + 1){
								echo '</div>';
							}
						?>
				<?php $index++; endwhile; ?>
				</div>
				<?php if($real_post / ($number_of_page*2) > 1) : ?>
					<div class=" pagination clearfix kopa-pagination-<?php echo $this->number;?> kopa-pagination" id="kopa-pagination-<?php echo $this->number;?>">
	                    <ul class="page-numbers clearfix">
	                    </ul>
	                </div>
	            <?php endif; ?>
			<?php endif; ?>
		<?php
		wp_reset_postdata();
		echo wp_kses_post( $after_widget );
	}

}