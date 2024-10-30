<?php

add_filter('kpb_get_widgets_list', array('MTP_Widget_Contact_Info', 'register_block'));

class MTP_Widget_Contact_Info extends Kopa_Widget {

    public $kpb_group = 'contact';

    public static function register_block($blocks){
        $blocks['MTP_Widget_Contact_Info'] = new MTP_Widget_Contact_Info();
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'master-widget-contact-left';
		$this->widget_description = esc_html__( 'Display contact info, email, phone, address. Image background', 'masterpiece-lite-toolkit' );
		$this->widget_id          = 'masterpiece-toolkit-plus-widget-contact-info';
		$this->widget_name        = esc_html__( 'Masterpiece - Contact Info', 'masterpiece-lite-toolkit' );
		$this->settings 		  = array(
			'title'  => array(         
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title:', 'masterpiece-lite-toolkit' )
			),            
            'address'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__('Address:', 'masterpiece-lite-toolkit')
            ),
			'phone'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__('Phone:', 'masterpiece-lite-toolkit')
            ),		            
            'email'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__('Email:', 'masterpiece-lite-toolkit')
            ),
            'tumblr'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Tumblr:', 'masterpiece-lite-toolkit' )
            ),
            'place'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Gmap - Place:', 'masterpiece-lite-toolkit' )
            ),
            'latitude'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Gmap - Latitude:', 'masterpiece-lite-toolkit' )
            ),
            'longitude'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Gmap - Longitude:', 'masterpiece-lite-toolkit' )
            )
		);	

		parent::__construct();
	}

	public function widget( $args, $instance ) {
        extract( $args );
        $instance = wp_parse_args((array) $instance, $this->get_default_instance());
        extract( $instance );
        $title    = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        echo wp_kses_post( $before_widget );
        ?>
            <div class="widget-about">
                <h4><?php echo wp_kses_post( $title ); ?></h4>
            </div>
            <div class="widget-address">
                <ul>
                    <?php 
                        if($address){
                            echo '<li><i class="fa fa-map-marker"></i><p class="address">'.wp_kses_post( $address ).'</p>';
                            if( $place && $latitude && $longitude){
                                echo '<a href="https://www.google.com/maps/place/Kopasoft+Coporation/@21.0295798,105.7825549,17z/data=!3m1!4b1!4m2!3m1!1s0x3135ab4cf4c65dd5:0xbdd1574566258c7f" class="map">'.esc_html__('map it', 'masterpiece-lite-toolkit' ).'</a>';
                            }
                            echo '</li>';
                        }
                    
                        if( $email ){
                            echo '<li><i class="fa fa-envelope"></i><a href="mailto:'.esc_attr( $email ).'" class="mail">'.wp_kses_post( $email ).'</a></li>';
                        }

                        if( $phone ){
                            echo '<li><i class="fa fa-phone"></i><a href="callto:'.esc_attr( $phone ).'" class="phone">'.wp_kses_post( $phone ).'</a></li>';
                        }

                        if( $tumblr ){
                            echo '<li><i class="fa fa-tumblr"></i><p class="tum">'.wp_kses_post( $tumblr ).'</p></li>';
                        }
                    ?>
                </ul>
            </div>
        <?php
		echo wp_kses_post( $after_widget );
	}

}