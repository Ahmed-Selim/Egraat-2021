<?php

require_once __DIR__.'./../../database/connection.php'; 
require_once __DIR__.'./../../database/modules/equipments-module.php' ;
require_once __DIR__.'./../../database/modules/equip-cond-module.php' ;
require_once __DIR__.'./../../database/modules/repair-cat-module.php' ;
require_once __DIR__.'./../../database/modules/military-unit-module.php' ;
require_once __DIR__.'./../../database/modules/inquery-records-module.php' ;

$military_units = (new MilitaryUnitModule())->getMilitaryUnits_all() ;

$groups = $brigades = $battalions =  array();

foreach ($military_units as $key => $val) {
  $groups[$key] = (int)$val['group'] ;
}


function getEquipments () {
    $Equipments = (new EquipmentModule())->getEquipments() ; ;
    foreach ($Equipments as $equipment) { 
        echo "<option value='".$equipment["id"]."'>"
            .$equipment["equipment_title"].
            "</option>" ;
    }    
}

function getEquipmentConditions() {
    foreach ((new EquipmentConditionModule())->getEquipmentConditions() as $condition) { 
        echo "<option value='".$condition["id"]."'>".$condition["condition"]."</option>" ;
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

function display_records ($obj) {
    $result = (new InqueryRecordsModule())->get_records($obj) ;
    $iter = 1 ;
    while($row = $result->fetch_assoc()) {
        // echo "<pre>".print_r($row) . '</pre><br>' ;
        echo 
            "<tr title='$row[id]'>
                <th scope='row'>$iter</th>
                <td><a href='./../display-record/display-record.php?record_id=$row[id]' 
                    class='text-decoration-none'>
                        $row[record_id]
                    </a>
                </td>
                <td class='format_date'>$row[record_date]</td>
                <td>$row[equipment_title]</td>
                <td>$row[unit]</td>
                <td>$row[condition]</td>
                <td class='format_date'>$row[repair_date]</td>
                <td class='format_date'>$row[delivery_date]</td>
            </tr>" ;
        $iter++ ;
    }
    return $iter ;
}

?>