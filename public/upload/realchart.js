   var xmlDoc;
   var x  
   var len; 
   

var chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	
};


function getph(){
	console.log(x[len-1].getAttribute("DATE_TIME_STAMP"))
	data_ph =parseFloat(x[len-1].getAttribute("PH"));
	return (data_ph);
}

function onReceive(event) {
	myChart.config.data.datasets[event.index].data.push({
		x: event.timestamp,
		y: event.value,
	});
	myChart.update({
		preservation: true
	});
}

var timeoutIDs = [];


function startph() {
	var i=0;
	var receive = function() {
		onReceive({
			index: 0,
			timestamp: Date.now(),
			value: getph()
		});
		i++;
		timeoutIDs[0] = setTimeout(receive, getph(i) + 10000);
	}
	timeoutIDs[0] = setTimeout(receive, getph(i)+ 10000);
}

function stopFeed(index) {
	clearTimeout(timeoutIDs[index]);
}

var color = Chart.helpers.color;
var config = {
	type: 'line',
	data: {
		datasets: [{
			label: 'PH',
			backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
			borderColor: chartColors.blue,
			fill: false,
			cubicInterpolationMode: 'monotone',
			data: []
		}]
	},
	options: {
		title: {
			display: true,
			text: 'Push data feed sample'
		},
		scales: {
			xAxes: [{
				type: 'realtime',
				realtime: {
					duration: 20000,
					delay: 2000,
				}
			}],
			yAxes: [{
				scaleLabel: {
					display: true,
					labelString: 'value'
				}
			}]
		},
		tooltips: {
			mode: 'nearest',
			intersect: false
		},
		hover: {
			mode: 'nearest',
			intersect: false
		}
	}
};

 $(document).on("click", "#selectError",function(){
 	console.log("ok")
  xmlurl =$('select').val();
  console.log(xmlurl);
 $(function () {
   $.ajax({
            url: xmlurl,
            dataType: "xml",
            success: function (xml) {
              x =xml.getElementsByTagName('ROW');
              len =x.length;            
              
              var ctx = document.getElementById('myChart').getContext('2d');
              myChart = new Chart(ctx, config);

					startph();
					//startFeed(1);


             //----
              }
            });

  })
})