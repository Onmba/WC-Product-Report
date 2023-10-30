// Start datepicker
    jQuery(document).ready(function($) {
    	// Start the date picker
       $(".datepicker").datepicker({});
       // The from and ajax call
	   $('#wooForm').on('submit', function(e){
	    	e.preventDefault();
			//admin_url = jQuery("form#wooForm").attr("data-url");
			var base_url = window.location.origin;
			var admin_url = base_url + '/wp-admin/admin-ajax.php';
			console.log(admin_url);
				$.ajax({
					url: admin_url,
					type: 'post',
					data: { 
						action: 'sausage_action',
						start_date: $('#start_date').val(),
						end_date: $('#end_date').val(),
				    },
					success: function($print_sausage){
						$('#wooresults').html($print_sausage);
						console.log("success");
					}
				});
	 	});
	   $(document).on('click', '.csv_download_wrapper button', function(){
			$.ajax({
				type: 'post',
				url: 'http://localhost/tomnelsoncomedy/wp-admin/admin-ajax.php',
				data:{
					action: 'csvGOGO',
				},
				success:function($csvGOGO) {
					console.log("booYA");
					$('#wooCSV').html($csvGOGO);
				}
			});
		});
    });
