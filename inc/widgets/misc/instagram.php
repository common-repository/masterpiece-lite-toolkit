<?php

add_action( 'widgets_init', array('MT_Widget_Instagram', 'register_widget'));

class MT_Widget_Instagram extends Kopa_Widget {

	public $kpb_group = 'Misc';

	public static function register_widget(){
		register_widget('MT_Widget_Instagram');
	}

	public function __construct() {
		$this->widget_cssclass    = 'master-footer-middle';
		$this->widget_description = esc_html__( 'Display photo instagram.', 'masterpiece-lite-toolkit' );
		$this->widget_id          = 'masterpiece_toolkit_instagram';
		$this->widget_name        = esc_html__( 'Masterpiece - Photo Instagram', 'masterpiece-lite-toolkit' );
		
		$this->settings           = array(			
			'title'  => array(
				'type'  => 'text',
				'std'   => esc_html__( 'Instagram', 'masterpiece-lite-toolkit'),
				'label' => esc_html__( 'Title:', 'masterpiece-lite-toolkit')
			),			
			'desc'  => array(
                'type'  => 'textarea',
                'std'   => '',
                'label' => esc_html__( 'Description:', 'masterpiece-lite-toolkit' )
            ),
			'user_id'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'User id:', 'masterpiece-lite-toolkit' )
			),		
            'access_token'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Access token key:', 'masterpiece-lite-toolkit' )
            ),
            'number_photo'  => array(
                'type'  => 'text',
                'std'   => 4,
                'label' => esc_html__( 'Number photo:', 'masterpiece-lite-toolkit' )
            )
        );


		parent::__construct();
	}

	public function widget( $args, $instance ) {	
		extract( $args );
		$instance = wp_parse_args((array) $instance, $this->get_default_instance());
		extract( $instance );
		echo wp_kses_post( $before_widget );
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);		
		?>
            <div class="row master-custom-footer-middle-row-1">
                <?php if( $title || $desc ) : ?>
                    <div class="col-xs-12 col-sm-4 col-md-2 master-custom-left">
                        <div class="master-instagram-content">
                            <?php
                                if( $title )
                                    echo '<h2>'.wp_kses_post( $title ).'</h2>';
                                if( $desc )
                                    echo '<p>'.wp_kses_post( $desc ).'</p>';
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="master-instagram-info" data-accessid="<?php echo wp_kses_post( $user_id ); ?>" data-accesstoken="<?php echo wp_kses_post( $access_token ); ?>" data-number="<?php echo wp_kses_post( $number_photo );?>"></div>
               <div class="hidden-xs hidden-sm col-xs-12 col-sm-8 col-md-10 master-custom-right">
					<div class="row"></div>
				</div>
				<div class="visible-xs visible-sm hidden-md col-xs-12 col-sm-8 col-md-9 master-custom-right">
					<div class="row"></div>
				</div>
            </div>
		<?php
		echo wp_kses_post( $after_widget );
	}
}



