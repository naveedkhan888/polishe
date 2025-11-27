<?php
/**
 * Hooks for importer
 *
 * @package Polishe
 */


/**
 * Importer the demo content
 *
 * @since  1.0
 *
 */
function polishe_importer() {
	return array(
		array(
			'name'       => 'Main Demo',
			'preview'    => get_template_directory_uri().'/inc/backend/data/maintheme/home1.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/maintheme/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/maintheme/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/maintheme/widgets.wie',
			'sliders'    => 'https://dpsample.com/themes_data/polishe/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home 2',
			'preview'    => get_template_directory_uri().'/inc/backend/data/maintheme/home2.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/maintheme/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/coffee/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/maintheme/widgets.wie',
			'sliders'    => 'https://dpsample.com/themes_data/polishe/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 2',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home 3',
			'preview'    => get_template_directory_uri().'/inc/backend/data/maintheme/home3.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/maintheme/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/ice-cream/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/maintheme/widgets.wie',
			'sliders'    => 'https://dpsample.com/themes_data/polishe/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 3',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home 4',
			'preview'    => get_template_directory_uri().'/inc/backend/data/maintheme/home4.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/maintheme/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/pizza/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/maintheme/widgets.wie',
			'sliders'    => 'https://dpsample.com/themes_data/polishe/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 4',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home 5',
			'preview'    => get_template_directory_uri().'/inc/backend/data/maintheme/home5.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/maintheme/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/juice/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/maintheme/widgets.wie',
			'sliders'    => 'https://dpsample.com/themes_data/polishe/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 5',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
	);
}

add_filter( 'soo_demo_packages', 'polishe_importer', 30 );