var ajax_func= function(){
  return $.ajax({
            url: xmlurl,
            dataType: "xml",
            cache: false,
            success: function (xml) {  
              console.log(xml)
              var  x =xml.getElementsByTagName('ROW');              
              var len =x.length;
              console.log(len);
              var labels1=[],labels2 =[];
              var data_ph1 =[],data_ph2 =[];
              var i, datas =[];
              nowday =Date().split(" ")[2]
              nowtime =Date().split(" ")[4].split(":")[0]
              for(i =0; i<len; i++){
                 findtimestamp =x[i].getAttribute("DATE_TIME_STAMP");
                  findday ="0"+findtimestamp.split("/")[0] 
                  findtime =findtimestamp.split(" ")[1].split(":")[0]

                  console.log(nowday)
                  console.log("Ss")
                  console.log(findday)

                  if(nowday ==findday){
                      get_phdata(i);
                  }

              }
              function get_phdata(len){
                data_ph1.push(parseFloat(x[len].getAttribute(findval)));
                labels1.push(x[len].getAttribute("DATE_TIME_STAMP"));
              } 
              console.log(data_ph1)
            
              //first
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
setInterval(
  function(){ ajax_func() }, 600000);

$(document).on("click","#selectError",function(){
  xmlurl = $('#selectError').attr('xmlval')+"?r=" + Math.random();
  findval=$('#selectError').attr('findval')
  console.log(xmlurl)
  console.log(findval)
 ajax_func();
})
 