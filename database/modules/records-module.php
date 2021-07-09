<?php

require_once __DIR__.'./../connection.php' ;
// require_once __DIR__.'/../classes/record-class.php' ;

class RecordModule {
    
    private $db ;

    public function __construct () {  $this->db = DBConnection::getConnection() ; }
    
    static function filter_array ($array) {
        function filter($var){
            return ($var !== NULL && $var !== FALSE && $var !== "" && $var !== "''");
        }

        return array_filter($array, "filter") ;
    }

    public function add_record ($record) {

        $prep = array(
            'record_id' => $record['record_id'],
            'record_date' => "'$record[record_date]'" ,
            'equipment_id' => $record['equipment_id'],
            'equipment_serial_number' => $record['equipment_serial_number'],
            'equipment_condition_id' => $record['equipment_condition_id'],
            'repair_cat_id' => $record['repair_cat_id'] ,
            'repair_date' => "'$record[repair_date]'",
            'delivery_date' => "'$record[delivery_date]'",
            'delegate_name' => "'$record[delegate_name]'",
            'delegate_number' => $record['delegate_number'],
            'is_other' => (($record['unit_id'][0]== '1') ? 1 : -1 ),
            'unit_id' => $record['unit_id'][1],
            'record_year' => $record['record_year'],
            'mmc_id' => $record['mmc_id']
        );
        
        $prep = RecordModule::filter_array($prep) ;
        $sql = "INSERT INTO records (" . implode(", ", array_keys($prep)) . ") values (" . implode(",", $prep) . ")";

        if ($this->db->query($sql) === TRUE) {
            $_SESSION['msg'] =  "تم اضافة إذن الشغل بنجاح";
            $_SESSION['msg_title'] =  "تهانينا!";
            $_SESSION['msg_type'] =  "success";
        } else {
            $_SESSION['msg'] =  "لم يتم اضافة اذن الشغل <br>" . "Error: " . $sql . "<br>" . $this->db->error;
            $_SESSION['msg_title'] =  "نأسف!";
            $_SESSION['msg_type'] =  "danger";
        }
    }

    public function get_record (int $id) {
        
        $sql = "
            SELECT
                id,  record_id, repair_id as repair_cat_id , mmc_id,
                equipment_serial_number, repair_section , equipment_record_abbr,
                record_date, equipment_id , record_book, delegate_name, delegate_number,
                unit, condition_id as equipment_condition_id, repair_date, delivery_date,
                is_other, unit_id
            FROM 
                record
            WHERE 
                id = $id
        " ;
        
        $result = $this->db->query($sql);

        $record = new Record() ;

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc() ;
            $record->createRecord($row) ;
        }

        return $record ;
    }

    public function update_record (Record $record) {
        
        $prep = array(
            'record_id' => (int)$record->record_id,
            'record_date' => "'$record->record_date'" ,
            'equipment_id' => (int)$record->equipment_id,
            'equipment_serial_number' => (int)$record->equipment_serial_number,
            'equipment_condition_id' => (int)$record->equipment_condition_id,
            'repair_cat_id' => (int)$record->repair_cat_id,
            'repair_date' => "'$record->repair_date'" ,
            'delivery_date' => "'$record->delivery_date'" ,
            'delegate_name' => "'$record->delegate_name'",
            'delegate_number' => (int)$record->delegate_number,
            'is_other' => (int)$record->is_other,
            'unit_id' => (int)$record->unit_id ?: NULL,
            'record_year' => (int)$record->record_year,
            'mmc_id' => (int)$record->mmc_id
        );
        
        $prep = RecordModule::filter_array($prep) ;


        $sql = "UPDATE records SET " ;
        
        foreach ($prep as $key => $value) {
            $sql .= "$key = $value ," ;
        }

        $sql = rtrim($sql, ',') . "Where id = $record->id";

        if ($this->db->query($sql) === TRUE) {
        //     // $_SESSION['message'] =  "تم اضافة إذن الشغل بنجاح";
            $_SESSION['msg'] =  "تم تعديل إذن الشغل بنجاح";
            $_SESSION['msg_title'] =  "تهانينا!";
            $_SESSION['msg_type'] =  "success";

        } else {
            echo "Error: " . $sql . "<br>" . $this->db->error; 
            //     // $_SESSION['message'] =  "Error: " . $sql . "<br>" . $this->db->error;
            $_SESSION['msg'] =  "لم يتم تعديل اذن الشغل <br>" . "Error: " . $sql . "<br>" . $this->db->error;
            $_SESSION['msg_title'] =  "نأسف!";
            $_SESSION['msg_type'] =  "danger";
        }
        
        return $record ;
    }

    function delete_record ($id) {
        $sql = "DELETE FROM records WHERE id = $id " ;
        return $this->db->query($sql) ;
    }

    public function repaired_equip (int $group, int $state) {
        $sql = "
            SELECT 
                id, record_id, record_date, equipment_title, unit, `condition`, repair_date, delivery_date
            FROM 
                record 
            WHERE 
                condition_id = $state 
            AND
                unit_id in (SELECT id from military_units WHERE `group` = $group) 
            AND 
                is_other = -1
            GROUP BY 
                unit , record_date , equipment_title;
            
        " ;
        return $this->db->query($sql);
    }

}


