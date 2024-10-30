<?php

add_action( 'widgets_init', array('MT_Widget_Subscribe', 'register_widget'));

class MT_Widget_Subscribe extends Kopa_Widget {

	public $kpb_group = 'Misc';
	public $lines = array();

	public static function register_widget(){
		register_widget('MT_Widget_Subscribe');
	}

	public function __construct() {
		$this->widget_cssclass    = 'footer-title';
		$this->widget_description = esc_html__( 'Displays subscribe form.', 'masterpiece-lite-toolkit' );
		$this->widget_id          = 'masterpiece_toolkit_widget_subscribe';
		$this->widget_name        = esc_html__( 'Masterpiece - Subscribe', 'masterpiece-lite-toolkit' );
		
		$this->settings           = array(			
			'title'  => array(
				'type'  => 'text',
				'std'   => esc_html__( 'Subscribe to smudge eats latest news', 'masterpiece-lite-toolkit'),
				'label' => esc_html__( 'Title:', 'masterpiece-lite-toolkit'),
			),
			'label'  => array(
				'type'  => 'text',
				'std'   => esc_html__( 'Enter email address', 'masterpiece-lite-toolkit'),
				'label' => esc_html__( 'Label:', 'masterpiece-lite-toolkit'),
			),
			'button_text'  => array(
				'type'  => 'text',
				'std'   => esc_html__( 'Subscribe', 'masterpiece-lite-toolkit'),
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
			<form class="form-inline" method="post" action="http://feedburner.google.com/fb/a/mailverify" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_html( $id ); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520'); return true;">
				<div class="form-group">
					<?php
						if( $title )
							echo '<span class="master-border">'.wp_kses_post( $title ).'</span>';
						if( $label )
							echo '<span class="master-label-email">'.wp_kses_post( $label ).'</span>';
					?>
					<input type="text" class="form-control" name="name">
					<input type="hidden" value="<?php echo esc_attr( $id ); ?>" name="uri">
					<input type="submit" value="<?php echo wp_kses_post( $button_text ); ?>" />
				</div>
			</form>
		<?php else : ?>
			<form class="form-inline" method="post" action="<?php echo esc_url( $id ); ?>">
				<div class="form-group">
					<?php
						if( $title )
							echo '<span class="master-border">'.wp_kses_post( $title ).'</span>';
						if( $label )
							echo '<span class="master-label-email">'.wp_kses_post( $label ).'</span>';
					?>
		            <input type="text" class="form-control" name="name">
		            <input type="hidden" value="<?php echo esc_url( $id ); ?>" name="uri">
		            <input type="submit" value="<?php echo wp_kses_post( $button_text ); ?>" />
	            </div>
	        </form>
		<?php endif; ?>
		<?php
		echo  wp_kses_post( $after_widget );
	}
}