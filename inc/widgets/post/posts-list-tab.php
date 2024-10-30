<?php

add_action( 'widgets_init', array('MTP_Widget_Posts_List_Tab', 'register_widget'));

class MTP_Widget_Posts_List_Tab extends Kopa_Widget {

	public $kpb_group = 'post';
	
	public static function register_widget(){
		register_widget('MTP_Widget_Posts_List_Tab');
	}

	public function __construct() {
		$all_cats = get_categories();
		$categories = array('' => esc_html__('-- none --', 'masterpiece-toolkit-plus'));
		foreach ( $all_cats as $cat ) {
			$categories[ $cat->slug ] = $cat->name;
		}
		$this->widget_cssclass    = 'master-menu-tab';
		$this->widget_description = esc_html__( 'Displays posts list tab, no thumb. Recommend use in Mega Menu.', 'masterpiece-toolkit-plus' );
		$this->widget_id          = 'masterpiece_toolkit_plus_widget_posts-list-tab';
		$this->widget_name        = esc_html__( 'Masterpiece - Posts List Tab', 'masterpiece-toolkit-plus' );
		$this->settings           = array(			
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title:', 'masterpiece-toolkit-plus'),
			),
			'category'  => array(
				'type'  => 'multiselect',
				'std'   => '',
				'label' => esc_html__( 'Category:', 'masterpiece-toolkit-plus'),
				'options' => $categories
			),
			'posts_per_page'  => array(
				'type'  => 'number',
				'std'   => 5,
				'label' => esc_html__( 'Post Per Page:', 'masterpiece-toolkit-plus'),
			),
			'excerpt_length' => array(
				'type'  => 'select',
				'std'   => 20,
				'label' => esc_html__( 'Excerpt length:', 'masterpiece-toolkit-plus' ),
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
				'desc' => esc_html__( 'Enter 0 to hide the excerpt.', 'masterpiece-toolkit-plus' ),
			),
		);

		parent::__construct();
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$instance   = wp_parse_args((array) $instance, $this->get_default_instance());
		extract( $instance );
		$tablist    = '';
		$tabcontent = '';
		$first      = true;
		foreach ($category as $slug) {
			$cat_obj = get_category_by_slug($slug);
			$cat_name = $cat_obj->name;
			if($first){
				$tablist .= '<li role="presentation" class="active"><a href="#'.$slug.'" aria-controls="'.$slug.'" role="tab" data-toggle="tab">'.$cat_name.'</a></li>';
			}else{
				$tablist .= '<li role="presentation"><a href="#'.$slug.'" aria-controls="'.$slug.'" role="tab" data-toggle="tab">'.$cat_name.'</a></li>';
			}

			$args = array(
				'cat'            => $cat_obj->term_id,
				'posts_per_page' => $posts_per_page,
			);
			
			$result_set     = new WP_Query( $args );
			if($first){
				$tabcontent .= '<div role="tabpanel" class="tab-pane active" id="'.$slug.'">';
				$first      = false;
			}else{
				$tabcontent .= '<div role="tabpanel" class="tab-pane" id="'.$slug.'">';
			}
			$tabcontent .= '<div class="master-widget-sub-menu">';
			$tabcontent .= '<div class="row">';
			if($result_set->have_posts()) : while($result_set->have_posts()) : $result_set->the_post();
				$tabcontent .= '<div class="col-md-4 sf-mega-section">
									<h2><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
				add_filter( 'excerpt_length', 'masterpiece_lite_custom_excerpt_lenght_widget_'.$excerpt_length.'', 999 );
				$tabcontent .= '<p>'.get_the_excerpt().'</p>';
				remove_filter( 'excerpt_length', 'masterpiece_lite_custom_excerpt_lenght_widget_'.$excerpt_length.'', 999 );
				$tabcontent .= '</div>';
			endwhile; endif;
			wp_reset_postdata();
			$tabcontent .= '</div>';
			$tabcontent .= '</div>';
			$tabcontent .= '</div>';
		}
		echo wp_kses_post( $before_widget );
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
		echo  wp_kses_post( $after_widget );
	}
}

