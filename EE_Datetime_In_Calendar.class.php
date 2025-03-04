<?php

/**
 * Event Espresso
 *
 * Event Registration and Management Plugin for WordPress
 *
 * @ package            Event Espresso
 * @ author         Seth Shoultes
 * @ copyright      (c) 2008-2011 Event Espresso  All Rights Reserved.
 * @ license            https://eventespresso.com/support/terms-conditions/   * see Plugin Licensing *
 * @ link               https://www.eventespresso.com
 * @ version            4.0
 *
 * ------------------------------------------------------------------------
 *
 * EE_Datetime_In_Calendar
 * Class for containing info about how to display an event  datetime in the calendar
 *
 * @package     Event Espresso
 * @subpackage  /EE4-calendar/
 * @author      Michael Nelson
 *
 * ------------------------------------------------------------------------
 */
class EE_Datetime_In_Calendar
{
    /**
     * @var EE_Event $_Event
     */
    protected $_event;
    protected $_datetime;
    protected $_color = '';
    protected $_textColor = '';
    protected $_classname = '';
    protected $_event_time = '';
    protected $_event_time_no_tags = '';
    protected $_event_img_thumb = '';
    protected $_eventType = '';
    protected $_description;
    protected $_tooltip;
    protected $_tooltip_my;
    protected $_tooltip_at;
    protected $_tooltip_style;
    protected $_show_tooltips;
    protected $_iframe = false;



    public function __construct(EE_Datetime $datetime)
    {
        $this->_datetime = $datetime;
        $this->_event = $datetime->event();
    }

    public function get($variable_name)
    {
        return $this->$variable_name;
    }

    public function set($variable_name, $value)
    {
        return $this->$variable_name = $value;
    }

    /**
     * Gets color
     * @return string
     */
    public function color()
    {
        return $this->get('_color');
    }

    /**
     * Sets color
     * @param string $color
     * @return boolean
     */
    public function set_color($color)
    {
        return $this->set('_color', $color);
    }

    /**
     * Gets textColor
     * @return string
     */
    public function textColor()
    {
        return $this->get('_textColor');
    }

    /**
     * Sets textColor
     * @param string $textColor
     * @return boolean
     */
    public function set_textColor($textColor)
    {
        return $this->set('_textColor', $textColor);
    }

    /**
     * Gets datetime
     * @return EE_Datetime
     */
    public function datetime()
    {
        return $this->get('_datetime');
    }

    /**
     * Sets datetime
     * @param EE_Datetime $datetime
     * @return boolean
     */
    public function set_datetime($datetime)
    {
        return $this->set('_datetime', $datetime);
    }

    /**
     * Gets event
     * @return EE_Event
     */
    public function event()
    {
        return $this->get('_event');
    }

    /**
     * Sets event
     * @param EE_Event $event
     * @return boolean
     */
    public function set_event($event)
    {
        return $this->set('_event', $event);
    }
    /**
     * Gets classname
     * @return string
     */
    public function classname()
    {
        return $this->get('_classname');
    }

    /**
     * Sets classname
     * @param string $classname
     * @return boolean
     */
    public function set_classname($classname)
    {
        return $this->set('_classname', $classname);
    }
    /**
     * Just adds $classname to the existing classname attribute
     * @param string $classname
     * @return string
     */
    public function add_classname($classname)
    {
        return $this->set('_classname', $this->get('_classname') . ' ' . $classname);
    }
    /**
     * Gets event_time html
     * @return string
     */
    public function event_time()
    {
        return $this->get('_event_time');
    }

    /**
     * Sets event_time html
     * @param string $event_time
     * @return boolean
     */
    public function set_event_time($event_time)
    {
        $this->set('_event_time_no_tags', strip_tags($event_time));
        return $this->set('_event_time', $event_time);
    }
    /**
     * Gets event_time_no_tags
     * @return string
     */
    public function event_time_no_tags()
    {
        return $this->get('_event_time_no_tags');
    }

    /**
     * Gets event_img_thumb HTML
     * @return string
     */
    public function event_img_thumb()
    {
        return $this->get('_event_img_thumb');
    }

    /**
     * Sets event_img_thumb HTML
     * @param string $event_img_thumb
     * @return boolean
     */
    public function set_event_img_thumb($event_img_thumb)
    {
        return $this->set('_event_img_thumb', $event_img_thumb);
    }
    /**
     * Gets eventType
     * @return string
     */
    public function eventType()
    {
        return $this->get('_eventType');
    }

    /**
     * Sets eventType
     * @param string $eventType
     * @return boolean
     */
    public function set_eventType($eventType)
    {
        return $this->set('_eventType', $eventType);
    }

    /**
     * Gets description
     * @return string
     */
    public function description()
    {
        return $this->get('_description');
    }

    /**
     * Sets description
     * @param string $description
     * @return boolean
     */
    public function set_description($description)
    {
        return $this->set('_description', $description);
    }
    /**
     * Gets tooltip
     * @return string
     */
    public function tooltip()
    {
        return $this->get('_tooltip');
    }

    /**
     * Sets tooltip
     * @param string $tooltip
     * @return boolean
     */
    public function set_tooltip($tooltip)
    {
        return $this->set('_tooltip', $tooltip);
    }
    /**
     * Gets tooltip_my
     * @return string
     */
    public function tooltip_my()
    {
        return $this->get('_tooltip_my');
    }

    /**
     * Sets tooltip_my
     * @param string $tooltip_my
     * @return boolean
     */
    public function set_tooltip_my($tooltip_my)
    {
        return $this->set('_tooltip_my', $tooltip_my);
    }
    /**
     * Gets tooltip_at
     * @return string
     */
    public function tooltip_at()
    {
        return $this->get('_tooltip_at');
    }

    /**
     * Sets tooltip_at
     * @param string $tooltip_at
     * @return boolean
     */
    public function set_tooltip_at($tooltip_at)
    {
        return $this->set('_tooltip_at', $tooltip_at);
    }
    /**
     * Gets tooltip_style
     * @return string
     */
    public function tooltip_style()
    {
        return $this->get('_tooltip_style');
    }

    /**
     * Sets tooltip_style
     * @param string $tooltip_style
     * @return boolean
     */
    public function set_tooltip_style($tooltip_style)
    {
        return $this->set('_tooltip_style', $tooltip_style);
    }
    /**
     * Gets show_tooltips
     * @return boolean
     */
    public function show_tooltips()
    {
        return $this->get('_show_tooltips');
    }

    /**
     * Sets show_tooltips
     * @param boolean $show_tooltips
     * @return boolean
     */
    public function set_show_tooltips($show_tooltips)
    {
        return $this->set('_show_tooltips', $show_tooltips);
    }



    /**
     * @param boolean $iframe
     */
    public function set_iframe($iframe)
    {
        $this->_iframe = filter_var($iframe, FILTER_VALIDATE_BOOLEAN);
    }




    /**
     * @return array which can be used for converting to json
     * @throws \EE_Error
     */
    public function to_array_for_json()
    {
        $title = $this->_datetime->name() !== ''
            ? $this->_event->name() . ': ' . $this->_datetime->name()
            : $this->_event->name();
        return array(
            'allDay' => false,
            'className' => $this->classname(),
            'color' => $this->color(),
            'end' => $this->_datetime->end_date('c'),
            'event_days' => $this->_datetime->length('days', true),
            'event_time' => $this->event_time(),
            'event_time_no_tags' => $this->event_time_no_tags(),
            'event_img_thumb' => $this->event_img_thumb(),
            'eventType' => $this->eventType(),
            'description' => apply_filters(
                'FHEE__EE_Datetime_In_Calendar__to_array_for_json__description',
                $this->description(),
                $this
            ),
            'id' => $this->_event->ID(),
            'show_tooltips' => $this->show_tooltips(),
            'start' => $this->_datetime->start_date('c'),
            'target_date' => $this->_datetime->start_date('Y-m-d'),
            'textColor' => $this->textColor(),
            'tooltip' => $this->tooltip(),
            'tooltip_my' => $this->tooltip_my(),
            'tooltip_at' => $this->tooltip_at(),
            'tooltip_style' => $this->tooltip_style(),
            'title' => apply_filters(
                'FHEE__EE_Datetime_In_Calendar__to_array_for_json__title',
                $title,
                $this
            ),
            'url' => apply_filters(
                'FHEE__EE_Datetime_In_Calendar__to_array_for_json__url',
                add_query_arg(
                    [ 'datetime' => $this->_datetime->ID() ],
                    $this->_event->get_permalink()
                ),
                $this->event(),
                $this
            ),
            'iframe' => $this->_iframe,
        );
    }
}
// End of file EE_Datetime_In_Calendar.class.php
// Location: /inc/EE_Datetime_In_Calendar.class.php
