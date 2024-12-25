//
//  Dynamically load Morris Charts plugin
//  homepage: http://www.oesmith.co.uk/morris.js/ v0.4.3 License - MIT
//  require Raphael http://raphael.js
//
function LoadMorrisScripts(callback){
	function LoadMorrisScript(){
		if(!$.fn.Morris){
		}
		else {
			if (callback && typeof(callback) === "function") {
				callback();
			}
		}
	}
	if (!$.fn.raphael){
	}
	else {
		LoadMorrisScript();
	}
}

function LoadKnobScripts(callback){
	if(!$.fn.knob){
	}
	else {
		if (callback && typeof(callback) === "function") {
			callback();
		}
	}
}
//
//  Dynamically load Sparkline plugin
//  homepage: http://omnipotent.net/jquery.sparkline v2.1.2  License - BSD
//
function LoadSparkLineScript(callback){
	if(!$.fn.sparkline){
		$.getScript('../js/jquery.sparkline.min.js', callback);
	}
	else {
		if (callback && typeof(callback) === "function") {
			callback();
		}
	}
}
/*-------------------------------------------
	Main scripts used by theme
---------------------------------------------*/
//
//  Function for load content from url and put in $('.ajax-content') block
//
function LoadAjaxContent(url){
	$('.preloader').show();
	$.ajax({
		mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
		url: url,
		type: 'GET',
		success: function(data) {
			$('#ajax-content').html(data);
			$('.preloader').hide();
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert(errorThrown);
		},
		dataType: "html",
		async: false
	});
}

function LoadAjaxRmContent(url){
	$('.preloader').show();
	$.ajax({
		mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
		url: url,
		type: 'GET',
		success: function(data) {
			$('#ajax-content-rm').html(data);
			$('.preloader').hide();
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert(errorThrown);
		},
		dataType: "html",
		async: false
	});
}


//
// Function for change panels of Dashboard
//
function DashboardTabChecker(){
	$('#content').on('click', 'a.tab-link', function(e){
		e.preventDefault();
		$('div#dashboard_tabs').find('div[id^=dashboard]').each(function(){
			$(this).css('visibility', 'hidden').css('position', 'absolute');
		});
		var attr = $(this).attr('id');
		$('#'+'dashboard-'+attr).css('visibility', 'visible').css('position', 'relative');
		$(this).closest('.nav').find('li').removeClass('active');
		$(this).closest('li').addClass('active');
	});
}

//
// Helper for draw Sparkline plots on Dashboard page
//
function SparkLineDrawBarGraph(elem, arr, color){
	if (color) {
		var stacked_color = color;
	}
	else {
		stacked_color = '#ff6600'
	}
	elem.sparkline(arr, { type: 'bar', barWidth: 7, highlightColor: '#000', barSpacing: 2, height: 40, stackedBarColor: stacked_color});
}

//
//  Beauty tables plugin (navigation in tables with inputs in cell)
//  Created by DevOOPS.
//

//
// Beauty Hover Plugin (backlight row and col when cell in mouseover)
//
//
(function( $ ){
	$.fn.beautyHover = function() {
		var table = this;
		table.on('mouseover','td', function() {})
		.on('mouseleave','td', function(e) {
			var idx = $(this).index();
			var rows = $(this).closest('table').find('tr');
			rows.each(function(){
				$(this).find('td:eq('+idx+')').removeClass('beauty-hover');
			});
		});
	};
})( jQuery );


/*-------------------------------------------
	Functions for Dashboard page (dashboard.html)
---------------------------------------------*/
//
// Helper for random change data (only test data for Sparkline plots)
//
function SmallChangeVal(val) {
	var new_val = Math.floor(100*Math.random());
	var plusOrMinus = Math.random() < 0.5 ? -1 : 1;
	var result = val[0]+new_val*plusOrMinus;
	if (parseInt(result) > 1000){
		return [val[0] - new_val]
	}
	if (parseInt(result) < 0){
		return [val[0] + new_val]
	}
	return [result];
}
//
// Make array of random data
//
function SparklineTestData(){
	var arr = [];
	for (var i=1; i<9; i++){
		arr.push([Math.floor(1000*Math.random())])
	}
	return arr;
}

function SparklineLoop(){
	SparkLineDrawBarGraph($('.sparkline-1'), sparkline_arr_1.map(SmallChangeVal));
}
//
// Draw Morris charts on Dashboard (panel- Statistics + 3 donut)
//
function MorrisDashboard(){
	Morris.Line({
		element: 'stat-graph',
		data: [
			{"period": "2014-01", "Win8": 13.4, "Win7": 55.3, 'Vista': 1.5, 'NT': 0.3, 'XP':11, 'Linux': 4.9, 'Mac': 9.6 , 'Mobile':4},
			{"period": "2013-12", "Win8": 10, "Win7": 55.9, 'Vista': 1.5, 'NT': 3.1, 'XP':11.6, 'Linux': 4.8, 'Mac': 9.2 , 'Mobile':3.8},
			{"period": "2013-11", "Win8": 8.6, "Win7": 56.4, 'Vista': 1.6, 'NT': 3.7, 'XP':11.7, 'Linux': 4.8, 'Mac': 9.6 , 'Mobile':3.7},
			{"period": "2013-10", "Win8": 9.9, "Win7": 56.7, 'Vista': 1.6, 'NT': 1.4, 'XP':12.4, 'Linux': 4.9, 'Mac': 9.6 , 'Mobile':3.3},
			{"period": "2013-09", "Win8": 10.2, "Win7": 56.8, 'Vista': 1.6, 'NT': 0.4, 'XP':13.5, 'Linux': 4.8, 'Mac': 9.3 , 'Mobile':3.3},
			{"period": "2013-08", "Win8": 9.6, "Win7": 55.9, 'Vista': 1.7, 'NT': 0.4, 'XP':14.7, 'Linux': 5, 'Mac': 9.2 , 'Mobile':3.4},
			{"period": "2013-07", "Win8": 9, "Win7": 56.2, 'Vista': 1.8, 'NT': 0.4, 'XP':15.8, 'Linux': 4.9, 'Mac': 8.7 , 'Mobile':3.2},
			{"period": "2013-06", "Win8": 8.6, "Win7": 56.3, 'Vista': 2, 'NT': 0.4, 'XP':15.4, 'Linux': 4.9, 'Mac': 9.1 , 'Mobile':3.2},
			{"period": "2013-05", "Win8": 7.9, "Win7": 56.4, 'Vista': 2.1, 'NT': 0.4, 'XP':15.7, 'Linux': 4.9, 'Mac': 9.7 , 'Mobile':2.6},
			{"period": "2013-04", "Win8": 7.3, "Win7": 56.4, 'Vista': 2.2, 'NT': 0.4, 'XP':16.4, 'Linux': 4.8, 'Mac': 9.7 , 'Mobile':2.2},
			{"period": "2013-03", "Win8": 6.7, "Win7": 55.9, 'Vista': 2.4, 'NT': 0.4, 'XP':17.6, 'Linux': 4.7, 'Mac': 9.5 , 'Mobile':2.3},
			{"period": "2013-02", "Win8": 5.7, "Win7": 55.3, 'Vista': 2.4, 'NT': 0.4, 'XP':19.1, 'Linux': 4.8, 'Mac': 9.6 , 'Mobile':2.2},
			{"period": "2013-01", "Win8": 4.8, "Win7": 55.3, 'Vista': 2.6, 'NT': 0.5, 'XP':19.9, 'Linux': 4.8, 'Mac': 9.3 , 'Mobile':2.2}
		],
		xkey: 'period',
		ykeys: ['Win8', 'Win7','Vista','NT','XP', 'Linux', 'Mac', 'Mobile'],
		labels: ['Win8', 'Win7','Vista','NT','XP', 'Linux', 'Mac', 'Mobile']
	});
	Morris.Donut({
		element: 'morris_donut_1',
		data: [
			{value: 70, label: 'pay', formatted: 'at least 70%' },
			{value: 15, label: 'client', formatted: 'approx. 15%' },
			{value: 10, label: 'buy', formatted: 'approx. 10%' },
			{value: 5, label: 'hosted', formatted: 'at most 5%' }
		],
		formatter: function (x, data) { return data.formatted; }
	});
	Morris.Donut({
		element: 'morris_donut_2',
		data: [
			{value: 20, label: 'office', formatted: 'current' },
			{value: 35, label: 'store', formatted: 'approx. 35%' },
			{value: 20, label: 'shop', formatted: 'approx. 20%' },
			{value: 25, label: 'cars', formatted: 'at most 25%' }
		],
		formatter: function (x, data) { return data.formatted; }
	});
	Morris.Donut({
		element: 'morris_donut_3',
		data: [
			{value: 17, label: 'current', formatted: 'current' },
			{value: 22, label: 'week', formatted: 'last week' },
			{value: 10, label: 'month', formatted: 'last month' },
			{value: 25, label: 'period', formatted: 'period' },
			{value: 25, label: 'year', formatted: 'this year' }
		],
		formatter: function (x, data) { return data.formatted; }
	});
}
//
// Draw SparkLine example Charts for Dashboard (table- Tickers)
//
function DrawSparklineDashboard(){
	SparklineLoop();
	setInterval(SparklineLoop, 1000);
	var sparkline_clients = [[309],[223], [343], [652], [455], [18], [912],[15]];
	$('.bar').each(function(){
		$(this).sparkline(sparkline_clients.map(SmallChangeVal), {type: 'bar', barWidth: 5, highlightColor: '#000', barSpacing: 2, height: 30, stackedBarColor: '#6AA6D6'});
	});
	var sparkline_table = [ [1,341], [2,464], [4,564], [5,235], [6,335], [7,535], [8,642], [9,342], [10,765] ];
	$('.td-graph').each(function(){
		var arr = $.map( sparkline_table, function(val, index) {
			return [[val[0], SmallChangeVal([val[1]])]];
		});
		$(this).sparkline( arr ,
			{defaultPixelsPerValue: 10, minSpotColor: null, maxSpotColor: null, spotColor: null,
			fillColor: false, lineWidth: 2, lineColor: '#5A8DB6'});
		});
}
//
// Draw Knob Charts for Dashboard (for servers)
//
function DrawKnobDashboard(){
	var srv_monitoring_selectors = [
		$("#knob-srv-1"),$("#knob-srv-2"),$("#knob-srv-3"),
		$("#knob-srv-4"),$("#knob-srv-5"),$("#knob-srv-6")
	];
	srv_monitoring_selectors.forEach(DrawKnob);
	setInterval(function(){
		srv_monitoring_selectors.forEach(RedrawKnob);
	}, 3000);
}

$(document).ready(function () {
	
	var ajax_url = location.hash.replace(/^#/, '');
	
	if (ajax_url.length < 1) {
		ajax_url = '../ajax.html';
	}
	
	var ajax_url_rm = location.hash.replace(/^#/, '');
	
	if (ajax_url_rm.length < 1) {
		ajax_url_rm = '../ajax_rm.html';
	}
	
	LoadAjaxContent(ajax_url);
	LoadAjaxRmContent(ajax_url_rm);

	var height = window.innerHeight - 49;
	$('#main').css('min-height', height)

});


