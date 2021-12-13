<?php

class InqueryRecordsModule {
    
    private $db ;

    public function __construct () {  $this->db = DBConnection::getConnection() ; }
    
    public function get_records ($obj) {

        $prep = array(
            'equip' => $obj['equip'] ?? NULL ,
            'all' => $obj['all'] ?? NULL ,
            'cond' => $obj['cond'] ?? NULL ,
            'cond_id' => $obj['equipment_condition_id'] ?? NULL ,
            'date' => $obj['date'] ?? NULL ,
            'date_from' => $obj['date_from'] ?? NULL ,
            'date_to' => $obj['date_to'] ?? NULL ,
            'unit' => $obj['unit'] ?? NULL ,
            'unit_id' => $obj['unit_id'] ?? NULL , 
            'military_brigade' => $obj['military_brigade'] ?? NULL
        );

        $sql = "
            SELECT 
                id, record_id, record_date, equipment_title, unit, `condition`, repair_date, delivery_date 
            FROM 
                record 
            WHERE 
                1 = 1 " ;

        if (!$prep['all']) {
            $sql .= " AND equipment_id in ( " . join(' , ', $prep['equip']) . " ) " ;
        }

        if ($prep['cond']) {
            $sql .= " AND condition_id = $prep[cond_id] " ;
        }

        if ($prep['date']) {
            $sql .= " AND record_date <= '$prep[date_to]' AND record_date >= '$prep[date_from]' " ; 
        }

        if ($prep['unit']) {
            $is_other = ($prep['unit_id'][0] == 1) ?: -1 ; 
            $unit_id = $prep['unit_id'][1] ;
            $sql .= " AND is_other = $is_other AND unit_id = $unit_id " ;
        }

        $result = $this->db->query($sql);

        return $result ;
    }
}

?>