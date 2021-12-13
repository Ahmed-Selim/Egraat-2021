<?php

include_once __DIR__.'./../app/header.php' ;
require_once __DIR__.'./repaired-equip.service.php' ;

echo "
  <div class='row justify-content-center'>
    <h4 dir='rtl' class='text-center display-5 font-monospace col-auto'>موقف المعدات ".
      ( ($_GET['state'] == '2') ? 'الصالحة' : 'العاطلة' ) .
    "</h4>
    <button onclick='save_pdf()' class='btn btn-primary px-3 my-3 col-auto' data-html2canvas-ignore='true'>
      حفظ <i class='fa fa-save' aria-hidden='true'></i>
    </button> 
  </div>" ;

foreach ( [5, 8, 10, 12, 15] as $i): ?>

<div class="text-center mb-2">
  <h4 dir="rtl" class="d-inline">الفرقة <?= $i ?> دجو</h4>
  <button onclick='_copy(<?= "id$i" ?>)' class="btn btn-primary px-3 py-0" data-html2canvas-ignore='true'>
     نسخ <i class="fa fa-copy" aria-hidden="true"></i>
  </button>
</div>

<table class="table table-bordered border-dark table-hover text-center mb-5 bg-gradient bg-light shadow fw-bolder"
   dir="rtl" id='<?= "id$i" ?>'>
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
      $num_rows = repaired_equip($i, $_GET['state']) ;
    ?>
  </tbody>
  <?php if ($num_rows === 1): ?>
  <tfoot>
    <tr>  
      <!-- <td colspan=8 class="display-6"> -->
        <!-- الكمية : <strong><?php  // echo $num_rows = $num_rows-1 ; ?></strong> -->
      <!-- </td> -->
        <td colspan=8 class="display-6">
          <strong> لا يوجد </strong>
        </td>
    </tr>
  </tfoot>
  <?php endif ?>
</table>
<?php endforeach ?>

<?php include_once './../app/footer.php' ; ?>