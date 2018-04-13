$(function () {

    $(window).bind("resize", function () {
        console.log($(this).width())
        if ($(this).width() < 768) {
            $('#navbarToggleExternalContent').removeClass('col-md-3 right').addClass('collapse')
            $('#button').show()
        } else {
            $('#navbarToggleExternalContent').removeClass('collapse').addClass('col-md-3 right')
            $('#button').hide()
        }
    }).trigger('resize');
})