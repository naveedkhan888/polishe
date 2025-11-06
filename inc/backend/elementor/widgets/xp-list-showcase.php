<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: XP Lists Showcase
 */
class XP_Lists_Showcase extends Widget_Base {

    public function get_name() {
        return 'xp_lists_showcase';
    }

    public function get_title() {
        return __( 'XP Lists Showcase', 'bistroly' );
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return [ 'category_bistroly' ];
    }

    protected function register_controls() {

        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'bistroly' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_top_border',
            [
                'label' => __( 'Show Top Border', 'bistroly' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'bistroly' ),
                'label_off' => __( 'Hide', 'bistroly' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_bottom_border',
            [
                'label' => __( 'Show Bottom Border', 'bistroly' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'bistroly' ),
                'label_off' => __( 'Hide', 'bistroly' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title', [
                'label' => __( 'Title', 'bistroly' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'List Title', 'bistroly' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'bistroly' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h2',
            ]
        );

        $repeater->add_control(
            'subtitle', [
                'label' => __( 'Subtitle', 'bistroly' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'List Subtitle', 'bistroly' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'subtitle_tag',
            [
                'label' => __( 'Subtitle HTML Tag', 'bistroly' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'p' => 'p',
                    'div' => 'div',
                    'span' => 'span',
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                ],
                'default' => 'p',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __( 'Link', 'bistroly' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'bistroly' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $repeater->add_control(
            'image_1',
            [
                'label' => __( 'Image 1', 'bistroly' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'image_2',
            [
                'label' => __( 'Image 2', 'bistroly' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'image_3',
            [
                'label' => __( 'Image 3', 'bistroly' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'list_items',
            [
                'label' => __( 'List Items', 'bistroly' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __( 'Menu', 'bistroly' ),
                        'title_tag' => 'h3',
                        'subtitle' => __( 'Main Courses', 'bistroly' ),
                        'subtitle_tag' => 'p',
                    ],
                    [
                        'title' => __( 'Cocktails', 'bistroly' ),
                        'title_tag' => 'h3',
                        'subtitle' => __( 'Mixed Drinks', 'bistroly' ),
                        'subtitle_tag' => 'p',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'bistroly' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Style
        $this->add_control(
            'heading_title_style',
            [
                'label' => __( 'Title', 'bistroly' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'bistroly' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .xptheme-e-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_active_color',
            [
                'label' => __( 'Active Color', 'bistroly' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .xptheme-m-item.xptheme--active .xptheme-e-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Typography', 'bistroly' ),
                'selector' => '{{WRAPPER}} .xptheme-e-title',
            ]
        );

        // Subtitle Style
        $this->add_control(
            'heading_subtitle_style',
            [
                'label' => __( 'Subtitle', 'bistroly' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Color', 'bistroly' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .xptheme-e-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_active_color',
            [
                'label' => __( 'Active Color', 'bistroly' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .xptheme-m-item.xptheme--active .xptheme-e-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => __( 'Typography', 'bistroly' ),
                'selector' => '{{WRAPPER}} .xptheme-e-subtitle',
            ]
        );

        // Border Style
        $this->add_control(
            'heading_border_style',
            [
                'label' => __( 'Border', 'bistroly' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => __( 'Color', 'bistroly' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(255, 255, 255, 0.3)',
                'selectors' => [
                    '{{WRAPPER}} .xptheme-m-items:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .xptheme-m-item:after' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_width',
            [
                'label' => __( 'Width', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .xptheme-m-items:before' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .xptheme-m-item:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_control(
            'heading_padding',
            [
                'label' => __( 'Padding', 'bistroly' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label' => __( 'Item Padding', 'bistroly' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .xptheme-m-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Image 1 Style Section
        $this->start_controls_section(
            'image_1_style_section',
            [
                'label' => __( 'Image 1 Style', 'bistroly' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_1_width',
            [
                'label' => __( 'Width', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xptheme-m-item img:nth-of-type(1)' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_1_border_radius',
            [
                'label' => __( 'Border Radius', 'bistroly' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .xptheme-m-item img:nth-of-type(1)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Image 2 Style Section
        $this->start_controls_section(
            'image_2_style_section',
            [
                'label' => __( 'Image 2 Style', 'bistroly' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_2_width',
            [
                'label' => __( 'Width', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xptheme-m-item img:nth-of-type(2)' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_2_border_radius',
            [
                'label' => __( 'Border Radius', 'bistroly' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .xptheme-m-item img:nth-of-type(2)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Image 3 Style Section
        $this->start_controls_section(
            'image_3_style_section',
            [
                'label' => __( 'Image 3 Style', 'bistroly' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_3_width',
            [
                'label' => __( 'Width', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xptheme-m-item img:nth-of-type(3)' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_3_border_radius',
            [
                'label' => __( 'Border Radius', 'bistroly' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .xptheme-m-item img:nth-of-type(3)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $show_top_border = $settings['show_top_border'] === 'yes' ? 'xptheme-has-top-border' : '';
        $show_bottom_border = $settings['show_bottom_border'] === 'yes' ? 'xptheme-has-bottom-border' : '';
        ?>
        
        <div class="xptheme-shortcode xptheme-m xptheme-interactive-link-showcase xptheme-layout--list <?php echo esc_attr($show_top_border); ?> <?php echo esc_attr($show_bottom_border); ?>">
            <div class="xptheme-m-items">
                <?php foreach ($settings['list_items'] as $index => $item): 
                    $link_attr = '';
                    if (!empty($item['link']['url'])) {
                        $this->add_link_attributes('link_' . $index, $item['link']);
                        $link_attr = $this->get_render_attribute_string('link_' . $index);
                    }
                    $title_tag = !empty($item['title_tag']) ? $item['title_tag'] : 'h2';
                    $subtitle_tag = !empty($item['subtitle_tag']) ? $item['subtitle_tag'] : 'p';
                ?>
                    <a itemprop="url" class="xptheme-m-item xptheme-e" <?php echo $link_attr; ?>>
                        <div class="links_innnnner">
                                <<?php echo esc_attr($title_tag); ?> class="xptheme-e-title"><?php echo esc_html($item['title']); ?></<?php echo esc_attr($title_tag); ?>>
                            <<?php echo esc_attr($subtitle_tag); ?> class="xptheme-e-subtitle"><?php echo esc_html($item['subtitle']); ?></<?php echo esc_attr($subtitle_tag); ?>>
                        </div>

                        <?php if (!empty($item['image_1']['url'])): ?>
                            <img decoding="async" loading="lazy" src="<?php echo esc_url($item['image_1']['url']); ?>" alt="<?php echo esc_attr($item['title']); ?>" />
                        <?php endif; ?>

                        <?php if (!empty($item['image_2']['url'])): ?>
                            <img decoding="async" loading="lazy" src="<?php echo esc_url($item['image_2']['url']); ?>" alt="<?php echo esc_attr($item['title']); ?>" />
                        <?php endif; ?>

                        <?php if (!empty($item['image_3']['url'])): ?>
                            <img decoding="async" loading="lazy" src="<?php echo esc_url($item['image_3']['url']); ?>" alt="<?php echo esc_attr($item['title']); ?>" />
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        
        <?php
    }
}

// Register the widget
Plugin::instance()->widgets_manager->register( new XP_Lists_Showcase() );