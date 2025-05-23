<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Tax_Calculator_Button_Controls {
    public static function add_controls($widget) {
        // === BUTTON STYLES ===
        $widget->start_controls_section('section_button_styles', [
            'label' => esc_html__('Button', 'tax-calculator'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        // ALIGNMENT CONTROL
        $widget->add_responsive_control(
            'button_alignment',
            [
                'label' => esc_html__( 'Alignment', 'tax-calculator' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => esc_html__( 'Left', 'tax-calculator' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'tax-calculator' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'tax-calculator' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justified', 'tax-calculator' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tax-calculator-widget .submit-button-wrapper' => 'text-align: {{VALUE}};',
                ],
                'default' => 'center',
            ]
        );

        $widget->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__('Typography', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .tax-calculator-widget .btn-subbmit',
            ]
        );

        $widget->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'button_text_shadow',
                'label' => esc_html__('Text Shadow', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .tax-calculator-widget .btn-subbmit',
            ]
        );

        // --- Tabs for Normal and Hover States ---
        $widget->start_controls_tabs('button_tabs');

        // --- Normal Tab ---
        $widget->start_controls_tab(
            'button_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tax-calculator' ),
            ]
        );

        $widget->add_control('button_text_color', [
            'label' => esc_html__('Text Color', 'tax-calculator'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .tax-calculator-widget .btn-subbmit' => 'color: {{VALUE}};']
        ]);

        $widget->add_group_control(\Elementor\Group_Control_Background::get_type(), [
            'name' => 'button_background',
            'label' => esc_html__('Background', 'tax-calculator'),
            'types' => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} .tax-calculator-widget .btn-subbmit',
            'exclude' => [ 'image' ],
        ]);

        $widget->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => esc_html__('Border', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .tax-calculator-widget .btn-subbmit',
            ]
        );

        $widget->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), [
            'name' => 'button_box_shadow',
            'label' => esc_html__('Box Shadow', 'tax-calculator'),
            'selector' => '{{WRAPPER}} .tax-calculator-widget .btn-subbmit'
        ]);

        $widget->end_controls_tab();

        // --- Hover Tab ---
        $widget->start_controls_tab(
            'button_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tax-calculator' ),
            ]
        );

        $widget->add_control(
            'button_hover_text_color',
            [
                'label' => esc_html__( 'Text Color', 'tax-calculator' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tax-calculator-widget .btn-subbmit:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $widget->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button_hover_background',
                'label' => esc_html__( 'Background', 'tax-calculator' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tax-calculator-widget .btn-subbmit:hover',
                'exclude' => [ 'image' ],
            ]
        );

        $widget->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_hover_border',
                'label' => esc_html__('Border', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .tax-calculator-widget .btn-subbmit:hover',
            ]
        );
              
        $widget->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_hover_box_shadow',
                'label' => esc_html__('Box Shadow', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .tax-calculator-widget .btn-subbmit:hover'
            ]
        );
        
        $widget->add_control(
            'button_hover_animation',
            [
                'label' => esc_html__( 'Hover Animation', 'tax-calculator' ),
                'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $widget->end_controls_tab();
        $widget->end_controls_tabs();

        $widget->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tax-calculator-widget .btn-subbmit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );        

        $widget->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__( 'Margin', 'tax-calculator' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tax-calculator-widget .btn-subbmit, {{WRAPPER}} .tax-calculator-widget .btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            'button_min_width',
            [
                'label' => esc_html__( 'Min Width', 'tax-calculator' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%', 'vw' ],
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 1000, 'step' => 1 ],
                    '%' => [ 'min' => 0, 'max' => 100, 'step' => 1 ],
                    'em' => [ 'min' => 0, 'max' => 50, 'step' => 0.1 ],
                    'vw' => [ 'min' => 0, 'max' => 100, 'step' => 1 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tax-calculator-widget .btn-subbmit' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }
} 