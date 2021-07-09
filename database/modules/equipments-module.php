<?php

class EquipmentModule {
    
    private $db ;

    public function __construct () {  $this->db = DBConnection::getConnection() ; }
    
    public function getEquipments () {

        $sql = "SELECT 
                    id,
                    equipment_title,
                    record_book,
                    equipment_record_abbr,
                    repair_section,
                    equipment_group,
                    repair_cost
                FROM 
                    equipments
                ORDER by 
                    repair_section DESC
                " ;

        $resultRows = $this->db->query($sql);
        
        $result = array() ;

        if ($resultRows->num_rows > 0) {
            while($row = $resultRows->fetch_assoc()) {
              $temp = array(
                "id" => $row["id"],
                "equipment_title" => $row["equipment_title"],
                "record_book" => $row["record_book"],
                "equipment_record_abbr" => $row["equipment_record_abbr"],
                "repair_section" => $row["repair_section"],
                "equipment_group" => $row["equipment_group"],
                "repair_cost" => $row["repair_cost"]
              ) ;
              array_push($result, $temp) ;
            }
            // var_dump($result) ;
        }
        return $result ;
    }

    public function getBooks () {
        $sql = "SELECT `id`, `record_book` ,`equipment_record_abbr` FROM `equipments` GROUP BY `record_book`" ;

        $resultRows = $this->db->query($sql);
        
        $result = array() ;

        if ($resultRows->num_rows > 0) {
            while($row = $resultRows->fetch_assoc()) {
              array_push($result, $row) ;
            }
            // var_dump($result) ;
        }
        return $result ;
    
    }

    public function getEquipmentsByBook ($book) {
        $sql = "SELECT 
                    id,
                    equipment_title,
                    equipment_record_abbr
                FROM 
                    equipments
                WHERE
                    record_book = '$book'
                " ;

        $resultRows = $this->db->query($sql);
        
        if ($resultRows->num_rows > 0) {
            while($row = $resultRows->fetch_assoc()) {
              echo "<option class='' value='$row[id]'>$row[equipment_title]</option>" ;
            }
        }
    }
}

