<?php

require_once __DIR__.'./../../database/connection.php'; 
require_once __DIR__.'./../../database/modules/equipments-module.php' ;
require_once __DIR__.'./../../database/modules/equip-cond-module.php' ;
require_once __DIR__.'./../../database/modules/repair-cat-module.php' ;
require_once __DIR__.'./../../database/modules/military-unit-module.php' ;

$Equipments = (new EquipmentModule())->getEquipments() ;
$books = (new EquipmentModule())->getBooks() ;
$military_units = (new MilitaryUnitModule())->getMilitaryUnits_all() ;

$groups = $brigades = $battalions =  array();

foreach ($military_units as $key => $val) {
  $groups[$key] = (int)$val['group'] ;
}

function getEquipment (int $id) {
    global $Equipments ;
    foreach ($Equipments as $equipment) { 
        if ($equipment["id"] == $id)
            echo "<option value='".$equipment["id"]."' selected>".$equipment["equipment_title"]."</option>" ;
        else
            echo "<option value='".$equipment["id"]."'>".$equipment["equipment_title"]."</option>" ;
    }    
}

function getRepairDepartment(int $id) {
    global $Equipments ;
    foreach ($Equipments as $equipment) { 
        if ($equipment["id"] == $id)
            echo "<option value='".$equipment["id"]."'selected>".$equipment["repair_section"]."</option>" ;
        else
            echo "<option value='".$equipment["id"]."'>".$equipment["repair_section"]."</option>" ;
    }  
}

function getRecordBook($record_book) {
    global $books ;
    foreach ($books as $row => $book) {
        if ($book['record_book'] == $record_book)
            echo "<option value='".$book["record_book"]."' selected data-abbr='".$book["equipment_record_abbr"]."'>"
                .$book["record_book"]."</option>" ;
        else
            echo "<option value='".$book["record_book"]."' data-abbr='".$book["equipment_record_abbr"]."'>"
                .$book["record_book"]."</option>" ;
    }  
}

function getBook(int $id) {
    global $books ;
    foreach ($books as $book) { 
        if ($equipment["id"] == $id)
            echo "<option value='".$book["id"]."' selected data-abbr='".$book["equipment_record_abbr"]."'>"
                .$book["record_book"]."</option>" ;
        else
            echo "<option value='".$book["id"]."' data-abbr='".$book["equipment_record_abbr"]."'>"
                .$book["record_book"]."</option>" ;
    }  
}

function getEquipmentCondition(int $id) {
    foreach ((new EquipmentConditionModule())->getEquipmentConditions() as $condition) { 
        if ($condition["id"] == $id)
            echo "<option value='".$condition["id"]."' selected>".$condition["condition"]."</option>" ;
        else
            echo "<option value='".$condition["id"]."'>".$condition["condition"]."</option>" ;
    }  
}

function getRepairCat(int $id) {
    foreach ((new RepairCatModule())->getRepairCats() as $cat) { 
        if ($cat["id"] == $id)
            echo "<option value='".$cat["id"]."' selected>".$cat["repair_category"]."</option>" ;
        else
            echo "<option value='".$cat["id"]."'>".$cat["repair_category"]."</option>" ;
    }  
}

function getMilitaryUnits() {
    global $groups ;
    $groups = array_unique($groups) ;
    foreach ($groups as $key => $val) { 
        echo "<option value='".$val."'>فر ".$val."</option>" ;
    }  
}

function getOtherMilitaryUnits() {
    foreach ((new MilitaryUnitModule())->getOtherUnits() as $unit) { 
        echo "<option value='".$unit["id"]."'>".$unit["unit"]."</option>" ;
    }    
}

function update_record (Record $record) {
   return (new RecordModule())->update_record($record) ;
}

function delete_record($id) {
    return  (new RecordModule())->delete_record($id) ;
}
