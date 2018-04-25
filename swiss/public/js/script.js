$(function () {

    $(window).bind("resize", function () {
        console.log($(this).width())
        if ($(this).width() < 768) {
            $('#navbarToggleExternalContent').removeClass('col-md-3 right').addClass('collapse')
            $('#button').show()
            $('#logo').removeClass('masthead-brand').addClass('masthead-brand2')
        } else {
            $('#navbarToggleExternalContent').removeClass('collapse').addClass('col-md-3 right')
            $('#button').hide()
            $('#logo').removeClass('masthead-brand2').addClass('masthead-brand')
        }
    }).trigger('resize');
})