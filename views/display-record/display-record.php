<?php

 include_once __DIR__.'./../app/header.php' ;
 require_once __DIR__.'./display-record.service.php' ;
 require_once __DIR__.'./../../database/record-class.php' ;
 require_once __DIR__.'./../../database/modules/records-module.php' ;

  $record = (new RecordModule())->get_record((int)$_GET['record_id']) ;
  $del = false ;

  if (isset($_POST['edit'])) {
    $record->updateRecord($_POST) ;
    $record = update_record($record) ;
  }
  
  if (isset($_POST['del'])) {
    
    $del = delete_record($_POST['del']) ;
    // if ( $del ) {
    //   $_SESSION['msg'] =  "تم حذف إذن الشغل بنجاح";
    //   $_SESSION['msg_title'] =  "تهانينا!";
    //   $_SESSION['msg_type'] =  "success";
    // } else {
    //     $_SESSION['msg'] =  "لم يتم حذف اذن الشغل";
    //     $_SESSION['msg_title'] =  "نأسف!";
    //     $_SESSION['msg_type'] =  "danger";
    // };
  }
  
  if (isset($_GET['record_id'])) {
    $record = (new RecordModule())->get_record((int)$_GET['record_id']) ;
  }

  // if (isset($_GET['del'])) {
  //   if ($_GET['del'] == '0') {
  //     $_SESSION['msg'] =  "لم يتم حذف اذن الشغل";
  //     $_SESSION['msg_title'] =  "نأسف!";
  //     $_SESSION['msg_type'] =  "danger";
  //   }
  //   $record = (new RecordModule())->get_record((int)$_GET['record_id']) ;
  // }
?>

<?php if (!$del): ?>
<div class='row justify-content-center my-2'>
    <h4 dir='rtl' class='text-center font-monospace col-auto'>عرض إذن شغل</h4>
    <button onclick='save_pdf()' class='btn btn-primary px-3 col-auto' data-html2canvas-ignore='true'>
      حفظ <i class='fa fa-save' aria-hidden='true'></i>
    </button> 
</div>

<section dir="rtl" class="container-fluid px-3">
  <form action="<?php //echo $_SERVER['PHP_SELF'] ; ?>" method="POST" role="form" name="form"
        class="border border-3 border-primary rounded text-center needs-validation" novalidate >
      <input type="hidden" name="id" value="<?=$record->id ;  ?>">
    <div class="row justify-content-around mt-3">
      <div class="form-group col-3">
        <label for="records_book" class="form-label">دفتر</label>
        <select name="records_book" id="records_book" class="form-select">
          <option value="" disabled>اختر دفتر ...</option>
          <?php getRecordBook($record->record_book); ?>
        </select>
      </div>
      <div class="form-group col-3">
        <label for="equipment_id" class="form-label">المعدة</label>
        <select name="equipment_id" id="equipment_id" class="form-select" required>
          <option value="" disabled>اختر المعدة ...</option>
          <?php getEquipment($record->equipment_id); ?>
        </select>
      </div>
      <div class="form-group col-3">
        <label for="repair_section" class="form-label">قسم الاصلاح</label>
        <select name="repair_section" id="repair_section" class="form-select" disabled>
          <option value="" disabled>اختر قسم الاصلاح ...</option>
          <?php getRepairDepartment($record->equipment_id); ?>
        </select>
      </div>
      
    </div>

    <div class="row justify-content-around mt-3">
      <div class="form-group col-3">
        <label for="record_id" class="form-label">رقم إذن الشغل</label>
        <div class="row">
          <span class="input-group-text col-auto" id="record_book_abbr">#</span>
          <input type="number" name="record_id" id="record_id" class="col form-control" 
            placeholder="ادخل رقم إذن الشغل ..." min="1"  required
            value = <?= $record->record_id ?> >
        </div>
      </div>
      <div class="form-group col-3">
        <label for="record_date" class="form-label">تاريخ إذن الشغل</label>
        <input type="date" name="record_date" id="record_date" class="form-control" 
          placeholder="اختر تاريخ إذن الشغل  ..." required
          value = <?= $record->record_date;  ?> >
      </div>
      <input type="hidden" name="record_year" id="record_year" value="">
      <div class="form-group col-3">
        <label for="equipment_condition_id" class="form-label">موقف المعدة</label>
        <select name="equipment_condition_id" id="equipment_condition_id" class="form-select" required>
          <option value="" disabled>اختر موقف المعدة ...</option>
          <?php getEquipmentCondition($record->equipment_condition_id); ?>
        </select>
      </div>
    </div>

    <div class="row justify-content-around mt-3">
      <div class="form-group col-2">
          <label for="mmc_id" class="form-label">رقم MMC</label>
          <input type="number" name="mmc_id" id="mmc_id" class="form-control" 
              placeholder="ادخل رقم MMC  ..." min="0" 
              value = "<?= $record->mmc_id;  ?>" >
      </div>
      <div class="form-group col-2">
        <label for="equipment_serial_number" class="form-label">رقم المعدة</label>
        <input type="number" name="equipment_serial_number" id="equipment_serial_number" 
          class="form-control" placeholder="ادخل رقم المعدة ..." min="0"
          value = <?= $record->equipment_serial_number;  ?>>
      </div>
      <div class="form-group col-3">
        <label for="repair_category" class="form-label">نوع الاصلاح</label>
        <select name="repair_cat_id" id="repair_category" class="form-select">
          <option value="" disabled>اختر نوع الاصلاح ...</option>
          <?php getRepairCat($record->repair_cat_id); ?>
        </select>
      </div>
      <div class="form-group col-3">
        <label for="repair_date" class="form-label">تاريخ الاصلاح </label>
        <input type="date" name="repair_date" id="repair_date" class="form-control"
          value = <?= $record->repair_date;  ?>>
      </div>
    </div>

    <div class="row justify-content-around mt-3">
      <div class="form-group col-auto">
        <label for="unit" class="form-label">الوحدة</label>
        <input type="text" name="unit" id="unit" class="form-control"
          value="<?= $record->unit ?>" disabled>
      </div>
      <div class="form-group col-3">
        <label for="military_unit" class="form-label">الفرقة/اخرى</label>
        <select name="unit_id[]" id="military_unit" class="form-select">
          <option value="" selected disabled>اختر الفرقة/اخرى ...</option>
          <?php getMilitaryUnits(); ?>
          <option value="1">وحدات اخرى</option>
        </select>
      </div>
      <div class="form-group col-6" hidden>
        <label for="military_unit_others" class="form-label">وحدات اخرى</label>
        <select name="unit_id[]" id="military_unit_others" class="form-select">
          <option value="" selected disabled>اختر وحدات اخرى ...</option>
          <?php getOtherMilitaryUnits(); ?>
        </select>
      </div>
      <div class="form-group col-3" hidden>
        <label for="military_brigade" class="form-label">اللواء</label>
        <select name="military_brigade" id="military_brigade" class="form-select">
          <option value="" selected disabled>اختر اللواء ...</option>
        </select>
      </div>
      <div class="form-group col-3" hidden>
        <label for="military_battalion" class="form-label">الكتيبة</label>
        <select name="unit_id[]" id="military_battalion" class="form-select">
          <option value="" selected disabled>اختر الكتيبة ...</option>
        </select>
      </div>

    </div>

    <div class="row justify-content-around mt-3" id="delivery" >
      <div class="form-group col-3">
      <label for="delivery_date" class="form-label">تاريخ التسليم </label>
        <input type="date" name="delivery_date" id="delivery_date" class="form-control" 
          placeholder="اختر تاريخ التسليم ..."
          value=<?= $record->delivery_date ?>>
      </div>
      <div class="form-group col-3">
        <label for="delegate_number" class="form-label">رقم عسكري</label>
        <input type="number" name="delegate_number" id="delegate_number" class="form-control" 
          placeholder="ادخل رقم عسكري  ..." min="0"
          value="<?= $record->delegate_number ?>">
      </div>
      <div class="form-group col-3">
        <label for="delegate_name" class="form-label">اسم المندوب </label>
        <input type="text" name="delegate_name" id="delegate_name" class="form-control" 
          placeholder="ادخل اسم المندوب  ..."
          value="<?= $record->delegate_name ?>">
      </div>
    </div>

    <div class="row justify-content-around my-4">
      <button type="submit" name="edit" class="btn btn-dark py-3 col-4">
      تعديل <i class="fa fa-edit" aria-hidden="true"></i>
      </button>
      <!-- <button type="button" class="btn btn-danger py-3 col-4" 
          onclick="getRid(<?=$record->id ?>)">
        حذف <i class="fa fa-trash-alt" aria-hidden="true"></i>
      </button> -->
    </div>
  
  </form>
</section>
<?php endif ?>
<!-- Modal -->
<!-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" dir="rtl"
      aria-labelledby="deleteModalLabel" aria-hidden="true" onchange="getRid()">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <h5 class="modal-title" id="deleteModalLabel">تأكيد حذف</h5>
        <button type="button" class="btn-close m-0" 
            data-dismiss="modal" aria-label="Close" onclick="$('#deleteModal').modal('hide')"></button>
      </div>
      <div class="modal-body">
        <p>أنت على وشك حذف اذن الشغل <strong>#</strong></p>
        <p>هذه العملية لا رجعة فيها, هل تريد المتابعة ؟</p>
      </div>
      <form method="POST" action="./display-record.view.php" class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"
          onclick="$('#deleteModal').modal('hide')">غلق</button>
        <button type="submit" class="btn btn-danger px-5" >تأكيد</button>
        <input type="hidden" name="del" value="<?= $record->id ?>">
      </form>
    </div>
  </div>
</div> -->

<?php include_once './../app/footer.php' ; ?>
<script src="./display-record.js"></script>
