$(function () {
    let $ratingRowEmpty = $(".rating");
    $ratingRowEmpty.mouseenter(function (event) {
        $elm = $(event.currentTarget);
        $elm.find('.rating-row-full').hide();
    });
    $ratingRowEmpty.mousemove(function (event) {
        $elm = $(event.currentTarget);
        let percent = Math.round(event.offsetX / $elm.width() * 10) * 10;
        $elm.find('.rating-row-hover').css('width', percent + '%');
    });
    $ratingRowEmpty.mouseleave(function (event) {
        $elm = $(event.currentTarget);
        $elm.find('.rating-row-full').show();
        $elm.find('.rating-row-hover').width(0);
    });
    $ratingRowEmpty.click(function (event) {
        $elm = $(event.currentTarget);
        let stars = Math.round(event.offsetX / $elm.width() * 10) / 2;

        $.post($elm.data('url'), {rating: stars}, function (returnValue) {
            $elm.find('.rating-row-full').css('width', (returnValue * 20) + '%');
        });
    });
});