<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Floating Container Widget (FULLY FIXED VERSION)
 * Works with Elementor Flexbox Container OR Classic Sections
 * Allows drag-drop widgets inside + floating animations
 */
class Bistroly_Floating_Container extends Widget_Base {

    /** Enable container behavior */
    public function is_container() {
        return true;
    }

    public function get_name() {
        return 'floating_container';
    }

    public function get_title() {
        return __( 'Floating Container', 'bistroly' );
    }

    public function get_icon() {
        return 'eicon-animation';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    /** IMPORTANT: wrapper classes so Elementor shows dropzone */
    public function get_html_wrapper_class() {
        return 'elementor-section elementor-column elementor-top-column elementor-widget-container';
    }

    protected function _register_controls() {

        /* -------------------- Layout Controls -------------------- */
        $this->start_controls_section(
            'layout_section',
            [ 'label' => __( 'Layout', 'bistroly' ) ]
        );

        $this->add_responsive_control(
            'width', [
                'label' => __( 'Width', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [ '{{WRAPPER}} .bistroly-floating-box' => 'width: {{SIZE}}{{UNIT}};' ]
            ]
        );

        $this->add_responsive_control(
            'height', [
                'label' => __( 'Height', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [ '{{WRAPPER}} .bistroly-floating-box' => 'height: {{SIZE}}{{UNIT}};' ]
            ]
        );

        $this->end_controls_section();

        /* -------------------- Container Style -------------------- */
        $this->start_controls_section(
            'box_style',
            [ 'label' => __( 'Box Style', 'bistroly' ), 'tab' => Controls_Manager::TAB_STYLE ]
        );

        $this->add_control(
            'bg_color', [
                'label' => __( 'Background', 'bistroly' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .bistroly-floating-box' => 'background-color: {{VALUE}};' ]
            ]
        );

        $this->add_responsive_control(
            'padding', [
                'label' => __( 'Padding', 'bistroly' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [ '{{WRAPPER}} .bistroly-floating-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ]
            ]
        );

        $this->add_responsive_control(
            'border_radius', [
                'label' => __( 'Border Radius', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [ '{{WRAPPER}} .bistroly-floating-box' => 'border-radius: {{SIZE}}{{UNIT}};' ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .bistroly-floating-box'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'shadow',
                'selector' => '{{WRAPPER}} .bistroly-floating-box'
            ]
        );

        $this->end_controls_section();

        /* -------------------- Floating Animation -------------------- */
        $this->start_controls_section(
            'float_anim',
            [ 'label' => __( 'Floating Animation', 'bistroly' ), 'tab' => Controls_Manager::TAB_STYLE ]
        );

        $this->add_control(
            'float_type', [
                'label' => __( 'Animation Type', 'bistroly' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'updown',
                'options' => [
                    'none' => 'None',
                    'updown' => 'Float Up/Down',
                    'leftright' => 'Float Left/Right',
                    'scale' => 'Pulse Scale',
                ]
            ]
        );

        $this->add_control(
            'speed', [
                'label' => __( 'Speed (seconds)', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [ 's' => [ 'min' => 2, 'max' => 20 ] ],
                'default' => [ 'size' => 6 ]
            ]
        );

        $this->add_control(
            'distance', [
                'label' => __( 'Movement Distance (px)', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [ 'px' => [ 'min' => 1, 'max' => 100 ] ],
                'default' => [ 'size' => 12 ]
            ]
        );

        $this->end_controls_section();
    }

    /* -------------------- CHILD SUPPORT -------------------- */
    public function get_child_type() {
        return 'widget';
    }

    public function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'box', 'class', 'bistroly-floating-box bistroly-float-'.$settings['float_type'] );
        $this->add_render_attribute( 'box', 'style', '--float-speed: '.$settings['speed']['size'].'s; --float-distance: '.$settings['distance']['size'].'px;' );
        ?>

        <div class="bistroly-floating-container elementor-section elementor-inner-section">
            <div <?php echo $this->get_render_attribute_string( 'box' ); ?> >
                <div class="elementor-container elementor-column">
                    <?php $this->render_children(); ?>
                </div>
            </div>
        </div>

        <?php
    }

    protected function render_children() {
        foreach ( $this->get_children() as $child ) {
            $child->print_element();
        }
    }
}

Plugin::instance()->widgets_manager->register( new Bistroly_Floating_Container() );

/* ---------------- CSS (Add in theme or file) ----------------
.bistroly-floating-box { display:flex; justify-content:center; align-items:center; }

.bistroly-float-updown { animation: floatUpDown var(--float-speed) ease-in-out infinite; }
.bistroly-float-leftright { animation: floatLeftRight var(--float-speed) ease-in-out infinite; }
.bistroly-float-scale { animation: floatScale var(--float-speed) ease-in-out infinite; }

@keyframes floatUpDown {
  0% { transform: translateY(0); }
  50% { transform: translateY(calc(var(--float-distance) * -1)); }
  100% { transform: translateY(0); }
}

@keyframes floatLeftRight {
  0% { transform: translateX(0); }
  50% { transform: translateX(calc(var(--float-distance) * -1)); }
  100% { transform: translateX(0); }
}

@keyframes floatScale {
  0% { transform: scale(1); }
  50% { transform: scale(1.06); }
  100% { transform: scale(1); }
}
------------------------------------------------------------ */
