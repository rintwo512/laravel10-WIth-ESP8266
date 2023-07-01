$(function () {
	"use strict";
	jQuery('#world-map-markers').vectorMap({
		map: 'world_mill_en',
		backgroundColor: 'transparent',
		borderColor: '#818181',
		borderOpacity: 0.25,
		borderWidth: 1,
		zoomOnScroll: false,
		color: '#009efb',
		regionStyle: {
			initial: {
				fill: '#3461ff'
			}
		},
		markerStyle: {
			initial: {
				r: 9,
				'fill': '#fff',
				'fill-opacity': 1,
				'stroke': '#000',
				'stroke-width': 5,
				'stroke-opacity': 0.4
			},
		},
		enableZoom: true,
		hoverColor: '#f00',
		markers: [{
			latLng: [-5.033217727977814, 119.54496007769139],
			name: 'Love Indonesia'
		}],
		hoverOpacity: null,
		normalizeFunction: 'linear',
		scaleColors: ['#f00', '#f00'],
		selectedColor: '#f00',
		selectedRegions: [],
		showTooltip: true,
		onRegionClick: function (element, code, region) {
			var message = 'You clicked "' + region + '" which has the code: ' + code.toUpperCase();
			alert(message);
		}
	});
	$('#indonesia').vectorMap({
		map: 'indonesia_id',
		backgroundColor: 'transparent',
		zoomOnScroll: false,
		regionStyle: {
			initial: {
				fill: '#f00'
			}
		}
	});
	
});