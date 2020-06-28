var ajax_func =function(){
  return $.ajax({
            url: xmlurl,
            dataType: "xml",
            success: function (xml) {  
              var  x =xml.getElementsByTagName('ROW');              
              var len =x.length;
              console.log(len);
              var labels=[];
              var data_orp =[],data_ph =[], data_tem=[],
              data_cl=[],data_cl_t=[],data_cl_c=[];
             
               var i;
              nowday =Date().split(" ")[2]
              if(nowday <10){
                nowday =nowday.slice(1)
              }
              nowtime =Date().split(" ")[4].split(":")[0]
              var d=new Date();
              nowmonth =d.getMonth() +1;              
              for(i =0; i<len; i++){
                 findtimestamp =x[i].getAttribute("DATE_TIME_STAMP");
                  findday =findtimestamp.split("/")[0]
                  findtime =findtimestamp.split(" ")[1].split(":")[0]
                  findmonth =parseInt(findtimestamp.split("/")[1])
                  if(nowmonth !=findmonth)
                  {
                    continue;
                  }
                  if(nowday ==findday){
                      get_datas(i);                  
                 }
              }

              function get_datas(len){
                data_ph.push(parseFloat(x[len].getAttribute(findval1)));
                data_orp.push(parseFloat(x[len].getAttribute(findval2)));
                data_tem.push(parseFloat(x[len].getAttribute(findval3)));
                data_cl.push(parseFloat(x[len].getAttribute(findval4)));
                data_cl_t.push(parseFloat(x[len].getAttribute(findval5)));
                data_cl_c.push(parseFloat(x[len].getAttribute(findval6)));
                labels.push(x[len].getAttribute("DATE_TIME_STAMP"));
              } 
              
                d_ph =parseFloat(x[len-1].getAttribute(findval1))
                d_orp =parseFloat(x[len-1].getAttribute(findval2));
                d_tem =parseFloat(x[len-1].getAttribute(findval3));
                d_cl =parseFloat(x[len-1].getAttribute(findval4));

                $('#ph_div').html('<h3>'+d_ph+'</h3>');
                $('#orp_div').html('<h3>'+d_orp+'</h3>');
                $('#tem_div').html('<h3>'+d_tem+'</h3>');
                $('#cl_div').html('<h3>'+d_cl+'</h3>');
              var areaChartCanvas = $('#areaChart').get(0).getContext('2d');

              var areaChartData = {
                labels  : labels,
                datasets: [
                  {
                    label               : findval1,
                    backgroundColor     : 'rgba(229,255,188,0.9)',
                    borderColor         : 'rgba(229,255,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(229,255,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(229,255,188,1)',
                    data                : data_ph
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

              // This will get the first returned node in the jQuery collection.
              var areaChart       = new Chart(areaChartCanvas, { 
                type: 'line',
                data: areaChartData, 
                options: areaChartOptions
              })


              // -------------
              //  Chlorine CHART 
              // -------------
              var cl3ChartData = {
                labels  : labels,
                datasets: [
                  {
                    label               : findval4,
                    backgroundColor     : 'rgba(21,216,216,0.9)',
                    borderColor         : 'rgba(21,216,216,0.9)',
                    // pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(21,216,216,0.9)',
                    //  pointHighlightFill  : '#fff',
                    // pointHighlightStroke: 'rgba(21,216,216,0.9)',
                    data                : data_cl
                  },
                  {
                    label               : findval5,
                    backgroundColor     : 'rgba(60,63,255,0.9)',
                    borderColor         : 'rgba(60,63,255,0.9)',
                    // pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,63,255,0.9)',
                    // pointHighlightFill  : '#fff',
                    // pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : data_cl_t
                  },
                  {
                    label               : findval6,
                    backgroundColor     : 'rgba(101,141,100,0.9)',
                    borderColor         : 'rgba(101,141,100,0.9)',
                    // pointRadius          : false,
                    pointColor          : '#3b8bba',
                    // pointHighlightFill  : '#fff',
                    // pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : data_cl_c
                  },
                  
                ]
              }
             

                var lineChartCanvas = $('#cl3Chart').get(0).getContext('2d')
                var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
                var lineChartData = jQuery.extend(true, {}, cl3ChartData)
                lineChartData.datasets[0].fill = false;
                lineChartData.datasets[1].fill = false;
                lineChartData.datasets[2].fill = false;
                lineChartOptions.datasetFill = false

                var lineChart = new Chart(lineChartCanvas, { 
                  type: 'line',
                  data: lineChartData, 
                  options: lineChartOptions
                })

              //---------------------


             
              //-------------
              //- BAR CHART -
              //-------------
              var phtemChartData = {
                labels  : labels,
                datasets: [
                  {
                    label               : findval1,
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    pointRadius          : false,
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : data_ph
                  },
                  {
                    label               : findval3,
                    backgroundColor     : 'rgba(255,254,30,0.9)',
                    pointRadius          : false,
                    pointHighlightFill  : '#fff',
                    data                : data_tem
                  },
                  
                  
                ]
              }
              var barChart2Canvas = $('#barChart').get(0).getContext('2d')
              var barChart2Data = jQuery.extend(true, {}, phtemChartData)
              barChart2Data.datasets[0] = phtemChartData.datasets[0]
              barChart2Data.datasets[1] = phtemChartData.datasets[1]
              

              var barChart2Options = {
                responsive              : true,
                maintainAspectRatio     : false,
                datasetFill             : false
              }

              var barChart2 = new Chart(barChart2Canvas, {
                type: 'bar', 
                data: barChart2Data,
                options: barChart2Options
              })


              //---------------------
              }
            });
}

setInterval(function(){ ajax_func()},600000);

$(document).ready(function(){
  xmlurl = $('#selectError').attr('xmlval')+"?r=" + Math.random();
  findval1=$('#selectError').attr('findval1')
  findval2=$('#selectError').attr('findval2')
  findval3=$('#selectError').attr('findval3')
  findval4=$('#selectError').attr('findval4')
  findval5=$('#selectError').attr('findval5')
  findval6=$('#selectError').attr('findval6')
  console.log(findval2)
  console.log(xmlurl)
 ajax_func();
})
 
