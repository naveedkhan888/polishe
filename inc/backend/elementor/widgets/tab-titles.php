<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class CreamPoint_Tab_Titles extends Widget_Base {

	public function get_name() {
		return 'itabtitle';
	}

	public function get_title() {
		return __( 'XP Tab Titles', 'bistroly' );
	}

	public function get_icon() {
		return 'eicon-site-title';
	}

	public function get_categories() {
		return [ 'category_bistroly' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Titles', 'bistroly' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'titles',
			[
				'label' => __( 'Title', 'bistroly' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Content Marketing',
			]
		);
		$repeater->add_control(
			'title_link',
			[
				'label' => __( 'Link to ID Content', 'bistroly' ),
				'type' => Controls_Manager::TEXT,
				'default' => '#tab-1',
			]
		);
		$repeater->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'bistroly' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'title_boxes',
			[
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'show_label'  => false,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{titles}}}',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'bistroly' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [ 'title' => __( 'Left' ), 'icon' => 'eicon-text-align-left' ],
					'center'     => [ 'title' => __( 'Center' ), 'icon' => 'eicon-text-align-center' ],
					'flex-end'   => [ 'title' => __( 'Right' ), 'icon' => 'eicon-text-align-right' ],
				],
				'selectors' => [
					'{{WRAPPER}} .tab-titles' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/** ---------- Style Section ---------- **/

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style', 'bistroly' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_space',
			[
				'label' => __( 'Spacing', 'bistroly' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 'px' => [ 'min' => 0, 'max' => 150 ] ],
				'selectors' => [
					'{{WRAPPER}} .tab-titles .title-item' => 'margin: calc({{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .tab-titles' => 'margin: calc(-{{SIZE}}{{UNIT}}/2);',
				],
			]
		);

		$this->add_responsive_control(
			'padding_title',
			[
				'label' => __( 'Padding', 'bistroly' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tab-titles a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'radius_title',
			[
				'label' => __( 'Border Radius', 'bistroly' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tab-titles a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .title-item',
			]
		);

		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'bistroly' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-item a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_bg',
			[
				'label' => __( 'Background', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-item a' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-item a .icon, {{WRAPPER}} .title-item a .icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'bistroly' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 'px' => [ 'min' => 10, 'max' => 100 ] ],
				'selectors' => [
					'{{WRAPPER}} .title-item .icon i'     => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .title-item .icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_border_color',
			[
				'label' => __( 'Border Color', 'bistroly' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-item a' => 'border: 1px solid {{VALUE}};',
				],
			]
		);

		// Border Width
		$this->add_control(
			'title_border_width',
			[
				'label' => __( 'Border Width', 'bistroly' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title-item a' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label' => __( 'Hover / Active', 'bistroly' ),
			]
		);

		$this->add_control(
			'title_active_color',
			[
				'label' => __( 'Text Color', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-item a:hover, {{WRAPPER}} .title-item a.tab-active' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_active_bg',
			[
				'label' => __( 'Background', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-item a:hover, {{WRAPPER}} .title-item a.tab-active' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Icon Hover Color', 'bistroly' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-item a:hover .icon, {{WRAPPER}} .title-item a:hover .icon svg, {{WRAPPER}} .title-item a.tab-active .icon, {{WRAPPER}} .title-item a.tab-active .icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_border_hover_color',
			[
				'label' => __( 'Border Color', 'bistroly' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-item a:hover' => 'border: 1px solid {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="tab-titles">
			<?php foreach ( $settings['title_boxes'] as $box ) : ?>
				<div class="title-item font-second">
					<a href="<?php echo esc_url( $box['title_link'] ); ?>">
						<?php if ( ! empty( $box['icon']['value'] ) ) : ?>
							<span class="icon">
								<?php Icons_Manager::render_icon( $box['icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						<?php endif; ?>
						<div class="hover_tab_titleees">
							<span class="text_icn"><?php echo esc_html( $box['titles'] ); ?></span>
							<span class="text_icn_hover"><?php echo esc_html( $box['titles'] ); ?></span>
						</div>
						<div class="border-top bg_anim"></div>
				        <div class="border-right bg_anim"></div>
				        <div class="border-bottom bg_anim"></div>
				        <div class="border-left bg_anim"></div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new CreamPoint_Tab_Titles() );
