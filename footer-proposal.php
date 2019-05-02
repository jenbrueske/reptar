<?php
/**
 * The template for displaying the footer
 */
	
	$post_option = iceberg_get_post_option(get_the_ID());
	if( empty($post_option['enable-footer']) || $post_option['enable-footer'] == 'default' ){
		$enable_footer = iceberg_get_option('general', 'enable-footer', 'enable');
	}else{
		$enable_footer = $post_option['enable-footer'];
	}	
	if( empty($post_option['enable-copyright']) || $post_option['enable-copyright'] == 'default' ){
		$enable_copyright = iceberg_get_option('general', 'enable-copyright', 'enable');
	}else{
		$enable_copyright = $post_option['enable-footer'];
	}

	$fixed_footer = iceberg_get_option('general', 'fixed-footer', 'disable');
	echo '</div>'; // iceberg-page-wrapper

	if( $enable_footer == 'enable' || $enable_copyright == 'enable' ){

		if( $fixed_footer == 'enable' ){
			echo '</div>'; // iceberg-body-wrapper

			echo '<footer class="iceberg-fixed-footer" id="iceberg-fixed-footer" >';
		}else{
			echo '<footer>';
		}

		if( $enable_footer == 'enable' ){

			echo '<div class="iceberg-footer-wrapper" >';
			echo '<div class="iceberg-footer-container iceberg-container clearfix" >';
			
			$iceberg_footer_layout = array(
				'footer-1'=>array('iceberg-column-60'),
				'footer-2'=>array('iceberg-column-15', 'iceberg-column-15', 'iceberg-column-15', 'iceberg-column-15'),
				'footer-3'=>array('iceberg-column-15', 'iceberg-column-15', 'iceberg-column-30',),
				'footer-4'=>array('iceberg-column-20', 'iceberg-column-20', 'iceberg-column-20'),
				'footer-5'=>array('iceberg-column-20', 'iceberg-column-40'),
				'footer-6'=>array('iceberg-column-40', 'iceberg-column-20'),
			);
			
			$count = 0;
			$footer_style = iceberg_get_option('general', 'footer-style');
			$footer_style = empty($footer_style)? 'footer-2': $footer_style;
			foreach( $iceberg_footer_layout[$footer_style] as $layout ){ $count++;
				echo '<div class="iceberg-footer-column iceberg-item-pdlr ' . esc_attr($layout) . '" >';
				if( is_active_sidebar('footer-' . $count) ){
					dynamic_sidebar('footer-' . $count); 
				}
				echo '</div>';
			}
			
			echo '</div>'; // iceberg-footer-container
			echo '</div>'; // iceberg-footer-wrapper 

		} // enable footer

		if( $enable_copyright == 'enable' ){
			$copyright_text = iceberg_get_option('general', 'copyright-text');

			if( !empty($copyright_text) ){
				echo '<div class="iceberg-copyright-wrapper" >';
				echo '<div class="iceberg-copyright-container iceberg-container">';
				echo '<div class="iceberg-copyright-text iceberg-item-pdlr">';
				echo iwd_core_text_filter($copyright_text);
				echo '</div>';
				echo '</div>';
				echo '</div>'; // iceberg-copyright-wrapper
			}
		}

		echo '</footer>';

		if( $fixed_footer == 'disable' ){
			echo '</div>'; // iceberg-body-wrapper
		}
		echo '</div>'; // iceberg-body-outer-wrapper

	// disable footer	
	}else{
		echo '</div>'; // iceberg-body-wrapper
		echo '</div>'; // iceberg-body-outer-wrapper
	}

	$header_style = iceberg_get_option('general', 'header-style', 'plain');
	
	if( $header_style == 'side' || $header_style == 'side-toggle' ){
		echo '</div>'; // iceberg-header-side-nav-content
	}

	$back_to_top = iceberg_get_option('general', 'enable-back-to-top', 'disable');
	if( $back_to_top == 'enable' ){
		echo '<a href="#iceberg-top-anchor" class="iceberg-footer-back-to-top-button" id="iceberg-footer-back-to-top-button"><i class="fa fa-angle-up" ></i></a>';
	}
?>

<?php wp_footer(); ?>

</body>
</html>