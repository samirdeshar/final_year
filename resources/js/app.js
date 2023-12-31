require('./bootstrap');

$(document).on('click', '.delete-form', function(e) {
    e.preventDefault();

    let clicked = confirm('Are You Sure Want To Delete !');

    if (clicked) {
        $(this).parent().find('form').submit();
    }
});

$(document).on('click', '.delete-destination', function(e) {
    e.preventDefault();

    let clicked = confirm('Are You Sure Want To Delete !');

    if (clicked) {
        $(this).parent().find('form').submit();
    }
});









    $(document).ready( function () {
    $('.table').DataTable();
    } );



$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});


