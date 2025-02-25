<?php
/**
 * @var $calendar_config EE_Calendar_Config
 * @var $return_action   string
 * @var $values          array
 */

?>
<div class="padding">
    <h3>
        <?php
        esc_html_e('Formatting', 'event_espresso'); ?>
    </h3>

    <table class="ee-admin-two-column-layout form-table">
        <tbody>

            <tr>
                <th>
                    <label>
                        <?php
                        esc_html_e('Header Style Left', 'event_espresso'); ?>
                    </label>
                </th>
                <td>
                    <label for="espresso_calendar_header_left"><?php
                        esc_html_e('Left', 'event_espresso'); ?>:
                    </label>
                    <input type="text"
                           name="calendar[header][left]"
                           id="espresso_calendar_header_left"
                           class="ee-input-width--reg"
                           value="<?php
                           echo htmlentities($calendar_config->header->left) ?>"
                    >
                    <label for="espresso_calendar_header_center"><?php
                        esc_html_e('Center', 'event_espresso'); ?>:
                    </label>
                    <input type="text"
                           name="calendar[header][center]"
                           id="espresso_calendar_header_center"
                           class="ee-input-width--reg"
                           value="<?php
                           echo htmlentities($calendar_config->header->center) ?>"
                    >
                    <label for="espresso_calendar_header_right"><?php
                        esc_html_e('Right', 'event_espresso'); ?>:
                    </label>
                    <input type="text"
                           class="ee-input-width--reg"
                           name="calendar[header][right]"
                           id="espresso_calendar_header_right"
                           value="<?php
                           echo htmlentities($calendar_config->header->right) ?>"
                    >
                    <p class="description">
                        <?php
                        esc_html_e('Defines the buttons and title at the top of the calendar.', 'event_espresso'); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th>
                    <label>
                        <?php
                        esc_html_e('Button Text', 'event_espresso'); ?>
                    </label>
                </th>
                <td>

                    <label for="buttonText_prev"><?php
                        esc_html_e('Previous', 'event_espresso'); ?>:
                    </label>
                    <input type="text"
                           class="ee-input-width--reg"
                           name="calendar[button_text][prev]"
                           id="buttonText_prev"
                           value="<?php
                           echo htmlentities($calendar_config->button_text->prev) ?>"
                    >
                    <label for="buttonText_next"><?php
                        esc_html_e('Next', 'event_espresso'); ?>:
                    </label>
                    <input type="text"
                           class="ee-input-width--reg"
                           name="calendar[button_text][next]"
                           id="buttonText_next"
                           value="<?php
                           echo htmlentities($calendar_config->button_text->next) ?>"
                    >
                    <label for="buttonText_prevYear"><?php
                        esc_html_e('Previous Year', 'event_espresso'); ?>:
                    </label>
                    <input type="text"
                           class="ee-input-width--reg"
                           name="calendar[button_text][prev_year]"
                           id="buttonText_prevYear"
                           value="<?php
                           echo htmlentities($calendar_config->button_text->prev_year) ?>"
                    >
                    <label for="buttonText_nextYear"><?php
                        esc_html_e('Next Year', 'event_espresso'); ?>:
                    </label>
                    <input type="text"
                           class="ee-input-width--reg"
                           name="calendar[button_text][next_year]"
                           id="buttonText_nextYear"
                           value="<?php
                           echo htmlentities($calendar_config->button_text->next_year) ?>"
                    >
                    <label for="buttonText_today"><?php
                        esc_html_e('Today', 'event_espresso'); ?>:
                    </label>
                    <input type="text"
                           class="ee-input-width--reg"
                           name="calendar[button_text][today]"
                           id="buttonText_today"
                           value="<?php
                           echo htmlentities($calendar_config->button_text->today) ?>"
                    >
                    <label for="buttonText_month"><?php
                        esc_html_e('Month', 'event_espresso'); ?>:
                    </label>
                    <input type="text"
                           class="ee-input-width--reg"
                           name="calendar[button_text][month]"
                           id="buttonText_month"
                           value="<?php
                           echo htmlentities($calendar_config->button_text->month) ?>"
                    >
                    <label for="buttonText_week"><?php
                        esc_html_e('Week', 'event_espresso'); ?>:
                    </label>
                    <input type="text"
                           class="ee-input-width--reg"
                           name="calendar[button_text][week]"
                           id="buttonText_week"
                           value="<?php
                           echo htmlentities($calendar_config->button_text->week) ?>"
                    >
                    <label for="buttonText_day"><?php
                        esc_html_e('Day', 'event_espresso'); ?>:
                    </label>
                    <input type="text"
                           class="ee-input-width--reg"
                           name="calendar[button_text][day]"
                           id="buttonText_day"
                           value="<?php
                           echo htmlentities($calendar_config->button_text->day) ?>"
                    >
                    <p class="description">
                        <?php
                        esc_html_e('Text that will be displayed on the buttons in the header.', 'event_espresso'); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th>
                    <label>
                        <?php
                        esc_html_e('Title Format', 'event_espresso'); ?>
                    </label>
                </th>
                <td>
                    <label for="titleFormat_month"><?php
                        esc_html_e('Month', 'event_espresso'); ?>:
                    </label>
                    <input type="text"
                           class="ee-input-width--reg"
                           name="calendar[title_format][month]"
                           id="titleFormat_month"
                           value="<?php
                           echo htmlentities($calendar_config->title_format->month) ?>"
                    >
                    <label for="titleFormat_week"><?php
                        esc_html_e('Week', 'event_espresso'); ?>:
                    </label>
                    <input type="text"
                           class="ee-input-width--reg"
                           name="calendar[title_format][week]"
                           id="titleFormat_week"
                           value="<?php
                           echo htmlentities($calendar_config->title_format->week) ?>"
                    >
                    <label for="titleFormat_day"><?php
                        esc_html_e('Day', 'event_espresso'); ?>:
                    </label>
                    <input type="text"
                           class="ee-input-width--reg"
                           name="calendar[title_format][day]"
                           id="titleFormat_day"
                           value="<?php
                           echo htmlentities($calendar_config->title_format->day) ?>"
                    >
                    <p class="description">
                        <?php
                        esc_html_e(
                            'Determines the text that will be displayed in the header\'s title.',
                            'event_espresso'
                        ); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th>
                    <label>
                        <?php
                        esc_html_e('Column Format', 'event_espresso'); ?>
                    </label>
                </th>
                <td>
                    <label for="columnFormat_month"><?php
                        esc_html_e('Month', 'event_espresso'); ?>:
                    </label>
                    <input type="text"
                           class="ee-input-width--reg"
                           name="calendar[column_format][month]"
                           id="columnFormat_month"
                           value="<?php
                           echo htmlentities($calendar_config->column_format->month) ?>"
                    >
                    <label for="columnFormat_week"><?php
                        esc_html_e('Week', 'event_espresso'); ?>:
                    </label>
                    <input type="text"
                           class="ee-input-width--reg"
                           name="calendar[column_format][week]"
                           id="columnFormat_week"
                           value="<?php
                           echo htmlentities($calendar_config->column_format->week) ?>"
                    >
                    <label for="columnFormat_day"><?php
                        esc_html_e('Day', 'event_espresso'); ?>:
                    </label>
                    <input type="text"
                           class="ee-input-width--reg"
                           name="calendar[column_format][day]"
                           id="columnFormat_day"
                           value="<?php
                           echo htmlentities($calendar_config->column_format->day) ?>"
                    >
                    <p class="description">
                        <?php
                        esc_html_e(
                            'Determines the text that will be displayed on the calendar\'s column headings.',
                            'event_espresso'
                        ); ?>
                    </p>
                </td>
            </tr>

        </tbody>
    </table>
    <h3>
        <?php
        esc_html_e('Memory Management', 'event_espresso'); ?>
    </h3>

    <table class="ee-admin-two-column-layout form-table">
        <tbody>

            <tr>
                <th>
                    <label for="show_attendee_limit">
                        <?php
                        esc_html_e('Display Attendee Limits', 'event_espresso'); ?>
                    </label>
                </th>
                <td>
                    <?php
                    echo EEH_Form_Fields::select_input(
                        'calendar[display][show_attendee_limit]',
                        $values,
                        $calendar_config->display->show_attendee_limit,
                        'id="show_attendee_limit"'
                    ); ?>
                    <p class="description">
                        <?php
                        esc_html_e(
                            'Enabling this setting increases the amount of database queries and may break the calendar on some servers.',
                            'event_espresso'
                        ); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th>
                    <label for="disable_categories">
                        <?php
                        esc_html_e('Disable Categories?', 'event_espresso'); ?>
                    </label>
                </th>
                <td>
                    <?php
                    echo EEH_Form_Fields::select_input(
                        'calendar[display][disable_categories]',
                        $values,
                        $calendar_config->display->disable_categories,
                        'id="disable_categories"'
                    ); ?><br/>
                    <p class="description">
                        <?php
                        esc_html_e(
                            'Disabling categories in the calendar may potentially speed up the calendar and allow you to load more events, but you will not be able to use the category colors and css class options.',
                            'event_espresso'
                        ); ?>
                    </p>
                </td>
            </tr>
            <tr>
                <th><?php
                    esc_html_e("Reset Calendar Settings?", 'event_espresso'); ?></th>
                <td>
                    <?php
                    echo EEH_Form_Fields::select_input(
                        'reset',
                        [true => __("Yes", 'event_espresso'), false => __("No", 'event_espresso')],
                        0
                    ); ?><br/>
                    <p class="description">
                        <?php
                        esc_html_e(
                            'Set to \'Yes\' and then click \'Save\' to confirm reset all basic and advanced Event Espresso calendar settings to their plugin defaults.',
                            'event_espresso'
                        ); ?>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<input type='hidden' name="return_action" value="<?php
echo $return_action ?>"
/>
<!-- / .padding -->