function EcrireCookiefreecounterstat(nom, valeur, nombre) {
	var argv = EcrireCookiefreecounterstat.arguments;
	var argc = EcrireCookiefreecounterstat.arguments.length;
	var ladate = new Date();
	ladate.setTime(ladate.getTime() + Number(nombre));
	var path = ("/");
	var domain = (argc > 4) ? argv[4] : null;
	var secure = (argc > 5) ? arg[5] : false;
	//toLocaleString
	document.cookie = nom + "=" + escape(valeur) + "; expires=" + ladate.toGMTString() + ((path == null) ? "" : ("; path=" + path)) + ((domain == null) ? "" : ("; domain=" + domain)) + ((secure == true) ? "; secure" : "");
}

function getCookieVal(offset) {
	var endstr = document.cookie.indexOf(";", offset);
	if (endstr == -1)
		endstr = document.cookie.length;
	return unescape(document.cookie.substring(offset, endstr));
}

function GetCookie(name) {
	var arg = name + "=";
	var alen = arg.length;
	var clen = document.cookie.length;
	var i = 0;
	while (i < clen) {
		var j = i + alen;
		if (document.cookie.substring(i, j) == arg)
			return getCookieVal(j);
		i = document.cookie.indexOf(" ", i) + 1;
		if (i == 0)
			break;
	}
	return null;
}

function EcrireCookieGeo(nom, valeur, nombre) {
	var argv = EcrireCookieGeo.arguments;
	var argc = EcrireCookieGeo.arguments.length;
	if (nombre == -1) {
		var ladate = nombre;
		valeur = "";
	} else {
		var ladate = new Date();
		ladate.setTime(ladate.getTime() + Number(nombre) * 1000);
	}
	var expires = (argc > 2) ? argv[2] : null;
	var expires = nombre;
	var path = ("/");
	var domain = (argc > 4) ? argv[4] : null;
	var secure = (argc > 5) ? arg[5] : false;
	document.cookie = nom + "=" + escape(valeur) + "; expires=" + ladate.toUTCString() + ((path == null) ? "" : ("; path=" + path)) + ((domain == null) ? "" : ("; domain=" + domain)) + ((secure == true) ? "; secure" : "");
}

function GetCookiefreecounterstat(name) {
	var arg = name + "=";
	var alen = arg.length;
	var clen = document.cookie.length;
	var i = 0;
	while (i < clen) {
		var j = i + alen;
		if (document.cookie.substring(i, j) == arg)
			return getCookieValfreecounterstat(j);
		i = document.cookie.indexOf(" ", i) + 1;
		if (i == 0)
			break;
	}
	return null;
}

function getCookieValfreecounterstat(offset) {
	var endstr = document.cookie.indexOf(";", offset);
	if (endstr == -1)
		endstr = document.cookie.length;
	return unescape(document.cookie.substring(offset, endstr));
}

var date_init = new Date();
var test_cookie_value_freecounterstat;
var test_cookie_value_freecounterstat_nv;
var init_freecounterstat = 1;
var init_freecounterstat_nv = 1;
var acceptcookiefreecounterstat;

//tester si accepte cookies
acceptcookiefreecounterstat = GetCookiefreecounterstat('acceptcookiefreecounterstat');
if (acceptcookiefreecounterstat == null) {
	date = new Date;
	date.setTime(date.getTime() + 1000);
	EcrireCookiefreecounterstat('acceptcookiefreecounterstat', 'ok', '31536000000');
}
acceptcookiefreecounterstat = GetCookiefreecounterstat('acceptcookiefreecounterstat');

if (acceptcookiefreecounterstat == 'ok') {
	test_cookie_value_freecounterstat = GetCookiefreecounterstat('counter');
	test_cookie_value_freecounterstat_nv = GetCookiefreecounterstat('counter_nv');
	if (test_cookie_value_freecounterstat == null) {
		init_freecounterstat = 0;
		test_cookie_value_freecounterstat = '1bf97226ada7372b30d2932d7e4285d5';
		EcrireCookiefreecounterstat('counter', test_cookie_value_freecounterstat, '52471000');
	}
	if (test_cookie_value_freecounterstat_nv == null) {
		test_cookie_value_freecounterstat_nv = '1bf97226ada7372b30d2932d7e4285d5';
		EcrireCookiefreecounterstat('counter_nv', test_cookie_value_freecounterstat_nv, '31536000000');
		init_freecounterstat_nv = 0;
	}
} else {
	var test_cookie_value_freecounterstat = "no";
	acceptcookiefreecounterstat = 'no';
}
init_freecounterstat = 0;
//div_iframe='<iframe src="http://www.freecounterstat.com/stats_tab/?c=86f9cd832da07225e8b7c4d7eeb13474&base=counter7" frameborder="0" height="355" width="500" marginwidth="0" marginheight="0" scrolling="no"></iframe>';
html_div = '<div id="FCS_86f9cd832da07225e8b7c4d7eeb13474_divFix" style="visibility:hidden;z-index:9999;margin:0px;padding:0px;width:550px;top:33%;left:-500px;position:fixed;"><div id="FCS_86f9cd832da07225e8b7c4d7eeb13474_divCac" style="float:left;background-color:#ccc;margin:0px;padding:0px;width:500px;height:355px;position:absolute;">&nbsp;</div><div id="FCS_86f9cd832da07225e8b7c4d7eeb13474_divCou" style="text-align:center;position:absolute;left:500px;background-color:#ccc;padding-left:2%;padding-top:2%;padding-bottom:2%;padding-right:2%;-moz-box-shadow: 5px 5px 5px 0px #656565;-webkit-box-shadow: 5px 5px 5px 0px #656565;-o-box-shadow: 5px 5px 5px 0px #656565;box-shadow: 5px 5px 5px 0px #656565;filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=134, Strength=5);-webkit-border-top-right-radius:15px;-webkit-border-bottom-right-radius:15px;-moz-border-radius-topright:15px;-moz-border-radius-bottomright:15px;border-top-right-radius: 15px;border-bottom-right-radius: 15px;"><img border="0" src="http://counter7.freecounterstat.com/private/countertab.php?c=86f9cd832da07225e8b7c4d7eeb13474&init=' + date_init.getTime() + '&init_freecounterstat=' + init_freecounterstat + '&library=library_counters&coef=1&type=034&lenght=4&type_result=tabLM" border="0" title="Cantidad de visitantes este mes." /></div></div>';

function getObject(id) {
	var object = null;
	if (document.layers) {
		object = document.layers[id];
	} else if (document.all) {
		object = document.all[id];
	} else if (document.getElementById) {
		object = document.getElementById(id);
	}
	return object;
}

function getDimensions() {
	var winW = 630,
	    winH = 460;
	if (document.body && document.body.offsetWidth) {
		winW = document.body.offsetWidth;
		winH = document.body.offsetHeight;
	}
	if (document.compatMode == 'CSS1Compat' && document.documentElement && document.documentElement.offsetWidth) {
		winW = document.documentElement.offsetWidth;
		winH = document.documentElement.offsetHeight;
	}
	if (window.innerWidth && window.innerHeight) {
		winW = window.innerWidth;
		winH = window.innerHeight;
	}
	return {
		"width" : winW,
		"height" : winH
	}
}

function getOffsetRight(elem) {
	element = getObject(elem)
	var width = element.offsetWidth
	var right = 0;
	while (element.offsetParent) {
		right += element.offsetLeft;
		element = element.offsetParent;
	}
	right += element.offsetLeft;
	right = getDimensions()["width"] - right
	right -= width
	return right
}

var FCS_86f9cd832da07225e8b7c4d7eeb13474_timer;
var FCS_86f9cd832da07225e8b7c4d7eeb13474_left = 0;
var FCS_86f9cd832da07225e8b7c4d7eeb13474_height = 0;
var FCS_86f9cd832da07225e8b7c4d7eeb13474_typecss = "middle";
var FCS_86f9cd832da07225e8b7c4d7eeb13474_typeresult = "tabLM";
var FCS_86f9cd832da07225e8b7c4d7eeb13474_dif = 0;
//onload=function(){
function FCS_86f9cd832da07225e8b7c4d7eeb13474_addLoadEvent(func) {
	var oldonload = window.onload;
	if ( typeof window.onload != 'function') {
		window.onload = func;
	} else {
		window.onload = function() {
			if (oldonload) {
				oldonload();
			}
			func();
		}
	}
}

FCS_86f9cd832da07225e8b7c4d7eeb13474_addLoadEvent(function() {

	FCS_86f9cd832da07225e8b7c4d7eeb13474_left = document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divFix').offsetLeft;
	FCS_86f9cd832da07225e8b7c4d7eeb13474_height = document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divCou').offsetHeight;
	if (FCS_86f9cd832da07225e8b7c4d7eeb13474_typecss == "bottom") {
		if (FCS_86f9cd832da07225e8b7c4d7eeb13474_typeresult == "tabLB") {
			FCS_86f9cd832da07225e8b7c4d7eeb13474_dif = document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divCou').offsetHeight + 15;
			document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divFix').style.bottom = FCS_86f9cd832da07225e8b7c4d7eeb13474_dif + "px";
		} else if (FCS_86f9cd832da07225e8b7c4d7eeb13474_typeresult == "tabRB") {
			//FCS_86f9cd832da07225e8b7c4d7eeb13474_dif=document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divCac').offsetHeight-document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divCou').offsetHeight;
			FCS_86f9cd832da07225e8b7c4d7eeb13474_dif = 15;
			document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divFix').style.bottom = FCS_86f9cd832da07225e8b7c4d7eeb13474_dif + "px";
		}
		FCS_86f9cd832da07225e8b7c4d7eeb13474_dif = (document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divCac').offsetHeight * -1) + document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divCou').offsetHeight;
	} else {
		FCS_86f9cd832da07225e8b7c4d7eeb13474_dif = 0;
	}
	document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divCac').style.top = FCS_86f9cd832da07225e8b7c4d7eeb13474_dif + "px";
	document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divCac').style.backgroundColor = "#EEEEEE";
	document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divCou').style.backgroundColor = "#EEEEEE";
	document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divFix').style.visibility = "visible";
	//}
})
function allerR() {
	var nume = document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divFix')
	nume.style.left = nume.offsetLeft - 10 + 'px'
	if (getOffsetRight('FCS_86f9cd832da07225e8b7c4d7eeb13474_divFix') >= 0) {
		//document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divCac').innerHTML=div_iframe;
		//document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_btSee').onclick=retourR;
		return false
	} else {
		clearTimeout(FCS_86f9cd832da07225e8b7c4d7eeb13474_timer);
		FCS_86f9cd832da07225e8b7c4d7eeb13474_timer = setTimeout(allerR, 10)
	}
}

function retourR() {
	var nume = document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divFix')
	nume.style.left = nume.offsetLeft + 10 + 'px'
	if (nume.offsetLeft >= FCS_86f9cd832da07225e8b7c4d7eeb13474_left) {
		nume.style.left = FCS_86f9cd832da07225e8b7c4d7eeb13474_left + "px";
		document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divCac').innerHTML = "";
		//document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_btSee').onclick=allerR;
		return false
	}
	clearTimeout(FCS_86f9cd832da07225e8b7c4d7eeb13474_timer);
	FCS_86f9cd832da07225e8b7c4d7eeb13474_timer = setTimeout(retourR, 10)
}

function allerL() {
	var nume = document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divFix')
	nume.style.left = nume.offsetLeft + 10 + 'px'
	if (nume.offsetLeft == 0) {
		//document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_btSee').onclick=retourL;
		//document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divCac').innerHTML=div_iframe;
		return false
	}
	if (nume.offsetLeft >= document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divCac').offsetWidth) {
		return false
	} else {
		clearTimeout(FCS_86f9cd832da07225e8b7c4d7eeb13474_timer);
		FCS_86f9cd832da07225e8b7c4d7eeb13474_timer = setTimeout(allerL, 10)
	}
}

function retourL() {
	var nume = document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divFix')
	nume.style.left = nume.offsetLeft - 10 + 'px'
	if (nume.offsetLeft <= -(document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divCac').offsetWidth)) {
		document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_divCac').innerHTML = "";
		//document.getElementById('FCS_86f9cd832da07225e8b7c4d7eeb13474_btSee').onclick=allerL;
		return false
	}
	clearTimeout(FCS_86f9cd832da07225e8b7c4d7eeb13474_timer);
	FCS_86f9cd832da07225e8b7c4d7eeb13474_timer = setTimeout(retourL, 10)
}

var nb_couleur;
if (screen.colorDepth != undefined) {
	nb_couleur = screen.colorDepth;
} else if (screen.pixelDepth != undefined) {
	nb_couleur = screen.pixelDepth;
} else {
	nb_couleur = 0;
}
var browser = parseInt(navigator.appVersion);
if (browser >= 4) {
	var resolution = (screen.height + "*" + screen.width)
} else {
	var resolution;
}
if (navigator.appName.indexOf("Microsoft Internet Explorer") != -1) {
	langue = navigator.systemLanguage;
} else {
	langue = navigator.language;
}
langue = langue.substring(0, 2);
var date_freecounterstat = new Date();

var ref = document.referrer;
var bro_nom = "firefox";
//if (ref.indexOf(".swf")!=-1 && bro_nom.indexOf("chrome")!=-1){
//ref="";
//ref="NULL";

html_div += '<img style="border:none" src = "http://counter7.allfreecounter.com:8080/private/pointeur/pointeur.gif?|86f9cd832da07225e8b7c4d7eeb13474|' + escape(resolution) + '|' + escape(langue) + '|' + escape(nb_couleur) + '|' + Math.round(date_freecounterstat.getTime() / 1000) + '|' + test_cookie_value_freecounterstat + '|computer|windows|7|firefox|37|Costa+Rica|CR|9.933300|-84.083298|San+Jos%E9|Amnet+Cable+Costa+Rica|-21600|' + init_freecounterstat_nv + '|1428506729|' + acceptcookiefreecounterstat + '|' + escape(document.URL) + '|' + escape(ref) + '|js|186.176.15.226|||&init=' + date_init.getTime() + '" border="0"  width="1" height="1">';

with (document) write(html_div);
;