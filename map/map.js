		var map = L.map('map');
		L.tileLayer('http://{s}.tile.cloudmade.com/5F9A940B68534DF98F4EC7F3C5B6C300/997/256/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',		maxZoom: 18
		}).addTo(map);
		
		var loc = document.getElementsByClassName('location')
		locationTuples = locationTuple(loc);
		locations = parseLocationString(locationTuples);
		
		markers = locations.map(function(loc){
			 return L.marker(loc).addTo(map);
		});
		
		
		function locationTuple(loc){
			var locationsHtml = [];
			for (var i = 0; i<loc.length; i++) {
				locationsHtml.push(loc[i].innerHTML.split(","));
			}
			return locationsHtml;
		}
		
		function parseLocationString(locationString) {
			var locations = []; 
			for (var i =0; i<locationString.length; i++) {
				console.log(locationString[i]);
				locations.push([parseFloat(locationString[i][0], 10), parseFloat(locationString[i][1],10)]);
			}
			return locations;
		}
		
	map.setView(locations[0] || [52.31,13.25], 12 )
	
	var linknamen = document.getElementsByClassName('linkname')	
	function parseHTML(linkclass){
		var ergebnis = [];
		for (var i =0; i<linkclass.length; i++) {
			ergebnis.push(linkclass[i].innerHTML);
		}
		return ergebnis
	}
	namen = parseHTML(linknamen)
	
	var uninamen = document.getElementsByClassName('uniname')		
	var uninames = parseHTML(uninamen)
	
	for (var i = 0; i<markers.length; i++) {
		markers[i].bindPopup('<a href='+namen[i]+'>'+uninames[i]+'</a>').openPopup();
	}
	

	
