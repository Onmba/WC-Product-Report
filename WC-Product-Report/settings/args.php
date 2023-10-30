<?php
	$args = array(
		'limit' => 9999,
		'return' => 'ids',
		'status' => 'wc-completed',
		'date_query' => array(
			array( 
				'before' => $end_date, 
				'after' => $start_date,
				'compare' => '=',
			),
		),
	);
	$query = new WC_Order_Query( $args );
	$order_ids = $query->get_orders();