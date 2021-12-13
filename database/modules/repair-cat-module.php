<?php

class RepairCatModule {
    
    private $db ;

    public function __construct () {  $this->db = DBConnection::getConnection() ; }
    
    public function getRepairCats () {

        $sql = "SELECT 
                    id,
                    repair_category
                FROM 
                    repair_cat
                " ;

        $resultRows = $this->db->query($sql);
        
        $result = array() ;

        if ($resultRows->num_rows > 0) {
            while($row = $resultRows->fetch_assoc()) {
              $temp = array(
                "id" => $row["id"],
                "repair_category" => $row["repair_category"],
              ) ;
              array_push($result, $temp) ;
            }
            // var_dump($result) ;
        }
        return $result ;
    }
}

