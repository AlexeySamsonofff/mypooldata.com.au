var t_offset = 9.5;
var allow_email = 0;
var selDash = 1;
var item_data = [];
var outOfRange = [];
var Pool = {
    itemajax: function(){
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/main_saveval',
            data: {
                val: val,
                tbl_id: tbl_id,
                val_name: val_name,
            },

            success: function (data) {
                console.log(data);
                $('#' + val_name).html(val);

                outOfRange = [];

                compare('h' + val_name.slice(1) + '_l' + val_name.slice(1))
                if(outOfRange.length > 0) emailcheck();
            }
        })
    }
};

$('.plusitem').click(function () {
    if(selDash == 0) return;
    if(allow_email == 0) return;
    strval = $(this).parents('.row').children('.col-sm-6').eq(0)
        .children('.curdiv').text();
    tbl_id =$('#select_pool').attr('pool_id');
    val_name = $(this).parents('.row').children('.col-sm-6').eq(0)
        .children('.curdiv').attr('id');
    
  
  
    if (val_name.slice(1) == "1") {
        valf = parseFloat(strval) + 10;
    }
    else if (val_name.slice(1) == "2") {
        valf = parseFloat(strval) + 1;
    }
    else {
        valf = parseFloat(strval) + 0.1;
    }
  
  
    val = valf.toFixed(1)
    console.log(tbl_id)
    Pool.itemajax(tbl_id,val_name,val);
  
})
$('.minusitem').click(function () {
    if(selDash == 0) return;
    if(allow_email == 0) return;
    strval = $(this).parents('.row').children('.col-sm-6').eq(0)
        .children('.curdiv').text();
    tbl_id =$('#select_pool').attr('pool_id');
    val_name = $(this).parents('.row').children('.col-sm-6').eq(0)
        .children('.curdiv').attr('id');


    if (val_name.slice(1) == "1") {
        valf = parseFloat(strval) - 10;
    }
    else if (val_name.slice(1) == "2") {
        valf = parseFloat(strval) - 1;
    }
    else {
        valf = parseFloat(strval) - 0.1;
    }

    val = valf.toFixed(1)
    Pool.itemajax(tbl_id,val_name,val);
})

function notiFunc(ch_id) {
    var checkBox = document.getElementById("ck_" + ch_id);
    var val = 0;
    // If the checkbox is checked, display the output text
    if (checkBox.checked == true){
        val = 1;
    } else {
        val = 0;
    }

    if(allow_email == 0) return; 
    if(selDash == 1) {
        // ch_name = $(this).attr('id');
        ch_name = "c" + ch_id;
        id = $('#select_pool').attr('pool_id');
        // val =$(this).children().eq(0).attr('title');
        
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/mainemail_check',
            data: {
                val:val,
                id: id,
                ch_name: ch_name,
            },
            dataType: 'JSON',
            success: function (data) {
                ch_name =data.ch_name
                val =data.val;
                if(val ==1){
                    // $('#'+ch_name).empty();
                    // $('#'+ch_name).html('<span title="0"  class="btn-success">Notifications<i class="fas fa-check"></i></span>');
                    $('#'+ch_name + ' span').addClass("btn-success");
                }
                else{
                    // $('#'+ch_name).empty();
                    // $('#'+ch_name).html('<span title="1">Notifications</span>');
                    $('#'+ch_name + ' span').removeClass("btn-success");
                }                

            }
        })
    }
    else if (selDash == 0) {
        ch_name = "c" + ch_id;
        id = $('#tbl_id').val();

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            type: 'POST',
            url: '/email_check',
            data: {
                val:val,
                tbl_id: id,
                ch_name: ch_name,
            },
            dataType: 'JSON',
            success: function (data) {
                ch_name =data.ch_name
                val =data.val;
                if(val ==1){
                    $('#'+ch_name + ' span').addClass("btn-success");
                }
                else{
                    $('#'+ch_name + ' span').removeClass("btn-success");
                }
            }
        })
    }
}

// $('.noti').click(function() {
//     if(allow_email == 0) return; 
//     if(selDash == 0) return;
    
// });

 
  
  
var ajax_func_dash = function () {
    console.log("ajax_func_dash");
    return $.ajax({
        url: xmlurl,
        dataType: "xml",
        async: false,
        success: function (xml) {
            var x = xml.getElementsByTagName('ROW');
            var len = x.length;
            var labels = [];
            var datas = [];
            item_data = [];
            outOfRange = [];
            var datalen = -1;
            console.log("ajax_func_dash = ", x)

            var j;
            
            d = new Date();

            utc = d.getTime() + (d.getTimezoneOffset() * 60000);
            
            nd = new Date(utc + (3600000*t_offset));

            nowday = nd.getDate();
            nowHour = nd.getHours();
            // nowday = nd.split(" ")[2];
            // if (nowday < 10) {
            //     nowday = nowday.slice(1)
            // }
            //nowtime = nd.split(" ")[4].split(":")[0];

            nowmonth = nd.getMonth() + 1; 

            for (j = 0; j < len; j++) {
                findtimestamp = x[j].getAttribute("DATE_TIME_STAMP");
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
                if (nowmonth != findmonth) {
                    continue;
                }

                //findtime =findtimestamp.split(" ")[1].split(":")[0]
                var findid = x[j].getAttribute("MACHINE_ID")
                // console.log(findid)


                if (machine_id == findid) {
                    if ((nowday == findday) && (nowHour >= findtime)) {
                        get_phdata1(j);
                        datalen = j;
                    }
                }

            }
            function get_phdata1(len) {
                for (i = 0; i < 6; i++) {
                    datas[i] = datas[i] ? datas[i] : [];
                    datas[i].push(parseFloat(x[len].getAttribute(findvals[i])));
                }

                labels.push(x[len].getAttribute("DATE_TIME_STAMP"));
            }


            for (i = 0; i < 6; i++) {
                if(datalen != -1)
                    item_data.push(parseFloat(x[datalen].getAttribute(findvals[i])));
                else
                    item_data.push(0);
            }

            var item_div = [];
            for (i = 0; i < 6; i++) {
                $('#h' + i + '_l' + i).text(item_data[i]);
                compare('h' + i + '_l' + i);
            }

            // if(outOfRange.length > 0) emailcheck();

            var chart1Parent = $('#areaChart').parent();
            $('#areaChart').remove();
            chart1Parent.append('<canvas id="areaChart" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>');


            var areaChartCanvas = $('#areaChart').get(0).getContext('2d');

            var areaChartData = {
                labels: labels,
                datasets: [

                    {
                        label: findvals[1],
                        fill: false,
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        //   borderColor         : 'rgba(210, 214, 222, 1)',
                        //   pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        // pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: datas[1]
                    },

                ]
            }

            var areaChartOptions_orp = {
                maintainAspectRatio: false,
                responsive: true,
                datasetFill: false,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        },
                        ticks: {
                            max: 1000,
                            min: 0,
                            stepSize: 250
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            var areaChart = new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData,
                options: areaChartOptions_orp
            })

            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }]
                }
            }


            // -------------
            //  Chlorine CHART 
            // -------------
            var cl3ChartData = {
                labels: labels,
                datasets: [
                    {
                        label: findvals[3],
                        backgroundColor: 'rgba(21,216,216,0.9)',
                        borderColor: 'rgba(21,216,216,0.9)',
                        // pointRadius          : false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(21,216,216,0.9)',
                        // pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(21,216,216,0.9)',
                        data: datas[3]
                    },
                    {
                        label: findvals[4],
                        backgroundColor: 'rgba(60,63,255,0.9)',
                        borderColor: 'rgba(60,63,255,0.9)',
                        // pointRadius          : false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,63,255,0.9)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: datas[4]
                    },
                    {
                        label: findvals[5],
                        backgroundColor: 'rgba(101,141,100,0.9)',
                        borderColor: 'rgba(101,141,100,0.9)',
                        // pointRadius          : false,
                        pointColor: '#3b8bba',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: datas[5]
                    },

                ]
            }


            var chartParent = $('#cl3Chart').parent();
            $('#cl3Chart').remove();
            chartParent.append('<canvas id="cl3Chart" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>');
            
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

            //-------------ph chart
            var phChartData = {
                labels: labels,
                datasets: [
                    {
                        label: findvals[0],
                        fill: false,
                        backgroundColor: 'rgba(100,91,188,0.9)',
                        borderColor: 'rgba(21,216,216,0.9)',
                        // pointRadius: false,
                        pointStrokeColor: 'rgba(60,130,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: datas[0]
                    }

                ]
            }
            // var phchartParent = $('#phChart').parent();
            // $('#phChart').remove();
            // chartParent.append('<canvas id="phChart" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>');
            
            var barChart2Canvas = $('#phChart').get(0).getContext('2d')



            var barChart2Options = {
                maintainAspectRatio: false,
                responsive: true,
                datasetFill: false,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        },
                        ticks: {
                            max: 10,
                            min: 0,
                            stepSize: 2.5
                        }
                    }]
                }
            }

            var barChart2 = new Chart(barChart2Canvas, {
                type: 'line',
                data: phChartData,
                options: barChart2Options
            })

            //---temperature chart
            var temChartData = {
                labels: labels,
                datasets: [
                    {
                        label: findvals[2],
                        fill: false,
                        backgroundColor: 'rgba(240,12,12,0.9)',
                        borderColor: 'rgba(240,12,12,0.9)',
                        // pointRadius: false,
                        pointStrokeColor: 'rgba(255,254,30,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: datas[2]
                    },

                ]
            }
            // var phchartParent = $('#phChart').parent();
            // $('#phChart').remove();
            // chartParent.append('<canvas id="phChart" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>');
            
            var temChart2Canvas = $('#temChart').get(0).getContext('2d')

            var temChart2Options = {
                maintainAspectRatio: false,
                responsive: true,
                datasetFill: false,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        },
                        ticks: {
                            max: 50,
                            min: 0,
                            stepSize: 25
                        }
                    }]
                }
            }

            var bartempChart2 = new Chart(temChart2Canvas, {
                type: 'line',
                data: temChartData,
                options: temChart2Options
            })
            
        }
    });
}
  
function draw_items(data) {
    for (i = 0; i < 6; i++) {
        $('#h' + i).html(data[0]['h' + i]);
        $('#l' + i).html(data[0]['l' + i]);
        console.log(data[0])

        var checkBox = document.getElementById("ck_" + i);
        
        if(data[0]['c'+i] =='1') {
            //   $('#c'+i).empty();
            //   $('#c'+i).html('<span title="0" class="btn-success">Notifications<i class="fas fa-check"></i></span>')
            $('#c'+ i + ' span').addClass("btn-success");
            checkBox.checked = true;
        }
        else
        {
            // $('#c'+i).empty();
            // $('#c'+i).html('<span title="1" >Notifications</span>')
            $('#c'+ i + ' span').removeClass("btn-success");
            checkBox.checked = false;
        }

        if(allow_email == 0)
            checkBox.disabled = true;
        
    }
}

function draw_emails(data){
    var email_addrs =[];
    $.each(data,function(key,value){
        var htmlContent = '<li>'+value.email_addr+'</li>';
        if(allow_email == 1) htmlContent = '<li>'+value.email_addr+'<a href="/delete_emails/'+value.tbl_id+'" ><i class="fas fa-trash"></i></a>'+'</li>';
        email_addrs.push(htmlContent);          
    })
    $('#emaildiv').html(email_addrs);
}
  
setInterval(function () { 
    if(selDash == 1) ajax_func_dash() 
    }, 
300000);
  

$(function(){
    id = $('#select_pool').attr('pool_id');
    machine_id = $('#select_pool').attr('title')
    findvals = []
    for (i = 0; i < 6; i++) {
        findvals.push($('#select_pool').attr('findval' + i))
    }
    xmlurl = $('#select_pool').attr('xmlval') + '?r=' + Math.random();

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
            //   console.log(pool_info);
          allow_email = pool_info[0].allow_email;
          console.log("allow_email = ", allow_email);
          if(allow_email == 1) {
            $(".add-email-alarm").show();
          }
          else {
            $(".add-email-alarm").hide();
          }
          selDash = 1;
            console.log("allow_email = ", allow_email);
          t_offset = ((pool_info[0].yourtimezone == null) ? 9.5 : pool_info[0].yourtimezone);
            $('#tbl_id').val('11'+pool_info[0].id)
            $('#pool_div').html(pool_info[0].pool_name.toUpperCase())
            
            if(selDash == 1) {
                draw_items(pool_info);
                draw_emails(email_info);
                ajax_func_dash();
                if(outOfRange.length > 0) emailcheck();
            }
        }
  
    })  
    
    

})  