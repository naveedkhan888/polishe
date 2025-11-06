<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Testimonial Carousel 1 with Star Ratings
 */
class Bistroly_Testimonials extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'itestimonials';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'XP Testimonial Carousel 1', 'bistroly' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_bistroly' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_testimonials',
			[
				'label' => __( 'Testimonials', 'bistroly' ),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'timage',
			[
				'label' => __( 'Avatar:', 'bistroly' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => get_template_directory_uri().'/images/avatar-3.png',
				]
			]
		);

		$repeater->add_control(
			'tname',
			[
				'label' => __( 'Name:', 'bistroly' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Emilia Clarke',
			]
		);

		$repeater->add_control(
			'tjob',
			[
				'label' => __( 'Job:', 'bistroly' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Developer',
			]
		);

		$repeater->add_control(
			'trating',
			[
				'label' => __( 'Rating:', 'bistroly' ),
				'type' => Controls_Manager::SELECT,
				'default' => '5',
				'options' => [
					'1' => __( '1 Star', 'bistroly' ),
					'2' => __( '2 Stars', 'bistroly' ),
					'3' => __( '3 Stars', 'bistroly' ),
					'4' => __( '4 Stars', 'bistroly' ),
					'5' => __( '5 Stars', 'bistroly' ),
				],
			]
		);

		$repeater->add_control(
			'tcontent',
			[
				'label' => __( 'Content:', 'bistroly' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => '10',
				'default' => '"I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment."',
			]
		);

		$this->add_control(
		    'testi_slider',
		    [
		        'label'       => '',
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => false,
		        'default'     => [
		            [
		             	'tcontent' => __( '"I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment."', 'bistroly' ),
		                'timage'  => [
							'url' => get_template_directory_uri().'/images/avatar-1.png',
						],
						'tname'	  => 'Oliver Simson',
						'tjob'	  => 'Developer',
						'trating' => '5'
		 
		            ],
		            [
		             	'tcontent' => __( '"I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment."', 'bistroly' ),
		                'timage'  => [
							'url' => get_template_directory_uri().'/images/avatar-1.png',
						],
						'tname'	  => 'Mary Grey',
						'tjob'	  => 'Manager',
						'trating' => '4'
		 
		            ],
		            [
		             	'tcontent' => __( '"I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment."', 'bistroly' ),
		                'timage'  => [
							'url' => get_template_directory_uri().'/images/avatar-1.png',
						],
						'tname'	  => 'Samanta Fox',
						'tjob'	  => 'Designer',
						'trating' => '5'
		 
		            ]
		            
		        ],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{tname}}}',
		    ]
		);
		$slides_show = range( 1, 4 );
		$slides_show = array_combine( $slides_show, $slides_show );

		$this->add_responsive_control(
			'tshow',
			[
				'label' => __( 'Slides To Show', 'bistroly' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'bistroly' ),
				] + $slides_show,
				'default' => ''
			]
		);
		$this->add_control(
			'loop',
			[
				'label' => __( 'Loop', 'bistroly' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'true' => __( 'Yes', 'bistroly' ),
					'false' => __( 'No', 'bistroly' ),
				]
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'bistroly' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' => __( 'Yes', 'bistroly' ),
					'false' => __( 'No', 'bistroly' ),
				]
			]
		);
		$this->add_control(
			'timeout',
			[
				'label' => __( 'Autoplay Timeout', 'bistroly' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 1000,
						'max'  => 20000,
						'step' => 1000,
					],
				],
				'default' => [
					'size' => 7000,
				],
				'condition' => [
					'autoplay' => 'true',
				]
			]
		);
		$this->add_control(
			'arrows',
			[
				'label' => __( 'Arrows', 'bistroly' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'true'   => __( 'Yes', 'bistroly' ),
					'false'  => __( 'No', 'bistroly' ),
				],
			]
		);
		$this->add_control(
			'dots',
			[
				'label' => __( 'Dots', 'bistroly' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'   => __( 'Yes', 'bistroly' ),
					'false'  => __( 'No', 'bistroly' ),
				],
			]
		);

		$this->end_controls_section();

		// Styling.
		$this->start_controls_section(
			'style_general',
			[
				'label' => __( 'General', 'bistroly' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'is_reverse',
			[
				'label'   => esc_html__( 'Reverse content', 'bistroly' ),
				'type'    => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'tcontent_bg',
			[
				'label' => __( 'Background Color', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials .testi-item' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tcontent_color',
			[
				'label' => __( 'Text Color', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials .ttext' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'line_color',
			[
				'label' => __( 'Line Color', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials .t-head' => 'border-color: {{VALUE}};',
				],
				'condition'	=> [
					'is_reverse!' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .xp-testimonials .ttext',
			]
		);

		$this->add_responsive_control(
			'tcontent_box_padding',
			[
				'label' => __( 'Padding Box top', 'bistroly' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials .t-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tcontent_padding',
			[
				'label' => __( 'Padding Photo Text', 'bistroly' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials .ttext' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'radius_boxes',
			[
				'label' => __( 'Border Radius', 'bistroly' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .testi-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tcontent_box_shadow',
				'selector' => '{{WRAPPER}} .testi-item',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_tinfo',
			[
				'label' => __( 'Information', 'bistroly' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		/* image */
		$this->add_control(
			'style_timage',
			[
				'label' => __( 'Photo', 'bistroly' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'spacing_img',
			[
				'label' => __( 'Spacing', 'bistroly' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials .tphoto' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'bistroly' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'quote_color',
			[
				'label' => __( 'Icon Color', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials .tphoto:after' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'quote_bg',
			[
				'label' => __( 'Icon Background', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials .tphoto:after' => 'background: {{VALUE}};',
				],
			]
		);

		/* name */
		$this->add_control(
			'style_tname',
			[
				'label' => __( 'Name', 'bistroly' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'spacing_name',
			[
				'label' => __( 'Spacing', 'bistroly' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials h6' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'name_color',
			[
				'label' => __( 'Text Color', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials h6' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .xp-testimonials h6',
			]
		);		

		/* job */
		$this->add_control(
			'style_tjob',
			[
				'label' => __( 'Job', 'bistroly' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'job_color',
			[
				'label' => __( 'Text Color', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'job_typography',
				'selector' => '{{WRAPPER}} .xp-testimonials span',
			]
		);		

		$this->end_controls_section();

		// Star Rating Styles
		$this->start_controls_section(
			'style_rating',
			[
				'label' => __( 'Star Rating', 'bistroly' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'rating_position',
			[
				'label' => __( 'Rating Position', 'bistroly' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after_name',
				'options' => [
					'before_content' => __( 'Before Content', 'bistroly' ),
					'after_content' => __( 'After Content', 'bistroly' ),
					'after_name' => __( 'After Name', 'bistroly' ),
					'after_job' => __( 'After Job', 'bistroly' ),
				],
			]
		);

		$this->add_responsive_control(
			'rating_size',
			[
				'label' => __( 'Star Size', 'bistroly' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 50,
					],
					'em' => [
						'min' => 0.5,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'default' => [
					'size' => 16,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials .rating i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rating_spacing',
			[
				'label' => __( 'Spacing Between Stars', 'bistroly' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'default' => [
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials .rating i:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rating_margin',
			[
				'label' => __( 'Rating Margin', 'bistroly' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials .rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rating_align',
			[
				'label' => __( 'Alignment', 'bistroly' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'bistroly' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'bistroly' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'bistroly' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials .rating' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'star_filled_color',
			[
				'label' => __( 'Filled Star Color', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffb400',
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials .rating .star-filled' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'star_empty_color',
			[
				'label' => __( 'Empty Star Color', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#e0e0e0',
				'selectors' => [
					'{{WRAPPER}} .xp-testimonials .rating .star-empty' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'star_style',
			[
				'label' => __( 'Star Style', 'bistroly' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'solid' => __( 'Solid', 'bistroly' ),
					'outline' => __( 'Outline', 'bistroly' ),
				],
			]
		);

		$this->end_controls_section();

		// Dots.
		$this->start_controls_section(
			'navigation_section',
			[
				'label' => __( 'Dots', 'bistroly' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'dots' => 'true',
				],
			]
		);

		$this->add_responsive_control(
			'dots_spacing',
			[
				'label' => __( 'Spacing', 'bistroly' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'dots_bgcolor',
            [
                'label' => __( 'Color', 'bistroly' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .owl-dots button.owl-dot span' => 'background: {{VALUE}};',
				],
            ]
        );

        $this->add_control(
            'dots_active_bgcolor',
            [
                'label' => __( 'Color Active', 'bistroly' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .owl-dots button.owl-dot.active span' => 'background: {{VALUE}};',
				],
            ]
        );

        $this->end_controls_section();

        // Arrows.
		$this->start_controls_section(
			'style_nav',
			[
				'label' => __( 'Arrows', 'bistroly' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'arrows' => 'true',
				],
			]
		);
		$this->add_responsive_control(
			'arrow_spacing',
			[
				'label' => __( 'Spacing', 'bistroly' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-nav .owl-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .owl-nav .owl-next' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'arrow_width',
			[
				'label' => __( 'Width', 'bistroly' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 70,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'arrow_color',
			[
				'label' => __( 'Color', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->add_control(
			'arrow_bg_color',
			[
				'label' => __( 'Background', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_hcolor',
			[
				'label' => __( 'Color Hover', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_bg_hcolor',
			[
				'label' => __( 'Background Hover', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button:hover' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'radius_arrow',
			[
				'label' => __( 'Border Radius', 'bistroly' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render_stars( $rating, $star_style = 'solid' ) {
		$stars_html = '<div class="rating">';
		
		for ( $i = 1; $i <= 5; $i++ ) {
			if ( $i <= $rating ) {
				if ( $star_style === 'outline' ) {
					$stars_html .= '<i class="far fa-star star-filled"></i>';
				} else {
					$stars_html .= '<i class="fas fa-star star-filled"></i>';
				}
			} else {
				if ( $star_style === 'outline' ) {
					$stars_html .= '<i class="far fa-star star-empty"></i>';
				} else {
					$stars_html .= '<i class="fas fa-star star-empty"></i>';
				}
			}
		}
		
		$stars_html .= '</div>';
		return $stars_html;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$shows  = !empty( $settings['tshow'] ) ? $settings['tshow'] : 3;
		$tshows = !empty( $settings['tshow_tablet'] ) ? $settings['tshow_tablet'] : $shows;
		$mshows = !empty( $settings['tshow_mobile'] ) ? $settings['tshow_mobile'] : $tshows;

		?>

		<div class="xp-testimonials xp-testimonials-carousel <?php echo esc_attr( $settings['is_reverse'] == 'yes' ? 'is-reverse' : '' ); ?>" 
     data-loop="<?php echo esc_attr( $settings['loop'] ); ?>" 
     data-auto="<?php echo esc_attr( $settings['autoplay'] ); ?>" 
     data-time="<?php echo esc_attr( $settings['timeout']['size'] ); ?>" 
     data-arrows="<?php echo esc_attr( $settings['arrows'] ); ?>" 
     data-dots="<?php echo esc_attr( $settings['dots'] ); ?>" 
     data-show="<?php echo esc_attr( $shows ); ?>" 
     data-tshow="<?php echo esc_attr( $tshows ); ?>" 
     data-mshow="<?php echo esc_attr( $mshows ); ?>">
			<div class="owl-carousel owl-theme">
				<?php if ( ! empty( $settings['testi_slider'] ) ) : foreach ( $settings['testi_slider'] as $testi ) : ?>
				<div class="testi-item">
					
					<?php 
					// Render rating before content if selected
					if ( $settings['rating_position'] === 'before_content' && !empty( $testi['trating'] ) ) {
						echo $this->render_stars( intval( $testi['trating'] ), $settings['star_style'] );
					}
					?>

					<?php if($testi['tcontent']) { echo '<div class="ttext">' .$testi['tcontent']. '</div>'; } ?>

					<?php 
					// Render rating after content if selected
					if ( $settings['rating_position'] === 'after_content' && !empty( $testi['trating'] ) ) {
						echo $this->render_stars( intval( $testi['trating'] ), $settings['star_style'] );
					}
					?>			
					
					<div class="t-head flex-middle">
						<?php if($testi['timage']['url']) { ?>
							<div class="tphoto"><img src="<?php echo esc_url( $testi['timage']['url'] ); ?>" alt="<?php echo esc_attr( $testi['tname'] ); ?>"></div>
						<?php } ?>
						<div class="tinfo">
							<?php if($testi['tname']) { echo '<h6>' .$testi['tname']. '</h6>'; } ?>
							
							<?php 
							// Render rating after name if selected
							if ( $settings['rating_position'] === 'after_name' && !empty( $testi['trating'] ) ) {
								echo $this->render_stars( intval( $testi['trating'] ), $settings['star_style'] );
							}
							?>

							<?php if($testi['tjob']) { echo '<span>' .$testi['tjob']. '</span>'; } ?>

							<?php 
							// Render rating after job if selected
							if ( $settings['rating_position'] === 'after_job' && !empty( $testi['trating'] ) ) {
								echo $this->render_stars( intval( $testi['trating'] ), $settings['star_style'] );
							}
							?>
						</div>
					</div>
				</div>
				<?php endforeach; endif; ?>
			</div>				
	    </div>

	    <?php
	}

	public function get_keywords() {
		return [ 'slider', 'says', 'quote', 'testimonial', 'rating', 'stars' ];
	}
}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Bistroly_Testimonials() );