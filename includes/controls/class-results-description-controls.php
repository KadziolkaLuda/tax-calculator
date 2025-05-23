<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Tax_Calculator_Results_Description_Controls {
    public static function add_controls($widget) {
        // Add Results Description style section
        $widget->start_controls_section(
            'section_input_description_style',
            [
                'label' => esc_html__('Results Description', 'tax-calculator'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // --- Normal Description Text Controls ---
        $widget->add_control(
            'input_description_heading',
            [
                'label' => esc_html__('Normal Description Text', 'tax-calculator'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $widget->add_control(
            'input_description_text_color',
            [
                'label' => esc_html__('Text Color', 'tax-calculator'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .input-description-text' => 'color: {{VALUE}};'
                ],
            ]
        );

        $widget->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'input_description_text_typography',
                'label' => esc_html__('Typography', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .input-description-text',
            ]
        );

        $widget->add_responsive_control(
            'input_description_text_margin',
            [
                'label' => esc_html__('Margin', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .input-description-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $widget->add_responsive_control(
            'input_description_text_padding',
            [
                'label' => esc_html__('Padding', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .input-description-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        // --- Warning Description Text Controls ---
        $widget->add_control(
            'input_description_warning_heading',
            [
                'label' => esc_html__('Warning Description Text', 'tax-calculator'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $widget->add_control(
            'input_description_text_warning_color',
            [
                'label' => esc_html__('Text Color', 'tax-calculator'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .input-description-text-warning' => 'color: {{VALUE}};'
                ],
            ]
        );

        $widget->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'input_description_text_warning_typography',
                'label' => esc_html__('Typography', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .input-description-text-warning',
            ]
        );

        $widget->add_responsive_control(
            'input_description_text_warning_margin',
            [
                'label' => esc_html__('Margin', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .input-description-text-warning' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $widget->add_responsive_control(
            'input_description_text_warning_padding',
            [
                'label' => esc_html__('Padding', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .input-description-text-warning' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        // --- Tooltip Icon Controls ---
        $widget->add_control(
            'tooltip_icon_heading',
            [
                'label' => esc_html__('Tooltip Icon', 'tax-calculator'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $widget->add_control(
            'tooltip_icon_color',
            [
                'label' => esc_html__('Text Color', 'tax-calculator'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tooltip-icon' => 'color: {{VALUE}};'
                ],
            ]
        );

        $widget->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tooltip_icon_typography',
                'label' => esc_html__('Typography', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .tooltip-icon',
            ]
        );

        $widget->add_responsive_control(
            'tooltip_icon_margin',
            [
                'label' => esc_html__('Margin', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tooltip-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $widget->add_responsive_control(
            'tooltip_icon_padding',
            [
                'label' => esc_html__('Padding', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tooltip-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $widget->end_controls_section();
    }
} 