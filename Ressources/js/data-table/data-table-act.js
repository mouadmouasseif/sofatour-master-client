(function ($) {
 "use strict";
	
	$(document).ready(function() {
		 $('#data-table-basic').DataTable({
			language: {
				url: "data-tables/fr.json"
			},
			responsive: {
				details: {
					type: 'column'
				}
			},
			paging: true,
			searching: true,
			ordering: true,
			info: true,
			responsive: true,
			dom: 'Bfrtip', // 'B' stands for buttons
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			]
		 });
	});
 
})(jQuery); 