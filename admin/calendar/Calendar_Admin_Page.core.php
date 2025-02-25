<?php

use EventEspresso\core\services\request\DataType;

/**
 * Calendar_Admin_Page
 * This contains the logic for setting up the Calendar Addon Admin related pages.  Any methods without PHP doc comments
 * have inline docs with parent class.
 *
 * @package     Calendar_Admin_Page (calendar addon)
 * @subpackage  admin/Calendar_Admin_Page.core.php
 * @author      Darren Ethier
 */
class Calendar_Admin_Page extends EE_Admin_Page
{
    protected function _init_page_props()
    {
        $this->page_slug        = CALENDAR_PG_SLUG;
        $this->page_label       = CALENDAR_LABEL;
        $this->_admin_base_url  = EE_CALENDAR_ADMIN_URL;
        $this->_admin_base_path = EE_CALENDAR_ADMIN;
    }


    protected function _ajax_hooks()
    {
    }


    protected function _define_page_props()
    {
        $this->_admin_page_title = CALENDAR_LABEL;
        $this->_labels           = [
            'publishbox' => esc_html__('Update Settings', 'event_espresso'),
        ];
    }


    protected function _set_page_routes()
    {
        $this->_page_routes = [
            'default'         => [$this, '_basic_settings'],
            'advanced'        => [$this, '_advanced_settings'],
            'update_settings' => [
                'func'     => [$this, '_update_settings'],
                'noheader' => true,
            ],
            'usage'           => '_usage',
        ];
    }


    protected function _set_page_config()
    {
        $this->_page_config = [
            'default'  => [
                'nav'           => [
                    'label' => esc_html__('Basic Settings', 'event_espresso'),
                    'order' => 10,
                ],
                'metaboxes'     => array_merge($this->_default_espresso_metaboxes, ['_publish_post_box']),
                'require_nonce' => false,
            ],
            'advanced' => [
                'nav'           => [
                    'label' => esc_html__('Advanced Settings', 'event_espresso'),
                    'order' => 20,
                ],
                'metaboxes'     => array_merge($this->_default_espresso_metaboxes, ['_publish_post_box']),
                'require_nonce' => false,
            ],
            'usage'    => [
                'nav'           => [
                    'label' => esc_html__('Calendar Usage', 'event_espresso'),
                    'order' => 30,
                ],
                'require_nonce' => false,
            ],
        ];
    }


    protected function _add_screen_options()
    {
    }


    protected function _add_screen_options_default()
    {
    }


    protected function _add_feature_pointers()
    {
    }


    public function load_scripts_styles()
    {
        wp_register_style(
            'ee-calendar-admin-css',
            EE_CALENDAR_ADMIN_ASSETS_URL . 'calendar-admin.css',
            ['ee-admin-css', 'wp-color-picker'],
            EE_CALENDAR_VERSION
        );
        wp_enqueue_style('ee-calendar-admin-css');
        wp_register_script(
            'ee-calendar-admin-js',
            EE_CALENDAR_ADMIN_ASSETS_URL . 'calendar-admin.js',
            ['jquery', 'wp-color-picker'],
            EE_CALENDAR_VERSION,
            true
        );
        wp_enqueue_script('ee-calendar-admin-js');
        wp_localize_script(
            'ee-calendar-admin-js',
            'ee_calendar',
            [
                'confirm_reset_text' => esc_html__(
                    "Are you sure you want to reset ALL your Event Espresso Calendar Information? This cannot be undone.",
                    'event_espresso'
                ),
            ]
        );
    }


    public function admin_init()
    {
    }


    public function admin_notices()
    {
    }


    public function admin_footer_scripts()
    {
    }


    /**
     * @throws EE_Error
     */
    protected function _basic_settings()
    {
        $this->_settings_page('calendar_basic_settings.template.php');
    }


    /**
     * @throws EE_Error
     */
    protected function _advanced_settings()
    {
        $this->_settings_page('calendar_advanced_settings.template.php');
    }


    /**
     * _settings_page
     *
     * @param $template
     * @throws EE_Error
     */
    protected function _settings_page($template)
    {
        $this->_template_args['calendar_config'] = EE_Config::instance()->get_config(
            'addons',
            'EE_Calendar',
            'EE_Calendar_Config'
        );
        $this->_template_args['values']          = [
            ['id' => false, 'text' => esc_html__('No', 'event_espresso')],
            ['id' => true, 'text' => esc_html__('Yes', 'event_espresso')],
        ];
        $this->_template_args['return_action']   = $this->_req_action;
        $this->_template_args['reset_url']       = EE_Admin_Page::add_query_args_and_nonce(
            ['action' => 'reset_settings', 'return_action' => $this->_req_action],
            EE_CALENDAR_ADMIN_URL
        );
        $this->_set_add_edit_form_tags('update_settings');
        $this->_set_publish_post_box_vars();
        $this->_template_args['admin_page_content'] = EEH_Template::display_template(
            EE_CALENDAR_ADMIN_TEMPLATE_PATH . $template,
            $this->_template_args,
            true
        );
        $this->display_admin_page_with_sidebar();
    }


    /**
     * @throws EE_Error
     */
    protected function _usage()
    {
        $this->_template_args['admin_page_content'] = EEH_Template::display_template(
            EE_CALENDAR_ADMIN_TEMPLATE_PATH . 'calendar_usage_info.template.php',
            apply_filters(
                'FHEE__Calendar_Admin_Page___usage__calendar_usage_info__template_args',
                []
            ),
            true
        );
        $this->display_admin_page_with_no_sidebar();
    }


    /**
     * @throws EE_Error
     */
    protected function _update_settings()
    {
        if ($this->request->getRequestParam('reset') === '1') {
            $config = new EE_Calendar_Config();
            $count  = 1;
        } else {
            $config = EE_Config::instance()->get_config('addons', 'EE_Calendar', 'EE_Calendar_Config');
            $count  = 0;
            // WP adds slashes by default, so remove them.
            // see https://wordpress.org/support/topic/does-wordpress-escapeadd-slashes-to-_request-fields-in-a-plugin
            $calendar_req_data = stripslashes_deep($this->request->getRequestParam('calendar', [], DataType::ARRAY));
            if (
                isset($calendar_req_data['time']['format'])
                && $calendar_req_data['time']['format'] === 'custom'
                && $this->request->requestParamIsset('time_format_custom')
            ) {
                $calendar_req_data['time']['format'] = $this->request->getRequestParam('time_format_custom');
            }
            // otherwise we assume you want to allow full html
            foreach ($calendar_req_data as $top_level_key => $top_level_value) {
                if (is_array($top_level_value)) {
                    foreach ($top_level_value as $second_level_key => $second_level_value) {
                        if (
                            property_exists($config, $top_level_key)
                            && property_exists($config->{$top_level_key}, $second_level_key)
                            && $second_level_value !== $config->{$top_level_key}->{$second_level_key}
                        ) {
                            $config->{$top_level_key}->{$second_level_key} = $this->_sanitize_config_input(
                                $top_level_key,
                                $second_level_key,
                                $second_level_value
                            );
                            $count++;
                        }
                    }
                } elseif (property_exists($config, $top_level_key) && $top_level_value !== $config->{$top_level_key}) {
                    $config->{$top_level_key} = $this->_sanitize_config_input(
                        $top_level_key,
                        null,
                        $top_level_value
                    );
                    $count++;
                }
            }
        }
        EE_Config::instance()->update_config('addons', 'EE_Calendar', $config);
        $this->_redirect_after_action(
            $count,
            'Settings',
            'updated',
            ['action' => $this->request->getRequestParam('return_action')]
        );
    }


    private function _sanitize_config_input($top_level_key, $second_level_key, $value)
    {
        $sanitization_methods = [
            'time'          => [
                'first_day' => 'int',
                'weekends'  => 'bool',
                'week_mode' => 'plaintext',
                'format'    => 'plaintext',
                'show'      => 'bool',
            ],
            'header'        => [
                'left'   => 'plaintext',
                'center' => 'plaintext',
                'right'  => 'plaintext',
            ],
            'button_text'   => [
                'prev'      => 'html',
                'next'      => 'html',
                'prev_year' => 'html',
                'next_year' => 'html',
                'today'     => 'html',
                'month'     => 'html',
                'week'      => 'html',
                'day'       => 'html',
            ],
            'tooltip'       => [
                'show'     => 'bool',
                'pos_my_1' => 'plaintext',
                'pos_my_2' => 'plaintext',
                'pos_at_1' => 'plaintext',
                'pos_at_2' => 'plaintext',
                'style'    => 'plaintext',
            ],
            'title_format'  => [
                'month' => 'plaintext',
                'week'  => 'plaintext',
                'day'   => 'plaintext',
            ],
            'column_format' => [
                'month' => 'plaintext',
                'week'  => 'plaintext',
                'day'   => 'plaintext',
            ],
            'display'       => [
                'enable_calendar_thumbs'  => 'bool',
                'calendar_height'         => 'int',
                'enable_calendar_filters' => 'bool',
                'enable_category_legend'  => 'bool',
                'use_pickers'             => 'bool',
                'event_background'        => 'plaintext',
                'event_text_color'        => 'plaintext',
                'enable_cat_classes'      => 'bool',
                'disable_categories'      => 'bool',
                'show_attendee_limit'     => 'bool',
            ],
        ];
        $sanitization_method  = null;
        if (
            isset($sanitization_methods[ $top_level_key ])
            && $second_level_key === null
            && ! is_array($sanitization_methods[ $top_level_key ])
        ) {
            $sanitization_method = $sanitization_methods[ $top_level_key ];
        } elseif (
            is_array($sanitization_methods[ $top_level_key ])
            && isset($sanitization_methods[ $top_level_key ][ $second_level_key ])
        ) {
            $sanitization_method = $sanitization_methods[ $top_level_key ][ $second_level_key ];
        }
        //      echo "$top_level_key [$second_level_key] with value $value will be sanitized as a $sanitization_method<br>";
        switch ($sanitization_method) {
            case 'bool':
                return filter_var($value, FILTER_VALIDATE_BOOL);
            case 'plaintext':
                return wp_strip_all_tags($value);
            case 'int':
                return (int) $value;
            case 'html':
                return $value;
            default:
                EE_Error::add_error(
                    sprintf(
                        esc_html__(
                            "Could not sanitize input '%s' because it has no entry in our sanitization methods array",
                            "event_espresso"
                        ),
                        $second_level_key ? "$top_level_key[$second_level_key]" : $top_level_key
                    ),
                    __FILE__,
                    __FUNCTION__,
                    __LINE__
                );
                return null;
        }
    }
}
