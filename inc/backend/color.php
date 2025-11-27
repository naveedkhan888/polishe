<?php 


//Custom Style Frontend
if(!function_exists('polishe_color_scheme')){
    function polishe_color_scheme(){
	  	$color_scheme = '';

	  	// Get theme options with fallbacks
		$primary_color      = polishe_get_option('primary_color', '#e8d4ad');
		$secondary_color    = polishe_get_option('secondary_color', '#343a20');
		$text_color         = polishe_get_option('text_color', '#e3e3e3');
		$accent_color       = polishe_get_option('accent_color', '#262b14');
		$bg_color           = polishe_get_option('bg_color', '#f4efef');
		$white_color        = polishe_get_option('white_color', '#FFFFFF');
		$divider_color      = polishe_get_option('divider_color', '#FFFFFF14');
		$dark_divider_color = polishe_get_option('dark_divider_color', '#3835373b'); // example fallback


		// Ensure variables have values (use fallbacks if empty)
        $primary_color      = !empty($primary_color) ? $primary_color : '#e8d4ad';
        $secondary_color    = !empty($secondary_color) ? $secondary_color : '#343a20';
        $text_color         = !empty($text_color) ? $text_color : '#1d1312';
        $accent_color       = !empty($accent_color) ? $accent_color : '#262b14';
        $bg_color           = !empty($bg_color) ? $bg_color : '#f4efef';
        $white_color        = !empty($white_color) ? $white_color : '#FFFFFF';
        $divider_color      = !empty($divider_color) ? $divider_color : '#FFFFFF14';
        $dark_divider_color = !empty($dark_divider_color) ? $dark_divider_color : '#3835373b';

		// Output variables inside :root
		$color_scheme .= "
		:root {
		    --primary-color: {$primary_color};
		    --secondary-color: {$secondary_color};
		    --text-color: {$text_color};
		    --accent-color: {$accent_color};
		    --bg-color: {$bg_color};
		    --white-color: {$white_color};
		    --divider-color: {$divider_color};
		    --dark-divider-color: {$dark_divider_color};
		}
		";

		// Print CSS
		if( !empty($color_scheme) ){
		    echo '<style type="text/css">'.$color_scheme.'</style>';
		}


    }
}
add_action('wp_head', 'polishe_color_scheme');

//Custom Second Font
if(!function_exists('polishe_second_font')){
	function polishe_second_font(){
		$second_font = polishe_get_option( 'second_font', [] );
		$data_font = '';

		if ( is_array($second_font) && !empty($second_font['font-family']) && $second_font['font-family'] != 'Belleza' ) {
			$data_font = 
			'h1, h2, h3, h4, h5, h6,
			blockquote,
			.font-second,
			.link-details,
			.slide-rev-subtitle,
			.xptf-btn,
			select,
			.main-navigation ul,
			.page-header,
			.post-box .post-cat a,
			.post-box .entry-meta,
			.post-box .link-box a,
			.post-box .quote-box .quote-text,
			.page-pagination li a, .page-pagination li span,
			.blog-post .tagcloud a,
			.drop-cap,
			.post-nav,
			.comments-area .comment-item .comment-meta .comment-time,
			.comments-area .comment-item .comment-meta .comment-reply-link,
			.comment-form .logged-in-as,
			.widget .tagcloud a,
			.widget table,
			.widget .recent-news .post-on,
			.xp-heading,
			.xp-flip-box .number-title span,
			.xp-counter,
			.xp-counter span,
			.xp-countdown li span,
			.line-progress .percent,
			.project_filters li a,
			.projects-grid .projects-box .portfolio-info .portfolio-cates,
			.project-slider .projects-box .portfolio-info .portfolio-cates,
			.xp-team .team-info span,
			.member-info li span,
			.xp-accordions .acc-item .acc-toggle,
			.xp-tabs .tab-link,
			.xp-testimonials .t-head,
			.features-service-wrapper .features-service-item .features-service-content,
			div.elementor-widget-heading.elementor-widget-heading .elementor-heading-title,
			.elementor-element .elementor-widget-button .elementor-button,
			.elementor-default .elementor-widget-text-editor .elementor-drop-cap,
			.elementor-widget-wp-widget-polylang .lang-item,
			#lang_choice_wp-widget-polylang,
			.mmenu-wrapper .mobile_mainmenu,
			.woocommerce ul.products li.product, .woocommerce-page ul.products li.product,
			.woocommerce ul.products li.product .added_to_cart, .woocommerce ul.products li.product .product_type_grouped, .woocommerce-page ul.products li.product .added_to_cart, .woocommerce-page ul.products li.product .product_type_grouped,
			.woocommerce table.shop_table,
			.woocommerce .quantity .qty,
			.cart_totals h2,
			#add_payment_method .cart-collaterals .cart_totals table td, #add_payment_method .cart-collaterals .cart_totals table th,.woocommerce-cart .cart-collaterals .cart_totals table td, .woocommerce-cart .cart-collaterals .cart_totals table th,.woocommerce-checkout .cart-collaterals .cart_totals table td, .woocommerce-checkout .cart-collaterals .cart_totals table th,
			.woocommerce .site ul.product_list_widget li a:not(.remove),
			.woocommerce .widget_shopping_cart .cart_list .quantity,
			.woocommerce .widget_shopping_cart .total strong,.woocommerce.widget_shopping_cart .total strong,
			.woocommerce .widget_shopping_cart .total .woocommerce-Price-amount,.woocommerce.widget_shopping_cart .total .woocommerce-Price-amount,
			.woocommerce-mini-cart__buttons a.button.wc-forward,
			.woocommerce .woocommerce-widget-layered-nav-list,
			.woocommerce .widget_price_filter .price_slider_amount,
			.woocommerce .widget_price_filter .price_slider_amount button.button,
			.product_meta > span,
			.woocommerce div.product .entry-summary p.price,.woocommerce div.product .entry-summary span.price{ font-family: '.sprintf( $second_font['font-family'] ).';}
		    ';
		}

		if( !empty($data_font) ){
			echo '<style type="text/css">'.$data_font.'</style>';
		}
	}
}
add_action('wp_head', 'polishe_second_font');