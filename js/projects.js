$(document).ready(function () {
    $.ajax({
		url: 'https://api.github.com/repos/NguyeningCode/NguyeningCode',
		type: 'GET',
		dataType: 'json',
		contentType: "application/json",
		success: function (data) {
			var NC_lastUpdated = data.pushed_at;
			var dateFinal = new Date(NC_lastUpdated);
			var date = NC_lastUpdated.substring(0, 10);
			var time = NC_lastUpdated.substring(11, 19);
			if (document.getElementById("NC_lastUpdated") != null) {
				document.getElementById("NC_lastUpdated").innerHTML = "Updated: " + dateFinal.toLocaleString();
			}
		}
	});
	$.ajax({
		url: 'https://api.github.com/repos/jnguyen7410/road_to_flutter',
		type: 'GET',
		dataType: 'json',
		contentType: "application/json",
		success: function (data) {
			var RtF_lastUpdated = data.pushed_at;
			var dateFinal = new Date(RtF_lastUpdated);
			var date = RtF_lastUpdated.substring(0, 10);
			var time = RtF_lastUpdated.substring(11, 19);
			if (document.getElementById("RtF_lastUpdated") != null) {
				document.getElementById("RtF_lastUpdated").innerHTML = "Updated: " + dateFinal.toLocaleString();
			}
		}
	});
	$.ajax({
		url: 'https://api.github.com/repos/NguyeningCode/NguyeningCode/stats/contributors',
		type: 'GET',
		dataType: 'json',
		contentType: "application/json",
		success: function (data) {
			var NC_commits = data[0].total;

			if (document.getElementById("NC_commits") != null) {
				document.getElementById("NC_commits").innerHTML = NC_commits + " COMMITS";
			}
		}
	});
	$.ajax({
		url: 'https://api.github.com/repos/jnguyen7410/road_to_flutter/stats/contributors',
		type: 'GET',
		dataType: 'json',
		contentType: "application/json",
		success: function (data) {
			var RtF_commits = data[0].total;

			if (document.getElementById("RtF_commits") != null) {
				document.getElementById("RtF_commits").innerHTML = RtF_commits + " COMMITS";
			}
		}
	});
});