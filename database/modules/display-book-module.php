<?php
// echo __DIR__ ;
// require_once __DIR__.'/../connection.php' ;
// require_once __DIR__.'/../classes/record-class.php' ;

class DisplayBookModule {
    
    private $db ;

    public function __construct () {  $this->db = DBConnection::getConnection() ; }
    
    public function get_records (string $book) {

        $sql = "
            SELECT 
                id, record_id, record_date, equipment_title, unit, `condition`, repair_date, delivery_date 
            FROM 
                record 
            WHERE 
                record_book = '$book'" ;
        
        $result = $this->db->query($sql);

        return $result ;
    }
}

?>