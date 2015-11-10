jQuery.getScript(
	"//code.highcharts.com/adapters/standalone-framework.js",
	function(data, textStatus, jqxhr) {
		jQuery.getScript(
			"//code.highcharts.com/highcharts.js",
			function(data, textStatus, jqxhr) {
				jQuery.getScript(
					"//code.highcharts.com/highcharts-more.js",
					function(data, textStatus, jqxhr) {
						jQuery.getScript(
							"//code.highcharts.com/modules/solid-gauge.js",
							function(data, textStatus, jqxhr) {
								jQuery.getScript(
									"//code.highcharts.com/modules/exporting.js",
									function(data, textStatus, jqxhr) {
										loadCharts();
									});
							});
					});
			});
	});

function loadCharts() {
	buildChartHitRate();
	data = storageOpcodeInfoStatistics.getData()[0];
	if (data != undefined) {
		jQuery('#value-opcache-statistics-hits').text(data.hits);
		jQuery('#value-opcache-statistics-misses').text(data.misses);
		jQuery('#value-opcache-statistics-num-cached-scripts').text(
				data.num_cached_scripts);
		jQuery('#value-opcache-statistics-num-cached-keys').text(
				data.num_cached_keys);
		jQuery('#value-opcache-statistics-max-cached-keys').text(
				data.max_cached_keys);
		setTimeout(function() {
			point = chartHitRate.series[0].points[0];
			point.update(Math.round(data.opcache_hit_rate * 10) / 10);
		}, 1500);
	
		buildChartMemory();
	}
}

function buildChartHitRate() {
	chartHitRate = new Highcharts.Chart(
			{
				chart : {
					renderTo : 'container-chart-hit-rate',
					type : 'solidgauge'
				},

				title : null,

				pane : {
					center : [ '50%', '85%' ],
					size : '140%',
					startAngle : -90,
					endAngle : 90,
					background : {
						backgroundColor : '#EEE',
						innerRadius : '60%',
						outerRadius : '100%',
						shape : 'arc'
					}
				},

				tooltip : {
					enabled : false
				},

				yAxis : {
					stops : [ [ 0.3, '#DF5353' ], // green
					[ 0.5, '#DDDF0D' ], // yellow
					[ 0.8, '#55BF3B' ] // red
					],
					lineWidth : 0,
					minorTickInterval : null,
					tickPixelInterval : 400,
					tickWidth : 0,
					title : {
						y : -70,
						text : 'Hit Rate'
					},
					labels : {
						y : 16
					},
					min : 0,
					max : 100
				},
				exporting : {
					enabled : false
				},
				plotOptions : {
					solidgauge : {
						dataLabels : {
							y : 5,
							borderWidth : 0,
							useHTML : true
						}
					}
				},

				credits : {
					enabled : false
				},

				series : [ {
					name : 'Hit Rate',
					data : [ 0 ],
					dataLabels : {
						format : '<div style="text-align:center"><span style="font-size:40px;color:black">{y}%</span>'
					}
				} ]

			});

};

function buildChartMemory() {
	chartMemory = new Highcharts.Chart({
		chart : {
			renderTo : 'container-chart-memory',
			plotBackgroundColor : null,
			plotBorderWidth : 0,
			plotShadow : false
		},
		title : {
			text : 'Memory<br>consumption',
			align : 'center',
			verticalAlign : 'middle',
			y : 50
		},
		tooltip : {
			pointFormat : '<b>{point.y/1024} KB, {point.percentage:.1f}%</b>',
			formatter : function() {
				return '<b>' + (Math.round(this.y / 1024 / 1024 * 10) / 10)
						+ ' MB </b>, '
						+ (Math.round(this.percentage * 10) / 10) + '%';
			}
		},
		exporting : {
			enabled : false
		},
		plotOptions : {
			pie : {
				dataLabels : {
					enabled : true,
					distance : -50,
					style : {
						fontWeight : 'bold',
						color : 'white',
						textShadow : '0px 1px 2px black'
					}
				},
				startAngle : -90,
				endAngle : 90,
				center : [ '50%', '75%' ]
			}
		},
		series : [ {
			type : 'pie',
			name : 'Percentage',
			innerSize : '50%',
			data : [ [ 'Used', 5963648 ], [ 'Free', 60886000 ],
					[ 'Wasted', 259216 ] ]
		} ]
	});
}
