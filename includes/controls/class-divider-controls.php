<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Tax_Calculator_Divider_Controls {
    public static function add_controls($widget) {
        // Add Calculator Divider Styles Section
        $widget->start_controls_section(
            'section_calculator_divider_style',
            [
                'label' => esc_html__('Calculator Divider (e.g., OR Divider)', 'tax-calculator'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // --- Divider Container Controls ---
        $widget->add_control(
            'calculator_divider_heading_container',
            [
                'label' => esc_html__('Divider Container (.calculat-divider)', 'tax-calculator'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $widget->add_responsive_control(
            'calculator_divider_margin',
            [
                'label' => esc_html__('Margin', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .calculat-divider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            'calculator_divider_padding',
            [
                'label' => esc_html__('Padding', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .calculat-divider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // --- Divider Span (Text) Controls ---
        $widget->add_control(
            'calculator_divider_heading_span',
            [
                'label' => esc_html__('Divider Text (span)', 'tax-calculator'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $widget->add_control(
            'calculator_divider_span_text_color',
            [
                'label' => esc_html__('Text Color', 'tax-calculator'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .calculat-divider span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $widget->add_control(
            'calculator_divider_span_bg_color',
            [
                'label' => esc_html__('Background Color', 'tax-calculator'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .calculat-divider span' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $widget->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'calculator_divider_span_typography',
                'label' => esc_html__('Typography', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .calculat-divider span',
            ]
        );

        $widget->add_responsive_control(
            'calculator_divider_span_padding',
            [
                'label' => esc_html__('Padding', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .calculat-divider span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // --- Divider Line (::after) Controls ---
        $widget->add_control(
            'calculator_divider_heading_line',
            [
                'label' => esc_html__('Divider Line (::after)', 'tax-calculator'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $widget->add_control(
            'calculator_divider_line_bg_color',
            [
                'label' => esc_html__('Line Background Color', 'tax-calculator'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .calculat-divider::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }
} 