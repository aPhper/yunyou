           function drawing(){
        	   //console.log(eval($('#x').val()));
        	  // console.log(eval("("+$('#y').val()+")"));
                $(function () {
                    $('#container').highcharts({                   //图表展示容器，与div的id保持一致
                        chart: {
                            type: 'line'                         //指定图表的类型，默认是折线图（line）
                        },
                        title: {
                            text: $('#title').val()      //指定图表标题
                        },
                        xAxis: {
                        	title:{
                        		text:$('#x_tytle').val()
                        	},
                            categories: eval($('#x').val())   //指定x轴分组
                        },
                        yAxis: {
                            title: {
                                text: $('#y_title').val()             //指定y轴的标题
                            }
                        },
                        series:[{                                 //指定数据列
                            name: $('#line_name').val(),                          //数据列名
                            data: eval($('#y').val())                    //数据
                        }],
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
       