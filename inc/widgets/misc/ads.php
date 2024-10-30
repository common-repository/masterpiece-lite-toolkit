<?php

add_action( 'widgets_init', array('MT_Widget_Ads', 'register_widget'));

class MT_Widget_Ads extends Kopa_Widget {

	public $kpb_group = 'Misc';
	public $lines = array();

	public static function register_widget(){
		register_widget('MT_Widget_Ads');
	}

	public function __construct() {
		$this->widget_cssclass    = 'widget-receive-adv';
		$this->widget_description = esc_html__( 'Displays ads image.', 'masterpiece-lite-toolkit' );
		$this->widget_id          = 'masterpiece_toolkit_widget_ads';
		$this->widget_name        = esc_html__( 'Masterpiece - Ads', 'masterpiece-lite-toolkit' );
		
		$this->settings           = array(			
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title:', 'masterpiece-lite-toolkit'),
			),
			'image'  => array(
				'type'  => 'upload',
				'std'   => '',
				'label' => esc_html__( 'Image:', 'masterpiece-lite-toolkit'),
				'mines' => 'image'
			),
			'url'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'URL:', 'masterpiece-lite-toolkit'),
			),
			'target'  => array(
				'type'    => 'radio',
				'label'   => esc_html__( 'Target', 'masterpiece-lite-toolkit'),
				'std'     => 1
			),
		);

		parent::__construct();
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args((array) $instance, $this->get_default_instance());
		extract( $instance );
		echo wp_kses_post( $before_widget );
		if( $target ){
			$target = '_self';
		}else{
			$target = '_blank';
		}
		?>
			<?php if( $image ) : ?>
				<?php echo '<a target="'.wp_kses_post( $target ).'" href="'.wp_kses_post( $url ).'"><img src="'.esc_url( $image ).'" alt=""></a>'; ?>
			<?php endif; ?>
		<?php
		echo  wp_kses_post( $after_widget );
	}
}