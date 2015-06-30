           function drawing(title_name,x_cate,y_title,series_data){
                $(function () {
                    $('#container').highcharts({                   //图表展示容器，与div的id保持一致
                        chart: {
                            type: 'line'                         //指定图表的类型，默认是折线图（line）
                        },
                        title: {
                            text: title_name      //指定图表标题
                        },
                        xAxis: {
                            categories: x_cate   //指定x轴分组
                        },
                        yAxis: {
                            title: {
                                text: y_title                  //指定y轴的标题
                            }
                        },
                        series: series_data,
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
        $(document).ready(function(){
            var title_name='测试';
            var x_cate=['周一', '周二', '周三','周四','周五','周六','周天'];
            var y_title='人数';
            var series_data=[{                                 //指定数据列
                            name: 'Jane',                          //数据列名
                            data: [10, 0, 40,87,83,9,27],
                            color:'#dddddd'                     //数据
                        }, {
                            name: 'John',
                            data: [53, 77, 33,42,63,23,47]
                        }];
            drawing(title_name,x_cate,y_title,series_data);
        });
        function choose(){
            var url;
            var data;
            $.post(
                url,data,callback(result));
        };
        function callback(result){

        }