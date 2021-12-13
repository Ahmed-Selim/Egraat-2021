<?php

include_once __DIR__.'./../app/header.php' ;
require_once __DIR__.'./inquery-records.service.php' ;

?>
<div class="row justify-content-around my-3" data-html2canvas-ignore="true">
  <h4 dir="rtl" class="text-center col-5">استعلام عن إذن شغل</h4>
  <button type="button" class="fw-bolder btn btn-outline-primary col-5" 
    onclick="$('form').toggleClass('d-none')" data-html2canvas-ignore='true'>
    اعادة البحث <i class="fa fa-search" aria-hidden="true"></i>
  </button>
</div>

<form action="" method="POST" role="form" name="form" novalidate data-html2canvas-ignore="true"
        class="border border-3 border-primary rounded text-center needs-validation d-none mb-2">
    <div class="row justify-content-around mt-3 ms-0">
      <div class="form-group">
        <label for="equip">المعدات</label>
        <select multiple size="5" class="form-select align-middle mx-3 w-50 d-none" name="equip[]" 
            id="equip">
          <?= getEquipments() ?>
        </select>
        <div class="form-check d-inline-block">
          <input class="form-check-input" type="checkbox" id="all" name="all" value="true" checked>
          <label class="form-check-label" for="all">
            الكل
          </label>
        </div>
      </div>
    </div>
    <div class="d-inline-flex justify-content-around mt-3 form-group ms-0 col-8">
      <!-- <label for="equipment_condition_id" class="col-7 align-self-center">موقف المعدة</label> -->
      <div class="form-check form-check-inline col-4 align-self-center">
        <label class="form-check-label col-7 align-self-center">
          <input class="form-check-input" type="checkbox" name="cond" id="cond" value="true"> موقف المعدة
        </label>
      </div>
      <select name="equipment_condition_id" id="equipment_condition_id" class="form-select" hidden>
        <option value="" selected disabled>اختر موقف المعدة ...</option>
        <?php getEquipmentConditions(); ?>
      </select>
    </div>

    <div class="justify-content-around mt-3 ms-0 row">
        <!-- <label class="align-self-center">تاريخ إذن الشغل</label> -->
        <div class="form-check form-check-inline">
            <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="date" id="date" value="true"> تاريخ إذن الشغل
          </label>
        </div>
      <div class="col-5" hidden>
        <label for="date_from" class="align-self-center">من</label>
        <input type="date" name="date_from" id="date_from" class="form-select" min="2021-07-01">
        <small class="text-muted"> صيغة التاريخ [يوم-شهر-سنة] , بعد يوم 01-07-2021 </small>
      </div>
      <div class="col-5" hidden>
        <label for="date_to" class="align-self-center">الى</label>
        <input type="date" name="date_to" id="date_to" class="form-select" min="2021-07-01">
        <small class="text-muted"> صيغة التاريخ [يوم-شهر-سنة] , بعد يوم 01-07-2021 </small>
        <div class="invalid-feedback">
          تاريخ (بعد) يجب الا يسبق تاريخ (من)!
        </div>
      </div>
    </div>

    <div class="row justify-content-around mt-3 ms-0">
      <div class="form-check form-check-inline">
          <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="unit" id="unit" value="true"> الوحدة
        </label>
      </div>
      <div class="form-group col-3" hidden>
        <label for="military_unit">الفرقة/اخرى</label>
        <select name="unit_id[]" id="military_unit" class="form-select">
          <option value="" selected disabled>اختر الفرقة/اخرى ...</option>
          <?php getMilitaryUnits(); ?>
          <option value="1">وحدات اخرى</option>
        </select>
      </div>
      <div class="form-group col-6" hidden>
        <label for="military_unit_others">وحدات اخرى</label>
        <select name="unit_id[]" id="military_unit_others" class="form-select">
          <option value="" selected disabled>اختر وحدات اخرى ...</option>
          <?php getOtherMilitaryUnits(); ?>
        </select>
      </div>
      <div class="form-group col-3" hidden>
        <label for="military_brigade">اللواء</label>
        <select name="military_brigade" id="military_brigade" class="form-select">
          <option value="" selected disabled>اختر اللواء ...</option>
        </select>
      </div>
      <div class="form-group col-3" hidden>
        <label for="military_battalion">الكتيبة</label>
        <select name="unit_id[]" id="military_battalion" class="form-select">
          <option value="" selected disabled>اختر الكتيبة ...</option>
        </select>
      </div>
    </div>

    <div class="row justify-content-around my-4 ms-0">
      <button type="submit" class="btn btn-outline-primary py-3 col-4" name="search">
       بحث <i class="fa fa-search" aria-hidden="true"></i>
    </button>
    </div>
    
</form>


<?php if(isset($_POST['search'])): ?>
<div class="text-center mb-2 justify-content-around row" data-html2canvas-ignore="true">
  <div class='row justify-content-center'>
    <h4 dir='rtl' class='text-center display-5 font-monospace col-auto'>نتائج البحث :</h4>
    <button onclick='save_pdf()' class='btn btn-primary px-3 my-3 col-auto'>
      حفظ <i class='fa fa-save' aria-hidden='true'></i>
    </button> 
  </div>
  <!-- <button onclick='_copy(tb)' class="btn btn-primary px-3 col-5">
     نسخ <i class="fa fa-copy" aria-hidden="true"></i>
  </button> -->
</div>
<table class="table table-bordered border-dark table-hover text-center mb-5 bg-gradient 
  bg-light shadow fw-bolder"   dir="rtl" id="tb">
<thead class="border-2">
    <tr>
      <th scope="col">م</th>
      <th scope="col">رقم إذن الشغل</th>
      <th scope="col">تاريخ إذن الشغل</th>
      <th scope="col">اسم المعدة</th>
      <th scope="col">اسم الوحدة</th>
      <th scope="col">موقف المعدة</th>
      <th scope="col">تاريخ الاصلاح</th>
      <th scope="col">تاريخ التسليم</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $num_rows = display_records($_POST) ;
    ?>
  </tbody>
  <tfoot>
    <tr>  
      <td colspan=8 class="display-6">
        الكمية : <strong><?php echo $num_rows-1 ; ?></strong>
      </td>
    </tr>
  </tfoot>
</table>
<?php endif ?>

<?php include_once './../app/footer.php' ; ?>

<script>
$('#date').change(function(){
    $('#date_from').parent().prop("hidden", !$('#date').prop('checked')) ;
    $('#date_to').parent().prop("hidden", !$('#date').prop('checked')) ;
    $('#date_from').prop("required", $('#date').prop('checked')) ;
    $('#date_to').prop("required", $('#date').prop('checked')) ;
});
  
$('#cond').change(function(){
    $('#equipment_condition_id').prop("hidden", !$('#cond').prop('checked')) ;
    $('#equipment_condition_id').prop("required", $('#cond').prop('checked')) ;
});
  
$('#all').change(function(){
    $('#equip').toggleClass("d-inline", !$('#all').prop('checked')) ;
    $('#equip').toggleClass("d-none", $('#all').prop('checked')) ;
    $('#equip').prop("required", !$('#all').prop('checked')) ;
});
  
$('#unit').change(function(){
  if ($('#unit').prop('checked') == false) {
    $('#military_unit_others').parent().prop("hidden", true) ;
    $('#military_brigade').parent().prop("hidden", true) ;
    $('#military_battalion').parent().prop("hidden", true) ;
    $('#military_unit').parent().prop("hidden", true) ;
    $('#military_unit').prop("required", false) ;
    $('#military_unit_others').prop("required", false) ;
    $('#military_brigade').prop("required", false) ;
    $('#military_battalion').prop("required", false) ;
  } else {
    $('#military_unit').prop("required", true) ;
    $('#military_unit').parent().prop("hidden", false) ;
    }
});

$('#date_from').change(function(){
  // $('#date_to').parent().prop("hidden", !$('#date_from').prop('hidden')) ;
  $('#date_to').prop("min", $('#date_from').val()) ;
});

// $('#date_from').change(function(){
//   console.log($('#date').prop('checked') == true);
//   $('#date_from').parent().prop("hidden", !$('#date').prop('checked')) ;
//   $('#date_to').parent().prop("hidden", !$('#date').prop('checked')) ;
// });
</script>