<?php



$route = $_SESSION['route'] ?: 'homepage' ;
switch ($route) {
    case 'homepage':
        require_once 'views/homepage/homepage.php' ;
        break;
    
    default:
        # code...
        break;
}

?>