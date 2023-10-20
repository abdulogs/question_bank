function clearparams(parameter) {
    var url = window.location.href;
    url =  url.replace(new RegExp('[?&]' + parameter + '=[^&#]*(#.*)?$'), '$1')
        .replace(new RegExp('([?&])' + parameter + '=[^&]*&'), '$1');
    window.history.pushState("", "", url)
}


// Open side nav
$(document).on("click", ".opensidenav", (e) => {
    e.preventDefault();
    $("#sidebar").show();
});

// Close side nav
$(document).on("click", ".closesidenav", (e) => {
    e.preventDefault();
    $("#sidebar").hide();
});



