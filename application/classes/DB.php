<?php
/**
 * Description of DB
 *
 * @author NaZzar
 */
class DB {
    private $host;
    private $user;  
    private $pass;
    private $db;
    private $link;
    
    function __construct() {
        $this->host = HOST;
        $this->user = USER;
        $this->pass = PASS;
        $this->db = DB;
        $this->connect();
    }
    
    function another_db ($host, $user, $pass, $db){
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;
    }
            
    function connect(){
        $link = new mysqli($this->host, $this->user, $this->pass, $this->db);
        mysqli_set_charset($link,"utf8");
        return $link;
    }
    
    public function callProc($proc){
      $db = $this->connect();
      if (!$db->query("CALL ".$proc)) {
          return "Не удалось вызвать хранимую процедуру: (" .  $db->errno . ") " .  $db->error;
      }
    }

    public function query($query) {
        $db = $this->connect();
        $db->query($query);
        return 0;
    }
    
    public function query2($query) {
        $db = $this->connect();
        $result = $db->query($query);
        $results = array();
        while ( $row = $result->fetch_assoc() ) {
                $results[] = $row;
        }
        return $results;
    }
    
}
