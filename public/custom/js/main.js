jQuery(document).ready(function(){
	only_number();
	initialize_selectize();
	initialize_datepicker();
});

/**
 * ====== Initialize Only Number ======
 */
function only_number(){
    // client-side validation of numeric inputs, optionally replacing separator sign(s).
	$("input.only_number").on("keydown", function (e) {
		// allow function keys and decimal separators
		if (
			// backspace, delete, tab, escape, enter, comma and .
			$.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
			// Ctrl/cmd+A, Ctrl/cmd+C, Ctrl/cmd+X
			($.inArray(e.keyCode, [65, 67, 88]) !== -1 && (e.ctrlKey === true || e.metaKey === true)) ||
			// home, end, left, right
			(e.keyCode >= 35 && e.keyCode <= 39)) {

			/*
			// optional: replace commas with dots in real-time (for en-US locals)
			if (e.keyCode === 188) {
				e.preventDefault();
				$(this).val($(this).val() + ".");
			}

			// optional: replace decimal points (num pad) and dots with commas in real-time (for EU locals)
			if (e.keyCode === 110 || e.keyCode === 190) {
				e.preventDefault();
				$(this).val($(this).val() + ",");
			}
			*/

			return;
		}
		// block any non-number
		if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			e.preventDefault();
		}
	});
}


/**
 * ====== Initialize Selectize ======
 */
function initialize_selectize() {
    $('.selectize').selectize();
}

/**
 * ====== Initialize Datepicker ======
 */
function initialize_datepicker() {
    if ($(".select_dates").length > 0) {
        $(".select_dates").daterangepicker({
            // minDate: '-3w',
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
        });
    }
}