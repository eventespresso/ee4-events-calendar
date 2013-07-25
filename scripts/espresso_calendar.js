jQuery(document).ready(function($) {

	var ee_total_images = 0;
	
	if ( eeCAL.weekends == undefined || eeCAL.weekends == '' ) {
		eeCAL.weekends = false;
	}


	$('#espresso_calendar').fullCalendar({
		
		// General Display - http://arshaw.com/fullcalendar/docs/display/
		// Defines the buttons and title at the top of the calendar.
		header: {
			left: eeCAL.header_left,
			center: eeCAL.header_center,
			right: eeCAL.header_right,
		},
		// Enables/disables use of jQuery UI theming.
		//theme: eeCAL.theme,
		// The day that each week begins.
		firstDay: eeCAL.firstDay,
		// Whether to include Saturday/Sunday columns in any of the calendar views.
		weekends: eeCAL.weekends,
		// Will make the entire calendar (including header) a pixel height.
		height: eeCAL.espresso_calendar_height,
		// Triggered when the calendar loads and every time a different date-range is displayed.
		viewDisplay: function(view) {
	        $('.qtip-close .ui-icon').each( function() {
		 		$(this).removeClass('ui-icon');
		 		$(this).removeClass('ui-icon-close');
		 	});
	    },
	 
		// Views - http://arshaw.com/fullcalendar/docs/views/
		// The initial view when the calendar loads.
		defaultView: eeCAL.cal_view,
		
		//Text/Time Customization - http://arshaw.com/fullcalendar/docs/text/
		// Determines the text that will be displayed in the header's title.
		timeFormat:{ 
			agenda: 'h:mm a{ - h:mm a}',
			'' : ''
		},
		// Determines the text that will be displayed on the calendar's column headings.
		columnFormat: {
			month: eeCAL.columnFormat_month,
			week: eeCAL.columnFormat_week,
			day: eeCAL.columnFormat_day,
		},
		// Determines the text that will be displayed in the header's title.
		titleFormat: {
			month: eeCAL.titleFormat_month,
			week: eeCAL.titleFormat_week,
			day: eeCAL.titleFormat_day,
		},
		// Text that will be displayed on buttons of the header.
		buttonText: {
			next: eeCAL.buttonText_next, 	// default '&lsaquo;' <
			prev: eeCAL.buttonText_prev, 	// default '&rsaquo;'  >
			prevYear: eeCAL.buttonText_prevYear, 	// default '&laquo;'  <<
			nextYear:eeCAL.buttonText_nextYear, 	// default '&raquo;'  >>
			today: eeCAL.buttonText_today, 	// default 'today'
			month: eeCAL.buttonText_month, 	// default 'month'
			week: eeCAL.buttonText_week, 	// default 'week'
			day: eeCAL.buttonText_day, 	// default 'day'
		},

		// Sets the background and border colors for all events on the calendar.
		eventColor: eeCAL.ee_event_background,
		// Sets the text color for all events on the calendar.
		eventTextColor: eeCAL.ee_event_text_color,


		//Full names of months.
		monthNames: eeCAL.monthNames,
		//Abbreviated names of months.
		monthNamesShort: eeCAL.monthNamesShort,
		//Full names of days-of-week.
		dayNames: eeCAL.dayNames,
		//Abbreviated names of days-of-week.
		dayNamesShort: eeCAL.dayNamesShort,
				
		eventRender: function( event, element ) {

			if( event.event_img_thumb ){
				element.find('.fc-event-title').after( event.event_img_thumb );
			}
			
			if( event.event_time ){
				element.find('.fc-event-title').after( event.event_time );
			}

			if ( event.display_reg_form == 'Y') {
				event.regButtonText = event.register_now;
			} else {
				event.regButtonText = event.view_details;
			}

			if ( eeCAL.show_tooltips ) {						
				element.qtip({
					content: {
						text: event.description + event.tooltip,
						title: event.title,
						button: 'close'
					},
					position: {
						// Position my top left...
						my: event.tooltip_my, 
						// at the bottom right of...
						at: event.tooltip_at,
					},
					show: {
						event: 'click mouseenter',
						solo: true
					},
					hide: "unfocus",
					style: {
						classes: event.tooltip_style, 
					},
					widget: true
				});
				
			} else {
				//This displays the title of the event when hovering
				element.attr( 'title', event.title + " - Event Times: " + event.event_time_no_tags );				
			}

		},

		//Load the events into json srrsy
		events: function(start, end, callback) {
			$.ajax({
				url: eeCAL.ajax_url,
				dataType: 'json',
				data: {
					action: 'get_calendar_events',
					noheader : 'true',
					start_date: Math.round(start.getTime() / 1000),
					end_date: Math.round(end.getTime() / 1000)
				},
				success: function( response ) {
//					console.log( 'success' );
//					console.log( JSON.stringify( response, null, 4 ));
					callback( response );
				},
				error: function(response) {
//					console.log( 'error' );
//					console.log( JSON.stringify( response, null, 4 ));
					//callback(response);
				},
			});
		},
		

		loading: function(bool) {
			if (bool) $('#ee-calendar-ajax-loader-img').show();
			else $('#ee-calendar-ajax-loader-img').hide();
		}
								
	});

    $('.qtip-close .ui-icon').each( function() {
 		$(this).removeClass('ui-icon');
 		$(this).removeClass('ui-icon-close');
 	});	
//	if ( eeCAL.theme ) {
//		$('a.fc-event').addClass('themeroller ui-state-focus');
//		$('a.fc-event div').removeClass('fc-event-skin');
//		$('.fc-view').addClass('ui-widget-content');
//		$('.expired').removeClass('ui-state-focus').addClass('ui-state-default');
//	}


});