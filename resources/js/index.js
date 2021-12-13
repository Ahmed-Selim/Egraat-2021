
$(document).ready(function () {

    $("#msg").insertAfter("nav");

    var $repairSection= $('#repair_section'),
        $equipment = $('#equipment_id'),
        $records_book = $('#records_book') 
        $record_book_abbr = $("#record_book_abbr");
        
    $record_book_abbr.text($records_book.find(':selected').data('abbr'));

    toggleCondition();

});

function save_pdf() {
    var opt = {
        margin: 0.10,
        filename: 'Egraat.pdf',
        jsPDF: { unit: 'in', format: 'a4'}
    } ;
    const main = document.getElementById('main') ;
    html2pdf().set(opt).from(main).save() ;
}

function _copy(tid) {
    // console.log(typeof tid);
    window.getSelection().removeAllRanges();
    var range = document.createRange();
    range.selectNode(tid);
    window.getSelection().addRange(range);
    document.execCommand('copy');
}

$('.format_date').each(function () {
    function pad(s) { return (s < 10) ? '0' + s : s; }
    var d = new Date($(this).text()) ;
    if ( d instanceof Date && !isNaN(d)) {
        $(this).text([pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('\\')) ;
    }
})

$(".toast").ready(function(){
    $msg = $(".toast") ;
    $msg.parent().addClass("position-absolute");
    $msg.addClass("show").delay(3000).slideUp("slow");
});

$('#records_book').change(function() {
    $record_book_abbr.text($('#records_book').find(':selected').data('abbr'));
    console.log("Ahmed");
});

$('#equipment_id').change(function(){
    var $repairSection= $('#repair_section'),
        $equipment = $('#equipment_id'),
        $records_book = $('#records_book') 
        $record_book_abbr = $("#record_book_abbr");
    
    $repairSection.val($equipment.val());
    // $records_book.val($equipment.val());
    // $record_book_abbr.text($records_book.find(':selected').data('abbr'));
}) ;

$("#military_unit").change(function() {
    var $unit = $("#military_unit"), 
        $MilitaryOthers = $("#military_unit_others"), 
        $Militarybrigade = $("#military_brigade"),
        $Militarybattalion = $("#military_battalion");

    if ($unit.val() == "1") {
        $Militarybrigade.parent().attr("hidden", true);    
        $Militarybattalion.parent().attr("hidden", true);
        $MilitaryOthers.parent().removeAttr("hidden");    
        $MilitaryOthers.val("");    
        $MilitaryOthers.prop('required', true);    
        $("#military_battalion").removeAttr("required");
        $Militarybrigade.removeAttr("required");    
    } else {
        $Militarybrigade.find("option.selectOpt").remove();;
        getBrigades($unit.val());
        $MilitaryOthers.parent().attr("hidden", true);    
        $MilitaryOthers.removeAttr("required");    
        $Militarybrigade.parent().removeAttr("hidden");    
        $Militarybrigade.val("");    
        $Militarybattalion.val("");    
        $Militarybrigade.prop("required", true);    
    }
}) ;

$("#military_brigade").change(function () {
    $Militarybrigade = $("#military_brigade");
    $Militarybattalion = $("#military_battalion");
    $Militarybattalion.find("option.selectOpt").remove();
    getBattalions($Militarybrigade.val());
    $Militarybattalion.parent().removeAttr("hidden");
    $Militarybattalion.val("");
    $Militarybattalion.prop("required", true);
});

$("#equipment_condition_id").change(function () {
    toggleCondition() ;
})

function toggleCondition() {
    switch ($("#equipment_condition_id").val()) {
        case "3":
            $("#delivery").removeAttr("hidden") ;
            $("#repair_date").parent().removeAttr("hidden") ;
            $("#delivery_date").prop("required", true);
            $("#delegate_m_number").prop("required", true);
            $("#repair_date").prop("required", true);
            $("#delegate_name").prop("required", true);
            break;
        
        case "2":
            $("#delivery").attr("hidden", true) ;
            $("#repair_date").parent().removeAttr("hidden") ;
            $("#repair_date").prop("required", true);
            $("#delivery_date").removeAttr("required");
            $("#delegate_m_number").removeAttr("required");
            $("#delegate_name").removeAttr("required");
            break;
    
        default:
            $("#repair_date").parent().attr("hidden", true) ;
            $("#delivery").attr("hidden", true) ;
            $("#delivery_date").removeAttr("required");
            $("#delegate_m_number").removeAttr("required");
            $("#delegate_name").removeAttr("required");
            $("#repair_date").removeAttr("required");
            break;
    }
}

function getBrigades(val) {
	// $.ajax({
	// 	type: "POST",
	// 	url: "./ajax-unit.php",
	// 	data:'group='+val,
	// 	success: function(data){
    //        $('#military_brigade').append(data);
	// 	}
	// });
    $.post("./../../views/app/ajax-unit.php", 'group='+val,
        function (data, textStatus, jqXHR) {
            $('#military_brigade').append(data);
        }
    );
}

function getBattalions(val) {
	// $.ajax({
	// 	type: "POST",
	// 	url: "./ajax-unit.php",
	// 	data:'brigade='+val,
	// 	// beforeSend: function() {
	// 	// 	$("#city-list").addClass("loader");
	// 	// },
	// 	success: function(data){
    //        $('#military_battalion').append(data);
	// 	}
	// });

    $.post("./../../views/app/ajax-unit.php", 'brigade='+val,
        function (data, textStatus, jqXHR) {
            $('#military_battalion').append(data);
        }
    );
}


// Fetch all the forms we want to apply custom Bootstrap validation styles to
const forms = document.querySelectorAll('.needs-validation');

// Loop over them and prevent submission
Array.prototype.slice.call(forms).forEach((form) => {
    form.addEventListener('submit', (event) => {
    if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
    }
    form.classList.add('was-validated');
    }, false);
});
