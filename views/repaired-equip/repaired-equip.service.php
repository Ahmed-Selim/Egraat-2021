<?php

require_once (__DIR__.'/../../database/connection.php'); 
require_once (__DIR__.'/../../database/modules/records-module.php') ;


function repaired_equip (int $group, int $state) {
    $result = (new RecordModule())->repaired_equip($group, $state) ;
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