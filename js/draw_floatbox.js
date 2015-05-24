
jQuery(window).load(function() {
    jQuery(".floatBox").hide();
});

jQuery(window).scroll(function(e){
    var scrollPercentage = ( jQuery(this).scrollTop() + jQuery(this).height() ) / jQuery('body').height();
    //if(scrollPercentage > 0.5 && getCookie('subscribe_box_closed') != 1){
    if(scrollPercentage > 0.5 &&  jQuery(".floatBox").data('box_is_closed') != true ){
        jQuery(".floatBox").fadeIn("slow");
    }
});

jQuery(".floatBoxClose").click(function(){
    jQuery(".floatBox").fadeOut("fast");
    jQuery(".floatBox").data('box_is_closed', true);
    //setCookie("subscribe_box_closed", 1, 1);
});



function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}
