<?php

class Record {

    public $id ;
    public $record_id  ;
    public $mmc_id  ;
    public $record_date ;
    public $record_book ;
    public $record_year ;
    public $equipment_id ;
    public $equipment_serial_number ;

    public $equipment_condition_id ;
    public $repair_cat_id ;
    public $repair_date ;
    public $delivery_date ;

    public $delegate_name ;
    public $delegate_number ;
    public $is_other ;
    public $unit_id ;
    public $unit ;

    public function createRecord ($obj) {
        $this->id = (int)$obj['id'] ?? 0 ;
        $this->equipment_id = (int)$obj['equipment_id'] ;
        $this->record_id = (int)$obj['record_id'] ;
        $this->mmc_id = (int)$obj['mmc_id'] ;
        $this->record_date = "'". $obj['record_date'] ."'" ;
        $this->record_book = $obj['record_book'] ;
        $this->equipment_condition_id = (int)$obj['equipment_condition_id'] ;
        $this->equipment_serial_number = (int)$obj['equipment_serial_number'] ;
        $this->repair_cat_id = (int)$obj['repair_cat_id'];
        $this->repair_date = "'". $obj['repair_date'] ."'" ;
        $this->unit_id = (int)$obj['unit_id'];
        $this->delivery_date = "'". $obj['delivery_date'] ."'" ;
        $this->delegate_name = $obj['delegate_name'] ;
        $this->delegate_number = (int)$obj['delegate_number'] ;
        $this->is_other = ((int)( ($obj['unit_id'][0] == '1') ? 1 : -1 )) ?? ((int)$obj['is_other']) ;
        $this->unit = $obj['unit'] ?: '' ;
    }

    public function updateRecord ($obj) {
        $this->id = (int)$obj['id'] ?? $this->id ;
        $this->mmc_id = (int)$obj['mmc_id'] ?? $this->mmc_id ;
        $this->record_year = (int)$obj['record_year'] ?? $this->record_year ;
        $this->equipment_id = (int)$obj['equipment_id'] ?? $this->equipment_id ;
        $this->record_id = (int)$obj['record_id'] ?? $this->record_id ;
        $this->equipment_condition_id = (int)$obj['equipment_condition_id'] ?? $this->equipment_condition_id ;
        $this->equipment_serial_number = (int)$obj['equipment_serial_number'] ?? $this->equipment_serial_number ;
        $this->repair_cat_id = (int)$obj['repair_cat_id'] ?? $this->repair_cat_id ;
        $this->unit_id = (isset($obj['unit_id'][1])) ? (int)$obj['unit_id'][1] : $this->unit_id ;
        $this->is_other = ( (isset($obj['unit_id'][0]) && $obj['unit_id'][0]  == '1') ? 1 : -1 ) ?? $this->is_other ;
        $this->delegate_number =  (int)$obj['delegate_number'] ?? $this->delegate_number ;
        $this->record_date =  $obj['record_date'] ?? $this->record_date ;
        $this->repair_date =  $obj['repair_date'] ?? $this->repair_date ;
        $this->delivery_date =  $obj['delivery_date'] ?? $this->delivery_date ;
        $this->delegate_name =  $obj['delegate_name'] ?? $this->delegate_name ;
    }
}

?>