<?php

class EquipmentConditionModule {
    
    private $db ;

    public function __construct () {  $this->db = DBConnection::getConnection() ; }
    
    public function getEquipmentConditions () {

        $sql = "SELECT 
                    id,
                    equipments_condition.condition
                FROM 
                    equipments_condition
                " ;

        $resultRows = $this->db->query($sql);
        
        $result = array() ;

        if ($resultRows->num_rows > 0) {
            while($row = $resultRows->fetch_assoc()) {
              $temp = array(
                "id" => $row["id"],
                "condition" => $row["condition"],
              ) ;
              array_push($result, $temp) ;
            }
            // var_dump($result) ;
        }
        return $result ;
    }
}

