
    if ( $(window).width() <= 600) {
        $('#centerbar').css('display', 'block');
        $('#sidebar').css('display', 'none');
    } else {
        $('#centerbar').css('display', 'none');
        $('#sidebar').css('display', 'block');
    }

    
$(window).resize( function () { 
    if ( $(window).width() <= 600) {
        $('#centerbar').css('display', 'block');
        $('#sidebar').css('display', 'none');
    } else {
        $('#centerbar').css('display', 'none');
        $('#sidebar').css('display', 'block');
    }
});
