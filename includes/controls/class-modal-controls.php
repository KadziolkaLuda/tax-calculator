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

        // Pledge Text Controls
        $widget->add_control(
            'heading_pledge_text',
            [
                'label' => esc_html__('Pledge Text', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Pledge Text Typography
        $widget->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'pledge_text_typography',
                'selector' => '{{WRAPPER}} .modal-form-pledge',
            ]
        );

        // Pledge Text Color
        $widget->add_control(
            'pledge_text_color',
            [
                'label' => esc_html__('Text Color', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .modal-form-pledge, {{WRAPPER}} .modal-form-pledge--total' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Pledge Text Margin
        $widget->add_responsive_control(
            'pledge_text_margin',
            [
                'label' => esc_html__('Margin', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .modal-form-pledge, {{WRAPPER}} .modal-form-pledge--total' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Total Pledge Text Controls
        $widget->add_control(
            'heading_total_pledge_text',
            [
                'label' => esc_html__('Total Pledge Text', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Total Pledge Text Typography
        $widget->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'total_pledge_text_typography',
                'selector' => '{{WRAPPER}} .modal-form-pledge--total',
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
    }
} 