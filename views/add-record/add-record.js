$('#record_date').change(function () { 
    $('#repair_date').prop("min", $('#record_date').val()) ;
    $('#delivery_date').prop("min", $('#record_date').val()) ;
    $('#record_year').val((new Date($('#record_date').val())).getFullYear()) ;
});

$('#repair_date').change(function () {
    $('#delivery_date').prop("min", $('#record_date').val()) ;
});

$('#records_book').change(function(){
    const book = $('#records_book').val() ; 
    $.get("./../app/ajax-unit.php", "book=" + book ,
        function (data, textStatus, jqXHR) {
            $('#equipment_id')
                .empty()
                .append("<option value='' selected disabled>اختر المعدة ...</option>")
                .append(data) ;
        }
    );
});