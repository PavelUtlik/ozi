require('./bootstrap');

$( document ).ready(function() {

    $('.btn-sort').on('click', function () {

       let subject = $(this).data('subject'),
           type = $(this).data('type'),

       $cards = $('.card');

       $cards = customSort($cards, subject, type);
       $('#posts').empty();
       $.each($cards, function (key, item) {
           $('#posts').append(item);
       });

    });


});


function customSort(items, sortSubject, sortBy) {

    if (sortBy === 'asc') {
        items.sort(function (a, b) {
            return $(a).data(sortSubject) - $(b).data(sortSubject);
        });

        return items;
    }

    if (sortBy === 'desc') {
        items.sort(function (a, b) {
            return $(b).data(sortSubject) - $(a).data(sortSubject);
        });

        return items;
    }


}

