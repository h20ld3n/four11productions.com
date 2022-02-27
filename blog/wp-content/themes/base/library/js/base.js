// Clear Search form
function clearInput(field_id, term_to_clear) {
	if (document.getElementById(field_id).value == term_to_clear ) {
		document.getElementById(field_id).value = '';
	}
	else if (document.getElementById(field_id).value == '' ) {
		document.getElementById(field_id).value = term_to_clear;
	}
}