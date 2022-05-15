/*
	If document is ready,
	then...
*/
$(document).ready(function () {
	/* Go to selected message */
	$('.mail-element').click(function() {
		if (this.getAttribute('value') != null)
			window.location.href = "mail?id=" + this.getAttribute('value') + "#mail";
	});
	
	/*
		Function, which takes count of chars
		from message textarea
	*/
	$('textarea[name="contents"]').keyup(function() {
		// length
		let count = $(this).val().length;
		// string
		let string = $(this).val();
		
		/*
			If length is longer than possible
			you must cut off longer part.
		*/
		if (count > 500) {
			string = string.substring(0, 500);
			$(this).val(string);
			count = 500;
		}
		
		$('#chars-counter').text(count + "/500");
	});
	
	/*
		If is inputting in input elements...
	*/
	$('input[type="text"]').keyup(function() {
		// length
		let count = $(this).val().length;
		// string
		let string = $(this).val();
		
		/*
			If length is longer than possible
			you must cut off longer part.
		*/
		if (count > 32) {
			string = string.substring(0, 32);
			$(this).val(string);
		}
		
		$(this).val(string);
	});
	
	
	
	/*
		For two inputs...
		Validation
	*/
	$('form .mail-element div input').keyup(function() {
		//let pattern = /[A-za-z][A-Za-z0-9]{3, 32}/;
		let pattern = new RegExp('[A-za-z][A-Za-z0-9]{2,32}');
		
		if (!pattern.test($(this).val())) {
			$(this).css('backgroundColor', 'red');
		} else $(this).css('backgroundColor', '');
	});
	$('input[type="submit"]').click(function() {
		valid = true;
		/*
			Check all fields, if are filled,
			if not, then reset the submit
		*/
		if ($('form .mail-element div input').val().length < 3 || $('form .mail-element div input').val().length > 32) {
			alert('The username/title cannot be longer than 32 chars or shorter than 3 chars!');
			valid = false;
		}
		if ($('textarea[name="contents"]').val().length < 1 || $('textarea[name="contents"]').val().length > 500) {
			alert('The message contents must be longer than 1 char or shorter than 501 chars!');
			valid = false;
		}
		
		return valid;
	});
});