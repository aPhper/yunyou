           function drawing(){
        	   //console.log(eval($('#x').val()));
        	  // console.log(eval("("+$('#y').val()+")"));
                $(function () {
                    $('#container').highcharts({                   //图表展示容器，与div的id保持一致
                        chart: {
                            type: 'line'                         //指定图表的类型，默认是折线图（line）
                        },
                        title: {
                            text: '表单统计'      //指定图表标题
                        },
                        xAxis: {
                            categories: eval($('#x').val())   //指定x轴分组
                        },
                        yAxis: {
                            title: {
                                text: 'asdf'                  //指定y轴的标题
                            }
                        },
                        series:{                               
                                name: 'asdf',                          
                                data: eval($('#y').val()) 
                            },
                        tooltip: {
                            crosshairs: [{
                                width: 1,
                                color: 'green'
                            }, {
                                width: 1,
                                color: 'green'
                            }],
                            pointFormat: '<span style="color:{series.color}">{series.name}</span>: ({point.y:,.0f} 个)<br/>',
                            shared: true
                        }
                });
            });
        };
        
        function string_to_arr(string){
        	var obj=eval('('+string+')');
        	return obj;
//        	var arr=new Array();
//        	for(var i=0;i<obj.length;i++){
//        			   arr[i]=obj[i];
//        	}
//        	console.log(typeof(obj));
//        	console.log(typeof(arr));
//        	console.log(arr);
        }
       