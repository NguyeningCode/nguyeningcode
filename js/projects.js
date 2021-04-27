$(document).ready(function () {
    $.ajax({
		url: 'https://api.github.com/repos/jnguyen7410/NguyeningCode',
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
		url: 'https://api.github.com/repos/jnguyen7410/Give-N-Take',
		type: 'GET',
		dataType: 'json',
		contentType: "application/json",
		success: function (data) {
			var GnT_lastUpdated = data.pushed_at;
			var dateFinal = new Date(GnT_lastUpdated);
			var date = GnT_lastUpdated.substring(0, 10);
			var time = GnT_lastUpdated.substring(11, 19);
			if (document.getElementById("GnT_lastUpdated") != null) {
				document.getElementById("GnT_lastUpdated").innerHTML = "Updated: " + dateFinal.toLocaleString();
			}
		}
	});
	$.ajax({
		url: 'https://api.github.com/repos/jnguyen7410/NguyeningCode/stats/contributors',
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
		url: 'https://api.github.com/repos/jnguyen7410/Give-N-Take/stats/contributors',
		type: 'GET',
		dataType: 'json',
		contentType: "application/json",
		success: function (data) {
			var GnT_commits = data[0].total;

			if (document.getElementById("GnT_commits") != null) {
				document.getElementById("GnT_commits").innerHTML = GnT_commits + " COMMITS";
			}
		}
	});
});