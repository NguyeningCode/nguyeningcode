// JavaScript Document
$(document).ready(function(){
	var ctx = document.getElementById("skillBars");
	//ctx.canvas.width = ;
	//ctx.canvas.height = ;
	var myChart = new Chart(ctx, {
	    type: 'bar',
	    data: {
	        labels: ["Java", "Apex", "Salesforce", "Git/hub", "Bash/Batch", "JS", "Flutter", "Python"],
	        datasets: [{
	            label: 'Number of Years in Experience',
	            data: [3, 5, 5, 5, 5, 3, 1, 4],
							backgroundColor: "rgba(253,61,80,1)"
	        }]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero:true
	                }
	            }]
	        }
	    }
	});
});
