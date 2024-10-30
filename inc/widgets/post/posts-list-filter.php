<?php

add_action( 'kpb_get_widgets_list', array('MTP_Widget_Posts_List_Filter', 'register_block'));
	
class MTP_Widget_Posts_List_Filter extends Kopa_Widget {

	public $kpb_group = 'post';
	
	public static function register_block($blocks){
       	$blocks['MTP_Widget_Posts_List_Filter'] = new MTP_Widget_Posts_List_Filter();
        return $blocks;
    }
    
	public function __construct() {
		$all_cats = get_categories();
		$categories = array('' => esc_html__('-- none --', 'masterpiece'));
		foreach ( $all_cats as $cat ) {
			$categories[ $cat->slug ] = $cat->name;
		}
		$this->widget_cssclass    = 'master-article-main-thumb-medium hidden-xs';
		$this->widget_description = esc_html__( 'Display posts list with filter.', 'masterpiece-lite-toolkit' );
		$this->widget_id          = 'masterpiece-toolkit-plus-widget-posts-list-filter';
		$this->widget_name        = esc_html__( 'Masterpiece - Posts List Filter', 'masterpiece-lite-toolkit' );
		$this->settings           = array(			
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title:', 'masterpiece-lite-toolkit'),
			),
			'category'  => array(
				'type'  => 'multiselect',
				'std'   => '',
				'label' => esc_html__( 'Category:', 'masterpiece-lite-toolkit'),
				'options' => $categories
			),
			'posts_per_page'  => array(
				'type'  => 'number',
				'std'   => '5',
				'label' => esc_html__( 'Posts per page:', 'masterpiece-lite-toolkit'),
			),
		);

		parent::__construct();
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args((array) $instance, $this->get_default_instance());
		extract( $instance );
		$title    = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		echo wp_kses_post( $before_widget );
		$first      = true;
		$tablist    = '';
		$tabcontent = '';
		foreach ($category as $slug) {
			$cat_obj = get_category_by_slug($slug);
				$cat_name = $cat_obj->name;
				if($first){
				$tablist .= '<li role="presentation" class="active"><a href="#'.$slug.'" aria-controls="'.$slug.'" role="tab" data-toggle="tab" aria-expanded="true">'.$cat_name.'</a></li>';
			}else{
				$tablist .= '<li role="presentation"><a href="#'.$slug.'" aria-controls="'.$slug.'" role="tab" data-toggle="tab" aria-expanded="true">'.$cat_name.'</a></li>';
			}

			$args = array(
				'cat'            => $cat_obj->term_id,
				'posts_per_page' => $posts_per_page,
			);
			
			$result_set     = new WP_Query( $args );
			$loop_index     = 0;
			$number_per_row = 3;
			if($first){
				$tabcontent .= '<div role="tabpanel" class="tab-pane active" id="'.$slug.'">';
				$first      = false;
			}else{
				$tabcontent .= '<div role="tabpanel" class="tab-pane" id="'.$slug.'">';
			}
			$tabcontent .= '<div class="row">';
			if($result_set->have_posts()) : while($result_set->have_posts()) : $result_set->the_post();
				if( $loop_index > 0 & $loop_index % $number_per_row == 0){
					$tabcontent .= '</div><div class="row">';
				}
				$loop_index++;
				$tabcontent .= '<div class="col-md-4">';
				if(has_post_thumbnail()){
					$tabcontent .= 	'<div class="entry-item"><div class="entry-thum">
										<a href="'.get_permalink().'">'.get_the_post_thumbnail( get_the_id(), 'masterpiece-lite-269x156' ).'</a>
									</div>';
				}	
				$tabcontent .= 		'<div class="entry-content">
									<h2><a href="'.get_permalink().'">'.get_the_title().'</a></h2>
									</div>
								</div></div>';
			endwhile; endif;
			wp_reset_postdata();
			$tabcontent .= '</div>';
			$tabcontent .= '</div>';
		}
		?>
			<?php 
				if($title){
					echo wp_kses_post( $before_title.$title.$after_title );
				}
			?>
			<ul class="nav nav-tabs" role="tablist">
			    <?php echo sprintf('%s', $tablist); ?>
			</ul>
			<div class="tab-content">
			    <?php echo sprintf('%s', $tabcontent); ?>
			</div>
		<?php
		echo wp_kses_post( $after_widget );
	}
	
}