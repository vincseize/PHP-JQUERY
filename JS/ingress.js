// ==UserScript==
// @id             iitc-plugin-highlight-my-portals@vincseize
// @name           IITC plugin: K My Portals
// @author         Vincseize
// @category       Highlighter
// @version        0.1
// @namespace      https://github.com/jonatkins/ingress-intel-total-conversion
// @updateURL      https://github.com/vincseize/Ingress/blob/master/KMyPortals.js
// @downloadURL    https://github.com/vincseize/Ingress/blob/master/KMyPortals.js
// @description    [vincseize-2015-12-16-154202] Use the portal fill color to show My Portal
// @include        https://www.ingress.com/intel*
// @include        http://www.ingress.com/intel*
// @match          https://www.ingress.com/intel*
// @match          http://www.ingress.com/intel*
// @include        https://www.ingress.com/mission/*
// @include        http://www.ingress.com/mission/*
// @match          https://www.ingress.com/mission/*
// @match          http://www.ingress.com/mission/*
// @grant          none
// ==/UserScript==


function wrapper(plugin_info) {
// ensure plugin framework is there, even if iitc is not yet loaded
if(typeof window.plugin !== 'function') window.plugin = function() {};

//PLUGIN AUTHORS: 

//END PLUGIN AUTHORS NOTE



// disable vanilla JS
window.onload = function() {};    
    
// rescue user data from original page

var searchString = 'nickname';
var source = document.getElementsByTagName('html')[0].innerHTML;
var found = source.search(searchString);
//console.log('nickname OK : ' + found);   
var start = source.indexOf(searchString);
//console.log('nickname position : ' + start); 
var searchString = '}'; 
// var PLAYER = {"min_ap_for_next_level": "8400000", "min_ap_for_current_level": "6000000", "energy": 9198, 
// "team": "RESISTANCE", "verified_level": 11, "ap": "8021854", "available_invites": 252, "xm_capacity": "14500", "nickname": "karlova"};
var end = source.indexOf(searchString, start);
//console.log('end : ' + end);
var resToParse = source.substring(start,end); // nickname": "karlova"
//console.log('resToParse : ' + resToParse);   
var name_tmp = resToParse.split(":")[1];    
var name_tmp = name_tmp.trim(); 
//console.log('name_tmp : ' + name_tmp);  // "karlova"   
var name = name_tmp.slice(1,-1); 
//console.log('name : ' + name);   
//console.log('----------');     

    
/*    

// var toto = source.match(/nickname=(.*?)}/i)[1];  
var toto = source.match(/nickname=(.+)\}/)[1];
   
console.log('toto : ' + toto);   
console.log('----------');
  
var toto = source.split('nickname')[1].split(';')[0];    
//console.log('toto : ' + toto);
    
console.log('----------');   
    
*/
    

    
// PLUGIN START ////////////////////////////////////////////////////////

// use own namespace for plugin
window.plugin.portalHighlighterMyPortal = function() {};

    
    /*
  var data_portals_data = window.portals[guid].options.data;
  console.log(data_portals_guid);
  var data_portals_timestamp = window.portals[guid].options.timestamp;
  console.log(MYplayerGUID);
    */
    
 
    
    
window.plugin.portalHighlighterMyPortal.highlight = function(data) {
    

    //console.log('name : ' + name);   
    //console.log('----------'); 
    
     //var MYplayerGUID = PLAYER.guid;
    //console.log(MYplayerGUID);
    
    var d_data = data.portal.options.data;
    console.log('d_data : ' + d_data);
    
    var guid = data.portal.options.guid;
    console.log('guid : ' + guid)
     
    //var details = data.portal.options.details;
    //console.log('details : ' + details);   
   
    //var capturedTime = data.captured.capturedTime;
    //console.log('capturedTime : ' + capturedTime)
    
    var health = d_data.health;
    //console.log('health : ' + health)
    
    // var portalName = d_data.title;
    // console.log(portalName);  
    
    //var recordedDate = d_data.recordedDate
    // console.log(recordedDate);
    
    // var coord = data.portal.getLatLng();
    // console.log(coord);
    var thisPortal = {
        'portal': data.portal,
        // 'guid': d_data.portal.guid,
        // 'name': d_data.name,
        //'lat': coord.lat,
        //'lng': coord.lng,
    };
    console.log('Class thisPortal : ');
    console.log(thisPortal);
    // console.log(thisPortal.guid);
    
    
    
     //var d_details = data.portal.options.details;
    //console.log(d_details);
    
    //var portalOwnerId = '';
    //var portalOwnerId = d_details.captured.capturingPlayerId;
    //console.log(portalOwnerId);

    
    


    
    
    
    
    
    
    
  if(health !== undefined && data.portal.options.team != TEAM_NONE && health < 100) {
    var color,fill_opacity;
    if (health > 95) {
      color = 'yellow';
      fill_opacity = (1-health/100)*.50 + .50;
    } else if (health > 75) {
      color = 'DarkOrange';
      fill_opacity = (1-health/100)*.50 + .50;
    } else if (health > 15) {
      color = 'red';
      fill_opacity = (1-health/100)*.75 + .25;
    } else {
      color = 'magenta';
      fill_opacity = (1-health/100)*.75 + .25;
    }

    var params = {fillColor: color, fillOpacity: fill_opacity};
    data.portal.setStyle(params);
  }
}

var setup =  function() {
  window.addPortalHighlighter('K My Portals', window.plugin.portalHighlighterMyPortal.highlight);
}

// PLUGIN END //////////////////////////////////////////////////////////


setup.info = plugin_info; //add the script info data to the function as a property
if(!window.bootPlugins) window.bootPlugins = [];
window.bootPlugins.push(setup);
// if IITC has already booted, immediately run the 'setup' function
if(window.iitcLoaded && typeof setup === 'function') setup();
} // wrapper end
// inject code into site context
var script = document.createElement('script');
var info = {};
if (typeof GM_info !== 'undefined' && GM_info && GM_info.script) info.script = { version: GM_info.script.version, name: GM_info.script.name, description: GM_info.script.description };
script.appendChild(document.createTextNode('('+ wrapper +')('+JSON.stringify(info)+');'));
(document.body || document.head || document.documentElement).appendChild(script);


