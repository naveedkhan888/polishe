<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Contact Info
 */
class Polishe_CountDown extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'icountdown';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'XP CountDown', 'polishe' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-countdown';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_polishe' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'CountDown', 'polishe' ),
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
				// 'prefix_class' => 'polishe%s-align-',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'date',
			[
				'label' => 'Date - Time',
				'type' => Controls_Manager::DATE_TIME,
				'default' => __( '2025-10-26 12:00', 'polishe' ),
			]
		);

		$this->add_control(
			'zone',
			[
				'label' => __( 'UTC Timezone Offset', 'polishe' ),
				'type' => Controls_Manager::NUMBER,
				'default' => __( '0', 'polishe' ),
			]
		);

		$this->start_controls_tabs( 'tabs_titles' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'One', 'polishe' ),
			]
		);
		$this->add_control(
			'day',
			[
				'label' => __( 'Day', 'polishe' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Day', 'polishe' ),
			]
		);
		$this->add_control(
			'hour',
			[
				'label' => __( 'Hour', 'polishe' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Hour', 'polishe' ),
			]
		);
		$this->add_control(
			'min',
			[
				'label' => __( 'Minute', 'polishe' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Minute', 'polishe' ),
			]
		);
		$this->add_control(
			'second',
			[
				'label' => __( 'Second', 'polishe' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Second', 'polishe' ),
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_active',
			[
				'label' => __( 'Multi', 'polishe' ),
			]
		);
		$this->add_control(
			'days',
			[
				'label' => __( 'Days', 'polishe' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Days', 'polishe' ),
			]
		);
		$this->add_control(
			'hours',
			[
				'label' => __( 'Hours', 'polishe' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Hours', 'polishe' ),
			]
		);
		$this->add_control(
			'mins',
			[
				'label' => __( 'Minutes', 'polishe' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Minutes', 'polishe' ),
			]
		);
		$this->add_control(
			'seconds',
			[
				'label' => __( 'Seconds', 'polishe' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Seconds', 'polishe' ),
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Style', 'polishe' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Number
		$this->add_control(
			'heading_number',
			[
				'label' => __( 'Number', 'polishe' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' => __( 'Color', 'polishe' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-countdown li span' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .xp-countdown li span, {{WRAPPER}} .xp-countdown li.seperator',
			]
		);
		$this->add_responsive_control(
			'number_space',
			[
				'label' => __( 'Spacing', 'polishe' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-countdown li span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Title
		$this->add_control(
			'heading_titles',
			[
				'label' => __( 'Texts', 'polishe' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'polishe' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-countdown p' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .xp-countdown p',
			]
		);

		//Seperator
		$this->add_control(
			'heading_sepe',
			[
				'label' => __( 'Seperator', 'polishe' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'sepe_color',
			[
				'label' => __( 'Color', 'polishe' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-countdown li.seperator' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$datex = str_replace('-','/',$settings['date']);
		$next_date = date('m/d/Y', strtotime(' +25 days')); // Use for demo only
		?>
			
		<ul class="xp-countdown unstyle" data-zone="<?php echo esc_attr( $settings['zone'] ); ?>" data-date="<?php echo esc_attr( $datex ); ?>" data-day="<?php echo esc_attr( $settings['day'] ); ?>" data-days="<?php echo esc_attr( $settings['days'] ); ?>" data-hour="<?php echo esc_attr( $settings['hour'] ); ?>" data-hours="<?php echo esc_attr( $settings['hours'] ); ?>" data-min="<?php echo esc_attr( $settings['min'] ); ?>" data-mins="<?php echo esc_attr( $settings['mins'] ); ?>" data-second="<?php echo esc_attr( $settings['second'] ); ?>" data-seconds="<?php echo esc_attr( $settings['seconds'] ); ?>">
			<li><span class="days">00</span><p class="days_text">Days</p></li>
			<li class="seperator">:</li>
			<li><span class="hours">00</span><p class="hours_text">Hours</p></li>
			<li class="seperator">:</li>
			<li><span class="minutes">00</span><p class="minutes_text">Minutes</p></li>
			<li class="seperator">:</li>
			<li><span class="seconds">00</span><p class="seconds_text">Seconds</p></li>
		</ul>

	    <?php
	}

}
// After the Polishe_CountDown class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Polishe_CountDown() );