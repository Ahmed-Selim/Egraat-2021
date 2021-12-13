<?php

require_once __DIR__ . './../app/header.php' ;
require_once __DIR__ . './repair-cost.service.php' ;

?>

<div class='row justify-content-center my-2'>
    <h4 dir='rtl' class='text-center font-monospace col-auto'>تكلفة اصلاح المعدات</h4>
    <button onclick='save_pdf()' class='btn btn-primary px-3 col-auto' data-html2canvas-ignore='true'>
      حفظ <i class='fa fa-save' aria-hidden='true'></i>
    </button> 
  </div>

<table class="table table-bordered border-dark table-hover text-center mb-5 bg-gradient bg-light shadow fw-bolder"
     id="tb" dir="rtl">
<thead class="border-2">
    <tr>
      <th scope="col">م</th>
      <th scope="col">اسم المعدة</th>
      <th scope="col">التكلفة (ج.م)</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $num_rows = equip_repair_cost() ;
    ?>
  </tbody>
  <!-- <tfoot>
    <tr>  
      <td colspan=8 class="display-6">
        الكمية : <strong><?php //echo $num_rows-1 ; ?></strong>
      </td>
    </tr>
  </tfoot> -->
</table>


<?php require_once __DIR__ . './../app/footer.php' ; ?>