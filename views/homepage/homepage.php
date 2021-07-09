<?php 

// if(isset($_GET['del']) && $_GET['del'] == '1') {
//     $_SESSION['msg'] =  "تم حذف إذن الشغل بنجاح";
//     $_SESSION['msg_title'] =  "تهانينا!";
//     $_SESSION['msg_type'] =  "success";
// }

?>

<div class="card-group text-center font-weight-bold">
    <div class="card">
        <div class="card-header bg-primary text-white">
             <i class="fas fa-tools" aria-hidden="true"></i> اذن شغل
        </div>
        <div class="card-body list-group font-weight-bold p-4">
            <a href="views/add-record/add-record.php" class="list-group-item list-group-item-action"><i class="fas fa-plus" aria-hidden="true"></i> اضافة</a>
            <!-- <a onclick="edit()" class="list-group-item list-group-item-action btn"><i class="fas fa-edit" aria-hidden="true"></i> تعديل</a> -->
            <!-- <a onclick="del()" class="list-group-item list-group-item-action btn"><i class="fas fa-trash-alt" aria-hidden="true"></i> حذف</a> -->
            <!-- <a onclick="inquery()" class="list-group-item list-group-item-action btn"><i class="fas fa-tv" aria-hidden="true"></i> عرض</a> -->
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-dark text-white">
             <i class="fas fa-clipboard-list" aria-hidden="true"></i>
            مواقف | تمامات
        </div>
        <div class="card-body list-group p-4 font-weight-bold">
            <a href="views/inquery-records/inquery-records.php" class="list-group-item list-group-item-action"><i class="fas fa-search" aria-hidden="true"></i> استعلام</a>
            <a href="views/repaired-equip/repaired-equip.php?state=2" class="list-group-item list-group-item-action"><i class="fas fa-calendar-check" aria-hidden="true"></i> موقف صالح</a>
            <a href="views/repaired-equip/repaired-equip.php?state=1" class="list-group-item list-group-item-action"><i class="fas fa-calendar-times" aria-hidden="true"></i> موقف عاطل</a>
            <a href="#" class="list-group-item list-group-item-action text-decoration-line-through"><i class="fas fa-tasks" aria-hidden="true"></i> حجم معونات</a>
            <a href="#" class="list-group-item list-group-item-action d-none">يومية الانتاج</a>
            <a href="#" class="list-group-item list-group-item-action d-none">خطة اصلاح البطاريات</a>
        </div>
    </div>
</div>
<div class="card-group text-center font-weight-bold">
    <div class="card">
        <div class="card-header bg-success text-white">
            <i class="fas fa-book" aria-hidden="true"></i>
            دفاتر
        </div>
        <div class="card-body list-group p-4 font-weight-bold">
            <a href="views/display-book/display-book.php?record_book=لاسلكي قدرة منخفضة" class="list-group-item list-group-item-action">دفتر اللاسلكي قدرة منخفضة</a>
            <a href="views/display-book/display-book.php?record_book=لاسلكي قدرة عالية و متعددة" class="list-group-item list-group-item-action">دفتر اللاسلكي قدرة عالية و متعددة</a>
            <a href="views/display-book/display-book.php?record_book=مفردات" class="list-group-item list-group-item-action">دفتر المفردات</a>
            <a href="views/display-book/display-book.php?record_book=بطاريات" class="list-group-item list-group-item-action">دفتر البطاريات</a>
            <a href="views/display-book/display-book.php?record_book=مكن" class="list-group-item list-group-item-action">دفتر المكن</a>
            <a href="views/display-book/display-book.php?record_book=صناعات" class="list-group-item list-group-item-action">دفتر الصناعات</a>
            <a href="views/display-book/display-book.php?record_book=خطية/آلية/تشكيلات برية" class="list-group-item list-group-item-action">دفتر الخطية/آلية/تشكيلات برية</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-danger text-white">
            <i class="fas fa-chart-bar"></i>
            احصائيات
        </div>
        <div class="card-body list-group p-4 font-weight-bold">
            <a href="#" class="list-group-item list-group-item-action text-decoration-line-through">الصلاحية الفنية</a>
            <a href="#" class="list-group-item list-group-item-action d-none">قطع الغيار المستهلكة</a>
            <a href="views/repair-cost/repair-cost.php" class="list-group-item list-group-item-action">تكلفة الاصلاح</a>
            <a href="#" class="list-group-item list-group-item-action text-decoration-line-through">الطاقة الانتاجية</a>
            <a href="#" class="list-group-item list-group-item-action d-none">#####</a>
        </div>
    </div>
</div>


<script>
    function edit() {
       let x =  prompt("ادخل كود إذن الشغل: ") ;
       if (x) {
        var form = $('<form action="views/display-record/display-record.php" method="get">' +
            '<input type="number" name="record_id" value="' + x + '" />' +
            '</form>');
        $('body').append(form);
        form.submit();
        }
    }

    function del() {
       let x =  prompt("ادخل كود إذن الشغل: ") ;
       if (x) {
        var form = $('<form action="views/display-record/display-record.php" method="post">' +
            '<input type="number" name="del" value="' + x + '" />' +
            '</form>');
            $('body').append(form);
            form.submit();
        }
    }
    
    function inquery() {
       let x =  prompt("ادخل كود إذن الشغل: ") ;
       if (x) {
            var form = $('<form action="views/display-record/display-record.php" method="get">' +
            '<input type="number" name="record_id" value="' + x + '" />' +
            '</form>');
            $('body').append(form);
            form.submit();
       }
    }
</script>