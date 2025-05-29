<?php
/**
 * Modal Controls for Tax Calculator
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Tax_Calculator_Modal_Controls {
    public static function add_controls($widget) {
        // Main Modal Section
        $widget->start_controls_section(
            'section_modal',
            [
                'label' => esc_html__('Modal', 'tax-calculator'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Heading Controls
        $widget->add_control(
            'heading_modal_heading',
            [
                'label' => esc_html__('Heading', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Heading Alignment
        $widget->add_responsive_control(
            'modal_heading_alignment',
            [
                'label' => esc_html__('Alignment', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'tax-calculator'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'tax-calculator'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'tax-calculator'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .modal-form-heading' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Heading Color
        $widget->add_control(
            'modal_heading_color',
            [
                'label' => esc_html__('Color', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .modal-form-heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Heading Typography
        $widget->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'modal_heading_typography',
                'selector' => '{{WRAPPER}} .modal-form-heading',
            ]
        );

        // Heading Margin
        $widget->add_responsive_control(
            'modal_heading_margin',
            [
                'label' => esc_html__('Margin', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .modal-form-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Label Controls
        $widget->add_control(
            'heading_modal_label',
            [
                'label' => esc_html__('Label', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Label Typography
        $widget->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'modal_label_typography',
                'selector' => '{{WRAPPER}} .modal-form-label',
            ]
        );

        // Label Color
        $widget->add_control(
            'modal_label_color',
            [
                'label' => esc_html__('Color', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .modal-form-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Label Margin
        $widget->add_responsive_control(
            'modal_label_margin',
            [
                'label' => esc_html__('Margin', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .modal-form-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Amount Field Controls
        $widget->add_control(
            'heading_amount_field',
            [
                'label' => esc_html__('Amount Field', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Amount Field Background Color
        $widget->add_control(
            'amount_field_bg_color',
            [
                'label' => esc_html__('Background Color', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .total-amount-value' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Amount Field Text Color
        $widget->add_control(
            'amount_field_color',
            [
                'label' => esc_html__('Text Color', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .total-amount-value' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Amount Field Typography
        $widget->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'amount_field_typography',
                'selector' => '{{WRAPPER}} .total-amount-value',
            ]
        );

        // Amount Field Padding
        $widget->add_responsive_control(
            'amount_field_padding',
            [
                'label' => esc_html__('Padding', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .total-amount-value' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Amount Field Margin
        $widget->add_responsive_control(
            'amount_field_margin',
            [
                'label' => esc_html__('Margin', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .total-amount-value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Amount Field Border
        $widget->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'amount_field_border',
                'selector' => '{{WRAPPER}} .total-amount-value',
                'separator' => 'before',
            ]
        );

        // Amount Field Border Radius
        $widget->add_responsive_control(
            'amount_field_border_radius',
            [
                'label' => esc_html__('Border Radius', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .total-amount-value' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Modal Divider Controls
        $widget->add_control(
            'heading_modal_divider',
            [
                'label' => esc_html__('Modal Divider', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Divider Text
        $widget->add_control(
            'divider_text',
            [
                'label' => esc_html__('Divider Text', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'OR',
                'selectors' => [
                    '{{WRAPPER}} .modal-divider span' => 'content: "{{VALUE}}";',
                ],
            ]
        );

        // Divider Style
        $widget->add_control(
            'divider_style',
            [
                'label' => esc_html__('Style', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => esc_html__('Horizontal', 'tax-calculator'),
                    'vertical' => esc_html__('Vertical', 'tax-calculator'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .modal-divider' => 'display: flex; align-items: center; {{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'horizontal' => 'flex-direction: row;',
                    'vertical' => 'flex-direction: column;',
                ],
            ]
        );

        // Divider Alignment
        $widget->add_responsive_control(
            'divider_alignment',
            [
                'label' => esc_html__('Alignment', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'tax-calculator'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'tax-calculator'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'tax-calculator'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .modal-divider' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'divider_style' => 'horizontal',
                ],
            ]
        );

        // Divider Vertical Alignment
        $widget->add_responsive_control(
            'divider_vertical_alignment',
            [
                'label' => esc_html__('Vertical Alignment', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'tax-calculator'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Middle', 'tax-calculator'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'tax-calculator'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .modal-divider' => 'align-items: {{VALUE}};',
                ],
                'condition' => [
                    'divider_style' => 'vertical',
                ],
            ]
        );

        // Divider Color
        $widget->add_control(
            'divider_color',
            [
                'label' => esc_html__('Color', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .modal-divider::before, {{WRAPPER}} .modal-divider::after' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .modal-divider span' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Divider Width
        $widget->add_responsive_control(
            'divider_width',
            [
                'label' => esc_html__('Width', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .modal-divider::before, {{WRAPPER}} .modal-divider::after' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Divider Height
        $widget->add_responsive_control(
            'divider_height',
            [
                'label' => esc_html__('Height', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .modal-divider::before, {{WRAPPER}} .modal-divider::after' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Divider Spacing
        $widget->add_responsive_control(
            'divider_spacing',
            [
                'label' => esc_html__('Spacing', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .modal-divider span' => 'margin: 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Divider Text Typography
        $widget->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'divider_text_typography',
                'selector' => '{{WRAPPER}} .modal-divider span',
            ]
        );

        // Divider Margin
        $widget->add_responsive_control(
            'divider_margin',
            [
                'label' => esc_html__('Margin', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .modal-divider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Divider Padding
        $widget->add_responsive_control(
            'divider_padding',
            [
                'label' => esc_html__('Padding', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .modal-divider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $widget->end_controls_section();

        // Modal Parts Section
        $widget->start_controls_section(
            'section_modal_parts',
            [
                'label' => esc_html__('Modal Parts', 'tax-calculator'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Modal Header Controls
        $widget->add_control(
            'heading_modal_header',
            [
                'label' => esc_html__('Modal Header', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        // Modal Header Background
        $widget->add_control(
            'modal_header_background',
            [
                'label' => esc_html__('Background Color', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .modal-header' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Modal Header Padding
        $widget->add_responsive_control(
            'modal_header_padding',
            [
                'label' => esc_html__('Padding', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .modal-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Modal Title Typography
        $widget->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'modal_title_typography',
                'label' => esc_html__('Title Typography', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .modal-title-heading',
            ]
        );

        // Modal Title Color
        $widget->add_control(
            'modal_title_color',
            [
                'label' => esc_html__('Title Color', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .modal-title-heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Modal Title Margin
        $widget->add_responsive_control(
            'modal_title_margin',
            [
                'label' => esc_html__('Title Margin', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .modal-title-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Close Button Icon
        $widget->add_control(
            'modal_close_button_icon',
            [
                'label' => esc_html__('Close Button Icon', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-times',
                    'library' => 'fa-solid',
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn-custom-close i' => 'display: block;',
                ],
            ]
        );

        // Close Button Custom Icon
        $widget->add_control(
            'modal_close_button_custom_icon',
            [
                'label' => esc_html__('Custom Close Icon', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_type' => 'image',
                'default' => [
                    'url' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn-custom-close' => 'background-image: url("{{URL}}"); background-size: contain; background-position: center; background-repeat: no-repeat;',
                ],
            ]
        );

        // Close Button Size
        $widget->add_responsive_control(
            'modal_close_button_size',
            [
                'label' => esc_html__('Close Button Size', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0.5,
                        'max' => 3,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn-custom-close' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Close Button Color
        $widget->add_control(
            'modal_close_button_color',
            [
                'label' => esc_html__('Close Button Color', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-custom-close i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'modal_close_button_icon[value]!' => '',
                ],
            ]
        );

        // Close Button Hover Color
        $widget->add_control(
            'modal_close_button_hover_color',
            [
                'label' => esc_html__('Close Button Hover Color', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-custom-close:hover i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'modal_close_button_icon[value]!' => '',
                ],
            ]
        );

        // Modal Body Controls
        $widget->add_control(
            'heading_modal_body',
            [
                'label' => esc_html__('Modal Body', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Modal Body Padding
        $widget->add_responsive_control(
            'modal_body_padding',
            [
                'label' => esc_html__('Padding', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .modal-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Modal Footer Controls
        $widget->add_control(
            'heading_modal_footer',
            [
                'label' => esc_html__('Modal Footer', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Modal Footer Padding
        $widget->add_responsive_control(
            'modal_footer_padding',
            [
                'label' => esc_html__('Padding', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .modal-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $widget->end_controls_section();

        // Row Explain Section
        $widget->start_controls_section(
            'section_row_explain',
            [
                'label' => esc_html__('How to donate Section', 'tax-calculator'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Row Explain Heading Typography
        $widget->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'row_explain_heading_typography',
                'label' => esc_html__('Heading Typography', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .row-explain .row-explain--heading',
            ]
        );

        // Row Explain Heading Color
        $widget->add_control(
            'row_explain_heading_color',
            [
                'label' => esc_html__('Heading Color', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .row-explain .row-explain--heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Row Explain Heading Margin
        $widget->add_responsive_control(
            'row_explain_heading_margin',
            [
                'label' => esc_html__('Heading Margin', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .row-explain .row-explain--heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Row Explain Paragraph Typography
        $widget->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'row_explain_paragraph_typography',
                'label' => esc_html__('Paragraph Typography', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .row-explain p',
            ]
        );

        // Row Explain Paragraph Color
        $widget->add_control(
            'row_explain_paragraph_color',
            [
                'label' => esc_html__('Paragraph Color', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .row-explain p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }
} 