<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Polishe_Dynamic_Title extends Widget_Base {

    public function get_name() {
        return 'polishe_dynamic_title';
    }

    public function get_title() {
        return __( 'Dynamic Title', 'polishe' );
    }

    public function get_icon() {
        return 'eicon-post-title';
    }

    public function get_categories() {
        return [ 'category_polishe' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Title', 'polishe' ),
            ]
        );

        $this->add_control(
            'html_tag',
            [
                'label' => __( 'HTML Tag', 'polishe' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'p' => 'p',
                    'span' => 'span',
                ],
                'default' => 'h1',
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label' => __( 'Alignment', 'polishe' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .polishe-dynamic-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => __( 'Text Color', 'polishe' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .polishe-dynamic-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'label' => __( 'Typography', 'polishe' ),
                'selector' => '{{WRAPPER}} .polishe-dynamic-title',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $tag = $settings['html_tag'];
        $title = get_the_title();
        
        echo "<{$tag} class='polishe-dynamic-title'>{$title}</{$tag}>";
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Polishe_Dynamic_Title() );
