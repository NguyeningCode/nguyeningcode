// JavaScript Document
$(document).ready(function () {
	// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
	$('.modal').modal({
		dismissible: true, // Modal can be dismissed by clicking outside of the modal
		opacity: .5, // Opacity of modal background
		in_duration: 300, // Transition in duration
		out_duration: 200 // Transition out duration
	});
	$('.collapsible').collapsible();
	$('.sidenav').sidenav();
	$('.scrollspy').scrollSpy();
	$('.parallax').parallax();
	$('.materialboxed').materialbox();
	$(".dropdown-trigger").dropdown();
});