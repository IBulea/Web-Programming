var mcVM_options = {
    menuId: "menu-v",
};
init_v_menu(mcVM_options);

function init_v_menu(a) {
    /*attache an event handler to the window*/
    if (window.addEventListener) window.addEventListener("load", function() {
        start_v_menu(a)
    });
    else window.attachEvent && window.attachEvent("onload", function() {
        start_v_menu(a)
    })
}


function start_v_menu(i) {
    var e = document.getElementById(i.menuId),
        j = e.offsetHeight,
        b = e.getElementsByTagName("ul"),
        g = /Firefox|MSIE|Chrome/.test(navigator.userAgent);
   
    for (a = 0; a < b.length; a++) {
        var c = b[a].parentNode;
        c.getElementsByTagName("a")[0].className += "onearrow";
        b[a].style.left = c.offsetWidth + "px";
        b[a].style.top = c.offsetTop + "px";
        c.onmouseover = function() {
            this.className = "ihover";
            var a = this.getElementsByTagName("ul")[0];
            if (a) {
                a.style.visibility = "visible";
                a.style.display = "block"
            }
        };
        c.onmouseout = function() {
            if (g) this.className = "";
            this.getElementsByTagName("ul")[0].style.visibility = "hidden";
            this.getElementsByTagName("ul")[0].style.display = "none"
        }
    }
 
}