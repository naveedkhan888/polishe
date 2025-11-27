<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Image Reveal
 */
class Polishe_Image_Reveal extends Widget_Base{

	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iimage-reveal';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'XP Image Reveal', 'polishe' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-image';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_polishe' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Image', 'polishe' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'polishe' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image',
				'default' => 'large',
				'separator' => 'none',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'polishe' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'polishe' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'polishe' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'polishe' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-image-reveal' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_to',
			[
				'label' => __( 'Link', 'polishe' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __( 'None', 'polishe' ),
					'file' => __( 'Media File', 'polishe' ),
					'custom' => __( 'Custom URL', 'polishe' ),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'polishe' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'polishe' ),
				'condition' => [
					'link_to' => 'custom',
				],
				'show_label' => false,
			]
		);

		$this->add_control(
			'open_lightbox',
			[
				'label' => __( 'Lightbox', 'polishe' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'polishe' ),
					'yes' => __( 'Yes', 'polishe' ),
					'no' => __( 'No', 'polishe' ),
				],
				'condition' => [
					'link_to' => 'file',
				],
			]
		);

		$this->end_controls_section();

		// Reveal Animation Section
		$this->start_controls_section(
			'reveal_section',
			[
				'label' => __( 'Reveal Animation', 'polishe' ),
			]
		);

		$this->add_control(
			'reveal_enable',
			[
				'label' => __( 'Enable Reveal Effect', 'polishe' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'polishe' ),
				'label_off' => __( 'No', 'polishe' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'reveal_direction',
			[
				'label' => __( 'Reveal Direction', 'polishe' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'lr',
				'options' => [
					'lr' => __( 'Left to Right', 'polishe' ),
					'rl' => __( 'Right to Left', 'polishe' ),
					'tb' => __( 'Top to Bottom', 'polishe' ),
					'bt' => __( 'Bottom to Top', 'polishe' ),
					'scale' => __( 'Scale Up', 'polishe' ),
					'blur' => __( 'Blur In', 'polishe' ),
					'clip' => __( 'Clip Path', 'polishe' ),
					'circle' => __( 'Circle Expand', 'polishe' ),
					'diagonal' => __( 'Diagonal', 'polishe' ),
					'rotate' => __( 'Rotate Scale', 'polishe' ),
					'flip' => __( '3D Flip', 'polishe' ),
				],
				'condition' => [
					'reveal_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'reveal_duration',
			[
				'label' => __( 'Animation Duration', 'polishe' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 300,
						'max'  => 3000,
						'step' => 100,
					],
				],
				'default' => [
					'size' => 1000,
				],
				'condition' => [
					'reveal_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'reveal_delay',
			[
				'label' => __( 'Animation Delay', 'polishe' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 2000,
						'step' => 100,
					],
				],
				'default' => [
					'size' => 0,
				],
				'condition' => [
					'reveal_enable' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Style Section
		$this->start_controls_section(
			'style_image_section',
			[
				'label' => __( 'Image Style', 'polishe' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => __( 'Width', 'polishe' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'vw' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-image-reveal img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'max_width',
			[
				'label' => __( 'Max Width', 'polishe' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'vw' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-image-reveal img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => __( 'Height', 'polishe' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-image-reveal img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'object_fit',
			[
				'label' => __( 'Object Fit', 'polishe' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'polishe' ),
					'fill' => __( 'Fill', 'polishe' ),
					'cover' => __( 'Cover', 'polishe' ),
					'contain' => __( 'Contain', 'polishe' ),
				],
				'default' => '',
				'condition' => [
					'height[size]!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .xp-image-reveal img' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'separator_panel_style',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab( 'normal',
			[
				'label' => __( 'Normal', 'polishe' ),
			]
		);

		$this->add_control(
			'opacity',
			[
				'label' => __( 'Opacity', 'polishe' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-image-reveal img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .xp-image-reveal img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => __( 'Hover', 'polishe' ),
			]
		);

		$this->add_control(
			'opacity_hover',
			[
				'label' => __( 'Opacity', 'polishe' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-image-reveal:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .xp-image-reveal:hover img',
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'polishe' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_control(
			'background_hover_transition',
			[
				'label' => __( 'Transition Duration', 'polishe' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-image-reveal img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .xp-image-reveal img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'polishe' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .xp-image-reveal img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .xp-image-reveal img',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['image']['url'] ) ) {
			return;
		}

		$has_caption = ! empty( $settings['caption'] );

		$link = $this->get_link_url( $settings );

		if ( $link ) {
			$this->add_link_attributes( 'link', $link );

			if ( Plugin::$instance->editor->is_edit_mode() ) {
				$this->add_render_attribute( 'link', [
					'class' => 'elementor-clickable',
				] );
			}

			if ( 'custom' !== $settings['link_to'] ) {
				$this->add_lightbox_data_attributes( 'link', $settings['image']['id'], $settings['open_lightbox'] );
			}
		}

		$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings );

		$reveal_class = '';
		$reveal_attrs = '';

		if ( 'yes' === $settings['reveal_enable'] ) {
			$reveal_class = 'has-reveal reveal-' . $settings['reveal_direction'];
			$reveal_attrs = ' data-reveal-direction="' . esc_attr( $settings['reveal_direction'] ) . '"';
			$reveal_attrs .= ' data-reveal-duration="' . esc_attr( $settings['reveal_duration']['size'] ) . '"';
			$reveal_attrs .= ' data-reveal-delay="' . esc_attr( $settings['reveal_delay']['size'] ) . '"';
		}

		$hover_class = '';
		if ( ! empty( $settings['hover_animation'] ) ) {
			$hover_class = 'elementor-animation-' . $settings['hover_animation'];
		}

		?>
		<div class="xp-image-reveal <?php echo esc_attr( $reveal_class ); ?>" <?php echo $reveal_attrs; ?>>
			<?php if ( $link ) : ?>
				<a <?php echo $this->get_render_attribute_string( 'link' ); ?> class="<?php echo esc_attr( $hover_class ); ?>">
					<?php echo $image_html; ?>
				</a>
			<?php else : ?>
				<div class="<?php echo esc_attr( $hover_class ); ?>">
					<?php echo $image_html; ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	private function get_link_url( $settings ) {
		if ( 'none' === $settings['link_to'] ) {
			return false;
		}

		if ( 'custom' === $settings['link_to'] ) {
			if ( empty( $settings['link']['url'] ) ) {
				return false;
			}

			return $settings['link'];
		}

		return [
			'url' => $settings['image']['url'],
		];
	}

	public function get_keywords() {
		return [ 'image', 'photo', 'visual', 'reveal', 'animation' ];
	}
}
// After the Polishe_Image_Reveal class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Polishe_Image_Reveal() );