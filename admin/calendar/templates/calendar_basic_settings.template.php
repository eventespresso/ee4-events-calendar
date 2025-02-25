<?php
/**
 * @var $calendar_config EE_Calendar_Config
 * @var $return_action   string
 * @var $values          array
 */

?>
<div class="ee-calender-settings padding">
    <h3>
        <?php esc_html_e('Time/Date Settings', 'event_espresso'); ?>
    </h3>
    <table class="ee-admin-two-column-layout form-table">
        <tbody>
            <tr>
                <th>
                    <label for="show_time">
                        <?php esc_html_e('Show Event Time in Calendar', 'event_espresso'); ?>
                    </label>
                </th>
                <td>
                    <?php echo EEH_Form_Fields::select_input(
                        'calendar[time][show]',
                        $values,
                        $calendar_config->time->show,
                        'id="show_time"'
                    ); ?>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="time_format">
                        <?php esc_html_e('Time Format', 'event_espresso') ?>
                    </label>
                </th>
                <td>
                    <ul class='ee-calendar-options__time-format'>
                    <?php

                    $time_formats = apply_filters(
                        'time_formats',
                        [
                            'g:i a',
                            'ga',
                            'g:i A',
                            'gA',
                            'H:i',
                        ]
                    );

                    $custom = true;

                    foreach ($time_formats as $format) {
                        $checked = '';
                        if ($calendar_config->time->format === $format) {
                            $checked = " checked='checked'";
                            $custom = false;
                        }
                        ?>
                        <li class="ee-calendar-option__time-format">
                            <label title="<?php echo esc_attr($format);?>">
                                <input type="radio"
                                       name="calendar[time][format]"
                                       value="<?php echo esc_attr($format);?>"
                                       <?php echo $checked;?>
                                />
                                <span><?php echo date_i18n($format);?></span>
                            </label>
                        </li>
                    <?php } ?>

                        <li class="ee-calendar-option__time-format">
                            <label title="<?php echo esc_attr(__('Custom:', 'event_espresso'));?>">
                                <input type="radio"
                                       id="time_format_custom_radio"
                                       name="calendar[time][format]"
                                       value="\c\u\s\t\o\m"
                                        <?php echo $custom ? ' checked="checked"' : '';?>
                                />
                                <?php esc_html_e('Custom:', 'event_espresso');?>
                            </label>
                            <label for="time_format_custom" class="screen-reader-text"></label>
                            <input type="text"
                                   class="ee-input-width--small"
                                   id="time_format_custom"
                                   name="time_format_custom"
                                   value="<?php echo esc_attr($calendar_config->time->format);?>"
                            />
                            <span class="example"><?php echo date_i18n($calendar_config->time->format);?></span>
                        </li>
                        <li>
                            <p class="description">
                                <a href="https://wordpress.org/documentation/article/customize-date-and-time-format/" target="_blank">
                                    <?php esc_html_e('Documentation on date and time formatting', 'event_espresso'); ?>
                                </a>
                            </p>
                        </li>
                    </ul>

                    <img src="<?php echo esc_url(admin_url('images/wpspin_light.gif')); ?>"
                         alt="loading"
                         class="ajax-loading"
                         height='16px'
                         width='16px'
                    />
                </td>
            </tr>

            <?php
            $days_of_the_week = [
                ['id' => 0, 'text' => __('Sunday', 'event_espresso')],
                ['id' => 1, 'text' => __('Monday', 'event_espresso')],
                ['id' => 2, 'text' => __('Tuesday', 'event_espresso')],
                ['id' => 3, 'text' => __('Wednesday', 'event_espresso')],
                ['id' => 4, 'text' => __('Thursday', 'event_espresso')],
                ['id' => 5, 'text' => __('Friday', 'event_espresso')],
                ['id' => 6, 'text' => __('Saturday', 'event_espresso')],
            ];
            ?>
            <tr>
                <th>
                    <label for="firstDay">
                        <?php esc_html_e('First Day of the Week', 'event_espresso'); ?>
                    </label>
                </th>
                <td>
                    <?php
                    echo EEH_Form_Fields::select_input(
                        'calendar[time][first_day]',
                        $days_of_the_week,
                        $calendar_config->time->first_day,
                        'id="firstDay"'
                    ); ?>
                    <p class="description">
                        <?php esc_html_e('Determines which day will be in the first column of the calendar', 'event_espresso'); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th>
                    <label for="weekends">
                        <?php esc_html_e('Show Weekends', 'event_espresso'); ?>
                    </label>
                </th>
                <td>
                    <?php
                    echo EEH_Form_Fields::select_input(
                        'calendar[time][weekends]',
                        $values,
                        $calendar_config->time->weekends,
                        'id="weekends"'
                    ); ?>
                    <p class="description">
                        <?php esc_html_e(
                            'This setting allows you to remove the weekends from your calendar views. This may be useful if you don\'t have events on weekends.',
                            'event_espresso'
                        ); ?>
                    </p>
                </td>
            </tr>

        </tbody>
    </table>
    <h3>
        <?php esc_html_e('Page Settings', 'event_espresso'); ?>
    </h3>
    <table class="ee-admin-two-column-layout form-table">
        <tbody>
            <?php
            $week_modes = [
                ['id' => 'fixed', 'text' => __('fixed: displays 6 weeks, fixed height', 'event_espresso')],
                ['id' => 'liquid', 'text' => __('liquid: displays 4-6 weeks, fixed height', 'event_espresso')],
                ['id' => 'variable', 'text' => __('variable: displays 4-6 weeks, variable height', 'event_espresso')],
            ];
            ?>
            <tr>
                <th>
                    <label for="weekMode">
                        <?php esc_html_e('Week Mode', 'event_espresso');  // 'fixed', 'liquid', 'variable'?>
                    </label>
                </th>
                <td>
                    <?php
                    echo EEH_Form_Fields::select_input(
                        'calendar[time][week_mode]',
                        $week_modes,
                        $calendar_config->time->week_mode,
                        'id="weekMode"'
                    ); ?>
                    <p class="description">
                        <?php printf(
                            esc_html__(
                                'Determines the number of weeks displayed in a month view. Also determines each week\'s height.%1$s - %2$sfixed%3$s: The calendar will always be 6 weeks tall. The height will always be the same, as determined by the calendar height setting or the aspect ratio.%1$s - %2$sliquid%3$s: The calendar will have either 4, 5, or 6 weeks, depending on the month. The height of the weeks will stretch to fill the available height, as determined by the calendar height setting or the aspect ratio.%1$s - %2$svariable%3$s: The calendar will have either 4, 5, or 6 weeks, depending on the month. Each week will have the same constant height, meaning the calendar\'s height will change month-to-month.',
                                'event_espresso'
                            ),
                            '<br/>',
                            '<strong>',
                            '</strong>'
                        ); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th>
                    <label for="espresso_calendar_height">
                        <?php esc_html_e('Height', 'event_espresso'); ?>
                    </label>
                </th>
                <td>
                    <input type="text"
                           class="ee-input-width--small"
                           id="espresso_calendar_height"
                           name="calendar[display][calendar_height]"
                           value="<?php
                           echo $calendar_config->display->calendar_height; ?>"
                    />
                    <p class="description">
                        <?php esc_html_e(
                            'Will make the entire calendar (including header) a pixel height. Leave blank for an automagical height.',
                            'event_espresso'
                        ); ?>
                    </p>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="enable-calendar-thumbs">
                        <?php esc_html_e('Enable Images in Calendar', 'event_espresso'); ?>
                    </label>
                </th>
                <td>
                    <?php
                    echo EEH_Form_Fields::select_input(
                        'calendar[display][enable_calendar_thumbs]',
                        $values,
                        $calendar_config->display->enable_calendar_thumbs,
                        'id="enable-calendar-thumbs"'
                    ); ?>
                    <p class="description">
                        <?php esc_html_e(
                            'The "Featured Image" box in the event editor handles the thumbnail image URLs for each event. After setting the "Enable Calendar images" option to "Yes" in the calendar settings, upload an event image in the built-in WordPress media uploader, then click the Insert into post button on the media uploader.',
                            'event_espresso'
                        ); ?>
                    </p>
                </td>
            </tr>


            <tr>
                <th>
                    <label for="enable_calendar_filters">
                        <?php esc_html_e('Enable Filters in Calendar', 'event_espresso'); ?>
                    </label>
                </th>
                <td>
                    <?php
                    echo EEH_Form_Fields::select_input(
                        'calendar[display][enable_calendar_filters]',
                        $values,
                        $calendar_config->display->enable_calendar_filters,
                        'id="enable_calendar_filters"'
                    ); ?>
                    <p class="description">
                        <?php esc_html_e('Filters allow users to filter events based on category and/or venue.', 'event_espresso'); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th>
                    <label for="enable_category_legend">
                        <?php esc_html_e('Enable Category Legend', 'event_espresso'); ?>
                    </label>
                </th>
                <td>
                    <?php echo EEH_Form_Fields::select_input(
                        'calendar[display][enable_category_legend]',
                        $values,
                        $calendar_config->display->enable_category_legend,
                        'id="enable_category_legend"'
                    ); ?>
                    <p class="description">
                        <?php esc_html_e('Shows a legend of all the different event categories', 'event_espresso'); ?>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <h3>
        <?php esc_html_e('Theme Settings', 'event_espresso'); ?>
    </h3>

    <table class="ee-admin-two-column-layout form-table">
        <tbody>
            <tr>
                <th>
                    <label for="enable-cat-classes">
                        <?php esc_html_e('Enable CSS for Categories', 'event_espresso'); ?>
                    </label>
                </th>
                <td>
                    <?php echo EEH_Form_Fields::select_input(
                        'calendar[display][enable_cat_classes]',
                        $values,
                        $calendar_config->display->enable_cat_classes,
                        'id="enable-cat-classes"'
                    ); ?>
                    <p class="description">
                        <?php esc_html_e(
                            'This setting allows you to set each category to display a different color. Set each category color in Event Espresso > Categories.',
                            'event_espresso'
                        ); ?>
                    </p>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="espresso_use_pickers">
                        <?php esc_html_e('Use Color Pickers', 'event_espresso'); ?>
                    </label>
                </th>
                <td>
                    <?php
                    echo EEH_Form_Fields::select_input(
                        'calendar[display][use_pickers]',
                        $values,
                        $calendar_config->display->use_pickers
                    ); ?>
                    <p class="description">
                        <?php esc_html_e(
                            'This allows you to customize the event background color and text color.',
                            'event_espresso'
                        ); ?>
                    </p>
                </td>
            </tr>
            <tr class="color-picker-selections requires-color-pickers">
                <th class="color-picker-style">
                    <label for="background-color">
                        <?php esc_html_e('Event Background Color', 'event_espresso') ?>
                    </label>
                </th>
                <td>
                    <input id="background-color"
                           class="color-picker"
                           type="text"
                           name="calendar[display][event_background]"
                           value="<?php echo $calendar_config->display->event_background ?>"
                    />
                </td>
            </tr>
            <tr class="color-picker-selections requires-color-pickers">
                <th class="color-picker-style">
                    <label for="text-color">
                        <?php esc_html_e('Event Text Color', 'event_espresso') ?>
                    </label>
                </th>
                <td>
                    <input id="text-color"
                           class="color-picker"
                           type="text"
                           name="calendar[display][event_text_color]"
                           value="<?php echo $calendar_config->display->event_text_color ?>"
                    />

                </td>
            </tr>


            <tr>
                <th>
                    <label for="show_tooltips">
                        <?php esc_html_e('Show Tooltips', 'event_espresso'); ?>
                    </label>
                </th>
                <td>
                    <?php
                    echo EEH_Form_Fields::select_input(
                        'calendar[tooltip][show]',
                        $values,
                        $calendar_config->tooltip->show,
                        'id="show_tooltips"'
                    ); ?>
                    <p class="description">
                        <?php printf(
                            esc_html__(
                                'This allows you to display a short description of the event on hover. The "display short descriptions" feature set in Event Espresso>Template settings should be switched on when using this feature. Be sure to use the %1$s<!--more-->%2$s tag to separate the short description from the entire event description.',
                                'event_espresso'
                            ),
                            '<code>',
                            '</code>'
                        ); ?>
                    </p>
                </td>
            </tr>
            <?php
            $values_1 = [
                ['id' => 'top', 'text' => __('Top', 'event_espresso')],
                ['id' => 'center', 'text' => __('Center', 'event_espresso')],
                ['id' => 'bottom', 'text' => __('Bottom', 'event_espresso')],
            ];
            $values_2 = [
                ['id' => 'left', 'text' => __('Left', 'event_espresso')],
                ['id' => 'center', 'text' => __('Center', 'event_espresso')],
                ['id' => 'right', 'text' => __('Right', 'event_espresso')],
            ];
            ?>
            <tr class="tooltip-position-selections requires-tooltips">
                <th class="tooltip-positions">
                    <label for="tooltips_pos_my_1">
                        <?php esc_html_e('Tooltip Position', 'event_espresso'); ?>
                    </label>
                </th>
                <td>
                    <div class="ee-layout-row">
                        <?php esc_html_e('Place Tooltip\'s ', 'event_espresso'); ?>
                        <?php
                        echo EEH_Form_Fields::select_input(
                            'calendar[tooltip][pos_my_1]',
                            $values_1,
                            $calendar_config->tooltip->pos_my_1,
                            'id="tooltips_pos_my_1"'
                        ); ?>
                        <?php
                        echo EEH_Form_Fields::select_input(
                            'calendar[tooltip][pos_my_2]',
                            $values_2,
                            $calendar_config->tooltip->pos_my_2,
                            'id="tooltips_pos_my_2"'
                        ); ?>
                    </div>
                    <div class="ee-layout-row">
                        &nbsp;<?php esc_html_e('at the Event\'s ', 'event_espresso'); ?>
                        <?php
                        echo EEH_Form_Fields::select_input(
                            'calendar[tooltip][pos_at_1]',
                            $values_1,
                            $calendar_config->tooltip->pos_at_1,
                            'id="tooltips_pos_at_1"'
                        ); ?>
                        <?php
                        echo EEH_Form_Fields::select_input(
                            'calendar[tooltip][pos_at_2]',
                            $values_2,
                            $calendar_config->tooltip->pos_at_2,
                            'id="tooltips_pos_at_2"'
                        ); ?>
                    </div>
                    <p class="description">
                        <?php esc_html_e('Default: "Bottom Center" and "Center Center"', 'event_espresso'); ?>
                    </p>
                </td>
            </tr>

            <?php
            $tooltip_style = [
                ['id' => 'qtip-plain', 'text' => __('plain', 'event_espresso')],
                ['id' => 'qtip-light', 'text' => __('light', 'event_espresso')],
                ['id' => 'qtip-dark', 'text' => __('dark', 'event_espresso')],
                ['id' => 'qtip-red', 'text' => __('red', 'event_espresso')],
                ['id' => 'qtip-green', 'text' => __('green', 'event_espresso')],
                ['id' => 'qtip-blue', 'text' => __('blue', 'event_espresso')],
                ['id' => 'qtip-bootstrap', 'text' => __('Twitter Bootstrap', 'event_espresso')],
                ['id' => 'qtip-tipsy', 'text' => __('Tipsy', 'event_espresso')],
                ['id' => 'qtip-youtube', 'text' => __('YouTube', 'event_espresso')],
                ['id' => 'qtip-jtools', 'text' => __('jTools', 'event_espresso')],
                ['id' => 'qtip-cluetip', 'text' => __('clueTip', 'event_espresso')],
                ['id' => 'qtip-tipped', 'text' => __('Tipped', 'event_espresso')],
            ];
            ?>

            <tr class="tooltip_style-selections requires-tooltips">
                <th class="tooltip_style">
                    <label for="tooltip_style">
                        <?php esc_html_e('Tooltip Style', 'event_espresso'); ?>
                    </label>
                </th>
                <td>
                    <?php
                    echo EEH_Form_Fields::select_input(
                        'calendar[tooltip][style]',
                        $tooltip_style,
                        $calendar_config->tooltip->style,
                        'id="tooltip_style"'
                    ); ?>
                    <p class="description">
                        <?php esc_html_e('Adds styling to tooltips. Default: light', 'event_espresso'); ?>
                    </p>
                </td>
            </tr>

        </tbody>
    </table>
</div>
<input type='hidden' name="return_action" value="<?php echo $return_action ?>" />
<!-- / .padding -->
