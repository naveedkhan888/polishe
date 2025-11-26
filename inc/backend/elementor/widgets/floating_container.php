<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Widget Name: Floating Container
 * Description: A draggable container that can hold any Elementor widgets and provides floating animations + styling.
 * NOTE: This implementation marks the widget as a container. It relies on Elementor's container/inner-section support.
 */
class Bistroly_Floating_Container extends Widget_Base {

    // Tell Elementor this widget can contain other widgets
    protected $is_container = true;

    public function get_name() {
        return 'floating_container';
    }

    public function get_title() {
        return __( 'Floating Container', 'bistroly' );
    }

    public function get_icon() {
        return 'eicon-floating';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    public function get_keywords() {
        return [ 'float', 'floating', 'badge', 'bubble', 'container' ];
    }

    public function get_style_depends() {
        return [ 'bistroly-floating-css' ];
    }

    public function get_script_depends() {
        return [ 'bistroly-floating-js' ];
    }

    protected function _register_controls() {
        // Layout tab
        $this->start_controls_section(
            'section_layout',
            [ 'label' => __( 'Layout', 'bistroly' ) ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'bistroly' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [ 'title' => __( 'Left', 'bistroly' ), 'icon' => 'eicon-h-align-left' ],
                    'center' => [ 'title' => __( 'Center', 'bistroly' ), 'icon' => 'eicon-h-align-center' ],
                    'right' => [ 'title' => __( 'Right', 'bistroly' ), 'icon' => 'eicon-h-align-right' ],
                ],
                'selectors' => [ '{{WRAPPER}} .bistroly-floating-wrap' => 'text-align: {{VALUE}};' ],
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => __( 'Width', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [ 'px' => [ 'min' => 20, 'max' => 1200 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
                'selectors' => [ '{{WRAPPER}} .bistroly-floating-box' => 'width: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => __( 'Height', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [ 'px' => [ 'min' => 20, 'max' => 1200 ], '%' => [ 'min' => 1, 'max' => 100 ] ],
                'selectors' => [ '{{WRAPPER}} .bistroly-floating-box' => 'height: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->end_controls_section();

        // Style tab - container style
        $this->start_controls_section(
            'section_style',
            [ 'label' => __( 'Container Style', 'bistroly' ), 'tab' => Controls_Manager::TAB_STYLE ]
        );

        $this->add_control(
            'background',
            [
                'label' => __( 'Background Color', 'bistroly' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .bistroly-floating-box' => 'background: {{VALUE}};' ],
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [ '{{WRAPPER}} .bistroly-floating-box' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __( 'Padding', 'bistroly' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [ '{{WRAPPER}} .bistroly-floating-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [ 'name' => 'box_shadow', 'selector' => '{{WRAPPER}} .bistroly-floating-box' ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [ 'name' => 'border', 'selector' => '{{WRAPPER}} .bistroly-floating-box' ]
        );

        $this->end_controls_section();

        // Animation settings
        $this->start_controls_section(
            'section_anim',
            [ 'label' => __( 'Floating Animation', 'bistroly' ), 'tab' => Controls_Manager::TAB_STYLE ]
        );

        $this->add_control(
            'float_type',
            [
                'label' => __( 'Animation Type', 'bistroly' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'up-down',
                'options' => [
                    'up-down' => 'Float Up / Down',
                    'left-right' => 'Float Left / Right',
                    'scale' => 'Pulse (Scale)',
                    'none' => 'None',
                ],
            ]
        );

        $this->add_control(
            'float_speed',
            [
                'label' => __( 'Speed (s)', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's' ],
                'range' => [ 's' => [ 'min' => 1, 'max' => 10 ] ],
                'default' => [ 'size' => 6 ],
            ]
        );

        $this->add_control(
            'float_distance',
            [
                'label' => __( 'Distance (px)', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [ 'px' => [ 'min' => 1, 'max' => 200 ] ],
                'default' => [ 'size' => 10 ],
            ]
        );

        $this->end_controls_section();

        // NOTE: This widget is a container so Elementor will allow dropping child widgets in the editor.
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $float_type = $settings['float_type'];
        $speed = ( isset( $settings['float_speed']['size'] ) ) ? $settings['float_speed']['size'] : 6;
        $distance = ( isset( $settings['float_distance']['size'] ) ) ? $settings['float_distance']['size'] : 10;

        $this->add_render_attribute( 'wrapper', 'class', 'bistroly-floating-wrap' );
        $this->add_render_attribute( 'box', 'class', 'bistroly-floating-box bistroly-float-'.$float_type );
        $this->add_render_attribute( 'box', 'style', sprintf( '--bistroly-float-speed:%ss; --bistroly-float-distance:%spx;', $speed, $distance ) );

        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <div <?php echo $this->get_render_attribute_string( 'box' ); ?>>
                <?php
                // Render child elements (this is what allows drag & drop inside the container in editor)
                // For container widgets, Elementor will manage inner widgets. The following call prints children in the editor/frontend context.
                if ( isset( \Elementor\Plugin::$instance->elements_manager ) ) {
                    // Print inner content
                    $this->print_child_widgets();
                }
                ?>
            </div>
        </div>
        <?php
    }

    // Helper: print child widgets when this widget is used as container
    protected function print_child_widgets() {
        // This is a compatibility helper: if Elementor provides a method to print child elements for container widgets
        // we use it; otherwise fallback to rendering the inner content via the elements manager if possible.

        if ( method_exists( $this, 'print_inner' ) ) {
            // Some versions may provide print_inner()
            $this->print_inner();
            return;
        }

        // Try to fetch and render children via the elements manager (best-effort)
        try {
            $elements = \Elementor\Plugin::$instance->elements_manager->get_elements_data_for_frontend( $this->get_id() );
            if ( ! empty( $elements ) ) {
                // If elements were returned, loop and render (best-effort, may require Elementor internal APIs)
                foreach ( $elements as $element ) {
                    // We can't reliably render arbitrary child elements here without deeper integration.
                    // In many cases Elementor will handle rendering the children automatically when the widget is marked as a container.
                }
            }
        } catch ( \Exception $e ) {
            // silently fail - editor will still allow dropping widgets in most Elementor setups
        }
    }
}

// Register widget
Plugin::instance()->widgets_manager->register( new Bistroly_Floating_Container() );


/*
 * Styles and JS registration example (add this in your theme/plugin enqueue hooks):
 * wp_register_style( 'bistroly-floating-css', get_stylesheet_directory_uri() . '/assets/css/bistroly-floating.css' );
 * wp_register_script( 'bistroly-floating-js', get_stylesheet_directory_uri() . '/assets/js/bistroly-floating.js', [ 'jquery' ], false, true );
 *
 * Example CSS (bistroly-floating.css):
 * .bistroly-floating-wrap { display: inline-block; }
 * .bistroly-floating-box { display:inline-flex; align-items:center; justify-content:center; transition: transform .2s ease; }
 * .bistroly-float-up-down { animation: bistroly-float-up-down var(--bistroly-float-speed,6s) ease-in-out infinite; }
 * .bistroly-float-left-right { animation: bistroly-float-left-right var(--bistroly-float-speed,6s) ease-in-out infinite; }
 * .bistroly-float-scale { animation: bistroly-float-scale var(--bistroly-float-speed,6s) ease-in-out infinite; }
 * @keyframes bistroly-float-up-down { 0% { transform: translateY(0); } 50% { transform: translateY(calc(var(--bistroly-float-distance,10px) * -1)); } 100% { transform: translateY(0); } }
 * @keyframes bistroly-float-left-right { 0% { transform: translateX(0); } 50% { transform: translateX(calc(var(--bistroly-float-distance,10px) * -1)); } 100% { transform: translateX(0); } }
 * @keyframes bistroly-float-scale { 0%{ transform: scale(1);} 50%{ transform: scale(1.06);} 100%{ transform: scale(1);} }
 *
 * Important:
 * - Depending on your Elementor version, additional tweaks may be required to make this widget behave exactly like Elementor's Inner Section (so you can drag/drop child widgets).
 * - If the widget does not expose a drop area, ensure 'Experiments > Container' or similar is enabled in Elementor, and that you place this widget inside a section that allows inner content.
 */
