
function getRid(id) {
    // $('#deleteModal').modal('show')
    let rid =  $('#record_book_abbr').text() + ' ' + $('#record_id').val() ;
    // $('.modal-body strong').text(rid) ;
    let msg = "أنت على وشك حذف اذن الشغل "+ rid +"\nهذه العملية لا رجعة فيها, هل تريد المتابعة ؟" ;
    if (confirm(msg)) {
        $.post("./display-record.php", 'del='+ id);
    }
}

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