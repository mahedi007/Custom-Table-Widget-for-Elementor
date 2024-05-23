<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Custom_Table_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'custom_table';
    }

    public function get_title() {
        return __('Custom Table', 'custom-table-widget');
    }

    public function get_icon() {
        return 'eicon-table';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function _register_controls() {
        // Table Header Section
        $this->start_controls_section(
            'header_section',
            [
                'label' => __('Table Header', 'custom-table-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater_header = new \Elementor\Repeater();

        $repeater_header->add_control(
            'header_content',
            [
                'label' => __('Header Content', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Header', 'custom-table-widget'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'table_header',
            [
                'label' => __('Table Header', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater_header->get_controls(),
                'title_field' => '{{{ header_content }}}',
            ]
        );

        $this->end_controls_section();

        // Table Columns Section
        $this->start_controls_section(
            'columns_section',
            [
                'label' => __('Table Columns', 'custom-table-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater_columns = new \Elementor\Repeater();

        $repeater_columns->add_control(
            'column_content',
            [
                'label' => __('Column Content', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Column', 'custom-table-widget'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'table_columns',
            [
                'label' => __('Table Columns', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater_columns->get_controls(),
                'title_field' => '{{{ column_content }}}',
            ]
        );

        $this->end_controls_section();

        // Table Rows Section
        $this->start_controls_section(
            'rows_section',
            [
                'label' => __('Table Rows', 'custom-table-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater_rows = new \Elementor\Repeater();
        $repeater_cells = new \Elementor\Repeater();

        $repeater_cells->add_control(
            'cell_content',
            [
                'label' => __('Cell Content', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Cell Content', 'custom-table-widget'),
                'label_block' => true,
            ]
        );

        $repeater_rows->add_control(
            'row_name',
            [
                'label' => __('Row Name', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Row', 'custom-table-widget'),
                'label_block' => true,
            ]
        );

        $repeater_rows->add_control(
            'row_cells',
            [
                'label' => __('Row Cells', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater_cells->get_controls(),
                'title_field' => '{{{ cell_content }}}',
            ]
        );

        $this->add_control(
            'table_rows',
            [
                'label' => __('Table Rows', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater_rows->get_controls(),
                'title_field' => '{{{ row_name }}}',
            ]
        );

        $this->end_controls_section();

        // Style Section for Header
        $this->start_controls_section(
            'header_style_section',
            [
                'label' => __('Header Style', 'custom-table-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'header_alignment',
            [
                'label' => __('Alignment', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'custom-table-widget'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'custom-table-widget'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'custom-table-widget'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-table th' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'header_text_color',
            [
                'label' => __('Text Color', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-table th' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'header_background_color',
            [
                'label' => __('Background Color', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-table th' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'header_typography',
                'selector' => '{{WRAPPER}} .custom-table th',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'header_text_shadow',
                'selector' => '{{WRAPPER}} .custom-table th',
            ]
        );

        $this->add_control(
            'header_text_stroke',
            [
                'label' => __('Text Stroke', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __('Example: 1px black', 'custom-table-widget'),
                'selectors' => [
                    '{{WRAPPER}} .custom-table th' => '-webkit-text-stroke: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section for Cell
        $this->start_controls_section(
            'cell_style_section',
            [
                'label' => __('Cell Style', 'custom-table-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'cell_alignment',
            [
                'label' => __('Alignment', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'custom-table-widget'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'custom-table-widget'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'custom-table-widget'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-table td' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cell_text_color',
            [
                'label' => __('Text Color', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-table td' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cell_background_color',
            [
                'label' => __('Background Color', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-table td' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'cell_typography',
                'selector' => '{{WRAPPER}} .custom-table td',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'cell_text_shadow',
                'selector' => '{{WRAPPER}} .custom-table td',
            ]
        );

        $this->add_control(
            'cell_text_stroke',
            [
                'label' => __('Text Stroke', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __('Example: 1px black', 'custom-table-widget'),
                'selectors' => [
                    '{{WRAPPER}} .custom-table td' => '-webkit-text-stroke: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Table Style Section
        $this->start_controls_section(
            'table_style_section',
            [
                'label' => __('Table Style', 'custom-table-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'table_border_color',
            [
                'label' => __('Table Border Color', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-table, {{WRAPPER}} .custom-table td, {{WRAPPER}} .custom-table th' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'table_cell_padding',
            [
                'label' => __('Cell Padding', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-table td, {{WRAPPER}} .custom-table th' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'table_background_color',
            [
                'label' => __('Table Background Color', 'custom-table-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-table' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $columns = $settings['table_columns'];
        $rows = $settings['table_rows'];
        $header = $settings['table_header'];

        echo '<table class="custom-table">';

        // Render Table Header
        echo '<thead><tr>';
        foreach ($header as $header_cell) {
            echo '<th>' . esc_html($header_cell['header_content']) . '</th>';
        }
        echo '</tr></thead>';

        // Render Table Rows
        echo '<tbody>';
        foreach ($rows as $row) {
            echo '<tr>';
            foreach ($row['row_cells'] as $cell) {
                echo '<td>' . esc_html($cell['cell_content']) . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody>';

        echo '</table>';
    }

    protected function _content_template() {
        ?>
        <#
        var columns = settings.table_columns;
        var rows = settings.table_rows;
        var header = settings.table_header;
        #>
        <table class="custom-table">
            <thead>
                <tr>
                    <# _.each(header, function(header_cell) { #>
                        <th>{{{ header_cell.header_content }}}</th>
                    <# }); #>
                </tr>
            </thead>
            <tbody>
                <# _.each(rows, function(row) { #>
                    <tr>
                        <# _.each(row.row_cells, function(cell) { #>
                            <td>{{{ cell.cell_content }}}</td>
                        <# }); #>
                    </tr>
                <# }); #>
            </tbody>
        </table>
        <?php
    }
}

// Register the widget
\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Custom_Table_Widget());
