<?php

add_filter('kpb_get_widgets_list', array('MTP_Widget_Contact_Form', 'register_block'));

class MTP_Widget_Contact_Form extends Kopa_Widget {

    public $kpb_group = 'contact';

    public static function register_block($blocks){
        $blocks['MTP_Widget_Contact_Form'] = new MTP_Widget_Contact_Form();
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'master-widget-contact-right';
		$this->widget_description = esc_html__( 'Display contact form.', 'masterpiece-lite-toolkit' );
		$this->widget_id          = 'masterpiece-toolkit-plus-contact-form';
		$this->widget_name        = esc_html__( 'Masterpiece - Contact Form', 'masterpiece-lite-toolkit' );
		$this->settings 		  = array(
			'title'  => array(         
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title', 'masterpiece-lite-toolkit' )
			),
            'desc'  => array(
                'type'  => 'textarea',
                'std'   => '',
                'rows'  => 10,
                'label' => esc_html__('Description', 'masterpiece-lite-toolkit')
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
            <?php 
                if($desc)
                echo '<h3>'.wp_kses_post( $desc ).'</h3>';
            ?>
            <form action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" novalidate="novalidate" class="form-inline contact-form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="master-input-contact">
                            <label><?php esc_html_e('name','masterpiece-lite-toolkit'); ?></label>
                            <input type="text" placeholder="<?php esc_html_e('(required)', 'masterpiece-lite-toolkit'); ?>"  name="name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="master-input-contact">
                            <label><?php esc_html_e('email','masterpiece-lite-toolkit'); ?></label>
                            <input type="text" placeholder="<?php esc_html_e('(required)', 'masterpiece-lite-toolkit'); ?>" name="email">
                        </div>
                    </div>
                    <div class="col-md-12 master-textarea-border">
                        <div class="master-textarea-contact">
                            <label><?php esc_html_e('a message','masterpiece-lite-toolkit'); ?></label>
                            <textarea name="message" rows="5" required="required" placeholder="<?php esc_html_e('Message', 'masterpiece-lite-toolkit'); ?>"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="mas-res"><?php esc_html_e('Send','masterpiece-lite-toolkit'); ?></button>
                    </div> 
                    <div id="response"></div>
                    <input type="hidden" name="action" value="masterpiece_toolkit_plus_send_contact_widget">
                    <?php echo wp_nonce_field('masterpiece_toolkit_plus_send_contact_widget', 'ajax_nonce_masterpiece_toolkit_plus_send_contact_widget', true, false); ?>
                </div>
            </form>
        <?php
		echo wp_kses_post( $after_widget );
	}

}