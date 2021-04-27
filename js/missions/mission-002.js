// JavaScript Document
$(document).ready(function () {
	// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
	$("#submit").click(function (e) {
		checkPassword();
	});
	$('form input').keydown(function (e) {
		if (e.keyCode == 13) {
			event.preventDefault();
			checkPassword();
			$("#modal").openModal();
			$("form input").blur();
		}
	});

});


function checkPassword() {
	if ($("#password").val() == "") {
		$("#resultHeader").text('Error!');
		$("#resultText").text('You didn\'t enter anything. Try again!');
		$("#modal").css('background-color', '#e74c3c');
		$(".modal-footer").addClass("importantRed");
	} else {
		$("#resultHeader").text('Sorry!');
		$("#resultText").text('You entered the wrong password, buddy. Try again!');
		$("#modal").css('background-color', '#e74c3c');
		$(".modal-footer").addClass("importantRed");
	}
}
