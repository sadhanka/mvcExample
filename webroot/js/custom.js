$('.confirm').click(function() {
    $(this).removeClass('confirm');
    $(this).text("Sure?");
    $(this).unbind();
    return false;
});