<section>
	<div class="calendar_content_wrapper">
		<?php
		$base_date = new DateTime();
		$base_date->modify('first day of this month');  // Start from current month
		$base_month = $base_date->format("Y-m");
		$calendarObject = get_calendar_object($base_month, 0);
		$month_list      = $calendarObject['date_list'];
		$days_list      = $calendarObject['days_list'];
		$captions       = $calendarObject['month_captions'];

		foreach ($month_list as $month_key => $month_item) {
			if ($month_key > 1) break;  // Limit to 2 months

			// Mapping Schedule Array
			$start_date = clone $base_date;
			$start_date->modify($month_key . " months");  // Add month_key months

			$end_date = clone $start_date;
			$end_date->modify('last day of this month');

			$start_date_formatted = $start_date->format("Y-m-01");
			$end_date_formatted   = $end_date->format("Y-m-d");

			$args = array(
				'post_type'      => array('schedule'),
				'posts_per_page' => -1,
				'meta_query'     => array(
					array(
						'key'     => 'p_schedule_conditional_use_daytime',
						'value'   => array($start_date_formatted, $end_date_formatted),
						'compare' => 'BETWEEN',
						'type'    => 'DATE',
					),
				),
			);

			$the_query = new WP_Query($args);
// 			if ($month_key == 1) { var_export($the_query); }
			$schedule_array = [];
			while ($the_query->have_posts()) {
				$the_query->the_post();
				$post       = get_post();
				$work_date  = get_field('p_schedule_conditional_use_daytime');
				$is_workday = get_field('is_workday');
				$is_holiday = get_field('is_holiday');

				$doctor_1 = get_field('p_schedule_workers_01') ? '〇〇医師' : null;

				$schedule_array[] = array(
					'work_date'  => $work_date,
					'is_holiday' => $is_holiday,
					'weekday'    => date("w", strtotime($work_date)),
					'doctor_1'   => $doctor_1,
				);
			}
			usort($schedule_array, function ($a, $b) {
				return strtotime($a['work_date']) - strtotime($b['work_date']);
			});
			// Restore original Post Data
			wp_reset_query();
			// Include the calendar part
			require(dirname(__FILE__) . "/ly-calendar/calendar-part.php");
		}
		?>
	</div>
</section>