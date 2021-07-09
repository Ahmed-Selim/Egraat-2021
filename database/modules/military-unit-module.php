<?php

require_once __DIR__.'./../connection.php' ;

class MilitaryUnitModule {
    
    private $db ;

    public function __construct () {  $this->db = DBConnection::getConnection() ; }
    
    public function getMilitaryUnits_all () {

        $sql = "SELECT 
                    id,
                    military_units.group, 
                    brigade, 
                    battalion
                FROM 
                    military_units
                ORDER BY
                    `group` ASC,
                    brigade ASC,
                    battalion ASC" ;

        $resultRows = $this->db->query($sql);
        
        $result = array() ;

        if ($resultRows->num_rows > 0) {
            while($row = $resultRows->fetch_assoc()) {
              $temp = array(
                "id" => $row["id"],
                "group" => $row["group"] , 
                "brigade" => $row["brigade"] , 
                "battalion" => $row["battalion"]
              ) ;
            //   array_push($result, $temp) ;
                $result[$row['id']] = $temp ;
            }
            // var_dump($result) ;
            return $result ;
        } else {
            echo "0 results";
        }
    }

    public function getOtherUnits () {

        $sql = "SELECT 
                    id,
                    unit
                FROM 
                    other_units" ;

        $resultRows = $this->db->query($sql);
        
        $result = array() ;

        if ($resultRows->num_rows > 0) {
            while($row = $resultRows->fetch_assoc()) {
              $temp = array(
                "id" => $row["id"],
                "unit" => $row["unit"]
              ) ;
              array_push($result, $temp) ;
            }
            // var_dump($result) ;
            return $result ;
        } else {
            echo "0 results";
        }
    }
    
    public function getMilitaryUnits () {

        $sql = "SELECT DISTINCT `id`, `group` FROM `military_units` WHERE is_other = 0 ORDER BY `group`" ;

        $resultRows = $this->db->query($sql);
        
        $result = array() ;

        if ($resultRows->num_rows > 0) {
            while($row = $resultRows->fetch_assoc()) {
              $temp = array(
                // "id" => $row["id"],
                "group" => $row["group"] , 
              ) ;
              array_push($result, $temp) ;
            }
            // var_dump($result) ;
            return $result ;
        } else {
            echo "0 results";
        }
    }
    
    public function getBrigadesByGroup (int $group) {

        $sql = "SELECT DISTINCT `brigade` FROM `military_units` WHERE `group` = $group" ;

        $resultRows = $this->db->query($sql);
    
        if ($resultRows->num_rows > 0) {
            while($row = $resultRows->fetch_assoc()) {
                echo "<option class='selectOpt' value='".$row["brigade"]."'>ل ". $row["brigade"]."</option>" ;
            }
        } else {
            echo "0 results";
        }
    }
    
    public function getBattalionByBrigade (int $brigade) {

        $sql = "SELECT `id`, `battalion` FROM `military_units` WHERE `brigade` = $brigade" ;

        $resultRows = $this->db->query($sql);
        
        if ($resultRows->num_rows > 0) {
            while($row = $resultRows->fetch_assoc()) {
                if ($row["battalion"] != 0) {
                    echo "<option class='selectOpt' value='".$row["id"]."'>ك ". $row["battalion"]."</option>" ;
                } else {
                    echo "<option class='selectOpt' value='".$row["id"]."'>قيادة</option>" ;
                }
            }
        }
    }
}

