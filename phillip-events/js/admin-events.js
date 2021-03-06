$(document).ready(function() {
	$(function() {
		$('#datetimepicker6').datetimepicker({
			format: 'DD-MM-YYYY h:mm a'
		});
		$('#datetimepicker7').datetimepicker({
			format: 'DD-MM-YYYY h:mm a',
			useCurrent: false //Important! See issue #1075
		});
		$('#datetimepicker6').on('dp.change', function(e) {
			$('#datetimepicker7')
				.data('DateTimePicker')
				.minDate(e.date);
		});
		$('#datetimepicker7').on('dp.change', function(e) {
			$('#datetimepicker6')
				.data('DateTimePicker')
				.maxDate(e.date);
		});
	});
});

// $(function() {
// 	// $('#datetimepicker6').datetimepicker({
// 	// 	format: 'DD-MM-YYYY h:mm a'
// 	// });
// 	// $('#datetimepicker7').datetimepicker({
// 	// 	format: 'DD-MM-YYYY h:mm a'
// 	// });

// 	$('#datetimepicker6').datetimepicker();
// 	$('#datetimepicker7').datetimepicker({
// 		useCurrent: false //Important! See issue #1075
// 	});
// 	$('#datetimepicker6').on('dp.change', function(e) {
// 		$('#datetimepicker7')
// 			.data('DateTimePicker')
// 			.minDate(e.date);
// 	});
// 	$('#datetimepicker7').on('dp.change', function(e) {
// 		$('#datetimepicker6')
// 			.data('DateTimePicker')
// 			.maxDate(e.date);
// 	});
// });
