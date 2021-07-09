<?php

require_once __DIR__.'./../../database/connection.php' ;
require_once __DIR__.'./../../database/modules/equipments-module.php' ;


function equip_repair_cost () {
    $result = (new EquipmentModule())->getEquipments() ;
    $iter = 1 ;
    foreach ($result as $row) {
        // echo "<pre>".print_r($row) . '</pre><br>' ;
        echo 
            "<tr title='كود: $row[id]'>
                <th scope='row'>$iter</th>
                <td>$row[equipment_title]</td>
                <td>$row[repair_cost]</td>
            </tr>" ;
        $iter++ ;
    }
    return $iter ;
}

?>