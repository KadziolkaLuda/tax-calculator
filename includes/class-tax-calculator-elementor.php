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

class Tax_Calculator_Elementor_Widget extends Widget_Base {
    public function get_name() {
        return 'tax_calculator';
    }

    public function get_title() {
        return esc_html__('Tax Calculator', 'tax-calculator');
    }

    public function get_icon() {
        return 'eicon-calculator';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function register_controls() {
        // === INPUT STYLES ===
        $this->start_controls_section('section_input_styles', [
            'label' => esc_html__('Input Fields', 'tax-calculator'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('input_text_color', [
            'label' => esc_html__('Text Color', 'tax-calculator'),
            'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .tp-input' => 'color: {{VALUE}};']
        ]);

        $this->add_control('input_bg_color', [
            'label' => esc_html__('Background Color', 'tax-calculator'),
            'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .tp-input' => 'background-color: {{VALUE}};']
        ]);

        $this->add_control('input_border_color', [
            'label' => esc_html__('Border Color', 'tax-calculator'),
            'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .tp-input' => 'border-color: {{VALUE}};']
        ]);

        $this->add_control('input_border_radius', [
            'label' => esc_html__('Border Radius', 'tax-calculator'),
            'type' => Controls_Manager::SLIDER,
            'selectors' => ['{{WRAPPER}} .tp-input' => 'border-radius: {{SIZE}}{{UNIT}};']
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'input_typography',
            'label' => esc_html__('Typography', 'tax-calculator'),
            'selector' => '{{WRAPPER}} .tp-input'
        ]);

        $this->end_controls_section();

        // === BUTTON STYLES ===
        $this->start_controls_section('section_button_styles', [
            'label' => esc_html__('Buttons', 'tax-calculator'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('button_text_color', [
            'label' => esc_html__('Text Color', 'tax-calculator'),
            'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} button' => 'color: {{VALUE}};']
        ]);

        $this->add_group_control(Group_Control_Background::get_type(), [
            'name' => 'button_background',
            'label' => esc_html__('Background', 'tax-calculator'),
            'selector' => '{{WRAPPER}} button'
        ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(), [
            'name' => 'button_shadow',
            'selector' => '{{WRAPPER}} button'
        ]);

        $this->add_control('button_border_radius', [
            'label' => esc_html__('Border Radius', 'tax-calculator'),
            'type' => Controls_Manager::SLIDER,
            'selectors' => ['{{WRAPPER}} button' => 'border-radius: {{SIZE}}{{UNIT}};']
        ]);

        $this->end_controls_section();

        // Content Section
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Calculator Settings', 'tax-calculator'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Donation Calculator', 'tax-calculator'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Calculate your donation with Gift Aid and tax relief.', 'tax-calculator'),
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Style', 'tax-calculator'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tax-calculator-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .tax-calculator-title',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'tax-calculator'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tax-calculator-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Description Typography', 'tax-calculator'),
                'selector' => '{{WRAPPER}} .tax-calculator-description',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="tax-calculator-widget">
            <?php if ($settings['title']) : ?>
                <h2 class="tax-calculator-title"><?php echo esc_html($settings['title']); ?></h2>
            <?php endif; ?>

            <?php if ($settings['description']) : ?>
                <div class="tax-calculator-description"><?php echo wp_kses_post($settings['description']); ?></div>
            <?php endif; ?>

            <?php echo do_shortcode('[tax_calculator]'); ?>
        </div>
        <?php
    }
}

class Tax_Calculator_Elementor {
    public function init() {
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
    }

    public function register_widgets($widgets_manager) {
        require_once(TAX_CALCULATOR_PLUGIN_DIR . 'includes/class-tax-calculator-elementor.php');
        $widgets_manager->register(new Tax_Calculator_Elementor_Widget());
    }
}

// Initialize the Elementor integration
function tax_calculator_init_elementor() {
    if (did_action('elementor/loaded')) {
        $elementor = new Tax_Calculator_Elementor();
        $elementor->init();
    }
}
add_action('plugins_loaded', 'tax_calculator_init_elementor');
