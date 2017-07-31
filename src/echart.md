## echart

 - 配置项的demo
 		
		var option = {
            title: {
                text: opts.title,
                x: "center",
                y: 240,
                textStyle: {
                    fontSize: 14,
                    color: "#666",
                    fontWeight: "normal"
                }
            },
            grid: {
                bottom: "40%"
            },
            tooltip: {
                trigger: "item",
                formatter: "{a} <br/>{b}: {c}",
            },
            toolbox: {
                feature: {
        	        saveAsImage: {
        	            show: true,  // 显示导出图片的小图标
        	            title: '导出'
        	        }
        	    },
            },
            legend: {
                x: "center",
                y: 300,
                data: opts.legendData
            },
            xAxis: {
                type: "category",
                boundaryGap: false,
                data: opts.legendData,
                splitLine: {
                    show: false
                },
                axisTick: {
                    show: false
                },
                axisLabel: {
                    show: false
                }
            },
            yAxis: {
                type: "value",
                splitLine: {
                    show: false
                }
            },
            series: seriesArr
        };
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
        }
		// 绑定click时间，进行事件监听
		myChart.on('click', function (params) {
			var url = Routing.generate(opts.route_name,{'param': 'value'});
			layui.layer.confirm('您是将要跳转到数据列表？', {
			  btn: ['确定','取消'] //按钮
			}, function(){
			  location.href=url;
			}, function(){
			});
		});
        $(window).on("resize", function() {
            myChart.resize();
        });