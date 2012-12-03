var elid = "#acg_lbcf_div";

function acg_lbcf_pop(postid) {
	lbcf_showLoading();
	jQuery.post(
		acgAjax.ajaxurl,
		{
			action: "acgAjax-submit",
			postID: acgAjax.postID,
			acg_popup: 1,
			postNonce: acgAjax.postNonce
		},
		function(data) {
			lbcf_response(data);
		}
	);
}

function acg_lbcf_submit(el) {
	var elid = ".input" + el;
	var url = "", sel = "?";
	var i, pname, param;
	jQuery(elid).each(function() {
		var el = jQuery(this);
		if (el.attr("type") == "checkbox" ) {
			pname = (el.attr("checked")) ? el.attr("name") : ""
			param = (el.attr("checked")) ? "checked" : "";
		} else if (el.attr("type") == "radio") {
			pname = (el.attr("checked")) ? el.attr("name") : ""
			param = (el.attr("checked")) ? el.val() : "";
		} else {
			pname = el.attr("name");
			param = el.val();
		}
		url += (pname) ? sel + pname + "=" + encodeURIComponent(param) : "";
		sel = "&";
	});
	jQuery.post(
		acgAjax.ajaxurl + url,
		{
			action: "acgAjax-submit",
			postID: acgAjax.postID,
			acg_popup: 1,
			postNonce: acgAjax.postNonce
		},
		function(data) {
			lbcf_response(data);
		}
	);
	return false;
}

// *** STATE CHANGE HANDLER ***
lbcf_response=function (str) {
	if (str.indexOf("|")>0 && str.indexOf("|")<3) {
		var resptext = str.split("|");
		jQuery(elid).html ("<h3>" + resptext[1] + "</h3>");
		if (resptext[0]=="1") {
			setTimeout(function() {lbcf_hideLoading();}, 3000);
		}
	} else {
		jQuery(elid).html(str);
	}
}

var moveint;
var refreshid;

if (document.images) {
  pic1= new Image(30,30); 
  pic1.src="images/loading.gif"; 
}

var lbcf_showLoading = function() {
	var ls = jQuery("#acg_lbcf_blur");
	var top = "200";
	var ld = jQuery("acg_lbcf_div");
	
	var height = lbcf_getSize();
	var top = lbcf_getScrollXY();
	ls.top = top + "px";
	ls.height = height + "px";
	ld.top = height + "px";
	ld.innerHTML='<p class=\"loading\">Loading Form...</p>';
	jQuery("#acg_lbcf_blur").fadeIn('slow');
	jQuery("#acg_lbcf_div").fadeIn('slow');
	moveint = setInterval("lbcf_moveBlur()", 10);
}

var lbcf_hideLoading = function() {	
	jQuery("#acg_lbcf_blur").fadeOut('slow');
	jQuery("#acg_lbcf_div").fadeOut('slow');
}

function lbcf_getSize(x) {
  var myWidth = 0, myHeight = 0;
  if( typeof( window.innerWidth ) == 'number' ) {
    //Non-IE
    myWidth = window.innerWidth;
    myHeight = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+ in 'standards compliant mode'
    myWidth = document.documentElement.clientWidth;
    myHeight = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    myWidth = document.body.clientWidth;
    myHeight = document.body.clientHeight;
  }
  if (x) {
  	return [myWidth];
  } else {
  	return [myHeight];
  }
}

function lbcf_getScrollXY(x) {
  var scrOfX = 0, scrOfY = 0;
  if( typeof( window.pageYOffset ) == 'number' ) {
    //Netscape compliant
    scrOfY = window.pageYOffset;
    scrOfX = window.pageXOffset;
  } else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
    //lbcf_Dom compliant
    scrOfY = document.body.scrollTop;
    scrOfX = document.body.scrollLeft;
  } else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
    //IE6 standards compliant mode
    scrOfY = document.documentElement.scrollTop;
    scrOfX = document.documentElement.scrollLeft;
  }
  if (x) {
  	return [ scrOfX ];
  } else {
	return [ scrOfY ];
  }
}

function lbcf_moveBlur() {
	var el = jQuery("#acg_lbcf_blur");
	if (el!=null) {
		var height = lbcf_getSize();
		var top = lbcf_getScrollXY();
		el.css("top", top+"px");
		el.css("height", height+"px");
		el = jQuery("#acg_lbcf_div");
		if (el!=null) {
			top=parseInt(top);
			top+=(parseInt(height)/2)-150;
			el.css("top", top+"px");
		}
	}
}

