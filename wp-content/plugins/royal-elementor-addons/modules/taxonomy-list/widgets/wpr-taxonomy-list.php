<?php
namespace WprAddons\Modules\TaxonomyList\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Responsive\Responsive;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Image_Size;
use WprAddons\Classes\Utilities;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Wpr_Taxonomy_List extends Widget_Base {
	
	public function get_name() {
		return 'wpr-taxonomy-list';
	}

	public function get_title() {
		return esc_html__( 'Taxonomy List', 'wpr-addons' );
	}

	public function get_icon() {
		return 'wpr-icon eicon-editor-list-ul';
	}

	public function get_categories() {
		return [ 'wpr-widgets' ];
	}

	public function get_keywords() {
		return [ 'royal', 'taxonomy-list', 'taxonomy', 'category', 'categories', 'tag', 'list'];
	}

	public function get_post_taxonomies() {
		return [
			'category' => esc_html__( 'Categories', 'wpr-addons' ),
			'post_tag' => esc_html__( 'Tags', 'wpr-addons' ),
			'product_cat' => esc_html__( 'Product Categories', 'wpr-addons' ),
			'product_tag' => esc_html__( 'Product Tags', 'wpr-addons' ),
		];
	}

    protected function register_controls() {

		// Tab: Content ==============
		// Section: General ----------
		$this->start_controls_section(
			'section_taxonomy_list_general',
			[
				'label' => esc_html__( 'General', 'wpr-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'query_heading',
			[
				'label' => esc_html__( 'Query', 'wpr-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'query_tax_selection',
			[
				'label' => esc_html__( 'Select Taxonomy', 'wpr-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'category',
				'options' => $this->get_post_taxonomies(),
			]
		);

		$this->add_control(
			'query_hide_empty',
			[
				'label' => esc_html__( 'Hide Empty', 'wpr-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes'
			]
		);

		$this->add_control(
			'layout_heading',
			[
				'label' => esc_html__( 'Layout', 'wpr-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'taxonomy_list_layout',
			[
				'label' => esc_html__( 'Select Layout', 'wpr-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'vertical',
				'options' => [
					'vertical' => [
						'title' => esc_html__( 'Vertical', 'wpr-addons' ),
						'icon' => 'eicon-editor-list-ul',
					],
					'horizontal' => [
						'title' => esc_html__( 'Horizontal', 'wpr-addons' ),
						'icon' => 'eicon-ellipsis-h',
					],
				],
                'prefix_class' => 'wpr-taxonomy-list-',
				'label_block' => false,
			]
		);

		$this->add_control(
			'show_tax_list_icon',
			[
				'label' => esc_html__( 'Show Icon', 'wpr-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'label_block' => false,
				'default' => 'yes'
			]
		);

		$this->add_control(
			'tax_list_icon',
			[
				'label' => esc_html__( 'Select Icon', 'wpr-addons' ),
				'type' => Controls_Manager::ICONS,
				'skin' => 'inline',
				'label_block' => false,
				'exclude_inline_options' => 'svg',
				'condition' => [
					'show_tax_list_icon' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_tax_count',
			[
				'label' => esc_html__( 'Show Count', 'wpr-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'label_block' => false,
				'default' => 'yes'
			]
		);

        $this->end_controls_section();

		// Section: Pro Features
		Utilities::pro_features_list_section( $this, '', Controls_Manager::RAW_HTML, 'taxonomy-list', [
			'Query Custom Post Type Taxonomies (categories).'
		] );

		// Styles ====================
		// Section: Taxonomy Style ---
		$this->start_controls_section(
			'section_style_tax',
			[
				'label' => esc_html__( 'Taxonomy Style', 'wpr-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->start_controls_tabs( 'tax_style' );

		$this->start_controls_tab(
			'tax_normal',
			[
				'label' => esc_html__( 'Normal', 'wpr-addons' ),
			]
		);

		$this->add_control(
			'tax_color',
			[
				'label'  => esc_html__( 'Color', 'wpr-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#605BE5',
				'selectors' => [
					'{{WRAPPER}} .wpr-taxonomy-list li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tax_bg_color',
			[
				'label'  => esc_html__( 'Background Color', 'wpr-addons' ),
				'type' => Controls_Manager::COLOR,
                'default' => '#00000000',
				'selectors' => [
					'{{WRAPPER}} .wpr-taxonomy-list li a' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'tax_border_color',
			[
				'label'  => esc_html__( 'Border Color', 'wpr-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#E8E8E8',
				'selectors' => [
					'{{WRAPPER}} .wpr-taxonomy-list li a' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tax_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wpr-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0.5,
				'min' => 0,
				'max' => 5,
				'step' => 0.1,
				'selectors' => [
					'{{WRAPPER}} .wpr-taxonomy-list li a' => 'transition-duration: {{VALUE}}s',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tax_typography',
				'scheme' => Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .wpr-taxonomy-list li a',
				'fields_options' => [
					'typography'      => [
						'default' => 'custom',
					],
					'font_size'      => [
						'default'    => [
							'size' => '14',
							'unit' => 'px',
						],
					]
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tax_hover',
			[
				'label' => esc_html__( 'Hover', 'wpr-addons' ),
			]
		);

		$this->add_control(
			'tax_color_hr',
			[
				'label'  => esc_html__( 'Color', 'wpr-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-taxonomy-list li a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tax1_bg_color_hr',
			[
				'label'  => esc_html__( 'Background Color', 'wpr-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-taxonomy-list li a:hover' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'tax1_border_color_hr',
			[
				'label'  => esc_html__( 'Border Color', 'wpr-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-taxonomy-list li a:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'tax_padding',
			[
				'label' => esc_html__( 'Padding', 'wpr-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 5,
					'right' => 0,
					'bottom' => 5,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-taxonomy-list li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'tax_margin',
			[
				'label' => esc_html__( 'Margin', 'wpr-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 5,
					'right' => 8,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-taxonomy-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tax_border_type',
			[
				'label' => esc_html__( 'Border Type', 'wpr-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'wpr-addons' ),
					'solid' => esc_html__( 'Solid', 'wpr-addons' ),
					'double' => esc_html__( 'Double', 'wpr-addons' ),
					'dotted' => esc_html__( 'Dotted', 'wpr-addons' ),
					'dashed' => esc_html__( 'Dashed', 'wpr-addons' ),
					'groove' => esc_html__( 'Groove', 'wpr-addons' ),
				],
				'default' => 'solid',
				'selectors' => [
					'{{WRAPPER}} .wpr-taxonomy-list li a' => 'border-style: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tax_border_width',
			[
				'label' => esc_html__( 'Border Width', 'wpr-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 1,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-taxonomy-list li a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'tax_border_type!' => 'none',
				],
			]
		);

		$this->add_control(
			'tax_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wpr-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-taxonomy-list li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();

		// Tab: Style ==============
		// Section: Content --------
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon', 'wpr-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_tax_list_icon' => 'yes'
				]
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'  => esc_html__( 'Color', 'wpr-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#605BE5',
				'selectors' => [
					'{{WRAPPER}} .wpr-taxonomy-list li i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'wpr-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-taxonomy-list li i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'icon_distance',
			[
				'label' => esc_html__( 'Distance', 'wpr-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-taxonomy-list li i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
    }

    protected function render() {
		// Get Settings
        $settings = $this->get_settings_for_display();

		ob_start();
		\Elementor\Icons_Manager::render_icon( $settings['tax_list_icon'], [ 'aria-hidden' => 'true' ] );
		$icon = ob_get_clean();
		$icon_wrapper = !empty($settings['tax_list_icon']) ? '<span>'. $icon .'</span>' : '';

        // Get Taxonomies
		$terms = get_terms([
			'taxonomy' => $settings['query_tax_selection'],
			'hide_empty' => 'yes' === $settings['query_hide_empty'],
		]);

         echo '<ul class="wpr-taxonomy-list">';

        foreach ($terms as $key => $term) {
        	$sub_class = $term->parent > 0 ? ' class="wpr-sub-taxonomy"' : '';
        	
            echo '<li'. $sub_class .'>';
	            echo '<a href="'. esc_url(get_term_link($term->term_id)) .'">';
					echo '<span class="wpr-tax-wrap">'. $icon_wrapper .'<span>'. esc_html($term->name) .'</span></span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		            echo ($settings['show_tax_count']) ? '<span><span class="wpr-term-count">&nbsp;('. esc_html($term->count) .')</span></span>' : '';
	            echo '</a>';
            echo '</li>';
        }

         echo '</ul>';
    }
}