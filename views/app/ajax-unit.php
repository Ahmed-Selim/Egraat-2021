<?php

require_once './../../database/modules/military-unit-module.php' ;
require_once './../../database/modules/equipments-module.php' ;

if ( ! empty($_POST['group']) ) {
    $group = $_POST['group'] ;
    
    $brigades = (new MilitaryUnitModule())->getBrigadesByGroup((int)$group) ;
}

if ( ! empty($_POST['brigade']) ) {
    $brigade = $_POST['brigade'] ;
    
    $battalions = (new MilitaryUnitModule())->getBattalionByBrigade((int)$brigade) ;
}

if ( ! empty($_POST['rid']) ) {
    $rid = $_POST['rid'] ;
    
}

if ( ! empty($_GET['book']) ) {
    $book = $_GET['book'] ;
    // echo "<html>Ahmec</html>";
    $equipments = (new EquipmentModule())->getEquipmentsByBook($book) ;
}
