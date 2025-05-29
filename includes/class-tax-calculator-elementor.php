<?php
if (!defined('ABSPATH')) {
    exit;
}

// Check if Elementor is installed and activated
if (!did_action('elementor/loaded')) {
    return;
}

// Check if the Widget_Base class exists
if (!class_exists('Elementor\Widget_Base')) {
    return;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;

class Tax_Calculator_Elementor_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'tax_calculator';
    }

    public function get_title()
    {
        return esc_html__('Tax Calculator', 'tax-calculator');
    }

    public function get_icon()
    {
        return 'eicon-calculator';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function register_controls()
    {
        // === INPUT STYLES ===
        $this->start_controls_section('section_input_styles', [
            'label' => esc_html__('Input Fields', 'tax-calculator'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->start_controls_tabs('input_state_tabs');

        // --- Normal Tab ---
        $this->start_controls_tab(
            'input_normal_tab',
            [
                'label' => esc_html__('Normal', 'tax-calculator'),
            ]
        );

        $this->add_control('input_text_color', [
            'label' => esc_html__('Text Color (Input)', 'tax-calculator'),
            'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .tp-input' => 'color: {{VALUE}};']
        ]);

        $this->add_control('input_bg_color', [
            'label' => esc_html__('Background Color (Input)', 'tax-calculator'),
            'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .tp-input' => 'background-color: {{VALUE}};']
        ]);

        $this->add_control('input_border_color', [
            'label' => esc_html__('Border Color', 'tax-calculator'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .tp-input' => 'border-color: {{VALUE}};',
            ]
        ]);

        $this->add_responsive_control('input_border_radius', [
            'label' => esc_html__('Border Radius', 'tax-calculator'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .tp-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ]
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'input_typography',
            'label' => esc_html__('Typography (Input)', 'tax-calculator'),
            'selector' => '{{WRAPPER}} .tp-input'
        ]);

        $this->end_controls_tab(); // End Normal Tab

        // --- Focus Tab ---
        $this->start_controls_tab(
            'input_focus_tab',
            [
                'label' => esc_html__('Focus', 'tax-calculator'),
            ]
        );

        $this->add_control('input_focus_text_color', [
            'label' => esc_html__('Text Color', 'tax-calculator'),
            'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .tp-input:focus' => 'color: {{VALUE}};']
        ]);

        $this->add_control('input_focus_bg_color', [
            'label' => esc_html__('Background Color', 'tax-calculator'),
            'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .tp-input:focus' => 'background-color: {{VALUE}};']
        ]);

        $this->add_control('input_focus_border_color', [
            'label' => esc_html__('Border Color', 'tax-calculator'),
            'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .tp-input:focus' => 'border-color: {{VALUE}};']
        ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(), [
            'name' => 'input_focus_box_shadow',
            'label' => esc_html__('Box Shadow', 'tax-calculator'),
            'selector' => '{{WRAPPER}} .tp-input:focus'
        ]);

        $this->end_controls_tab(); // End Focus Tab

        // --- Error Tab ---
        $this->start_controls_tab(
            'input_error_tab',
            [
                'label' => esc_html__('Error', 'tax-calculator'),
            ]
        );

        $this->add_control('input_error_text_color', [
            'label' => esc_html__('Text Color', 'tax-calculator'),
            'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .tp-input.is-invalid' => 'color: {{VALUE}};']
        ]);

        $this->add_control('input_error_bg_color', [
            'label' => esc_html__('Background Color', 'tax-calculator'),
            'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .tp-input.is-invalid' => 'background-color: {{VALUE}};']
        ]);

        $this->add_control('input_error_border_color', [
            'label' => esc_html__('Border Color', 'tax-calculator'),
            'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .tp-input.is-invalid' => 'border-color: {{VALUE}};']
        ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(), [
            'name' => 'input_error_box_shadow',
            'label' => esc_html__('Box Shadow', 'tax-calculator'),
            'selector' => '{{WRAPPER}} .tp-input.is-invalid'
        ]);

        $this->end_controls_tab(); // End Error Tab

        $this->end_controls_tabs(); // End Tabs

        // --- Input Addon (Prepend) Styles ---
        $this->add_control(
            'heading_input_addon_style',
            [
                'label' => esc_html__('Input Addon (Prepend)', 'tax-calculator'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control('input_addon_text_color', [
            'label' => esc_html__('Addon Text Color', 'tax-calculator'),
            'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .input-group-prepend .input-group-text' => 'color: {{VALUE}};']
        ]);

        $this->add_control('input_addon_bg_color', [
            'label' => esc_html__('Addon Background Color', 'tax-calculator'),
            'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .input-group-prepend .input-group-text' => 'background-color: {{VALUE}};']
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'input_addon_typography',
            'label' => esc_html__('Addon Typography', 'tax-calculator'),
            'selector' => '{{WRAPPER}} .input-group-prepend .input-group-text'
        ]);

        $this->add_responsive_control('input_addon_padding', [
            'label' => esc_html__('Addon Padding', 'tax-calculator'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => ['{{WRAPPER}} .input-group-prepend .input-group-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']
        ]);

        // Border controls for Input Addon
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'input_addon_border',
                'label' => esc_html__('Addon Border', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .input-group-prepend .input-group-text',
            ]
        );

        $this->add_control(
            'input_addon_border_radius',
            [
                'label' => esc_html__('Addon Border Radius', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .input-group-prepend .input-group-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'input_addon_border_color',
            [
                'label' => esc_html__('Addon Border Color', 'tax-calculator'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .input-group-prepend .input-group-text' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_addon_border_width',
            [
                'label' => esc_html__('Addon Border Width', 'tax-calculator'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .input-group-prepend .input-group-text' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content Section
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Calculator Texts', 'tax-calculator'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text_monthly_donation_label',
            [
                'label' => esc_html__('Monthly Donation Label', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('The amount I am happy to give each month', 'tax-calculator'),
                'rows' => 2,
            ]
        );

        $this->add_control(
            'text_years_label',
            [
                'label' => esc_html__('Number of Years Label', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('The number of years over which I wish to spread my donation', 'tax-calculator'),
                'rows' => 2,
            ]
        );

        $this->add_control(
            'text_one_off_donation_label',
            [
                'label' => esc_html__('One-off Donation Label', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('The amount I am happy to give as a one-off donation', 'tax-calculator'),
                'rows' => 2,
            ]
        );

        $this->end_controls_section();

        // Add Input Labels style section
        $this->start_controls_section(
            'section_labels_style',
            [
                'label' => esc_html__('Input Labels', 'tax-calculator'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'label_text_color',
            [
                'label' => esc_html__('Input Label Color', 'tax-calculator'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tax-input-label' => 'color: {{VALUE}};'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'label' => esc_html__('Input Label Typography', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .tax-input-label',
            ]
        );
        $this->add_responsive_control(
            'label_margin',
            [
                'label' => esc_html__('Input Label Margin', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tax-input-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'label_padding',
            [
                'label' => esc_html__('Input Label Padding', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tax-input-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
        $this->end_controls_section();

        

        // Add Invalid Feedback Styles Section
        $this->start_controls_section(
            'section_invalid_feedback_style',
            [
                'label' => esc_html__('Invalid Feedback Messages', 'tax-calculator'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'invalid_feedback_text_color',
            [
                'label' => esc_html__('Text Color', 'tax-calculator'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .invalid-feedback' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'invalid_feedback_typography',
                'label' => esc_html__('Typography', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .invalid-feedback',
            ]
        );

        $this->add_responsive_control(
            'invalid_feedback_margin',
            [
                'label' => esc_html__('Margin', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .invalid-feedback' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'invalid_feedback_padding',
            [
                'label' => esc_html__('Padding', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .invalid-feedback' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Add Tax Rate Title style section
        $this->start_controls_section(
            'section_tax_rate_title_style',
            [
                'label' => esc_html__('Tax Rate Title', 'tax-calculator'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'tax_rate_title_color',
            [
                'label' => esc_html__('Text Color', 'tax-calculator'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tax-rate-title' => 'color: {{VALUE}};'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tax_rate_title_typography',
                'label' => esc_html__('Typography', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .tax-rate-title',
            ]
        );
        $this->add_responsive_control(
            'tax_rate_title_margin',
            [
                'label' => esc_html__('Tax Rate Title Margin', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tax-rate-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'tax_rate_title_padding',
            [
                'label' => esc_html__('Tax Rate Title Padding', 'tax-calculator'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tax-rate-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
        $this->end_controls_section();

        // Include radio and checkbox controls
        require_once TAX_CALCULATOR_PLUGIN_DIR . 'includes/controls/class-radio-checkbox-controls.php';
        Tax_Calculator_Radio_Checkbox_Controls::add_controls($this);

        // Include results description controls
        require_once TAX_CALCULATOR_PLUGIN_DIR . 'includes/controls/class-results-description-controls.php';
        Tax_Calculator_Results_Description_Controls::add_controls($this);

        // Include divider controls
        require_once TAX_CALCULATOR_PLUGIN_DIR . 'includes/controls/class-divider-controls.php';
        Tax_Calculator_Divider_Controls::add_controls($this);

        // Include button controls
        require_once plugin_dir_path(__FILE__) . 'controls/class-button-controls.php';
        Tax_Calculator_Button_Controls::add_controls($this);

        // Include modal controls
        require_once plugin_dir_path(__FILE__) . 'controls/class-modal-controls.php';
        Tax_Calculator_Modal_Controls::add_controls($this);
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $shortcode_atts_array = [];
        $text_attributes = [
            'text_monthly_donation_label',
            'text_years_label',
            'text_one_off_donation_label',
            'text_invalid_amount_message',
            'text_invalid_years_message'
        ];

        foreach ($text_attributes as $attr) {
            if (isset($settings[$attr]) && !empty($settings[$attr])) {
                $shortcode_atts_array[] = sprintf('%s="%s"', $attr, esc_attr($settings[$attr]));
            }
        }

        $shortcode_atts_string = implode(' ', $shortcode_atts_array);
        $final_shortcode = '[tax_calculator ' . $shortcode_atts_string . ']';

        ?>
        <div class="tax-calculator-widget">
            <?php echo do_shortcode($final_shortcode); ?>
        </div>
        <?php
    }
}

class Tax_Calculator_Elementor
{
    public function init()
    {
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
    }

    public function register_widgets($widgets_manager)
    {
        require_once(TAX_CALCULATOR_PLUGIN_DIR . 'includes/class-tax-calculator-elementor.php');
        $widgets_manager->register(new Tax_Calculator_Elementor_Widget());
    }
}

// Initialize the Elementor integration
function tax_calculator_init_elementor()
{
    if (did_action('elementor/loaded')) {
        $elementor = new Tax_Calculator_Elementor();
        $elementor->init();
    }
}
add_action('plugins_loaded', 'tax_calculator_init_elementor');
