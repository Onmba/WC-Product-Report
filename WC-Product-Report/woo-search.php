<?php
	// All the ajax includes and function for the form postings
		add_action( 'wp_ajax_sausage_action', 'sausage_action' );
		add_action( 'wp_ajax_nopriv_sausage_action', 'sausage_action' );		
		add_action( 'wp_ajax_csvGOGO', 'csvGOGO' );
		add_action( 'wp_ajax_nopriv_csvGOGO', 'csvGOGO' );

// This is my nice file for my search functions
	function sausage_action() {
		$start_date = esc_attr( $_POST['start_date']);
		$end_date = esc_attr( $_POST['end_date']);
		// Check the dates enter with date picker server side
		if ((strtotime($_POST['start_date'])) > (strtotime($_POST['end_date'])))
			{
			    ?>
			    	<div class="error">
			    			<p>It appears your start and end dates are incorrect. Please try again.</p>
			    	</div>
			    <?php
			}
			else
			{
				include plugin_dir_path( __FILE__ ) . '/settings/args.php';
						?>
						<table>
							<thead>
								<th>Product</th>
								<th>Amount Sold</th>
								<th>Total</th>
							</thead>
							<tbody>
							<?php
							
							$prodItems = [];
							$prodsCount = 0;
							foreach( $order_ids as $order_id ){
								// get an instance of the WC_Order object
								$order = new WC_Order( $order_id );
								// The loop to get the order items 
								foreach( $order->get_items() as $item_id => $item_product ){
									//Get the WC_Product object and declasre everything
									$item_product->get_product_id();
									$item_product->get_product();
									$prod_id = $item_product->get_product_id();
									$product_name = $item_product->get_name();
									$quantity = $item_product->get_quantity();
									$total = $item_product->get_total();

									?>
						
									<tr class="prod_<?php echo $prod_id; ?>">
										<td class="prod_name"><?php echo $product_name; ?></td>
										<td class="prod_qty"><?php echo $quantity; ?></td>
										<td class="prod_total"><?php echo $total; ?></td>
									</tr>

									<?php
								}
								$prodsCount++;
							}
							if ($prodsCount==0){
								?>
								<style type="text/css">
									#wooresults table {
										display: none;
									}
								</style>
								<div class="error">
									<p>Oops, there are no results within this range.</p>
									<p>Please enter another set of dates.</p>
								</div>
								<?php
							}
							else {
									?>
									<style type="text/css">
										#wooresults table {
											display: table;
										}
									</style>
								<?php
							}

						?>
						</tbody>
					</table>
<!-- 					<div class="csv_download_wrapper">
						<button class="csv_download">Download as CSV</button>
					</div> -->
				<?php
			}
		wp_die();
	}
// // CSV Function
// 	function csvGOGO() {
// 		$start_date = esc_attr( $_POST['start_date']);
// 		$end_date = esc_attr( $_POST['end_date']);
// 		echo "load into div";
// 		$argsCSV = array(
// 		'limit' => 9999,
// 		'return' => 'ids',
// 		'status' => 'wc-completed',
// 		'date_query' => array(
// 			array( 
// 				'before' => $end_date, 
// 				'after' => $start_date,
// 				'compare' => '=',
// 			),
// 		),
// 	);
// 	$queryCSV = new WC_Order_Query( $argsCSV );
// 	$order_idsCSV = $queryCSV->get_orders();

// 		foreach( $order_idsCSV as $order_idCSV ){
// 			// get an instance of the WC_Order object
// 			$orderCSV = new WC_Order( $order_idCSV );
// 			// Load all the order items into array and name them
// 			$prodItemsCSV = [];
// 			foreach( $orderCSV->get_items() as $item_idCSV => $item_productCSV ){
// 				$prodItemsCSV[] = array(
// 					//'prod_id' => $item_productCSV->get_product_id(),
// 					'prod_name' => $item_productCSV->get_name(),
// 					'prod_qty' => $item_productCSV->get_quantity(),
// 					'prod_total' => $item_productCSV->get_total(),
// 				);
// 			}
// 		}
// 		print_r($prodItemsCSV);
// 		header('Content-Type: text/csv; charset=UTF-8');
// 		header('Content-Disposition: attachment; filename=sample.csv');
// 		header('Pragma: no-cache');
// 		header('Expires: 0');
// 		$fp = fopen('php://output', 'w');
// 		//ex: $list={...};


// 		foreach ($prodItemsCSV as $fields)
// 		{
// 		fputcsv($fp,implode($fields, ','));
// 		}
// 		fclose($fp);
// 		exit();
// 	}