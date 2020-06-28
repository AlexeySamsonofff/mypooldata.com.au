var ajax_func1= function(){
  return $.ajax({
    url: startxmlurl,
    dataType: "xml",
    cache: false,
    success: function (xml) {  
      console.log(machine_id)

      var  x =xml.getElementsByTagName('ROW');   
      console.log(x);           
      var len =x.length;
      console.log(len);
      var labels1=[],labels2 =[];
      var data_ph1 =[],data_ph2 =[];
      var i, datas =[];
      
      for(i=0; i<len; i++){
        var findid =x[i].getAttribute("MACHINE_ID")    
        if(machine_id == findid){
          data_ph1.push(parseFloat(x[i].getAttribute(findval)));
          labels1.push(x[i].getAttribute("DATE_TIME_STAMP"));
        }
        
      }
    

    
      // var chartParent = $('#areaChart1').parent();
      var chartParent =$('#chart1');
      $('#areaChart1').remove();
      $('#chart1').html(' <canvas id="areaChart1" style="min-height: 550px; height: 550px; max-height: 550px; max-width: 100%;"></canvas>');
      // chartParent.append(' <canvas id="areaChart1" style="min-height: 550px; height: 550px; max-height: 550px; max-width: 100%;"></canvas>');
      var areaChartCanvas = $('#areaChart1').get(0).getContext('2d')

      var areaChartData = {
        labels  : labels1,
        datasets: [
          {
            label               : findval,
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : data_ph1
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

      var areaChart       = new Chart(areaChartCanvas, { 
        type: 'bar',
        data: areaChartData, 
        options: areaChartOptions
      })
      

    
      //---------------------
    }
  });
}
// var ajax_func2= function(){
//   return $.ajax({
//     url: endxmlurl,
//     dataType: "xml",
//     cache: false,
//     success: function (xml) {  
      

//       var  x =xml.getElementsByTagName('ROW');   
//       console.log(x);           
//       var len =x.length;
//       console.log(len);
//       var labels1=[]
//       var data_ph1 =[]
//       var i, datas =[];
      
//       for(i=0; i<len; i++){
//         var findid =x[i].getAttribute("MACHINE_ID")    
//         if(machine_id == findid){
//           data_ph1.push(parseFloat(x[i].getAttribute(findval)));
//           labels1.push(x[i].getAttribute("DATE_TIME_STAMP"));
//         }
        
//       }
    

    
//       // var chart2Parent = $('#areaChart2').parent();
//       var chart2parent =$('#chart2');
//       $('#areaChart2').remove();
//       $('#chart2').html(' <canvas id="areaChart2" style="min-height: 550px; height: 550px; max-height: 550px; max-width: 100%;"></canvas>');
//       // chart2Parent.append(' <canvas id="areaChart2" style="min-height: 550px; height: 550px; max-height: 550px; max-width: 100%;"></canvas>');
//       var areaChart2Canvas = $('#areaChart2').get(0).getContext('2d')

//       var areaChart2Data = {
//         labels  : labels1,
//         datasets: [
//           {
//             label               : findval,
//             backgroundColor     : 'rgba(60,141,188,0.9)',
//             borderColor         : 'rgba(60,141,188,0.8)',
//             pointRadius          : false,
//             pointColor          : '#3b8bba',
//             pointStrokeColor    : 'rgba(60,141,188,1)',
//             pointHighlightFill  : '#fff',
//             pointHighlightStroke: 'rgba(60,141,188,1)',
//             data                : data_ph1
//           },
          
//         ]
//       }              

//       var areaChart2Options = {
//         maintainAspectRatio : false,
//         responsive : true,
//         legend: {
//           display: false
//         },
//         scales: {
//           xAxes: [{
//             gridLines : {
//               display : false,
//             }
//           }],
//           yAxes: [{
//             gridLines : {
//               display : false,
//             }
//           }]
//         }
//       }

//       var areaChart2       = new Chart(areaChart2Canvas, { 
//         type: 'bar',
//         data: areaChart2Data, 
//         options: areaChart2Options
//       })           
//       //---------------------
//     }
//   });
// }  

$(function(){  
  
  
  $('#reservation').daterangepicker(
    {
      locale: {
        format: 'DD/MM/YYYY'
      },
      singleDatePicker: true
    },
    function(start,end){
      machine_id= $('#site_select').children('option:selected').attr('title');
      findval= $('#option_select').children('option:selected').attr('title');
      console.log(machine_id)
      console.log(findval)
      startdate =start.format('YYYYMMDD')
      enddate =end.format('YYYYMMDD' )
      startxml ='xmlhistory/' + startdate  + '.XML';
      endxml ='xmlhistory/' + enddate + '.XML';
      $('#startdate').val(startxml);
      $('#enddate').val(endxml);
      startxmlurl =startxml + '?r=' +Math.random();
      endxmlurl =endxml + '?r=' +Math.random();
      console.log(startdate)
      console.log(enddate);
      ajax_func1();
      // ajax_func2();
    }
  );    


});
  
  