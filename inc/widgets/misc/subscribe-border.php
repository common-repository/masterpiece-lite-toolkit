<?php

add_action( 'widgets_init', array('MT_Widget_Subscribe_Border', 'register_widget'));

class MT_Widget_Subscribe_Border extends Kopa_Widget {

	public $kpb_group = 'Misc';
	public $lines = array();

	public static function register_widget(){
		register_widget('MT_Widget_Subscribe_Border');
	}

	public function __construct() {
		$this->widget_cssclass    = 'widget-receive-email-main';
		$this->widget_description = esc_html__( 'Displays subscribe form. Style border.', 'masterpiece-lite-toolkit' );
		$this->widget_id          = 'masterpiece_toolkit_widget_subscribe_border';
		$this->widget_name        = esc_html__( 'Masterpiece - Subscribe Border', 'masterpiece-lite-toolkit' );
		
		$this->settings           = array(			
			'title'  => array(
				'type'  => 'text',
				'std'   => esc_html__( 'Stay in the know', 'masterpiece-lite-toolkit'),
				'label' => esc_html__( 'Title:', 'masterpiece-lite-toolkit'),
			),
			'label'  => array(
				'type'  => 'text',
				'std'   => esc_html__( 'Sign up to receive weekly updates from the W editors', 'masterpiece-lite-toolkit'),
				'label' => esc_html__( 'Label:', 'masterpiece-lite-toolkit'),
			),
			'button_text'  => array(
				'type'  => 'text',
				'std'   => esc_html__( 'Submit', 'masterpiece-lite-toolkit'),
				'label' => esc_html__( 'Button text:', 'masterpiece-lite-toolkit'),
			),
			'service'  => array(
				'type'  => 'select',
				'label' => esc_html__( 'Mailchimp / Feedburner', 'masterpiece-lite-toolkit'),
				'std'     => 'feedburner',
				'options' => array(
					'mailchimp'  => esc_html__('Mailchimp ', 'masterpiece-lite-toolkit'),
					'feedburner' => esc_html__('Feedburner', 'masterpiece-lite-toolkit'),
				)
			),
			'id'  => array(
				'type'  => 'text',
				'std'     => '',
				'label' => esc_html__( 'ID / URL', 'masterpiece-lite-toolkit'),
			),
		);

		parent::__construct();
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args((array) $instance, $this->get_default_instance());
		extract( $instance );
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		echo wp_kses_post( $before_widget );
		?>

		<?php if( $service == 'feedburner') : ?>
			<div class="widget-receive-email">
				<?php
					if( $title )
						echo '<h2>'.wp_kses_post( $title ).'</h2>';
					if( $label )
						echo '<p>'.wp_kses_post( $label ).'</p>';
				?>
				<form class="form-inline" method="post" action="http://feedburner.google.com/fb/a/mailverify" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_html( $id ); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520'); return true;">
					<textarea cols="30" rows="10" name="name" placeholder="<?php esc_html_e('Enter email to receive the BEST DAY', 'masterpiece-lite-toolkit'); ?>"></textarea>
					<input type="hidden" value="<?php echo esc_attr( $id ); ?>" name="uri">
					<input type="submit" value="<?php echo wp_kses_post( $button_text ); ?>" />
				</form>
			</div>
		<?php else : ?>
			<div class="widget-receive-email">
				<?php
					if( $title )
						echo '<h2>'.wp_kses_post( $title ).'</h2>';
					if( $label )
						echo '<p>'.wp_kses_post( $label ).'</p>';
				?>
				<form class="form-inline" method="post" action="<?php echo esc_url( $id ); ?>">
		            <textarea cols="30" rows="10" name="name" placeholder="<?php esc_html_e('Enter email to receive the BEST DAY', 'masterpiece-lite-toolkit'); ?>"></textarea>
		            <input type="hidden" value="<?php echo esc_url( $id ); ?>" name="uri">
		            <input type="submit" value="<?php echo wp_kses_post( $button_text ); ?>" />
		        </form>
	        </div>
		<?php endif; ?>

		<?php
		echo  wp_kses_post( $after_widget );
	}
}