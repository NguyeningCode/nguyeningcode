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

setCookie("canAccessNextLevel", "false", 1);

function checkPassword() {
	if (getCookie("canAccessNextLevel") == "true") {
		$("#resultHeader").text('Congrats!');
		$("#resultText").text('Nice! Get it? \'Cookie\' jar? It\'s okay, I crack myself up...');
		$("#modal").css('background-color', '#2ecc71');
		$(".modal-footer").addClass("importantGreen");
		$(".modal-footer a").attr("href", "mission-005.html")
	} else if ($("#password").val() == "") {
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

function setCookie(cname, cvalue, days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		var expires = "; expires=" + date.toGMTString();
	}
	else var expires = "";
	document.cookie = cname + "=" + cvalue + expires + ";";
}

function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}
