var t_offset = 9.5;
var ajax_func= function(){
	return $.ajax({
			  url: xmlurl,
			  dataType: "xml",
			  cache: false,
			  success: function (xml) {  
			   
  
				var  x =xml.getElementsByTagName('ROW');              
				var len =x.length;
				console.log(len);
				var labels1=[],labels2 =[];
				var data_ph1 =[],data_ph2 =[];
				var i, datas =[];
			  
				d = new Date();

				utc = d.getTime() + (d.getTimezoneOffset() * 60000);
				
				nd = new Date(utc + (3600000*t_offset));

				// nowday = nd.split(" ")[2];
				// if (nowday < 10) {
				// 	nowday = nowday.slice(1)
				// }
				// nowtime = nd.split(" ")[4].split(":")[0];
				nowday = nd.getDate();
				nowHour = nd.getHours();
				nowmonth = nd.getMonth() + 1;
  
  
				for(i =0; i<len; i++){
					findtimestamp =x[i].getAttribute("DATE_TIME_STAMP");
					//var fd = new Date(findtimestamp);

					findday = findtimestamp.split("/")[0];
					findtime = findtimestamp.split(" ")[1].split(":")[0];
					// findday = fd.getDate();
					// findtime = fd.getHours();

					findAP = findtimestamp.split(" ")[2];
					if(findtime == 12) findtime = 0;
					if(findAP == "PM") findtime = 12 + parseInt(findtime);

					findmonth = parseInt(findtimestamp.split("/")[1])
					// findmonth = fd.getMonth() + 1;
					
					if(nowmonth !=findmonth)   
					{
					  continue;
					}
					
					var findid =x[i].getAttribute("MACHINE_ID")                 
  
		   
					if ((nowday == findday) && (nowHour >= findtime)) {
						if(machine_id ==findid){                       
						   get_phdata1(i);
						} 
						
					} 
				
					
				}
  
				function get_phdata1(len){
				  data_ph1.push(parseFloat(x[len].getAttribute(findval)));
				  labels1.push(x[len].getAttribute("DATE_TIME_STAMP"));
				} 
				console.log(data_ph1)    
			  
  
        var chartParent =$('#chart1');
        $('#areaChart1').remove();
        $('#chart1').html(' <canvas id="areaChart1" style="min-height: 550px; height: 550px; max-height: 550px; max-width: 100%;"></canvas>');
        var areaChartCanvas = $('#areaChart1').get(0).getContext('2d')
  
				var areaChartData = {
				  	labels  : labels1,				 
					datasets: [
						{
							label: findval,
							backgroundColor: 'rgba(20,210,216,0.9)',
							borderColor: 'rgba(21,216,216,0.9)',
							// pointRadius          : false,
							pointColor: '#3b8bba',
							pointStrokeColor: 'rgba(21,216,216,0.9)',
							// pointHighlightFill  : '#fff',
							pointHighlightStroke: 'rgba(21,216,216,0.9)',
							data: data_ph1
						},
					]
				}
				
  
				var areaChartOptions = {
				  maintainAspectRatio : false,
				  responsive : true,
				  legend: {
					display: false
				  },
				  scales: {
					xAxes: [{
					  gridLines : {
						display : false,
					  }
					}],
					yAxes: [{
					  gridLines : {
						display : false,
					  }
					}]
				  }
				}

        		areaChartOptions.datasetFill = false
				
				var areaChart       = new Chart(areaChartCanvas, { 
					type: 'line',
					data: areaChartData, 
					options: areaChartOptions
				})
				
  
			  
				//---------------------
				}
			  });
  }
  setInterval(
	function(){ ajax_func() }, 600000);
  
  
  
  $(document).on('click', "#select_pool li", function () {
	id = $(this).attr('pool_id');
	machine_id = $(this).attr('title')
	findval =$('#pool_div').attr('findval');
   
	xmlurl = $('#select_pool').attr('xmlval') + '?r=' + Math.random();
	console.log(xmlurl)
	console.log("id : ", id, " ---machine_id : ", machine_id);
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		url: '/find_pool/' + id,
		dataType: "JSON",
		success: function (data) {
		  pool_info =data['pool_info'];
		  email_info =data['email_info'];
		  console.log(pool_info);
		  t_offset = ((pool_info[0].yourtimezone == null) ? 9.5 : pool_info[0].yourtimezone);
			$('#tbl_id').val(pool_info[0].tbl_id)
			$('#pool_div').html(pool_info[0].pool_name)

			ajax_func();
		}
  
	})  
	
	
  
  })
  $(function(){  
	id = $('#select_pool').attr('pool_id');
	machine_id = $('#select_pool').attr('title')
	findval =$('#pool_div').attr('findval');
	xmlurl = $('#select_pool').attr('xmlval') + '?r=' + Math.random();
	console.log(xmlurl)
	console.log("id : ", id, " ---machine_id : ", machine_id);

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/main_pool/' + id,
        dataType: "JSON",
        success: function (data) {
            console.log(data)
          pool_info =data['pool_info'];
          email_info =data['email_info'];
          console.log(pool_info);
		  t_offset = ((pool_info[0].yourtimezone == null) ? 9.5 : pool_info[0].yourtimezone);
            $('#tbl_id').val('11'+pool_info[0].id);
			$('#pool_div').html(pool_info[0].pool_name);
			
			ajax_func();  
        }
  
    })  
	
	 
	  
  });
  