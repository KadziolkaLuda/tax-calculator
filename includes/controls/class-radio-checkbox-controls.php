<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Tax_Calculator_Radio_Checkbox_Controls {
    public static function add_controls($widget) {
        // Add Rate Tax section
        $widget->start_controls_section(
            'section_rate_tax_style',
            [
                'label' => esc_html__('Rate Tax', 'tax-calculator'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // --- Checkbox Text Labels Controls ---
        $widget->add_control(
            'radio_label_heading',
            [
                'label' => esc_html__('Checkbox Text Labels', 'tax-calculator'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $widget->add_control(
            'radio_label_text_color',
            [
                'label' => esc_html__('Text Color', 'tax-calculator'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tax-radio-label' => 'color: {{VALUE}};'
                ],
            ]
        );

        $widget->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'radio_label_typography',
                'label' => esc_html__('Typography', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .tax-radio-label',
            ]
        );

        $widget->add_responsive_control(
            'radio_label_margin',
            [
                'label' => esc_html__('Margin', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tax-radio-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $widget->add_responsive_control(
            'radio_label_padding',
            [
                'label' => esc_html__('Padding', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tax-radio-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        // --- Checkbox Label Controls ---
        $widget->add_control(
            'checkbox_label_heading',
            [
                'label' => esc_html__('Checkbox Label', 'tax-calculator'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $widget->add_control(
            'checkbox_label_bg_color',
            [
                'label' => esc_html__('Background Color', 'tax-calculator'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-check-label' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $widget->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'checkbox_label_border',
                'label' => esc_html__('Border', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .form-check-label',
            ]
        );

        $widget->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'checkbox_label_box_shadow',
                'label' => esc_html__('Box Shadow', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .form-check-label',
            ]
        );

        $widget->add_responsive_control(
            'checkbox_label_width',
            [
                'label' => esc_html__('Width', 'tax-calculator'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'vw'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 500],
                    '%' => ['min' => 0, 'max' => 100],
                ],
                'selectors' => [
                    '{{WRAPPER}} .form-check-label' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            'checkbox_label_height',
            [
                'label' => esc_html__('Height', 'tax-calculator'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'vh'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 500],
                    '%' => ['min' => 0, 'max' => 100],
                ],
                'selectors' => [
                    '{{WRAPPER}} .form-check-label' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            'checkbox_label_padding',
            [
                'label' => esc_html__('Padding', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .form-check-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // --- Checked State Controls ---
        $widget->add_control(
            'checkbox_checked_heading',
            [
                'label' => esc_html__('Checked State', 'tax-calculator'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $widget->add_control(
            'checkbox_checked_color',
            [
                'label' => esc_html__('Checkmark Color', 'tax-calculator'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-check-input:checked + .form-check-label::after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            'checkbox_checked_font_size',
            [
                'label' => esc_html__('Checkmark Size', 'tax-calculator'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 100],
                ],
                'selectors' => [
                    '{{WRAPPER}} .form-check-input:checked + .form-check-label::after' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }
} 