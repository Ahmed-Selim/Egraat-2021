<?php

require_once __DIR__.'./../../database/connection.php' ;
require_once __DIR__.'./../../database/modules/equipments-module.php' ;
require_once __DIR__.'./../../database/modules/equip-cond-module.php' ;
require_once __DIR__.'./../../database/modules/repair-cat-module.php' ;
require_once __DIR__.'./../../database/modules/military-unit-module.php' ;
require_once __DIR__.'./../../database/modules/records-module.php' ;

$Equipments = (new EquipmentModule())->getEquipments() ;
$books = (new EquipmentModule())->getBooks() ;
$military_units = (new MilitaryUnitModule())->getMilitaryUnits_all() ;

$groups = $brigades = $battalions =  array();

foreach ($military_units as $key => $val) {
  $groups[$key] = (int)$val['group'] ;
}

function getEquipments () {
    global $Equipments ;
    foreach ($Equipments as $equipment) { 
        echo "<option value='".$equipment["id"]."'>"
            .$equipment["equipment_title"].
            "</option>" ;
    }    
}

function getRepairDepartments() {
    global $Equipments ;
    foreach ($Equipments as $equipment) { 
        echo "<option value='".$equipment["id"]."'>"
            .$equipment["repair_section"].
            "</option>" ;
    }  
}

function getRecordBooks() {
    global $Equipments ;
    foreach ($Equipments as $equipment) { 
        echo "<option value='".$equipment["id"].
            "' data-abbr='".$equipment["equipment_record_abbr"]."'>"
            .$equipment["record_book"].
            "</option>" ;
    }  
}

function getBooks () {
    global $books ;
    foreach ($books as $book) { 
        echo "<option value='$book[record_book]' data-abbr='$book[equipment_record_abbr]'>$book[record_book]</option>" ;
    }  
}

function getEquipmentConditions() {
    foreach ((new EquipmentConditionModule())->getEquipmentConditions() as $condition) { 
        echo "<option value='".$condition["id"]."'>".$condition["condition"]."</option>" ;
    }  
}

function getRepairCats() {
    foreach ((new RepairCatModule())->getRepairCats() as $cat) { 
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

function add_record ($request) {
    (new RecordModule())->add_record($request) ;
}
