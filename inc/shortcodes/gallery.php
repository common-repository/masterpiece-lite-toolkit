<?php 
remove_shortcode( 'gallery' );
add_shortcode( 'gallery', 'friday_toolkit_gallery' );

function friday_toolkit_gallery($atts, $content = null){
	extract(shortcode_atts(array('ids' => ''), $atts));
	$ids_array = explode(',', $ids);
	if($ids) : 
	?>
	<div class="kopa-owl-carousel kopa-owl-carousel-3 loader">
	    <div class="customNavigation">
	        <div class="inner"><a class="btn prev"><i class="fa fa-caret-left"></i></a><span class="current-slide"></span><span class="text-center">/</span><span class="total-slides"></span><a class="btn next"><i class="fa fa-caret-right"></i></a>
	        </div>
	    </div>
	    <!-- /.customNavigation-->
    	<div data-slider-item='1' data-slider-auto="false" data-slider-navigation="false" data-slider-pagination="false" class="kopa-owl-content owl-theme">
			<?php foreach ($ids_array as $id){
				// var_dump( $id );
				$url = wp_get_attachment_image_src( $id, 'friday_news-single-gallery-730x375');
				?>
					<div class="entry-item">
			            <div class="entry-thumb">
			                <a href="<?php echo esc_url( $url[0] ); ?>"><img src="<?php echo esc_url( $url[0] ); ?>" alt="" class="img-responsive">
			                </a>
			            </div>
			        </div>
		        <?php
				}
			?>
	    </div>
	</div>
	<?php
	endif;
}