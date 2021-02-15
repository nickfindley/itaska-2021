// $(window).scroll(function() {
//     var $grid = $('.masonry-container').masonry({
//         itemSelector: '.masonry-block',
//         columnWidth: '.masonry-block',
//         percentPosition: true
//     });

//     $('.masonry-container').masonry('layout');
// });

// $(window).on('scroll', function(){
//     window.dispatchEvent(new Event('scroll'));
// });

function scrollResetLayout() {
    var $grid = $('.masonry-container').masonry({
        itemSelector: '.masonry-block',
        columnWidth: '.masonry-block',
        percentPosition: true
    });

    $('.masonry-container').masonry('layout');
};

var scrollcount = 0
function scrollListener(){
    setTimeout(function(){
        scrollcount ++
        if (scrollcount < 2) {
            scrollResetLayout();
            window.removeEventListener("scroll", scrollListener);
        }
    }, 1200);
};
window.addEventListener("scroll", scrollListener);