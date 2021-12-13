<?php

require_once __DIR__ . './../app/header.php';
require_once __DIR__ . './add-record.service.php';

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     add_record($_POST) ;
// }
?>

<!-- action="//localhost/pro/views/app/redirect.php" -->

<h4 dir="rtl" class="text-center">أضافة إذن شغل</h4>

<section dir="rtl" class="container-fluid px-3">
    <form method="POST" role="form"   
        class="border border-3 border-primary rounded text-center needs-validation" novalidate>

        <div class="row justify-content-around mt-3">
            <div class="form-group col-3">
                <label for="records_book" class="form-label">دفتر</label>
                <select name="" id="records_book" class="form-select" required>
                    <option value="" selected disabled>اختر دفتر ...</option>
                    <?php // getRecordBooks();
                        getBooks(); 
                    ?>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="equipment_id" class="form-label">المعدة</label>
                <select name="equipment_id" id="equipment_id"
                    class="form-select" required>
                    <option value="" selected disabled>اختر المعدة ...</option>
                    <?php //getEquipments(); ?>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="repair_section" class="form-label">قسم الاصلاح</label>
                <select name="" id="repair_section" class="form-select" disabled>
                    <option value="" selected disabled>اختر قسم الاصلاح ...</option>
                    <?php getRepairDepartments(); 
                    ?>
                </select>
            </div>
            
        </div>

        <div class="row justify-content-around mt-3">
            <div class="form-group col-3">
                <label for="record_id" class="form-label">رقم إذن الشغل</label>
                <div class="row">
                    <span class="input-group-text col-auto" id="record_book_abbr">#</span>
                    <input type="number" name="record_id" id="record_id" class="col form-control" placeholder="ادخل رقم إذن الشغل ..." min="0" required>
                </div>
            </div>
            <div class="form-group col-3">
                <label for="record_date" class="form-label">تاريخ إذن الشغل</label>
                <input type="date" name="record_date" id="record_date" class="form-control" placeholder="اختر تاريخ إذن الشغل  ..." min="2021-07-01" required>
                <small class="text-muted"> صيغة التاريخ [يوم-شهر-سنة] , من يوم 01-07-2021 </small>
            </div>
            <input type="hidden" name="record_year" id="record_year" value="">
            <div class="form-group col-3">
                <label for="equipment_condition_id" class="form-label">موقف المعدة</label>
                <select name="equipment_condition_id" id="equipment_condition_id" class="form-select" required>
                    <option value="" selected disabled>اختر موقف المعدة ...</option>
                    <?php getEquipmentConditions(); 
                    ?>
                </select>
            </div>
        </div>

        <div class="row justify-content-around mt-3">
            <div class="form-group col-2">
                <label for="mmc_id" class="form-label">رقم MMC</label>
                <input type="number" name="mmc_id" id="mmc_id" class="form-control" 
                    placeholder="ادخل رقم MMC  ..." min="0">
            </div>
            <div class="form-group col-2">
                <label for="equipment_serial_number" class="form-label">رقم المعدة</label>
                <input type="number" name="equipment_serial_number" id="equipment_serial_number" class="form-control" placeholder="ادخل رقم المعدة ..." min="0">
            </div>
            <div class="form-group col-3">
                <label for="repair_category" class="form-label">نوع الاصلاح</label>
                <select name="repair_cat_id" id="repair_category" class="form-select" required>
                    <option value="" selected disabled>اختر نوع الاصلاح ...</option>
                    <?php getRepairCats(); 
                    ?>
                </select>
            </div>
            <div class="form-group col-3" hidden>
                <label for="repair_date" class="form-label">تاريخ الاصلاح </label>
                <input type="date" name="repair_date" id="repair_date" class="form-control" placeholder="اختر تاريخ الاصلاح  ..." min="2021-07-01">
                <small class="text-muted"> صيغة التاريخ [يوم-شهر-سنة] </small>
            </div>
        </div>

        <div class="row justify-content-around mt-3">
            <div class="form-group col-3">
                <label for="military_unit" class="form-label">الفرقة/اخرى</label>
                <select name="unit_id[]" id="military_unit" class="form-select" required>
                    <option value="" selected disabled>اختر الفرقة/اخرى ...</option>
                    <?php getMilitaryUnits(); 
                    ?>
                    <option value="1">وحدات اخرى</option>
                </select>
            </div>
            <div class="form-group col-6" hidden>
                <label for="military_unit_others" class="form-label">وحدات اخرى</label>
                <select name="unit_id[]" id="military_unit_others" class="form-select">
                    <option value="" selected disabled>اختر وحدات اخرى ...</option>
                    <?php getOtherMilitaryUnits(); 
                    ?>
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

        <div class="row justify-content-around mt-3" id="delivery" hidden>
            <div class="form-group col-3">
                <label for="delivery_date" class="form-label">تاريخ التسليم </label>
                <input type="date" name="delivery_date" id="delivery_date" class="form-control" placeholder="اختر تاريخ التسليم ..." min="2021-07-01">
                <small class="text-muted"> صيغة التاريخ [يوم-شهر-سنة] </small>
            </div>
            <div class="form-group col-3">
                <label for="delegate_number" class="form-label">رقم عسكري</label>
                <input type="number" name="delegate_number" id="delegate_number" class="form-control" placeholder="ادخل رقم عسكري  ..." min="0">
            </div>
            <div class="form-group col-3">
                <label for="delegate_name" class="form-label">اسم المندوب </label>
                <input type="text" name="delegate_name" id="delegate_name" class="form-control" placeholder="ادخل اسم المندوب  ...">
            </div>
        </div>

        <div class="row justify-content-around my-4">
            <button type="submit" class="btn btn-primary py-3 col-4 fw-bold">
                <i class="fas fa-plus" aria-hidden="true"></i>
                اضافة
            </button>
        </div>

    </form>
</section>

<?php
require_once '../app/footer.php';
?>

<script src="./add-record.js"></script>