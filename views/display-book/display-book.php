<?php

require_once __DIR__ . './../app/header.php' ;
require_once __DIR__ . './display-book.service.php' ;

?>

<div class="text-center mb-2">
  <h4 dir="rtl" class="d-inline">دفتر <?php echo $_GET['record_book'] ; ?></h4>
    <!-- <button onclick='_copy(tb)' class="btn btn-primary px-3 py-0">
     نسخ <i class="fa fa-copy" aria-hidden="true"></i>
    </button> -->
</div>

<table class="table table-bordered border-dark table-hover text-center mb-5 bg-gradient bg-light shadow fw-bolder"
     id="tb" dir="rtl">
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
      $num_rows = display_records($_GET['record_book']) ;
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


<?php require_once __DIR__ . './../app/footer.php' ; ?>