var _alphabetSearch = '';

$.fn.dataTable.ext.search.push(function(settings, searchData) {
    if (!_alphabetSearch) {
        return true;
    }

    if (searchData[0].charAt(0) === _alphabetSearch) {
        return true;
    }

    return false;
});
$(document).ready(function() {
    // DataTbale
    var table = $('#myTable1').DataTable({
        responsive: true
    });

    var table = $('#table-kunden').DataTable({
        responsive: true,
        sort: false
    });
    var alphabet = $('<div class="alphabet"/>').append('Search: ');
    $('<span class="clear active"/>')
        .data('letter', '')
        .html('All')
        .appendTo(alphabet);
    for (var i = 0; i < 26; i++) {
        var letter = String.fromCharCode(65 + i);
        $('<span/>')
            .data('letter', letter)
            .html(letter)
            .appendTo(alphabet);
    }

    alphabet.insertBefore(table.table().container());

    alphabet.on('click', 'span', function() {
        alphabet.find('.active').removeClass('active');
        $(this).addClass('active');

        _alphabetSearch = $(this).data('letter');
        table.draw();
    });


    var table = $('#table-resp').DataTable({
        responsive: true,
        initComplete: function() {
            this.api().columns().every(function() {
                var column = this;
                var select = $('<select><option value="">All</option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                column.data().unique().sort().each(function(d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        }
    });

    var alphabet = $('<div class="alphabet"/>').append('Search: ');
    $('<span class="clear active"/>')
        .data('letter', '')
        .html('All')
        .appendTo(alphabet);

    for (var i = 0; i < 26; i++) {
        var letter = String.fromCharCode(65 + i);

        $('<span/>')
            .data('letter', letter)
            .html(letter)
            .appendTo(alphabet);
    }

    alphabet.insertBefore(table.table().container());

    alphabet.on('click', 'span', function() {
        alphabet.find('.active').removeClass('active');
        $(this).addClass('active');

        _alphabetSearch = $(this).data('letter');
        table.draw();
    });



    // $('.login-wrapper .page-wrapper').matchHeight();
    var inners = $(".row  .col-md-6 .card-view,.row.profile-wrapper .card-view,.login-wrapper .page-wrapper");
    var maxHeight = 0;
    for (var i = 0; i < inners.length; i++) {
        if (inners[i].offsetHeight > maxHeight)
            maxHeight = inners[i].offsetHeight;
    }
    for (var i = 0; i < inners.length; i++)
        inners[i].style.height = maxHeight + 'px';


});