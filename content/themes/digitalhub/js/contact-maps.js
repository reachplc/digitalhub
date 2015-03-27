 /**
 *  JQuery Google Maps- v0.1.0
 *  Adds Google Maps to Contact page.
 *
 *  Made by Jon Masters
 *  Under MIT License
 */

//  Regions with offices
    var markerTMPLC;
    var markerTMMH;
    var markerTMNW;
    var markerNASA;
    var markerTMNE;
    var markerTMM;
    var markerTMSCOT;
    var markerTMW;
    var markerTMS;
    var markerIRE;

//  Coordinates for office markers
    var MEN = new google.maps.LatLng(53.521218, -2.149808);
    var HUD = new google.maps.LatLng(53.680195, -1.762001);
    var LIV = new google.maps.LatLng(53.406399, -2.975554);
    var SOUTHPORT = new google.maps.LatLng(53.645979, -3.00339);
    var CHESHIRE = new google.maps.LatLng(53.195012, -2.92123);
    var LANDU = new google.maps.LatLng(53.28497, -3.814801);
    var NASA = new google.maps.LatLng(51.505431, -0.023533);
    var NCJ = new google.maps.LatLng(54.970348, -1.613606);
    var GMC = new google.maps.LatLng(54.575852, -1.244942);
    var BPM = new google.maps.LatLng(52.510018, -1.811315);
    var COV = new google.maps.LatLng(52.412218, -1.510776);
    // Media Scotland
    var MEDSCOT = new google.maps.LatLng(55.857071, -4.272572);
    var TMW = new google.maps.LatLng(51.477238, -3.181018);
    var READ = new google.maps.LatLng(51.463622, -0.984264);
    var GUILD = new google.maps.LatLng(51.249651, -0.571036);
    // Mirror Media Ireland
    var belfast = new google.maps.LatLng(54.61158, -5.86445);
    var dublin  = new google.maps.LatLng(53.35244, -6.29773);

function initialize() {

  // Create an array of styles.
  var styles =   [
    {
        "featureType": "water",
        "stylers": [
            {
                "color": "#1bc4e5"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape",
        "stylers": [
            {
                "color": "#f4f4f4"
            }
        ]
    },
    {
        "featureType": "road",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 45
            }
        ]
    },
    {
        "featureType": "road.highway",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#444444"
            }
        ]
    },
    {
        "featureType": "transit",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    }
];
  // Create a new StyledMapType object, passing it the array of styles,
  // as well as the name to be displayed on the map type control.
  var styledMap = new google.maps.StyledMapType(styles,
    {name: 'Styled Map'});

  // Create a map object, and include the MapTypeId to add

  // variable for position of map centre
  var myLatlng = new google.maps.LatLng(51.505431, -0.023533);
  var tmmhLatlng = new google.maps.LatLng(53.599752, -1.930075);
  var tmnwLatlng = new google.maps.LatLng(53.456257, -3.144086);
  var nasaLatlng = new google.maps.LatLng(51.505431, -0.023533);
  var tmneLatlng = new google.maps.LatLng(54.784853, -1.3515);
  var tmmLatlng = new google.maps.LatLng(52.438655, -1.647762);
  var tmscotLatlng = new google.maps.LatLng(55.820982, -4.167891);
  var tmwLatlng = new google.maps.LatLng(51.477238, -3.181018);
  var tmsLatlng = new google.maps.LatLng(51.417588, -0.670146);
  var ireLatlng = new google.maps.LatLng(53.966571, -6.426121);





  // to the map type control.
  var mapOptions = {
    zoom: 12,
    center: myLatlng,
     mapTypeControlOptions: {
    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style'],
    position: google.maps.ControlPosition.BOTTOM_CENTER
    }
  };

  var tmmhOptions = {
    zoom: 10,
    center: tmmhLatlng,
     mapTypeControlOptions: {
    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style'],
    position: google.maps.ControlPosition.BOTTOM_CENTER
    }
  };

  var tmnwOptions = {
    zoom: 8,
    center: tmnwLatlng,
     mapTypeControlOptions: {
    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style'],
    position: google.maps.ControlPosition.BOTTOM_CENTER
    }
  };

  var nasaOptions = {
    zoom: 12,
    center: nasaLatlng,
     mapTypeControlOptions: {
    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style'],
    position: google.maps.ControlPosition.BOTTOM_CENTER
    }
  };

  var tmneOptions = {
    zoom: 8,
    center: tmneLatlng,
     mapTypeControlOptions: {
    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style'],
    position: google.maps.ControlPosition.BOTTOM_CENTER
    }
  };

  var tmmOptions = {
    zoom: 9,
    center: tmmLatlng,
     mapTypeControlOptions: {
    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style'],
    position: google.maps.ControlPosition.BOTTOM_CENTER
    }
  };

    var tmscotOptions = {
    zoom: 10,
    center: tmscotLatlng,
     mapTypeControlOptions: {
    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style'],
    position: google.maps.ControlPosition.BOTTOM_CENTER
    }
  };

  var tmwOptions = {
    zoom: 10,
    center: tmwLatlng,
     mapTypeControlOptions: {
    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style'],
    position: google.maps.ControlPosition.BOTTOM_CENTER
    }
  };

  var tmsOptions = {
    zoom: 9,
    center: tmsLatlng,
     mapTypeControlOptions: {
    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style'],
    position: google.maps.ControlPosition.BOTTOM_CENTER
    }
  };

  var ireOptions = {
    zoom: 7,
    center: ireLatlng,
    mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style'],
      position: google.maps.ControlPosition.BOTTOM_CENTER
    }
  };



  var maptmplc = new google.maps.Map(document.getElementById('map-tmplc-canvas'),
    mapOptions);

  var maptmmh = new google.maps.Map(document.getElementById('map-tmmh-canvas'),
    tmmhOptions);

  var maptmnw = new google.maps.Map(document.getElementById('map-tmnw-canvas'),
    tmnwOptions);

  var mapnasa = new google.maps.Map(document.getElementById('map-nasa-canvas'),
    nasaOptions);

  var maptmne = new google.maps.Map(document.getElementById('map-tmne-canvas'),
    tmneOptions);

  var maptmm = new google.maps.Map(document.getElementById('map-tmm-canvas'),
    tmmOptions);

  var maptmscot = new google.maps.Map(document.getElementById('map-tmscot-canvas'),
    tmscotOptions);

  var maptmw = new google.maps.Map(document.getElementById('map-tmw-canvas'),
    tmwOptions);

  var maptms = new google.maps.Map(document.getElementById('map-tms-canvas'),
    tmsOptions);

  var mapire = new google.maps.Map(document.getElementById('map-tmire-canvas'),
    ireOptions
  );

/**
 * Marker Animation
 */

//var iconBase = url;
  // To add the marker to the map, use the 'map' property
markerTMPLC = new google.maps.Marker({
    position: myLatlng,
  icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: maptmplc,
    title:"Trinity Mirror PLC"
    });


// Manchester and Huddersfield Markers

markerTMMH = new google.maps.Marker({
    position: MEN,
  icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: maptmmh,
    title:"Trinity Mirror North West & North Wales"
    });

markerTMMH = new google.maps.Marker({
    position: HUD,
  icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: maptmmh,
    title:"Huddersfield"
    });

// Trinity Mirror North West Wales

markerTMNW = new google.maps.Marker({
    position: LIV,
  icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: maptmnw,
    title:"Liverpool"
    });

markerTMNW = new google.maps.Marker({
    position: SOUTHPORT,
  icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: maptmnw,
    title:"Southport"
    });

markerTMNW = new google.maps.Marker({
    position: CHESHIRE,
  icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: maptmnw,
    title:"Cheshire"
    });

markerTMNW = new google.maps.Marker({
    position: LANDU,
  icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: maptmnw,
    title:"North Wales"
    });

//  NASA

markerNASA = new google.maps.Marker({
    position: NASA,
  icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: mapnasa,
    title:"NASA"
    });

// Trinity Mirror North East

markerTMNE = new google.maps.Marker({
    position: NCJ,
  icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: maptmne,
    title:"NCJ Media"
    });

markerTMNE = new google.maps.Marker({
    position: GMC,
  icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: maptmne,
    title:"Gazette Media Company"
    });

markerTMM = new google.maps.Marker({
    position: BPM,
  icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: maptmm,
    title:"BPM Media"
    });

markerTMM = new google.maps.Marker({
    position: COV,
  icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: maptmm,
    title:"Coventry Newspapers Ltd"
    });

markerTMSCOT = new google.maps.Marker({
    position: MEDSCOT,
  icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: maptmscot,
    title:"Media Scotland"
    });

markerTMW = new google.maps.Marker({
    position: TMW,
  icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: maptmw,
    title:"Media Wales"
    });

// Trinity Mirror South

markerTMS = new google.maps.Marker({
    position: READ,
  icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: maptms,
    title:"Reading"
    });

markerTMS = new google.maps.Marker({
    position: GUILD,
  icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: maptms,
    title:"Reading"
    });

// Ireland

markerIRE = new google.maps.Marker({
    position: belfast,
    icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: mapire,
    title:"Belfast"
    });

markerIRE = new google.maps.Marker({
    position: dublin,
    icon: iconBase + 'trinity_mirror_plc_tag.png',
    draggable: false,
    animation: google.maps.Animation.DROP,
    map: mapire,
    title:"Dublin"
    });

  //Associate the styled map with the MapTypeId and set it to display.
  maptmplc.mapTypes.set('map_style', styledMap);
  maptmplc.setMapTypeId('map_style');
  maptmmh.mapTypes.set('map_style', styledMap);
  maptmmh.setMapTypeId('map_style');
  maptmnw.mapTypes.set('map_style', styledMap);
  maptmnw.setMapTypeId('map_style');
  mapnasa.mapTypes.set('map_style', styledMap);
  mapnasa.setMapTypeId('map_style');
  maptmne.mapTypes.set('map_style', styledMap);
  maptmne.setMapTypeId('map_style');
  maptmm.mapTypes.set('map_style', styledMap);
  maptmm.setMapTypeId('map_style');
  maptmscot.mapTypes.set('map_style', styledMap);
  maptmscot.setMapTypeId('map_style');
  maptmw.mapTypes.set('map_style', styledMap);
  maptmw.setMapTypeId('map_style');
  maptms.mapTypes.set('map_style', styledMap);
  maptms.setMapTypeId('map_style');
  mapire.mapTypes.set('map_style', styledMap);
  mapire.setMapTypeId('map_style');
}




google.maps.event.addDomListener(window, 'load', initialize);


;(function( $ ){

    $('.contacts-menu ul li a').click(function(){
    $('.contacts-menu ul li a').removeClass("contacts-menu-active");
    $(this).addClass("contacts-menu-active");

});


})( jQuery );
